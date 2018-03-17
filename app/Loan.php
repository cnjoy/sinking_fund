<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'lender_id',
        'member_id',
        'total_amount',
        'terms_to_pay',
        'is_paid',
        'amount_per_term',
        'start_at'
        ];
    public function lender()
    {
         return $this->belongsTo('App\Lender');
    }

    public function payment_dates()
    {
         return $this->belongsToMany('App\PaymentDate', 'loan_payment_dates', 'loan_id', 'payment_date_id')
                    ->withPivot('amount')
                    ->withTimestamps();
    }


}
