<?php

use Faker\Generator as Faker;

$factory->define(Mercury\Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(Mercury\User::pluck('id')->toArray()),
        'post_id' => $faker->randomElement(Mercury\Post::pluck('id')->toArray()),
        'body' => $faker->randomElement([$faker->emoji(), null]) . $faker->realText(150) .
            $faker->randomElement([$faker->emoji(), null]) . $faker->randomElement([$faker->emoji(), null]) .
            $faker->randomElement([$faker->emoji(), null, null]) . $faker->randomElement([$faker->emoji(), null]) .
            $faker->randomElement([$faker->emoji(), null, null])
    ];
});
