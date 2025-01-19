<?php
namespace App\Http\Controllers\Backend\EditUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditUserController extends Controller
{
    public function editUserIndex($id)
    {
        $editUser = User::find($id);
        return view('backend.editUserData.editUser', compact('editUser'));
    }


    public function updateUser(Request $request, $id)
{
    $user = User::find($id);
    
    // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'required|numeric',
        'is_going' => 'required|boolean',
        'additional_members' => 'nullable|numeric',
        'm_size' => 'nullable|numeric',
        'l_size' => 'nullable|numeric',
        'xl_size' => 'nullable|numeric',
        'xxl_size' => 'nullable|numeric',
        'single_room' => 'nullable|numeric',
        'couple_room' => 'nullable|numeric',
        'opinion' => 'nullable|string',
        'password' => 'nullable|confirmed|min:6',  // Validation for password
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->is_going = $request->is_going;
    $user->additional_members = $request->additional_members;
    $user->m_size = $request->m_size;
    $user->l_size = $request->l_size;
    $user->xl_size = $request->xl_size;
    $user->xxl_size = $request->xxl_size;
    $user->single_room = $request->single_room;
    $user->couple_room = $request->couple_room;
    $user->opinion = $request->opinion;

    // Update password only if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);  // Hash the new password before saving
    }

    $user->save();

    return redirect()->route('dashboard');
}

}
