@extends('backend.layout')
@section('backend_contains')
<form id="foods" action="{{ route('backend.foods.store') }}" method="post" class="shadow p-5 mt-3">
    @csrf
    <h3 class="text-center">Insert Foods Item</h3>

    <div class="row mt-3">
        <div class="col-lg-12">
            <label for="food_name">Food Item Name</label>
            <input required id="food_name" name="food_name" type="text" placeholder="food item name" class="mb-3 form-control p-4">
        </div>

        
        <div class="col-lg-6">
            <label for="serve_time">Serve Time</label>
            <input required id="serve_time" name="serve_time" type="time" placeholder="serve time" class="mb-3 form-control p-4">
        </div>
        <div class="col-lg-6">
            {{-- <label for=""></label> --}}
            <button type="submit" class="btn btn-outline-dark w-100 p-4 mt-4">Submit</button>
        </div>



        
    </div>
</form>


@push('backend_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function(){
        $('#foods').on('submit', function(e){
            e.preventDefault(); // Prevent the form from submitting immediately

            // Get the form data
            var formData = $(this).serialize();

            // Send the form data via AJAX
            $.ajax({
                url: "{{ route('backend.foods.store') }}", // Replace with your route
                type: "POST",
                data: formData,
                success: function(response) {
                    // Show the alert on successful data insertion
                    Swal.fire({
                        title: "Good job!",
                        text: "Food Items Inserted Successfully!",
                        icon: "success",
                        timer: 3000,
                    }).then(() => {
                        // Redirect after the alert is closed
                        window.location.href = "{{ route('backend.admin.dashboard') }}";
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
