<?php

namespace App\Http\Controllers;
use App\Member;
use App\Lender;
use App\Loan;
use App\Payment;
use App\LoanPaymentDate;
use App\PaymentDate;
use Mail;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Input;
class LoansController extends Controller
{

    public function index()
    {
        return view('pages/loans');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loan = Loan::find($id);
        $data['id']   = $id;
        $data['first_name'] = $loan->lender->first_name;
        $data['last_name']  = $loan->lender->last_name;
        $data['codename']   = $loan->lender->codename;
        $data['is_member']   = $loan->lender->is_member;
        $data['email']   = "";
        $data['phone']      = $loan->lender->phone;
        $data['amount']     = $loan->total_amount;
        
        pr($data);
        return view('pages/members_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input  = Input::all();
        $loan   = Loan::find($id);

        $loan->lender->first_name = $input['first_name'];
        $loan->lender->last_name = $input['last_name'];
        $loan->lender->codename = $input['codename'];
        $loan->lender->email = $input['email'];
        $loan->lender->phone = $input['phone'];
        $loan->lender->is_member = isset($input['is_member']) && $input['is_member']  == 1 ? 1 : 0;
        $loan->lender->save();

        $loan->total_amount = $input['amount'];
        $loan->save();

        return redirect('loans/'.$id.'/edit');
    }

    public function getMembers(Request $request){
        $members = Member::all()->toArray();
        // if( $request->term ) {
        //     $members = Member::where('first_name', 'LIKE', '%'.$request->term.'%')->get();
        // }
    	$result['results'] = $members;
    	$data_map = function ($members){
    		return array(
                'term' => '',
    			'id' => $members['id'],
    			'text' => $members['first_name'] . ' ' . $members['last_name']);
    	};

    	$result['results'] = array_map($data_map, $members);
    	
    	return Response::json($result);
    }
    public function applyLoan(){
        $data['payment_dates'] = PaymentDate::pluck('month_day');
        return view('pages.apply_loan', $data);
    }

    public function getMemberName(){
    	$members = Member::all()->toArray();
    	$result['results'] = $members;
    	$data_map = function ($members){
    		return array(
    			'id' => $members['id'],
    			'text' => $members['first_name'] . ' ' . $members['last_name']);
    	};

    	$result['results'] = array_map($data_map, $members);

    	
    	return Response::json($result);
    }

    public function add(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'codename' => 'required|unique:lenders',
            'guaranter' => 'required',
            // 'phone' => 'required',
            'amount' => 'required',
            'terms' => 'required',
        ]);


        $lender = new Lender();
        $lender->first_name = $request->first_name;
        $lender->last_name = $request->last_name;
        $lender->is_member = 1;
        $lender->codename = $request->codename;
        $lender->phone = $request->phone;
        $lender->save();

        $loan = new Loan();
        $loan->lender_id = $lender->id;
        $loan->member_id = $request->guaranter;
        $loan->total_amount = $request->amount;
        $loan->months_to_pay = $request->terms;
        $loan->save();
        
        $monthly_due = compute_monthly_due($request->amount, $request->terms);

        $data = array(
            'name' => $request->first_name . ' ' . $request->last_name,
            'codename' => $request->codename,
            'amount' => $request->amount,
            'terms' => $request->terms,
            'monthly_due' => $monthly_due,
        );

        Mail::send('emails.application', $data, function ($message) {
            
            $message->from('codevsf@gmail.com', 'Codev Sinking Fund');
    
            $message->to('cieliton@codev.com')->subject('Loan Application');
    
        });
        

        
        return redirect('/apply-loan');

    }

    

    public function updatePaymentRow(){
        
        $input = Input::all();

        $month_day = explode('_', $input['name'])[1];
        $amount = $input['value'];
        $loan_id = $input['pk'];


        // $condition =['loan_id' => $loan_id,'payment_date_id'=> $payment_date_id];
        // $data = $condition;
        // $data['amount'] = $amount;
        // print_r($condition);
        // LoanPaymentDate::updateOrCreate($condition, $data );

        $data['paymentable_id'] = $loan_id;
        $data['paymentable_type'] = 'App\Loan';
        $data['month_day'] = $month_day;
        
        $condition = $data; // don't include amount in condition
        
        $data['amount'] = $amount;

        Payment::updateOrCreate($condition, $data );


        

        
        // $lpd->loan_id = $loan_id;
        // $lpd->payment_date_id= $payment_date_id;
        // $lpd->amount=$amount;
        // $lpd->save();


    }
}
