<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMsbannedaccountAddrole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('msbannedaccount', function (Blueprint $table) {
            $table->tinyInteger('RoleID');
        });
        Schema::table('msreport', function (Blueprint $table) {
            $table->tinyInteger('RoleIDTarget');
            $table->tinyInteger('RoleIDSource');
        });
        Schema::table('msreportpost', function (Blueprint $table) {
            $table->tinyInteger('RoleIDSource');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
