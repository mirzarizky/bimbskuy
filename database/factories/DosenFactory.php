<?php

use Faker\Generator as Faker;

$factory->define(\App\Dosen::class, function (Faker $faker) {
    return [
        'kode_bimbing'  => $faker->unique()->randomNumber(5),
        'kode_wali'     => $faker->unique()->randomNumber(4),
        'nip'           => $faker->unique()->randomNumber(5).$faker->randomNumber(5).$faker->randomNumber(5).$faker->randomNumber(3),
        'nama'          => $faker->name(),
        'departemen_id' => $faker->numberBetween(1, 6)
    ];
});
