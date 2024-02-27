<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'username' => 'required|max:255|min:7|unique:users',
            'email' => 'required|email|unique:users',
            'nama_lengkap' => 'required|max:255',
            'password' => 'required|min:5|max:8'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'User Baru Berhasil Ditambah, Please Login');
    }

    public function index_login(){
        return view('auth.login');
    }
    public function authtenticate(Request $request): RedirectResponse {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|'
        ]);

        if (Auth::attempt($credentials)) {

            session()->regenerate();
            return redirect()->intended('/');
        }

        // return back()->with('loginError', 'Login Gagal!! Email \ Password Salah');
        return back()->withErrors([
            'email' => 'Email Salah',
            'password' => 'Password Salah',
        ])->onlyInput('email', 'password');

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
