<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Kullanıcılar ve profilleri için veriler
        $users = [
            [
                'name' => 'Ahmet Yılmaz',
                'email' => 'ahmet@example.com',
                'password' => Hash::make('secret123'),
                'is_admin' => false,
                'profile' => [
                    'profile_picture' => 'ahmet.jpg',
                    'address' => 'İstanbul, Türkiye',
                    'phone' => '0555 123 4567',
                    'country' => 'Türkiye',
                ],
            ],
            [
                'name' => 'Zeynep Demir',
                'email' => 'zeynep@example.com',
                'password' => Hash::make('secret123'),
                'is_admin' => false,
                'profile' => [
                    'profile_picture' => 'zeynep.jpg',
                    'address' => 'Ankara, Türkiye',
                    'phone' => '0555 234 5678',
                    'country' => 'Türkiye',
                ],
            ],
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'profile' => [
                    'profile_picture' => 'john.jpg',
                    'address' => '123 Main St, Springfield',
                    'phone' => '555-678-1234',
                    'country' => 'USA',
                ],
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'password' => Hash::make('password456'),
                'is_admin' => false,
                'profile' => [
                    'profile_picture' => 'jane.jpg',
                    'address' => '456 Elm St, Metropolis',
                    'phone' => '555-789-5678',
                    'country' => 'Canada',
                ],
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michaelbrown@example.com',
                'password' => Hash::make('password789'),
                'is_admin' => false,
                'profile' => [
                    'profile_picture' => 'michael.jpg',
                    'address' => '789 Oak St, Gotham',
                    'phone' => '555-890-9012',
                    'country' => 'UK',
                ],
            ],
        ];

        // Kullanıcıları ve profilleri oluştur
        foreach ($users as $userData) {
            // Kullanıcı oluştur
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'is_admin' => $userData['is_admin'],
            ]);

            // Profil oluştur
            UserProfile::create(array_merge($userData['profile'], ['user_id' => $user->id]));
        }
    }
}
