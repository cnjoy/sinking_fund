<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Member;
use App\Payment;
use App\Loan;
use App\MemberPaymentDate;
use App\PaymentDate;
use App\ViewMember;
use Response;
use Illuminate\Support\Facades\Auth;

class MembersController extends MyBaseController
{
 
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $members = ViewMember::all();
       
        return view('pages/members');
    }

    public function profile()
    {

        // return view('pages/profile',  'App\Http\ViewComposers\MyViewComposer');
        return view('pages/profile');
    }

    public function dashboard()
    {
        
        // $member = $this->member;
        $member = Auth::user()->member;
        $member_id = $member->id;

        $collection_per_payday = Member::all()->sum('amount');
        
        $loan_count = Loan::count();

        $total_shares = Member::all()->sum('shares');
        $deposit =   $member->payments->sum('amount');
       
        // get fund value
        $total_loan = Loan::all()->sum('total_amount');
        $interest = ($total_loan/$total_shares) * $member->shares;
        $fund_value = $interest + $deposit;
       
        
        // get target savings and expected amount
        $date_count = PaymentDate::count();
        $target_savings = $member->amount * $date_count;
        $expected_amount = $target_savings + $interest;

        $p = new Payment();
        $total_collection = $p->getTotalPayments(1);
        
        $total_payment = $p->getTotalPayments(2);
        
        // getavailable cash
        $total_payments = $p->getTotalPayments();
        $available_cash = $total_payments-$total_loan;
        
        // get percentage
        
        $collection_per_payday = $collection_per_payday > 0 ? $collection_per_payday : 1;
        $total_payments = $total_payments > 0 ? $total_payments : 1;
        $total_loan = $total_loan > 0 ? $total_loan : 1;

        $tc_percentage = round( ($total_collection/$total_loan) * 100 );
        $tl_percentage = round( ($total_loan/$total_payments) * 100);
        $tp_percentage = round( ($total_payment/$total_loan) * 100);



        $data = [
                    'deposit' =>  format2($deposit),
                    'available_cash' =>  format2($available_cash),
                    'total_shares' =>  $total_shares,
                    'collection_per_payday' =>  format2($collection_per_payday),
                    'loan_count' =>  $loan_count,
                    'fund_value' => format2($fund_value),
                    'target_savings' => format2($target_savings),
                    'expected_amount' => format2($expected_amount),
                    'total_collection' => ['amount'=> format2($total_collection), 'percent' => $tc_percentage],
                    'total_loan' => ['amount'=> format2($total_loan), 'percent' => $tl_percentage],
                    'total_payment' => ['amount'=> format2($total_payment), 'percent' => $tp_percentage],
                    

                ];
        
        // $data['collection_per_payday'] = format2($collection_per_payday);
        // pr($data);
        return view('pages/dashboard')->with($data);
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
        $input = Input::all();
        $member = Auth::user()->member;
        $member->first_name = $input['first_name'];
        $member->last_name = $input['last_name'];
        $member->codename = $input['codename'];
        $member->email = $input['email'];
        $member->phone = $input['phone'];
        $member->save();
        return redirect('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateMemberPayment() 
    {
        $input = Input::all();
        $member_id = 0;
        if( !empty($input['member_id']) ) {
            $exp = explode('_', $input['member_id']);
            $member_id = sizeof($exp) > 1 ? $exp[1] : 0;
        }
       
        $data['paymentable_id'] = $member_id;
        $data['paymentable_type'] = 'App\Member';
        $data['amount'] = $input['amount'];
        // $data['payment_date_id'] = $input['payment_date_id'];
        $data['month_day'] = $input['month_day'];
        
        $condition = $data;
        if( $input['remove'] ) {
            unset($condition['amount']);
            Payment::whereArray($condition )->delete();
            
        }else {
            Payment::updateOrCreate($condition, $data );
        }
       


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return Response::json($member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        pr('test');
    }
}
