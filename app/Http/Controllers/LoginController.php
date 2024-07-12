<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{


    public function login(Request $request)
    {
        //validate the details
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:5|max:12"
        ]);



        $user = UserModel::where('email', '=', $request->input('email'))->first();

        if ($user) {
            //check entered password
            if (Hash::check($request->input('password'), $user->password)) {
                if ($user->roles === 2) {
                    Auth::login($user);
                return redirect()->route('seller-dashboard');
                }

                // here auth login
                Auth::login($user);


                return redirect()->route('users');
            } else {
                //invalid user
                return view('auth.Login')->with('fail', 'Invalid email or password!');
            }
        } else {
            // not register this email
            return view('auth.Login')->with('fail', 'Invalid email or password!');
        }
    }

    public function logout()
    {
        //logout
        Auth::logout();
        if (!Auth::check()) {
            return view('auth.Login');
        }
    }

    public function customerLogin(Request $request)
    {
        if (!Auth::guard('customer')->attempt($request->only('customer_email', 'password'), $request->filled('remember'))) {
            session()->flash('message', 'Invalid Email or Password');
            return redirect()->intended('/flogin');
        } else {
            $x = session()->get('path');
            return redirect()->intended($x);
        }
    }

    public function customerLogout()
    {
        Auth::guard('customer')->logout();
        if (!Auth::guard('customer')->check()) {
            return redirect()->intended('/');
        }
    }
}
