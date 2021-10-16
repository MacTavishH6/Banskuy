<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrlevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trlevel', function (Blueprint $table) {
            
            $table->integer("LevelID")->unsigned();
            $table->integer("Exp");
            $table->date("ReceivedDate");

            $table->foreign('LevelID')->references('LevelID')->on('MsUserLevel');

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
        Schema::dropIfExists('trlevel');
    }
}
