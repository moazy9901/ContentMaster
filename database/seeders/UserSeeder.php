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
            ['email' => 'moazy9901@gmail.com'],
            [
                'name' => 'Main Admin',
                'password' => Hash::make('moazy9901'),
                'role' => 'Super_Admin',
            ]
        );

        User::factory(5)->create();

      
    }
}
