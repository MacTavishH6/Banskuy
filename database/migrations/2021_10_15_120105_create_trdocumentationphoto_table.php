<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrdocumentationphotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trdocumentationphoto', function (Blueprint $table) {
            
            $table->integer("DocumentationID")->unsigned();
            $table->string("PhotoName",50);

            $table->foreign('DocumentationID')->references('DocumentationID')->on('msdocumentation');

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
        Schema::dropIfExists('trdocumentationphoto');
    }
}
