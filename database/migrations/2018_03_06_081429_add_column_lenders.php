<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnLenders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lenders', function (Blueprint $table) {
            $table->boolean('is_approved')->default(0)->after('is_member');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lenders', function (Blueprint $table) {
            $table->dropColumn('is_approved');
        });
    }
}
