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

$factory->afterCreating(Cemetery::class, function ($cemetery, $faker) {

    $cemetery->classifications()->sync([1,2]);
    $cemetery->options()->sync(1);
    factory(App\Models\Plot::class, 5)->create(['cemetery_id' => $cemetery->id]);
});
