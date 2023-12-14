@extends('frontend.layouts.app')
@section('title')
{{$inventory->title ?? config('app.name')}}
@endsection
@php
    $imges = explode(',', $inventory->image_from_url);
@endphp
@push('meta')

<meta property="og:title" content="{{ $inventory->title }}">
 <meta property="og:description" content="{{ $inventory->description }}">
 <meta property="og:image" content="{{ $imges[0] }}">
<meta property="og:url" content="{{ route('auto.details', $inventory->id) }}">
@endpush
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.form-control {
    padding: 5px 10px 5px 10px;

}

.custom-list-style {
    list-style-type: disc;
    /* Use a filled circle as the list item marker */
    padding: 0;
    margin: 0;
    margin-left: 20px;
    /* Add left margin for spacing */
}


/* Target the radio buttons and labels within the specific <ul> */
.finance-radio-list li input[type="radio"] {
    visibility: hidden;
}

.finance-radio-list li label {
    cursor: pointer;
    display: inline-block;
    line-height: 50px !important;
    width: 50px !important;
    height: 50px !important;
    border-radius: 22% !important;
    border: 1px solid black;
    background: #fff;
    text-align: center;
    font-size: 18px;

}

.finance-radio-list label {
    display: inline-block;
    max-width: 100%;

    font-weight: bold;

    margin-top: 10px !important;
}




/* Style the labels of checked radio buttons */
.finance-radio-list li input[type="radio"]:checked+label {
    color: white;
    cursor: pointer !important;
    display: inline-block;
    line-height: 50px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: red;
    font-size: 18px;


}

#social-links ul li
{
    display: inline-block;
    padding: 2px;
}
#social-links ul li a:hover{

    color: rgb(41, 34, 34)
}

#social-links ul li a{
    font-size: 20px;
}
#social-links ul li a:first-child
{
    margin-left: 2px
}
</style>

@endpush
@section('content')

<!-- =-=-=-=-=-=-= Breadcrumb =-=-=-=-=-=-= -->
<div class="car-detail gray">
    <div class="advertising">
        <div class="container">
            <div class="banner">
                @foreach ($banner as $item)
                <img class="top-img" src="{{asset('/dashboard')}}/images/banners/{{$item->image}}" alt="image" height="70px">

                @endforeach



            </div>

        </div>
    </div>
</div>


<div class="page-header-area-2 no-bottom gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 no-padding  col-md-12 col-sm-12 col-xs-12">
                <div class="small-breadcrumb">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class=" breadcrumb-link back-home">
                            <ul>
                                <li><a href="{{ route('home') }}">Home Page</a></li>
                                <li><a href="{{ route('autos') }}">Autos</a></li>
                                <li><a class="active" href="#">Listing Details</a></li>
                            </ul>
                        </div>
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
    <section class="section-padding no-top gray ">
        <!-- Main Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <div class="pricing-area">
                    <div class="col-xs-12 col-md-7">
                        <div class="heading-zone">
                            <h1 class="title-first">{{ $inventory->title }}</h1>
                            <h2 class="title-second">{{ $inventory->year }} {{ $inventory->make }} {{ $inventory->model }} - {{$inventory->price_formate}}</h2>
                            <div class="short-history">
                                <ul>
                                    <li>{{ $inventory->engine_description_formate }} . {{ $inventory->drive_train }} . {{ $inventory->miles_formate }} miles . {{ $inventory->payment_price }}/ {{'mo*'}}</li>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-5 detail_price ">

                        <div   class="singleprice-tag">
                            {{$inventory->price_formate}}
                        </div>
                    </div>
                </div>


                <!-- Middle Content Area -->

                <div class="col-xs-12 col-md-7">
                    <div class="image-header">
                        @php
                            $imges = explode(',', $inventory->image_from_url);
                            $image_count = count($imges);
                        @endphp
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 photos-first">
                                <span class="photos"><i class="fa fa-image  icon-icon-photos"></i>Photos({{$image_count}})</span>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 photos-second">
                                <div class="img-header-icon">

                                    <div class="dropdown">
                                       <a href="#" class="dropdown-toggle" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-share-alt icon-icon text-warning"></i></a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                           {!! $shareButtons !!}
                                        </div>
                                      </div>
                                    <a href="{{ route('inventory.details.pdf',$inventory->id)}}" title="print" target="_blank"><i class="fa fa-print icon-icon text-danger"></i></a>
                                    <i class="fa fa-envelope icon-icon"></i>
                                    <a href="#" class="cpy" title="Copy Link" id="copyUrlButton"><i class="fa fa-copy icon-icon" ></i>
                                    </a>



                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- Single Ad -->
                    <div class="singlepage-detail ">


                        <div id="single-slider" class="flexslider">
                            <ul class="slides">
                                @foreach($imges as $key => $img)
                                    @if($inventory->is_feature == 0)
                                            @if($key < 3)
                                            <li><a href="{{ $img }}" data-fancybox="group"><img alt="" src="{{ $img }}" /></a></li>
                                            @endif
                                        @else
                                        <li><a href="{{ $img }}" data-fancybox="group"><img alt="" src="{{ $img }}" /></a></li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides slides-bottom">



                                @foreach($imges as $key => $img)
                                    @if($inventory->is_feature == 0)
                                            @if($key < 3)
                                            <li><img alt="" src="{{ $img }}" style="width:200; height:212;" /></li>
                                            @endif
                                        @else
                                        <li><img alt="" src="{{ $img }}" style="width:200; height:212;" /></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="key-features">
                            <div class="row condition-card">
                                <div class="heading-panel">
                                    <h3 class="con-title text-left ">
                                        Vehicle Overview
                                    </h3>

                                </div>
                                <div class="col-xs-12 col-md-6 col-sm-6 ">

                                    <div class="boxicons " title="Fuel">
                                        <i class="flaticon-gas-station-1 petrol icon-auto"></i>
                                        <p class="auto-icon-para">Fuel Type : {{ $inventory->fuel }}</p>
                                    </div>
                                    <div class="boxicons" title="Mileage">
                                        <i class="flaticon-dashboard-1 kilo-meter icon-auto"></i>
                                        <p class="auto-icon-para">Mileage : {{ $inventory->miles_formate }}miles</p>
                                    </div>
                                    <div class="boxicons">
                                        <i class="flaticon-tool engile-capacity icon-auto"></i>
                                        <p class="auto-icon-para">Engine :{{ $inventory->engine_description_formate }}
                                        </p>
                                    </div>
                                    <div class="boxicons" title="Year">
                                        <i class="flaticon-calendar reg-year icon-auto"></i>
                                        <p class="auto-icon-para">Year : {{ $inventory->year }}</p>
                                    </div>

                                    <div class="boxicons" title="Year">
                                        <i class="flaticon-car icon-auto"></i>
                                        <p class="auto-icon-para">Condition : {{ $inventory->condition }}</p>
                                    </div>
                                </div>


                                <div class="col-xs-12 col-md-6  col-sm-6 ">
                                    <div class="boxicons" title="Transmission">
                                        <i class="flaticon-gearshift transmission icon-auto"></i>
                                        <p class="auto-icon-para">Transmission : {{ $inventory->transmission }}</p>
                                    </div>
                                    <div class="boxicons" title="Model">
                                        <i class="flaticon-transport-1 body-type icon-auto"></i>
                                        <p class="auto-icon-para">Model : {{ $inventory->model }}</p>
                                    </div>
                                    <div class="boxicons" title="Exterior Color ">
                                        <i class="flaticon-color-palette  icon-auto"></i>
                                        <p class="auto-icon-para">Color : {{ $inventory->exterior_color }}</p>
                                    </div>
                                    <div class="boxicons" title="Exterior Color ">
                                        <i class="flaticon-damper  icon-auto "></i>
                                        <p class="auto-icon-para">Drive Train : {{ $inventory->drive_train }}</p>
                                    </div>
                                </div>

                            </div>

                        </div>




                        <div class="content-box-grid">
                            <!-- Heading Area -->
                            <div class="short-features">
                                <!-- Heading Area -->
                                <div class="heading-panel">
                                    <h3 class="main-title text-left">
                                        Standard Features
                                    </h3>
                                </div>
                                @php
                                $core_featurtes_datas = explode(',', $inventory->options);

                                @endphp

                                @forelse($core_featurtes_datas as $core_feture_key => $core_feature)
                                @if($core_feture_key < 10) <div class="col-sm-6 col-md-6 col-xs-12 no-padding">

                                    <ul class="custom-list-style">
                                        <li style="padding: 1px;">{{ $core_feature }}</li>
                                    </ul>
                            </div>
                            @endif
                            @empty
                            @endforelse
                            <a href=".cat_modal03757" data-toggle="modal" class="pull-right"
                                style="float:right; padding-top:10px;">Show
                                more</a>
                        </div>
                        <!-- Short Features  -->
                        <div class="short-features">

                            <!-- Related Image  -->
                            <div class="ad-related-img">
                                <img src="images/car-img1.png" alt="" class="img-responsive center-block">
                            </div>
                        </div>
                        <!-- Short Features  -->
                        <div class="clearfix"></div>
                    </div>






                    <div class="content-box-grid">
                        <!-- Heading Area -->
                        <div class="short-features">
                            <!-- Heading Area -->
                            <div class="heading-panel">
                                <h3 class="main-title text-left">
                                    Seller Description
                                </h3>
                            </div>
                            @php
                            $description_data = substr($inventory->description,0,320);
                            $lest_data = substr($inventory->description,320)

                            @endphp
                            <p>{{ $description_data }} <span id="text_data"
                                    style="display: none;">{{ $lest_data }}</span></p>
                            <a id="show-more-button" onclick="truncateText()" style="float:right"><u>Show more</u></a>

                        </div>

                        <!-- Short Features  -->
                        <div class="short-features">
                            <!-- Ad Specifications -->
                            <div class="specification">
                                <!-- Heading Area -->
                                <!-- <div class="heading-panel">
                                        <h3 class="main-title text-left">
                                            Specifications
                                        </h3>
                                    </div> -->
                                <!-- <p>
                                        samsung galaxy note 2 new condition with handsfree and charger urgent sale. with
                                        book pouch original 4g lte. 16 gb condition 10/10 andriod kitkat4.4.2
                                    </p>
                                    <p>
                                        Bank Leased 5 Year plan 2013 Honda Civic 1.8 Vti Oriel Prosmatec Automatic ( New
                                        Shape ) Attractive Silver Color 1 year installments paid Lahore Reg number Well
                                        Maintained Insurance + tracker etc included Options: Sunroof
                                    </p>
                                    <p>
                                        Chilled AC Power Windows Power Steering ABS braking system ETC 15000 km
                                        carefully driven No SMS / Email , Serious Buyers Requested To Call .
                                    </p> -->

                            </div>
                            <!-- Related Image  -->
                            <div class="ad-related-img">
                                <img src="images/car-img1.png" alt="" class="img-responsive center-block">
                            </div>
                            <!-- Heading Area -->
                            {{--<div class="heading-panel">
                                        <h3 class="main-title text-left">
                                            Car Features
                                        </h3>
                                    </div>
                                    <!-- Car Key Features  -->
                                    <ul class="car-feature-list ">
                                        <li><i class="flaticon-antenna"></i> A/C</li>
                                        <li><i class="flaticon-air-conditioner-1"></i> Air Condition</li>
                                        <li><i class="flaticon-cd"></i> Cassette Player</li>
                                        <li><i class="flaticon-light-bulb"></i> Power Locks</li>
                                        <li><i class="flaticon-rearview-mirror"></i> Power Mirrors</li>
                                        <li><i class="flaticon-car-steering-wheel"></i> Power Steering</li>
                                        <li><i class="flaticon-car-door"></i> Power Windows</li>
                                        <li><i class="flaticon-disc-brake"></i> Anti-lock Braking</li>
                                        <li><i class="flaticon-rim"></i> 19 Inch Alloy Wheels</li>
                                        <li><i class="flaticon-message"></i> Cruise Control</li>
                                        <li><i class="flaticon-airbag"></i> Front Airbag Package</li>
                                        <li><i class="flaticon-photo-camera-1"></i> Reversing Camera</li>
                                    </ul>--}}
                        </div>
                        <!-- Short Features  -->
                        <div class="clearfix"></div>


                        <div class="price_section">
                            <h3>Price changes</h3>
                            <table class="table">
                                <tr>
                                    <th>DATE</th>
                                    <th>PRICE</th>
                                    <th>MILEAGE</th>
                                    <th>DIFFERENCE</th>
                                </tr>
                                <tr>
                                    <td><span style="color: red;font-weight:bold">New</span> 9/23/23</td>
                                    <td>$35,586</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- <div class="list-style-1 margin-top-20">
                            <div class="panel with-nav-tabs panel-default">
                                <div class="panel-heading">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab3default" data-toggle="tab">Video</a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane in active fade" id="tab3default">
                                            <iframe src="https://www.youtube.com/embed/lr7mPzjTgC0" allowfullscreen=""
                                                height="370"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                    <!-- Share Ad  -->
                </div>
                <!-- Single Ad End -->
                <!-- Price Alert -->
                <div class="alert-box-container margin-top-30">
                    <div class="well">
                        <h3>Create Alert</h3>
                        <p>Receive emails for the latest ads matching your search criteria</p>
                        <form>
                            <div class="row">
                                <div class="col-md-5 col-xs-12 col-sm-12">
                                    <input placeholder="Enter Your Email " type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-xs-12 col-sm-12">
                                    <select class="alerts">
                                        <option value="1">Daily</option>
                                        <option value="7">Weekly</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-xs-12 col-sm-12">
                                    <input class="btn btn-theme btn-block" value="Submit" type="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Price Alert End -->
                <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
                <div class="grid-panel margin-top-30">
                    <div class="heading-panel">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <h3 class="main-title text-left">
                                Related Ads
                            </h3>
                        </div>
                    </div>
                    <!-- Ads Archive -->
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="posts-masonry">

                            @forelse($models_inventory as $invent)
                            <div class="ads-list-archive">
                                <!-- Image Block -->
                                <div class="col-lg-5 col-md-5 col-sm-5 no-padding">
                                    <!-- Img Block -->
                                    <div class="ad-archive-img">
                                        <a href="{{ route('auto.details', $invent->id) }}">
                                            <img class="img-responsive" src="{{ $invent->image }}" alt="">
                                        </a>
                                    </div>
                                    <!-- Img Block -->
                                </div>
                                <!-- Ads Listing -->
                                <div class="clearfix visible-xs-block"></div>
                                <!-- Content Block -->
                                <div class="col-lg-7 col-md-7 col-sm-7 no-padding">
                                    <!-- Ad Desc -->
                                    <div class="ad-archive-desc">
                                        <!-- Price -->
                                        <div class="ad-price">{{ $invent->price_formate }}</div>
                                        <!-- Title -->
                                        <a href="{{ route('auto.details', $invent->id) }}">
                                            <h3>{{ $invent->title }}</h3>
                                        </a>

                                        <!-- Category -->
                                        {{--<div class="category-title"> <span><a href="#">Car &amp; Bikes</a></span> </div>--}}
                                        <div class="category-title"> <span><a
                                                    href="#">{{ $invent->condition }}</a></span> </div>
                                        <!-- Short Description -->
                                        <div class="clearfix visible-xs-block"></div>
                                        @php
                                        $desc = substr($invent->description ,0,180)
                                        @endphp
                                        <p class="hidden-sm">{{ $desc }}.....</p>
                                        <!-- Ad Features -->
                                        {{--<ul class="add_info">
                                                <li><a href="#"><img src="{{asset('frontend')}}/images/blog/s1.jpg"
                                        alt=""></a></li>
                                        <li><a href="#"><img src="{{asset('frontend')}}/images/blog/s1.jpg" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{asset('frontend')}}/images/blog/s1.jpg" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{asset('frontend')}}/images/blog/s1.jpg" alt=""></a>
                                        </li>
                                        </ul>--}}
                                        <!-- Ad History -->
                                        @php
                                        $dato_formate = \Carbon\Carbon::parse($invent->date_in_stock);
                                        @endphp
                                        <div class="clearfix archive-history">
                                            <div class="last-updated">Last Updated:
                                                {{ $dato_formate->diffForHumans() }}</div>
                                            <div class="ad-meta"> <a  class="btn save-ad"><i class="fa fa-heart text-white"></i>
                                                    Add Favorite</a>
                                                    <a href="{{ route('auto.details',$invent->id) }}" class="btn btn-success"><i class="fa fa-eye"></i>View Details.</a> </div>
                                        </div>
                                    </div>
                                    <!-- Ad Desc End -->
                                </div>
                                <!-- Content Block End -->
                            </div>
                            @empty
                            @endforelse



                        </div>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-= Latest Ads End =-=-=-=-=-=-= -->
            </div>
            <!-- Right Sidebar -->
            <div class="col-xs-12 col-md-5">
                <!-- Sidebar Widgets -->
                <div class="sidebar">
                    <!-- Price info block -->
                    <div class="category-list-icon">
                        <i class="green flaticon-mail-1"></i>
                        <div class="category-list-title">
                            <h5><a href="#" data-toggle="modal" data-target=".price-quote">Contact Seller</a></h5>
                        </div>


                    </div>
                    <div class="category-list-icon">
                        <div class="user-photo col-md-4 col-sm-3  col-xs-4">
                        @if($inventory->user->package && $inventory->is_feature == 1)
                            <img class="img-circle" src="{{ asset('frontend/images/sk.jpg') }}" alt="">
                        @else
                        <span class="user-name">
                                <p href="#">[ Hidden logo ]</>
                            </span>
                        @endif
                        </div>
                        <div class="user-information  col-md-8 col-sm-9 col-xs-8">
                        @if($inventory->user->package && $inventory->is_feature == 1)
                            <span class="user-name"><a class="hover-color"
                                    href="#">{{ $inventory->users->username }}</a></span>
                            <span class="user-name">
                                <p href="#">{{ $inventory->users->address }}</>
                            </span>
                            <div class="item-date">
                                {{--<span class="ad-pub">Published on: {{ $inventory->stock_date}}</span><br>--}}
                                <a href="#" class="link hover-color">More Ads</a>
                            </div>
                        @else
                            <span class="user-name">
                                <p href="#">[ Hidden infomation ]</>
                            </span>
                        @endif

                        </div>
                    </div>
                    {{--<div class="category-list-icon">
                              <i class="purple flaticon-smartphone"></i>
                              <div class="category-list-title">
                                 <h5><a href="javascript:void(0)" class="number" data-last="111111X">0320<span>XXXXXXX</span></a></h5>
                              </div>
                           </div>--}}


                    <!-- User Info -->
                    <div class="bg-white">


                        <!--  Form -->
                        @if (session()->has('message'))
                        <div class="text-success">
                            <h3>{{ session()->get('message')}}</h3>
                        </div>

                        @endif
                        @php
                        $user = auth()->user();
                        @endphp
                        <h3 class="tead-message" style="background-color: #2F4F4F;padding:4px;color:white">MESSAGE
                            SELLER</h3>
                        <form class="message-lead-byer" action="{{ route('lead.store')}}" method="POST"
                            style="background-color: #d6d6d6">
                            @csrf
                            <div class="container-fluid">

                                <input type="hidden" name="tmp_inventories_id" value="{{ $inventory->id}}">
                                <input type="hidden" name="vichele_name" value="{{ $inventory->title}}">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 " style="margin-top:20px">
                                        <div class="form-group ">

                                            <input placeholder="First Name*"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                type="text" name="first_name"
                                                value="{{ ($user ? $user->fname : old('first_name'))}}">
                                            @error('first_name')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 " style="margin-top:20px">
                                        <div class="form-group ">

                                            <input placeholder="Last Name*"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                type="text" name="last_name"
                                                value="{{ ($user ? $user->lname : old('last_name'))}}">
                                            @error('last_name')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="form-group ">

                                            <input placeholder="E-mail*"
                                                class="form-control @error('email') is-invalid @enderror" type="text"
                                                name="email" value="{{ ($user ? $user->email : old('email'))}}">
                                            @error('email')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="form-group ">

                                            <input
                                                class="form-control us_telephone @error('phone') is-invalid @enderror" type="text"
                                                name="phone" value="{{ ($user ? $user->phone : old('phone'))}}" data-mask="(999) 999-9999">
                                            @error('phone')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="form-group ">
                                            <textarea id="w3review"
                                                class="form-control @error('description') is-invalid @enderror"
                                                name="description" rows="4" cols="55">I am interested and want to know more about the {{ $inventory->title }} Sport Utility, you have listed for $ {{ $inventory->price }} on Localcarz.
                                                    </textarea>
                                            @error('description')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="form-group ">
                                            <p style="color: black"><input type="checkbox" name="ask_trade"
                                                    id="tradeChecked" style="cursor: pointer"> Do you have a
                                                trade-in?</p>

                                        </div>

                                    </div>
                                    <div class="row" style="margin-left: 0px; margin-right:0px; display:none"
                                        id="Trade_block_content">
                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                            <div class="form-group ">

                                                <input placeholder="Year*"
                                                    class="form-control @error('year') is-invalid @enderror" type="text"
                                                    name="year" value="{{old('year')}}">
                                                @error('year')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                            <div class="form-group ">

                                                <input placeholder="Make*"
                                                    class="form-control @error('make') is-invalid @enderror" type="text"
                                                    name="make" value="{{ old('make')}}">
                                                @error('make')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                            <div class="form-group ">

                                                <input placeholder="Model*"
                                                    class="form-control @error('model') is-invalid @enderror"
                                                    type="text" name="model" value="{{old('model')}}">
                                                @error('model')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                            <div class="form-group ">

                                                <input placeholder="Mileage*"
                                                    class="form-control @error('mileage') is-invalid @enderror"
                                                    type="text" name="mileage" value="{{ old('mileage')}}">
                                                @error('mileage')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                            <div class="form-group ">

                                                <input placeholder="Color*"
                                                    class="form-control @error('color') is-invalid @enderror"
                                                    type="text" name="color" value="{{ old('color')}}">
                                                @error('color')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                            <div class="form-group ">
                                                <input placeholder="VIN (optional)" class="form-control " type="text"
                                                    name="vin" value="{{ old('vin')}}">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="form-group ">
                                            <p style="color: black"><input type="checkbox" name="isEmailSend"
                                                    style="cursor: pointer" checked> Email me price drops for this
                                                vehicle </p>

                                        </div>

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-theme btn-lg btn-block">Send</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>
                        <!-- Form -->
                        <p class="mini" style="    font-size: 12px;
                                   line-height: 11px;
                                   color: #999;
                                   margin-top: 5px; text-align:justify">By clicking "SEND EMAIL", I consent to be
                            contacted by localcarz.com and the dealer selling this car at any telephone number I
                            provide, including, without limitation, communications sent via text message to my cell
                            phone or communications sent using an autodialer or prerecorded message. This
                            acknowledgment constitutes my written consent to receive such communications. I have
                            read and agree to the Terms and Conditions of Use and Privacy Policy of localcarz.com.
                            This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service
                            apply.</p>
                    </div>
                    <div class="map" id="itemMap">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3431.0994401347843!2d-88.21638292426417!3d30.687478133787742!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x889bb264d8d2482b%3A0xf6be7f6160faedaf!2sSkco%20Automotive!5e0!3m2!1sen!2sus!4v1693733384879!5m2!1sen!2sus"
                            width="600" height="365" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <!-- Recent Ads -->
                    <div class="widget">
                        <div class="widget-heading">
                            <h4 class="panel-title"><a>Recent Ads</a></h4>
                        </div>
                        <div class="widget-content recent-ads">
                            <!-- Ads -->
                            @forelse($inventories as $invento)
                            <div class="recent-ads-list">
                                <div class="recent-ads-container">
                                    <div class="recent-ads-list-image">
                                        <a href="{{ route('auto.details', $invento->id) }}"
                                            class="recent-ads-list-image-inner">
                                            <img src="{{ $invento->image }}" alt="">
                                        </a><!-- /.recent-ads-list-image-inner -->
                                    </div>
                                    <!-- /.recent-ads-list-image -->
                                    <div class="recent-ads-list-content">
                                        <h3 class="recent-ads-list-title">

                                            <a
                                                href="{{ route('auto.details', $invento->id) }}">{{ $invento->title }}</a>
                                        </h3>
                                        <ul class="recent-ads-list-location">
                                            {{--<li><a href="#">New York</a>,</li>
                                          <li><a href="#">Brooklyn</a></li>--}}
                                            <li>
                                                <p>{{ $invento->dealer_address_formate }}</p>
                                            </li>
                                        </ul>
                                        <div class="recent-ads-list-price">
                                            {{$invento->price_formate}}
                                        </div>
                                        <!-- /.recent-ads-list-price -->
                                    </div>
                                    <!-- /.recent-ads-list-content -->
                                </div>
                                <!-- /.recent-ads-container -->
                            </div>
                            @empty
                            @endforelse
                            <!-- Ads -->

                        </div>
                    </div>
                    <!--  Financing calculator  -->
                    <div class="widget">
                        <div class="widget-heading">
                            <h4 class="panel-title"><a>Financing Calculator</a></h4>
                        </div>
                        <div
                            style="border:1px solid rgb(167, 165, 165); border-radius:7px; width:97%; margin:0 auto; margin-top:16px;">
                            @php
                            $down_paym = ($inventory->price * 10/100);
                            $loan_amount = $inventory->price - ($inventory->price * 10/100);
                            @endphp
                            <p style="display:block; text-align:center"><small>Estimated Monthly Payment:</small></p>
                            <h1 style="display:block; text-align:center"><sup>$</sup><span id="monthly_pay">{{ $inventory->payment_price }}</span>
                            </h1>
                            <p style="display:block; text-align:center" id="loan_amount"><small>Total Loan Amount:
                                    ${{$loan_amount }}
                                </small></p>
                            <p style="display:block; text-align:center"><small>*Est. on 10% down & good credit </small>
                            </p>
                        </div>
                        <div class="widget-content ">
                            <div class="finance-calculator">


                                <ul>
                                    <li class="col-lg-12 col-md-6 col-sm-12 col-xs-12 ">
                                        <div class="row">

                                            <div class=" col-lg-6">
                                                <label>Credit Score</label>
                                                <select class="common_calculate" id="credit_calculate">
                                                    <option value="rebuild">Rebuilding (0-620)</option>
                                                    <option value="fair">Fair (621-699)</option>
                                                    <option value="good" selected>Good (700-759)</option>
                                                    <option value="excellent">Excellent (760+)</option>
                                                </select>
                                            </div>
                                            <div class=" col-lg-6">
                                                <label>Vehicle Price</label>
                                                <input type="text" class="form-control common_calculate"
                                                    placeholder="Enter a vehicle price" value="{{ $inventory->price }}"
                                                    id="price_calculate">
                                            </div>


                                        </div>

                                    </li>
                                    <li class="col-lg-12 col-md-6 col-sm-12 col-xs-12 ">
                                        <div class="row">
                                            <div class=" col-lg-6">
                                                <label>Interest Rate (APR) %</label>
                                                <input type="text" class="form-control common_calculate"
                                                    placeholder="Enter an interest rate" value="5.82"
                                                    id="calculate_interest">
                                            </div>

                                            <div class=" col-lg-6">
                                                <label>Down Payment</label>
                                                <input type="text" class="form-control common_calculate"
                                                    placeholder="Enter a down payment" id="calculate_downpayment"
                                                    value="{{$down_paym}}">
                                            </div>
                                        </div>

                                    </li>

                                    <ul class="finance-radio-list">
                                        <label>Period month</label>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class=" col-md-2 col-sm-2 col-xs-2 monthly-package">

                                                    <li class="">
                                                        <input type='radio' value='36' class="common_calculate"
                                                            name='calculate_month' id='36' />
                                                        <label for='36'>36</label>
                                                    </li>
                                                </div>
                                                <div class=" col-md-2 col-sm-2 col-xs-2 monthly-package">
                                                    <li>
                                                        <input type='radio' value='48' class="common_calculate"
                                                            name='calculate_month' id='48' />
                                                        <label for='48'>48</label>
                                                    </li>
                                                </div>
                                                <div class=" col-md-2 col-sm-2 col-xs-2 monthly-package">
                                                    <li>
                                                        <input type='radio' value='60' class="common_calculate"
                                                            name='calculate_month' id='60' />
                                                        <label for='60'>60</label>
                                                    </li>
                                                </div>
                                                <div class=" col-md-2 col-sm-2 col-xs-2 monthly-package">
                                                    <li>
                                                        <input type='radio' value='72' class="common_calculate"
                                                            name='calculate_month' id='72' checked />
                                                        <label class="pt-2" for='72'>72</label>
                                                    </li>

                                                </div>

                                                <div class=" col-md-2 col-sm-2 col-xs-2 monthly-package">
                                                    <li>
                                                        <input type='radio' value='84' class="common_calculate"
                                                            name='calculate_month' id='84' />
                                                        <label for='84'>84</label>
                                                    </li>

                                                </div>
                                            </div>

                                        </div>





                                    </ul>
                                    <li class="col-lg-12 col-md-6 col-sm-12 col-xs-12 ">

                                    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="auto-field">
                                            <input class="btn btn-theme btn-sm margin-bottom-20 common_calculate"
                                                type="submit" value="Calculate">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Saftey Tips  -->
                    <div class="widget">
                        <div class="widget-heading">
                            <h4 class="panel-title"><a>Safety tips for deal</a></h4>
                        </div>
                        <div class="widget-content saftey">
                            <ol>
                                <li>Use a safe location to meet seller</li>
                                <li>Avoid cash transactions</li>
                                <li>Beware of unrealistic offers</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Widgets End -->
            </div>
            <!-- Middle Content Area  End -->
        </div>
        <!-- Row End -->
</div>
<!-- Main Container End -->
</section>
<!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
{{-- email lead modal start --}}




<!-- Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <!--  Form -->
                @if (session()->has('message'))
                <div class="text-success">
                    <h3>{{ session()->get('message')}}</h3>
                </div>

                @endif
                @php
                $user = auth()->user();
                @endphp
                <h3 style="background-color: #2F4F4F;padding:4px;color:white">MESSAGE </h3>
                <form action="{{ route('lead.store')}}" method="POST" style="background-color: #d6d6d6">
                    @csrf
                    <div class="container-fluid">

                        <input type="hidden" name="tmp_inventories_id" value="{{ $inventory->id}}">
                        <input type="hidden" name="vichele_name" value="{{ $inventory->title}}">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 " style="margin-top:20px">
                                <div class="form-group ">

                                    <input placeholder="First Name*"
                                        class="form-control @error('first_name') is-invalid @enderror" type="text"
                                        name="first_name" value="{{ ($user ? $user->fname : old('first_name'))}}">
                                    @error('first_name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 " style="margin-top:20px">
                                <div class="form-group ">

                                    <input placeholder="Last Name*"
                                        class="form-control @error('last_name') is-invalid @enderror" type="text"
                                        name="last_name" value="{{ ($user ? $user->lname : old('last_name'))}}">
                                    @error('last_name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <div class="form-group ">

                                    <input placeholder="E-mail*"
                                        class="form-control @error('email') is-invalid @enderror" type="text"
                                        name="email" value="{{ ($user ? $user->email : old('email'))}}">
                                    @error('email')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <div class="form-group ">

                                    <input
                                        class="form-control telephoneInput @error('phone') is-invalid @enderror" type="text"
                                        name="phone"
                                        placeholder="cell"
                                        value="{{ ($user ? $user->phone : old('phone'))}}">
                                    @error('phone')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="form-group ">
                                    <textarea id="w3review"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description" rows="4" cols="55">I am interested and want to know more about the {{ $inventory->title }} Sport Utility, you have listed for $ {{ $inventory->price }} on Localcarz.
                                                    </textarea>
                                    @error('description')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="form-group ">
                                    <p style="color: black"><input type="checkbox" name="ask_trade"
                                            id="tradeCheckedEmail" style="cursor: pointer"> Do you have a trade-in?
                                    </p>

                                </div>

                            </div>


                            <div class="row Trade_block_content"
                                style="margin-left: 0px; margin-right:0px; display:none">
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="form-group ">

                                        <input placeholder="Year*"
                                            class="form-control @error('year') is-invalid @enderror" type="text"
                                            name="year" value="{{old('year')}}">
                                        @error('year')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="form-group ">

                                        <input placeholder="Make*"
                                            class="form-control @error('make') is-invalid @enderror" type="text"
                                            name="make" value="{{ old('make')}}">
                                        @error('make')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="form-group ">

                                        <input placeholder="Model*"
                                            class="form-control @error('model') is-invalid @enderror" type="text"
                                            name="model" value="{{old('model')}}">
                                        @error('model')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="form-group ">

                                        <input placeholder="Mileage*"
                                            class="form-control @error('mileage') is-invalid @enderror" type="text"
                                            name="mileage" value="{{ old('mileage')}}">
                                        @error('mileage')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="form-group ">

                                        <input placeholder="Color*"
                                            class="form-control @error('color') is-invalid @enderror" type="text"
                                            name="color" value="{{ old('color')}}">
                                        @error('color')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="form-group ">
                                        <input placeholder="VIN (optional)" class="form-control " type="text" name="vin"
                                            value="{{ old('vin')}}">

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="form-group ">
                                    <p style="color: black"><input type="checkbox" name="isEmailSend"
                                            style="cursor: pointer" checked> Email me price drops for this vehicle
                                    </p>

                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-theme btn-lg btn-block">Send</button>
                                </div>


                                <p style="    font-size: 12px;
                                   line-height: 11px;
                                   color: #999;
                                   margin-top: 5px; text-align:justify">By clicking "SEND EMAIL", I consent to be
                                    contacted by localcarz.com and the dealer selling this car at any telephone
                                    number I provide, including, without limitation, communications sent via text
                                    message to my cell phone or communications sent using an autodialer or
                                    prerecorded message. This acknowledgment constitutes my written consent to
                                    receive such communications. I have read and agree to the Terms and Conditions
                                    of Use and Privacy Policy of localcarz.com. This site is protected by reCAPTCHA
                                    and the Google Privacy Policy and Terms of Service apply.</p>




                            </div>

                        </div>
                    </div>

                </form>
                <!-- Form -->

            </div>

        </div>
    </div>
</div>

{{-- email lead modal close --}}



<div class=" emailmodalpopup">

    {{-- <i class="fa fa-share-alt bottom-share"></i> --}}
    {{-- <a href="https://www.flaticon.com/free-icons/share" title="share icons"></a> --}}
    {{-- <a href="#"><img class="bottom-share"   src="{{asset('frontend/images/share.png')}}" ></a> --}}
    {{-- <a  href="#"><i class="fa fa-heart btn save-ad love-icon" id="wishlist-icon" title="Wishlist"></i></a> --}}


                                @php
                                $countWishList = 0;
                                @endphp
                                @if(Auth::check())
                                @php
                                $countWishList =
                                App\Models\Favourite::countWishList($inventory->id);
                                @endphp
                                @endif

                                <a href="javascript:void(0);" class="update_wishlist"
                                    data-productid="{{ $inventory->id }}">
                                    @if($countWishList > 0)
                                    <i class="fa fa-heart btn save-ad love-icon" id="wishlist-icon" title="Wishlist"
                                        style="color:red"></i>
                                    @else
                                    <i class="fa fa-heart btn save-ad love-icon" id="wishlist-icon" title="Wishlist"></i>
                                    @endif
                                </a>




  <a  data-toggle="modal" data-target="#emailModal" class="bottom-check">Check Availability</a>

</div>




<!-- =-=-=-=-=-=-= Make Modal =-=-=-=-=-=-= -->
<div class="search-modal modal fade cat_modal03757" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>
                <h3 class="modal-title text-center">Standard Features</h3>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <div class="search-block">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12 popular-search">
                            {{--<label>All Standard Features</label>--}}
                            <!-- Brands List -->
                            <div class="">
                                <ul class="list">
                                    @foreach($core_featurtes_datas as $key => $make_list)

                                    <ul class="custom-list-style">
                                        <li class="col-sm-6 col-md-6 col-xs-6">
                                            <label for="r1">{{ $make_list}}</label>
                                        </li>
                                    </ul>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Brands List End -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-block btn-block">Close</span>
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
@endsection

@push('js')
<script type="text/javascript">

document.getElementById('copyUrlButton').addEventListener('click', function() {
    // Get the current URL from the browser's address bar
    const currentUrl = window.location.href;

    // Create a temporary input element to hold the URL
    const tempInput = document.createElement('input');
    tempInput.value = currentUrl;
    document.body.appendChild(tempInput);

    // Select the input's value and copy it to the clipboard
    tempInput.select();
    document.execCommand('copy');

    // Remove the temporary input element
    document.body.removeChild(tempInput);

    // Display a message to indicate that the URL has been copied
    alert('The URL has been copied to the clipboard.');
});

$(document).ready(function () {

$(".phone_xx").keyup(function (e) {
    var value = $(".phone_xx").val();
    if (e.key.match(/[0-9]/) == null) {
        value = value.replace(e.key, "");
        $(".phone_xx").val(value);
        return;
    }

    if (value.length == 3) {
        $(".phone_xx").val(value + "-")
    }
    if (value.length == 7) {
        $(".phone_xx").val(value + "-")
    }
});
});









$(document).ready(function() {



    $('#tradeChecked').on('change', function() {

        var isChecked = this.checked;
        if (isChecked == true) {
            $('#Trade_block_content').css('display', 'block');
        } else {
            $('#Trade_block_content').css('display', 'none');
        }


    });
    $('#tradeCheckedEmail').on('change', function() {

        var isChecked = this.checked;
        if (isChecked == true) {
            $('.Trade_block_content').css('display', 'block');
        } else {
            $('.Trade_block_content').css('display', 'none');
        }


    });

    $('.common_calculate').on('change click', function() {
        var price = parseFloat($('#price_calculate').val());
        var credit = $('#credit_calculate').val();
        var interest_rate = parseFloat($('#calculate_interest').val());
        var down_payment_percentage = 10 / 100;
        var calculateMonthValue = $('input[name="calculate_month"]:checked').val();

        // Calculate down payment
        var down_payment = price * down_payment_percentage;
        $('#calculate_downpayment').val(down_payment);

        var loan_amount = price - down_payment;

        // Set interest rate based on credit
        if (credit == 'rebuild') {
            interest_rate = 11 / 100;
            $('#calculate_interest').val(11);
        } else if (credit == 'fair') {
            interest_rate = 6.85 / 100;
            $('#calculate_interest').val(6.85);
        } else if (credit == 'good') {
            interest_rate = 5.82 / 100;
            $('#calculate_interest').val(5.85);
        } else if (credit == 'excellent') {
            interest_rate = 4 / 100;
            $('#calculate_interest').val(4);
        }

        // Calculate monthly payment
        var months = calculateMonthValue; // Assuming a 72-month (6-year) loan term
        var monthly_interest_rate = interest_rate / 12;

        var monthly_payment = Math.ceil((loan_amount * monthly_interest_rate) / (1 - Math.pow(1 +
            monthly_interest_rate, -months)));

        $('#monthly_pay').html(monthly_payment); // Remove .toFixed(2)
        $('#loan_amount').html('Total Loan Amount: $' + Math.floor(loan_amount)); // Remove .toFixed(2)
    });

})
</script>


<script>
// JavaScript function to truncate text after a full word
function truncateText() {
    var content = document.getElementById("text_data");
    var button = document.getElementById("show-more-button");

    if (content.style.display === "none") {
        content.style.display = "block";
        button.innerHTML = "Show Less";
    } else {
        content.style.display = "none";
        button.innerHTML = "Show More";
    }
}

$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


$(document).ready(function() {
    // Initialize Inputmask
    $('.telephoneInput').inputmask('(999) 999-9999');

    $('.update_wishlist').on('click', function() {
    var inventory_id = $(this).data('productid');
    var my_id = "{{ Auth::id() }}";
    var url = "{{ route('update.wishlist') }}";
    if (my_id === "") {
        //  alert("Please login first!!");
        $('#inventory_id_pass').val(inventory_id);
        $('#favourite_add_auth_modal').modal('show');

    }
    console.log(inventory_id + my_id);

    $.ajax({
        url: url,
        type: 'post',
        data: {
            inventory_id: inventory_id,
            user_id: my_id
        },

        success: function(response) {
            var icon = $('#wishlist-icon');

            if (response.action === 'add') {
                $('a[data-productid=' + inventory_id + ']').html(
                    `<i class="fa fa-heart btn save-ad" id="wishlist-icon" title="Wishlist" style="color:red">&nbsp;Save Fav.</i>`
                );
                toastr.success(response.message);
            } else if (response.action === 'remove') {
                $('a[data-productid=' + inventory_id + ']').html(
                    `<i class="fa fa-heart-o btn save-ad" id="wishlist-icon" title="Wishlist" >&nbsp;Save Fav.</i>`
                );
                toastr.error(response.message);
            }
        },
        error: function(error) {
            // Handle error here
        }


    });

});




$('#CheckEmail').on('click', function() {

var email = $('#email').val();
$.ajax({
    url: "{{ route('favourte.check.auth') }}",
    type: 'post',
    data: {
        email: email
    },
    success: function(res) {
        if (res.email) {
            $('.error_email').text(res.email);
        }
        if (res.status == 1) {
            $('#replace_html').css('display', 'none');
            $('#login_field').css('display', 'block');
            $('#email_session_one').text(res.email);
            $('.email_session_one').val(res.email);
        }

        if (res.status == 0) {
            $('#rowOne').css('display', 'none');
            $('#rowTwo').css('display', 'block');
            $('#email_session_two').text(res.email);
            $('.email_session_two').val(res.email);

        }



    }
})
});

$('#login').on('click', function() {
var password = $('#password').val();
var inventory_id = $('#inventory_id_pass').val();
$.ajax({
    url: "{{ route('favourte.auth.login')}}",
    type: 'post',
    data: {
        password: password,
        inventory_id: inventory_id
    },
    success: function(res) {
        if (res.password) {
            $('.error_password').text(res.password);
        }
        if (res.message) {

            toastr.success(res.message);
            window.location.reload();

        }
        if (res.error) {

            toastr.success(res.error);
            $('.error_password').text(res.error);

        }

    }
})
});

$('#SignUp').on('click', function() {

var email = $('.email_session_two').val();

var password = $('#res_password').val();
var inventory_id = $('#inventory_id_pass').val();
$.ajax({
    url: "{{ route('favourte.auth.signup')}}",
    type: 'post',
    data: {
        email: email,
        password: password,
        inventory_id: inventory_id
    },
    success: function(res) {
        if (res.email) {
            $('.sign_up_email').text(res.email);

        }
        if (res.password) {
            $('.sign_up_password').text(res.password);
        }
        if (res.create) {
            toastr.success(res.create);
            window.location.reload();
            //window.location.href = "{{ route('buyer.login') }}";

        }

    }
});
});





  });


     // HTML BOx JS Code
     let HTMLBox = document.getElementById("HTMLBox");
      let HTMLButton = document.getElementById("HTMLButton");

      HTMLButton.onclick = function () {
        const currentUrl = window.location.href;
        currentUrl.select();
        document.execCommand("copy");
        HTMLButton.innerText = "Codes Copied";
      };


</script>

@endpush
