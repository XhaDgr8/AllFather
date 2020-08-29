<?php

use Illuminate\Database\Seeder;

class SubProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(\App\SubProduct::class, 5)->create();
        DB::table('sub_products')->insert([
            'cat_number' => 'OL005',
            'name' => "JDRF",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam.',
            'country_of_origin' => 'FRANCE',
            'facility_name' => 'IFF',
            'buying_unit' => 'KG',
            'price_per_unit' => '70',
            'production_unit' => 'GR',
            'production_price' => '0.07',
            'stock_quantity' => '4.5',
            'price_for_customer' => '000',
            'price_for_admin' => '000',
            'other_costs' => '000',
            'image' => '',
            'image_alt' => '',
            'category' => 'Type1',
            'key_words' => 'Lorem ipsum dolor sit amet,',
            'created_by' => '1',
            'updated_by' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('sub_products')->insert([
            'cat_number' => 'OL018',
            'name' => "SNTM",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam.',
            'country_of_origin' => 'FRANCE',
            'facility_name' => 'IFF',
            'buying_unit' => 'KG',
            'price_per_unit' => '95.00',
            'production_unit' => 'GR',
            'production_price' => '0.095',
            'stock_quantity' => '1.5',
            'price_for_customer' => '000',
            'price_for_admin' => '000',
            'other_costs' => '000',
            'image' => '',
            'image_alt' => '',
            'category' => 'Type1',
            'key_words' => 'Lorem ipsum dolor sit amet,',
            'created_by' => '1',
            'updated_by' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('sub_products')->insert([
            'cat_number' => 'OL009',
            'name' => "SHKH",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam.',
            'country_of_origin' => 'FRANCE',
            'facility_name' => 'IFF',
            'buying_unit' => 'KG',
            'price_per_unit' => '350.00',
            'production_unit' => 'GR',
            'production_price' => '0.35',
            'stock_quantity' => '3',
            'price_for_customer' => '000',
            'price_for_admin' => '000',
            'other_costs' => '000',
            'image' => '',
            'image_alt' => '',
            'category' => 'Type1',
            'key_words' => 'Lorem ipsum dolor sit amet,',
            'created_by' => '1',
            'updated_by' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('sub_products')->insert([
            'cat_number' => 'OL084',
            'name' => "KNBS",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam.',
            'country_of_origin' => 'FRANCE',
            'facility_name' => 'IFF',
            'buying_unit' => 'KG',
            'price_per_unit' => '350.00',
            'production_unit' => 'GR',
            'production_price' => '0.35',
            'stock_quantity' => '2.25',
            'price_for_customer' => '000',
            'price_for_admin' => '000',
            'other_costs' => '000',
            'image' => '',
            'image_alt' => '',
            'category' => 'Type1',
            'key_words' => 'Lorem ipsum dolor sit amet,',
            'created_by' => '1',
            'updated_by' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('sub_products')->insert([
            'cat_number' => 'OL066',
            'name' => "RLUD",
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam.',
            'country_of_origin' => 'KUWEIT',
            'facility_name' => 'KRC',
            'buying_unit' => 'KG',
            'price_per_unit' => '350.00',
            'production_unit' => 'GR',
            'production_price' => '0.35',
            'stock_quantity' => '2.5',
            'price_for_customer' => '000',
            'price_for_admin' => '000',
            'other_costs' => '000',
            'image' => '',
            'image_alt' => '',
            'category' => 'Type1',
            'key_words' => 'Lorem ipsum dolor sit amet,',
            'created_by' => '1',
            'updated_by' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
