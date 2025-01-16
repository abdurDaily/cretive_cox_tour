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


    public function individualCost()
    {
        // Fetch the authenticated user
        $authUser = Auth::user();
    
        // Check if the authenticated user's status is 1
        if ($authUser->status == 1) {
            // Fetch all users with their transactions and additionalMembers
            $users = User::with('transactions', 'additinalMembers')->get();
        } else {
            // Fetch only the authenticated user's record
            $users = User::with('transactions', 'additinalMembers')
                ->where('id', $authUser->id) // Filter by the authenticated user's ID
                ->get();
        }
    
        foreach ($users as $user) {
            $user->cost_amount = $user->transactions->sum('cost_amount');
            $user->add_amount = $user->transactions->sum('add_amount');
    
            // Office contributions
            $user->officeAddAmount = $user->transactions->filter(function ($transaction) {
                return $transaction->transaction_category == 'office';
            })->sum('add_amount');
    
            // Specific categories
            $user->foodCost = $user->transactions->filter(function ($transaction) {
                return $transaction->transaction_category == 'food';
            })->sum('add_amount');
    
            $user->transportationCost = $user->transactions->filter(function ($transaction) {
                return $transaction->transaction_category == 'transportation';
            })->sum('add_amount');
    
            $user->personalCost = $user->transactions->filter(function ($transaction) {
                return $transaction->transaction_category == 'personal cost';
            })->sum('add_amount');
    
            $user->otherCost = $user->transactions->filter(function ($transaction) {
                return $transaction->transaction_category == 'others';
            })->sum('add_amount');
        }
    
        //* INDIVIDUAL ROOM COST
        $individualRoomCost = RoomCost::select('id', 'single_room_cost', 'couple_room_cost', 't_shirt_price')->first();
    
        $totalOfficeAddAmount = $users->sum(function ($user) {
            return $user->transactions->filter(function ($transaction) {
                return $transaction->transaction_category == 'office';
            })->sum('add_amount');
        });
    
        $officeProvided = Transaction::where('transaction_category', 'office')->sum('add_amount');
        // dd($officeProvided);
        $totalUsers = count(User::get());
    
        return view('backend.individualCost.individual', compact('users', 'individualRoomCost', 'officeProvided', 'totalUsers'));
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
    public function updateIndividualDetails(Request $request, $id)
    {
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
