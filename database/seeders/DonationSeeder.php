<?php

namespace Database\Seeders;

use App\Models\Donation;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Campaign;

class DonationSeeder extends Seeder
{
    public function run()
    {
        // Kullanıcı ve Kampanya bilgileri
        $user = User::first();  // Ahmet Yılmaz
        $campaign = Campaign::first();  // Çocuklar İçin Eğitim Bağışı

        Donation::create([
            'user_id' => $user->id,
            'campaign_id' => $campaign->id,
            'amount' => 500,
            'payment_method' => 'Kredi Kartı',
        ]);

        $user2 = User::find(2);
        $campaign2 = Campaign::find(2);

        Donation::create([
            'user_id' => $user2->id,
            'campaign_id' => $campaign2->id,
            'amount' => 1500,
            'payment_method' => 'Bankamatik Kartı',
        ]);
    }
}
