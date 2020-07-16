<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function unauthenticated(Request $request){
        return response()->json([
            "message" => "Invalid Token"
        ], 401);
    }

    public function read(Request $request){
        return response()->json([
            "message" => "test"
        ], 200);
    }

    public function update(Request $request){
        return response()->json([
            "message" => "test"
        ], 200);
    }
}
