<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// faker->randomElement(['Amman', 'Zarqa', 'Irbid', 'Aqaba', 'As-Salt', 'Madaba', 'Mafraq', 'Jerash', "Ma'an", "Tafilah", "Karak"])
// 1
//'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
//        'API_KEY' =>str_random(5) . bcrypt(Carbon::now()->toDateTimeString()),
//        'date_of_birth' => $faker->date('Y-m-d', 'now'),
//        'image' => "http://lorempixel.com/800/600/cats/",
//        'city' => 'Amman',
//        'phone' => '0795345532',
//        'about' => $faker->realText(250),
//        'remember_token' => str_random(10),

$factory->define(Mercury\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'API_KEY' =>str_random(5) . bcrypt(Carbon::now()->toDateTimeString()),
        'date_of_birth' => $faker->date('Y-m-d', 'now'),
        'image' => $faker->imageUrl(640, 480, 'cats'),
        'city' => $faker->randomElement(['Amman', 'Zarqa', 'Irbid', 'Aqaba', 'As-Salt', 'Madaba', 'Mafraq', 'Jerash', "Ma'an", "Tafilah", "Karak"]),
        'phone' => $faker->e164PhoneNumber(),
        'about' => $faker->realText(250),
        'remember_token' => str_random(10),
    ];
});
