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
        $user = User::with('transactions','additinalMembers')->find($id);
        // Check if additionalMembers exists and is not null

        // dd($user);

        if ($user->additinalMembers) {
            // Calculate the total size
            $totalSize = $user->additinalMembers->sum('m_size') +
                         $user->additinalMembers->sum('l_size') +
                         $user->additinalMembers->sum('xl_size') +
                         $user->additinalMembers->sum('xxl_size');
        } else {
            $totalSize = 0; 
        }


        return view('backend.individualCost.individualDetails', compact('user','totalSize'));
    }



    //*EDIT INDIVIDUAL DATA 
    public function editIndividualDetails($id){
        $editTransaction = Transaction::with('users')->where('additional_cost_user',$id)->first();
        // dd($editTransaction);
        // $test = User::with('transactions')->first();
        
        $editTransaction = Transaction::with(['users' => function ($query) {
            $query->where('id', 'additional_cost_user');
        }])->first();

        // dd($editTransaction);


        $users = User::get();
        // $user = User::with('transactions','additinalMembers')->find($id);
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
