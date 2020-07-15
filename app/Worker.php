<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    public function department()
    {
        return $this->hasOne('App\Department');
    }

    public function work_position()
    {
        return $this->hasOne('App\WorkPosition');
    }
}
