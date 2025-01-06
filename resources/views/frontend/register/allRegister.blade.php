@extends('frontend.layout')
@section('frontend_contains')

    <div class="table-responsive shadow-sm  p-2 mt-3">
        <div class="header">
            <h3 class="text-center mb-5">Register Members</h3>
        </div>
        <table class="table-bordered table table-striped table-hover text-center table-v-center">
            <tr>
                <th>Sn.</th>
                <th>Name</th>
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


                    <td @if ($register->additinalMembers != null && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                        {{ ++$key }}</td>
                    <td @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                        {{ $register->name }}</td>
                    <td @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                        {{ $register->email }}</td>
                    <td @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                        {{ $register->phone }}</td>
                    <td @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
                        {{ $register->tshirt_size }}</td>
                    <td @if ($register->additinalMembers && count($register->additinalMembers) > 0) rowspan="{{ count($register->additinalMembers) + 1 }}" @endif>
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

@endsection
