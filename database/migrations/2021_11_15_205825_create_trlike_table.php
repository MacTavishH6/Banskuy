<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrlikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trlike', function (Blueprint $table) {
            $table->increments('LikeID');
            $table->integer('PostID')->unsigned();
            $table->integer('ID');
            $table->integer('LikePost');
            $table->timestamps();

             $table->foreign('PostID')->references('PostID')->on('mspost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trlike');
    }
}
