<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Sentinel;
use Activation;

class ActivationController extends Controller
{
    public function activate($email, $activationCode)
    {
        $user = User::whereEmail($email)->first();
        $sentinelUser=Sentinel::findById($user->id);
        if(Activation::complete($sentinelser, $activationCode))
        {
            return redirect('/login');
        } 
        // else
        // {

        // }
    }
}
