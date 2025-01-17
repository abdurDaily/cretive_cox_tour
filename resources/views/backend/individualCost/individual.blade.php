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
                    {{-- <th>s.room</th>
                    <th>c.room</th> --}}
                    <th> T-shirt</th>
                    <th>Room </th>
                    <th>Food</th>
                    <th>Transportation</th>
                    <th>Others</th>
                    <th>Office Share</th>
                    <th style="min-width: 150px;">Guest Cost</th>
                    <th>Total Cost</th>
                    <th>Paid /-</th>  <!-- Added Paid column -->
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
                          <!-- Display Paid Amount -->
                        {{-- <td>{{ $user->single_room * ($individualRoomCost->single_room_cost ?? 0) }} /-</td>
                        <td>{{ $user->couple_room * ($individualRoomCost->couple_room_cost ?? 0) }} /-</td> --}}
                        <td>{{ $user->totalAdditionalTshirtCost }} /-</td>
                        <td>{{ ($user->single_room * ($individualRoomCost->single_room_cost ?? 0)) + 
                               ($user->couple_room * ($individualRoomCost->couple_room_cost ?? 0)) }} /-</td>
                        <td>{{ $user->foodCost }} /-</td>
                        <td>{{ $user->transportCost }} /-</td>
                        <td>{{ $user->otherCost }} /-</td>
                        <td>{{ $distributedOfficeAddAmount }} /-</td>
                        <td>
                            T-shirt: {{ $user->totalAdditionalTshirtCost }} /- <br>
                            Room: {{ $user->totalAdditionalRoomCost }} /-
                        </td>
                        <td>
                            @php
                                $payable = $user->cost_amount +
                                           ($user->single_room * ($individualRoomCost->single_room_cost ?? 0)) +
                                           ($user->couple_room * ($individualRoomCost->couple_room_cost ?? 0)) +
                                           $user->totalAdditionalTshirtCost +
                                           $user->totalAdditionalRoomCost +
                                           $user->foodCost +
                                           $user->transportCost +
                                           $user->otherCost;
                            @endphp
                            {{ $payable }} /-
                        </td>
                        <td>{{ $user->add_amount }} /-</td>
                        <td>
                            <span class="mt-1 btn btn-sm btn-{{ $payable <= $user->add_amount ? 'success' : 'danger' }}">
                                {{ $payable - $user->add_amount }} tk
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
