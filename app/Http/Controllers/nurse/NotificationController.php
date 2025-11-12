<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Get notifications for dropdown
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();

        return view('nurse.partials.notifications', compact('notifications'));
    }

    // Mark all as read
    public function markAllRead()
    {
        Notification::where('user_id', Auth::id())
            ->update(['is_read' => true]);

        return response()->json(['status' => 'success']);
    }
}
