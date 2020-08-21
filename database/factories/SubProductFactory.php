<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SubProduct;
use Faker\Generator as Faker;

$factory->define(SubProduct::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'created_by' => function () {
            return factory(\App\User::class)->create()->created_by;
        },
        'updated_by' => function () {
            return factory(\App\User::class)->create()->updated_by;
        },
        'cat_number' => $faker->word,
        'name' => $faker->name,
        'description' => $faker->text,
        'country_of_origin' => $faker->word,
        'facility_name' => $faker->word,
        'buying_unit' => $faker->word,
        'price_per_unit' => $faker->word,
        'production_unit' => $faker->word,
        'production_price' => $faker->word,
        'quantity' => $faker->word,
        'price_for_customer' => $faker->word,
        'price_for_admin' => $faker->word,
        'other_costs' => $faker->word,
        'image' => $faker->word,
        'image_alt' => $faker->word,
        'category' => $faker->word,
        'key_words' => $faker->word,
    ];
});
