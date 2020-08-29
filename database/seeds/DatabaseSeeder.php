<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->insert([
//            'provider_name' => 'github',
//            'provider_id' => '60407260',
//            'email' => 'stfox003@gmail.com',
//            'password' => hash::make('60407260')
//        ]);
        // Roles
        DB::table('roles')->insert([
            'name' => 'admin',
            'label' => 'Admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'customer',
            'label' => 'Customer'
        ]);

        DB::table('roles')->insert([
            'name' => 'worker',
            'label' => 'Worker'
        ]);

        //Abilities
        DB::table('abilities')->insert([
            'name' => 'page_admin',
            'label' => 'Pages For Admins'
        ]);

        DB::table('abilities')->insert([
            'name' => 'page_customer',
            'label' => 'Pages For Customers'
        ]);

        DB::table('abilities')->insert([
            'name' => 'page_worker',
            'label' => 'Pages For Workers'
        ]);

//        $this->call(SubProductSeeder::class);
//        $this->call(ProductSeeder::class);
//        $this->call(OrderSeeder::class);
    }
}
