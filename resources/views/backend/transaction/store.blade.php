@extends('backend.layout')
@section('backend_contains')
<form id="transaction" action="{{ route('backend.transaction.store') }}" method="post" class="shadow p-5 mt-3">
    @csrf
    <h3 class="text-center">Create New Transaction</h3>

    <div class="row mt-3">
        <div class="col-lg-12">
            <label for="transaction_name">Food Item Name</label>
            <textarea name="transaction_name" placeholder="transaction title" class="mb-3 form-control p-4" id="transaction_name" rows="2"></textarea>
        </div>
        <div class="col-lg-12">
            <label for="transaction_amount">Food Item Name</label>
            <input type="number" name="transaction_amount" placeholder="transaction amount" class="mb-3 form-control p-4" id="transaction_amount">
        </div>

        <button type="submit" class="btn btn-outline-dark p-4 my-3 w-25">Submit</button>
    </div>
</form>


@push('backend_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function(){
        $('#transaction').on('submit', function(e){
            e.preventDefault(); // Prevent the form from submitting immediately

            // Get the form data
            var formData = $(this).serialize();

            // Send the form data via AJAX
            $.ajax({
                url: "{{ route('backend.transaction.store') }}", // Replace with your route
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
