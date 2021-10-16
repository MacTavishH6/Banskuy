<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrfollowpostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trfollowpost', function (Blueprint $table) {

            $table->increments('FollowPostID');
            $table->integer("UserID")->unsigned();
            $table->integer("DonationTypeID");

            

            $table->timestamps();
            $table->foreign('UserID')->references('UserID')->on('msuser');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trfollowpost');
    }
}
