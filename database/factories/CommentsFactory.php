<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'comment'         => $faker->text,
        "user_id"       => rand(1, 4),
        'question_id'  => rand(1, 1000)
    ];
});
