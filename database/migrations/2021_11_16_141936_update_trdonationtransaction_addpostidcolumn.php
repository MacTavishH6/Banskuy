<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTrdonationtransactionAddpostidcolumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trdonationtransaction', function (Blueprint $table) {
            $table->integer('PostID')->unsigned()->nullable();

            $table->foreign("PostID")->references("PostID")->on("MsPost");
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
