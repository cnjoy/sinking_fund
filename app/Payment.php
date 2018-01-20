<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
     /**
     * Get the phone record associated with the members.
     */
    public function member()
    {
        return $this->morphMany('App\Member', 'commentable');

    }
    public function payment_date()
    {
        return $this->belongsTo('App\PaymentDate');

    }
}
