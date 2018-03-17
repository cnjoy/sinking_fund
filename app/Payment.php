<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Payment extends Model
{
     /**
     * Get all of the owning commentable models.
     */
    public function paymentable()
    {
        return $this->morphTo();
    }

    
     /**
     * Get the phone record associated with the members.
     */
    // public function member()
    // {
    //     return $this->morphMany('App\Member', 'commentable');

    // }
    public function payment_date()
    {
        return $this->belongsTo('App\PaymentDate');

    }

    /**
     * Get total Payments
     * 
     * @param   string  $type   ['Member', 'Loan']
     * 
     * @return  float   sum of payments.amounts  
     */

    public function getTotalPayments($type = 0)
    {
        $classes = [null, 'Member', 'Loan'];
        $tables = [null, 'members', 'loans'];

        if( in_array($type, [1,2]) ) {

            $table = $tables[$type];
            $class = $classes[$type];

            $result = Payment::join($table, 'payments.paymentable_id', '=', $table .'.id')
                        ->selectRaw('sum(payments.amount) as total_payment')
                        ->whereRaw("payments.paymentable_type like '%" . $class. "'")
                        ->get()
                        ->toArray()[0]['total_payment'];
        }else {
            $result = Payment::leftJoin('members', function($join){
                            $join->on('payments.paymentable_id', '=', 'members.id');
                            $join->on('payments.paymentable_type', 'like', DB::raw("'%Member'"));
                        })
                        ->leftJoin('loans', function($join){
                            $join->on('payments.paymentable_id', '=', 'loans.id');
                            $join->on('payments.paymentable_type', 'like', DB::raw("'%Loan'"));
                        })            
                        ->selectRaw('sum(payments.amount) as total_payment')
                        ->whereRaw('members.id is not null or loans.id is not null')
                        ->get()
                        ->toArray()[0]['total_payment'];
        }
        return $result;
         
    }
}
