<?php

use Faker\Generator as Faker;

// 3

$factory->define(Mercury\Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(Mercury\User::pluck('id')->toArray()),
        'tag_id' => $faker->randomElement(Mercury\Tag::pluck('id')->toArray()),
        'header' => $faker->realText(20),
        'body' => $faker->realText(1600, 2),
        'location' => $faker->randomElement(Mercury\User::pluck('city')->toArray()),
        'quantity' => $faker->randomElement([1, 2, 3, 4, 5]),
        'status' => $faker->randomElement(['available', 'archive']),
        'video_link' => $faker->randomElement(['https://www.youtube.com/watch?v=ApN1cZoiX4w', 'https://www.youtube.com/watch?v=hQWRp-FdTpc', null])
    ];
});
