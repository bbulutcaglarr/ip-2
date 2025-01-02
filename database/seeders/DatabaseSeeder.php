<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CampaignSeeder::class,
            DonationSeeder::class,
        ]);
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Şifreyi bcrypt ile hash'leyin
            'is_admin' => true, // Admin kullanıcısı
        ]);
    }

}
