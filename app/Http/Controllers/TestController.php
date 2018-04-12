<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use DB;

class TestController extends Controller
{
    public function index()
    {
      

        $datatable_members = Loan::leftJoin('lenders', 'lenders.id', '=', 'loans.lender_id')
        ->leftJoin('members', 'members.id', '=', 'loans.member_id')
        ->leftJoin('payments', function($join){
            $join->on('loans.id', '=', 'payments.paymentable_id');
            $join->on('payments.paymentable_type', 'like', DB::raw("'%Loan'"));
        })
        ->leftJoin('payment_dates', 'payment_dates.id', '=', 'payments.payment_date_id')
        ->selectRaw("
                    CONCAT('row_', loans.id) as DT_RowId,
                    CONCAT(lenders.first_name, ' ' , lenders.last_name, '(', codename, ')') as lender,
                    codename,
                    CONCAT(members.first_name, ' ' , members.last_name) AS member,
                    FORMAT(total_amount,2, 'de_DE'), 
                    months_to_pay, 
                    loans.created_at, 
                    loans.updated_at, 
                    amount_per_term,
                    SUM(payments.amount) AS paid,
                    total_amount - SUM(payments.amount) AS balance, 
                    '' as end_date")
        // ->where("is_approved", 1)
        ->groupBy("loans.id")->toSql();
        $loan_id = 1;
        $datatable_singleloan = Loan::leftJoin('lenders', 'lenders.id', '=', 'loans.lender_id')
        ->leftJoin('payment_dates', function($join){
            $join->on('payment_dates.order_id', '>=', 'loans.starts_at');
            $join->on('payment_dates.order_id', '<', \DB::raw('loans.starts_at + months_to_pay* 2'));
        })
        ->leftJoin('payments', function($join){
            $join->on('loans.id', '=', 'payments.paymentable_id');
            $join->on('payments.paymentable_type', 'like', DB::raw("'%Loan'"));
            $join->on('payment_dates.id', '=', 'payments.payment_date_id');
            
        })
        ->selectRaw("loans.id,                                
                    CONCAT(lenders.first_name, ' ' , lenders.last_name, '(', codename, ')') AS lender,
                    order_id,
                    starts_at,
                    months_to_pay, 
                    payment_dates.id AS pdid,
                    payments.month_day, 
                    amount
                    ")
        ->where('loans.id', '=', $loan_id)
        ->orderBy('loans.id', 'order_id')
        ->toSql();
        // pr($datatable_singleloan);

        pr(Loan::leftJoin('lenders', 'lenders.id', '=', 'loans.lender_id')
        ->leftJoin('members', 'members.id', '=', 'loans.member_id')
        ->leftJoin('payments', function($join){
            $join->on('loans.id', '=', 'payments.paymentable_id');
            $join->on('payments.paymentable_type', 'like', DB::raw("'%Loan'"));
        })
        ->leftJoin('payment_dates', 'payment_dates.id', '=', 'payments.payment_date_id')
        ->selectRaw("
                    CONCAT('row_', loans.id) as DT_RowId,
                    CONCAT(lenders.first_name, ' ' , lenders.last_name, '(', codename, ')') as lender,
                    codename,
                    CONCAT(members.first_name, ' ' , members.last_name) AS member,
                    FORMAT(total_amount,2, 'de_DE') as total_amount, 
                    months_to_pay, 
                    loans.created_at, 
                    loans.updated_at, 
                    amount_per_term,
                    SUM(if(payments.month_day <> null, payments.amount, 0)) AS paid,
                    total_amount - SUM(payments.amount) AS balance, 
                    '' as end_date")
        // ->where("is_approved", 1)
        ->groupBy("loans.id")->toSql());
    }
}
