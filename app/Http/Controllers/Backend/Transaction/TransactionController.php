<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\AditionalMember;
use App\Http\Controllers\Controller;
use App\Models\RoomCost;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function transactionIndex()
    {
        $users = User::with('transactions')->get();
        // dd($users    );
        return view('backend.transaction.store', compact('users'));
    }



    public function transactionStore(Request $request)
    {

        $storeTransport = new Transaction();
        $storeTransport->additional_cost_user = $request->additional_cost_user;
        $storeTransport->auth_user = Auth::user()->name;
        $storeTransport->user_id = Auth::user()->id;
        $storeTransport->transaction_category = $request->transaction_category;
        $storeTransport->transaction_description = $request->transaction_description;
        $storeTransport->add_amount = $request->add_amount;
        $storeTransport->cost_amount = $request->cost_amount;
        $storeTransport->save();
    }


    public function viewtransaction()
    {
        $transactions = Transaction::get();

        // dd($transactions);
        $totalAdd = Transaction::sum('add_amount');
        $totalCost = Transaction::sum('cost_amount');
        $costStatus = $totalAdd - $totalCost;
        return view('frontend.transaction.allTransaction', compact('transactions', 'totalAdd', 'totalCost', 'costStatus'));
    }


    // INDIVIDUAL COSTING 
    public function individualCost()
    {
        $users = User::with('transactions','additinalMembers')->get();
        // dd($users);
        $usersCosting = collect();
       
        foreach ($users as $user) {
            $add_amount = $user->transactions->sum('add_amount');
            $user->cost_amount = $user->transactions->sum('cost_amount');
            $user->add_amount = $add_amount;

            //* Rooms
            $user->single_rooms = $user->additinalMembers->sum('single_room') + ($user->single_room ? 1 : 0);
            $user->couple_rooms = $user->additinalMembers->sum('couple_room') + ($user->couple_room ? 1 : 0);


            
        }
        
        //* INDIVIDUAL ROOM COST 
        $individualRoomCost = RoomCost::select('id','single_room_cost','couple_room_cost')->first();

        // dd($individualRoomCost);
        return view('backend.individualCost.individual', compact('users','individualRoomCost'));
    }



    //* INDIVIDUAL DETAILS 
    public function individualDetails($id){
        // Fetch the user with their transactions and additionalMembers
        $user = User::with('transactions', 'additinalMembers')->find($id);
    
        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User  not found.');
        }
    
        // Initialize sums for each t-shirt size
        $totalM = 0;
        $totalL = 0;
        $totalXL = 0;
        $totalXXL = 0;
    
        // Check if additionalMembers exists and is not null
        if ($user->additinalMembers) {
            // Calculate the total sum for each t-shirt size
            $totalM = $user->additinalMembers->sum('m_size');
            $totalL = $user->additinalMembers->sum('l_size');
            $totalXL = $user->additinalMembers->sum('xl_size');
            $totalXXL = $user->additinalMembers->sum('xxl_size');
        }
    
        // Calculate the total t-shirt size
        $totalTShirt = $totalM + $totalL + $totalXL + $totalXXL;
    
        // Pass the user and t-shirt sums to the view
        return view('backend.individualCost.individualDetails', compact('user', 'totalM', 'totalL', 'totalXL', 'totalXXL', 'totalTShirt'));
    }


    //* EDIT INDIVIDUAL DATA
    public function editIndividualDetails($id)
    {
        // Fetch the transaction to be edited with its associated user
        $editTransaction = Transaction::with('users')->find($id);

        // Fetch all users to populate the dropdown
        $users = User::all();

        // Pass the data to the view
        return view('backend.transaction.editTransaction', compact('editTransaction', 'users'));
    }

    //**UPDATE TRANSACTION  */
    public function updateIndividualDetails(Request $request, $id){
        $updateTransaction = Transaction::find($id);
        $updateTransaction->additional_cost_user = $request->additional_cost_user;
        $updateTransaction->auth_user = Auth::user()->name;
        $updateTransaction->user_id = Auth::user()->id;
        $updateTransaction->transaction_category = $request->transaction_category;
        $updateTransaction->transaction_description = $request->transaction_description;
        $updateTransaction->add_amount = $request->add_amount;
        $updateTransaction->cost_amount = $request->cost_amount;
        $updateTransaction->save();
    }
    
}
