<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Session;

class FireBaseNotification extends Controller
{
    public function saveToken(Request $request)
    {
        $admin = Admin::find(session('LoggedAdmin'));
        if (!$admin->device_token) {
            $admin->update(['device_token'=>$request->token]);
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Notification turned on!'
                ]
            );
        }else {
            $admin->update(['device_token'=>null]);
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Notification turned off!'
                ]
            );
        }
    }
}
