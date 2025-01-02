<?php

// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request, $campaignId)
    {

        $user = auth()->user();


        $campaign = Campaign::findOrFail($campaignId);

        // Validation
        $request->validate([
            'reason' => 'required|string|min:10',
        ]);


        Report::create([
            'reported_by' => $user->id,
            'reported_campaign_id' => $campaign->id,
            'reason' => $request->input('reason'),
        ]);

        return redirect()->back()->with('success', 'Kampanya başarıyla bildirildi!');
    }
}
