<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function work_positions()
    {
        return $this->belongsToMany('App\WorkPosition');
    }
}
