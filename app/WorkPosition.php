<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkPosition extends Model
{
    protected $fillable = ['name'];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'workers', 'work_position_id', 'department_id');
    }
}
