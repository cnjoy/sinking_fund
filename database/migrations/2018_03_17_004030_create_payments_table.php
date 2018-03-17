<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('paymentable_id');
            $table->string('paymentable_type');
            $table->decimal('amount',10,2)->default(0.00);
            $table->integer('payment_date_id')->unsigned();
            $table->foreign('payment_date_id')->references('id')->on('payment_dates')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function($table)
        {
            $table->dropForeign('payments_payment_date_id_foreign');
            $table->dropIndex('payments_payment_date_id_index');
        });
        Schema::dropIfExists('payments');
    }
}
