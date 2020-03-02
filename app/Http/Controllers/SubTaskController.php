<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\subtask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class SubTaskController extends Controller
{
    public function index($id){
        $params['subtasks'] = subtask::where('task_id',$id)->get();

        $params['task_id'] = $id;

        return view('Tasks.SubTask.index',$params);
    }

    public function store()
    {
        $data = Input::all();
        $results = subtask::create($data);
        if ($results) {
            return Redirect::back()->with('success', 'Sub Task Successfully Created');
        } else {
            return Redirect::back()->with('error', 'Failed to create Sub Task');
        }

    }
    public function edit($id){
        $params['subtask'] = subtask::find($id);
        return view('Tasks.SubTask.edit',$params);
    }

    public function update(){
        $data = Input::all();
        $subtask = subtask::find($data['subtask_id']);
        $subtask->update($data);

        return Redirect::back()->with('success', 'Sub Task Successfully Updated');
    }

    public function destroy($id){
        $subtask  = subtask::find($id);
        $subtask->delete();
        return Redirect::back()->with('success','Sub Task Successfully Deleted');
    }
}
