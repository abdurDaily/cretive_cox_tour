@extends('frontend.layout')
@section('frontend_contains')

<div class="table-responsive shadow-sm  p-2 mt-3" >
    <div class="header">
        <h3 class="text-center mb-5">Register Members</h3>
    </div>
    <table class="table table-striped table-hover text-center">
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
                <td>{{ ++$key }}</td>
                <td>{{ $register->name }}</td>
                <td>{{ $register->phone }}</td>
                <td>{{ $register->tshirt_size }}</td>
                <td>{{ $register->number_of_people	 }}</td>
                <td>{{ $register->status	 }}</td>
                
                <td>{{ $register->opinion }}</td>
            </tr>
        @empty
            
        @endforelse
    </table>
</div>

@endsection