<?php

$factory->define(App\Model\Song::class, function (Faker\Generator $faker) {
    return [
        'identifier' => $faker->randomNumber(5),
        'globalidentifier' => $faker->randomNumber(5),
        'lyrics' => $faker->text(400),
    ];
});
