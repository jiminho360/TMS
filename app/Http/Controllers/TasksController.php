<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Models\Department;
use App\Models\EsubTask;
use App\Models\subtask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class TasksController extends Controller
{
    public function index()
    {
        $params['responsibles'] = User::all();
        $params['tasks'] = Task::where('created_by', auth()->user()->id)->get();
        return view('Tasks.index', $params);
    }

    public function Supervisor()
    {
        $params['departments'] = Department::all();

        $params['tasks'] = Task::where('created_by', auth()->user()->id)->get();

        $params['priorities'] = [['name' => 'High'], ['name' => 'Medium'], ['name' => 'Low']];

        return view('Tasks.User.AllTasks.AllTasks', $params);
    }

    public function SupervisorTasks()
    {
        $params['tasks'] = Task::where('user_id', auth()->user()->id)->get();
        return view('Tasks.User.MyTasks.AllTasks', $params);
    }

    public function AllCompleted()
    {
        $params['user_id'] = auth()->user()->id;
        $params['tasks'] = Task::where([['created_by', $params['user_id']], ['status', 1]])->get();
        return view('Tasks.User.AllTasks.Complete', $params);
    }

    public function AllNotCompleted()
    {
        $params['user_id'] = auth()->user()->id;
        $params['ntasks'] = Task::where([['created_by', $params['user_id']], ['status', 0]])->get();
        return view('Tasks.User.AllTasks.InComplete', $params);
    }

    public function Completed()
    {
        $params['user_id'] = auth()->user()->id;
        $params['tasks'] = Task::where([['user_id', $params['user_id']], ['status', 1]])->get();
        return view('Tasks.User.MyTasks.Complete', $params);
    }

    public function NotCompleted()
    {
        $params['user_id'] = auth()->user()->id;
        $params['ntasks'] = Task::where([['user_id', $params['user_id']], ['status', 0]])->get();
        return view('Tasks.User.MyTasks.InComplete', $params);
    }

    public function TasksAssign()
    {
        $params['user_id'] = Auth::user();
        $params['Tasks'] = count(Task::where('created_by', auth()->user()->id)->get());
        $params['done'] = Task::where([['created_by', $params['user_id']], ['status', 1]])->get()->count();
        $params['notdone'] = Task::where([['created_by', $params['user_id']], ['status', 0]])->get()->count();
        return view('Dashboard.taskAssign', $params);
    }


    public function Progress()
    {
        $params['departments'] = Department::all();

        $params['tasks'] = Task::all();

        $params['priorities'] = [['name' => 'High'], ['name' => 'Medium'], ['name' => 'Low']];
        return view('Progress.index', $params);
    }

    public function edit($id)
    {
        $params['departments'] = Department::all();
        $params['task'] = Task::find($id);
        $params['priorities'] = [['name' => 'High'], ['name' => 'Medium'], ['name' => 'Low']];
        $params['users'] = User::where('department_id', $params['task']->department_id)->get();

        return view('Tasks.HOD.edit', $params);
    }

    public function update()
    {
        $data = Input::all();
        $task = Task::find($data['task_id']);
        $task->update($data);
        return Redirect::back()->with('success', 'Data Successfully Updated');
    }

    public function store()
    {
        $data = Input::all();
        $data['input_date'] = date('Y-m-d');
        $data['created_by'] = auth()->user()->id;

        $results = Task::create($data);
        if ($results) {
            General::processMail($results);
            return Redirect::back()->with('success', 'Task Successfully Created');
        } else {
            return Redirect::back()->with('error', 'Failed to create Task');
        }

    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return Redirect::back()->with('success', 'Task Successfully Deleted');
    }

    public function activate($id)
    {
        //Approve Task
        $task = Task::find($id);
        $SubTask = EsubTask::where('task_id', $id)->get()->count();
        if($SubTask>0)
        {
            $subtasks = EsubTask::where([['task_id', $id],['Status','Not Done']])->get()->count();
            if($subtasks == 0){
                $task->Status = 1;
                $task->update();
                return Redirect::back()->with('success', $task->name . ' Successfully Approved');
            }else{
                return Redirect::back()->with('errors', $task->name .' Can not be Approved, there are unfinished Subtasks');
            }
        }
        else{
            $task->Status = 1;
            $task->update();
            return Redirect::back()->with('success', $task->name . ' Successfully Approved');
        }

    }

    public function Subtask($id)
    {
        $params['subtasks'] = subtask::where('task_id', $id)->get();

        $params['task_id'] = $id;

        return view('Tasks.SubTask.index', $params);
    }

    public function deleteAll()
    {
        $user_id = auth()->user()->id;
        $task_array = Task::where('created_by',$user_id)->pluck('id')->toArray();
        //Deleting Subtask associated with the deleted task
        DB::table('e_sub_task')->whereIn('task_id',$task_array)->delete();
//Deleting Comments associated with the deleted task
        DB::table('comments')->whereIn('task_id',$task_array)->delete();
//Deleting the tasks
        DB::table('tasks')->where('created_by',$user_id)->delete();


        return Redirect::back()->with('success','All Tasks Successfully Deleted');
    }



}
