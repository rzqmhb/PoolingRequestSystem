<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function showLoginForm() {
        return redirect()->route('login_form');
    }

    public function login(Request $request) : RedirectResponse {
        $credentials = $request->validate([
            'user_email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_role == 'admin') {
                return redirect()->route('dashboard');
            }
            return redirect()->route('approver.dashboard');
        }


        return redirect()->back()->withErrors(['Credentials provided did not match our records.']);
    }

    public function logout(Request $request) : RedirectResponse {
        Auth::logout();
        return redirect()->intended('');
    }
}
