@extends('frontend.layout')

@section('frontend_contains')
    <div class="row">
        <div class="heading">
            <h4 class="mt-5 text-center">Edit Registration for Tour 2025</h4>
        </div>

        <form class="p-3" id="register" action="{{ route('backend.edit.user.update', $editUser->id) }}" method="post" class="shadow-sm p-4">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-6">
                    <label for="name">Name <b class="text-danger">*</b></label>
                    <input name="name" value="{{ old('name', $editUser->name) }}" id="name" type="text" placeholder="name"
                        class="p-4 form-control mb-3">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6">
                    <label for="email">Email <b class="text-danger">*</b></label>
                    <input value="{{ old('email', $editUser->email) }}" required name="email" id="email" type="text" placeholder="email"
                        class="p-4 form-control mb-3">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-4">
                    <label for="password">Make a Password</label>
                    <input name="password" id="password" type="password" placeholder="password"
                        class="p-4 form-control mb-3">
                </div>

                <div class="col-lg-4">
                    <label for="password">Make a New Password</label>
                    <input name="password" id="password" type="password" placeholder="new password"
                        class="p-4 form-control mb-3">
                </div>
                
                <div class="col-lg-4">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input name="password_confirmation" id="password_confirmation" type="password" placeholder="confirm new password" class="p-4 form-control mb-3">
                </div>
                

                <div class="col-lg-4">
                    <span>Are you interested? <b class="text-danger">*</b></span> <br> <br>
                    <label for="yes">YES</label>
                    <input value="1" name="is_going" id="yes" type="radio" {{ $editUser->is_going == 1 ? 'checked' : '' }} class=" mb-3">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label for="no">NO</label>
                    <input value="0" name="is_going" id="no" type="radio" {{ $editUser->is_going == 0 ? 'checked' : '' }} class=" mb-3">

                    @error('is_going')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-4">
                    <label for="phone">Contact Number <b class="text-danger">*</b></label>
                    <input required name="phone" value="{{ old('phone', $editUser->phone) }}" id="phone" type="number" placeholder="phone"
                        class="p-4 form-control mb-3">
                </div>

                <div class="col-lg-4">
                    <label for="additional_members">Additional Members<b class="text-danger">*</b></label>
                    <input  name="additional_members" id="additional_members" type="number" placeholder="add additional members" class="p-4 form-control mb-3">
                </div>

                <div class="col-lg-6 mb-3">
                    <label for="m_size">Select Amount of T-shirt</label> <br>
                    <div class="row g-3">
                        <div class="col-lg-3">
                            <input name="m_size" class="form-control p-4" value="{{ old('m_size', $editUser->m_size) }}" type="number" placeholder="M Size">
                        </div>
                        <div class="col-lg-3">
                            <input name="l_size" class="form-control p-4" value="{{ old('l_size', $editUser->l_size) }}" type="number" placeholder="L Size">
                        </div>
                        <div class="col-lg-3">
                            <input name="xl_size" class="form-control p-4" value="{{ old('xl_size', $editUser->xl_size) }}" type="number" placeholder="XL Size">
                        </div>
                        <div class="col-lg-3">
                            <input name="xxl_size" class="form-control p-4" value="{{ old('xxl_size', $editUser->xxl_size) }}" type="number" placeholder="XXL Size">
                        </div>
                    </div>
                    <span class="text-danger" id="tshirt-error" style="display: none;">Please provide at least one T-shirt size.</span>
                </div>

                <div class="col-lg-6 mb-3">
                    <div class="row" id="room-error">
                        <div class="col-lg-6 mb-3">
                            <label for="single_room">Amount of Single Room</label>
                            <input type="number" id="single_room" name="single_room" value="{{ old('single_room', $editUser->single_room) }}" class="form-control p-4"
                                placeholder="amount : 01">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="couple_room">Amount of Couple Room</label>
                            <input type="number" id="couple_room" name="couple_room" value="{{ old('couple_room', $editUser->couple_room) }}" class="form-control p-4"
                                placeholder="amount : 01">
                        </div>
                    </div>
                    <span class="text-danger" id="room-error-message" style="display: none;">Please provide at least one room amount (single or couple).</span>
                </div>

                <div class="col-lg-12">
                    <label for="opinion">Any opinion?</label>
                    <textarea id="opinion" name="opinion" placeholder="Any opinion?" rows="6" class="p-3 form-control mb-3">{{ old('opinion', $editUser->opinion) }}</textarea>
                </div>

                <button type="submit" class="btn btn-dark w-100 mx-auto mt-3 p-4 ">Submit</button>
            </div>
        </form>
    </div>
@endsection
