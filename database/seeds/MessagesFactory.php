<?php

use Illuminate\Database\Seeder;

class MessagesFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Mercury\Message::class, 200)->create();
    }
}
