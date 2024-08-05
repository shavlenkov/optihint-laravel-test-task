<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function getSignin(): View {
        return view('auth.signin');
    }

    public function postSignin(Request $request): RedirectResponse
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()
                ->back();
        }

        return redirect()
            ->route('articles.index');
    }

    public function getSignout(): RedirectResponse
    {
        Auth::logout();

        return redirect()
            ->route('get.signin');
    }
}
