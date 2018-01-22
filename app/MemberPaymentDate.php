<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberPaymentDate extends Model
{
    public function members(){
    	return $this->belongsToMany('App\Member', 'member_payment_dates')
    			->withPivot('member_id', 'payment_date_id')
    			->withTimestamps();
    }
}
