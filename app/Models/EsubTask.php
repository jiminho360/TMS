<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EsubTask extends Model
{
    protected $table = 'e_sub_task';

    public $guarded = ['subtask_id'];

    public function Task()
    {
        return $this->belongsTo(Task::class,'task_id');
    }
    public static function CountSubTasks($id){
       return self::where('task_id',$id)->count();
    }
    public static function CountCompletedSubTasks($id){
        return self::where([['task_id',$id],['Status','Done']])->get()->count();
    }
}
