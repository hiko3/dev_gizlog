<?php

use Faker\Generator as Faker;

$factory->define(App\Models\DailyReport::class, function (Faker $faker) {
    return [
        'title'          => $faker->title,
        'user_id'        => 1,
        'content'        => $faker->text,
        'reporting_time' => $faker->dateTimeThisYear,
    ];
});
