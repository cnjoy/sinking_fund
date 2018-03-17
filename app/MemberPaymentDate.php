<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberPaymentDate extends Model
{
    protected $fillable = ['member_id', 'payment_date_id', 'amount'];

    public function members(){
    	return $this->belongsToMany('App\Member', 'member_payment_dates')
    			->withPivot('member_id', 'payment_date_id')
    			->withTimestamps();
	}
	
	/**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return static
     */
    public static function updateOrCreate(array $attributes, array $values = array())
    {
        $instance = static::firstOrNew($attributes);

        $instance->fill($values)->save();

        return $instance;
    }
}
