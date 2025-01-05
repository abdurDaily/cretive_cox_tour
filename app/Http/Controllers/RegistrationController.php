<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::all();
        return view('frontend.register.register', compact('registrations'));
    }


    public function store(Request $request)
    {
        $registerData = new Registration();
        $registerData->name = $request->name;
        $registerData->email = $request->email;
        $registerData->password = bcrypt($request->password);
        $registerData->phone = $request->phone;
        $registerData->tshirt_size = $request->tshirt_size;
        $registerData->opinion = $request->opinion;
        $registerData->save();
    }

    public function viewRegistrations()
    {
        $allRegisters = Registration::get();
        return view('frontend.register.allRegister', compact('allRegisters'));
    }
}
