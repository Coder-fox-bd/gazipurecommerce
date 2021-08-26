<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarkNotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        auth()->guard('admin')->user()
        ->unreadNotifications
        ->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead();

        return response()->noContent();
    }
}
