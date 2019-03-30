<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Vacancy::class, function (Faker $faker) {
    return [
        //
        'name_vacancy'=>$faker->name,
        'amount_workers'=>random_int(20,500),
        'organization_id'=>null,
        'salary'=>random_int(5000,10000),
        'creator_id'=>random_int(1,1000),
    ];
});
