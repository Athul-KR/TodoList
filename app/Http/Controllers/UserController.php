<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //User Registration

    protected function create()
    {
        return view('users.usercreate');
    }

    // Save the data from the user fields

    protected function save()
    {
        request()->validate([
            'name' => 'required|max:255', // Name is required and should not exceed 255 characters
            'phone' => 'required|numeric|digits:10', // Phone number is required and should be exactly 10 digits
            'password' => 'required|min:6|confirmed', // PAssword is required and should be at least 6 characters long
            'password_confirmation' => 'required', //PAssword is requird and should be same as password
        ], [], [
            'password_confirmation' => 'confirm password', // Custom attribute name

        ]);


        User::create(request(['name', 'phone', 'password']));
        return redirect()->route('user.login')->with('message', 'Account Created Successfully. Please Login!');

        // DB::enableQueryLog();
        // Check the query log
        // dd(DB::getQueryLog());

        // $user = User::create([
        //     'name' => request('name'),
        //     'phone' => Hash::make(request('password')),
        //     'password' => Hash::make(request('password')),
        // ]);
        // return $user['password'];
    }


    //User Login

    protected function login()
    {
        return view('users.userlogin');
    }
}
