<?php

use Faker\Generator as Faker;

$factory->define(\App\Notifikasi::class, function (Faker $faker) {
    return [
        'message'       => $faker->sentence(1),
        'read_at'       => $faker->randomElement([null, now()]),
        'user_id'       => $faker->numberBetween(1, 556)
    ];
});
