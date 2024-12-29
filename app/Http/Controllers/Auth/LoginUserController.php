<?php

namespace App\Http\Controllers\Auth;

use App\Dto\LoginUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginUserController extends Controller
{

    public function showLoginPage()
    {
        return inertia()->render('Auth/Login');
    }

    public function processLogin(LoginUserRequest $loginUserRequest)
    {

        $success = auth()->attempt(
            $loginUserRequest->only('username', 'password')->toArray(),
            $loginUserRequest->rememberMe
        );

        if (!$success) {
            return back()->withErrors(['auth' => 'Username or password wrong.']);
        }

        return redirect()->route('home');
    }
}
