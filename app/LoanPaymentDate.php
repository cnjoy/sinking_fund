<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanPaymentDate extends Model
{
	protected $fillable = ['loan_id', 'payment_date_id', 'amount'];

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
