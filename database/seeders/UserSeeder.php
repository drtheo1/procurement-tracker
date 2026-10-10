<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'System Administrator', 'email' => 'admin@admin.com', 'role' => 'admin'],
            ['name' => 'Akosua Mensah', 'email' => 'manager@example.com', 'role' => 'manager'],
            ['name' => 'Kwame Boateng', 'email' => 'employee@example.com', 'role' => 'employee'],
            ['name' => 'Lena Fischer', 'email' => 'lena@example.com', 'role' => 'employee'],
            ['name' => 'Tobias Weber', 'email' => 'tobias@example.com', 'role' => 'employee'],
        ];

        foreach ($users as $user) {
            User::factory()->create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
