<?php

namespace App\Http\Controllers;
use App\Member;
use App\Lender;
use App\Loan;
use App\LoanPaymentDate;
use App\PaymentDate;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Input;
class LoansController extends Controller
{
    public function getMembers(){
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
            'phone' => 'required',
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
        return redirect('/apply-loan');

    }

    public function updatePaymentRow(){
        
        $input = Input::all();

        $payment_date_id = explode('_', $input['name'])[1];
        $amount = $input['value'];
        $loan_id = $input['pk'];

        // $results = LoanPaymentDate::where([
        //             'loan_id', '=', $loan_id,
        //             'payment_date_id', '=', $payment_date_id
        //             ])->get();
        

        $condition =['loan_id' => $loan_id,'payment_date_id'=> $payment_date_id];
        $data = $condition;
        $data['amount'] = $amount;
        print_r($condition);

        LoanPaymentDate::updateOrCreate($condition, $data );

        
        // $lpd->loan_id = $loan_id;
        // $lpd->payment_date_id= $payment_date_id;
        // $lpd->amount=$amount;
        // $lpd->save();


    }
}
