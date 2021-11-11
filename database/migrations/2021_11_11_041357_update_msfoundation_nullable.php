<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMsfoundationNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('msfoundation', function (Blueprint $table) {
            $table->string('FoundationName', 50)->nullable()->change();
            $table->string('Username', 36)->nullable()->change();
            $table->string('Visi', 100)->nullable()->change();
            $table->string('Misi', 255)->nullable()->change();
            $table->boolean('IsConfirmed')->nullable();
            $table->string('Password', 60)->change();
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
