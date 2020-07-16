<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Api\Auth\UpdateUserRequest;

class UserController extends Controller
{
    public function unauthenticated(Request $request){ //Ну тут без комментариев😅
        return response()->json([
            "message" => "Invalid Token"
        ], 401);
    }

    public function read(Request $request){
        return response()->json([
            "message" => $request->user()
        ], 200);
    }

    public function update(UpdateUserRequest $request){
        $request->user()->update([
            'name'=>$request->show_name,
            'about'=>$request->about,
            'github'=>$request->github,
            'city'=>$request->city,
            'is_finished'=>$request->is_finished,
            'telegram'=>$request->telegram,
            'phone'=>$request->phone,
            'birthday'=>$request->birthday]);
        return response()->json([
            "message" => $request->user()
        ], 200);
    }
}
