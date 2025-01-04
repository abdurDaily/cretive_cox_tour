@extends('backend.layout')
@section('backend_contains')
<form id="transport" action="{{ route('backend.transport.store') }}" method="post" class="shadow p-5 mt-3">
    @csrf
    <h3 class="text-center">Insert Transport Schedule</h3>

    <div class="row mt-3">
        <div class="col-lg-12">
            <label for="location">Location</label>
            <input required id="location" name="location" type="text" placeholder="location" class="mb-3 form-control p-4">
        </div>

        <div class="col-lg-4">
            <label for="date">Select date</label>
            <input required type="date" name="date" id="date" class="form-control p-4">
        </div>

        <div class="col-lg-4">
            <label for="start_time">Start Time</label>
            <input required type="time" name="start_time" id="start_time" class="form-control p-4">
        </div>

        <div class="col-lg-4">
            <label for="end_time">End Time</label>
            <input required type="time" name="end_time" id="end_time" class="form-control p-4">
        </div>

        <button type="submit" class="btn btn-outline-dark w-25 p-4 mt-3">Submit</button>
    </div>
</form>


@push('backend_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function(){
        $('#transport').on('submit', function(e){
            e.preventDefault(); // Prevent the form from submitting immediately

            // Get the form data
            var formData = $(this).serialize();

            // Send the form data via AJAX
            $.ajax({
                url: "{{ route('backend.transport.store') }}", // Replace with your route
                type: "POST",
                data: formData,
                success: function(response) {
                    // Show the alert on successful data insertion
                    Swal.fire({
                        title: "Good job!",
                        text: "Thanks for Registration",
                        icon: "success",
                        timer: 3000,
                    }).then(() => {
                        // Redirect after the alert is closed
                        window.location.href = "{{ route('home') }}";
                    });
                },
                error: function(xhr) {
                    // Handle errors if any
                    Swal.fire({
                        title: "Error!",
                        text: "Something went wrong. Please try again.",
                        icon: "error",
                    });
                }
            });
        });
    });
</script>
@endpush
@endsection
