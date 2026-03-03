<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Creates the admin account for backend management.
     * Credentials: admin@iperformanceafrica.com / password
     * Login at: /admin/login
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@iperformanceafrica.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );
    }
}
