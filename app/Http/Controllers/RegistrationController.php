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

        // dd($request->all());
       
        $registerData = new Registration();
        $registerData->name = $request->name;
        $registerData->email = $request->email;
        $registerData->phone = $request->phone;
        $registerData->tshirt_size = $request->tshirt_size;
        $registerData->status = $request->status;
        $registerData->number_of_people = $request->number_of_people;
        $registerData->opinion = $request->opinion;
        $registerData->save();
        // return view('welcome');
    }

    public function viewRegistrations()
    {
        $allRegisters = Registration::get();
        return view('frontend.register.allRegister', compact('allRegisters'));
    }
}
