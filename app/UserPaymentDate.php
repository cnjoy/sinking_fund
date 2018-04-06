<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentDate extends Model
{
    
    protected $fillable = ['user_id', 'payment_date_id', 'amount'];
    
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_payment_dates')
                ->withPivot('user_id', 'payment_date_id')
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
