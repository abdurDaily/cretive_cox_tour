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
            <th>status</th>
        </tr>

        @foreach ($user->transactions as $key => $data)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $data->transaction_category }}</td>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->cost_amount ? $data->cost_amount : 0 }} /-</td>
                <td>{{ $data->add_amount ? $data->add_amount : 0 }} /-</td>
                <td>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('backend.transaction.edit.individual.details', $data->id) }}" style="display: inline-block; padding:0 20px; ">
                            <span style="color:#000;">
                                <iconify-icon icon="line-md:edit" width="24" height="24"></iconify-icon>
                            </span>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>


<div class="table-responsive">
    <div class="d-flex justify-content-between py-3">
        <h4>Hotel Costs</h4>
        <span></span>
    </div>
    <table style="vertical-align: middle; text-align:center;" class="table table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Total T-shirt</th>
            <th>Single</th>
            <th>Couple</th>
            <th>status</th>
        </tr>

        @foreach ($user->additinalMembers as $key => $hotelData)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $totalSize }}</td>
                <td>{{ $hotelData->single_room ? $hotelData->single_room : 0 }} </td>
                <td>{{ $hotelData->couple_room ? $hotelData->couple_room : 0 }}</td>
                <td>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('backend.additional.edit', $hotelData->id) }}" style="display: inline-block; padding:0 20px; ">
                            <span style="color:#000;">
                                <iconify-icon icon="line-md:edit" width="24" height="24"></iconify-icon>
                            </span>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection