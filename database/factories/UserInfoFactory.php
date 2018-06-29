<?php

use Faker\Generator as Faker;

$factory->define(App\UserInfo::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'nickname' => $faker->name,
        'bio' => $faker->paragraph,
    ];
});
