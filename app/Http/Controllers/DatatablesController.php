<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\PaymentDate;
use App\Loan;
use App\Payment;
use App\User;
use App\MemberPaymentDate;
use Yajra\Datatables\Datatables;
use App\Http\Controllers;
use App\ViewMember;
use DB;
use Response;
use Illuminate\Support\Facades\Auth;
class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('pages.members');
    }

   
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function membersData()
    {
        
        $done = 0; $raw_columns = [];
      
        $members = DB::table('members_view')
                    ->selectRaw("*, monthly_due as amount, CONCAT('row_', id) as DT_RowId, id as member_id,
                                CONCAT(first_name,' ', last_name, ' <b class=\"font11\">(',shares, ')</b>') as fullname
                                ")
                    ->get()
                    ->toArray();

        $payment_date = PaymentDate::all()->pluck('month_day')->toArray();
        foreach($members as $x => $member )
        {
            foreach($payment_date as $pd)
            {
                if(isset($member->{$pd} ) && $member->{$pd} > 0 ) {
                    if( Auth::user()->isAdmin() ) {
                        $members[$x]->$pd = '<input type="checkbox" value="' . $pd. '" checked  />';
                    }else {
                        $members[$x]->$pd = '<i class="fa fa-check text-success text-center"></i>';
                    }
                    
                }else{
                    if( Auth::user()->isAdmin() ) {
                        $members[$x]->$pd = '<input type="checkbox" value="' . $pd . '"   />';
                    }else {
                        $members[$x]->$pd = '';
                    }
                }
                //  $members[$x]->total_paid =  $member->total_paid > 0 ? money_format((float)$member->total_paid,2): 0;
            }
        }



        if( !empty($members) ) {
            $raw_columns = array_keys(object_to_array(current($members)));
        }
        

        return Datatables::of($members)->rawColumns($raw_columns)->make(true);
    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lendersData()
    {
        $loans = Loan::leftJoin('lenders', 'lenders.id', '=', 'loans.lender_id')
                        ->leftJoin('members', 'members.id', '=', 'loans.member_id')
                        ->leftJoin('loan_payment_dates', 'loans.id', '=', 'loan_payment_dates.loan_id')
                        ->leftJoin('payment_dates', 'payment_dates.id', '=', 'loan_payment_dates.payment_date_id')
                        ->selectRaw("loans.id, 
                                    is_approved,
                                    CONCAT(lenders.first_name, ' ', lenders.last_name, ' <span class=\"font11\">(',months_to_pay, ')</span>') AS fullname,
                                    CONCAT(members.first_name, ' ', members.last_name) AS member,
                                    loans.total_amount,
                                    SUM(loan_payment_dates.amount) AS amount_paid, 
                                    (total_amount - SUM(loan_payment_dates.amount)) AS remaining,
                                    MAX(CASE WHEN month_day='January 16' THEN loan_payment_dates.amount END) AS 'January 16',
                                    MAX(CASE WHEN month_day='February 1' THEN loan_payment_dates.amount END) AS 'February 1',
                                    MAX(CASE WHEN month_day='February 16' THEN loan_payment_dates.amount END) AS 'February 16',
                                    MAX(CASE WHEN month_day='March 1' THEN loan_payment_dates.amount END) AS 'March 1',
                                    MAX(CASE WHEN month_day='March 16' THEN loan_payment_dates.amount END) AS 'March 16',
                                    MAX(CASE WHEN month_day='April 1' THEN loan_payment_dates.amount END) AS 'April 1',
                                    MAX(CASE WHEN month_day='April 16' THEN loan_payment_dates.amount END) AS 'April 16',
                                    MAX(CASE WHEN month_day='May 1' THEN loan_payment_dates.amount END) AS 'May 1',
                                    MAX(CASE WHEN month_day='May 16' THEN loan_payment_dates.amount END) AS 'May 16',
                                    MAX(CASE WHEN month_day='June 1' THEN loan_payment_dates.amount END) AS 'June 1',
                                    MAX(CASE WHEN month_day='June 16' THEN loan_payment_dates.amount END) AS 'June 16',
                                    MAX(CASE WHEN month_day='July 1' THEN loan_payment_dates.amount END) AS 'July 1',
                                    MAX(CASE WHEN month_day='July 16' THEN loan_payment_dates.amount END) AS 'July 16',
                                    MAX(CASE WHEN month_day='August 1' THEN loan_payment_dates.amount END) AS 'August 1',
                                    MAX(CASE WHEN month_day='August 16' THEN loan_payment_dates.amount END) AS 'August 16',
                                    MAX(CASE WHEN month_day='September 1' THEN loan_payment_dates.amount END) AS 'September 1',
                                    MAX(CASE WHEN month_day='September 16' THEN loan_payment_dates.amount END) AS 'September 16',
                                    MAX(CASE WHEN month_day='October 1' THEN loan_payment_dates.amount END) AS 'October 1',
                                    MAX(CASE WHEN month_day='October 16' THEN loan_payment_dates.amount END) AS 'October 16',
                                    MAX(CASE WHEN month_day='November 1' THEN loan_payment_dates.amount END) AS 'November 1',
                                    MAX(CASE WHEN month_day='November 16' THEN loan_payment_dates.amount END) AS 'November 16',
                                    MAX(CASE WHEN month_day='December 1' THEN loan_payment_dates.amount END) AS 'December 1'")
                        // ->where("is_approved", 1)
                        ->groupBy("loans.id")
                        ->get()->toArray();
        $raw_columns = [];
        if( !empty($loans) ) {
            $raw_columns = array_keys(current($loans));
        }
        

        return Datatables::of($loans)->rawColumns($raw_columns)->make(true);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loansData()
    {
        if( Auth::user()->isAdmin() ) {
            $lender = "CONCAT('<a href=\"loans/',loans.id,'/edit\">',lenders.first_name, ' ' , lenders.last_name, '(', IF(LENGTH(lenders.codename)> 0, lenders.codename, 'anonymous'), ')','</a>') as lender";
        }else {
            $lender = "IF(LENGTH(lenders.codename)> 0, lenders.codename, 'anonymous') as lender";
        }
        $loans = Loan::leftJoin('lenders', 'lenders.id', '=', 'loans.lender_id')
                        ->leftJoin('members', 'members.id', '=', 'loans.member_id')
                        ->leftJoin('payments', function($join){
                            $join->on('loans.id', '=', 'payments.paymentable_id');
                            $join->on('payments.paymentable_type', 'like', DB::raw("'%Loan'"));
                        })
                        ->leftJoin('payment_dates', 'payment_dates.id', '=', 'payments.payment_date_id')
                        ->selectRaw("
                                    CONCAT('row_', loans.id) as DT_RowId,
                                    " . $lender  . ",
                                    lenders.codename,
                                    CONCAT(members.first_name, ' ' , members.last_name) AS member,
                                    FORMAT(total_amount,2, 'de_DE') as total_amount, 
                                    months_to_pay, 
                                    loans.created_at, 
                                    loans.updated_at, 
                                    amount_per_term,
                                    SUM(IF(payments.month_day > 0, payments.amount, 0)) AS paid,
                                    total_amount - SUM(IF(payments.month_day > 0, payments.amount, 0)) AS balance, 
                                    '' as end_date")
                        // ->where("is_approved", 1)
                        ->groupBy("loans.id")
                        ->get()->toArray();
        $raw_columns = [];
        if( !empty($loans) ) {
            $raw_columns = array_keys(current($loans));
        }
        

        return Datatables::of($loans)->rawColumns($raw_columns)->make(true);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSingleLoan($loan_id)
    {
        $loans = Loan::leftJoin('lenders', 'lenders.id', '=', 'loans.lender_id')
                        ->leftJoin('payment_dates', function($join){
                            $join->on('payment_dates.order_id', '>=', 'loans.starts_at');
                            $join->on('payment_dates.order_id', '<', \DB::raw('loans.starts_at + months_to_pay* 2'));
                        })
                        ->leftJoin('payments', function($join){
                            $join->on('loans.id', '=', 'payments.paymentable_id');
                            $join->on('payments.paymentable_type', 'like', DB::raw("'%Loan'"));
                            $join->on('payment_dates.month_day', '=', 'payments.month_day');
                            
                        })
                        ->selectRaw("loans.id,                                
                                    CONCAT(lenders.first_name, ' ' , lenders.last_name, '(', codename, ')') AS lender,
                                    order_id,
                                    starts_at,
                                    months_to_pay, 
                                    payment_dates.id AS pdid,
                                    payment_dates.month_day, 
                                    ifnull(amount,0) as amount
                                
                                    ")
                        ->where('loans.id', '=', $loan_id)
                        ->orderBy('loans.id', 'order_id')
                        ->get()->toArray();
        $raw_columns = [];
        if( !empty($loans) ) {
            $raw_columns = array_keys(current($loans));
        }
        // return Response::json($loans);
        return Datatables::of($loans)->rawColumns($raw_columns)->make(true);
        // return Response::json(Datatables::of($loans)->rawColumns($raw_columns)->make(true));
    }

    /**
     * Members contribution displayed in profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfileContribution()
    {
        $payments = Auth::user()->member->payments;
       
        return Datatables::of($payments)->make(true);
    }

    /**
     * Lenders payment displayed in members (edit)profile 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLenderPayment($id)
    {
        $payments = Loan::find($id)->payments;
       
        return Datatables::of($payments)->make(true);
    }
    
  


}
