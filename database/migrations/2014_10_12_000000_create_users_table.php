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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('API_KEY')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('image');
            $table->string('city');
            $table->string('phone')->unique();
            $table->longText('about')->nullable();
            $table->string('provider')->nullable();
            $table->string('provided_id')->nullable();
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
