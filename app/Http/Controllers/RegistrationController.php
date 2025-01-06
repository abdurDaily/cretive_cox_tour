<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\AditionalMember;
use App\Models\User;

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
        $allRegisters = User::with('additinalMembers')->get();
        
        return view('frontend.register.allRegister', compact('allRegisters'));
    }



    // ADDITIONAL MEMBERS ADD 
    public function additionalMembers(Request $request){
        // dd($request->all());
      $addAdditionalMembers = new AditionalMember();
      $addAdditionalMembers->name = $request->name;
      $addAdditionalMembers->m_size = $request->m_size;
      $addAdditionalMembers->l_size = $request->l_size;
      $addAdditionalMembers->xl_size = $request->xl_size;
      $addAdditionalMembers->xxl_size = $request->xxl_size;
      $addAdditionalMembers->single_room = $request->single_room;
      $addAdditionalMembers->couple_room = $request->couple_room;
      $addAdditionalMembers->save();
      return redirect()->route('home')->with('success','additional members added successfully!');
    }
}
