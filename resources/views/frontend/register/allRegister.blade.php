@extends('frontend.layout')
@section('frontend_contains')

    <div class="table-responsive shadow-sm  p-2 mt-3">
        <div class="header">
            <h3 class="text-center mb-3">Register Members</h3>
            <div class="d-flex justify-content-between">
                <p>Total Official Members Going: <b class="btn-dark btn">{{ $totalGoinMembers }} / {{ $totalMembers }}</b>
                </p>
                <p>Total Guest : <b class="btn-dark btn">{{ $totalGuest }} </b> </p>
                <p>Total Members : <b class="btn-dark btn">{{ $totalMembersGuest }} </b> </p>
            </div>


            <div class="d-flex mb-3">


                <!-- Button trigger modal -->
                <button type="button" style="padding: 10px 15px;" data-bs-toggle="modal" data-bs-target="#goingMembers">
                    Going Members
                </button>

                {{-- NOT GOING  --}}
                <button type="button" style="padding: 10px 15px; margin:0 10px;" data-bs-toggle="modal"
                    data-bs-target="#notGoingMembers">
                    Not Going Members
                </button>


                {{-- GUEST --}}
                <button type="button" style="padding: 10px 30px; margin-right:10px;" data-bs-toggle="modal"
                    data-bs-target="#guest">
                    Guest
                </button>
            </div>


            <!-- Modal going -->
            <div class="modal fade" id="goingMembers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Going Members</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Official Stuffs</p>
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>Sn</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                </tr>

                                @forelse ($goingMembersDetails as $key => $goingMember)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $goingMember->name }}</td>
                                        <td>
                                            <a style="text-decoration: none; color:#000;"
                                                href="tel:{{ $goingMember->phone }}">{{ $goingMember->phone }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No data found!</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>





            <!-- Modal not going-->
            <div class="modal fade" id="notGoingMembers" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Not Going Members</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Official Stuffs</p>
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>Sn</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                </tr>

                                @forelse ($notgoingMembersDetails as $key => $goingMember)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $goingMember->name }}</td>
                                        <td>
                                            <a style="text-decoration: none; color:#000;"
                                                href="tel:{{ $goingMember->phone }}">{{ $goingMember->phone }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No data found!</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Modal guest-->
            <div class="modal fade" id="guest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Going Members</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Guest</p>
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>Sn</th>
                                    <th>Guest Name</th>
                                    <th>Ref. Name</th>
                                    <th>Phone</th>
                                </tr>

                                @forelse ($GuestDetails as $key => $GuestDetail)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ Str::limit($GuestDetail->name, 8, '...') }}</td>
                                        <td>{{ Str::limit($GuestDetail->users->name, 8, '...') }}</td>
                                        <td>
                                            <a style="text-decoration: none; color:#000;"
                                                href="tel:{{ $GuestDetail->users->phone }}">{{ $GuestDetail->users->phone }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No data found!</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <div class="table-responsive">
            <table class="table-bordered table table-striped table-hover text-center table-v-center">
                <tr>
                    <th>Sn.</th>
                    <th>Name</th>
                    <th>Is Going</th>
                    <th>email</th>
                    <th>Phone</th>
                    <th>T-shirt</th>
                    <th>Opinion</th>
                    <th>Ad Name</th>
                    <th>M</th>
                    <th>L</th>
                    <th>XL</th>
                    <th>XXL</th>
                    <th>Single R</th>
                    <th>Couple R</th>
                </tr>

                @forelse ($allRegisters as $key => $register)
                    <tr>


                        <td
                            @if ($register->additinalMembers != null && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                            {{ ++$key }}</td>
                        <td
                            @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                            {{ $register->name }}</td>
                        <td
                            @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                            {{ $register->is_going === 1 ? 'Yes' : 'No' }}</td>
                        <td
                            @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                            {{ $register->email }}</td>
                        <td
                            @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                            {{ $register->phone }}</td>
                        <td
                            @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                            {{ $register->tshirt_size }}</td>
                        <td
                            @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                            {{ $register->opinion }}</td>

                        @if (!$register->additinalMembers || count($register->additinalMembers) == 0)
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        @endif
                    </tr>
                    @foreach ($register->additinalMembers as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->m_size }}</td>
                            <td>{{ $member->l_size }}</td>
                            <td>{{ $member->xl_size }}</td>
                            <td>{{ $member->xxl_size }}</td>
                            <td>{{ $member->single_room }}</td>
                            <td>{{ $member->couple_room }}</td>
                        </tr>
                    @endforeach
                @empty
                @endforelse
            </table>
        </div>
    </div>

@endsection
