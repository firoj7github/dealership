@extends('layouts.app')

@section('content')

<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card prod-p-card card-red">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col">
                                        <h6 class="m-b-5 text-white">Total User</h6>
                                        <h3 class="m-b-0 f-w-700 text-white">{{ count($users) }}</h3>
                                    </div>
                                    <div class="col-auto">
                                        {{-- <i class="fas fa-money-bill-alt text-c-red f-18"></i> --}}
                                    </div>
                                </div>
                                <a class="m-b-0 float-right" href="{{route('dealer.management')}}"><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card prod-p-card card-blue">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col">
                                        <h6 class="m-b-5 text-white">Total Dealer</h6>
                                        <h3 class="m-b-0 f-w-700 text-white">{{ $dealers }}</h3>
                                    </div>
                                    <div class="col-auto">
                                        {{-- <i class="fas fa-database text-c-blue f-18"></i> --}}
                                    </div>
                                </div>
                                <a class="m-b-0 float-right" href="{{route('dealer.management')}}"><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card prod-p-card card-green">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col">
                                        <h6 class="m-b-5 text-white">Total Inventory</h6>
                                        <h3 class="m-b-0 f-w-700 text-white">{{$inventories}}</h3>
                                    </div>
                                    <div class="col-auto">
                                        {{-- <i class="fas fa-tags text-c-yellow f-18"></i> --}}
                                    </div>
                                </div>
                                <a class="m-b-0 float-right" href="#"><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card prod-p-card card-yellow">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col">
                                        <h6 class="m-b-5 text-white">Today Dealer</h6>
                                        <h3 class="m-b-0 f-w-700 text-white">0</h3>
                                    </div>
                                    <div class="col-auto">
                                        {{-- <i class="fas fa-dollar-sign text-c-green f-18"></i> --}}
                                    </div>
                                </div>
                                <a class="m-b-0 float-right" href="#"><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
