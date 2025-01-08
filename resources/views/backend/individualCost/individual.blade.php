@extends('backend.layout')
@section('backend_contains')

<div class="shadow p-4 mt-3">
    <h4>individual cost</h4>
    <div class="table-responsive">
        <table style="vertical-align: middle; text-align:center;" class="table table-striped table-bordered table-hover">
            <tr>
                <th style="padding: 20px 0;">Sn</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Cost /-</th>
                <th>Paid /-</th>
                <th>Status</th>
            </tr>
            <tbody>
                @forelse($summedCosts as $key =>  $summedCostAndAddAmount)
                    @php
                        $userId = $summedCostAndAddAmount->additional_cost_user;
                        $user = $users[$userId];
                    @endphp
                    <tr>
                        <td style="padding: 20px 0;">{{ ++$key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $summedCostAndAddAmount->total_cost }} /-</td>
                        <td>{{ $summedCostAndAddAmount->total_add_amount ? $summedCostAndAddAmount->total_add_amount : 0 }} /-</td>
                        <td>
                            <span class="text-light btn btn-sm bg-{{$summedCostAndAddAmount->total_cost <= $summedCostAndAddAmount->total_add_amount ? 'success' : 'danger' }}">
                              {{ $summedCostAndAddAmount->total_cost <= $summedCostAndAddAmount->total_add_amount ? 'paid' : 'due' }}
                            </span>
                        </td>
                    </tr>
                    @empty

                <tr>
                    <td>no record found!</td>
                </tr>

 
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection