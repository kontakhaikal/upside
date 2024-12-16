<?php

namespace App\Http\Controllers\Auth;

use App\Dto\LoginUserRequest;
use App\Http\Controllers\Controller;

class LoginUserController extends Controller
{

    public function showLoginPage()
    {
        return inertia()->render('Auth/Login');
    }

    public function processLogin(LoginUserRequest $request)
    {
        $success = auth()->attempt(
            $request->only('username', 'password')->toArray(),
            $request->rememberMe
        );

        if (!$success) {
            return back()->withErrors(['auth' => 'Username or password wrong.']);
        }

        return redirect()->route('home');
    }
}
