<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsuserlevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msuserlevel', function (Blueprint $table) {
            
            $table->increments("LevelID");
            $table->integer("UserID")->unsigned();
            $table->integer("LevelGradeID")->unsigned();
            $table->date("ReceivedDate");

           
            
            $table->timestamps();
            $table->foreign('UserID')->references('UserID')->on('msuser');
            $table->foreign('LevelGradeID')->references('LevelGradeID')->on('mslevelgrade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msuserlevel');
    }
}
