<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use App\WorkPosition;

class DepartmentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request){
        $user = $request->user();
        if($user->isAdmin()){
            $message = [];
            foreach (Department::all() as $d) {
                $worker = [];
                foreach ($d->work_positions()->get() as $p){
                    array_push($worker, ['id'=>$p->id, 'name'=>$p->name]);
                }
                array_push($message, ['id'=>$d->id, 'name'=>$d->name, 'worker'=>$worker]);
            }
            return response()->json([
                "message" => $message
            ], 200);
        }else if($user->isWorker()){
            return response()->json([
                "message" => "2"
            ], 200);
        }else{
            return response()->json([
                "message" => "3"
            ], 200);
        }
    }
}
