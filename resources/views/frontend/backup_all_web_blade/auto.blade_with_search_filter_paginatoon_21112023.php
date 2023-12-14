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
                                            <input placeholder="Search Year, Make, Model, Body, Stock" type="text" class="common_selector" id="search_car">
                                            <button type="submit" class="common_selector"><i class="fa fa-search"></i></button>
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
                                                    min="{{$inventory_min_miles}}" max="{{$inventory_max_miles}}" value="{{$inventory_min_miles}}" oninput="slideMinMileage()">
                                                <input type="range" name="max_miles" class="common_selector max-mile"
                                                    min="{{$inventory_min_miles}}" max="{{$inventory_max_miles}}" value="{{$inventory_max_miles}}" oninput="slideMaxMileage()">

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
                            <div class="panel panel-default" id="default_select_ala">
                            {{--<div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading9001">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse901" aria-expanded="true" aria-controls="collapse901">
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
                                                        class="common_selector maker form-control select2">
                                                        <option value="" selected>All Make</option>
                                                        @foreach($inventory_make_list as $makefilter => $makefilterid)
                                                        <option value="{{ $makefilter }}"
                                                            @selected(request('make')===$makefilter ? 'selected' : '' )>
                                                            {{ $makefilter }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="model">Model</label>
                                                    <select name="" id="model_filter_input"
                                                        class="common_selector modeler form-control select2">
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
                                                        class="common_selector bodies form-control select2">
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
                            </div>--}}
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
                                                    <input type="checkbox" class="common_selector check_brand brand"
                                                        style="color:black" value="Audi">
                                                    <label for="minimal-checkbox-2">&nbsp;&nbsp;&nbsp;Audi </label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand brand"
                                                        style="color:black" value="BMW">
                                                    <label for="minimal-checkbox-3">&nbsp;&nbsp;&nbsp;BMW</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand brand"
                                                        style="color:black" value="Mercedes-Benz">
                                                    <label
                                                        for="minimal-checkbox-4">&nbsp;&nbsp;&nbsp;Mercedes-Benz</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand brand"
                                                        style="color:black" value="Chevrolet">
                                                    <label for="minimal-checkbox-5">&nbsp;&nbsp;&nbsp;Chevrolet</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand brand"
                                                        style="color:black" value="Honda">
                                                    <label for="minimal-checkbox-6">&nbsp;&nbsp;&nbsp;Honda</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand brand"
                                                        style="color:black" value="Jeep">
                                                    <label for="minimal-checkbox-7">&nbsp;&nbsp;&nbsp;Jeep</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="minimal-checkbox-8"
                                                        class="common_selector brand" style="color:check_brand black" value="Acura">
                                                    <label for="minimal-checkbox-8">&nbsp;&nbsp;&nbsp;Acura</label>
                                                </li>

                                                <a href=".cat_modal037"
                                                    class="pull-right"><strong class="bg-success">View
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
                                                        <a
                                                            href="{{ route('auto.details', $related_ad->id) }}">{{ $related_ad->title }}</a>
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
        <div class="modal-content ">
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


<!-- =-=-=-=-=-=-= Make Modal mobile=-=-=-=-=-=-= -->
<div class="search-modal modal fade cat_modal037_mobile" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <input type="checkbox" class="common_selector brand" style="color:black"
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
                <button type="button" class="btn btn-block btn-block" data-dismiss="modal">Search</button>
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
                                    <input placeholder="choose a password" class="form-control" type="password"
                                        name="password" id="res_password" style="width: 95% !important;">
                                        <span style="text-align: center">Your password must be at least 6 characters long, and contain a number or a symbol.</span>
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
                                            <input type="text" placeholder="Search Year, Make, Model, Body, Stock" class="common_selector" id="mobile_search_car">
                                            <button type="submit" class="common_selector"><i class="fa fa-search"></i></button>
                                        </div>
                                        <!-- price List -->

                        <div class="double-slider-box">
                            <h3 class="range-title" style="margin-top:4rem">Price Range</h3>

                            <div id="price-range-slider-mobile" ></div>
                            <span id="selected-range-display-mobile" style="text-align:center">${{number_format(intval($inventory_min_price))}} - ${{number_format(intval($inventory_max_price))}}</span>

                            <div class="range-slider" style="margin-top:1rem">
                                <span class="slider-track"></span>

                        <input type="range" name="min_value_mobile" class="common_selector min-val-another"
                            min="{{$inventory_min_price}}" max="{{$inventory_max_price}}" value="{{$inventory_min_price}}" oninput="slideMinMobile()">
                        <input type="range" name="max_value_mobile" class="common_selector max-val-another"
                            min="{{$inventory_min_price}}" max="{{$inventory_max_price}}" value="{{$inventory_max_price}}" oninput="slideMaxMobile()">
                        <div class="tooltip min-tooltip-another"></div>
                        <div class="tooltip max-tooltip-another"></div>
                    </div>
                    <div class="input-box" style="display:none">
                        <div class="min-box">
                            <div class="input-wrap">
                                <span class="input-addon">$</span>
                                <input type="text" name="min_input_mobile" id="min_input_mobile_another"
                                    class="input-field min-input-another" onchange="setMinInputMobile()" value="{{ (request('min') ? request('min') : $inventory_min_price ) }}">
                            </div>
                        </div>
                        <div class="max-box">
                            <div class="input-wrap">
                                <span class="input-addon">$</span>
                                <input type="text" name="max_input_mobile" id="max_input_mobile_another"
                                    class="input-field max-input-another" onchange="setMaxInputMobile()" value="{{ (request('max') ? request('max') : $inventory_max_price ) }}">
                            </div>
                        </div>
                    </div>
                </div>


<!-- Mobile Miles Slider -->
<div class="double-slider-box" style="margin-top:4rem">
    <h3 class="range-title" >Miles Slider</h3>
<div class="double-slider-box">
    <div id="miles-range-slider-mobile"></div>
    <span id="selected-miles-display-mobile">{{number_format(intval($inventory_min_miles))}} - {{number_format(intval($inventory_max_miles))}} miles</span>

    <div class="range-slider" style="margin-top: 1rem;">
        <span class="slider-track"></span>
        <input type="range" name="min_miles" class="common_selector min-val-miles"
               min="{{$inventory_min_miles}}" max="{{$inventory_max_miles}}" value="{{$inventory_min_miles}}" oninput="slideMinMiles()">
        <input type="range" name="max_miles" class="common_selector max-val-miles"
               min="{{$inventory_min_miles}}" max="{{$inventory_max_miles}}" value="{{$inventory_max_miles}}" oninput="slideMaxMiles()">
        <div class="tooltip min-tooltip-miles"></div>
        <div class="tooltip max-tooltip-miles"></div>
    </div>

    <div class="input-box" style="display:none">
        <div class="min-box">
            <div class="input-wrap">
                <span class="input-addon">Miles</span>
                <input type="text" name="min_input_miles" id="min_input_mobile_miles"
                       class="input-field min-input-miles" onchange="setMinInputMiles()" value="{{$inventory_min_miles}}">
            </div>
        </div>
        <div class="max-box">
            <div class="input-wrap">
                <span class="input-addon">Miles</span>
                <input type="text" name="max_input_miles" id="max_input_mobile_miles"
                       class="input-field max-input-miles" onchange="setMaxInputMiles()" value="{{$inventory_max_miles}}">
            </div>
        </div>
    </div>
</div>

<!-- Mobile Year Slider -->
<div class="double-slider-box">
    <h3 class="range-title" style="margin-top:4rem">Year Slider</h3>
<div class="double-slider-box">


    <div id="year-range-slider-mobile"></div>
    <span id="selected-year-display-mobile">{{1990}} - {{date('Y')}} Year</span>

    <div class="range-slider" style="margin-top: 1rem;">
        <span class="slider-track"></span>
        <input type="range" name="min_year" class="common_selector min-val-year"
               min="1990" max="{{date('Y')}}" value="1990" oninput="mobileSlideMinYear()">
        <input type="range" name="max_year" class="common_selector max-val-year"
               min="1990" max="{{date('Y')}}" value="{{date('Y')}}" oninput="mobileSlideMaxYear()">
        <div class="tooltip min-tooltip-year"></div>
        <div class="tooltip max-tooltip-year"></div>
    </div>

    <div class="input-box" style="display:none">
        <div class="min-box">
            <div class="input-wrap">
                <span class="input-addon">Year</span>
                <input type="text" name="min_input_year" id="min_input_mobile_year"
                       class="input-field min-input-year" onchange="setMinInputYear()" value="1990">
            </div>
        </div>
        <div class="max-box">
            <div class="input-wrap">
                <span class="input-addon">Year</span>
                <input type="text" name="max_input_year" id="max_input_mobile_year"
                       class="input-field max-input-year" onchange="setMaxInputYear()" value="2023">
            </div>
        </div>
    </div>
</div>


                                        </div>

<!-- Mobile Payment Slider -->
<div class="double-slider-box">
    <h3 class="range-title" style="margin-top:4rem">Payment Slider</h3>
<div class="double-slider-box">

    <div id="payment-range-slider-mobile"></div>
    <span id="selected-payment-display-mobile">{{number_format(intval($inventory_min_payment))}} - {{number_format(intval($inventory_max_payment))}} /mo*</span>

    <div class="range-slider" style="margin-top: 1rem;">
        <span class="slider-track"></span>
        <input type="range" name="min_payment" class="common_selector min-val-payment"
               min="{{$inventory_min_payment}}" max="{{$inventory_max_payment}}" value="{{$inventory_min_payment}}" oninput="mobileSlideMinPayment()">
        <input type="range" name="max_payment" class="common_selector max-val-payment"
               min="{{$inventory_min_payment}}" max="{{$inventory_max_payment}}" value="{{$inventory_max_payment}}" oninput="mobileSlideMaxPayment()">
        <div class="tooltip min-tooltip-payment"></div>
        <div class="tooltip max-tooltip-payment"></div>
    </div>

    <div class="input-box" style="display:none">
        <div class="min-box">
            <div class="input-wrap">
                <span class="input-addon">Payment</span>
                <input type="text" name="min_input_payment" id="min_input_mobile_payment"
                       class="input-field min-input-payment" onchange="setMinInputPayment()" value="{{$inventory_min_payment}}">
            </div>
        </div>
        <div class="max-box">
            <div class="input-wrap">
                <span class="input-addon">Payment</span>
                <input type="text" name="max_input_payment" id="max_input_mobile_payment"
                       class="input-field max-input-payment" onchange="setMaxInputPayment()" value="{{$inventory_max_payment}}">
            </div>
        </div>
    </div>
</div>





{{--<div class="double-slider-box">
    <h3 class="range-title" style="margin-bottom:4rem">Mobile Price Range Slider</h3>
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

    <div id="price-range-slider" style="margin-bottom:2rem"></div>
    <input type="text" id="price-range" name="price_range">

</div>--}}

    {{--<div class="double-slider-box">
    <h3 class="range-title" style="margin-bottom:4rem">Mobile Price Slider</h3>
    <div class="range-slider" style="margin-top:5rem">
        <span class="slider-track"></span>

        <input type="range" name="min_value_another" class="common_selector min-val-another"
            min="1000" max="80000" value="1000" oninput="slideMinAnother()">
        <input type="range" name="max_value_another" class="common_selector max-val-another"
            min="1000" max="80000" value="80000" oninput="slideMaxAnother()">
        <div class="tooltip min-tooltip-another"></div>
        <div class="tooltip max-tooltip-another"></div>
    </div>
    <div class="input-box">
        <div class="min-box">
            <div class="input-wrap">
                <span class="input-addon">$</span>
                <input type="text" name="min_input_another" id="min_input_mobile_another"
                    class=" input-field min-input-another" onchange="setMinInputAnother()" value="{{(request('min') ? request('min') : 1000 ) }}">
            </div>
        </div>
        <div class="max-box">
            <div class="input-wrap">
                <span class="input-addon">$</span>
                <input type="text" name="max_input_another" id="max_input_mobile_another"
                    class=" input-field max-input-another" onchange="setMaxInputAnother()" value="{{(request('max') ? request('max') : 80000 ) }}">
            </div>
        </div>
    </div>

    <div id="price-range-slider-another" style="margin-bottom:2rem"></div>
    <input type="text" id="price-range-another" name="price_range_another">
</div>--}}
{{--<div class="range-slider" style="margin-top:5rem">
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
</div>--}}
</div>

{{--<div id="miles-range-slider"></div>
<input type="text" id="miles-range" name="miles_range" style="margin-top: 2rem;">--}}

{{--<div class="range-slider" style="margin-top:5rem">
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
</div>--}}
{{--<div id="years-range-slider"></div>
<input type="text" id="years-range" name="years_range" style="margin-top: 2rem;">--}}
{{--<div id="payments-range-slider"></div>

<input type="text" id="payments-range" name="payments_range" style="margin-top: 2rem;">--}}

{{--<div class="range-slider" style="margin-top: 5rem">
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
</div>--}}
                                        </div>

                                        {{--<div class="card">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation01" class="active"><a href="#homeMobilePrice"
                                                        aria-controls="homeMobilePrice" role="tab" data-toggle="tab">Price</a>
                                                </li>
                                                <li role="presentation"><a href="#profileMobileYear" aria-controls="profileMobileYear"
                                                        role="tab" data-toggle="tab">Year</a></li>

                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content" style="width:100%">
                                                <div role="tabpanel" class="tab-pane active" id="homeMobilePrice">
                                                    <label for="make">Minimum Price</label>
                                                    <select name="" id="mobile_min_price"
                                                        class="common_selector min_price_mobile">
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
                                                    <label for="model">Maximum Price</label>
                                                    <select name="" id="mobile_max_price"
                                                        class="common_selector max_price_mobile">
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
                                                <select class="common_selector form-control" name="min-year-mobile" id="min_year_mobile">
                                                            <option selected value="">Min Year</option>
                                                            @for($i= date('Y'); $i>= 1901 ; $i--)
                                                            <option value="{{$i}}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    <label for="max-year-mobile">Maximum Year</label>
                                                    <select class="common_selector form-control" name="max-year-mobile" id="max_year_mobile">
                                                            <option selected value="">Max Year</option>
                                                            @for($i= date('Y'); $i>= 1901 ; $i--)
                                                            <option value="{{$i}}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                </div>
                                            </div>
                                        </div>--}}

                                        <!-- price List End -->
                                    </div>
                                </div>
                            </div>
                            <!-- any /price Panel End -->
                            {{--<div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading9001MobilePayment">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse901MobileMiles" aria-expanded="false" aria-controls="collapse901MobileMiles">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Miles / Payment
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div id="collapse901MobileMiles" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading9001MobilePayment">
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
                                                <select class="common_selector form-control" name="min-payment_mobile" id="min_payment_mobile">
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
                                                    <select class="common_selector form-control" name="max-payment_mobile" id="max_payment_mobile">
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
                                                        class="common_selector ">
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
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="heading9001Mobile">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#sidebar"
                                            href="#collapse901Mobile" aria-expanded="true" aria-controls="collapse901Mobile">
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
                                                        class="common_selector">
                                                        <option value="" selected>All Make</option>
                                                        @foreach($inventory_make_list as $makefilter => $makefilterid)
                                                        <option value="{{ $makefilter }}"
                                                            @selected(request('make')===$makefilter ? 'selected' : '' )>
                                                            {{ $makefilter }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="model">Model</label>
                                                    <select name="" id="model_filter_input_mobile"
                                                        class="common_selector">
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
                                </div>
                            </div>--}}
                            <!-- any make/model Panel End -->

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
                                <div id="collapse90Mobile" class="panel-collapse collapse mobile-open" role="tabpanel"
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
                                                    <input type="checkbox" class="common_selector check_brand_mobile brand"
                                                        style="color:black" value="Audi">
                                                    <label for="minimal-checkbox-2">&nbsp;&nbsp;&nbsp;Audi </label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand_mobile brand"
                                                        style="color:black" value="BMW">
                                                    <label for="minimal-checkbox-3">&nbsp;&nbsp;&nbsp;BMW</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand_mobile brand"
                                                        style="color:black" value="Mercedes-Benz">
                                                    <label
                                                        for="minimal-checkbox-4">&nbsp;&nbsp;&nbsp;Mercedes-Benz</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand_mobile brand"
                                                        style="color:black" value="Chevrolet">
                                                    <label for="minimal-checkbox-5">&nbsp;&nbsp;&nbsp;Chevrolet</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand_mobile brand"
                                                        style="color:black" value="Honda">
                                                    <label for="minimal-checkbox-6">&nbsp;&nbsp;&nbsp;Honda</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand_mobile brand"
                                                        style="color:black" value="Jeep">
                                                    <label for="minimal-checkbox-7">&nbsp;&nbsp;&nbsp;Jeep</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="common_selector check_brand_mobile brand"
                                                    style="color:black" value="Acura">
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

                                                @if($body_count >= 10)
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

                            <!-- Latest Ads Panel End -->
                        </div>
                        <!-- panel-group end -->
                    </div>
                    <!-- Sidebar Widgets End -->
                </div>
            </div>
            <div class="modal-footer mt-5">
                <button style="padding-top:15px !imporatant;" type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="apply-btn" data-dismiss="modal">Apply</button>
                {{-- //class="btn btn-primary " id="apply-btn" --}}
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
                                        <input type="checkbox" class="common_selector brand" style="color:black"
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
                <button type="button" class="btn btn-block btn-block" data-dismiss="modal">Search</button>
            </div>
        </div>
    </div>
</div>






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

    // check if modal or not checked both
    $('.check_brand').on('click', function() {
        var value = $(this).val();
        // Toggle the checkbox in the modal
        $('.cat_modal037 .common_selector[value="' + value + '"]').prop('checked', $(this).prop('checked'));
    });

    // Checkbox inside the modal
    $('.cat_modal037 .common_selector').on('click', function() {
        var value = $(this).val();

        // Toggle the checkbox outside the modal
        $('.check_brand[value="' + value + '"]').prop('checked', $(this).prop('checked'));
    });


    // check if modal or not checked both
    $('.check_brand_mobile').on('click', function() {
        var value = $(this).val();
        alert(value)
        // Toggle the checkbox in the modal
        $('.cat_modal037_mobile .common_selector[value="' + value + '"]').prop('checked', $(this).prop('checked'));
    });

        // Checkbox inside the modal
        $('.cat_modal037_mobile .common_selector').on('click', function() {
        var value = $(this).val();

        // Toggle the checkbox outside the modal
        $('.check_brand[value="' + value + '"]').prop('checked', $(this).prop('checked'));
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
            url = "{{ route('auto_filter.ajax') }}";
            var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            var screenHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
            if (screenWidth < 1000 && screenHeight < 896) {
                $('.filter_data').html('<div id="loading" style=""></div>');
                action = 'mobile_fetch_data';

                var mobile_minimun_price = $('#min_input_mobile_another').val();
                var mobile_maximun_price = $('#max_input_mobile_another').val();
                var mobile_mimimun_mileage = $('#min_input_mobile_miles').val();
                var mobile_maximun_mileage = $('#max_input_mobile_miles').val();
                var mobile_mimimun_years = $('#min_input_mobile_year').val();
                var mobile_maximun_years = $('#max_input_mobile_year').val();
                var mobile_minimun_payment = $('#min_input_mobile_payment').val();
                var mobile_maximun_payment = $('#max_input_mobile_payment').val();
                var brand = get_filter('brand');
                var body = get_filter('body');
                var transmission = get_filter('transmission');
                var year = get_filter('year');
                var mobile_search_car = $('#mobile_search_car').val();

                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        action:action,
                        mobile_minimun_price:mobile_minimun_price,
                        mobile_maximun_price:mobile_maximun_price,
                        mobile_mimimun_mileage:mobile_mimimun_mileage,
                        mobile_maximun_mileage:mobile_maximun_mileage,
                        mobile_mimimun_years:mobile_mimimun_years,
                        mobile_maximun_years:mobile_maximun_years,
                        mobile_minimun_payment:mobile_minimun_payment,
                        mobile_maximun_payment:mobile_maximun_payment,
                        mobile_ajax_brand: brand,
                        mobile_ajax_body: body,
                        mobile_ajax_transmission: transmission,
                        mobile_ajax_year: year,
                        mobile_search_car: mobile_search_car,
                        page:page,
                    },
                    success:function(res){
                        // $('#sidebarModal').modal('hide');
                        $('.filter_data').html(res)

                    },
                    error:function(err){

                    }

                });
            }else{
            // var action = 'fetch_data';
            // var mimimun_price = $('#min_input').val();
            // var maximun_price = $('#max_input').val();
            // var mimimun_mileage = $('#min_mileage_input').val();
            // var maximun_mileage = $('#max_mileage_input').val();
            // var mimimun_years = $('#min_years_input').val();
            // var maximun_years = $('#max_years_input').val();
            // var make_filter = $('#make_filter_input').val();
            // var model_filter = $('#model_filter_input').val();
            // var brand = get_filter('brand');
            // var transmission = get_filter('transmission');
            // var body = get_filter('body');
            // var year = get_filter('year');
            action = 'fetch_data';
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
            var model_filter_input_mobile= $('#make_filter_input_mobile').val();
            var price_range = $('#price-range').val();
            var miles_range = $('#miles-range').val();
            var years_range = $('#years-range').val();
            var payments_range = $('#payments-range').val();
            var search_car = $('#search_car').val();
                    
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    // action: action,
                    // mimimun_price: mimimun_price,
                    // maximun_price: maximun_price,
                    // mimimun_mileage: mimimun_mileage,
                    // maximun_mileage: maximun_mileage,
                    // mimimun_years: mimimun_years,
                    // maximun_years: maximun_years,
                    // ajaxmake: make_filter,
                    // ajaxmodel: model_filter,
                    // ajaxtransmission: transmission,
                    // ajaxyear: year,
                    // ajaxbody: body,
                    // // ajaxbrand: brand,
                    // page:page

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
                    min_payment_mobile:min_payment_mobile,
                    max_payment_mobile:max_payment_mobile,
                    mobile_max_miles:mobile_max_miles,
                    make_filter_input_mobile:make_filter_input_mobile,
                    model_filter_input_mobile:model_filter_input_mobile,
                    price_range : price_range,
                    miles_range : miles_range,
                    years_range : years_range,
                    payments_range : payments_range,
                    search_car:search_car,
                    // max_year_miles_mobile:max_year_miles,
                    page:page,

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
        }

        // Call filter_data with the new page number
        filter_data(page);


    });

    // var webScreenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    // var webScreenHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

    filter_data();

    // function mobile_filter_data()
    // {
    //     // $('.filter_data').empty();
    //     $('.filter_data').html('<div id="loading" style=""></div>');
    //     var action = 'mobile_fetch_data';
    //     alert(action);
    //     return;
    // }

    function filter_data(page) {

        var action;
        var url ="{{ route('auto_filter.ajax') }}";
        var page = $(this).data('page');
        // Check the screen resolution
        var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        var screenHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

        if (screenWidth < 1000 && screenHeight < 896) {
            $('.filter_data').html('<div id="loading" style=""></div>');
            action = 'mobile_fetch_data';

            var mobile_minimun_price = $('#min_input_mobile_another').val();
            var mobile_maximun_price = $('#max_input_mobile_another').val();
            var mobile_mimimun_mileage = $('#min_input_mobile_miles').val();
            var mobile_maximun_mileage = $('#max_input_mobile_miles').val();
            var mobile_mimimun_years = $('#min_input_mobile_year').val();
            var mobile_maximun_years = $('#max_input_mobile_year').val();
            var mobile_minimun_payment = $('#min_input_mobile_payment').val();
            var mobile_maximun_payment = $('#max_input_mobile_payment').val();
            var brand = get_filter('brand');
            var body = get_filter('body');
            var transmission = get_filter('transmission');
            var year = get_filter('year');
            var mobile_search_car = $('#mobile_search_car').val();

            
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    action:action,
                    mobile_minimun_price:mobile_minimun_price,
                    mobile_maximun_price:mobile_maximun_price,
                    mobile_mimimun_mileage:mobile_mimimun_mileage,
                    mobile_maximun_mileage:mobile_maximun_mileage,
                    mobile_mimimun_years:mobile_mimimun_years,
                    mobile_maximun_years:mobile_maximun_years,
                    mobile_minimun_payment:mobile_minimun_payment,
                    mobile_maximun_payment:mobile_maximun_payment,
                    mobile_ajax_brand: brand,
                    mobile_ajax_body: body,
                    mobile_ajax_transmission: transmission,
                    mobile_ajax_year: year,
                    mobile_search_car: mobile_search_car,
                    page:page,
                },
                success:function(res){
                    // $('#sidebarModal').modal('hide');
                    $('.filter_data').html(res)

                },
                error:function(err){

                }

            });
        } else {
            $('.filter_data').html('<div id="loading" style=""></div>');
                action = 'fetch_data';
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
            var model_filter_input_mobile= $('#make_filter_input_mobile').val();
            var price_range = $('#price-range').val();
            var miles_range = $('#miles-range').val();
            var years_range = $('#years-range').val();
            var payments_range = $('#payments-range').val();
            var search_car = $('#search_car').val();
            // var milesFunction = function getMilesSlider(data){};
            //         price-range
            // miles-range
            // years-range
            // payments-range

            // alert(price_range+'  '+miles_range+'  '+years_range+'  '+payments_range);
            $.ajax({
                url: url,
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
                    min_payment_mobile:min_payment_mobile,
                    max_payment_mobile:max_payment_mobile,
                    mobile_max_miles:mobile_max_miles,
                    make_filter_input_mobile:make_filter_input_mobile,
                    model_filter_input_mobile:model_filter_input_mobile,
                    price_range : price_range,
                    miles_range : miles_range,
                    years_range : years_range,
                    payments_range : payments_range,
                    search_car:search_car,
                    // max_year_miles_mobile:max_year_miles,
                    page:page,

                },
                success: function(data) {
                    // $('#sidebarModal').modal('hide');
                    $('.filter_data').html(data)
                    // console.log(data)
                },
                error: function(error) {
                    console.log(error)
                }

            });
        }






    }

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
            filter.push($(this).val());
        });
        return filter; // Add this line to return the filter array
    }


    $(".common_selector").on("click change", function(event) {
        filter_data();
    });


    $(document).on('change','#tradeChecked', function() {
        var isChecked = this.checked;
        if (isChecked == true) {
            $('#Trade_block_content').css('display', 'block');
        } else {
            $('#Trade_block_content').css('display', 'none');
        }
    });

    //update wislist start
    //goto auto ajax blade file
    //update wislist end

    //checkavailaibality start
    //goto auto ajax blade file
    //checkavailaibality end

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

$('#make_filter_input').select2({
    width: '100%'
});

$('#model_filter_input').select2({
    width: '100%'
});
$('#body_filter_input').select2({
    width: '100%'
});
</script>

<!-- //new for price range slider  -->
<style>
   .ui-slider-tooltip {
      position: absolute;
      background-color: black;
      color: white;
      padding: 3px;
      border-radius: 4px;
      text-align: center;
      font-size: 12px;
      bottom: 20px; /* Adjust this value based on your design */
      transform: translateX(-50%);
   }

   #price-range-slider {
      position: relative;
   }
</style>

<!-- // price slider  -->
<style>
   #price-range-slider {
      margin-top: 20px; /* Adjust the margin-top as needed */
   }
</style>

<script>
   document.addEventListener('DOMContentLoaded', function () {
      var slider = document.getElementById('price-range-slider');
      var input = document.getElementById('price-range');

      noUiSlider.create(slider, {
         start: [0, 16000],
         connect: true,
         range: {
            'min': 0,
            'max': 16000
         }
      });

    //   slider.noUiSlider.on('update', function (values, handle) {
    //      input.value =  '$ '+values.join(' - ') ;
    //   });

    //   // Display initial values
    //   input.value = '$ '+slider.noUiSlider.get().join(' - ');

    slider.noUiSlider.on('update', function (values, handle) {
         // Use Math.round() to round to the nearest integer
         input.value = '$ ' + Math.round(values[0]) + ' - ' + Math.round(values[1]);
      });

      // Display initial values
      input.value = '$ ' + Math.round(slider.noUiSlider.get()[0]) + ' - ' + Math.round(slider.noUiSlider.get()[1]);
   });
</script>
<!-- <script>
   $(function() {
      // Initialize dual range slider
      $("#price-range-slider").slider({
         range: true,
         min: 0,
         max: 80000, // Set your maximum price range
         values: [0, 80000], // Set default values
         slide: function(event, ui) {
            $("#price-range").val("$" + ui.values[0] + " - $" + ui.values[1]);
            // Update tooltip
            $(ui.handle).find('.ui-slider-tooltip').text("$" + ui.value);
         },
         create: function(event, ui) {
            // Add tooltip to handles
            $("#price-range-slider .ui-slider-handle").append('<div class="ui-slider-tooltip"></div>');
            // Display initial tooltip values
            $("#price-range-slider .ui-slider-tooltip").eq(0).text("$" + $("#price-range-slider").slider("values", 0));
            $("#price-range-slider .ui-slider-tooltip").eq(1).text("$" + $("#price-range-slider").slider("values", 1));
         }
      });

      // Display initial values
      $("#price-range").val("$" + $("#price-range-slider").slider("values", 0) +
         " - $" + $("#price-range-slider").slider("values", 1));
   });
</script> -->


<!-- //mile range slider  -->

<style>
   #miles-range-slider {
      margin-top: 20px; /* Adjust the margin-top as needed */
   }
</style>

<script>
   document.addEventListener('DOMContentLoaded', function () {
      var slider = document.getElementById('miles-range-slider');
      var input = document.getElementById('miles-range');

      noUiSlider.create(slider, {
         start: [0, 16000],
         connect: true,
         range: {
            'min': 0,
            'max': 16000
         }
      });

//       slider.noUiSlider.on('update', function (values, handle) {
//          input.value = values.join(' - ') + ' miles';
//       });

//       // Display initial values
//       input.value = Math.round(slider.noUiSlider.get()).join(' - ') + ' miles';

       slider.noUiSlider.on('update', function (values, handle) {
         // Use Math.round() to round to the nearest integer
         input.value = Math.round(values[0]) + ' - ' + Math.round(values[1]) + ' miles';
      });

      // Display initial values
      input.value = Math.round(slider.noUiSlider.get()[0]) + ' - ' + Math.round(slider.noUiSlider.get()[1]) + ' miles';

        // Function to get slider values
        function getSliderValues() {
         var values = slider.noUiSlider.get();
         var roundedValues = values.map(function(value) {
            return Math.round(value);
         });
         return roundedValues;
      }

      // Example of how to use the function
    //   var button = document.getElementByClass('common_selector');
    //   button.addEventListener('click', function() {
    //      var sliderValues = getSliderValues();
    //      console.log('Slider Values:', sliderValues);
    //      // You can now use sliderValues as needed in your application
    //   });
   });
</script>
<!-- <script>
   $(function() {
      // Initialize dual range slider
      $("#miles-range-slider").slider({
         range: true,
         min: 0,
         max: 160000, // Set your maximum miles range
         values: [0, 160000], // Set default values
         slide: function(event, ui) {
            $("#miles-range").val(ui.values[0] + " - " + ui.values[1] + "m");
            // Update tooltip
            $(ui.handle).find('.ui-slider-tooltip').text(ui.value + "m");
         },
         create: function(event, ui) {
            // Add tooltip to handles
            $("#miles-range-slider .ui-slider-handle").append('<div class="ui-slider-tooltip"></div>');
            // Display initial tooltip values
            $("#miles-range-slider .ui-slider-tooltip").eq(0).text($("#miles-range-slider").slider("values", 0) + "m");
            $("#miles-range-slider .ui-slider-tooltip").eq(1).text($("#miles-range-slider").slider("values", 1) + "m");
         }
      });

      // Display initial values
      $("#miles-range").val($("#miles-range-slider").slider("values", 0) + " - " + $("#miles-range-slider").slider("values", 1));
   });
</script> -->



<!-- //mile range slider  -->
<!-- <script>
   $(function() {
      // Initialize dual range slider
      $("#years-range-slider").slider({
         range: true,
         min: 1991,
         max: 2023, // Set your maximum price range
         values: [1991, 2023], // Set default values
         slide: function(event, ui) {
            $("#years-range").val(ui.values[0]  + " - " + ui.values[1] );
            // Update tooltip
            $(ui.handle).find('.ui-slider-tooltip').text( ui.value +"Y" );
         },
         create: function(event, ui) {
            // Add tooltip to handles
            $("#years-range-slider .ui-slider-handle").append('<div class="ui-slider-tooltip"></div>');
            // Display initial tooltip values
            $("#years-range-slider .ui-slider-tooltip").eq(1).text( $("#years-range-slider").slider("values", 1)+"Y");
            $("#years-range-slider .ui-slider-tooltip").eq(0).text( $("#years-range-slider").slider("values", 0)+"Y");
         }
      });

      // Display initial values
      $("#years-range").val( $("#years-range-slider").slider("values", 0) +
         " - " + $("#years-range-slider").slider("values", 1));
   });
</script> -->

<!-- //mile range slider  -->
<script>
   $(function() {
      // Initialize dual range slider
      $("#payments-range-slider").slider({
         range: true,
         min: 0,
         max: 1500, // Set your maximum price range
         values: [0, 1500], // Set default values
         slide: function(event, ui) {
            $("#payments-range").val(ui.values[0] + " - " + ui.values[1]);
            // Update tooltip
            $(ui.handle).find('.ui-slider-tooltip').text( ui.value +"/mo");
         },
         create: function(event, ui) {
            // Add tooltip to handles
            $("#payments-range-slider .ui-slider-handle").append('<div class="ui-slider-tooltip"></div>');
            // Display initial tooltip values
            $("#payments-range-slider .ui-slider-tooltip").eq(0).text( $("#payments-range-slider").slider("values", 0)+'/mo');
            $("#payments-range-slider .ui-slider-tooltip").eq(1).text( $("#payments-range-slider").slider("values", 1)+'/mo');
         },
            // Handle touch events explicitly
            touch: true
      });

      // Display initial values
      $("#payments-range").val("$" + $("#payments-range-slider").slider("values", 0) +
         " - $" + $("#payments-range-slider").slider("values", 1));
   });
</script>
<!-- <script>
    // ... (existing code)

    // Function to close the modal
    function closeModal() {
        // Assuming you're using Bootstrap modal
        $('#sidebarModal').modal('hide');
    }

    // Function to set up modal closure on slider finish and button click
    function setupModalClosure() {
        const submitButton = document.querySelector('.btn_submit_modal');

        // Add an event listener to the submit button for the "click" event
        submitButton.addEventListener('click', function () {
            closeModal(); // Close the modal when the button is clicked
        });
    }

    // Call the function to set up modal closure on slider finish and button click
    setupModalClosure();

    // ... (rest of the existing code)

    // JavaScript for the second slider for mobile view
    const minValAnother = document.querySelector(".min-val-another");
    const maxValAnother = document.querySelector(".max-val-another");
    const priceInputMinAnother = document.querySelector(".min-input-another");
    const priceInputMaxAnother = document.querySelector(".max-input-another");
    const minToolTipAnother = document.querySelector(".min-tooltip-another");
    const maxToolTipAnother = document.querySelector(".max-tooltip-another");
    const rangeAnother = document.querySelector(".slider-track");
    const sliderMinValueAnother = parseInt(minValAnother.min);
    const sliderMaxValueAnother = parseInt(maxValAnother.max);

    function slideMinAnother() {
        let gap = parseInt(maxValAnother.value) - parseInt(minValAnother.value);
        if (gap <= minGap) {
            minValAnother.value = parseInt(maxValAnother.value) = minGap;
        }
        minToolTipAnother.innerHTML = "$" + minValAnother.value;
        priceInputMinAnother.value = minValAnother.value;
        setAreaAnother();
    }

    function slideMaxAnother() {
        let gap = parseInt(maxValAnother.value) - parseInt(minValAnother.value);
        if (gap <= minGap) {
            maxValAnother.value = parseInt(minValAnother.value) + minGap;
        }
        maxToolTipAnother.innerHTML = "$" + maxValAnother.value;
        priceInputMaxAnother.value = maxValAnother.value;
        setAreaAnother();
    }

    function setAreaAnother() {
        const minValPercentAnother = ((minValAnother.value - sliderMinValueAnother) / (sliderMaxValueAnother - sliderMinValueAnother)) * 100;
        const maxValPercentAnother = ((maxValAnother.value - sliderMinValueAnother) / (sliderMaxValueAnother - sliderMinValueAnother)) * 100;

        rangeAnother.style.left = minValPercentAnother + "%";
        rangeAnother.style.right = 100 - maxValPercentAnother + "%";

        // Adjust tooltip positions above the slider thumbs
        minToolTipAnother.style.left = minValPercentAnother + "%";
        maxToolTipAnother.style.right = 100 - maxValPercentAnother + "%";

        // Set tooltip opacity to make them visible
        minToolTipAnother.style.opacity = 1;
        maxToolTipAnother.style.opacity = 1;

        // Format and set tooltip values with commas
        const formattedMinValAnother = numberWithCommas(minValAnother.value);
        const formattedMaxValAnother = numberWithCommas(maxValAnother.value);

        minToolTipAnother.textContent = "$" + formattedMinValAnother;
        maxToolTipAnother.textContent = "$" + formattedMaxValAnother;
    }

    // Function to format numbers with commas
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function setMinInputAnother() {
        let minPriceAnother = parseInt(priceInputMinAnother.value)
        if (minPriceAnother < sliderMinValueAnother) {
            priceInputMinAnother.value = sliderMinValueAnother
        }
        minValAnother.value = priceInputMinAnother.value;
        slideMinAnother();
    }

    function setMaxInputAnother() {
        let maxPriceAnother = parseInt(priceInputMaxAnother.value)
        if (maxPriceAnother > sliderMaxValueAnother) {
            priceInputMaxAnother.value = sliderMaxValueAnother
        }
        maxValAnother.value = priceInputMaxAnother.value;
        slideMaxAnother();
    }
</script> -->
<!-- Your JavaScript code -->
<script>
    // JavaScript for the mobile price slider
    const minValMobile = document.querySelector(".min-val-another");
    const maxValMobile = document.querySelector(".max-val-another");
    const priceInputMinMobile = document.querySelector(".min-input-another");
    const priceInputMaxMobile = document.querySelector(".max-input-another");
    const rangeMobile = document.querySelector(".slider-track");
    const sliderMinValueMobile = parseInt(minValMobile.min);
    const sliderMaxValueMobile = parseInt(maxValMobile.max);
    const selectedRangeDisplayMobile = document.getElementById("selected-range-display-mobile");

    function slideMinMobile() {
        let gap = parseInt(maxValMobile.value) - parseInt(minValMobile.value);
        if (gap <= minGap) {
            minValMobile.value = parseInt(maxValMobile.value) = minGap;
        }
        priceInputMinMobile.value = minValMobile.value;
        setAreaMobile();
    }

    function slideMaxMobile() {
        let gap = parseInt(maxValMobile.value) - parseInt(minValMobile.value);
        if (gap <= minGap) {
            maxValMobile.value = parseInt(minValMobile.value) + minGap;
        }
        priceInputMaxMobile.value = maxValMobile.value;
        setAreaMobile();
    }

    function setAreaMobile() {
        const minValPercentMobile = ((minValMobile.value - sliderMinValueMobile) / (sliderMaxValueMobile - sliderMinValueMobile)) * 100;
        const maxValPercentMobile = ((maxValMobile.value - sliderMinValueMobile) / (sliderMaxValueMobile - sliderMinValueMobile)) * 100;

        rangeMobile.style.left = minValPercentMobile + "%";
        rangeMobile.style.right = 100 - maxValPercentMobile + "%";

        // Adjust tooltip positions above the slider thumbs
        // Skip tooltip code for simplicity since tooltips are not shown in this example

        // Update the selected range display for mobile price
        const formattedMinValMobile = numberWithCommas(minValMobile.value);
        const formattedMaxValMobile = numberWithCommas(maxValMobile.value);
        selectedRangeDisplayMobile.textContent = "$" + formattedMinValMobile + " - $" + formattedMaxValMobile;
    }

    // Function to format numbers with commas
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function setMinInputMobile() {
        let minPriceMobile = parseInt(priceInputMinMobile.value)
        if (minPriceMobile < sliderMinValueMobile) {
            priceInputMinMobile.value = sliderMinValueMobile
        }
        minValMobile.value = priceInputMinMobile.value;
        slideMinMobile();
    }

    function setMaxInputMobile() {
        let maxPriceMobile = parseInt(priceInputMaxMobile.value)
        if (maxPriceMobile > sliderMaxValueMobile) {
            priceInputMaxMobile.value = sliderMaxValueMobile
        }
        maxValMobile.value = priceInputMaxMobile.value;
        slideMaxMobile();
    }
</script>

<!-- Your JavaScript code for the mobile miles slider -->
<script>
    const minValMiles = document.querySelector(".min-val-miles");
    const maxValMiles = document.querySelector(".max-val-miles");
    const priceInputMinMiles = document.querySelector(".min-input-miles");
    const priceInputMaxMiles = document.querySelector(".max-input-miles");
    const rangeMiles = document.querySelector(".slider-track");
    const sliderMinValueMiles = parseInt(minValMiles.min);
    const sliderMaxValueMiles = parseInt(maxValMiles.max);
    const selectedMilesDisplayMobile = document.getElementById("selected-miles-display-mobile");

    function slideMinMiles() {
        let gap = parseInt(maxValMiles.value) - parseInt(minValMiles.value);
        if (gap <= minGap) {
            minValMiles.value = parseInt(maxValMiles.value) = minGap;
        }
        priceInputMinMiles.value = minValMiles.value;
        setAreaMiles();
    }

    function slideMaxMiles() {
        let gap = parseInt(maxValMiles.value) - parseInt(minValMiles.value);
        if (gap <= minGap) {
            maxValMiles.value = parseInt(minValMiles.value) + minGap;
        }
        priceInputMaxMiles.value = maxValMiles.value;
        setAreaMiles();
    }

    function setAreaMiles() {
        const minValPercentMiles = ((minValMiles.value - sliderMinValueMiles) / (sliderMaxValueMiles - sliderMinValueMiles)) * 100;
        const maxValPercentMiles = ((maxValMiles.value - sliderMinValueMiles) / (sliderMaxValueMiles - sliderMinValueMiles)) * 100;

        rangeMiles.style.left = minValPercentMiles + "%";
        rangeMiles.style.right = 100 - maxValPercentMiles + "%";

        // Adjust tooltip positions above the slider thumbs
        // Skip tooltip code for simplicity since tooltips are not shown in this example

        // Update the selected miles range display for mobile
        selectedMilesDisplayMobile.textContent = minValMiles.value + " - " + maxValMiles.value + " miles";
    }

    function setMinInputMiles() {
        let minMiles = parseInt(priceInputMinMiles.value)
        if (minMiles < sliderMinValueMiles) {
            priceInputMinMiles.value = sliderMinValueMiles
        }
        minValMiles.value = priceInputMinMiles.value;
        slideMinMiles();
    }

    function setMaxInputMiles() {
        let maxMiles = parseInt(priceInputMaxMiles.value)
        if (maxMiles > sliderMaxValueMiles) {
            priceInputMaxMiles.value = sliderMaxValueMiles
        }
        maxValMiles.value = priceInputMaxMiles.value;
        slideMaxMiles();
    }
</script>
<!-- Your JavaScript code for the mobile year slider -->
<script>
    const minValYear = document.querySelector(".min-val-year");
    const maxValYear = document.querySelector(".max-val-year");
    const inputMinYear = document.querySelector(".min-input-year");
    const inputMaxYear = document.querySelector(".max-input-year");
    const rangeYear = document.querySelector(".slider-track");
    const minYear = parseInt(minValYear.min);
    const maxYear = parseInt(maxValYear.max);
    const selectedYearDisplayMobile = document.getElementById("selected-year-display-mobile");

    function mobileSlideMinYear() {
        let minGap = 1; // Set the minimum gap between min and max values
        let gap = parseInt(maxValYear.value) - parseInt(minValYear.value);
        if (gap <= minGap) {
            minValYear.value = parseInt(maxValYear.value) - minGap;
        }
        inputMinYear.value = minValYear.value;
        setYearRange();
    }

    function mobileSlideMaxYear() {
        let minGap = 1; // Set the minimum gap between min and max values
        let gap = parseInt(maxValYear.value) - parseInt(minValYear.value);
        if (gap <= minGap) {
            maxValYear.value = parseInt(minValYear.value) + minGap;
        }
        inputMaxYear.value = maxValYear.value;
        setYearRange();
    }

    function setYearRange() {
        const minValPercentYear = ((minValYear.value - minYear) / (maxYear - minYear)) * 100;
        const maxValPercentYear = ((maxValYear.value - minYear) / (maxYear - minYear)) * 100;

        rangeYear.style.left = minValPercentYear + "%";
        rangeYear.style.right = 100 - maxValPercentYear + "%";

        // Adjust tooltip positions above the slider thumbs
        // Skip tooltip code for simplicity since tooltips are not shown in this example

        // Update the selected year range display for mobile
        selectedYearDisplayMobile.textContent = minValYear.value + " - " + maxValYear.value+" Year";
    }

    function setMinInputYear() {
        let minYearValue = parseInt(inputMinYear.value)
        if (minYearValue < minYear) {
            inputMinYear.value = minYear;
        }
        minValYear.value = inputMinYear.value;
        mobileSlideMinYear();
    }

    function setMaxInputYear() {
        let maxYearValue = parseInt(inputMaxYear.value)
        if (maxYearValue > maxYear) {
            inputMaxYear.value = maxYear;
        }
        maxValYear.value = inputMaxYear.value;
        mobileSlideMaxYear();
    }
</script>

<!-- Your JavaScript code for the mobile payment slider -->
<script>
    const minValPayment = document.querySelector(".min-val-payment");
    const maxValPayment = document.querySelector(".max-val-payment");
    const inputMinPayment = document.querySelector(".min-input-payment");
    const inputMaxPayment = document.querySelector(".max-input-payment");
    const rangePayment = document.querySelector(".slider-track");
    const minPayment = parseInt(minValPayment.min);
    const maxPayment = parseInt(maxValPayment.max);
    const selectedPaymentDisplayMobile = document.getElementById("selected-payment-display-mobile");

    function mobileSlideMinPayment() {
        let minGap = 1; // Set the minimum gap between min and max values
        let gap = parseInt(maxValPayment.value) - parseInt(minValPayment.value);
        if (gap <= minGap) {
            minValPayment.value = parseInt(maxValPayment.value) - minGap;
        }
        inputMinPayment.value = minValPayment.value;
        setPaymentRange();
    }

    function mobileSlideMaxPayment() {
        let minGap = 1; // Set the minimum gap between min and max values
        let gap = parseInt(maxValPayment.value) - parseInt(minValPayment.value);
        if (gap <= minGap) {
            maxValPayment.value = parseInt(minValPayment.value) + minGap;
        }
        inputMaxPayment.value = maxValPayment.value;
        setPaymentRange();
    }

    function setPaymentRange() {
        const minValPercentPayment = ((minValPayment.value - minPayment) / (maxPayment - minPayment)) * 100;
        const maxValPercentPayment = ((maxValPayment.value - minPayment) / (maxPayment - minPayment)) * 100;

        rangePayment.style.left = minValPercentPayment + "%";
        rangePayment.style.right = 100 - maxValPercentPayment + "%";

        // Adjust tooltip positions above the slider thumbs
        // Skip tooltip code for simplicity since tooltips are not shown in this example

        // Update the selected payment range display for mobile
        selectedPaymentDisplayMobile.textContent = "$" + minValPayment.value + " - $" + maxValPayment.value + " /mo*";
    }

    function setMinInputPayment() {
        let minPaymentValue = parseInt(inputMinPayment.value)
        if (minPaymentValue < minPayment) {
            inputMinPayment.value = minPayment;
        }
        minValPayment.value = inputMinPayment.value;
        mobileSlideMinPayment();
    }

    function setMaxInputPayment() {
        let maxPaymentValue = parseInt(inputMaxPayment.value)
        if (maxPaymentValue > maxPayment) {
            inputMaxPayment.value = maxPayment;
        }
        maxValPayment.value = inputMaxPayment.value;
        mobileSlideMaxPayment();
    }
</script>
@endpush
