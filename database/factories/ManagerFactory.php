<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Manager;
use Faker\Generator as Faker;

$factory->define(Manager::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'director_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => \Illuminate\Support\Str::random(10),
    ];
});
