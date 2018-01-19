<?php

use Illuminate\Database\Seeder;

class PaymentDateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = ['January','February','February','March','March','April','April','May','May','June','June','July','July','August','August','September','September','October','October','November','November','December'];
        $days = [16,1,16,1,16,1,16,1,16,1,16,1,16,1,16,1,16,1,16,1,16,1];
        foreach($months as $key => $month){
        	DB::table('payment_dates')->insert([
	            'str_month' => $month,
	            'int_day' => $days[$key],
	        ]);
        }
    }
}
