<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Department;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskTypeController extends Controller
{
    public function index(){
        $departs  = Department::all();
        return view('TaskTypes.User.index',compact('departs'));
    }

    public function viewed(){
        $departs  = Department::all();
$tasks = Task::all();
        $priorities = [['name'=>'High'],['name'=>'Medium'],['name'=>'Low']];

        return view('Tasks.User.dashboard',compact('departs','tasks','priorities'));

    }
}
