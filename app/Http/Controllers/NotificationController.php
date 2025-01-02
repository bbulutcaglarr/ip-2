<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->get();
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {

        $notification = Notification::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $notification->update(['read' => true]);


        return redirect()->route('welcome')->with('success', 'Bildirim okundu!');
    }

}
