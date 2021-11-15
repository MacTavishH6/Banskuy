<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMsuserRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('msuser', function (Blueprint $table) {
            $table->string('EmailVerified', 1)->nullable();
            $table->string('Role', 1);
        });

        Schema::table('msfoundation', function (Blueprint $table) {
            $table->string('EmailVerified', 1)->nullable();
            $table->string('Role', 1);
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
