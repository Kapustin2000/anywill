<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cremation;
use Faker\Generator as Faker;

$factory->define(Cremation::class, function (Faker $faker) {
    return [
        'name' => $faker->text,
        'owner_type' => App\Models\User::class,
        'owner_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});


$factory->afterCreating(Cremation::class, function ($cremation, $faker) {
    $cremation->managers()->saveMany(factory(App\Models\User::class, 3)->make());
    $cremation->comments()->saveMany(factory(App\Models\Comment::class, 3)->make());

});
