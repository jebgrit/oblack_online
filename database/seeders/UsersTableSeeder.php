<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            // Admin
            [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@vocoursse.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active'
            ],

            // Vendor
            [
                'name' => 'vendor',
                'username' => 'vendor',
                'email' => 'vendor@vocoursse.com',
                'password' => Hash::make('password'),
                'role' => 'vendor',
                'status' => 'active'
            ],

            // User or Customer
            [
                'name' => 'user',
                'username' => 'user',
                'email' => 'user@vocoursse.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'status' => 'active'
            ],

            // Shopper
            [
                'name' => 'shopper',
                'username' => 'shopper',
                'email' => 'shopper@vocoursse.com',
                'password' => Hash::make('password'),
                'role' => 'shopper',
                'status' => 'active'
            ]
        ]);
    }

    public function down()
    {
        DB::drop('users');
    }
}
