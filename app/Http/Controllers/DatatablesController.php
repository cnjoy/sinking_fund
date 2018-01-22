<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\PaymentDate;
use App\Loan;
use App\MemberPaymentDate;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\DB;

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
        $dates = PaymentDate::select(\DB::raw("concat(str_month,' ' , int_day) as date, id"))
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
                $final[$member_id][$month] = '';
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
    public function lendersData()
    {
        
        
        $loans = Loan::leftJoin('lenders', 'lenders.id', '=', 'loans.lender_id')
                        ->leftJoin('members', 'members.id', '=', 'loans.member_id')
                        ->leftJoin('loan_payment_dates', 'loans.id', '=', 'loan_payment_dates.loan_id')
                        ->leftJoin('payment_dates', 'payment_dates.id', '=', 'loan_payment_dates.payment_date_id')
                        ->selectRaw("loans.id, 
                                    CONCAT(lenders.first_name, ' ', lenders.last_name, ' <span class=\"font11\">(',terms_to_pay, ')</span>') AS fullname,
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
                        ->groupBy("loans.id")
                        ->get()->toArray();

        $raw_columns = array_keys(current($loans));

        return Datatables::of($loans)->rawColumns($raw_columns)->make(true);
    }


    public function memberstest(){
        echo '<pre>';
        $dates = PaymentDate::select(\DB::raw("concat(str_month,' ' , int_day) as date, id"))
                            ->get()->toArray();
        $dates = array_column($dates, 'date', 'id');
        print_r($dates);

        $month_index= array_flip($dates);
        $month_index = array_fill_keys(array_keys($month_index), '');
        print_r($month_index);
        
        $members = Member::leftJoin('member_payment_dates', 'members.id', '=', 'member_payment_dates.member_id')
                        ->leftJoin('payment_dates', 'payment_dates.id', '=', 'member_payment_dates.payment_date_id')
                        ->selectRaw("members.id as member_id, 
                                    first_name, last_name, 
                                    CONCAT(first_name,' ', last_name, '(',shares, ')') as fullname,
                                    members.amount, str_month, 
                                    int_day,
                                    CONCAT(str_month, ' ' , int_day) as term,
                                    payment_date_id")
                        ->get()->toArray();
                         print_r($members);

        $final = [];
        $final = []; $done = 0; $raw_columns = [];
        foreach($members as $member){
            $member_id = $member['member_id'];
            if( !isset($final[$member_id]) )
            {
                $final[$member_id] = $month_index;
                $final[$member_id]['fullname'] = $member['fullname'];
                $final[$member_id]['amount'] = $member['amount'];
    
            }
            
            $month = $member['term'];
            $payment_date_id = isset($month_index[$month]) ? $month_index[$month] : '0';
         
            if( isset($month_index[$month]) ){
                // $month = $dates[$payment_date_id];
                $final[$member_id][$month] = $member['amount'] ;

                $final[$member_id][$month] = '<i class="fa fa-check"></i>';
            }else{
                 // $month = $member['term'];
                 $final[$member_id][$month] = '';
            }
            
            // get the column for once
            if( !$done )
            {
                $raw_columns = array_keys($member);
                $raw_columns = array_merge($dates, $raw_columns);
            }

        }
        print_r($raw_columns);
        // return Datatables::of($final)->make(true);
    }



}
