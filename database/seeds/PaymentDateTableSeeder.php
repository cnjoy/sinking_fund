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
        $month_day = ['01/16','02/01','02/16','03/01','03/16','04/01','04/16','05/01','05/16','06/01','06/16','07/01','07/16','08/01','08/16','09/01','09/16','10/01','10/16','11/01','11/16','12/01'];

        foreach($months as $key => $month){
        	DB::table('payment_dates')->insert([
                'order_id' => $key+1,
	            'str_month' => $month,
                'int_day' => $days[$key],
                'month_day' => $month_day[$key]
	        ]);
        }
    }
}
