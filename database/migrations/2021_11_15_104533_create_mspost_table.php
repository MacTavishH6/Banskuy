<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMspostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mspost', function (Blueprint $table) {
            $table->increments('PostID');
            $table->integer('DonationTypeDetailID')->unsigned();
            $table->integer('DonationTypeID')->unsigned();
            $table->integer('ID');
            $table->string('PostTitle',100);
            $table->integer('PostTypeID');
            $table->string('PostType');
            $table->string('PostDescription', 255);
            $table->integer('RoleID')->unsigned();
            $table->date('UploadDate');
            $table->string('PostPicture', 255);
            $table->string('PictureRealName',255);
            $table->decimal('Quantity', $precision = 5, $scale = 2);
            $table->timestamps();

             $table->foreign('DonationTypeDetailID')->references('DonationTypeDetailID')->on('msdonationtypedetail');
             $table->foreign('DonationTypeID')->references('DonationTypeID')->on('msdonationtype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mspost');
    }
}
