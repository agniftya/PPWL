<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Kunci pencarian
            [
                'name' => 'Admin TokoKu',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Akun Agni (User)
        User::updateOrCreate(
            ['email' => 'agnifatya@gmail.com'], // Kunci pencarian
            [
                'name' => 'Agni',
                'password' => Hash::make('duaapril'),
                'role' => 'user',
            ]
        );
    }
}