<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Response\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class JWTAuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $user = User::where('username', $credentials['username'])->first();
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['Login failed! please try again with correct credentials'],
            ]);
        }
        $jwtToken = $user->createToken($credentials['device_name'] ?? 'default-device')->plainTextToken;

        return ApiResponse::success($jwtToken, 'Successfully logged in!');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return ApiResponse::deleted(null, 'Successfully logged out');
    }
}
