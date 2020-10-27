<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'text' => $faker->paragraph(25),
        'user_id' => $faker->numberBetween(1,3)
    ];
});
