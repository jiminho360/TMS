<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request){
        $username = $request->input();
        $password = $request->input();
        $checklogin = DB::table('user')->where(['Username'=>$username, 'Password'=>$password])->get();

        if(count($checklogin)==1){
           echo "Login successful";
        }
        else{
            echo "Failed to login: Wrong username or password";
        }
    }
}
