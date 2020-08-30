<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
    }
}
