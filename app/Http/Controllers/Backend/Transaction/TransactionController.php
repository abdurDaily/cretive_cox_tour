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

        $users = User::has('transactions')->get();
        dd($users);

        $summedCosts = Transaction::whereNotNull('additional_cost_user')
        ->selectRaw("additional_cost_user")
        ->selectRaw('COUNT(additional_cost_user) as count')
        ->selectRaw('SUM(cost_amount) as total_cost')
        ->selectRaw('SUM(add_amount) as total_add_amount')
        ->groupBy('additional_cost_user')
        ->get();


         // Fetch and sum single_room and couple_room for AditionalMember grouped by user_id
         $roomCosts = AditionalMember::with('transaction')->selectRaw('user_id')
         ->selectRaw('SUM(single_room) as total_single_room')
         ->selectRaw('SUM(couple_room) as total_couple_room')
         ->groupBy('user_id')
         ->get()
         ->keyBy('user_id'); 

        dd($summedCosts);

        $users = User::whereIn('id', $summedCosts->pluck('additional_cost_user'))->get()->keyBy('id');

        return view('backend.individualCost.individual', compact('summedCosts', 'users'));
    }


    
}
