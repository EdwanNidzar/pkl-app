<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // ! This is the original code. code ini tidak di gunakan untuk saat ini.
        // if (Auth::user()->hasRole('bawaslu-provinsi')) {
        //     return redirect()->to('bawaslu-provinsi');
        // }

        // if (Auth::user()->hasRole('bawaslu-kota')) {
        //     return redirect()->to('bawaslu-kota');
        // }

        // if (Auth::user()->hasRole('panwascam')) {
        //     return redirect()->to('panwascam');
        // }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
