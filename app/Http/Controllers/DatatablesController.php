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
    public function membersData_backup()
    {
        $dates = PaymentDate::select(DB::raw("concat(str_month,' ' , int_day) as date, id"))
                            ->get()->toArray();
        $dates = array_column($dates, 'date', 'id');
        $month_index= array_flip($dates);
        $month_index = array_fill_keys(array_keys($month_index), '');
        
        $members = Member::leftJoin('member_payment_dates', 'members.id', '=', 'member_payment_dates.member_id')
                        ->leftJoin('payment_dates', 'payment_dates.id', '=', 'member_payment_dates.payment_date_id')
                        ->selectRaw("members.id as member_id, 
                                    first_name, last_name, 
                                    CONCAT(first_name,' ', last_name, ' <b class=\"font11\">(',shares, ')</b>') as fullname,
                                    members.amount, str_month, 
                                    int_day,
                                    CONCAT(str_month, ' ' , int_day) as term,
                                    payment_date_id")
                        ->get()->toArray();

        $final = []; $done = 0; $raw_columns = [];

        foreach($members as $key=> $member){
            $member_id = $member['member_id'];
            

            if( !isset($final[$member_id]) )
            {
                $final[$member_id] = $month_index;
                $final[$member_id]['fullname'] = $member['fullname'];
               
    
            }

            
            $month = $member['term'];
            $payment_date_id = isset($month_index[$month]) ? $month_index[$month] : '0';
         
            if( isset($month_index[$month]) ){
                $final[$member_id]['amount'] = isset($final[$member_id]['amount']) ? $final[$member_id]['amount'] + $member['amount'] : $member['amount'] ;
                $final[$member_id][$month] = '<i class="fa fa-check text-success text-center"></i>';
                // $final[$member_id][$month] = $member['amount'];
                
            }else{
                $final[$member_id]['amount'] = isset($final[$member_id]['amount']) ? $final[$member_id]['amount'] + $member['amount'] : 0 ;
                $final[$member_id][$month] = '<input type=\"checkbox\" value="" />checked>';
            }
            
            // get the column for once
            // to be used to escape tags in datatable
            if( !$done )
            {
                $raw_columns = array_keys($member);
                $raw_columns = array_merge($dates, $raw_columns);
            }

        }
        return Datatables::of($final)->rawColumns($raw_columns)->make(true);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function membersData()
    {
        // <i class="fa fa-check text-success text-center"></i>
        
        $done = 0; $raw_columns = [];
        if( Auth::user()->isAdmin() ) 
        {
            $fields = "IF(MAX(CASE WHEN payments.month_day='01/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"01/16\" checked />',  '<input type=\"checkbox\" value=\"01/16\"  />') as '01/16',
            IF(MAX(CASE WHEN payments.month_day='02/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"02/01\" checked />',  '<input type=\"checkbox\" value=\"02/01\"  />') as '02/01',
            IF(MAX(CASE WHEN payments.month_day='02/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"02/16\" checked />',  '<input type=\"checkbox\" value=\"02/16\"  />') as '02/16',
            IF(MAX(CASE WHEN payments.month_day='03/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"03/01\" checked />',  '<input type=\"checkbox\" value=\"03/01\"  />') as '03/01',
            IF(MAX(CASE WHEN payments.month_day='03/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"03/16\" checked />',  '<input type=\"checkbox\" value=\"03/16\"  />') as '03/16',
            IF(MAX(CASE WHEN payments.month_day='04/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"04/01\" checked />',  '<input type=\"checkbox\" value=\"04/01\"  />') as '04/01',
            IF(MAX(CASE WHEN payments.month_day='04/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"04/16\" checked />',  '<input type=\"checkbox\" value=\"04/16\"  />') as '04/16',
            IF(MAX(CASE WHEN payments.month_day='05/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"05/01\" checked />',  '<input type=\"checkbox\" value=\"05/01\"  />') as '05/01',
            IF(MAX(CASE WHEN payments.month_day='05/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"05/16\" checked />',  '<input type=\"checkbox\" value=\"05/16\"  />') as '05/16',
            IF(MAX(CASE WHEN payments.month_day='06/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"06/01\" checked />',  '<input type=\"checkbox\" value=\"06/01\"  />') as '06/01',
            IF(MAX(CASE WHEN payments.month_day='06/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"06/16\" checked />',  '<input type=\"checkbox\" value=\"06/16\"  />') as '06/16',
            IF(MAX(CASE WHEN payments.month_day='07/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"07/01\" checked />',  '<input type=\"checkbox\" value=\"07/01\"  />') as '07/01',
            IF(MAX(CASE WHEN payments.month_day='07/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"07/16\" checked />',  '<input type=\"checkbox\" value=\"07/16\"  />') as '07/16',
            IF(MAX(CASE WHEN payments.month_day='08/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"08/01\" checked />',  '<input type=\"checkbox\" value=\"08/01\"  />') as '08/01',
            IF(MAX(CASE WHEN payments.month_day='08/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"08/16\" checked />',  '<input type=\"checkbox\" value=\"08/16\"  />') as '08/16',
            IF(MAX(CASE WHEN payments.month_day='09/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"09/01\" checked />',  '<input type=\"checkbox\" value=\"09/01\"  />') as '09/01',
            IF(MAX(CASE WHEN payments.month_day='09/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"09/16\" checked />',  '<input type=\"checkbox\" value=\"09/16\"  />') as '09/16',
            IF(MAX(CASE WHEN payments.month_day='10/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"10/01\" checked />',  '<input type=\"checkbox\" value=\"10/01\"  />') as '10/01',
            IF(MAX(CASE WHEN payments.month_day='10/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"10/16\" checked />',  '<input type=\"checkbox\" value=\"10/16\"  />') as '10/16',
            IF(MAX(CASE WHEN payments.month_day='11/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"11/01\" checked />',  '<input type=\"checkbox\" value=\"11/01\"  />') as '11/01',
            IF(MAX(CASE WHEN payments.month_day='11/16' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"11/16\" checked />',  '<input type=\"checkbox\" value=\"11/16\"  />') as '11/16',
            IF(MAX(CASE WHEN payments.month_day='12/01' THEN payments.amount END) > 0, '<input type=\"checkbox\" value=\"12/01\" checked />',  '<input type=\"checkbox\" value=\"12/01\"  />') as '12/01'
            
                    ";
                                    
                                    
        }else{
                                    
            $fields = "IF(MAX(CASE WHEN payments.month_day='01/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '01/16',
            IF(MAX(CASE WHEN payments.month_day='02/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '02/01',
            IF(MAX(CASE WHEN payments.month_day='02/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '02/16',
            IF(MAX(CASE WHEN payments.month_day='03/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '03/01',
            IF(MAX(CASE WHEN payments.month_day='03/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '03/16',
            IF(MAX(CASE WHEN payments.month_day='04/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '04/01',
            IF(MAX(CASE WHEN payments.month_day='04/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '04/16',
            IF(MAX(CASE WHEN payments.month_day='05/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '05/01',
            IF(MAX(CASE WHEN payments.month_day='05/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '05/16',
            IF(MAX(CASE WHEN payments.month_day='06/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '06/01',
            IF(MAX(CASE WHEN payments.month_day='06/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '06/16',
            IF(MAX(CASE WHEN payments.month_day='07/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '07/01',
            IF(MAX(CASE WHEN payments.month_day='07/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '07/16',
            IF(MAX(CASE WHEN payments.month_day='08/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '08/01',
            IF(MAX(CASE WHEN payments.month_day='08/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '08/16',
            IF(MAX(CASE WHEN payments.month_day='09/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '09/01',
            IF(MAX(CASE WHEN payments.month_day='09/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '09/16',
            IF(MAX(CASE WHEN payments.month_day='10/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '10/01',
            IF(MAX(CASE WHEN payments.month_day='10/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '10/16',
            IF(MAX(CASE WHEN payments.month_day='11/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '11/01',
            IF(MAX(CASE WHEN payments.month_day='11/16' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '11/16',
            IF(MAX(CASE WHEN payments.month_day='12/01' THEN payments.amount END) > 0, '<i class=\"fa fa-check text-success text-center\"></i>',  '') as '12/01'
            
            
                        ";

        }

         $members = Member::leftJoin('payments', function($join){
            $join->on('members.id', '=', 'payments.paymentable_id');
            $join->on('payments.paymentable_type', 'like', DB::raw("'%Member'"));
         })
                        ->leftJoin('payment_dates', 'payment_dates.id', '=', 'payments.payment_date_id')
                        ->selectRaw("
                                    CONCAT('row_', members.id) as DT_RowId,
                                    members.id as member_id, 
                                    first_name, last_name, 
                                    CONCAT(first_name,' ', last_name, ' <b class=\"font11\">(',shares, ')</b>') as fullname,
                                    members.amount, str_month, 
                                    int_day,
                                    CONCAT(str_month, ' ' , int_day) as term,
                                    payment_date_id,
                                    " . $fields . "


                                    ")
                            ->groupBy("members.id")
                            ->get()->toArray();
        $raw_columns = [];
        if( !empty($members) ) {
            $raw_columns = array_keys(current($members));
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
            $lender = "CONCAT('<a href=\"loans/edit/',loans.id,'\">',lenders.first_name, ' ' , lenders.last_name, '(', IF(LENGTH(lenders.codename)> 0, lenders.codename, 'anonymous'), ')','</a>') as lender";
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
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfileContribution()
    {
        $payments = Auth::user()->member->payments;
       
        return Datatables::of($payments)->make(true);
    }

    
  


}
