@extends('backend.layout')
@section('backend_contains')
@push('backend_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-container--default .select2-selection--single {
        height: 73px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e0d9d9;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        display: none;
    }
</style>
@endpush

 
    <form id="transaction" action="{{ route('backend.transaction.store') }}" method="post" class="shadow p-4 mt-3">
        @csrf
        <h3 class="text-center">Create New Transaction</h3>

        <div class="row mt-3">

            <div class="row mb-3 mx-auto ">
                <div class="col-lg-6 px-2">
                    <label for="transaction_category">Select Category</label>
                    <select class="form-control p-4" name="transaction_category" id="transaction_category">
                        <option value="" selected disabled>Select any Category</option>
                        <option value="1">Food</option>
                        <option value="2">Transportation </option>
                        <option value="3">Personal Cost  </option>
                        <option value="4">Others</option>
                        <option value="5">Office </option>
                    </select>
                </div>

                <div class="col-lg-6 px-2">
                    <label for="transaction_description">category description</label>
                    <input id="transaction_description" name="transaction_description" type="text" class="form-control p-4"
                        placeholder="Category Description">
                </div>
            </div>




            <div class="row mb-0 mx-auto ">
                <div class="col-lg-4 px-2">
                    <label for="cost_amount">Cost Amount :</label>
                    <input type="number" name="cost_amount" placeholder="transaction amount"
                        class="mb-3 form-control p-4" id="cost_amount">
                </div>
                <div class="col-lg-4 px-2">
                    <label for="add_amount">Add Amount :</label>
                    <input type="number" name="add_amount" placeholder="add amount" class="mb-3 form-control p-4"
                        id="add_amount">
                </div>
                <div class="col-lg-4">
                    <label for="member_cost">Member Cost</label>
                    <select class="select_member form-control" name="additional_cost_user">
                        <option selected disabled>--- select members ---</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id }}" >{{ $user->name }}</option>
                            @endforeach
                      </select>
                </div>
            </div>


        </div>
        <button type="submit" class="btn btn-dark p-4 my-3 w-100">Submit</button>
    </form>


    @push('backend_js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(function() {
                // Function to set negative values to 0
                function setNegativeValuesToZero() {
                    var transactionAmount = parseFloat($("#cost_amount").val()) || 0;
                    var addAmount = parseFloat($("#add_amount").val()) || 0;

                    // If cost_amount is less than 0, set it to 0
                    if (transactionAmount < 0) {
                        $("#cost_amount").val(0);
                        transactionAmount = 0;
                    }

                    // If add_amount is less than 0, set it to 0
                    if (addAmount < 0) {
                        $("#add_amount").val(0);
                        addAmount = 0;
                    }
                }

                // Function to update the submit button state
                function updateSubmitButtonState() {
                    var transactionAmount = parseFloat($("#cost_amount").val()) || 0;
                    var addAmount = parseFloat($("#add_amount").val()) || 0;

                    // Enable the submit button if at least one field has a value greater than 0
                    if (transactionAmount > 0 || addAmount > 0) {
                        $('button[type="submit"]').prop('disabled', false);
                    } else {
                        $('button[type="submit"]').prop('disabled', true);
                    }
                }

                // Event listener for keyup on cost_amount and add_amount input fields
                $("#cost_amount, #add_amount").on('keyup', function() {
                    setNegativeValuesToZero(); // Set negative values to 0
                    updateSubmitButtonState(); // Update the button state
                });

                // Event listener for form submission
                $('#transaction').on('submit', function(e) {
                    e.preventDefault(); // Prevent the form from submitting immediately

                    // Calculate the total amount
                    var transactionAmount = parseFloat($("#cost_amount").val()) || 0;
                    var addAmount = parseFloat($("#add_amount").val()) || 0;
                    var totalAmount = transactionAmount + addAmount;

                    // Get the form data
                    var formData = $(this).serializeArray();

                    // Add the total amount to the form data
                    formData.push({
                        name: "total_amount",
                        value: totalAmount
                    });

                    // Send the form data via AJAX
                    $.ajax({
                        url: "{{ route('backend.transaction.store') }}", // Replace with your route
                        type: "POST",
                        data: $.param(formData), // Convert array to URL-encoded string
                        success: function(response) {
                            // Show the alert on successful data insertion
                            Swal.fire({
                                title: "Good job!",
                                text: "Transaction Inserted Successfully!",
                                icon: "success",
                                timer: 3000,
                            }).then(() => {
                                // Redirect after the alert is closed
                                window.location.href =
                                    "{{ route('dashboard') }}"; // Fixed syntax error
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

                // Initialize the button state on page load
                setNegativeValuesToZero();
                updateSubmitButtonState();
            });




            // SELECT 
            $('.select_member').select2();
        </script>



    @endpush
@endsection
