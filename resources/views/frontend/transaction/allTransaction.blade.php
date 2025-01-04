@extends('frontend.layout')
@section('frontend_contains')

<div class="table-responsive shadow-sm  p-2 mt-3" >
    <div class="header">
        <h3 class="text-center mb-5">All Transactions</h3>
    </div>
    <div class="table-responsive">
        <h5 class="text-end mb-3">Total Transaction: <span style="background: #E42625;color:#fff; padding:10px; display:inline-block;border-radius:10px;">{{ $totalTransaction }}</span> </h5>
        <table class="table table-striped table-hover text-center">
            <tr>
                <th>Sn.</th>
                <th>Transaction Title</th>
                <th>Amount</th>
            </tr>
    
            @forelse ($transactions as $key => $transaction)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $transaction->transaction_name }}</td>
                    <td>{{ $transaction->transaction_amount }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-danger py-5">No Data found!</td>
                </tr>
            @endforelse
        </table>
    </div>
</div>

@endsection