<?php

use Faker\Generator as Faker;

$factory->define(\App\Mahasiswa::class, function (Faker $faker) {
    return [
        'nim'               => $faker->randomNumber(5).$faker->randomNumber(5).$faker->randomNumber(4),
        'nama'              => $faker->name(),
        'email'             => $faker->unique()->safeEmail,
        'alamat_ortu'       => $faker->address,
        'alamat_kos'        => $faker->address,
        'hp_ortu'           => $faker->phoneNumber,
        'hp_mahasiswa'      => $faker->phoneNumber,
        'foto'              => $faker->imageUrl(400, 400),
        'krs'               => $faker->imageUrl(),
        'tipe_bimbingan'    => $faker->numberBetween(1,2),
        'judul'             => $faker->sentence,
    ];
});
