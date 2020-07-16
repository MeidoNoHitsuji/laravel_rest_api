<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkPosition extends Model
{
    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
