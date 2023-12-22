<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin1',
                'email' => 'admin1@resmen.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'admin2',
                'email' => 'admin2@resmen.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456')
            ],
        ];
        foreach ($users as $user) {
            User::query()->firstOrCreate([
                'email' => $user['email']
            ], $user);
        }
    }
}
