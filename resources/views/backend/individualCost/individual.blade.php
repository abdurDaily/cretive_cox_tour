@extends('backend.layout')
@section('backend_contains')

<div class="p-4 mt-3">
    <h4>Individual Cost</h4>
    <div class="table-responsive" style="overflow-x: scroll;">
        <table style="vertical-align: middle; text-align: center;" class="table table-striped-columns table-bordered table-hover">
            <thead>
                <tr>
                    <th>Sn</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Opinion</th>
                    <th>Cost /-</th>
                    <th>Paid /-</th>
                    <th>s.room</th>
                    <th>c.room</th>
                    <th>Total T-shirt</th>
                    <th>Room Total</th>
                    <th>Food</th>
                    <th>Transportation</th>
                    <th>Personal Cost</th>
                    <th>Others</th>
                    <th>Office Share</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ Str::limit($user->opinion, 10, '...') }}</td>
                        <td>{{ $user->cost_amount }} /-</td>
                        <td>{{ $user->add_amount }} /-</td>
            
                        {{-- Single Room --}}
                        <td>{{ $user->single_room * ($individualRoomCost->single_room_cost ?? 0) }} /-</td>
                        
                        {{-- Couple Room --}}
                        <td>{{ $user->couple_room * ($individualRoomCost->couple_room_cost ?? 0) }} /-</td>
            
                        {{-- Total T-shirts --}}
                        <td>
                            @php
                                $total_t_shirt_cost = 
                                    ($user->m_size + $user->l_size + $user->xl_size + $user->xxl_size) * 
                                    ($individualRoomCost->t_shirt_price ?? 0);
                            @endphp
                            {{ $total_t_shirt_cost }} /-
                        </td>
            
                        {{-- Room Total --}}
                        <td>
                            {{ ($user->single_room * ($individualRoomCost->single_room_cost ?? 0)) +
                               ($user->couple_room * ($individualRoomCost->couple_room_cost ?? 0)) }} /-
                        </td>
            
                        {{-- Food --}}
                        <td>{{ $user->foodCost }} /-</td>
            
                        {{-- Transportation --}}
                        <td>{{ $user->transportationCost }} /-</td>
            
                        {{-- Personal Cost --}}
                        <td>{{ $user->personalCost }} /-</td>
            
                        {{-- Others --}}
                        <td>{{ $user->otherCost }} /-</td>
            
                        {{-- Office Share --}}
                        <td>{{ round($officeProvided / $totalUsers) }} /-</td>
            
                        {{-- Total --}}
                        @php
                            $payable = $user->cost_amount +
                            ($user->single_room * ($individualRoomCost->single_room_cost ?? 0)) +
                            ($user->couple_room * ($individualRoomCost->couple_room_cost ?? 0)) +
                            $total_t_shirt_cost;
                        @endphp
                        <td>{{ $payable }} /-</td>
            
                        {{-- Status --}}
                        <td>
                            <span class="mt-1 btn btn-sm btn-{{ $payable <= $user->add_amount + (round($officeProvided / $totalUsers)) ? 'success' : 'danger' }}">
                                {{ $payable - ($user->add_amount + round($officeProvided / $totalUsers)) }} tk
                            </span>
                            <a class="btn btn-primary btn-sm mt-1" href="{{ route('backend.transaction.individual.details', $user->id) }}">
                                Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="17">No data found!</td>
                    </tr>
                @endforelse
            </tbody>
            
        </table>
    </div>
</div>

@endsection
