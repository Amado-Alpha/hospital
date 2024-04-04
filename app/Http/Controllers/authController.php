<?php

namespace App\Http\Controllers;

use App\Http\Requests\authenticationRequest;
use App\Http\Requests\passwordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    //Show Attendance Page
    public function loginPage()
    {
        return view('auth.login');
    }

    //authentication page
    public function authentication(authenticationRequest $request)
    {
        $request->validated($request->all());

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard')->with('success', 'welcome! you have been loggen in');
        } else {
            return back()->with('error', 'Invalid crediantial');
        }
    }

    //logout function
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'welcome back!');
    }

    //change password
    public function changePassword(passwordRequest $request)
    {
        $request->validated($request->all());

        if (Hash::check($request->old_password, Auth::user()->password)) {
            if ($request->new_password == $request->confirm_new_password) {
                User::where('id', Auth::user()->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                return back()->with('success', 'Password changed');
            } else {
                return back()->with('error', 'Password did not match!');
            }
        } else {
            return back()->with('error', 'Old Password did not match!');
        }
    }
}
