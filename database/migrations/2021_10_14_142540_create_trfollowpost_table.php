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
            $table->integer("UserID");
            $table->integer("DonationTypeID");

            $table->foreign('UserID')->references('UserID')->on('MsUser');

            $table->timestamps();
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
