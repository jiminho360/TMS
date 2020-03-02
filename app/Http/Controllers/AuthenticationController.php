<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class AuthenticationController extends Controller
{
    public function loginIndex()
    {
        $params['errorMsg'] = "";
        return view('Login',$params);
    }

    public function Login()
    {
        $data = Input::all();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect()->action('HomeController@home');
        } else {
            $params['errorMsg'] = "Wrong Email or Password";
            return view('Login',$params);
        }

    }
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
}
