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
                <th>s.room</th>
                <th>c.room</th>
            </tr>
            
            @forelse ($users as $key => $user)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->cost_amount }}</td>
                    <td>{{ $user->add_amount }}</td>
                    <td>{{ $user->single_rooms }}</td>
                    <td>{{ $user->couple_rooms }}</td>
                </tr>
            @empty
                
            @endforelse
        </table>
    </div>
</div>

@endsection