<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name'];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function work_positions()
    {
        return $this->belongsToMany(WorkPosition::class, 'workers', 'department_id', 'work_position_id');
    }
}
