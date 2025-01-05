@extends('backend.layout')
@section('backend_contains')
    <div class="row">
        <div class="heading">
            <h4 class="mt-5 text-center">Additinal Member Register</h4>
        </div>

   


        <form class="p-3" id="register" action="{{ route('backend.additional.store') }}" method="post"
            class="shadow-sm p-4">
            @csrf

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="name">Name <b class="text-danger">*</b></label>
                    <input name="name" value="{{ old('name') }}" id="name" type="text" placeholder="name"
                        class="p-4 form-control mb-3">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6 mb-3">
                    <label for="m_size">Select Amount of T-shirt</label> <br>

                    <div class="row g-3">
                        <div class="col-lg-3">
                            <input name="m_size" class="form-control p-4" type="number" placeholder="M Size">
                        </div>
                        <div class="col-lg-3">
                            <input name="l_size" class="form-control p-4" type="number" placeholder="L Size">
                        </div>
                        <div class="col-lg-3">
                            <input name="xl_size" class="form-control p-4" type="number" placeholder="XL Size">
                        </div>
                        <div class="col-lg-3">
                            <input name="xxl_size" class="form-control p-4" type="number" placeholder="XXL Size">
                        </div>
                    </div>
                    <span class="text-danger" id="tshirt-error" style="display: none;">Please provide at least one T-shirt
                        size.</span>
                </div>


                <!-- Rooms -->
                <div class="col-lg-6 mb-3">
                    <div class="row" id="room-error">
                        <div class="col-lg-6 mb-3">
                            <label for="single_room">Amount of Single Room</label>
                            <input type="number" id="single_room" name="single_room" class="form-control p-4"
                                placeholder="amount : 01">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="couple_room">Amount of Couple Room</label>
                            <input type="number" id="couple_room" name="couple_room" class="form-control p-4"
                                placeholder="amount : 01">
                        </div>
                    </div>
                    <span class="text-danger" id="room-error-message" style="display: none;">Please provide at least one
                        room amount (single or couple).</span>
                </div>


                <div class="col-lg-6">
                    <label for="show_size">T-Shirt Size </label> <br>
                    <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="show_size" style="color:#fff;"
                        class="btn p-4 w-100 bg-dark">check T-Shirt Size</button>
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
                                <img class="img-fluid"
                                    src="https://sunnahsquarebd.com/wp-content/uploads/2024/11/j-size.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12">
                    <label for="opinion">any opinion?</label>

                    <textarea id="opinion" name="opinion" placeholder="any opinion?" rows="6" class="p-3 form-control mb-3"></textarea>
                </div>


            </div>
            <button type="submit" class="btn btn-dark w-100 mx-auto mt-3 p-4 ">submit</button>
        </form>
    </div>

    @push('backend_js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#register').on('submit', function(e) {
                    e.preventDefault(); // Prevent form submission

                    // Reset error messages
                    $('#tshirt-error, #room-error-message').hide();

                    // Check if at least one T-shirt size is provided
                    const mSize = $('input[name="m_size"]').val();
                    const lSize = $('input[name="l_size"]').val();
                    const xlSize = $('input[name="xl_size"]').val();
                    const xxlSize = $('input[name="xxl_size"]').val();

                    const isTshirtProvided = mSize || lSize || xlSize || xxlSize;

                    // Check if single room or couple room is provided
                    const singleRoom = $('input[name="single_room"]').val();
                    const coupleRoom = $('input[name="couple_room"]').val();

                    const isRoomProvided = singleRoom || coupleRoom;

                    // Validate at least one field is filled
                    if (!isTshirtProvided && !isRoomProvided) {
                        // Show error messages
                        $('#tshirt-error').show();
                        $('#room-error-message').show();
                        return false; // Stop form submission
                    }

                    // If T-shirt sizes are not provided, check rooms
                    if (!isTshirtProvided) {
                        if (!isRoomProvided) {
                            // Show error for rooms
                            $('#room-error-message').show();
                            return false; // Stop form submission
                        }
                    }

                    // If validation passes, submit the form
                    this.submit();
                });
            });
        </script>
    @endpush
@endsection
