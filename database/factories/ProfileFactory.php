<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'user_name' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'status' => $faker->word,
        'website' => $faker->text,
        'mobile' => $faker->numberBetween(-10000, 10000),
        'avatar' => $faker->text,
    ];
});
