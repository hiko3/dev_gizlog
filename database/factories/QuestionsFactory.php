<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Question::class, function (Faker $faker) {
    return [
        'title'           => $faker->title,
        'content'         => $faker->text,
        'tag_category_id' => rand(1, 4),
        'user_id'         => rand(1, 4),
    ];
});
