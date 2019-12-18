<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/18/19
 * Time: 1:14 PM
 */

namespace App\Services;


use App\Entities\User;
use App\Exceptions\Http\Auth\InvalidLoginOrPassword;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Support\Carbon;
use Laravel\Passport\PersonalAccessTokenResult;
use Illuminate\Support\Facades\Auth as AuthFacade;

class Auth
{
    public function login(LoginRequest $request): PersonalAccessTokenResult
    {
        $this->tryLogin($request);

        $this->updateLastLogin($request->user(), $request->ip());

        return $this->createToken($request->user());
    }

    public function logout(User $user): void
    {
        $user->token()->revoke();
    }

    private function updateLastLogin(User $user, string $ip): void
    {
        $user->last_login = Carbon::now();
        $user->last_ip = $ip;

        $user->save();
    }

    private function createToken(User $user): PersonalAccessTokenResult
    {
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return $tokenResult;
    }

    /**
     * @param LoginRequest $request
     */
    private function tryLogin(LoginRequest $request): void
    {
        $credentials = [
            'login' => $request->login,
            'password' => $request->password
        ];

        if (!AuthFacade::attempt($credentials)) {
            throw new InvalidLoginOrPassword();
        }
    }
}