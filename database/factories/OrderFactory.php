<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        'shiping_address' => $faker->word,
        'token' => $faker->word,
        'status' => $faker->word,
        'created_by' => function () {
            return factory(\App\User::class)->create()->created_by;
        },
        'updated_by' => factory(\App\UpdatedBy::class),
    ];
});
