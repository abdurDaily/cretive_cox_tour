<?php

namespace App\Http\Controllers\Backend\AdditionalMember;

use Illuminate\Http\Request;
use App\Models\AditionalMember;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdditionalController extends Controller
{
    public function additionalIndex(){
        return view('backend.AddMembers.additional');
    }

     // ADDITIONAL MEMBERS ADD 
     public function storeMembers(Request $request){
        $addAdditionalMembers = new AditionalMember();
        $addAdditionalMembers->name = $request->name;
        $addAdditionalMembers->user = Auth::user()->id;
        $addAdditionalMembers->auth_email = Auth::user()->email;
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
