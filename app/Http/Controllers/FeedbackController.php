<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function storeFeedback(Request $request, $campaignId)
    {
        $user = auth()->user();


        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        Feedback::create([
            'user_id' => $user->id,
            'campaign_id' => $campaignId,
            'message' => $request->message,
            'rating' => $request->rating,
        ]);


        return redirect()->route('campaigns.show', $campaignId)->with('success', 'Geri bildiriminiz başarıyla kaydedildi!');
    }

}
