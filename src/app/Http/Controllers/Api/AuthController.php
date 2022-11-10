<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginService $loginService)
    {
        $token = $loginService->login();
        if ($token != null) {
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
