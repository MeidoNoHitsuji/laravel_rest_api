<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Worker;
use App\Department;
use App\WorkPosition;

class WorkerController extends Controller
{

    public function all(Request $request){
        $user = $request->user();
        $users_builder = User::where('role', 1);
        
        if($request->has('query')){
            $users_builder = $users_builder->where('name', $request->input('query'));
        }
        if($request->has('department_id')){
            $users_id = Worker::where('department_id', $request->input('department_id'))->get()->mapWithKeys(function ($item){
                return [$item['user_id']];
            });
            $users_builder = $users_builder->whereIn('id', $users_id);
        }
        if($request->has('position_id')){
            $users_id = Worker::where('position_id', $request->input('position_id'))->get()->mapWithKeys(function ($item){
                return [$item['user_id']];
            });
            $users_builder = $users_builder->whereIn('id', $users_id);
        }

        if($user->isWorker()){
            $users_id = Worker::where('department_id', $user->worker->department->id)->get()->mapWithKeys(function ($item){
                return [$item['user_id']];
            });
            $users_builder = $users_builder->whereIn('id', $users_id);
        }else{
            $users_builder = $users_builder->where('id', 0); //Костыльная фигня. Не знаю как сделать, чтобы выдавало пустой ответ.
        }
        
        return response()->json([
            "message" => $users_builder->paginate(10)
        ], 200);
    }

    public function worker(Request $request, $id){
        $user = $request->user();
        $worker = Worker::find($id);
        if(!$worker->user){
            return response()->json([
                "message" => "Worker not found!"
            ], 404);
        }
        if($user->isAdmin()){
            $message = $worker->user;
            $message->worker = ['department'=>$worker->department->name, 'position'=>$worker->work_position->name, 'adopted_at'=>$message->updated_at];
        }else if($user->isWorker()){
            if($worker->department->id == $user->worker->department->id){
                $message = $worker->user;
                $message->worker = ['department'=>$worker->department->name, 'position'=>$worker->work_position->name, 'adopted_at'=>$message->updated_at];
            }else{
                $message = 'You dont permissions';
            }
        }else{
            $message = 'You dont permissions';
        }
        return response()->json([
            "message" => $message
        ], 200);
    }
}
