<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Organization;
use Faker\Generator as Faker;

$factory->define(Organization::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'user_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
       'description' => $faker->text
    ];
});


$factory->afterCreating(Organization::class, function ($organization) {
    $organization->cemeteries()->saveMany(factory(App\Models\Cemetery::class, 3)->make());
    $organization->laboratories()->saveMany(factory(App\Models\Laboratory::class, 3)->make());
    $organization->funeral_homes()->saveMany(factory(App\Models\FuneralHome::class, 3)->make());
    $organization->cremations()->saveMany(factory(App\Models\Cremation::class, 3)->make());
    $organization->managers()->saveMany(factory(App\Models\Manager::class, 3)->make());
    $organization->address()->create(
        [
            'country_id' => 1,
            'region_id' => 1,
            'address' => 1,
            'zip' => 1,
        ]
    );
});
