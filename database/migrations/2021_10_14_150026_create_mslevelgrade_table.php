<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMslevelgradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mslevelgrade', function (Blueprint $table) {
            
            $table->increment("LevelGradeID");
            $table->string("LevelName",36);
            $table->integer("LevelExp");
            $table->integer("LevelOrder");

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
        Schema::dropIfExists('mslevelgrade');
    }
}
