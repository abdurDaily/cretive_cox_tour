<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\AditionalMember;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
   public function transactionPDF()
   {
      $transactions = Transaction::get();
      $auth_user_transaction = Transaction::with('users')
         ->select('user_id', 'id', 'cost_amount', 'add_amount')
         ->get();

      // dd($auth_user_transaction);

      // Group transactions by user_id and sum amounts
      $userTotals = $auth_user_transaction->groupBy('user_id')->map(function ($transactions) {
         return [
            'total_cost_amount' => $transactions->sum('cost_amount'),
            'total_add_amount' => $transactions->sum('add_amount'),
         ];
      });


      //*T-SHIRT AMOUNT COUNT 
      $additionalMemberTshirt = AditionalMember::get();
      $guestTshirt = $additionalMemberTshirt->sum('m_size') + 
                  $additionalMemberTshirt->sum('l_size') + 
                  $additionalMemberTshirt->sum('xl_size') + 
                  $additionalMemberTshirt->sum('xxl_size');

      $employeeTshirt = count(User::get());
      $totalTshirt = $guestTshirt + $employeeTshirt;


      //* TRANSPOTATION COST 
      $transactionSums = DB::table('transactions')
            ->select('transaction_category', 
                     DB::raw('SUM(add_amount) as total_add_amount'), 
                     DB::raw('SUM(cost_amount) as total_cost_amount'))
            ->groupBy('transaction_category')
            ->get();

      // dd($transactionSums);





      $totalAdd = Transaction::sum('add_amount');
      $totalCost = Transaction::sum('cost_amount');
      $costStatus = $totalAdd - $totalCost;
      $totalAdd = Transaction::sum('add_amount');
      $totalCost = Transaction::sum('cost_amount');
      $costStatus = $totalAdd - $totalCost;
      $pdf = Pdf::loadView('backend.pdf.transactionPdf', compact('transactionSums','userTotals', 'auth_user_transaction', 'transactions', 'totalAdd', 'totalCost', 'costStatus', 'totalTshirt'));
      return $pdf->stream('invoice.pdf');
   }
}
