<?php

use Illuminate\Database\Seeder;

class FollowersFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Mercury\Follower::class, 10)->create();
    }
}
