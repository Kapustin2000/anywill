<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'owner_type' => App\Models\User::class,
        'owner_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
        'comment' => $faker->text,

    ];
});
