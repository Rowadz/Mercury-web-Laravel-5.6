<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersNamesForChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('users_names_for_chats', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->timestamps();
        // });
        DB::statement("CREATE VIEW users_names_for_chat AS SELECT	DISTINCT revicer.name as revicer_name,    revicer.id as revicer_id,    revicer.image as revicer_image,	sender.name as sender_name,    sender.id as sender_id,    sender.image as sender_image FROM    mercury.messages        LEFT JOIN    users AS revicer ON revicer.id = messages.user_id        LEFT JOIN    users AS sender ON sender.id = messages.from_id;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_names_for_chats');
    }
}
