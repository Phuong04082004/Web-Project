<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as Authenticate;


class Auth extends Controller
{
    public function register() {
        return view("register");
    }
    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
        $avatar = $request->input('avatar', 'default-avatar.png');
        if (!str_starts_with($avatar, '/default-avatars/')) {
            $avatar = '/default-avatars/' . $avatar;
        }

        $user = User::factory()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'avatar' => $avatar,
        ]);

        return redirect('/login')->with('success', 'Registration successful!');
    }
    public function login() {
        return view("login");
    }
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Authenticate::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect("/")->with("success", "Login successfully");
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }
    public function logout(Request $request)
    {
        Authenticate::logout();
        $request->session()->invalidate();         // Xóa session hiện tại
        $request->session()->regenerateToken();    // Tạo CSRF token mới

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
