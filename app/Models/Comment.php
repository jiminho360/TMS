<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use softDeletes;
    public $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function Task(){
        return $this->belongsTo(Task::class,'task_id');
    }
    public function Assigned(){
    return $this->belongsTo(User::class,'assigned_to');
}
    public function comms(){
        return $this->belongsTo('Comments');
    }
}
