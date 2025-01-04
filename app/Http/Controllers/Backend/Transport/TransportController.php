<?php

namespace App\Http\Controllers\Backend\Transport;

use App\Http\Controllers\Controller;
use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function transportIndex(){
        return view('backend.transport.store');
    }


    public function transportStore(Request $request){
        $storeTransport = new Transport();
        $storeTransport->location = $request->location;
        $storeTransport->date = $request->date; // Ensure this is in YYYY-MM-DD format
        $storeTransport->start_time = $request->start_time;
        $storeTransport->end_time = $request->end_time;
        $storeTransport->save();
        // return back(); 
    }


    public function viewTransport(){
        $transports = Transport::get();
        return view('frontend.transport.allTransport', compact('transports'));
    }
}
