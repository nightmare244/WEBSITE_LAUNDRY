<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    /**
     * Halaman login admin
     */
    public function showLogin(): View
    {
        return view('admin.login');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()
                ->intended(route('admin.orders.index'))
                ->with(
                    'success',
                    'Selamat datang di Dashboard Admin.'
                );
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->onlyInput('email');
    }

    /**
     * Logout admin
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with(
                'success',
                'Berhasil logout.'
            );
    }
}