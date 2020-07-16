<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkPosition extends Model
{
    protected $fillable = ['name'];
    
    public function departments()
    {
        return $this->belongsToMany('App\Department');
    }
}
