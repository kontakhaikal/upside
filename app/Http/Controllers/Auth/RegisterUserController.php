<?php

namespace App\Http\Controllers\Auth;

use App\Dto\RegisterUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterUserController extends Controller
{
    public function showRegistrationPage()
    {
        return inertia()->render('Auth/Register');
    }

    public function processRegistration(RegisterUserRequest $request)
    {
        $user = new User($request->toArray());
        $user->save();
        return redirect()->route('login.show');
    }
}
