<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use softDeletes;

    public $guarded = ['input_date', 'task_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function assigner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function percentageDone($task_id)
    {
        $total_sub_task = EsubTask::where('task_id', $task_id)->get()->count();
        $completed_sub_task = EsubTask::where([['task_id', $task_id], ['status', 'Done']])->get()->count();
        $task_status = Task::find($task_id);
        if ($total_sub_task > 0) {
            return ($completed_sub_task / $total_sub_task) * 100;
        } elseif (($total_sub_task == 0) AND ($task_status->Status == 1)) {
            return 100;
        } else {
            return 0;
        }
    }

    public static function countByDeptId($deptId)
    {
        return self::where('department_id', $deptId)->get()->count();
    }

    public static function countCompleteByDeptId($deptId)
    {
        return self::where([['department_id', $deptId], ['status', 1]])->get()->count();
    }

    public static function countInCompleteByDeptId($deptId)
    {
        return self::where([['department_id', $deptId], ['status', 0]])->get()->count();
    }

    public static function percentageByDeptId($deptId)
    {
        $total = self::countByDeptId($deptId);
        $complete = self::countCompleteByDeptId($deptId);

        return $complete > 0 ? ($complete / $total) * 100 : 0;
    }

    public static function countByUserId($user_id)
    {
        return self::where('user_id', $user_id)->get()->count();
    }

    public static function countCompleteByUserId($user_id)
    {
        return self::where([['user_id', $user_id], ['status', 1]])->get()->count();
    }

    public static function countInCompleteByUserId($user_id)
    {
        return self::where([['user_id', $user_id], ['status', 0]])->get()->count();
    }

    public static function percentageByUserId($user_id)
    {
        $total = self::countByUserId($user_id);
        $complete = self::countCompleteByUserId($user_id);

        return $complete > 0 ? ($complete / $total) * 100 : 0;
    }

    public static function completeTaskByMonth($user_id,$month,$year)
    {
        return self::where([['user_id', $user_id], ['status', 1]])->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)->get()->count();
    }
    public static function inCompleteTaskByMonth($user_id,$month,$year)
    {
        return self::where([['user_id', $user_id], ['status', 0]])->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)->get()->count();
    }
    public static function TaskByMonth($user_id,$month,$year)
    {
        return self::where('user_id', $user_id)->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)->get()->count();
    }
}
