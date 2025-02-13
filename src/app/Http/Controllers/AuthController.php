<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;


// implements HasMiddleware - doesn't work, "localhost redirected you too many times" ERR_TOO_MANY_REDIRECTS 
class AuthController extends Controller
{
    public function login(): View
    {


        return view(
            'auth.login',
            [
            'title' => 'Log in'
            ]
        );
    }
    // authenticate user
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // We’ll later change redirect URL to /books
            return redirect('/manufacturers');
        }
        return back()->withErrors([
            'name' => 'Failed to authenticate',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

}
