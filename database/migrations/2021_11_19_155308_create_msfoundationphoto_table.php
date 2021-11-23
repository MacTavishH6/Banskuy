<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsfoundationphotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msfoundationphoto', function (Blueprint $table) {
            $table->increments('PhotoID');
            $table->integer('ID');
            $table->string('Path')->nullable();
            $table->string('Role', 1);
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
        Schema::dropIfExists('msfoundationphoto');
    }
}
