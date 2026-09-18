<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@desa.com')->exists()) {
            User::create([
                'name' => 'Admin Desa',
                'email' => 'admin@desa.com',
                'password' => Hash::make('manglidesaku'), // password aman
                'role' => 'admin',
            ]);
        }
    }
}
