<?php

use Faker\Generator as Faker;



$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Movement::class, function (Faker $faker) {

    return [

        'type' => $faker->randomElement(['egreso', 'ingreso']),
        'movement_date' => $faker->date(),
        'category_id' => $faker->numberBetween(1, 10),
        'description' => $faker->paragraph(),
        'money' => $faker->numberBetween(1000,9900000),
        'image' => null
    ];

});

