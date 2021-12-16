<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHtrnotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('htrnotification', function (Blueprint $table) {
            $table->increments('HtrNotificationID');
            $table->tinyInteger('NotificationType');
            $table->text('NotificationHeader');
            $table->text('NotificationContent');
            $table->timestamps();
            //1 for notif post
            //2 for notif message
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_htrnotification');
    }
}
