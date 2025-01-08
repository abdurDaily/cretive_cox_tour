<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function transactionIndex(){
        $users = User::with('transactions')->get();
        // dd($users    );
        return view('backend.transaction.store', compact('users'));
    }


    
    public function transactionStore(Request $request){
        // dd($request->all());
        $storeTransport = new Transaction();
        $storeTransport->auth_user = Auth::user()->name;
        $storeTransport->user_id = Auth::user()->id;
        $storeTransport->additional_cost_user = $request->additional_cost_user;
        $storeTransport->transaction_category = $request->transaction_category;
        $storeTransport->transaction_description = $request->transaction_description;
        $storeTransport->add_amount = $request->add_amount; 
        $storeTransport->cost_amount = $request->cost_amount; 
        $storeTransport->save();
    }


    public function viewtransaction(){
        $transactions = Transaction::get();
        $totalAdd = Transaction::sum('add_amount');
        $totalCost = Transaction::sum('cost_amount');
        $costStatus = $totalAdd - $totalCost ;
        return view('frontend.transaction.allTransaction', compact('transactions', 'totalAdd', 'totalCost','costStatus'));
    }
}
