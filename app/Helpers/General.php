<?php


namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class General
{
    public static function processMail($result)
    {
        $user = User::find($result->user_id);
        if (!$user) {
            return Redirect::back()->with('errors','User Does not Exist');
        }

        self::sendEmail($user,$result);

//        if($send_mail){
            return Redirect::back()->with('success','Mail Successfully Sent to '.$user->email);
//        }
//        return Redirect::back()->with('errors','Failed to Send Mail Please Try Again Later!');
    }

    private static function sendEmail($user,$task_data)
    {
        Mail::send('email_notification', ['user' => $user,'task' => $task_data], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->first_name");
        });
    }
}
