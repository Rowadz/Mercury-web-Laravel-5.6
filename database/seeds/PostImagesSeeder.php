<?php

use Illuminate\Database\Seeder;

class PostImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Mercury\PostImage::class, 1000)->create();
    }
}
