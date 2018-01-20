<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDate extends Model
{
	public function posts()
    {
        return $this->hasManyThrough(
            'App\Member',
            'App\Payment',
            'payment_date_id', // Foreign key on users table...
            'member_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }

    /**
     * Get the phone record associated with the members.
     */
    public function member()
    {
        return $this->belongsTo('App\Member', 'payments');
        
    }

    /**
     * Get the contribution record associated with the members.
     */
    public function contributions()
    {
        return $this->hasMany('App\Contribution');
        
    }
}
