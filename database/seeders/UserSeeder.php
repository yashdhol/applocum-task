<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = [
            [
                'full_name' => 'Super Admin',
                'username' => 'applocumadmin@yopmail.com',
                'email' => 'applocumadmin@yopmail.com',
                'role' => 'super admin',
                'password' => Hash::make('Password@123'),
            ], [
                'full_name' => 'Admin',
                'username' => 'appadmin@yopmail.com',
                'email' => 'appadmin@yopmail.com',
                'role' => 'admin',
                'password' => Hash::make('Password@123'),
            ], [
                'full_name' => 'User',
                'username' => 'appuser@yopmail.com',
                'email' => 'appuser@yopmail.com',
                'role' => 'user',
                'password' => Hash::make('Password@123'),
            ],
        ];
        User::insert($users);
    }

}
