<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsreportpostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msreportpost', function (Blueprint $table) {
            $table->increments('ReportID');
            $table->integer('PostID');
            $table->integer('IDSource');
            $table->integer('ReportCategoryID')->unsigned();
            $table->string('Reason',255);
            $table->timestamps();

            $table->foreign('ReportCategoryID')->references('ReportCategoryID')->on('ltreportcategory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msreportpost');
    }
}
