<?php

namespace App\Http\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Validator;

class AdminAuthServices
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function authenticate($request)
    {
        $validate = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ]);

        if ($validate->fails()) {
            return redirect()->route('admin.login')->with('error', $validate->errors()->first());
        }


        if ($validate->passes()) {
            if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
                if (auth()->user()->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('admin.login')->with('error', 'You are not an authenticated person to access this site.');
                }
            } else { 
                dd(auth()->user());
                return redirect()->route('admin.login')->with('error', 'Email or Password is incorrect');
            }
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }

}
