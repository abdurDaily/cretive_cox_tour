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
        $addAdditionalMembers->user_id = Auth::user()->id;
        $addAdditionalMembers->auth_email = Auth::user()->email;
        $addAdditionalMembers->m_size = $request->m_size;
        $addAdditionalMembers->l_size = $request->l_size;
        $addAdditionalMembers->xl_size = $request->xl_size;
        $addAdditionalMembers->xxl_size = $request->xxl_size;
        $addAdditionalMembers->single_room = $request->single_room;
        $addAdditionalMembers->couple_room = $request->couple_room;
        $addAdditionalMembers->save();
        return redirect()->route('dashboard')->with('success','additional members added successfully!');
      }



    //   EDIT ADDITIONALL MEMBER
    public function editMember($id){
        $editMember = AditionalMember::find($id);
        // dd($editMember);
        return view('backend.AddMembers.editAdditionalMember', compact('editMember'));
    }



    //*update additional member 
    public function updateMember(Request $request, $id){
        // dd($request->all());
        $editMember = AditionalMember::find($id);
        $editMember->name = $request->name;
        $editMember->user_id = Auth::user()->id;
        $editMember->auth_email = Auth::user()->email;
        $editMember->m_size = $request->m_size;
        $editMember->l_size = $request->l_size;
        $editMember->xl_size = $request->xl_size;
        $editMember->xxl_size = $request->xxl_size;
        $editMember->single_room = $request->single_room;
        $editMember->couple_room = $request->couple_room;
        $editMember->save();
        return redirect()->route('dashboard')->with('success','additional members update successfully!');
    }
}
