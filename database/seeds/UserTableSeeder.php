<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'name' => 'superAdmin',
            'email' => 'superAdmin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'role' => 'superAdmin',
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'Admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'User@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'role' => 'user',
        ]);
    }
}
