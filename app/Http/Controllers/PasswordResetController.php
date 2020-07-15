<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Notifications\PasswordResetRequest;

class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => "We can't find a user with that e-mail address."
            ], 404);

        $user->password_reset_token = Str::random(60);
        $user->save();

        $user->notify(
            new PasswordResetRequest($user->token)
        );
            
        return response()->json([
            'message' => 'We have e-mailed your password reset token!'
        ]);
    }
     /**
     * Confirm reset password
     *
     * @param  [string] token
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] success message
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::where(['token', $request->token])->first();
        if (!$user)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            "message" => "User successfully changed password."
        ]);
    }
}
