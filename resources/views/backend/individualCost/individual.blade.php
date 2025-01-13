@extends('backend.layout')
@section('backend_contains')

<div class=" p-4 mt-3">
    <h4>individual cost</h4>
    <div class="table-responsive">
        <table style="vertical-align: middle; text-align:center;" class="table table-striped table-bordered table-hover">
            <tr>
                <th style="padding: 20px 0;">Sn</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Opinion</th>
                <th>Cost /-</th>
                <th>Paid /-</th>
                <th>s.room</th>
                <th>c.room</th>
                <th>m.size</th>
                <th>l.size</th>
                <th>xl.size</th>
                <th>xxl.size</th>
                <th>Total Tshirt</th>
                <th>total</th>
                <th>status</th>
            </tr>

            @forelse ($users as $key => $user)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ Str::limit($user->opinion, 10, '...') }}</td>
                    <td>{{ $user->cost_amount }} /-</td>
                    <td>{{ $user->add_amount }} /-</td>
                    <td>
                        {{ $user->single_rooms }} * 
                        {{ ($individualRoomCost->single_room_cost ?? 0) }} = 
                        {{ $user->single_rooms * ($individualRoomCost->single_room_cost ?? 0) }} /-
                    </td>
                    <td>
                        {{ $user->couple_rooms }} * 
                        {{ ($individualRoomCost->couple_room_cost ?? 0) }} = 
                        {{ $user->couple_rooms * ($individualRoomCost->couple_room_cost ?? 0) }} /-
                    </td>
                    
                    <td>{{ $user->m_size }}</td>
                    <td>{{ $user->l_size }}</td>
                    <td>{{ $user->xl_size }}</td>
                    <td>{{ $user->xxl_size }}</td>
                    <td>{{ ($user->m_size + $user->l_size + $user->xl_size + $user->xxl_size) *  $individualRoomCost->t_shirt_price }}</td>
                    <td>
                        {{ ($user->cost_amount + 
                           ($user->single_rooms * ($individualRoomCost->single_room_cost ?? 0)) + 
                           ($user->couple_rooms * ($individualRoomCost->couple_room_cost ?? 0)) + ($user->m_size + $user->l_size + $user->xl_size + $user->xxl_size) *  $individualRoomCost->t_shirt_price) }} /-
                    </td>
                    <td>
                        <span class="btn btn-sm btn-{{ 
                            ($user->cost_amount + 
                             ($user->single_rooms * ($individualRoomCost->single_room_cost ?? 0)) + 
                             ($user->couple_rooms * ($individualRoomCost->couple_room_cost ?? 0))) <= $user->add_amount ? 'success' : 'danger' 
                        }}">
                            {{ 
                                ($user->cost_amount + 
                                 ($user->single_rooms * ($individualRoomCost->single_room_cost ?? 0)) + 
                                 ($user->couple_rooms * ($individualRoomCost->couple_room_cost ?? 0))) <= $user->add_amount ? 'paid' : 'due' 
                            }}
                        </span>
                        <a class="btn btn-primary btn-sm" href="{{ route('backend.transaction.individual.details', $user->id) }}">
                            details
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>No data found!</td>
                </tr>
            @endforelse
        </table>
    </div>
</div>

@endsection