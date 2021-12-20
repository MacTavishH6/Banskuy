<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsmessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trmessage', function (Blueprint $table) {
            $table->increments('MessageID');
            $table->integer('ReceiverID')->unsigned();
            $table->integer('SenderID')->unsigned();
            $table->text('Messages');
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
        Schema::dropIfExists('tsmessage');
    }
}
