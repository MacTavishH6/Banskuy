<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMsreportAddColumnIsTaken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('msreport', function (Blueprint $table) {
            $table->tinyInteger('IsTakenAction');
        });
        Schema::table('msreportpost', function (Blueprint $table) {
            $table->tinyInteger('IsTakenAction');
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
