@extends('frontend.layout')
@section('frontend_contains')
    <div class="row">


        <div class="row mt-5">
            <div class="col-lg-6 mx-auto shadow py-3">

                <form class="p-3" id="register" action="{{ route('backend.login.check.auth') }}" method="post"
                class="shadow-sm p-4">
                @csrf
    
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="email">Email</label>
                        <input name="email"  id="email" type="email" placeholder="enter your email"
                            class="p-4 form-control mb-3">
                    </div>
                    
                    <div class="col-lg-12 mb-3">
                        <label for="password">Password</label>
                        <input name="password"  id="password" type="password" placeholder="password"
                            class="p-4 form-control ">
                    </div>
                </div>
                <button type="submit" class="btn btn-dark w-100 mx-auto mt-3 p-4 ">submit</button>
            </form>
            </div>
        </div>


    </div>

    @push('frontend_js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      
    @endpush
@endsection
