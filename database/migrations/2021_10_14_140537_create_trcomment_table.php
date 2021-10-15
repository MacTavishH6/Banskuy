<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrcommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trcomment', function (Blueprint $table) {
            $table->integer('PostID');
            $table->integer('ID');
            $table->string('Comment', 255);
            $table->date('CommentDate');
            $table->timestamps();

            // $table->foreign('PostID')->references('PostID')->on('mspost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trcomment');
    }
}
