<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function index()
    {
        return view('auth.signin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_admin) {
                return redirect()->route('user.index');
            } else {
                return redirect()->route('home.index');
            }
        }

        return back()->with('failed', 'Username atau password salah!');
    }


    // function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/dashboard/home');
    //     }
    //     return back()->with('failed', 'Username/Password salah!');
    // }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
