<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FuneralHome;
use Faker\Generator as Faker;

$factory->define(FuneralHome::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});


$factory->afterCreating(FuneralHome::class, function ($home) {
    factory(App\Models\FuneralHomeRooms::class, 5)->create(['funeral_home_id' => $home->id]);
});

