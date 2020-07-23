<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'body' => $faker->paragraph($faker->numberBetween(1, 5)),
        'status' => $faker->randomElement(['draft', 'publish'])
    ];
});
