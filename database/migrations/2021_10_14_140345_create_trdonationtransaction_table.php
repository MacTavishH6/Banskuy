<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrdonationtransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trdonationtransaction', function (Blueprint $table) {
            $table->increments('DonationTransactionID');
            $table->integer('UserID')->unsigned();
            $table->integer('FoundationID')->unsigned();
            $table->integer('DonationTypeDetailID')->unsigned();
            $table->integer('ApprovalStatusID')->unsigned();
            $table->string('DonationDescriptionName', 255);
            $table->date('TransactionDate');
            $table->decimal('Quantity', $precision = 5, $scale = 2);
            $table->timestamps();

             $table->foreign('UserID')->references('UserID')->on('msuser');
             $table->foreign('FoundationID')->references('FoundationID')->on('msfoundation');
             $table->foreign('DonationTypeDetailID')->references('DonationTypeDetailID')->on('msdonationtypedetail');
             $table->foreign('ApprovalStatusID')->references('ApprovalStatusID')->on('msapprovalstatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trdonationtransaction');
    }
}
