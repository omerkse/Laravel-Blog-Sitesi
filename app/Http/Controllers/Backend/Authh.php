<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Authh extends Controller
{
    public function login(){
        return view('Back.auth.login');
    }

    public function loginPost(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->withErrors('Email veya Şifre Hatalı');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

}
