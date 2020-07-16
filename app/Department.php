<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name'];

    public function work_positions()
    {
        return $this->belongsToMany(WorkPosition::class);
    }
}
