<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('Departments.index', compact('departments'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $data = Input::all();
        $results = Department::create($data);
        if ($results) {
            return Redirect::back()->with('success', 'Department Successfully Created');
        } else {
            return Redirect::back()->with('error', 'Failed to create Department');
        }
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('Departments.edit', compact('department'));

    }

    public function update()
    {
        $data = Input::all();

        $dept = Department::find($data['department_id']);

        $result = $dept->update($data);

        if ($result) {
            return Redirect::back()->with('success', 'Department Successfully Updated');
        } else {
            return Redirect::back()->with('errors', 'Sorry An Error Occurred');
        }
    }

    public function destroy($id)
    {
        $dept = Department::find($id);
        $dept->delete();

        return Redirect::back()->with('success', 'Department Successfully Deleted');
    }

    public function getUsers(Request $request)
    {
        $department = DB::table("users")
            ->select("id", DB::raw("CONCAT(first_name, ' ',middle_name,' ',last_name) as name"))
            ->where("department_id", $request->department_id)
            ->pluck("name", "id");
        return json_encode($department);
    }

}