<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();

            if (Auth::user()->isSuperadmin()) {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/petugas/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang Anda Masukkan Salah.',
        ]);
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak ditemukan dalam sistem.',
        ]);

        // Generate token
        $token = Str::random(64);

        // Delete existing tokens for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Create new password reset token
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => now()
        ]);

        // Redirect to reset form with token
        return redirect()->route('password.reset', ['token' => $token, 'email' => $request->email])
                        ->with('status', 'Link reset password berhasil dibuat. Silakan buat password baru.');
    }

    public function showResetForm($token = null, Request $request)
    {
        $email = $request->email;

        // Verify token exists
        $resetData = DB::table('password_reset_tokens')
                      ->where('email', $email)
                      ->first();

        if (!$resetData) {
            return redirect()->route('login')->withErrors(['email' => 'Token reset password tidak valid.']);
        }

        return view('auth.reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        // Find the password reset record
        $resetData = DB::table('password_reset_tokens')
                      ->where('email', $request->email)
                      ->first();

        if (!$resetData) {
            return back()->withErrors(['email' => 'Token reset password tidak valid.']);
        }

        // Check if token is expired (24 hours)
        if (now()->diffInHours($resetData->created_at) > 24) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['token' => 'Token reset password sudah kadaluarsa.']);
        }

        // Update user password
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete the reset token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}