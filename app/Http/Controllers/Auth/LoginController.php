<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Override the login method
    public function login(Request $request)
    {

        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $isMainDomain = $request->getHost() === env('MAIN_DOMAIN');

            if ($isMainDomain) {
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/home');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Other methods, such as showLoginForm, logout, etc.
}
