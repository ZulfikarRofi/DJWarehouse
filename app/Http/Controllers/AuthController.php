<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('error', 'The provided credentials do not match our records.');
    }

    public function logOut(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function postRegister(Request $request)
    {
        $datauser =  $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:4',
        ]);

        $user = User::Create([
            'name' => $datauser['name'],
            'email' => $datauser['email'],
            'name' => bcrypt($datauser['password']),
        ]);

        auth()->login($user);

        return redirect('/');
    }
}
