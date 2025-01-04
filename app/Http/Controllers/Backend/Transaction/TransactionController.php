<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactionIndex(){
        return view('backend.transaction.store');
    }


    
    public function transactionStore(Request $request){
        $storeTransport = new Transaction();
        $storeTransport->transaction_name = $request->transaction_name;
        $storeTransport->transaction_amount = $request->transaction_amount; 
        $storeTransport->save();
    }


    public function viewtransaction(){
        $transactions = Transaction::get();
        $totalTransaction = Transaction::sum('transaction_amount');
        // dd($totalTransaction);
        return view('frontend.transaction.allTransaction', compact('transactions','totalTransaction'));
    }
}
