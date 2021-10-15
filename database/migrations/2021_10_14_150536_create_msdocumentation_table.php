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
            
            $table->increment("DocumentationID");
            $table->integer("DonationTypeID");
            $table->date("DocumentationDate");

            $table->foreign('DonationTypeID')->references('DonationTypeID')->on('MsDonationType');

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
