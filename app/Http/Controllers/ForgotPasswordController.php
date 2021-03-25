<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Reminder;
use Sentinel;
use Mail;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('authentication.forgot-password');
    }

    public function postForgotPassword(Request $request)
    {
        // $user = User::whereEmail($request->email)->first();

        // $sentineluser=Sentinel::findById($user->id);

        // // if(count($user)==0)
        // //     return redirect()->back()->with([
        // //         'success' => 'Reset code was sent to your email.'
        // //     ]);
        // $reminder = Reminder::exists($sentineluser) ?: Reminder::create($sentineluser);

        // $this->sendEmailForForgetPassword($user, $reminder->code);

        // return redirect()->back()->with([
        //     'success' => 'Reset code was sent to your email.'
        // ]);

        $user=User::whereEmail($request->email)->first() ;
        $sentineluser=Sentinel::findById($user->id);
        $reminder=Reminder::exists($sentineluser)?:Reminder::create($sentineluser);
        $this->sendEmail($user,$reminder->code);
        return redirect()->back()->with(['success'=>'Your password has been successfully sent to your email address.']);
    }

    private function sendEmail($user, $code)
    {
        Mail::send('emails.forgot-password', [
            'user' => $user,
            'code' => $code
        ], function ($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello $user->first_name, reset your password.");
        });
    }

    public function resetPassword($email, $resetCode)
    {
        $user = User::byEmail($email);

        $sentineluser=Sentinel::findById($user->id);
        if($reminder=Reminder::exists($sentineluser)){
            if($resetCode == $reminder->code)
                return view('authentication.reset-Password');
            else 
                return redirect('/');
        } else{
            return 0;
        }
        return $user;
    }
}
