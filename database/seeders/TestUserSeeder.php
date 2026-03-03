<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Creates a test student/user account for portal login.
     * Credentials: user@iperformanceafrica.com / password
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'user@iperformanceafrica.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'phone' => '0712345678',
                'position' => 'HR Officer',
            ]
        );
    }
}
