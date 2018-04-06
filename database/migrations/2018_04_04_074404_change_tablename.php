<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTablename extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->string('avatar')->nullable()->after('name');
        //     $table->boolean('active')->default(1)->after('avatar');
        //     $table->decimal('amount', 10,2)->default(0.00)->after('active');
        //     $table->integer('shares')->default(1)->after('amount');
        // });

        // Schema::create('user_payment_dates', function (Blueprint $table) {
        //     $table->integer('user_id')->unsigned();
        //     $table->integer('payment_date_id')->unsigned();
        //     $table->decimal('amount', 10,2)->default(0.00);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropColumn('avatar');
        //     $table->dropColumn('active');
        //     $table->dropColumn('amount');
        //     $table->dropColumn('shares');
        // });
        
        // Schema::dropIfExists('user_payment_dates');
    }
}
