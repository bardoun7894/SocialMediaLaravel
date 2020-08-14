<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'body' => $faker->sentence(),
         'commentable_id' => $faker->numberBetween(1, 1000),
         'commentable_type' => \App\Post::class
//        'commentable_id' => $faker->numberBetween(1, 500),
//        'commentable_type' => Comment::class

    ];
});
