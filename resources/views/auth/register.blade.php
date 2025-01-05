


@extends('frontend.layout')
@section('frontend_contains')
    <div class="row">
        <div class="heading">
            <h4 class="mt-5 text-center">Registration for Tour 2025</h4>
        </div>


        <form class="p-3" id="register" action="{{ route('register') }}" method="post" class="shadow-sm p-4">
            @csrf

            <div class="row">
                <div class="col-lg-6">
                    <label for="name">Name <b class="text-danger">*</b></label>
                    <input name="name" value="{{ old('name') }}" id="name" type="text" placeholder="name"
                        class="p-4 form-control mb-3">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>



                <div class="col-lg-6">
                    <label for="email">Email <b class="text-danger">*</b></label>
                    <input required name="email" id="email" type="text" placeholder="email"
                        class="p-4 form-control mb-3">
                </div>



                <div class="col-lg-3">
                    <label for="password">Make a Password <b class="text-danger">*</b></label>
                    <input required name="password" id="password" type="password" placeholder="password"
                        class="p-4 form-control mb-3">
                </div>

                <div class="col-lg-3">
                    <label for="password_confirmation">Confirm Password <b class="text-danger">*</b></label>
                    <input required name="password_confirmation" id="password_confirmation" type="password" placeholder="confirm password" class="p-4 form-control mb-3">
                </div>

                <div class="col-lg-3">
                    <label for="phone">Contact Number <b class="text-danger">*</b></label>
                    <input required name="phone" id="phone" type="number" placeholder="phone"
                        class="p-4 form-control mb-3">
                </div>



                <div class="col-lg-3">
                    <label for="tshirt_size">T-Shirt Size <b class="text-danger">*</b></label>
                    <select required name="tshirt_size" id="tshirt_size" class="form-control p-4 mb-3">
                        <option value="" selected disabled>Select your T-shirt size</option>
                        <option value="1">M</option>
                        <option value="2">L</option>
                        <option value="3">XL</option>
                        <option value="4">XXL</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    <label for="show_size">T-Shirt Size </label> <br>
                    <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="show_size" style="background: #E42625; color:#fff;"
                        class="btn p-4 w-100">check T-Shirt Size</button>
                </div>





                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">T-shirt size</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               <img class="img-fluid" src="https://sunnahsquarebd.com/wp-content/uploads/2024/11/j-size.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12">
                    <label for="opinion">any opinion?</label>

                    <textarea id="opinion" name="opinion" placeholder="any opinion?" rows="6" class="p-3 form-control mb-3"></textarea>
                </div>

                <button type="submit" class="btn btn-dark w-100 mx-auto mt-3 p-4 ">submit</button>

            </div>
        </form>
    </div>

    @push('frontend_js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <script>
            $(function() {
                $('#register').on('submit', function(e) {
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
        </script> --}}
    @endpush
@endsection
