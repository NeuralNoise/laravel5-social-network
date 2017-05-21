<?php

/*
|--------------------------------------------------------------------------
| Status Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Models\Status::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->paragraph(1),
        'user_id' => factory(App\User::class)->create()->id,
    ];
});