<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ];
        $data = $request->validate($rules);
        if (Auth::attempt($data)) {
            /** @var User $user */
            $user = auth()->user();
            $token = $user->createToken($user->name)->plainTextToken;
            return self::getJsonResponse('Success', compact('user', 'token'));
        }
        return self::getJsonResponse('Wrong credentials...', null, false);
    }

    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->tokens()->delete();
        return self::getJsonResponse('Success');
    }
}
