<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NotifController extends Controller
{
    public function index(){
        $user = User::findOrFail(auth()->user()->user_id);
        return view('notif', [
            'fotos' => $user->foto
        ]);
    }
}
