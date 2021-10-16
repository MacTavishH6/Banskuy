<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsdonationtypedetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msdonationtypedetail', function (Blueprint $table) {
            $table->increments('DonationTypeDetailID');
            $table->integer('DonationTypeID')->unsigned();
            $table->string('DonationTypeDetail', 20);
            $table->timestamps();

             $table->foreign('DonationTypeID')->references('DonationTypeID')->on('msdonationtype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msdonationtypedetail');
    }
}
