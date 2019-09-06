<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ApiLoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {

        $this->validateLogin($request);


        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return response()->json([
                'success' => '1',
                'message' => 'Успешная авторизация',
                'data' => $user->toArray(),
            ]);
        }

        return response()->json([
            'success' => '0',
            'message' => 'Не правильный логин или пароль.',
        ]);
    }

    /**
     * @param $token
     */
    public function user_get($token)
    {
        $user = \App\User::with('attributes')->where('api_token',$token)->first();

        return response()->json([
            'success' => 1,
            'message' => 'Успешная авторизация',
            'data' => $user->toArray(),

        ]);
    }
}
