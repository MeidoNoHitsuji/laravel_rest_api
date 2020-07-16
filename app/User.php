<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'name', 'email', 'image', 'about', 'type', 'github', 'city', 'is_finished', 'phone', 'birthday', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function isAdmin(){
        return $this->role>=2;
    }

    public function isWorker(){
        return $this->role==1;
    }

    public function setWorker(Department $departament, WorkPosition $position){ //Ужаснейшая реализация задумки, но с логической стороны, что каждый пользователь может быть только определённым работником, смотрится логично.. Вроде..
        $w = new Worker();
        $w->department_id = $departament->id;
        $w->work_position_id = $position->id;
        $w->save();
        
        $w = Worker::find(1);
        
        $this->worker()->associate($w);
        $this->role=1;
        $this->save();
    }

}
