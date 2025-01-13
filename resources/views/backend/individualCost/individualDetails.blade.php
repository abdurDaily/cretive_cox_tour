@extends('backend.layout')
@section('backend_contains')
<div class="table-responsive">
    <div class="d-flex justify-content-between py-3">
        <h4>Others Costs</h4>
        <h4>{{ $user->name }}</h4>
    </div>
    <table style="vertical-align: middle; text-align:center;" class="table table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>category</th>
            <th>date</th>
            <th>cost</th>
            <th>add</th>
            @if (Auth::user()->status == 1)
            <th>status</th>
            @endif
        </tr>

        @foreach ($user->transactions as $key => $data)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $data->transaction_category }}</td>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->cost_amount ? $data->cost_amount : 0 }} /-</td>
                <td>{{ $data->add_amount ? $data->add_amount : 0 }} /-</td>
                
                @if (Auth::user()->status == 1)
                <td>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('backend.transaction.edit.individual.details', $data->id) }}" style="display: inline-block; padding:0 20px; ">
                            <span style="color:#000;">
                                <iconify-icon icon="line-md:edit" width="24" height="24"></iconify-icon>
                            </span>
                        </a>
                    </div>
                </td>
                @endif
                
            </tr>
        @endforeach
    </table>
</div>

@php
    $totalM = $totalM ?? 0;
    $totalL = $totalL ?? 0;
    $totalXL = $totalXL ?? 0;
    $totalXXL = $totalXXL ?? 0;
    $totalTShirt = $totalTShirt ?? 0;
    $singleRooms = $user->additinalMembers->sum('single_room') ?? 0;
    $coupleRooms = $user->additinalMembers->sum('couple_room') ?? 0;

    $showDataRow = $totalM > 0 || $totalL > 0 || $totalXL > 0 || $totalXXL > 0 || $totalTShirt > 0 || $singleRooms > 0 || $coupleRooms > 0;
@endphp

<div class="table-responsive">
    <div class="d-flex justify-content-between py-3">
        <h4>Hotel Costs</h4>
        <span></span>
    </div>
    <table style="vertical-align: middle; text-align:center;" class="table table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>M Size</th>
            <th>L Size</th>
            <th>XL Size</th>
            <th>XXL Size</th>
            <th>Total T-shirt</th>
            <th>Single</th>
            <th>Couple</th>
            @if (Auth::user()->status == 1)
            <th>status</th>
            @endif
        </tr>

        @if($showDataRow)
        <tr>
            <td>1</td>
            <td>{{ $totalM }}</td>
            <td>{{ $totalL }}</td>
            <td>{{ $totalXL }}</td>
            <td>{{ $totalXXL }}</td>
            <td>{{ $totalTShirt }}</td>
            <td>{{ $singleRooms }}</td>
            <td>{{ $coupleRooms }}</td>
            @if (Auth::user()->status == 1)
            <td>
                <div class="d-flex align-items-center justify-content-center">
                    <a href="{{ route('backend.additional.edit', $user->id) }}" style="display: inline-block; padding:0 20px; ">
                        <span style="color:#000;">
                            <iconify-icon icon="line-md:edit" width="24" height="24"></iconify-icon>
                        </span>
                    </a>
                </div>
            </td>
            @endif
           
        </tr>
        @endif
    </table>
</div>
@endsection