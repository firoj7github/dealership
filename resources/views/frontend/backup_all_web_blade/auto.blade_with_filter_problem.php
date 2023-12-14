@extends('frontend.layouts.app')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

.range-slider {
    position: relative;
    width: 100%;
    height: 5px;
    margin: 30px 0;
    background-color: #8a8a8a;
}

.slider-track {
    height: 100%;
    position: absolute;
    background-color: #fe696a;

}


.range-slider input {
    position: absolute;
    width: 100%;
    background: none;
    pointer-events: none;
    top: 50%;
    transform: translateY(-50%);
    appearance: none;
}

input[type="range"]::-webkit-slider-thumb {
    height: 25px;
    width: 25px;
    border-radius: 50%;
    border: 3px solid #fff;
    background: #fff;
    pointer-events: auto;
    appearance: none;
    cursor: pointer;
    box-shadow: 0 .125rem .5625rem -0.125rem rgba(0, 0, 0, .25);

}

input[type="range"]::-moz-range-thumb {
    height: 25px;
    width: 25px;
    border-radius: 50%;
    border: 3px solid #fff;
    background: #fff;
    pointer-events: auto;
    cursor: pointer;
    -moz-appearance: none;
    box-shadow: 0 .125rem .5625rem -0.125rem rgba(0, 0, 0, .25);
}

.tooltip {
    position: absolute;
    background: #373f50;
    color: #fff;
    font-size: 1.5rem;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    white-space: nowrap;
    z-index: 1;
    top: -2rem;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.2s;
}


.tooltip::before {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid #373f50;
    bottom: -6px;
    left: 60%;
    transform: translateX(-50%);
}


.min-tooltip {
    left: 50%;
    transform: translateX(-50%) translateY(-100%);
    z-index: 5;
}

.max-tooltip {
    right: 50%;
    transform: translateX(50%) translateY(-100%);
}

/* Hide tooltips initially */
.min-tooltip,
.max-tooltip {
    opacity: 0;
}

.input-box {
    display: flex;
}

.min-box,
.max-box {
    width: 50%;
}

.min-box {
    padding-right: .5rem;
    margin-right: .5rem;
}

.input-wrap {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%
}

.input-addon {
    display: flex;
    align-items: center;
    padding: .625rem 1rem;
    font-size: 0.9375rem;
    font-weight: 400;
    line-height: 1.5;
    color: #4b566b;
    text-align: center;
    white-space: nowrap;
    background-color: #fff;
    border: 1px solid #d4d7e5;
    border-radius: .25rem;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;

}

.input-field {
    margin-left: -1px;
    padding: .425rem .75rem;
    font-size: 1.5rem;
    border-radius: .25rem;
    position: relative;
    flex: 1 1 auto;
    width: 1%;
    min-width: 0;
    color: #4b566b;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #d4d7e5;
    border-top-left-radius: 0;
    border-bottom-right-radius: 0;
}

.input-field:focus {
    outline: none;
}


/* //mileage  css */
.slider-track-mileage {
    height: 100%;
    position: absolute;
    background-color: #fe696a;
}


.input-addon-mileage {
    display: flex;
    align-items: center;
    padding: .625rem 1rem;
    font-size: 0.9375rem;
    font-weight: 400;
    line-height: 1.5;
    color: #4b566b;
    text-align: center;
    white-space: nowrap;
    background-color: #fff;
    border: 1px solid #d4d7e5;
    border-radius: .25rem;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;

}

.min-mileage-tooltip {
    left: 50%;
    transform: translateX(-50%) translateY(-100%);
    z-index: 5;
}

.max-mileage-tooltip {
    right: 50%;
    transform: translateX(50%) translateY(-100%);
}

/* Hide tooltips initially */
/* .min-mileage-tooltip,
.max-mileage-tooltip {
    opacity: 0;
} */


/* Year Range CSS */
.slider-track-year {
    height: 100%;
    position: absolute;
    background-color: #fe696a;
    /* Change color as needed */
}

.slider-track-payment {
    height: 100%;
    position: absolute;
    background-color: #fe696a;
    /* Change color as needed */
}

.input-addon-year {
    display: flex;
    align-items: center;
    padding: .625rem 1rem;
    font-size: 0.9375rem;
    font-weight: 400;
    line-height: 1.5;
    color: #4b566b;
    text-align: center;
    white-space: nowrap;
    background-color: #fff;
    border: 1px solid #d4d7e5;
    border-radius: .25rem;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.min-year-tooltip {
    left: 50%;
    transform: translateX(-50%) translateY(-100%);
    z-index: 5;
}

.max-year-tooltip {
    right: 50%;
    transform: translateX(50%) translateY(-100%);
}

.min-payment-tooltip {
    left: 50%;
    transform: translateX(-50%) translateY(-100%);
    z-index: 5;
}

.max-payment-tooltip {
    right: 50%;
    transform: translateX(50%) translateY(-100%);
}

    .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 50px !important;
    position: absolute !important;
    top: 1px !important;
    right: 1px !important;
    width: 20px !important;
}

</style>
<!-- =-=-=-=-=-=-= Breadcrumb =-=-=-=-=-=-= -->
<div class="page-header-area-2 gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="small-breadcrumb">
                    <div class="breadcrumb-link">
                        <ul>
                            <li><a href="{{ route('home') }}">Home Page</a></li>
                            <li><a class="active" href="#">Listing</a></li>
                        </ul>
                    </div>
                    <div class="header-page">
                        <h1>Cars Listing</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-= Breadcrumb End =-=-=-=-=-=-= -->
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix">
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding no-top gray">
        <!-- Main Container -->
        <div class="container">
            {{--<div class="home-add">
                <img src="{{asset('frontend/images/top.jpg')}}" alt="" />
            </div>--}}
                    <!-- Related Image  -->
                    <div class="banner">
                        <img class="auto-img" src="{{asset('frontend/images/top.jpg')}}" alt="">
                    </div>



            <!-- Row -->
            <div class="row">
                <!-- Middle Content Area -->
                <div class="col-md-8 col-md-push-4 col-lg-8 col-sx-12" id="autoData">
                    <!-- Row -->
                    <div class="filter_data"></div>
                    {{--@include('frontend.auto_ajax')--}}
                    <!-- Row End -->
                </div>


                <!-- Middle Content Area  End -->






                <!-- Left Sidebar -->
                <div class="col-md-4 col-md-pull-8 col-sx-12 side-section">
                    <!-- Sidebar Widgets -->
                    <div class="sidebar">
                        <!-- Panel group -->
                        <div class="panel-group" id="sidebar" role="tablist" aria-multiselectable="true">
                            <!-- Brands Panel -->
                            <div class="panel panel-default">




                                <div class="panel panel-default">
                                    <!-- Heading -->
                                    <div class="panel-heading" role="tab" id="heading800">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                data-parent="#sidebar" href="#collapse800" aria-expanded="false"
                                                aria-controls="collapse800">
                                                <p class="more-less" style="color:rgb(10, 93, 126)">Clear All</p>
                                                Query Result
                                            </a>
                                        </h4>
                                    </div>
                                    <!-- Content -->
                                    <div id="collapse800" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="heading800">
                                        <div class="panel-body">
                                            <div class="">
                                                <h4><strong>Are you confirm ?</strong></h4>
                                                <p>This action will clear all your queries.</p>

                                                <button class="btn btn-info" id="cancelButton">Cancel</button>
                                                <a href="{{ route('autos') }}" class="btn btn-danger">Clear All</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Condition Panel start here marif -->






                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="headingTwoMobile">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapseTwoMobile" aria-expanded="false" aria-controls="collapseTwoMobile">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Search Any / Price
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapseTwoMobile" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="headingTwoMobile">
                                    <div class="panel-body">
                                        <!-- Search -->
                                        <div class="search-widget">
                                            <input placeholder="Search by Car Name" type="text">
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                        <!-- price List -->

                                        <div class="double-slider-box">
                                            <h3 class="range-title ">Price Range </h3>
                                            <div class="range-slider" style="margin-top:5rem">
                                                <span class="slider-track"></span>

                                                <input type="range" name="min_value" class="common_selector min-val"
                                                    min="{{$inventory_min_price}}" max="{{$inventory_max_price}}" value="{{$inventory_min_price}}" oninput="slideMin()">
                                                <input type="range" name="max_value" class="common_selector max-val"
                                                    min="{{$inventory_min_price}}" max="{{$inventory_max_price}}" value="{{$inventory_max_price}}" oninput="slideMax()">
                                                <div class="tooltip min-tooltip"></div>
                                                <div class="tooltip max-tooltip"></div>
                                            </div>
                                            <div class="input-box">
                                                <div class="min-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon">$</span>
                                                        <input type="text" name="min_input" id="min_input"
                                                            class="common_selector input-field min-input" onchange="setMinInput()" value="{{(request('min') ? request('min') : 1000 ) }}">
                                                    </div>
                                                </div>
                                                <div class="max-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon">$</span>
                                                        <input type="text" name="max_input" id="max_input"
                                                            class="common_selector input-field max-input" onchange="setMaxInput()" value="{{(request('max') ? request('max') : 80000 ) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="double-slider-box">
                                            <h3 class="range-title">Miles Range</h3>
                                            <div class="range-slider" style="margin-top:5rem">
                                                <span class="slider-track-mileage"></span>
                                                <input type="range" name="min_miles" class="common_selector min-mile"
                                                    min="5000" max="160000" value="5000" oninput="slideMinMileage()">
                                                <input type="range" name="max_miles" class="common_selector max-mile"
                                                    min="5000" max="160000" value="160000" oninput="slideMaxMileage()">

                                                <div class="tooltip min-mileage-tooltip"></div>
                                                <div class="tooltip max-mileage-tooltip"></div>
                                            </div>
                                            <div class="input-box">
                                                <div class="min-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon-mileage">Miles</span>
                                                        <input type="text" name="min_miles_input" id="min_mileage_input"
                                                            class="common_selector input-field min-mileage-input"
                                                            onchange="setMinMileageInput()" value="5000">

                                                    </div>
                                                </div>
                                                <div class="max-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon">Miles</span>
                                                        <input type="text" name="max_miles_input" id="max_mileage_input"
                                                            class="common_selector input-field max-mileage-input"
                                                            onchange="setMaxMileageInput()" value="{{(request('miles') ? request('miles') : 160000 ) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="double-slider-box">
                                            <h3 class="range-title">Year Range</h3>
                                            <div class="range-slider" style="margin-top:5rem">
                                                <span class="slider-track-year"></span>
                                                @php
                                                $year_data = date('Y');
                                                @endphp
                                                <input type="range" name="min_years" class="common_selector min-year"
                                                    min="1901" max="{{$year_data}}" value="1901"
                                                    oninput="slideMinYear()">
                                                <input type="range" name="max_years" class="common_selector max-year"
                                                    min="1901" max="{{$year_data}}" value="{{$year_data}}"
                                                    oninput="slideMaxYear()">
                                                <div class="tooltip min-year-tooltip"></div>
                                                <div class="tooltip max-year-tooltip"></div>
                                            </div>
                                            <div class="input-box">
                                                <div class="min-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon-year">Year:</span>
                                                        <input type="text" name="min_years_input" id="min_years_input" value="{{(request('min-year') ? request('min-year') : 1901 ) }}"
                                                            class="common_selector input-field min-year-input"
                                                            onchange="setMinYearInput()">
                                                    </div>
                                                </div>
                                                <div class="max-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon-year">Year:</span>
                                                        <input type="text" name="max_years_input" id="max_years_input" value="{{(request('max-year') ? request('max-year') : $year_data ) }}"
                                                            class="common_selector input-field max-year-input"
                                                            onchange="setMaxYearInput()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="double-slider-box">
                                            <h3 class="range-title">Payment Range</h3>
                                            <div class="range-slider" style="margin-top: 5rem">
                                                <span class="slider-track-payment"></span>
                                                <input type="range" name="min_payment"
                                                    class="common_selector min-payment" min="50" max="1500" value="50"
                                                    oninput="slideMinPayment()">
                                                <input type="range" name="max_payment"
                                                    class="common_selector max-payment" min="50" max="1500"
                                                    value="5000" oninput="slideMaxPayment()">
                                                <div class="tooltip min-payment-tooltip"></div>
                                                <div class="tooltip max-payment-tooltip"></div>
                                            </div>
                                            <div class="input-box">
                                                <div class="min-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon-year">Payment:</span>
                                                        <input type="text" name="min_payment_input"
                                                            id="min_payment_input" class="common_selector input-field min-payment-input" value="{{(request('min-payment') ? request('min-payment') : 50 ) }}"
                                                            onchange="setMinPaymentInput()">
                                                    </div>
                                                </div>
                                                <div class="max-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon-year">Payment:</span>
                                                        <input type="text" name="max_payment_input"
                                                            id="max_payment_input" class="common_selector input-field max-payment-input" value="{{(request('max-payment') ? request('max-payment') : 1500 ) }}"
                                                            onchange="setMaxPaymentInput()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- price List End -->
                                    </div>
                                </div>
                            </div>
                            <!-- any /price Panel End -->
                            <!-- Make  Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading9001">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse901" aria-expanded="false" aria-controls="collapse901">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Make /Model & Body
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse901" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading9001">
                                    <div class="panel-body">
                                        <div class="card">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#home"
                                                        aria-controls="home" role="tab" data-toggle="tab">Make/Model</a>
                                                </li>
                                                <li role="presentation"><a href="#profile" aria-controls="profile"
                                                        role="tab" data-toggle="tab">Body Style</a></li>

                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content" style="width:100%">
                                                <div role="tabpanel" class="tab-pane active" id="home">
                                                    <label for="make">Make</label>
                                                    <select name="" id="make_filter_input"
                                                        class="common_selector maker">
                                                        <option value="" selected>All Make</option>
                                                        @foreach($inventory_make_list as $makefilter => $makefilterid)
                                                        <option value="{{ $makefilter }}"
                                                            @selected(request('make')===$makefilter ? 'selected' : '' )>
                                                            {{ $makefilter }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="model">Model</label>
                                                    <select name="" id="model_filter_input"
                                                        class="common_selector modeler">
                                                        <option value="">All Model</option>
                                                        @foreach($inventory_model_list as $modelfilter =>
                                                        $modelfilterid)
                                                        <option value="{{ $modelfilter }}"
                                                            @selected(request('model')===$modelfilter ? 'selected' : ''
                                                            )>{{ $modelfilter }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="profile">
                                                    <select name="" id="body_filter_input"
                                                        class="common_selector bodies">
                                                        <option value="">All Body</option>
                                                        @foreach($inventory_body as $bodyfilter => $bodyfilterid)
                                                        <option value="{{ $bodyfilter }}"
                                                            @selected(request('body')===$bodyfilter ? 'selected' : '' )>
                                                            {{ $bodyfilter }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- make model Panel start here marif -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading9">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse90" aria-expanded="false" aria-controls="collapse90">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Make
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse90" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading9">
                                    <div class="panel-body">
                                        <div class="">
                                            <ul class="list">

                                                <li>
                                                    <input type="checkbox">
                                                    <label for="minimal-checkbox-1">&nbsp;&nbsp;&nbsp;<a
                                                            href="{{ route('autos') }}" style="color:black">
                                                            All Make</a></label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector brand"
                                                        style="color:black" value="Audi">
                                                    <label for="minimal-checkbox-2">&nbsp;&nbsp;&nbsp;Audi </label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector brand"
                                                        style="color:black" value="BMW">
                                                    <label for="minimal-checkbox-3">&nbsp;&nbsp;&nbsp;BMW</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector brand"
                                                        style="color:black" value="Mercedes-Benz">
                                                    <label
                                                        for="minimal-checkbox-4">&nbsp;&nbsp;&nbsp;Mercedes-Benz</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector brand"
                                                        style="color:black" value="Chevrolet">
                                                    <label for="minimal-checkbox-5">&nbsp;&nbsp;&nbsp;Chevrolet</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector brand"
                                                        style="color:black" value="Honda">
                                                    <label for="minimal-checkbox-6">&nbsp;&nbsp;&nbsp;Honda</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector brand"
                                                        style="color:black" value="Jeep">
                                                    <label for="minimal-checkbox-7">&nbsp;&nbsp;&nbsp;Jeep</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="minimal-checkbox-8"
                                                        class="common_selector brand" style="color:black" value="Acura">
                                                    <label for="minimal-checkbox-8">&nbsp;&nbsp;&nbsp;Acura</label>
                                                </li>

                                                <a href=".cat_modal037" data-toggle="modal"
                                                    class="pull-right"><strong>View
                                                        All</strong></a>
                                            </ul>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Make Panel start here marif -->
                            <!-- Body Type Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading7">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Body Type
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse7" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading7">
                                    <div class="panel-body">
                                        <div class="">
                                            <ul class="list">
                                                @php
                                                $body_count = count($inventory_body);
                                                @endphp
                                                @foreach($inventory_body as $body => $body_id)
                                                <li>
                                                    <input type="checkbox" class="common_selector body"
                                                        value="{{ $body }}" style="color:black"
                                                        @checked(request('body')===$body ? 'checked' : '' )>
                                                    <label for="body">&nbsp;&nbsp;&nbsp;{{ $body }}</label>
                                                    {{--<a href="{{ route('autos', ['body&filter' => $body]) }}"
                                                    style="color:black">
                                                    {{ $body }}</a>--}}

                                                </li>

                                                @endforeach

                                                @if($body_count >= 9)
                                                <a href=".cat_modal036" data-toggle="modal"
                                                    class="pull-right"><strong>View
                                                        All</strong></a>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Condition Panel End -->


                            <!-- Condition Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading9">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Transmission
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse9" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading9">
                                    <div class="panel-body">
                                        <div class="">
                                            <ul class="list">
                                                @foreach($inventory_transmission as $transmission => $transmission_id)
                                                <li>
                                                    <input type="checkbox" class="common_selector transmission"
                                                        value="{{ $transmission }}" style="color:black">
                                                    <label for="transmission">&nbsp;&nbsp;&nbsp;{{ $transmission }}
                                                    </label>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Condition Panel start here marif -->

                            <!-- Year Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading8">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Select Year
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse8" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading8">
                                    <div class="panel-body">
                                        <!-- Year List -->
                                        <div class="">
                                            <ul class="list">
                                                @foreach($inventory_year as $year => $year_id)
                                                <li>
                                                    <input type="checkbox" class="common_selector year"
                                                        value="{{$year}}" style="color:black"
                                                        @checked(request('min-year')==$year ||
                                                        request('max-year')==$year? 'checked' : '' )>

                                                    <label for="year">&nbsp;&nbsp;&nbsp;{{$year}}
                                                    </label>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- Year List End -->
                                    </div>
                                </div>
                            </div>
                            <!-- Year Panel End -->
                            <!-- Latest Ads Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a>
                                            Recent Listings
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div class="panel-collapse">
                                    <div class="panel-body recent-ads">


                                        @forelse($inventory_related_ad as $related_ad)
                                        <!-- Ads -->
                                        <div class="recent-ads-list">
                                            <div class="recent-ads-container">
                                                <div class="recent-ads-list-image">
                                                    <a href="{{ route('auto.details', $related_ad->id) }}"
                                                        class="recent-ads-list-image-inner">
                                                        <img src="{{ $related_ad->image }}" alt="">
                                                    </a><!-- /.recent-ads-list-image-inner -->
                                                </div>
                                                <!-- /.recent-ads-list-image -->
                                                <div class="recent-ads-list-content">
                                                    <h3 class="recent-ads-list-title">
                                                        <a href="{{ route('auto.details', $related_ad->id) }}">{{ $related_ad->title }}</a>
                                                    </h3>
                                                    <ul class="recent-ads-list-location">
                                                        <li>{{ $related_ad->dealer_address_formate }}</li>
                                                    </ul>
                                                    <div class="recent-ads-list-price">
                                                        {{ $related_ad->price_formate }}
                                                    </div>
                                                    <!-- /.recent-ads-list-price -->
                                                </div>
                                                <!-- /.recent-ads-list-content -->
                                            </div>
                                            <!-- /.recent-ads-container -->
                                        </div>

                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <!-- Latest Ads Panel End -->
                        </div>
                        <!-- panel-group end -->
                    </div>
                    <!-- Sidebar Widgets End -->
                </div>
                <!-- Left Sidebar End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Main Container End -->
    </section>
    <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
    <!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->

</div>
<!-- Main Content Area End -->

<!-- =-=-=-=-=-=-= Body Modal =-=-=-=-=-=-= -->
<div class="search-modal modal fade cat_modal036" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>
                <h3 class="modal-title text-center"> Select Makes </h3>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <div class="search-block">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12 popular-search">
                            <label>Select Makes</label>
                            <!-- Brands List -->
                            <div class="">
                                <ul class="list">
                                    @foreach($inventory_body as $body => $body_id)
                                    <li>
                                        <input type="checkbox" class="common_selector body" value="{{ $body }}"
                                            style="color:black" @checked(request('body')===$body ? 'checked' : '' )>
                                        <label for="body">&nbsp;&nbsp;&nbsp;{{ $body }}</label>
                                        {{--<a href="{{ route('autos', ['body&filter' => $body]) }}"
                                        style="color:black">
                                        {{ $body }}</a>--}}

                                    </li>
                                    @endforeach


                                </ul>
                            </div>
                            <!-- Body List End -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-block">Search</button>
            </div>
        </div>
    </div>
</div>

<!-- Body modal end -->

<!-- =-=-=-=-=-=-= Make Modal =-=-=-=-=-=-= -->
<div class="search-modal modal fade cat_modal037" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>
                <h3 class="modal-title text-center"> Select Makes </h3>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <div class="search-block">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12 popular-search">
                            <label>Select Makes</label>
                            <!-- Brands List -->
                            <div class="">
                                <ul class="list">
                                    @foreach($inventory_make_list as $brand => $make_list)
                                    <li class="col-sm-4 col-xs-6">
                                        <input type="checkbox" class="mobile_common_selector brand" style="color:black"
                                            value="{{ $brand}}" @checked(request('make')===$brand ? 'checked' : '' )>
                                        <label for="r1">{{ $brand}}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Brands List End -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-block">Search</button>
            </div>
        </div>
    </div>
</div>

<!-- sidebar open modal start -->

{{-- login modal show start here --}}

<div class="modal fade" id="favourite_add_auth_modal" tabindex="-1" aria-labelledby="exampleModalLabel10"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel10">Add Your Favorites</h3>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 p-4">
                            <form>
                                <div class="row mb-3" id="rowOne">

                                    <div class="form-group" id="replace_html">
                                        <p class="text-center">Sign up to view your favorite cars across devices and get
                                            price drop alerts.</p>
                                        <label>E-mail</label>
                                        <input placeholder="Enter Your E-mail" class="form-control" type="text"
                                            name="email" id="email" style="width: 95% !important;">
                                        <div class="text-danger error_email"></div>
                                        <a href="#" class="btn btn-danger" style="margin: 30px;float:right"
                                            id="CheckEmail">Continue</a>
                                    </div>
                                    <div class="form-group" id="login_field" style="display: none">
                                        <h3 class="text-center fw-bold text-dark">Welcome Back !</h3>
                                        <h4 class="text-center fw-bold">Please Enter Your Password to Log In.</h4>
                                        <h4 class="text-center fw-bold"><i class="fa fa-envelope"></i> <span
                                                id="email_session_one"></span></h4><br /><br />
                                        <input type="hidden" id="inventory_id_pass">
                                        <label>Password</label>
                                        <input placeholder="Enter Your Password" class="form-control" type="password"
                                            name="password" id="password" style="width: 95% !important;">
                                        <input type="hidden" name="email_session_one" class="email_session_one">
                                        <div class="text-danger error_password"></div>
                                        <a href="#" class="btn btn-danger" style="margin: 30px;float:right"
                                            id="login">Login</a>
                                    </div>
                                </div>
                                <div class="row mb-3" style="display:none" id="rowTwo">
                                    <h3 class="text-center fw-bold">Sign up</h3>
                                    <h4 class="text-center fw-bold"><i class="fa fa-envelope"></i> <span
                                            id="email_session_two"></span></h4>
                                    {{-- <label>First Name</label>
                                    <input placeholder="Enter Your First Name" class="form-control"
                                        type="text" name="fname" id="fname"
                                        style="width: 95% !important;"><br />

                                    <label>Last Name</label>
                                    <input placeholder="Enter Your Last Name" class="form-control" type="text"
                                        name="lname" id="lname" style="width: 95% !important;"><br />

                                    <label>E-mail</label>
                                    <input placeholder="Enter Your Email" class="form-control" type="email"
                                        name="email" id="email" style="width: 95% !important;"><br />

                                    <label>Password</label>
                                    <input placeholder="Password" class="form-control" type="password"
                                        name="res_password" id="res_password" style="width: 95% !important;"><br />

                                    <label>Confirm Password</label>
                                    <input placeholder="Confirm Password" class="form-control" type="password"
                                        name="confirm_password" id="confirm_password"
                                        style="width: 95% !important;"><br /> --}}
                                    <label>Password</label>
                                    <input placeholder="Enter Your Password" class="form-control" type="password"
                                        name="password" id="res_password" style="width: 95% !important;">
                                    <input type="hidden" name="email_session" class="email_session_two">
                                    <div class="text-danger sign_up_email"></div>
                                    <div class="text-danger sign_up_password"></div>
                                    <a href="#" class="btn btn-danger" style="margin: 30px;float:right"
                                        id="SignUp">Create Account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- login modal show end here --}}



{{-- siderbar modal start --}}


<!-- Modal -->
<div class="modal fade" id="sidebarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>

            </div>
            <div class="modal-body">
                <div class="col-md-4 col-md-pull-8 col-sx-12 ">
                    <!-- Sidebar Widgets -->
                    <div class="sidebar">
                        <!-- Panel group -->
                        <div class="panel-group" id="sidebar" role="tablist" aria-multiselectable="true">
                            <!-- Brands Panel -->
                            <div class="panel panel-default">


                            <div class="panel panel-default">
                                    <!-- Heading -->
                                    <div class="panel-heading" role="tab" id="heading800">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                data-parent="#sidebar" href="#collapse800mobile" aria-expanded="false"
                                                aria-controls="collapse800mobile">
                                                <p class="more-less" style="color:rgb(10, 93, 126)">Clear All</p>
                                                Query Result
                                            </a>
                                        </h4>
                                    </div>
                                    <!-- Content -->
                                    <div id="collapse800mobile" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="heading800">
                                        <div class="panel-body">
                                            <div class="">
                                                <h4><strong>Are you confirm ?</strong></h4>
                                                <p>This action will clear all your queries.</p>

                                                <button class="btn btn-info " id="cancelButtonMobile">Cancel</button>
                                                <a href="{{ route('autos') }}" class="btn btn-danger">Clear All</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Search Any / Price
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <!-- Search -->
                                        <div class="search-widget">
                                            <input placeholder="Search by Car Name" type="text">
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                        <!-- price List -->

                                        {{--<div class="double-slider-box">
                                            <h3 class="range-title ">Price Range Slider</h3>
                                            <div class="range-slider" style="margin-top:5rem">
                                                <span class="slider-track"></span>

                                                <input type="range" name="min_value" class="common_selector min-val"
                                                    min="1000" max="80000" value="1000" oninput="slideMin()">
                                                <input type="range" name="max_value" class="common_selector max-val"
                                                    min="1000" max="80000" value="80000" oninput="slideMax()">
                                                <div class="tooltip min-tooltip"></div>
                                                <div class="tooltip max-tooltip"></div>
                                            </div>
                                            <div class="input-box">
                                                <div class="min-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon">$</span>
                                                        <input type="text" name="min_input" id="min_input_mobile"
                                                            class=" input-field min-input" onchange="setMinInput()" value="{{(request('min') ? request('min') : 1000 ) }}">
                                                    </div>
                                                </div>
                                                <div class="max-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon">$</span>
                                                        <input type="text" name="max_input" id="max_input_mobile"
                                                            class=" input-field max-input" onchange="setMaxInput()" value="{{(request('max') ? request('max') : 80000 ) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="double-slider-box">
                                            <h3 class="range-title">Miles Slider</h3>
                                            <div class="range-slider" style="margin-top:5rem">
                                                <span class="slider-track-mileage"></span>
                                                <input type="range" name="min_miles" class="common_selector min-mile"
                                                    min="5000" max="160000" value="5000" oninput="slideMinMileage()">
                                                <input type="range" name="max_miles" class="common_selector max-mile"
                                                    min="5000" max="160000" value="160000" oninput="slideMaxMileage()">

                                                <div class="tooltip min-mileage-tooltip"></div>
                                                <div class="tooltip max-mileage-tooltip"></div>
                                            </div>
                                            <div class="input-box">
                                                <div class="min-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon-mileage">Miles</span>
                                                        <input type="text" name="min_miles_input" id="min_mileage_input"
                                                            class="common_selector input-field min-mileage-input"
                                                            onchange="setMinMileageInput()">

                                                    </div>
                                                </div>
                                                <div class="max-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon">Miles</span>
                                                        <input type="text" name="max_miles_input" id="max_mileage_input"
                                                            class="common_selector input-field max-mileage-input"
                                                            onchange="setMaxMileageInput()" value="{{(request('miles') ? request('miles') : 160000 ) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="double-slider-box">
                                            <h3 class="range-title">Year Slider</h3>
                                            <div class="range-slider" style="margin-top:5rem">
                                                <span class="slider-track-year"></span>
                                                @php
                                                $year_data = date('Y');
                                                @endphp
                                                <input type="range" name="min_years" class="common_selector min-year"
                                                    min="1901" max="{{$year_data}}" value="1901"
                                                    oninput="slideMinYear()">
                                                <input type="range" name="max_years" class="common_selector max-year"
                                                    min="1901" max="{{$year_data}}" value="{{$year_data}}"
                                                    oninput="slideMaxYear()">
                                                <div class="tooltip min-year-tooltip"></div>
                                                <div class="tooltip max-year-tooltip"></div>
                                            </div>
                                            <div class="input-box">
                                                <div class="min-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon-year">Year:</span>
                                                        <input type="text" name="min_years_input" id="min_years_input" value="{{(request('min-year') ? request('min-year') : 1901 ) }}"
                                                            class="common_selector input-field min-year-input"
                                                            onchange="setMinYearInput()">
                                                    </div>
                                                </div>
                                                <div class="max-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon-year">Year:</span>
                                                        <input type="text" name="max_years_input" id="max_years_input" value="{{(request('max-year') ? request('max-year') : $year_data ) }}"
                                                            class="common_selector input-field max-year-input"
                                                            onchange="setMaxYearInput()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="double-slider-box">
                                            <h3 class="range-title">Payment Range Slider</h3>
                                            <div class="range-slider" style="margin-top: 5rem">
                                                <span class="slider-track-payment"></span>
                                                <input type="range" name="min_payment"
                                                    class="common_selector min-payment" min="50" max="5000" value="100"
                                                    oninput="slideMinPayment()">
                                                <input type="range" name="max_payment"
                                                    class="common_selector max-payment" min="50" max="5000"
                                                    value="5000" oninput="slideMaxPayment()">
                                                <div class="tooltip min-payment-tooltip"></div>
                                                <div class="tooltip max-payment-tooltip"></div>
                                            </div>
                                            <div class="input-box">
                                                <div class="min-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon-year">Payment:</span>
                                                        <input type="text" name="min_payment_input"
                                                            id="min_payment_input" class="common_selector input-field min-payment-input" value="{{(request('min-payment') ? request('min-payment') : 50 ) }}"
                                                            onchange="setMinPaymentInput()">
                                                    </div>
                                                </div>
                                                <div class="max-box">
                                                    <div class="input-wrap">
                                                        <span class="input-addon-year">Payment:</span>
                                                        <input type="text" name="max_payment_input"
                                                            id="max_payment_input" class="common_selector input-field max-payment-input" value="{{(request('max-payment') ? request('max-payment') : 5000 ) }}"
                                                            onchange="setMaxPaymentInput()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>--}}

                                        <div class="card">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active">
                                                    <a href="#homeMobilePrice" aria-controls="homeMobilePrice" data-toggle="tab">Price</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#profileMobileYear" aria-controls="profileMobileYear" data-toggle="tab">Year</a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content" style="width:100%">
                                                <div role="presentation" class="tab-pane active" id="homeMobilePrice">
                                                    <label for="min_price_mobile">Minimum Price</label>
                                                    <select name="min_price_mobile" id="mobile_min_price"
                                                        class="mobile_common_selector form-control">
                                                        <option selected value="">Min Price</option>
                                                            <option value="1000">$1,000</option>
                                                            <option value="2000">$2,000</option>
                                                            <option value="3000">$3,000</option>
                                                            <option value="4000">$4,000</option>
                                                            <option value="5000">$5,000</option>
                                                            <option value="6000">$6,000</option>
                                                            <option value="7000">$7,000</option>
                                                            <option value="8000">$8,000</option>
                                                            <option value="10000">$10,000</option>
                                                            <option value="12000">$12,000</option>
                                                            <option value="15000">$15,000</option>
                                                            <option value="20000">$20,000</option>
                                                            <option value="25000">$25,000</option>
                                                            <option value="30000">$30,000</option>
                                                            <option value="40000">$40,000</option>
                                                            <option value="50000">$50,000</option>
                                                            <option value="75000">$75,000</option>
                                                    </select>

                                                    <label for="max_price_mobile">Maximum Price</label>
                                                    <select name="max_price_mobile" id="mobile_max_price"
                                                        class="mobile_common_selector form-control">
                                                            <option selected value="">Max Price</option>
                                                            <option value="1000">$1,000</option>
                                                            <option value="2000">$2,000</option>
                                                            <option value="3000">$3,000</option>
                                                            <option value="4000">$4,000</option>
                                                            <option value="5000">$5,000</option>
                                                            <option value="6000">$6,000</option>
                                                            <option value="7000">$7,000</option>
                                                            <option value="8000">$8,000</option>
                                                            <option value="10000">$10,000</option>
                                                            <option value="12000">$12,000</option>
                                                            <option value="15000">$15,000</option>
                                                            <option value="20000">$20,000</option>
                                                            <option value="25000">$25,000</option>
                                                            <option value="30000">$30,000</option>
                                                            <option value="40000">$40,000</option>
                                                            <option value="50000">$50,000</option>
                                                            <option value="75000">$75,000</option>
                                                    </select>
                                                </div>
                                                <div role="tabpanel1" class="tab-pane" id="profileMobileYear">
                                                <label for="min-year-mobile">Minimum Year</label>
                                                <select class="mobile_common_selector form-control" name="min-year-mobile" id="min_year_mobile">
                                                            <option selected value="">Min Year</option>
                                                            @for($i= date('Y'); $i>= 1901 ; $i--)
                                                            <option value="{{$i}}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    <label for="max-year-mobile">Maximum Year</label>
                                                    <select class="mobile_common_selector form-control" name="max-year-mobile" id="max_year_mobile">
                                                            <option selected value="">Max Year</option>
                                                            @for($i= date('Y'); $i>= 1901 ; $i--)
                                                            <option value="{{$i}}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- price List End -->
                                    </div>
                                </div>
                            </div>
                            <!-- any /price Panel End -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading8001MobilePayment">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse801MobileMiles" aria-expanded="false" aria-controls="collapse801MobileMiles">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Miles / Payment
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse801MobileMiles" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading8001MobilePayment">
                                    <div class="panel-body">
                                        <div class="card">
                                            <ul class="nav nav-tabs" role="tablist">
                                            <li  role="presentation01" class="active"><a href="#profileMobilepayment" aria-controls="profileMobilepayment"
                                                        role="tab" data-toggle="tab">Payment</a></li>
                                                <li role="presentation" ><a href="#homeMobilemiles"
                                                        aria-controls="homeMobilemiles" role="tab" data-toggle="tab">Miles</a>
                                                </li>


                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content" style="width:100%">

                                            <div role="tabpanel" class="tab-pane active" id="profileMobilepayment">
                                                <label for="make">Minimum Payment</label>
                                                <select class="mobile_common_selector form-control" name="min-payment_mobile" id="min_payment_mobile">
                                                            <option selected value="">Min Payment</option>
                                                            <option value="100">$100</option>
                                                            <option value="150">$150 </option>
                                                            <option value="200">$200 </option>
                                                            <option value="250">$250 </option>
                                                            <option value="300">$300 </option>
                                                            <option value="350">$350 </option>
                                                            <option value="400">$400 </option>
                                                            <option value="450">$450 </option>
                                                            <option value="500">$500 </option>
                                                            <option value="550">$550 </option>
                                                            <option value="600">$600 </option>
                                                            <option value="650">$650 </option>
                                                            <option value="700">$700 </option>
                                                            <option value="750">$750 </option>
                                                            <option value="800">$800 </option>
                                                            <option value="850">$850 </option>
                                                            <option value="900">$900 </option>
                                                            <option value="950">$950 </option>
                                                        </select>
                                                    <label for="model">Maximum Payment</label>
                                                    <select class="mobile_common_selector form-control" name="max-payment_mobile" id="max_payment_mobile">
                                                            <option selected value="">Max Payment</option>
                                                            <option value="100">$100</option>
                                                            <option value="150">$150 </option>
                                                            <option value="200">$200 </option>
                                                            <option value="250">$250 </option>
                                                            <option value="300">$300 </option>
                                                            <option value="350">$350 </option>
                                                            <option value="400">$400 </option>
                                                            <option value="450">$450 </option>
                                                            <option value="500">$500 </option>
                                                            <option value="550">$550 </option>
                                                            <option value="600">$600 </option>
                                                            <option value="650">$650 </option>
                                                            <option value="700">$700 </option>
                                                            <option value="750">$750 </option>
                                                            <option value="800">$800 </option>
                                                            <option value="850">$850 </option>
                                                            <option value="900">$900 </option>
                                                            <option value="950">$950 </option>
                                                        </select>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="homeMobilemiles">
                                                    <label for="model">Maximum Miles</label>
                                                    <select name="" id="mobile_max_miles"
                                                        class="mobile_common_selector form-control">
                                                            <option selected value="">Max Mileage</option>
                                                            <option value="10000">10,000 miles</option>
                                                            <option value="25000">25,000 miles </option>
                                                            <option value="50000">50,000 miles </option>
                                                            <option value="75000">75,000 miles </option>
                                                            <option value="100000">100,000 miles</option>
                                                            <option value="150000">150,000 miles</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="panel panel-default">--}}
                                <!-- Heading -->
                                {{--<div class="panel-heading" role="tab" id="heading9001Mobile">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse901Mobile" aria-expanded="false" aria-controls="collapse901Mobile">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Make /Model & Body
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse901Mobile" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading9001Mobile">
                                    <div class="panel-body">
                                        <div class="card">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#homeMobile"
                                                        aria-controls="homeMobile" role="tab" data-toggle="tab">Make/Model</a>
                                                </li>
                                                <li role="presentation"><a href="#profileMobile" aria-controls="profileMobile"
                                                        role="tab" data-toggle="tab">Body Style</a></li>

                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content" style="width:100%">
                                                <div role="tabpanel" class="tab-pane active" id="homeMobile">
                                                    <label for="make">Make</label>
                                                    <select name="" id="make_filter_input_mobile"
                                                        class="common_selector form-control">
                                                        <option value="" selected>All Make</option>
                                                        @foreach($inventory_make_list as $makefilter => $makefilterid)
                                                        <option value="{{ $makefilter }}"
                                                            @selected(request('make')===$makefilter ? 'selected' : '' )>
                                                            {{ $makefilter }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="model">Model</label>
                                                    <select name="" id="model_filter_input_mobile"
                                                        class="common_selector ">
                                                        <option value="">All Model</option>
                                                        @foreach($inventory_model_list as $modelfilter =>
                                                        $modelfilterid)
                                                        <option value="{{ $modelfilter }}"
                                                            @selected(request('model')===$modelfilter ? 'selected' : ''
                                                            )>{{ $modelfilter }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="profileMobile">
                                                    <select name="" id="body_filter_input_mobile"
                                                        class="common_selector bodies">
                                                        <option value="">All Body</option>
                                                        @foreach($inventory_body as $bodyfilter => $bodyfilterid)
                                                        <option value="{{ $bodyfilter }}"
                                                            @selected(request('body')===$bodyfilter ? 'selected' : '' )>
                                                            {{ $bodyfilter }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>--}}
                            {{--</div>--}}
                            <!-- any make/model Panel End -->
                            <!-- Make  Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="headingMobile9001">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapseMobile901" aria-expanded="false" aria-controls="collapseMobile901">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Make /Model & Body
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapseMobile901" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingMobile9001">
                                    <div class="panel-body">
                                        <div class="card">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#homeMobile"
                                                        aria-controls="homeMobile" role="tab" data-toggle="tab">Make/Model</a>
                                                </li>
                                                <li role="presentation"><a href="#profileMobile" aria-controls="profileMobile"
                                                        role="tab" data-toggle="tab">Body Style</a></li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content" style="width:100%">
                                                <div role="tabpanel" class="tab-pane active" id="homeMobile">
                                                    <label for="make">Make</label>
                                                    <select name="" id="make_filter_input_mobile"
                                                        class="mobile_common_selector form-control">
                                                        <option value="" selected>All Make</option>
                                                        @foreach($inventory_make_list as $make => $makeid)
                                                        <option value="{{ $make }}"
                                                            @selected(request('make')===$make ? 'selected' : '' )>
                                                            {{ $make }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="model">Model</label>
                                                    <select name="" id="model_filter_input_mobile"
                                                        class="mobile_common_selector form-control">
                                                        <option value="">All Model</option>
                                                        @foreach($inventory_model_list as $modelfilter =>
                                                        $modelfilterid)
                                                        <option value="{{ $modelfilter }}"
                                                            @selected(request('model')===$modelfilter ? 'selected' : ''
                                                            )>{{ $modelfilter }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="profileMobile">
                                                    <select name="" id="body_filter_input_mobile"
                                                        class="mobile_common_selector">
                                                        <option value="">All Body</option>
                                                        @foreach($inventory_body as $bodyfilter => $bodyfilterid)
                                                        <option value="{{ $bodyfilter }}"
                                                            @selected(request('body')===$bodyfilter ? 'selected' : '' )>
                                                            {{ $bodyfilter }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Make  Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading9Mobile">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse90Mobile" aria-expanded="false" aria-controls="collapse90Mobile">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Make
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse90Mobile" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading9Mobile">
                                    <div class="panel-body">
                                        <div class="">
                                            <ul class="list">

                                                <li>
                                                    <input type="checkbox">
                                                    <label for="minimal-checkbox-1">&nbsp;&nbsp;&nbsp;<a
                                                            href="{{ route('autos') }}" style="color:black">
                                                            All Make</a></label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="mobile_common_selector brand"
                                                        style="color:black" value="Audi">
                                                    <label for="minimal-checkbox-2">&nbsp;&nbsp;&nbsp;Audi </label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="mobile_common_selector brand"
                                                        style="color:black" value="BMW">
                                                    <label for="minimal-checkbox-3">&nbsp;&nbsp;&nbsp;BMW</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="mobile_common_selector brand"
                                                        style="color:black" value="Mercedes-Benz">
                                                    <label
                                                        for="minimal-checkbox-4">&nbsp;&nbsp;&nbsp;Mercedes-Benz</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="mobile_common_selector brand"
                                                        style="color:black" value="Chevrolet">
                                                    <label for="minimal-checkbox-5">&nbsp;&nbsp;&nbsp;Chevrolet</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="mobile_common_selector brand"
                                                        style="color:black" value="Honda">
                                                    <label for="minimal-checkbox-6">&nbsp;&nbsp;&nbsp;Honda</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="mobile_common_selector brand"
                                                        style="color:black" value="Jeep">
                                                    <label for="minimal-checkbox-7">&nbsp;&nbsp;&nbsp;Jeep</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="minimal-checkbox-8"
                                                        class="mobile_common_selector brand" style="color:black" value="Acura">
                                                    <label for="minimal-checkbox-8">&nbsp;&nbsp;&nbsp;Acura</label>
                                                </li>

                                                <a href=".cat_modal037" data-toggle="modal"
                                                    class="pull-right"><strong>View
                                                        All</strong></a>
                                            </ul>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Make Panel start here marif -->
                            <!-- Body Type Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading7Mobile">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse7Mobile" aria-expanded="false" aria-controls="collapse7Mobile">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Body Type
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse7Mobile" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading7Mobile">
                                    <div class="panel-body">
                                        <div class="">
                                            <ul class="list">
                                                @php
                                                $body_count = count($inventory_body);
                                                @endphp
                                                @foreach($inventory_body as $body => $body_id)
                                                <li>
                                                    <input type="checkbox" class="common_selector body"
                                                        value="{{ $body }}" style="color:black"
                                                        @checked(request('body')===$body ? 'checked' : '' )>
                                                    <label for="body">&nbsp;&nbsp;&nbsp;{{ $body }}</label>
                                                    {{--<a href="{{ route('autos', ['body&filter' => $body]) }}"
                                                    style="color:black">
                                                    {{ $body }}</a>--}}

                                                </li>

                                                @endforeach

                                                @if($body_count >= 9)
                                                <a href=".cat_modal036" data-toggle="modal"
                                                    class="pull-right"><strong>View
                                                        All</strong></a>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Condition Panel End -->


                            <!-- Condition Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading9Mobile">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse9Mobile" aria-expanded="false" aria-controls="collapse9Mobile">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Transmission
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse9Mobile" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading9Mobile">
                                    <div class="panel-body">
                                        <div class="">
                                            <ul class="list">
                                                @foreach($inventory_transmission as $transmission => $transmission_id)
                                                <li>
                                                    <input type="checkbox" class="mobile_common_selector transmission"
                                                        value="{{ $transmission }}" style="color:black">
                                                    <label for="transmission">&nbsp;&nbsp;&nbsp;{{ $transmission }}
                                                    </label>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Condition Panel start here marif -->

                            <!-- Year Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading8Mobile">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse8Mobile" aria-expanded="false" aria-controls="collapse8Mobile">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Select Year
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse8Mobile" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading8Mobile">
                                    <div class="panel-body">
                                        <!-- Year List -->
                                        <div class="">
                                            <ul class="list">
                                                @foreach($inventory_year as $year => $year_id)
                                                <li>
                                                    <input type="checkbox" class="mobile_common_selector year"
                                                        value="{{$year}}" style="color:black"
                                                        @checked(request('min-year')==$year ||
                                                        request('max-year')==$year? 'checked' : '' )>

                                                    <label for="year">&nbsp;&nbsp;&nbsp;{{$year}}
                                                    </label>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- Year List End -->
                                    </div>
                                </div>
                            </div>
                            <!-- Year Panel End -->

                            <!-- Latest Ads Panel -->

                            <!-- Latest Ads Panel End -->
                        </div>
                        <!-- panel-group end -->
                    </div>
                    <!-- Sidebar Widgets End -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary apply-btn mobileBtnSubmit" id="mobileBtnSubmit" data-dismiss="modal">Apply</button>
            </div>
        </div>
    </div>
</div>
{{-- siderbar modal close --}}

<button type="button" class="btn btn-primary" id="popup-show-button" data-toggle="modal" data-target="#sidebarModal">
    Filter Sidebar
</button>
<style>
#loading {
    text-align: center;
    background:url("{{ asset('frontend/images') }}/loader.gif") no-repeat center;
    height: 150px;
}
</style>
@endsection

@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


















    $('#make_filter_input, #make_filter_input_mobile').change(function() {
        var url = "{{ route('frontend.ajax.model') }}"
        var make = $(this).val();
        $.ajax({
            url: url,
            type: 'get',

            data: {
                make: make
            },
            success: function(data) {
                // toastr.success(data);
                $('#model_filter_input, #model_filter_input_mobile').empty();
                $('#model_filter_input, #model_filter_input_mobile').append('<option selected disabled>All Model</option>');
                $.each(data, function(index, item) {
                    $('#model_filter_input, #model_filter_input_mobile').append('<option value="' + index + '">' +
                        index + '</option>');
                });
            },
            error: function(error) {
                console.log(error);
                // toastr.error(error.responseJSON.message);
            }
        });
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();

        console.log('Pagination link clicked 2421221.');
        // Extract the page number from the link's href attribute
        // var page = $(this).attr('href').split('page=')[1];
        var page = $(this).attr('href').split('page=')[1];

        // Update your filter_data function to include the page parameter
        function filter_data(page) {
            $('.filter_data').html('<div id="loading" style=""></div>');
            var action = 'fetch_data';
            var mimimun_price = $('#min_input').val();
            var maximun_price = $('#max_input').val();
            var mimimun_mileage = $('#min_mileage_input').val();
            var maximun_mileage = $('#max_mileage_input').val();
            var mimimun_years = $('#min_years_input').val();
            var maximun_years = $('#max_years_input').val();
            var make_filter = $('#make_filter_input').val();
            var model_filter = $('#model_filter_input').val();
            var brand = get_filter('brand');
            var transmission = get_filter('transmission');
            var body = get_filter('body');
            var year = get_filter('year');
            var min_price_mobile= $('#mobile_min_price').val();
            var max_price_mobile= $('#mobile_max_price').val();
            var min_year_mobile= $('#min_year_mobile').val();
            var max_year_mobile= $('#max_year_mobile').val();
            var min_payment_mobile = $('#min_payment_mobile').val();
            var max_payment_mobile = $('#max_payment_mobile').val();
            var mobile_max_miles= $('#mobile_max_miles').val();
            var make_filter_input_mobile =  $('#make_filter_input_mobile').val();
            var model_filter_input_mobile= $('#model_filter_input_mobile').val();
            var body_filter_input_mobile= $('#body_filter_input_mobile').val();
            $.ajax({
                url: "{{ route('auto_filter.ajax') }}",
                type: "GET",
                data: {
                    action: action,
                    mimimun_price: mimimun_price,
                    maximun_price: maximun_price,
                    mimimun_mileage: mimimun_mileage,
                    maximun_mileage: maximun_mileage,
                    mimimun_years: mimimun_years,
                    maximun_years: maximun_years,
                    ajaxmake: make_filter,
                    ajaxmodel: model_filter,
                    ajaxtransmission: transmission,
                    ajaxyear: year,
                    ajaxbody: body,
                    min_price_mobile:min_price_mobile,
                    max_price_mobile:max_price_mobile,
                    min_year_mobile:min_year_mobile,
                    max_year_mobile:max_year_mobile,
                    min_payment_mobile:min_payment_mobile,
                    max_payment_mobile:max_payment_mobile,
                    mobile_max_miles:mobile_max_miles,
                    make_filter_input_mobile:make_filter_input_mobile,
                    model_filter_input_mobile:model_filter_input_mobile,
                    body_filter_input_mobile:body_filter_input_mobile,
                    // ajaxbrand: brand,
                    page:page
                },
                success: function(data) {
                    $('.filter_data').html(data)
                    console.log('AJAX request successful.');
                    console.log(data)
                },
                error: function(error) {
                    console.log(error)
                }

            });
        }

        // Call filter_data with the new page number
        filter_data(page);


    });


    filter_data();

    function filter_data(page) {
        $('.filter_data').html('<div id="loading" style=""></div>');
        var action = 'fetch_data';
        var mimimun_price = $('#min_input').val();
        var maximun_price = $('#max_input').val();
        var mimimun_mileage = $('#min_mileage_input').val();
        var maximun_mileage = $('#max_mileage_input').val();
        var mimimun_years = $('#min_years_input').val();
        var maximun_years = $('#max_years_input').val();
        var minimun_payment = $('#min_payment_input').val();
        var maximun_payment = $('#max_payment_input').val();
        var make_filter = $('#make_filter_input').val();
        var model_filter = $('#model_filter_input').val();
        var body_filter = $('#body_filter_input').val();
        var make_filter_mobile = $('#make_filter_input_mobile').val();
        var model_filter_mobile = $('#model_filter_input_mobile').val();
        var body_filter_mobile = $('#body_filter_input_mobile').val();
        var brand = get_filter('brand');
        var transmission = get_filter('transmission');
        var body = get_filter('body');
        var year = get_filter('year');
        var min_price_mobile= $('#mobile_min_price').val();
        var max_price_mobile= $('#mobile_max_price').val();
        var min_year_mobile= $('#min_year_mobile').val();
        var max_year_mobile= $('#max_year_mobile').val();
        var min_payment_mobile = $('#min_payment_mobile').val();
        var max_payment_mobile = $('#max_payment_mobile').val();
        var mobile_max_miles= $('#mobile_max_miles').val();
        var make_filter_input_mobile =  $('#make_filter_input_mobile').val();
        var model_filter_input_mobile= $('#model_filter_input_mobile').val();
        var body_filter_input_mobile= $('#body_filter_input_mobile').val();


        var page = $(this).data('page');
// alert(body_filter_mobile);
        $.ajax({
            url: "{{ route('auto_filter.ajax') }}",
            type: "GET",
            data: {
                action: action,
                mimimun_price: mimimun_price,
                maximun_price: maximun_price,
                mimimun_mileage: mimimun_mileage,
                maximun_mileage: maximun_mileage,
                mimimun_years: mimimun_years,
                maximun_years: maximun_years,
                minimun_payment: minimun_payment,
                maximun_payment: maximun_payment,
                ajaxmake: make_filter,
                ajaxmodel: model_filter,
                ajaxbodies: body_filter,
                ajaxmakeMobile: make_filter_mobile,
                ajaxmodelMobile: model_filter_mobile,
                ajaxbodiesMobile: body_filter_mobile,
                ajaxtransmission: transmission,
                ajaxyear: year,
                ajaxbody: body,
                ajaxbrand: brand,
                min_price_mobile:min_price_mobile,
                max_price_mobile:max_price_mobile,
                min_year_mobile:min_year_mobile,
                max_year_mobile:max_year_mobile,
                min_payment_mobile:min_payment_mobile,
                max_payment_mobile:max_payment_mobile,
                mobile_max_miles:mobile_max_miles,
                make_filter_input_mobile:make_filter_input_mobile,
                model_filter_input_mobile:model_filter_input_mobile,
                body_filter_input_mobile:body_filter_input_mobile,
                // max_year_miles_mobile:max_year_miles,
                page:page,

            },
            success: function(data) {
                $('.filter_data').html(data)
                console.log(data)
            },
            error: function(error) {
                console.log(error)
            }

        });
    }

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
            filter.push($(this).val());
        });
        return filter; // Add this line to return the filter array
    }


    $(document).on("click change",".common_selector", function(event) {
        event.preventDefault()
        filter_data();
    });

    $(document).on('click change', ".mobile_common_selector",function(e){
        e.stopPropagation();
        filter_data();
    });


    //update wislist start
    //goto auto ajax blade file
    //update wislist end

    //checkavailaibality start
    //goto auto ajax blade file
    //checkavailaibality end

    $('#tradeChecked').on('change', function() {

        var isChecked = this.checked;
        if (isChecked == true) {
            $('#Trade_block_content').css('display', 'block');
        } else {
            $('#Trade_block_content').css('display', 'none');
        }


    });







    //signup start
    // goto auto ajax file
    //signup end

    //login start
    // goto auto ajax file
    //logins end


});
</script>
<script>
//  window.onload = function(){
//     slideMin();
//     slideMax();
//     slideMinMileage();
//     slideMaxMileage();
// }


const minVal = document.querySelector(".min-val");
const maxVal = document.querySelector(".max-val");
const priceInputMin = document.querySelector(".min-input");
const priceInputMax = document.querySelector(".max-input");
const minToolTip = document.querySelector(".min-tooltip");
const maxToolTip = document.querySelector(".max-tooltip");
const minGap = 1000;
const range = document.querySelector(".slider-track");
const sliderMinValue = parseInt(minVal.min);
const sliderMaxValue = parseInt(maxVal.max);

function slideMin() {
    let gap = parseInt(maxVal.value) - parseInt(minVal.value);
    if (gap <= minGap) {
        minVal.value = parseInt(maxVal.value) = minGap;
    }
    minToolTip.innerHTML = "$" + minVal.value;
    priceInputMin.value = minVal.value;
    setArea();
}

function slideMax() {
    let gap = parseInt(maxVal.value) - parseInt(minVal.value);
    if (gap <= minGap) {
        maxVal.value = parseInt(minVal.value) + minGap;
    }
    maxToolTip.innerHTML = "$" + maxVal.value;
    priceInputMax.value = maxVal.value;
    setArea();
}

function setArea() {
    const minValPercent = ((minVal.value - sliderMinValue) / (sliderMaxValue - sliderMinValue)) * 100;
    const maxValPercent = ((maxVal.value - sliderMinValue) / (sliderMaxValue - sliderMinValue)) * 100;

    range.style.left = minValPercent + "%";
    range.style.right = 100 - maxValPercent + "%";

    // Adjust tooltip positions above the slider thumbs
    minToolTip.style.left = minValPercent + "%";
    maxToolTip.style.right = 100 - maxValPercent + "%";

    // Set tooltip opacity to make them visible
    minToolTip.style.opacity = 1;
    maxToolTip.style.opacity = 1;

    // Format and set tooltip values with commas
    const formattedMinVal = numberWithCommas(minVal.value);
    const formattedMaxVal = numberWithCommas(maxVal.value);

    minToolTip.textContent = "$" + formattedMinVal;
    maxToolTip.textContent = "$" + formattedMaxVal;
}

// Function to format numbers with commas
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function setMinInput() {
    let minPrice = parseInt(priceInputMin.value)
    if (minPrice < sliderMinValue) {
        priceInputMin.value = sliderMinValue
    }
    minVal.value = priceInputMin.value;
    slideMin();
}

function setMaxInput() {
    let maxPrice = parseInt(priceInputMax.value)
    if (maxPrice > sliderMaxValue) {
        priceInputMax.value = sliderMaxValue
    }
    maxVal.value = priceInputMax.value;
    slideMax();
}




// Year Range JavaScript 100% work
const minYearVal = document.querySelector(".min-year");
const maxYearVal = document.querySelector(".max-year");
const YearInputMin = document.querySelector(".min-year-input");
const YearInputMax = document.querySelector(".max-year-input");
const minYearToolTip = document.querySelector(".min-year-tooltip");
const maxYearToolTip = document.querySelector(".max-year-tooltip");
const minYearGap = 1; // Change the gap as needed
const yearRange = document.querySelector(".slider-track-year");
const sliderYearMinValue = parseInt(minYearVal.min);
const sliderYearMaxValue = parseInt(maxYearVal.max);



function setYearArea() {
    const minYearValPercent = ((minYearVal.value - sliderYearMinValue) / (sliderYearMaxValue - sliderYearMinValue)) *
        100;
    const maxYearValPercent = ((maxYearVal.value - sliderYearMinValue) / (sliderYearMaxValue - sliderYearMinValue)) *
        100;

    yearRange.style.left = minYearValPercent + "%";
    yearRange.style.right = 100 - maxYearValPercent + "%";

    // Adjust tooltip positions above the slider thumbs
    minYearToolTip.style.left = minYearValPercent + "%";
    maxYearToolTip.style.right = 100 - maxYearValPercent + "%";

    // Set tooltip opacity to make them visible
    minYearToolTip.style.opacity = 1;
    maxYearToolTip.style.opacity = 1;
}

function slideMinYear() {
    let gap = parseInt(maxYearVal.value) - parseInt(minYearVal.value);
    if (gap <= minYearGap) {
        minYearVal.value = parseInt(maxYearVal.value) = minYearGap;
    }
    // minYearToolTip.innerHTML = minYearVal.value;
    minYearToolTip.innerHTML = minYearVal.value;
    YearInputMin.value = minYearVal.value;
    setYearArea();
}

function slideMaxYear() {
    let gap = parseInt(maxYearVal.value) - parseInt(minYearVal.value);
    if (gap <= minYearGap) {
        maxYearVal.value = parseInt(minYearVal.value) + minYearGap;
    }
    maxYearToolTip.innerHTML = maxYearVal.value;
    YearInputMax.value = maxYearVal.value;
    setYearArea();
}

//mileage js

const minMileageVal = document.querySelector(".min-mile");
const maxMileageVal = document.querySelector(".max-mile");
const MileageInputMin = document.querySelector(".min-mileage-input");
const MileageInputMax = document.querySelector(".max-mileage-input");
const minMileageToolTip = document.querySelector(".min-mileage-tooltip");
const maxMileageToolTip = document.querySelector(".max-mileage-tooltip");
const minMileageGap = 1000;
const mileageRange = document.querySelector(".slider-track-mileage");
const sliderMileageMinValue = parseInt(minMileageVal.min);
const sliderMileageMaxValue = parseInt(maxMileageVal.max);

function slideMinMileage() {
    let gap = parseInt(maxMileageVal.value) - parseInt(minMileageVal.value);
    if (gap <= minMileageGap) {
        minMileageVal.value = parseInt(maxMileageVal.value) - minMileageGap;
    }
    // minMileageToolTip.innerHTML = numberWithCommas(minMileageVal.value) + " miles"; // Update tooltip with mileage
    minMileageToolTip.innerHTML = numberWithCommas(minMileageVal.value) + " m"; // Update tooltip with mileage
    MileageInputMin.value = minMileageVal.value;
    setMileageArea();
}

function slideMaxMileage() {
    let gap = parseInt(maxMileageVal.value) - parseInt(minMileageVal.value);
    if (gap <= minMileageGap) {
        maxMileageVal.value = parseInt(minMileageVal.value) + minMileageGap;
    }
    // maxMileageToolTip.innerHTML = numberWithCommas(maxMileageVal.value) + " miles"; // Update tooltip with mileage
    maxMileageToolTip.innerHTML = numberWithCommas(maxMileageVal.value) + " m"; // Update tooltip with mileage
    MileageInputMax.value = maxMileageVal.value;
    setMileageArea();
}



function setMileageArea() {
    const minMileageValPercent = ((minMileageVal.value - sliderMileageMinValue) / (sliderMileageMaxValue -
        sliderMileageMinValue)) * 100;
    const maxMileageValPercent = ((maxMileageVal.valuse - sliderMileageMinValue) / (sliderMileageMaxValue -
        sliderMileageMinValue)) * 100;

    mileageRange.style.left = minMileageValPercent + "%";
    mileageRange.style.right = 100 - maxMileageValPercent + "%";

    // Adjust tooltip positions above the slider thumbs
    minMileageToolTip.style.left = minMileageValPercent + "%";
    maxMileageToolTip.style.right = 100 - maxMileageValPercent + "%";

    // Set tooltip opacity to make them visible
    minMileageToolTip.style.opacity = 1;
    maxMileageToolTip.style.opacity = 1;
}

function setMinMileageInput() {
    let minMileage = parseInt(MileageInputMin.value)
    if (minMileage < sliderMileageMinValue) {
        MileageInputMin.value = sliderMileageMinValue
    }
    minMileageVal.value = MileageInputMin.value;
    slideMinMileage();
}

function setMaxMileageInput() {
    let maxMileage = parseInt(MileageInputMax.value)
    if (maxMileage > sliderMileageMaxValue) {
        MileageInputMax.value = sliderMileageMaxValue
    }
    maxMileageVal.value = MileageInputMax.value;
    slideMaxMileage();
}

// Function to format numbers with commas
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}



$('#cancelButton').on('click', function() {
    $("#collapse800").collapse("hide");
});
$('#cancelButtonMobile').on('click', function() {
    $("#collapse800mobile").collapse("hide");
});


function setPaymentArea() {
    const minPaymentValPercent = ((minPaymentVal.value - sliderPaymentMinValue) / (sliderPaymentMaxValue -
        sliderPaymentMinValue)) * 100;
    const maxPaymentValPercent = ((maxPaymentVal.value - sliderPaymentMinValue) / (sliderPaymentMaxValue -
        sliderPaymentMinValue)) * 100;

    paymentRange.style.left = minPaymentValPercent + "%";
    paymentRange.style.right = 100 - maxPaymentValPercent + "%";

    minPaymentToolTip.style.left = minPaymentValPercent + "%";
    maxPaymentToolTip.style.right = 100 - maxPaymentValPercent + "%";

    minPaymentToolTip.style.opacity = 1;
    maxPaymentToolTip.style.opacity = 1;

    const formattedMinPayment = numberWithCommas(minPaymentVal.value);
    const formattedMaxPayment = numberWithCommas(maxPaymentVal.value);

    minPaymentToolTip.textContent = formattedMinPayment;
    maxPaymentToolTip.textContent = formattedMaxPayment;
}

function slideMinPayment() {
    let gap = parseInt(maxPaymentVal.value) - parseInt(minPaymentVal.value);
    if (gap <= minPaymentGap) {
        minPaymentVal.value = parseInt(maxPaymentVal.value) - minPaymentGap;
    }
    minPaymentToolTip.innerHTML = minPaymentVal.value;
    paymentInputMin.value = minPaymentVal.value;
    setPaymentArea();
}

function slideMaxPayment() {
    let gap = parseInt(maxPaymentVal.value) - parseInt(minPaymentVal.value);
    if (gap <= minPaymentGap) {
        maxPaymentVal.value = parseInt(minPaymentVal.value) + minPaymentGap;
    }
    maxPaymentToolTip.innerHTML = maxPaymentVal.value;
    paymentInputMax.value = maxPaymentVal.value;
    setPaymentArea();
}

function setMinPaymentInput() {
    let minPayment = parseInt(paymentInputMin.value)
    if (minPayment < sliderPaymentMinValue) {
        paymentInputMin.value = sliderPaymentMinValue
    }
    minPaymentVal.value = paymentInputMin.value;
    slideMinPayment();
}

function setMaxPaymentInput() {
    let maxPayment = parseInt(paymentInputMax.value)
    if (maxPayment > sliderPaymentMaxValue) {
        paymentInputMax.value = sliderPaymentMaxValue
    }
    maxPaymentVal.value = paymentInputMax.value;
    slideMaxPayment();
}

const minPaymentVal = document.querySelector(".min-payment");
const maxPaymentVal = document.querySelector(".max-payment");
const paymentInputMin = document.querySelector(".min-payment-input");
const paymentInputMax = document.querySelector(".max-payment-input");
const minPaymentToolTip = document.querySelector(".min-payment-tooltip");
const maxPaymentToolTip = document.querySelector(".max-payment-tooltip");
const paymentRange = document.querySelector(".slider-track-payment");
const sliderPaymentMinValue = parseInt(minPaymentVal.min);
const sliderPaymentMaxValue = parseInt(maxPaymentVal.max);
const minPaymentGap = 100;


</script>

@endpush
