<?php

$factory->define(App\Model\File::class, function (Faker\Generator $faker) {
    return [
        'identifier' => $faker->randomNumber(5),
        'globalidentifier' => $faker->randomNumber(5),
        'url' => $faker->url,
        'extension' => $faker->word,
        'mime' => $faker->word,
    ];
});
