<?php

$factory->define(App\Job::class, function (Faker\Generator $faker) {
    return [
        'name_job' => $faker->sentence,
    ];
});
