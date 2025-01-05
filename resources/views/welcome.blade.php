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
            <span style="color: #E42625;"><iconify-icon icon="carbon:view-filled" width="24"
                    height="24"></iconify-icon></span>
            <h3 class="text-center mb-3">Creative Cox's Tour 2025</h3>
        </div>

        <div class="col-lg-4 text-center mx-auto">
            <div class="shadow p-5">
                <span
                    style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;"><iconify-icon
                        icon="material-symbols:note-alt-rounded" width="24" height="24"></iconify-icon></span>
                <h4 class="mt-3"> <a style="text-decoration: none; color:#000;"
                        href="{{ route('backend.registrations.view') }}">Register Members</a> </h4>
            </div>
        </div>


        <div class="col-lg-4 text-center">
            <div class="shadow p-5">
                <span
                    style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;"><iconify-icon
                        icon="mingcute:car-fill" width="24" height="24"></iconify-icon></span>
                <h4 class="mt-3"><a style="text-decoration: none; color:#000;"
                        href="{{ route('backend.transport.view') }}">Transport Schedule</a></h4>
            </div>
        </div>




        <div class="col-lg-4 text-center">
            <div class="shadow p-5">
                {{-- <h4 class="mt-3">Food Menu</h4> --}}
                <span
                    style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;"><iconify-icon
                        icon="healthicons:unhealthy-food-24px" width="24" height="24"></iconify-icon></span>
                <h4 class="mt-3"><a style="text-decoration: none; color:#000;"
                        href="{{ route('backend.foods.view') }}">Food Menu</a></h4>
            </div>
        </div>



        <div class="col-lg-4 text-center mx-auto">
            <div class="shadow p-5">
                <span
                    style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;"><iconify-icon
                        icon="healthicons:money-bag" width="24" height="24"></iconify-icon></span>
                <h4 class="mt-3"> <a style="text-decoration: none; color:#000;"
                        href="{{ route('backend.transaction.view') }}">Transaction</a></h4>
            </div>
        </div>










    </div>
@endsection
