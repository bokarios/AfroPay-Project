<?php

use Faker\Generator as Faker;

$factory->define(\CreatyDev\Domain\Project\Models\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->words(3, true),
        'slug' => $faker->unique()->slug(3),
    ];
});
