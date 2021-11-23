<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMsfoundationAddphotoid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('msfoundation', function (Blueprint $table) {
            $table->integer('PhotoID')->unsigned()->nullable();

            $table->foreign('PhotoID')->references('PhotoID')->on('MsFoundationPhoto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
