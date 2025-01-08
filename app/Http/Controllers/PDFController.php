<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
   public function transactionPDF(){
      $transactions = Transaction::get();
      $auth_user_transaction = Transaction::with('users')
    ->select('user_id', 'id', 'cost_amount', 'add_amount')
    ->get();


    // Group transactions by user_id and sum amounts
$userTotals = $auth_user_transaction->groupBy('user_id')->map(function ($transactions) {
   return [
       'total_cost_amount' => $transactions->sum('cost_amount'),
       'total_add_amount' => $transactions->sum('add_amount'),
   ];
});

// Display the results
// dd($userTotals);


      $totalAdd = Transaction::sum('add_amount');
      $totalCost = Transaction::sum('cost_amount');
      $costStatus = $totalAdd - $totalCost ;
      $totalAdd = Transaction::sum('add_amount');
      $totalCost = Transaction::sum('cost_amount');
      $costStatus = $totalAdd - $totalCost ;
      $pdf = Pdf::loadView('backend.pdf.transactionPdf',compact('userTotals','auth_user_transaction','transactions','totalAdd','totalCost','costStatus'));
      return $pdf->stream('invoice.pdf');
   }
}
