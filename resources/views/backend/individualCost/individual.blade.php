@extends('backend.layout')

@section('backend_contains')
@push('backend_css')
    <style>
      .main .container{
            max-width: 100%;
            padding: 0 10px;
        }
        .table-responsive::-webkit-scrollbar {
            display: none;
        }
        .table-responsive {
            -ms-overflow-style: none;
            scrollbar-width: none; /* Firefox */
         }
         .overlay{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: grid;
            place-items: center;
            transition: 0.3s
         }

         .overlay img{
            width: 200px;
         }
         .overlay.hide{
            opacity: 0;
            visibility: hidden
         }

    </style>
@endpush

<div class="p-4 mt-3">
    <h4>Individual Cost </h4>
    <div class="table-responsive" style="overflow-x: scroll;position:relative;">
        <table style="vertical-align: middle; text-align: center;" class="table table-striped table-bordered">
            <thead >
                <tr>
                    <th class="bg-success text-light" style="min-width: 20px;">Sn</th>
                    <th class="bg-success text-light" style="min-width: 25ch;">Name</th>
                    <th class="bg-success text-light" style="min-width: 11ch;">Phone</th>
                    <th class="bg-success text-light" style="min-width: 150px;">Opinion</th>
                    <th class="bg-success text-light" style="min-width: 150px;">T-shirt</th>
                    <th class="bg-success text-light" style="min-width: 150px;">Room</th>
                    <th class="bg-success text-light" style="min-width: 150px;">Food</th>
                    <th class="bg-success text-light" style="min-width: 150px;">Transportation</th>
                    <th class="bg-success text-light" style="min-width: 150px;">Others</th>
                    <th class="bg-success text-light" style="min-width: 150px;">Office Share</th>
                    <th class="bg-success text-light" style="min-width: 150px;">Guest Cost</th>
                    <th class="bg-success text-light" style="min-width: 150px;">Total Cost</th>
                    <th class="bg-success text-light" style="min-width: 150px;">Paid /-</th>
                    <th class="bg-success text-light" style="min-width: 150px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ Str::limit($user->opinion, 10, '...') }}</td>

                        <!-- T-shirt Cost: Main user's T-shirt cost (not including guests) -->
                        <td>{{ $user->userTshirtCost }} /-</td>

                        <!-- Room Cost Column -->
                        <td>
                            {{ ($user->single_room * ($individualRoomCost->single_room_cost ?? 0)) + 
                               ($user->couple_room * ($individualRoomCost->couple_room_cost ?? 0)) }} /-
                        </td>

                        <!-- Food Cost Column -->
                        <td>{{ $user->foodCost }} /-</td>

                        <!-- Transportation Cost Column -->
                        <td>{{ $user->transportCost }} /-</td>

                        <!-- Other Cost Column -->
                        <td>{{ $user->otherCost }} /-</td>

                        <!-- Office Share Column -->
                        <td>{{ $distributedOfficeAddAmount }} /-</td>

                        <!-- Guest Costs: T-shirt, Room, Food, Transport, Other -->
                        <td class="text-start">
                            T-shirt: {{ $user->totalAdditionalTshirtCost }} /- <br>
                            Room: {{ $user->totalAdditionalRoomCost }} /- <br>
                            Food: {{ $user->guestFoodCost }} /- <br>
                            Transport: {{ $user->guestTransportCost }} /- <br>
                            Other: {{ $user->guestOtherCost }} /-
                        </td>

                        <!-- Total Cost Column: Calculation of total payable amount -->
                        <td>
                            @php
                                $payable = 
                                    ($user->single_room * ($individualRoomCost->single_room_cost ?? 0)) +
                                    ($user->couple_room * ($individualRoomCost->couple_room_cost ?? 0)) +
                                    $user->userTshirtCost +
                                    $user->foodCost +
                                    $user->transportCost +
                                    $user->otherCost +
                                    $user->totalAdditionalTshirtCost +
                                    $user->totalAdditionalRoomCost +
                                    $user->guestFoodCost +
                                    $user->guestTransportCost +
                                    $user->guestOtherCost;

                                $remainingBalance = $payable - $user->add_amount;
                            @endphp

                            {{ $payable }} /-
                        </td>

                        <!-- Paid Amount Column -->
                        <td>{{ $user->add_amount }} /-</td>

                        <!-- Status Column: Display based on remaining balance -->
                        <td>
                            @if ($remainingBalance == 0)
                                <span class="mt-1 btn btn-sm btn-success">
                                    Paid in full
                                </span>
                            @elseif ($remainingBalance < 0)
                                <span class="mt-1 btn btn-sm btn-success">
                                    {{ abs($remainingBalance) }} tk overpaid
                                </span>
                            @else
                                <span class="mt-1 btn btn-sm btn-danger">
                                    {{ $remainingBalance }} tk due
                                </span>
                            @endif

                            <a class="btn btn-primary btn-sm mt-1" href="{{ route('backend.transaction.individual.details', $user->id) }}">
                                Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13">No data found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="overlay ">
            <img src="https://media1.giphy.com/media/P6a5ei3uRMAsukar9F/giphy.gif?cid=6c09b952vkegx5vsxa5u7nfbv8lxscidmomyxxow6qfx7rlg&ep=v1_internal_gif_by_id&rid=giphy.gif&ct=s" alt="">
        </div>
    </div>
</div>
@push('backend_js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {

            let isActive= null

            
            $('.table-responsive').on('mouseover', function(){
                if(!isActive){
                    setTimeout(() => {
                        $(this).find('.overlay').addClass('hide');
                    }, 300);
                    isActive+=1
                }
                
            })



        })
    </script>
@endpush
@endsection
