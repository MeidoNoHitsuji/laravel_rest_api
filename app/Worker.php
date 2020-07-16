<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{

    protected $hidden = [
        'user_id', 'created_at', 'updated_at'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function work_position()
    {
        return $this->belongsTo(WorkPosition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
