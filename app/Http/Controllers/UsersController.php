<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function getDataUser()
    {
        $user = DB::table('users')->orderBy('name')->get();

        // dd($user);
        return view('pages.userdata', compact('user'));
    }

    public function registerUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'level' => 'required',
        ]);

        $user =  User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'level' => $validatedData['level'],
        ]);

        return redirect()->back()->with('success', 'Data Pengguna Baru Telah Ditambahkan');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials))
        {
            return redirect('/');
        } else
        {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ]);
        }
    }

    public function postLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
