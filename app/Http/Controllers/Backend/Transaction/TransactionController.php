<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\AditionalMember;
use App\Http\Controllers\Controller;
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
        
        $usersCosting = collect();
       
        foreach ($users as $user) {
            $add_amount = $user->transactions->sum('add_amount');
            $user->cost_amount = $user->transactions->sum('cost_amount');
            $user->add_amount = $add_amount;

            //* Rooms
            $user->single_rooms = $user->additinalMembers->sum('single_room') + ($user->single_room ? 1 : 0);
            $user->couple_rooms = $user->additinalMembers->sum('couple_room') + ($user->couple_room ? 1 : 0);

        }
        
        

         // $transactions = Transaction::whereNotNull('additional_cost_user')
        // ->with('costUsers.additinalMembers')
        // ->get()->groupBy('additional_cost_user');
        // foreach($transactions as $item){
        //     $add_amount = $item->flatten()->sum('add_amount');
        //     $cost_amount = $item->flatten()->sum('cost_amount');
        //     $single_room = $item->flatten()->pluck('costUsers.additinalMembers')->flatten()->unique('id')->sum('single_room');
        //     $couple_room = $item->flatten()->pluck('costUsers.additinalMembers')->flatten()->unique('id')->sum('couple_room');
        //     $costUser = $item->flatten()->pluck('costUsers')->unique('id')->first();
        //     $usersCosting->push(compact('add_amount', 'cost_amount', 'single_room', 'couple_room','costUser'));
        // }
        
        // dd($usersCosting);


        // $summedCosts = Transaction::whereNotNull('additional_cost_user')
        // ->selectRaw("additional_cost_user")
        // ->selectRaw('COUNT(additional_cost_user) as count')
        // ->selectRaw('SUM(cost_amount) as total_cost')
        // ->selectRaw('SUM(add_amount) as total_add_amount')
        // ->groupBy('additional_cost_user')
        // ->get();


         // Fetch and sum single_room and couple_room for AditionalMember grouped by user_id
        //  $roomCosts = AditionalMember::with('transaction')->selectRaw('user_id')
        //  ->selectRaw('SUM(single_room) as total_single_room')
        //  ->selectRaw('SUM(couple_room) as total_couple_room')
        //  ->groupBy('user_id')
        //  ->get()
        //  ->keyBy('user_id'); 

        // dd($summedCosts);

        // $users = User::whereIn('id', $summedCosts->pluck('additional_cost_user'))->get()->keyBy('id');

        return view('backend.individualCost.individual', compact('users'));
    }


    
}
