<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'created_by' => function () {
            return factory(\App\User::class)->create()->created_by;
        },
        'updated_by' => function () {
            return factory(\App\User::class)->create()->updated_by;
        },
        'cat_number' => $faker->word,
        'name' => $faker->name,
        'description' => $faker->text,
        'stock_quantity' => $faker->numberBetween(-10000, 10000),
        'price_for_customer' => $faker->numberBetween(-10000, 10000),
        'price_for_admin' => $faker->numberBetween(-10000, 10000),
        'other_costs' => $faker->numberBetween(-10000, 10000),
        'image' => $faker->text,
        'image_alt' => $faker->text,
        'category' => $faker->word,
        'key_words' => $faker->word,
    ];
});
