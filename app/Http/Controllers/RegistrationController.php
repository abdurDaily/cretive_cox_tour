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
        $totalMembers = User::where('is_going', 1)->get();
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
        $totalGoinMembers = count(User::where('is_going', 1)->get());
        $goingMembersDetails = User::where('is_going', 1)->get();
        $notgoingMembersDetails = User::where('is_going', 0)->get();
        $GuestDetails = AditionalMember::with('users')->get();
        
        $m_size = AditionalMember::sum('m_size');
        $l_size = AditionalMember::sum('l_size');
        $xl_size = AditionalMember::sum('xl_size');
        $xxl_size = AditionalMember::sum('xxl_size');


        $couple_room = AditionalMember::sum('couple_room');
        $single_room = AditionalMember::sum('single_room');
        
        $userMSize = User::where('tshirt_size', 'M')->count();
        $userLSize = User::where('tshirt_size', 'L')->count();
        $userXLSize = User::where('tshirt_size', 'XL')->count();
        $userXXLSize = User::where('tshirt_size', 'XXL')->count();
        
        $totalMSize = $m_size + $userMSize;
        $totalLSize = $l_size + $userLSize;
        $totalXLSize = $xl_size + $userXLSize;
        $totalXXLSize = $xxl_size + $userXXLSize;
        $totalTShirt = $totalMSize + $totalLSize + $totalXLSize + $totalXXLSize;


        $totalMembers = count(User::get());
        $totalGuest = count(AditionalMember::get());
        $totalMembersGuest = $totalGoinMembers  + $totalGuest;
        
        return view('frontend.register.allRegister', compact('allRegisters', 'totalGoinMembers', 'totalMembers', 'totalGuest', 'totalMembersGuest', 'goingMembersDetails', 'notgoingMembersDetails', 'GuestDetails','totalMSize','totalLSize','totalXLSize','totalXXLSize', 'totalTShirt','couple_room','single_room'));
    }



    // ADDITIONAL MEMBERS ADD 
    public function additionalMembers(Request $request){

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
