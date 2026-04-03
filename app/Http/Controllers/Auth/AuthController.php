<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Xử lý đăng ký người dùng mới với Pepper + Argon2id.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:100',
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => SecurityService::hashWithPepper($request->password),
            'role' => 'user',
            'status' => 'active'
        ]);

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }

    /**
     * Xử lý đăng nhập với cơ chế Pepper verification.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        // Kiểm tra mật khẩu thủ công qua SecurityService ( Argon2id + Pepper )
        if (!$user || !SecurityService::verifyWithPepper($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['Thông tin tài khoản hoặc mật khẩu không chính xác.'],
            ]);
        }

        Auth::login($user, $request->remember);

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }
}
