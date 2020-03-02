<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Comment;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    public function index()
    {
        $params['tasks'] = Task::where('user_id', auth()->user()->id)->get();
        return view('Tasks.Employee.index', $params);
    }

    public function comment($id)
    {
        $comments = Comment::where('issue_id', $id)->get();
        return view('Tasks.Employee.comm', compact('comments'));
    }

    public function comment_load($id)
    {
        $params['assign_to'] = Task::find($id)->created_by;
        $params['task_id'] = $id;
        return view('Tasks.Employee.comment_view', $params);
    }

    public function post_comment()
    {
        $data = Input::all();
        $results = Comment::create($data);
        if ($results) {
            return Redirect::back()->with('success', 'Comment Successfully Created');
        } else {
            return Redirect::back()->with('error', 'Failed to Comment Task');
        }
    }

    public function subTaskLoad($id)
    {
        $comments = Comment::where('issue_id', $id)->get();
        return view('Tasks.Employee.comm', compact('comments'));
    }

}
