<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
    public function index($id)
    {
        $comments = Comment::where('issue_id',$id)->get();
        return view('Comments.index',compact('comments'));
    }

    public function store()
    {
        $data = Input::all();
        $results = Comment::create($data);

        if ($results) {
            return Redirect::back()->with('success', 'Comment Successfully Created');
        } else {
            return Redirect::back()->with('error', 'Failed to add Comment');
        }

    }

    public function edit($id)
    {
        $Comment = Comment::find($id);
        return view('Comments.edit', compact('Comment'));

    }

    public function show($id)
    {
        $Comment = Comment::find($id);
        return view('Comments.show', compact('Comment'));
    }


    public function update()
    {
        $data = Input::all();

        $Comment = Comment::find($data['comment_id']);

        $Comment->update($data);
        if ($Comment) {
            return Redirect::back()->with('success', 'Comment Successfully Created');
        } else {
            return Redirect::back()->with('error', 'Failed to add Comment');
        }
    }
        public
        function destroy($id)
        {
            $Comment = Comment::find($id);
            $Comment->delete();

            return Redirect::back()->with('success', 'Comment Successfully Deleted');
        }

}