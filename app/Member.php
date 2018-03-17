<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    public function payments()
    {
        return $this->morphMany('App\Payment', 'paymentable');
    }
    /**
     * Get the payment dates record associated with the members.
     */
    public function payment_dates()
    {
         return $this->belongsToMany('App\PaymentDate', 'member_payment_dates', 'member_id', 'payment_date_id')
                    ->withPivot('amount')
                    ->withTimestamps();
    }

    public function query_payments(Request $request) 
    {

        $storeId = $request->get('storeId');

        $customers = Customer::whereHas('stores', function($query) use($storeId) {
            $query->where('stores.id', $storeId);
        })->get();

    }


    /**
     * Get the contributions record associated with the members.
     */
    public function contributions()
    {
        // return $this->hasMany('App\Contribution');
        return $this->belongsToMany('App\Contribution')
                ->as('contribution');
    }

    public function getContributions()
    {

        // $payments = DB::table('members')

        // 			->leftJoin('payments', function($join){
        // 				$join->on('members.id', '=', 'payments.member_id'
        // 					->where('person_type', '=', "'member'"))
        // 			})
        // 		->get();
        $results = DB::select( DB::raw("SELECT p.id AS payment_id, m.id AS member_id,CONCAT(first_name, ' ', last_name, '(', shares, ')') AS fullname,
										m.amount, CONCAT(str_month, ' ', int_day) AS payment_date
										FROM members m
										LEFT JOIN payments p ON p.person_id = m.id AND person_type = 'member'
										LEFT JOIN payment_dates pd ON pd.id = p.payment_date_id 
										ORDER BY m.id") );
        return $results;
    }
       

}
