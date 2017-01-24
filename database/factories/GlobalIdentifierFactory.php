<?php

$factory->define(App\Model\GlobalIdentifier::class, function (Faker\Generator $faker) {
    return [
        'identifier' => $faker->randomNumber(5),
        'code' => $faker->word,
        'name' => $faker->word,
    ];
});
