<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkPosition extends Model
{
    public function departments()
    {
        return $this->belongsToMany('App\Department');
    }
}
