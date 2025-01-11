@extends('frontend.layout')
@section('frontend_contains')


    <div class="row mt-2 g-3">

        <div class="header text-center">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h3 class="text-center mb-3">Creative Cox's Tour 2025 </h3>
        </div>




        <div class="col-lg-6 mx-auto text-center">
            <div class="shadow">
                <a href="{{ route('register') }}">
                    <div class="h-100 d-flex py-5 align-items-center justify-content-center flex-column">
                        <span
                            style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;">
                            <iconify-icon icon="pepicons-pop:bulletin-notice" width="20" height="20"></iconify-icon>
                        </span>
                        <h4 class="mt-3">
                            <a href="{{ route('register') }}" style="text-decoration: none;color:#000;">Take Registration</a>
                        </h4>
                    </div>
                </a>
            </div>
        </div>












    </div>


@endsection
