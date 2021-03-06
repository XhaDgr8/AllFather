<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
