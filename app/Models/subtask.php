<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class subtask extends Model
{
    use SoftDeletes;
public $guarded = ['subtask_id'];
protected $table = 'subtask';

    public function Task()
    {
        return $this->belongsTo(Task::class,'task_id');
    }
}
