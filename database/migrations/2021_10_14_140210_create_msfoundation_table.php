<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsfoundationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msfoundation', function (Blueprint $table) {
            $table->increments('FoundationID');
            $table->string('Email',50);
            $table->string('Password',20);
            $table->string('FoundationName',50);
            $table->string('FoundationPhone',13);
            $table->string('Username',36);
            $table->date('RegisterDate');
            $table->string('Visi',100);
            $table->string('Misi',255);
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
        Schema::dropIfExists('msfoundation');
    }
}
