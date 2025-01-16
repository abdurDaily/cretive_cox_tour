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
        
        // Guest t-shirt sizes
        $guestMSize = AditionalMember::sum('m_size');
        $guestLSize = AditionalMember::sum('l_size');
        $guestXLSize = AditionalMember::sum('xl_size');
        $guestXXLSize = AditionalMember::sum('xxl_size');
    
        // User t-shirt sizes
        $userMSize = User::sum('m_size');
        $userLSize = User::sum('l_size');
        $userXLSize = User::sum('xl_size');
        $userXXLSize = User::sum('xxl_size');
    
        // Total t-shirt sizes
        $totalMSize = $guestMSize + $userMSize;
        $totalLSize = $guestLSize + $userLSize;
        $totalXLSize = $guestXLSize + $userXLSize;
        $totalXXLSize = $guestXXLSize + $userXXLSize;
    
        // Total t-shirt amount
        $totalTShirt = $totalMSize + $totalLSize + $totalXLSize + $totalXXLSize;
    
        // Room details
        $couple_room = AditionalMember::sum('couple_room');
        $single_room = AditionalMember::sum('single_room');
        
        // Total members and guests
        $totalMembers = count(User::get());
        $totalGuest = count(AditionalMember::get());
        $totalMembersGuest = $totalGoinMembers  + $totalGuest;
        
        return view('frontend.register.allRegister', compact('allRegisters', 'totalGoinMembers', 'totalMembers', 'totalGuest', 'totalMembersGuest', 'goingMembersDetails', 'notgoingMembersDetails', 'GuestDetails','couple_room','single_room', 'totalMSize', 'totalLSize', 'totalXLSize', 'totalXXLSize', 'totalTShirt'));
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
