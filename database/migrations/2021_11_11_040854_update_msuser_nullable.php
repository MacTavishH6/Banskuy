<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMsuserNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('msuser', function (Blueprint $table) {
            $table->string('FirstName', 36)->nullable()->change();
            $table->string('LastName', 36)->nullable()->change();
            $table->string('Username', 36)->nullable()->change();
            $table->string('Gender', 10)->nullable()->change();
            $table->string('Bio', 100)->nullable()->change();
            $table->string('Password', 60)->change();
            $table->boolean('IsConfirmed')->nullable();
            $table->integer('AddressID')->unsigned()->nullable();
            $table->foreign('AddressID')->references('AddressID')->on('MsAddress');
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
