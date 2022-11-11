<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    private $request;

    public function __construct(LoginRequest $request)
    {
        $this->request = $request;
    }

    public function login()
    {
        $validated = $this->request->validated();

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $token = $user->createToken('user')->accessToken;

            return $token;
        }

        return null;
    }
}
