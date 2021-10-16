<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsdocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msdocument', function (Blueprint $table) {
            $table->increments('DocumentID');
            $table->integer('FoundationID')->unsigned();
            $table->integer('DocumentTypeID')->unsigned();
            $table->string('DocumentName',50);
            $table->integer('ApprovalStatusID');
            $table->date('UploadDate');
            $table->date('ReviewDate');
            $table->timestamps();

            $table->foreign('FoundationID')->references('FoundationID')->on('msfoundation');
            $table->foreign('DocumentTypeID')->references('DocumentTypeID')->on('msdocumenttype');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msdocument');
    }
}
