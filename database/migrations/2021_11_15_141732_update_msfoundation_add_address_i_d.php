<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMsfoundationAddAddressID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('msfoundation', function (Blueprint $table) {
            $table->integer('AddressID')->unsigned()->nullable();

            $table->foreign("AddressID")->references("AddressID")->on("MsAddress");
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
