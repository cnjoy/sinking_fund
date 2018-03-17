<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Member;
use App\Payment;
use App\Loan;
use App\MemberPaymentDate;
use App\PaymentDate;
use Response;


class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('pages/members');
    }

    public function dashboard()
    {
        $member_id = 1;
        $collection_per_payday = Member::all()->sum('amount');
        $loan_count = Loan::count();

        $total_shares = Member::all()->sum('shares');
        $deposit = Member::find(1)->payments->sum('amount');
       
        // get fund value
        $total_loan = Loan::all()->sum('total_amount');
        $member = Member::find($member_id);
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

        $data = [
                    'deposit' =>  format2($deposit),
                    'available_cash' =>  format2($available_cash),
                    'total_shares' =>  $total_shares,
                    'collection_per_payday' =>  format2($collection_per_payday),
                    'loan_count' =>  $loan_count,
                    'fund_value' => format2($fund_value),
                    'target_savings' => format2($target_savings),
                    'expected_amount' => format2($expected_amount),
                    'total_collection' => ['amount'=> format2($total_collection), 'percent' => '10'],
                    'total_loan' => ['amount'=> format2($total_loan), 'percent' => '10'],
                    'total_payment' => ['amount'=> format2($total_payment), 'percent' => '10'],
                    

                ];
        
        // $data['collection_per_payday'] = format2($collection_per_payday);
        pr($data);
        return view('pages/dashboard')->with($data);
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
        //
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
        //
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
        $data['member_id'] = $member_id;
        $data['amount'] = $input['amount'];
        $data['payment_date_id'] = $input['payment_date_id'];
        
        $condition = $data;
        
        MemberPaymentDate::updateOrCreate($condition, $data );


    }
}
