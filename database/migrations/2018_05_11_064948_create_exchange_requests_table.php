<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// user_id  who sent the request
// post_id  the offerd Post
// original_post_id  the The post that recived an exchange request
// status => 1 accepted 
// status => 0 pending 

class CreateExchangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id'); // who sent the request
            $table->unsignedInteger('post_id'); // the offerd Post
            $table->unsignedInteger('original_post_id');
            $table->enum('status', ['accepted', 'pending', 'archive']);
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('original_post_id')->references('id')->on('posts');
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
        Schema::dropIfExists('exchange_requests');
    }
}
