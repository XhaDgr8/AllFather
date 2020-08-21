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
        factory(\App\SubProduct::class, 5)->create();
    }
}
