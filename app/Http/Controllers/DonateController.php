<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Notification;
use App\Models\Refund;
use Illuminate\Http\Request;

class DonateController extends Controller
{
    public function index()
    {
        // Bağış yapan kullanıcının tüm bağışlarını al
        $donations = Donation::where('user_id', auth()->id())->with('refunds')->get();

        // Eğer iade verisi varsa, iade edilen bağışları da döndürebiliriz
        foreach ($donations as $donation) {
            if ($donation->refunds->isEmpty()) {
                $donation->refunds_status = 'Henüz iade edilmedi';
            } else {
                $donation->refunds_status = 'İade edildi';
            }
        }

        // Donations sayfasını döndür
        return view('donations', compact('donations'));
    }


    public function donate(Request $request, $id)
    {
        // Bağış miktarı ve ödeme yöntemi al
        $amount = $request->input('amount');
        $payment_method = $request->input('payment_method');

        // Bağışı donations tablosuna ekle
        $donation = new Donation();
        $donation->campaign_id = $id;
        $donation->amount = $amount;
        $donation->payment_method = $payment_method;
        $donation->user_id = auth()->id();
        $donation->save();

        // Bağış yapan kullanıcıyı al
        $user = auth()->user();

        // Bildirimi oluştur
        Notification::create([
            'user_id' => $user->id, // Bildirim bağlanacak kullanıcı
            'message' => "Bağışınız başarıyla alındı. $amount TL bağış yaptınız.",
            'type' => 'Bağış Yapıldı',
            'read' => 0,
            'notifiable_type' => 'App\Models\User', // Polymorphic ilişki için
            'notifiable_id' => $user->id, // Polymorphic ilişki için
        ]);

        return redirect()->route('campaigns.show', $id)->with('donation_success', true);
    }

    public function refund(Request $request, $donationId)
    {

        $donation = Donation::where('id', $donationId)
            ->where('user_id', auth()->id())
            ->firstOrFail();


        $refund = new Refund();
        $refund->donation_id = $donation->id;
        $refund->reason = $request->input('reason');
        $refund->save();

        Notification::create([
            'user_id' => auth()->id(),
            'message' => "Bağışınız iade edilmiştir. Sebep: " . $request->input('reason'),
            'type' => 'Bağış İade',
            'read' => 0,
            'notifiable_type' => 'App\Models\User',
            'notifiable_id' => auth()->id(),
        ]);


        $campaign = $donation->campaign;


        $total_donations = $campaign->donations()
            ->where('status', '!=', 'refunded')
            ->sum('amount');

        $campaign->total_donations = $total_donations;
        $campaign->save();


        return redirect()->route('donations')->with('success', 'Bağışınız başarıyla iade edilmiştir.');  // Buradaki yönlendirmeyi 'donations' olarak güncelledik
    }


}

