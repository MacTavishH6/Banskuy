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
            
            $table->increment("LevelID");
            $table->integer("UserID");
            $table->integer("LevelGradeID");
            $table->date("ReceivedDate");

            $table->foreign('UserID')->references('UserID')->on('MsUser');
            $table->foreign('LevelGradeID')->references('LevelGradeID')->on('MsLevelGrade');
            
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
        Schema::dropIfExists('msuserlevel');
    }
}
