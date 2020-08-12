<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cremation;
use Faker\Generator as Faker;

$factory->define(Cremation::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});
