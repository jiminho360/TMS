<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use App\Models\Religion;
use App\Models\UserType;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class YearsController extends Controller
{
    public function index()
    {
        $years = Year::all();
        return view('years.index', compact('years'));
    }

    public function edit($id)
    {
        $year = Year::find($id);

        return view('years.edit', compact('year'));
    }

    public function store()
    {
        $data = Input::all();
        $data['status'] = 0;
        $result = Year::create($data);

        if ($result) {
            return Redirect::back()->with('success', 'Year Successfully Created');
        } else {
            return Redirect::back()->with('errors', 'Sorry An Error Occurred');
        }
    }

    public function update()
    {
        $data = Input::all();

        $year = Year::find($data['year_id']);

        $result = $year->update($data);

        if ($result) {
            return Redirect::back()->with('success', 'Year Successfully Updated');
        } else {
            return Redirect::back()->with('errors', 'Year An Error Occurred');
        }
    }

    public function destroy($id)
    {
        $year = Year::find($id);
        $year->delete();

        return Redirect::back()->with('success', 'Year Successfully Deleted');
    }


    public function activate($id)
    {
        //Deactivating Current Year
        $currentYear  = Year::where('status',1)->first();
        $currentYear->status = 0;
        $currentYear->update();

        //Activating Year
        $year = Year::find($id);
        $year->status = 1;
        $year->update();

        return Redirect::back()->with('success',$year->name.' Successfully Activated');
    }
}
