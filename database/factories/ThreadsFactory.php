<?php

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'section_id' => App\Section::all()->random(1)[0]['id'],
        'user_id' => App\User::all()->random(1)[0]['id']
    ];
});
