<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lender extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'address',
        'is_member',
    ];
    /**
     * Get the payment dates record associated with the members.
     */
    public function payment_dates()
    {
         return $this->belongsToMany('App\PaymentDate', 'member_payment_dates', 'member_id', 'payment_date_id')
                    ->withPivot('amount')
                    ->withTimestamps();
    }

    public function loans()
    {
         return $this->hasMany('App\Loan');
    }

}
