<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run()
    {
        $user = User::find(1);

        Campaign::create([
            'title' => 'Çocuklar İçin Eğitim Bağışı',
            'description' => 'Eğitim alamayan çocuklar için bağış yaparak, onların eğitim hayatlarına katkıda bulunun.',
            'goal_amount' => 20000,
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'user_id' => $user->id, // Kullanıcıyı ilişkilendiriyoruz
        ]);


        Campaign::create([
            'title' => 'Doğal Afet Yardım Kampanyası',
            'description' => 'Deprem ve doğal afetlerde zarar gören insanlara yardım ulaştırabilmek için bağış yapın.',
            'goal_amount' => 50000,
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'user_id' => $user->id,
        ]);


        Campaign::create([
            'title' => 'Sağlık İçin Yardım',
            'description' => 'Kanser tedavisi için hastalara yardım etmek amacıyla bağış yapabilirsiniz.',
            'goal_amount' => 100000,
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
            'user_id' => $user->id,
        ]);
        Campaign::create([
            'title' => 'Yeşilay İçin Yardım',
            'description' => 'Bağımlılıklarıyla savaşan insanlara destek olabilirsiniz.',
            'goal_amount' => 1000000,
            'start_date' => now(),
            'end_date' => now()->addMonths(1),
            'user_id' => $user->id,
        ]);
        Campaign::create([
            'title' => 'Çomü Teknik Bilimler MYO İçin Yardım',
            'description' => 'Öğrencilerin daha düzgün şartlarda eğitim alabilmesi için bağış yapabilirsiniz.',
            'goal_amount' => 10000000000,
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
            'user_id' => $user->id,
        ]);
    }
}
