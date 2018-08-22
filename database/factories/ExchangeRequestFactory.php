<?php

use Faker\Generator as Faker;

$factory->define(Mercury\ExchangeRequest::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(Mercury\User::pluck('id')->toArray()),
        'post_id' => $faker->randomElement(Mercury\Post::pluck('id')->toArray()),
        'original_post_id' => $faker->randomElement(Mercury\Post::pluck('id')->toArray()),
        'status' => $faker->randomElement([0, 1])
    ];
});
