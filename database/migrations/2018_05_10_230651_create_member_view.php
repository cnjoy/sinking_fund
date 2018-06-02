<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW members_view AS
                        SELECT m.id, first_name, last_name, shares, (shares*500) AS monthly_due,payments.month_day
                        , SUM(payments.amount) AS total_paid,
                        IF(MAX(CASE WHEN payments.month_day='01/16' THEN payments.amount END) > 0, payments.amount,  0) AS '01/16',
                        IF(MAX(CASE WHEN payments.month_day='02/01' THEN payments.amount END) > 0, payments.amount,  0) AS '02/01',
                        IF(MAX(CASE WHEN payments.month_day='02/16' THEN payments.amount END) > 0, payments.amount,  0) AS '02/16',
                        IF(MAX(CASE WHEN payments.month_day='03/01' THEN payments.amount END) > 0, payments.amount,  0) AS '03/01',
                        IF(MAX(CASE WHEN payments.month_day='03/16' THEN payments.amount END) > 0, payments.amount,  0) AS '03/16',
                        IF(MAX(CASE WHEN payments.month_day='04/01' THEN payments.amount END) > 0, payments.amount,  0) AS '04/01',
                        IF(MAX(CASE WHEN payments.month_day='04/16' THEN payments.amount END) > 0, payments.amount,  0) AS '04/16',
                        IF(MAX(CASE WHEN payments.month_day='05/01' THEN payments.amount END) > 0, payments.amount,  0) AS '05/01',
                        IF(MAX(CASE WHEN payments.month_day='05/16' THEN payments.amount END) > 0, payments.amount,  0) AS '05/16',
                        IF(MAX(CASE WHEN payments.month_day='06/01' THEN payments.amount END) > 0, payments.amount,  0) AS '06/01',
                        IF(MAX(CASE WHEN payments.month_day='06/16' THEN payments.amount END) > 0, payments.amount,  0) AS '06/16',
                        IF(MAX(CASE WHEN payments.month_day='07/01' THEN payments.amount END) > 0, payments.amount,  0) AS '07/01',
                        IF(MAX(CASE WHEN payments.month_day='07/16' THEN payments.amount END) > 0, payments.amount,  0) AS '07/16',
                        IF(MAX(CASE WHEN payments.month_day='08/01' THEN payments.amount END) > 0, payments.amount,  0) AS '08/01',
                        IF(MAX(CASE WHEN payments.month_day='08/16' THEN payments.amount END) > 0, payments.amount,  0) AS '08/16',
                        IF(MAX(CASE WHEN payments.month_day='09/01' THEN payments.amount END) > 0, payments.amount,  0) AS '09/01',
                        IF(MAX(CASE WHEN payments.month_day='09/16' THEN payments.amount END) > 0, payments.amount,  0) AS '09/16',
                        IF(MAX(CASE WHEN payments.month_day='10/01' THEN payments.amount END) > 0, payments.amount,  0) AS '10/01',
                        IF(MAX(CASE WHEN payments.month_day='10/16' THEN payments.amount END) > 0, payments.amount,  0) AS '10/16',
                        IF(MAX(CASE WHEN payments.month_day='11/01' THEN payments.amount END) > 0, payments.amount,  0) AS '11/01',
                        IF(MAX(CASE WHEN payments.month_day='11/16' THEN payments.amount END) > 0, payments.amount,  0) AS '11/16',
                        IF(MAX(CASE WHEN payments.month_day='12/01' THEN payments.amount END) > 0, payments.amount,  0) AS '12/01'
                        FROM members m
                        LEFT JOIN payments  ON payments.paymentable_id = m.id 
                        AND payments.paymentable_type LIKE '%Member%'
                        WHERE m.is_active = 1
                        GROUP BY m.id
                        
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW members_view");
    }
}
