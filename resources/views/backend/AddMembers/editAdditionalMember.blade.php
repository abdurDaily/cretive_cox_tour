@extends('backend.layout')
@section('backend_contains')
    <div class="row">
        <div class="heading">
            <h4 class="mt-5 text-center">Edit Additinal Member</h4>
        </div>

   


        <form class="p-3" id="register" action="{{ route('backend.additional.update', $editMember->id) }}" method="post"
            class="shadow-sm p-4">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="name">Name <b class="text-danger">*</b></label>
                    <input name="name" value="{{ $editMember->name }}" id="name" type="text" placeholder="name"
                        class="p-4 form-control mb-3">
                        <span class="text-danger" id="name-error" style="display: none;">Please provide guest name</span>
                </div>

                <div class="col-lg-6 mb-3">
                    <label for="m_size">Select Amount of T-shirt</label> <br>

                    <div class="row g-3">
                        <div class="col-lg-3">
                            <input value="{{ $editMember->m_size }}" name="m_size" class="form-control p-4" type="number" placeholder="M Size">
                        </div>
                        <div class="col-lg-3">
                            <input value="{{ $editMember->l_size }}" name="l_size" class="form-control p-4" type="number" placeholder="L Size">
                        </div>
                        <div class="col-lg-3">
                            <input value="{{ $editMember->xl_size }}" name="xl_size" class="form-control p-4" type="number" placeholder="XL Size">
                        </div>
                        <div class="col-lg-3">
                            <input value="{{ $editMember->xxl_size }}" name="xxl_size" class="form-control p-4" type="number" placeholder="XXL Size">
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
                            <input value="{{ $editMember->single_room }}" type="number" id="single_room" name="single_room" class="form-control p-4"
                                placeholder="amount : 01">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="couple_room">Amount of Couple Room</label>
                            <input value="{{ $editMember->couple_room }}" type="number" id="couple_room" name="couple_room" class="form-control p-4"
                                placeholder="amount : 01">
                        </div>
                    </div>
                    <span class="text-danger" id="room-error-message" style="display: none;">Please provide at least one
                        room amount (single or couple).</span>
                </div>


                <div class="col-lg-6">
                    <label for="show_size">T-Shirt Size </label> <br>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="show_size" style="color:#fff;"
                        class="btn p-4 w-100 bg-dark">check T-Shirt Size</a>
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

                    <textarea id="opinion" name="opinion" placeholder="any opinion?" rows="6" class="p-3 form-control mb-3">{{ $editMember->opinion }}</textarea>
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
        $('#tshirt-error, #room-error-message, #name-error').hide();

        // Validate name field
        const name = $('input[name="name"]').val().trim();
        let isValid = true;

        if (!name) {
            $('#name-error').show(); // Show name error message
            isValid = false;
        }

        // Convert negative values to positive for T-shirt sizes
        const mSize = Math.abs(parseInt($('input[name="m_size"]').val()) || 0);
        const lSize = Math.abs(parseInt($('input[name="l_size"]').val()) || 0);
        const xlSize = Math.abs(parseInt($('input[name="xl_size"]').val()) || 0);
        const xxlSize = Math.abs(parseInt($('input[name="xxl_size"]').val()) || 0);

        // Update the input fields with positive values
        $('input[name="m_size"]').val(mSize);
        $('input[name="l_size"]').val(lSize);
        $('input[name="xl_size"]').val(xlSize);
        $('input[name="xxl_size"]').val(xxlSize);

        const isTshirtProvided = mSize > 0 || lSize > 0 || xlSize > 0 || xxlSize > 0;

        // Convert negative values to positive for rooms
        const singleRoom = Math.abs(parseInt($('input[name="single_room"]').val()) || 0);
        const coupleRoom = Math.abs(parseInt($('input[name="couple_room"]').val()) || 0);

        // Update the input fields with positive values
        $('input[name="single_room"]').val(singleRoom);
        $('input[name="couple_room"]').val(coupleRoom);

        const isRoomProvided = singleRoom > 0 || coupleRoom > 0;

        // Validate T-shirt sizes
        if (!isTshirtProvided) {
            $('#tshirt-error').show(); // Show T-shirt error message
            isValid = false;
        }

        // Validate rooms
        if (!isRoomProvided) {
            $('#room-error-message').show(); // Show room error message
            isValid = false;
        }

        // If all validations pass, submit the form
        if (isValid) {
            $(this).unbind('submit').submit();
        }
    });
});
        </script>
    @endpush
@endsection
