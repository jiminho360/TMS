<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        $dept_id = Department::all();
        $roles = Role::all();

        return view('Users.index', compact('users', 'dept_id', 'roles'));
    }

    public function store()
    {

        $data = Input::all();
        $data['password'] = Hash::make('12345');
        $results = User::create($data);
        if ($results) {
            $role['user_id'] = $results->id;
            $role['role_id']= $data['role_id'];
            RoleUser::create($role);
            return Redirect::back()->with('success', 'User Successfully Created');
        } else {
            return Redirect::back()->with('error', 'Failed to create User');
        }

    }

    public function edit($id)
    {
        $params['departments'] = Department::all();
        $params['roles'] = Role::orderBy('name')->get();
        $params['user'] = User::find($id);
        $params['selected_role'] = RoleUser::where('user_id',$params['user']->id)->first()->role_id;

        return view('Users.edit', $params);
    }

    public function update()
    {
        $data = Input::all();

        $user = User::find($data['user_id']);

        $result = $user->update($data);

        if ($result) {
            $isExist = RoleUser::where([['user_id', $user->id], ['role_id', $data['role_id']]])->first();
            if (!$isExist) {
                $role['user_id'] = $user->id;
                $role['role_id'] = $data['role_id'];
                RoleUser::create($role);
            } else {
                $isExist->role_id = $data['role_id'];
                $isExist->update();
            }

            return Redirect::back()->with('success', 'User Successfully Updated');
        } else {
            return Redirect::back()->with('errors', 'Sorry An Error Occurred');
        }
    }

    public function ChangePasswordIndex()
    {
        return view('ChangePassword.index');
    }

    public function ChangePassword()
    {
        $data = Input::all();

        $user_id = Auth::user()->getAuthIdentifier();

        $user = User::find($user_id);

        if ($user->password = Hash::make($data['old_password'])) {
            $user->password = Hash::make($data['new_password']);
            $user->update();
            return Redirect::back()->with('success', 'Password Successfully Updated');
        }
        return Redirect::back()->with('errors', 'The old Password does not exist');

    }

    public function profile()
    {
        return view('Profile.index', array('user' => Auth::user()));
    }

    public function update_avatar(Request $request){

        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            $user =Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('Profile.index', array('user' => Auth::user()))->
        with('success', 'Image Successfully Updated');    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return Redirect::back()->with('success', 'User Successfully Deleted');
    }

}
