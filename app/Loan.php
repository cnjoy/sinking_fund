<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
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
