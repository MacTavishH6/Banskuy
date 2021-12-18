<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMspostTrtransactionChangedecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mspost', function (Blueprint $table) {
            $table->decimal('Quantity', $precision = 65, $scale = 2)->change();
        });
        Schema::table('trdonationtransaction', function (Blueprint $table) {
            $table->decimal('Quantity', $precision = 65, $scale = 2)->change();

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
