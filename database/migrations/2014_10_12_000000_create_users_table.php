<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msuser', function (Blueprint $table) {
            $table->increments('UserID');
            $table->string('Email',50)->unique();
            $table->string('Password',20);
            $table->string('PhoneNumber',13);
            $table->string('FirstName',36);
            $table->string('LastName',36);
            $table->string('Username',36);
            $table->string('Gender',10);
            $table->date('RegisterDate');
            $table->string('Bio',100);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
