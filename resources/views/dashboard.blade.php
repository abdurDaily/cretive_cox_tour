@extends('backend.layout')
@section('backend_contains')
    <div class="row my-5 g-3">

        <div class="header text-center">
            <span style="color: #E42625"><iconify-icon icon="eos-icons:admin" width="24"
                    height="24"></iconify-icon></span>
            <h3 class="text-center mb-5">Creative Cox's Tour 2025 </h3>
        </div>


        @if (Auth::user()->status == 1)

        <div class="col-lg-4 text-center">
            <div class="shadow p-5">
                <span
                    style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;"><iconify-icon
                        icon="mingcute:car-fill" width="24" height="24"></iconify-icon></span>
                <h4 class="mt-3"><a href="{{ route('backend.transport.transport') }}"
                        style="text-decoration: none;color:#000;">Transport Schedule</a></h4>
            </div>
        </div>





        <div class="col-lg-4 text-center">
            <div class="shadow p-5">
                <span
                    style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;"><iconify-icon
                        icon="healthicons:unhealthy-food-24px" width="24" height="24"></iconify-icon></span>
                <h4 class="mt-3"><a href="{{ route('backend.foods.foods') }}"
                        style="text-decoration: none;color:#000;">Food Menu</a></h4>
            </div>
        </div>


        <div class="col-lg-4 text-center">
            <div class="shadow p-5">
                <span
                    style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;"><iconify-icon
                        icon="healthicons:money-bag" width="24" height="24"></iconify-icon></span>
                <h4 class="mt-3"><a href="{{ route('backend.transaction.store') }}"
                        style="text-decoration: none;color:#000;">Transaction</a></h4>

            </div>
        </div>
        @endif

   
            <div class="col-lg-4 text-center">
                <div class="shadow p-5">
                    <span
                        style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;">
                        <iconify-icon icon="healthicons:money-bag" width="24" height="24"></iconify-icon>
                    </span>
                    <h4 class="mt-3">
                        <a href="{{ route('backend.additional.index') }}"
                            style="text-decoration: none;color:#000;">Additional Members</a>
                    </h4>
                </div>
            </div>

    
            <div class="col-lg-4 text-center">
                <div class="shadow p-5">
                    <span
                        style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;">
                        <iconify-icon icon="healthicons:money-bag" width="24" height="24"></iconify-icon>
                    </span>
                    <h4 class="mt-3">
                        <a href="{{ route('backend.transaction.individual') }}"
                            style="text-decoration: none;color:#000;">Individual Cost</a>
                    </h4>
                </div>
            </div>
    







    </div>
@endsection
