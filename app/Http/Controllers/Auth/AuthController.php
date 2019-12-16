<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = request(['login', 'password']);

        if (!Auth::attempt($credentials)) {
            return new JsonResponse([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();

        return new JsonResponse([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return new JsonResponse([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function user(Request $request)
    {
        return new JsonResponse($request->user());
    }
}
