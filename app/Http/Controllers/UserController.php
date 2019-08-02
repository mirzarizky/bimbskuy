<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getNotifications() {
        $user = Auth::user();

        return response()->json(['notifications' => $user->notifications]);
    }
}
