@extends('backend.layout')
@section('backend_contains')
    <div class="row mt-3 mb-5 g-3">

        <div class="header text-center">
            <h3 class="text-center mb-3">Creative Cox's Tour 2025 </h3>
        </div>


        @if (Auth::user()->status == 1)
            
            <div class="col-lg-6 text-center">
                <div class="shadow">
                    <a href="{{ route('backend.transaction.store') }}">
                        <div class="h-100 d-flex py-5 align-items-center justify-content-center flex-column">
                            <span
                                style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;">
                                <iconify-icon icon="si:money-fill" width="24" height="24"></iconify-icon>
                            </span>
                            <h4 class="mt-3">
                                <a href="{{ route('backend.transaction.store') }}" style="text-decoration: none;color:#000;">Add Transaction</a>
                            </h4>
                        </div>
                    </a>
                </div>
            </div>


            <div class="col-lg-6 text-center">
                <div class="shadow">
                    <a href="{{ route('backend.transaction.pdf') }}">
                        <div class="h-100 d-flex py-5 align-items-center justify-content-center flex-column">
                            <span
                                style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;">
                                <iconify-icon icon="carbon:report" width="24" height="24"></iconify-icon>
                            </span>
                            <h4 class="mt-3">
                                <a target="_blank" href="{{ route('backend.transaction.pdf') }}"" style="text-decoration: none;color:#000;">Report</a>
                            </h4>
                        </div>
                    </a>
                </div>
            </div>


            
            <div class="col-lg-6 text-center">
                <div class="shadow">
                    <a href="{{ route('backend.registrations.view') }}">
                        <div class="h-100 d-flex py-5 align-items-center justify-content-center flex-column">
                            <span
                                style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;">
                                <iconify-icon icon="hugeicons:note" width="24" height="24"></iconify-icon>
                            </span>
                            <h4 class="mt-3">
                                <a  href="{{ route('backend.registrations.view') }}"" style="text-decoration: none;color:#000;">Registration Summary</a>
                            </h4>
                        </div>
                    </a>
                </div>
            </div>





        @endif


        <div class="col-lg-6 text-center">
            <div class="shadow">
                <a href="{{ route('backend.transaction.individual') }}">
                    <div class="h-100 d-flex py-5 align-items-center justify-content-center flex-column">
                        <span
                            style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;">
                            <iconify-icon icon="healthicons:money-bag" width="24" height="24"></iconify-icon>
                        </span>
                        <h4 class="mt-3">
                            <a href="{{ route('backend.transaction.individual') }}" style="text-decoration: none;color:#000;">Individual Cost</a>
                        </h4>
                    </div>
                </a>
            </div>
        </div>



        <div class="col-lg-6 text-center mx-auto">
            <div class="shadow">
                <a href="{{ route('backend.additional.index') }}">
                    <div class="h-100 d-flex py-5 align-items-center justify-content-center flex-column">
                        <span
                            style="width:40px;height:40px;display:inline-block;background:#E42625;color:#fff; text-align:center; line-height:50px;border-radius:50%;">
                            <iconify-icon icon="lucide:user-round" width="24" height="24"></iconify-icon>
                        </span>
                        <h4 class="mt-3">
                            <a href="{{ route('backend.additional.index') }}" style="text-decoration: none;color:#000;">Add Additional Members</a>
                        </h4>
                    </div>
                </a>
            </div>
        </div>


    </div>
@endsection
