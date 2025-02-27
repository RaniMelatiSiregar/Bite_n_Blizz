<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'is_admin' => false,
        ]);
    }
} 