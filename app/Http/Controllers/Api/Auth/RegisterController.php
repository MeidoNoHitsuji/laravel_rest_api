<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterFormRequest $request)
    {
        $random_password = Str::random(8);
        $user = User::create(array_merge(
            $request->only('name', 'email', 'type', 'github', 'city', 'phone', 'birthday'),
            ['password' => bcrypt($random_password),
            'login' => $request->email],
        ));

        Auth::attempt(["email" => $request, "password" => $random_password]);
        $token = Auth::user()->createToken(config('app.name'));
        $token->token->expires_at = Carbon::now()->addMonth();
        $token->token->save();

        return response()->json([
            "token" => $token->accessToken,
            "user" => $user,
            "password" => $random_password,
        ], 200);
    }
}
