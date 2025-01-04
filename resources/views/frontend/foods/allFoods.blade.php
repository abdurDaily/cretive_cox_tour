@extends('frontend.layout')
@section('frontend_contains')

<div class="table-responsive shadow-sm  p-2 mt-3" >
    <div class="header">
        <h3 class="text-center mb-5">Foods Serve Schedule</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
            <tr>
                <th>Sn.</th>
                <th>Food Item</th>
                <th>Serve Time</th>
            </tr>
    
            @forelse ($foods as $key => $food)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $food->food_name }}</td>
                    <td>{{ $food->serve_time }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No Data found!</td>
                </tr>
            @endforelse
        </table>
    </div>
</div>

@endsection