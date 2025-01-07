<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
   public function transactionPDF(){
    $transactions = Transaction::get();
    // dd($transactions);
    $totalAdd = Transaction::sum('add_amount');
    $totalCost = Transaction::sum('cost_amount');
    $costStatus = $totalAdd - $totalCost ;
    $pdf = Pdf::loadView('backend.pdf.transactionPdf',compact('transactions'));
    return $pdf->stream('invoice.pdf');
   }
}
