<?php

use Faker\Generator as Faker;

$factory->define(\App\TransaksiBimbingan::class, function (Faker $faker) {
    return [
        'uraian_materi' => $faker->paragraph(1),
    ];
});
