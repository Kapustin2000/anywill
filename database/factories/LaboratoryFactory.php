<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Laboratory;
use Faker\Generator as Faker;

$factory->define(Laboratory::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'owner_type' => App\Models\User::class,
        'owner_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
        'description' => $faker->text
    ];
});
