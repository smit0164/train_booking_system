<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserAuthController extends Controller
{
     public function showLoginForm()
    {
        return view('auth.user_login'); // Create this view accordingly
    }
    public function login(Request $request)
    {
        // Validate the login form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        // Attempt to authenticate the user with the 'user' guard
        if (Auth::guard('user')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('user.dashboard');
        }

        // Authentication failed, redirect back with error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

     public function showRegisterForm()
    {
        return view('auth.user_register'); // Create this view accordingly
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        Auth::guard('user')->login($user);

        return redirect()->route('user.dashboard'); // Adjust redirect as needed
    }
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');;
    }
}