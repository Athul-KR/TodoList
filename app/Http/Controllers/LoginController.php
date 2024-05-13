<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    protected function login()
    {
        return view('users.userlogin');
    }

    protected function do_login()
    {

        request()->validate([
            'phone' => 'required|numeric', // Phone number is required and should be exactly 10 digits
            'password' => 'required', // PAssword is required and should be at least 6 characters long
        ]);
        if (auth()->attempt(request(['phone', 'password']))) {
            return redirect()->route('project.list');
        } else {
            return redirect()->route('user.login')->with('message', 'Invalid Credentials!');
        }
    }

    protected function logout()
    {
        auth()->logout();
        return redirect()->route('user.login');
    }
}
