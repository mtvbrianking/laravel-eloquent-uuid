<?php

use Bmatovu\Uuid\Tests\Models\Dummy;
use Faker\Generator as Faker;

$factory->define(Dummy::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
