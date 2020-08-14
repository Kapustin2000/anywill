<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cemetery;
use Faker\Generator as Faker;

$factory->define(Cemetery::class, function (Faker $faker) {
    return [
        'name' => $faker->text,
        'user_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
        'type' => rand(1, count(Cemetery::TYPES))
    ];
});
