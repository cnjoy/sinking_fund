<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('amount', 10,2)->default(0.00)->after('remember_token');
            $table->integer('shares')->default(0)->after('remember_token');
            $table->enum('user_type', ['member', 'admin', 'superadmin'])->after('remember_token');
            $table->string('avatar', 200)->nullable()->after('remember_token');
            $table->tinyInteger('is_active')->default(1)->after('remember_token');
            $table->string('phone', 15)->nullable()->after('remember_token');
            $table->string('codename', 50)->nullable()->after('remember_token');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('codename');
            $table->dropColumn('user_type');
            $table->dropColumn('phone');
            $table->dropColumn('avatar');
            $table->dropColumn('is_active');
            $table->dropColumn('amount');
            $table->dropColumn('shares');
           
        });
    }
}
