<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsreportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msreport', function (Blueprint $table) {
            $table->increments('ReportID');
            $table->integer('IDTarget');
            $table->integer('IDSource');
            $table->integer('ReportCategoryID');
            $table->string('Reason',255);
            $table->timestamps();

            //$table->foreign('ReportCategoryID')->references('ReportCategoryID')->on('ltreportcategory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msreport');
    }
}
