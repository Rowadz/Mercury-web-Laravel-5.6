<?php

use Faker\Generator as Faker;

$factory->define(Mercury\Follower::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(Mercury\User::pluck('id')->toArray()),
        'from_id' => $faker->randomElement(Mercury\User::pluck('id')->toArray()),
        'status' => $faker->randomElement([0, 1, 2])
    ];
});
