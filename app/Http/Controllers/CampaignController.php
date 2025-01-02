<?php

namespace App\Http\Controllers;

use App\Models\SavedCampaign;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user) {

            $savedCampaignIds = $user->savedCampaigns()->pluck('campaign_id')->toArray();


            if (!empty($savedCampaignIds)) {

                $campaigns = Campaign::query()
                    ->orderByRaw("FIELD(id, " . implode(',', $savedCampaignIds) . ") DESC")
                    ->orderBy('created_at', 'DESC')
                    ->get();
            } else {

                $campaigns = Campaign::latest()->get();
            }
        } else {

            $campaigns = Campaign::latest()->take(5)->get();
        }

        foreach ($campaigns as $campaign) {
            if ($campaign->end_date) {
                $campaign->end_date = \Carbon\Carbon::parse($campaign->end_date)->format('d-m-Y');
            }
        }

        return view('campaigns.campaigns', compact('campaigns'));
    }

    public function show($id)
    {
        $campaign = Campaign::with('comments.user')->findOrFail($id);


        $total_donations = $campaign->donations()->where('status', '!=', 'refunded')->sum('amount');

        return view('campaigns.show', compact('campaign', 'total_donations'));
    }

    public function donate(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
        ]);

        $campaign = Campaign::findOrFail($request->id);

        $donation = new Donation();
        $donation->campaign_id = $request->id;
        $donation->user_id = auth()->id();
        $donation->amount = $request->input('amount');
        $donation->payment_method = $request->input('payment_method');
        $donation->save();

        $campaign->increment('amount', $donation->amount);

        Notification::create([
            'user_id' => auth()->id(),
            'type' => 'Bağış Yapıldı',
            'message' => 'Bağışınız başarıyla alındı. ' . number_format($donation->amount, 2) . ' TL bağış yaptınız.',
            'read' => false,
        ]);

        return back()->with('success', 'Bağışınız başarıyla alındı!');
    }

    public function save($id)
    {
        $user = auth()->user();

        $campaign = Campaign::findOrFail($id);


        if ($user->savedCampaigns()->where('campaign_id', $campaign->id)->exists()) {
            return back()->with('error', 'Bu kampanya zaten kaydedildi.');
        }


        $user->savedCampaigns()->attach($campaign->id);

        return back()->with('success', 'Kampanya başarıyla kaydedildi!');
    }

    public function about()
    {

        $campaign = Campaign::first();


        return view('about', compact('campaign'));
    }

    public function addComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);


        $campaign = Campaign::findOrFail($id);


        $campaign->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);


        return redirect()->route('campaigns.show', $campaign->id)->with('success', 'Yorum başarıyla eklendi!');
    }

    public function storeDonation(Request $request, $campaignId)
    {
        $user = auth()->user();


        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
        ]);


        Donation::create([
            'user_id' => $user->id,
            'campaign_id' => $campaignId,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
        ]);


        session()->flash('donation_success', true);


        return redirect()->route('campaigns.show', $campaignId);
    }

}
