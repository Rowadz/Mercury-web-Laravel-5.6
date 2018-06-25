<?php

use Illuminate\Database\Seeder;

class ExchangeRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Mercury\ExchangeRequest::class, 310)->create();
    }
}
