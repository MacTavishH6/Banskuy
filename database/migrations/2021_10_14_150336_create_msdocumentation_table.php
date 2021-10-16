<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsdocumentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msdocumentation', function (Blueprint $table) {
            
            $table->increments("DocumentationID");
            $table->integer("DonationTypeID")->unsigned();
            $table->date("DocumentationDate");

            $table->foreign('DonationTypeID')->references('DonationTypeID')->on('msdonationtype');

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
        Schema::dropIfExists('msdocumentation');
    }
}
