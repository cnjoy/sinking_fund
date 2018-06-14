<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePaymentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('loans_payment_dates');
        Schema::dropIfExists('member_payment_dates');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('member_payment_dates', function (Blueprint $table) {
            $table->integer('member_id')->unsigned();
            $table->integer('payment_date_id')->unsigned();
            $table->decimal('amount', 10,2)->default(0.00);
            $table->timestamps();
        });
        Schema::create('loan_payment_dates', function (Blueprint $table) {
            $table->integer('loan_id')->unsigned();
            $table->integer('payment_date_id')->unsigned();
            $table->decimal('amount', 10,2)->default(0.00);
            $table->timestamps();
        });
    }
}
