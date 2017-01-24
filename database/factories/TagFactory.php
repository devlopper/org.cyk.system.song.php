<?php

$factory->define(App\Model\Tag::class, function (Faker\Generator $faker) {
    return [
        'identifier' => $faker->randomNumber(5),
        'globalidentifier' => $faker->randomNumber(5),
    ];
});
