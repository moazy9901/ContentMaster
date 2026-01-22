<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Explicit main admin user
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Main Admin',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
            ]
        );

        User::factory(5)->create();

      
    }
}
