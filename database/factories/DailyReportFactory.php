<?php

use Faker\Generator as Faker;

$factory->define(App\Models\DailyReport::class, function (Faker $faker) {
    return [
        'title'          => $faker->title,
        'user_id'        => 4,
        'content'        => $faker->text,
        'reporting_time' => $faker->dateTimeThisYear,
    ];
});
