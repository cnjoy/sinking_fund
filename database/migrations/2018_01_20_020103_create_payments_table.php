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
            $table->integer('lender_id')->unsigned();
            $table->foreign('lender_id')->references('id')->on('lenders');
            $table->integer('payment_date_id')->unsigned();
            $table->foreign('payment_date_id')->references('id')->on('payment_dates');
            $table->boolean('has_paid')->default(0);
            $table->decimal('amount',10,2)->nullable();
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
        Schema::dropIfExists('payments');
        // Schema::disableForeignKeyConstraints(); 
        // Schema::dropIfExists('payments');
        // Schema::enableForeignKeyContraints(); 

        // Schema::table('payments', function (Blueprint $table) {
        //     $table->dropForeign('payment_dates_payment_date_id_foreign');
        //     $table->dropColumn('[column]');
        // });
    }
}
