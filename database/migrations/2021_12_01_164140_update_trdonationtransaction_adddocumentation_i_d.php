<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTrdonationtransactionAdddocumentationID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trdonationtransaction', function (Blueprint $table) {
            $table->integer('DocumentationID')->unsigned()->nullable();

            $table->foreign('DocumentationID')->references('DocumentationID')->on('MsDocumentation');
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
