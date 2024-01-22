<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        DatabaseNotification::where('id', $request->id)->update([
            'read_at' => now(),
        ]);
        return response()->json();
    }
}
