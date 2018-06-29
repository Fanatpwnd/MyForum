<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => App\User::all()->random(1)[0]['id'],
        'thread_id' => App\Thread::all()->random(1)[0]['id']
    ];
});
