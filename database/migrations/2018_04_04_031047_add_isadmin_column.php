<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsadminColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('admin')->default(0);
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members');
        });
        Schema::enableForeignKeyConstraints();
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('admin');
            $table->dropForeign(['member_id']);
        });
        Schema::disableForeignKeyConstraints();
    }
}
