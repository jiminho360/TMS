<?php

namespace App\Http\Controllers\Tasks;

use App\Models\EsubTask;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class EsubTaskController extends Controller
{
    public function index($id)
    {
        $params['subtasks'] = EsubTask::where('task_id', $id)->get();

        $params['task_id'] = $id;

        $params['task_name'] = Task::find($id)->name;

        if (count($params['subtasks']) > 0) {
            $params['percent'] = 100 / count($params['subtasks']);
        } else {
            $params['percent'] = 0;
        }

        return view('Tasks.employee_sub_task.index', $params);
    }

    public function store()
    {
        $data = Input::all();
        $results = EsubTask::create($data);
        if ($results) {
            return Redirect::back()->with('success', 'Sub Task Successfully Created');
        } else {
            return Redirect::back()->with('error', 'Failed to create Sub Task');
        }

    }

    public function edit($id)
    {
        $params['subtask'] = EsubTask::find($id);
        return view('Tasks.employee_sub_task.edit', $params);
    }

    public function update()
    {
        $data = Input::all();
        $subtask = EsubTask::find($data['subtask_id']);
        $subtask->update($data);

        return Redirect::back()->with('success', 'Sub Task Successfully Updated');
    }

    public function destroy($id)
    {
        $subtask = EsubTask::find($id);
        $subtask->delete();
        return Redirect::back()->with('success', 'Sub Task Successfully Deleted');
    }

    public function approve($id)
    {
        $New = EsubTask::find($id);
        $New->Status = 'Done';
        $New->update();
        return Redirect::back()->with('success', 'Task Successfully Done');
    }

    public function remove($id)
    {
        $subtask = EsubTask::find($id);
        $subtask->delete();
        return Redirect::back()->with('success', 'Sub Task Successfully Removed');
    }

}
