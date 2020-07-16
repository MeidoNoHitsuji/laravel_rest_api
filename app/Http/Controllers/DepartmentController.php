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
                foreach ($d->work_positions as $p){
                    array_push($worker, ['id'=>$p->id, 'name'=>$p->name]);
                }
                array_push($message, ['id'=>$d->id, 'name'=>$d->name, 'worker'=>$worker]);
            }
            return response()->json([
                "message" => $message
            ], 200);
        }else if($user->isWorker()){
            $d = $user->work_position->department;
            $worker = [];
            foreach ($d->work_positions as $p){
                array_push($worker, ['id'=>$p->id, 'name'=>$p->name]);
            }
            $message = ['id'=>$d->id, 'name'=>$d->name, 'worker'=>$worker];
            return response()->json([
                "message" => $message
            ], 200);
        }else{
            $message = [];
            foreach (Department::all() as $d) {
                array_push($message, ['id'=>$d->id, 'name'=>$d->name]);
            }
            return response()->json([
                "message" => $message
            ], 200);
        }
    }
}
