@extends('frontend.layout')
@section('frontend_contains')

<div class="table-responsive shadow-sm  p-2 mt-3" >
    <div class="header">
        <h3 class="text-center mb-3">All Transactions Report</h3>

        <div class="">
            <a style="width: 200px;" target="_blank" class="btn btn-dark mb-3 d-flex align-items-center justify-content-center" href="{{ route('backend.transaction.pdf') }}"> 
                <span style="line-height: 0; width:30px;  height:30px; display:flex; align-item:center; flex-direction:column;justify-content:center;"><iconify-icon icon="material-symbols:download-sharp" width="24" height="24"></iconify-icon></span> Download Report </a>
        </div>
    </div>


    <div class="table-responsive">
        <table style="vertical-align: middle;" class="text-center table table-hover table-striped table-bordered">
            <tr>
                <td>Cost Amount : {{ $totalAdd }} /-</td>
                <td>Add Amount : {{ $totalCost }} /-</td>
                <td>Status Amount : <span class="p-2 text-light  btn bg-{{ $costStatus < 0 ? 'danger' : 'success'}}">{{ $costStatus }} /-</span> </td>
            </tr>
        </table>
    </div>


    <div class="table-responsive">
        
        <table class="table table-bordered table-striped table-hover text-center">
            <tr>
                <th>Sn.</th>
                <th>User</th>
                <th>Category</th>
                <th>Description</th>
                <th>Date</th>
                <th>Member</th>
                <th>Add Amount</th>
                <th>Expence Amount</th>
            </tr>
    
            @forelse ($transactions as $key => $transaction)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ Str::limit($transaction->auth_user, 10, '...') }}</td>
                    <td>{{ $transaction->transaction_category }}</td>
                    <td>{{ $transaction->transaction_description ? $transaction->transaction_description : '-' }}</td>
                    {{-- <td>{{ $transaction->created_at->format('d/m/Y')}} </td> --}}
                    <td>
                        {{ $transaction->created_at ? $transaction->created_at->format('d/m/Y') : 'N/A' }} |
                        {{ $transaction->created_at ? $transaction->created_at->format('h:i A') : 'N/A' }}
                    </td>
                    <td>{{ $transaction->additional_cost_user }}</td>
                    <td>{{ $transaction->add_amount > 0 ? $transaction->add_amount : 0 }} /-</td>
                    <td>{{ $transaction->cost_amount > 0 ? $transaction->cost_amount : 0 }} /-</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-danger py-5">No Data found!</td>
                </tr>
            @endforelse
        </table>
    </div>
</div>

@endsection