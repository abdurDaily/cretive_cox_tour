@extends('frontend.layout')
@section('frontend_contains')

<div class="table-responsive shadow-sm  p-2 mt-3" >
    <div class="header">
        <h3 class="text-center mb-5">All Transport Schedule</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
            <tr>
                <th>Sn.</th>
                <th>Location</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>Start End</th>
            </tr>
    
            @forelse ($transports as $key => $transport)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $transport->location }}</td>
                    <td>{{ $transport->date }}</td>
                    <td>{{ $transport->start_time }}</td>
                    <td>{{ $transport->end_time	 }}</td>
                </tr>
            @empty
                
            @endforelse
        </table>
    </div>
</div>

@endsection