<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    /**
     * Get the phone record associated with the members.
     */
    public function members()
    {
        return $this->belongsTo('App\Member','foreign_key');

    }
    
    public function payment_date()
    {
        return $this->belongsTo('App\PaymentDate');

    }
}
