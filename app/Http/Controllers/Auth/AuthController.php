<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\Auth as AuthService;
use Laravel\Passport\PersonalAccessTokenResult;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Http\Auth\InvalidLoginOrPassword;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        parent::__construct();
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        if (Auth::attempt([
            'login' => $request->login,
            'password' => $request->password
        ])) {
            $user = $request->user();
        } else if (Auth::guard('accounts')->attempt([
            'email' => $request->login,
            'password' => $request->password
        ])) {
            $user = Auth::guard('accounts')->user();
        } else {
            throw new InvalidLoginOrPassword();
        }

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return $this->respondWithToken($tokenResult);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

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

    protected function respondWithToken(PersonalAccessTokenResult $tokenResult)
    {
        return new JsonResponse([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)
                ->toDateTimeString()
        ]);
    }
}
