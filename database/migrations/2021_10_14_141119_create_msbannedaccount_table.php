<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsbannedaccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msbannedaccount', function (Blueprint $table) {
            $table->increments('BannedAccountID');
            $table->integer('ID');
            $table->integer('ReportID')->unsigned();
            $table->integer('Status');
            $table->date('Duration');
            $table->timestamps();

            $table->foreign('ReportID')->references('ReportID')->on('msreport');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msbannedaccount');
    }
}
