<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class UserController extends Controller
{
   public function index_login(){
    return view('auth.login');
   }
   public function index(){
    return view("auth.register");
   }
   public function store(Request $request){
    $ValidatedData = $request->validate([
        'nama_lengkap' => 'required',
        'username'=> 'required|unique:users',
        'email' => 'required|unique:users',
        'password' => 'required'
    ]);
    User::create($ValidatedData);
    return redirect('/login');
   }
   public function authtenticate(Request $request){

    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|'
    ]);

    if (Auth::attempt($credentials)) {

        session()->regenerate();
        return redirect()->intended('/');
    }
   }
    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
