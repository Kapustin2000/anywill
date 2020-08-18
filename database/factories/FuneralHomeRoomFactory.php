<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FuneralHomeRooms;
use Faker\Generator as Faker;

$factory->define(FuneralHomeRooms::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'capacity' => $faker->numberBetween(0,100), 
        'funeral_home_id' => function() {
            return factory(App\Models\FuneralHome::class)->create()->id;
        },
    ];
});
