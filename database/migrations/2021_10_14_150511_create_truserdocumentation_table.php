<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruserdocumentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truserdocumentation', function (Blueprint $table) {
            
            $table->integer("ID");
            $table->integer("DocumentationID")->unsigned();

            $table->timestamps();

            $table->foreign('DocumentationID')->references('DocumentationID')->on('msdocumentation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('truserdocumentation');
    }
}
