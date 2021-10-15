<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMscityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mscity', function (Blueprint $table) {
            $table->increments('CityID');
            $table->integer('ProvinceID');
            $table->string('CityName', 36);
            $table->timestamps();

            // $table->foreign('ProvinceID')->references('ProvinceID')->on('msprovince');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mscity');
    }
}
