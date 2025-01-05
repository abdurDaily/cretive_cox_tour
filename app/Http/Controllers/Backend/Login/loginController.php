<?php

namespace App\Http\Controllers\Backend\Login;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    //loginIndex
    public function loginIndex(){
        return view('frontend.login.login');
    }


    public function authCheck(Request $request){
        $email = $request->email;
        $password = $request->password;
        $user = Registration::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            return view('frontend.userDashboard.userDashboard');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }
}
