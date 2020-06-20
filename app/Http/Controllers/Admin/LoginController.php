<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

            return redirect()->intended('admin/home');

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        else {
            $credentials = $request->only('email', 'password');
            // return redirect()->intended('admin/home');
            if (Auth::attempt($credentials)) {
                return redirect()->intended('admin/home');
            } else {
                return redirect()->back()->withInput()->withErrors($validator);
            }

        }

        

        

        



        // if ($validator->fails()) {
        //     return redirect()->back()->withInput()->withErrors(['auth' =>  'Please fill in required fields']);
        // } else {
        //     $credentials = $request->only('email', 'password');
        //     if (Auth::attempt($credentials)) {
        //         return redirect()->intended('home');
        //     } else {
        //         return redirect()->back()->withInput()->withErrors(['auth' => 'Incorrect Email or Password']);
        //     }
        // }

        
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }
}
