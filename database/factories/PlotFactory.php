<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plot;
use Faker\Generator as Faker;

$factory->define(Plot::class, function (Faker $faker) {
    return [
        'cemetery_id' => function() {
            return factory(App\Models\Cemetery::class)->create()->id;
        },
    ];
});
