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
            "administrative_area_level_1" => "CA",
            "administrative_area_level_2" =>"Orange County",
            "country" => "United States",
            "latitude" => 33.5866727,
            "longitude" => 33.5866727,
            "name" => "12 Conch Reef",
            "locality" => "Aliso Viejo",
            "place_id" => "ChIJR-UVKLHo3IARrFZ2ptDjcEc",
            "postal_code" => "92656",
            "route" => "Conch Reef",
            "street_number" => "12",
            "formatted_address" => "12 Conch Reef, Aliso Viejo, CA 92656, USA"
        ]
    );
});
