@extends('frontend.layout')
@section('frontend_contains')
<div class="row">
    <div class="heading">
        <h4 class="mt-5 text-center">Registration for Tour 2025</h4>
    </div>


    <form id="register" action="{{ route('backend.registrations.store') }}" method="post" class="shadow-sm p-4">
        @csrf

        <div class="row">
            <div class="col-lg-6">
                <label for="name">Name <b class="text-danger">*</b></label>
                <input  name="name" value="{{ old('name') }}" id="name" type="text" placeholder="name" class="p-4 form-control mb-3"  >
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            
            <div class="col-lg-6">
                <label for="email">Email <b class="text-danger">*</b></label>
                <input required name="email" id="email" type="text" placeholder="email" class="p-4 form-control mb-3"  >
            </div>


            
            <div class="col-lg-6">
                <label for="phone">Contact Number <b class="text-danger">*</b></label>
                <input required name="phone" id="phone" type="number" placeholder="phone" class="p-4 form-control mb-3"  >
            </div>


            
            <div class="col-lg-6">
                <label for="tshirt_size">T-Shirt Size <b class="text-danger">*</b></label>
                <select required name="tshirt_size" id="tshirt_size" class="form-control p-4 mb-3">
                    <option value="" selected disabled>Select your T-shirt size</option>
                    <option value="1">S</option>
                    <option value="2">M</option>
                    <option value="3">L</option>
                    <option value="4">XL</option>
                    <option value="5">XXL</option>
                </select>
            </div>


              
            <div class="col-lg-6">
                <label for="number_of_people">Number of People</label>
                <input name="number_of_people" id="number_of_people" type="number" placeholder="number of peoples" class="p-4 form-control mb-3"  >
            </div>

              
            <div class="col-lg-6">
                <label for="status">Marital Status <b class="text-danger">*</b></label>
                <select required name="status" id="status" class="form-control p-4">
                    <option value="" selected disabled>select one</option>
                    <option value="1">single</option>
                    <option value="2">couple</option>
                </select>
            </div>

              
            <div class="col-lg-12">
                <label for="opinion">Additional T-shirt (if required) </label>
               
                <textarea name="opinion" placeholder="quantity + size (02 - XXL) or your any opinion" rows="10" class="p-3 form-control mb-3"></textarea>
            </div>

            <button type="submit" class="btn btn-outline-dark w-100 mx-auto mt-3 p-4">submit</button>

        </div>
    </form>
</div>

@push('frontend_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function(){
        $('#register').on('submit', function(e){
            e.preventDefault(); // Prevent the form from submitting immediately

            // Get the form data
            var formData = $(this).serialize();

            // Send the form data via AJAX
            $.ajax({
                url: "{{ route('backend.registrations.store') }}", // Replace with your route
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