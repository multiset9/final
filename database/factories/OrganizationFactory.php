<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Organization::class, function (Faker $faker) {
    return [
        //
        'name_organization' => $faker->name,
        'country' => $faker->country,
        'city' => $faker->city,
        'creator_id'=>random_int(1,10),
    ];
});
