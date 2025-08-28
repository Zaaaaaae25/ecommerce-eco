<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin EcoMart', 'email' => 'admin@ecomart.com', 'role' => 'admin'],
            ['name' => 'Alice', 'email' => 'alice@mail.com', 'role' => 'customer'],
            ['name' => 'Bob', 'email' => 'bob@mail.com', 'role' => 'customer'],
            ['name' => 'Charlie', 'email' => 'charlie@mail.com', 'role' => 'customer'],
            ['name' => 'David', 'email' => 'david@mail.com', 'role' => 'customer'],
            ['name' => 'Eve', 'email' => 'eve@mail.com', 'role' => 'customer'],
            ['name' => 'Frank', 'email' => 'frank@mail.com', 'role' => 'customer'],
            ['name' => 'Grace', 'email' => 'grace@mail.com', 'role' => 'customer'],
            ['name' => 'Heidi', 'email' => 'heidi@mail.com', 'role' => 'customer'],
            ['name' => 'Ivan', 'email' => 'ivan@mail.com', 'role' => 'customer'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
                'role' => $user['role'],
            ]);
        }
    }
}
