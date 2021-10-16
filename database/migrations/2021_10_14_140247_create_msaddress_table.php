<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsaddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msaddress', function (Blueprint $table) {
            $table->increments('AddressID');
            $table->integer('ID');
            $table->integer('ProvinceID')->unsigned();
            $table->integer('CityID')->unsigned();
            $table->string('Address', 100);
            $table->timestamps();

             $table->foreign('ProvinceID')->references('ProvinceID')->on('msprovince');
             $table->foreign('CityID')->references('CityID')->on('mscity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msaddress');
    }
}
