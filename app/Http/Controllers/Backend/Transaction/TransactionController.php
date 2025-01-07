<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function transactionIndex(){
        return view('backend.transaction.store');
    }


    
    public function transactionStore(Request $request){
        $storeTransport = new Transaction();
        $storeTransport->auth_user = Auth::user()->name;
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
