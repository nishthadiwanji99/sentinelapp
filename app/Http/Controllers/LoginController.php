<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class LoginController extends Controller
{
    public function login(){
        return view('authentication.login');
    }

    public function postLogin(Request $request)
    {
        if(Sentinel::authenticate($request->all())){
            
            $slug = Sentinel::getUser()->roles()->first()->slug;

            if($slug == 'admin')
                return redirect('/earnings');
            elseif($slug == 'manager')
                return redirect('tasks');
        } else
        {
            return redirect()->back()->with(['error' => 'Wrong Credentials.']);
        }

        

        
    }

    public function logout(){
        Sentinel::logout();
        return redirect('/login');
    }
}
