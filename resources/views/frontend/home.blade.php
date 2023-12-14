@extends('frontend.layouts.appnew')
@section('title', 'Home | ')
@section('content')

@push('css')

<style>
.hov {
    color: black;
}

.hov:hover {
    color: red;
}

.wishlist {
    list-style: none;
}

.wishlist li {
    display: inline-block;
    margin-right: 20px;
}

.flaticon-like-1 {
    font-size: 24px;
}
</style>


@endpush

<!-- =-=-=-=-=-=-= Home Banner  =-=-=-=-=-=-= -->







{{--<div class="banner-info">
    <div class="slider-container active">
        <div class="slide">
            <div class="content-first">

                <img class="img-all" src="{{asset('frontend/images/lady1.png')}}">
            </div>
        </div>
    </div>
    <div class="slider-container">
        <div class="slide">
            <div class="content">
                <img class="img-all" src="{{asset('frontend/images/333.jpg')}}">
            </div>
        </div>
    </div>
    <div class="slider-container">
        <div class="slide">
            <div class="content">
                <img class="img-all" src="{{asset('frontend/images/lady1.png')}}">
            </div>
        </div>
    </div>

    <div id="prev" onClick="prev()">
        < </div>
            <div id="next" onClick="next()"> > </div>

    </div>--}}


    <!-- =-=-=-=-=-=-= Home Banner End =-=-=-=-=-=-= -->

          <!-- Master Slider -->
          <div class="master-slider ms-skin-default" id="masterslider">


         <!-- slide 1 -->
         @foreach ($slide as $item)
         <div class="ms-slide slide-1"  data-delay="5">
            <!-- slide background -->
            <img src="js/masterslider/style/blank.gif" data-src="{{asset('/dashboard/images/slides/')}}/{{$item->image}}" alt="Slide1 background"/>
            <!-- slide thumbnail Image -->

            <h3 class="ms-layer title4 font-white font-uppercase font-thin-xs"
               style="left:120px; top:150px;"
               data-type="text"
               data-delay="2000"
               data-duration="2000"
               data-ease="easeOutExpo"
               data-effect="skewleft(30,80)">Find Your Dream Car</h3>
            <h3 class="ms-layer title4 font-white font-thin-xs"
               style="left:120px; top:210px;"
               data-type="text"
               data-delay="2500"
               data-duration="2000"
               data-ease="easeOutExpo"
               data-effect="skewleft(30,80)"><span class="font-color font-thin-xs heading-color">BECOME A LOCALCARZ.COM SELLERS TODAY!</span></h3>
            <h5 class="ms-layer text1 font-white"
               style="left: 120px; top: 280px;"
               data-type="text"
               data-effect="bottom(45)"
               data-duration="2500"
               data-delay="3000"
               data-ease="easeOutExpo">You Can advertise your vehicle with your photo and vedios at localcarz.com untill it sells.
            </h5>
            <a href="{{ route('autos') }}" class="ms-layer btn3 uppercase"
               style="left:120px; top: 390px;"
               data-type="text"
               data-delay="3500"
               data-ease="easeOutExpo"
               data-duration="2000"
               data-effect="scale(1.5,1.6)">Search Cars</a>
         </div>
         @endforeach
         <!-- end of slide -->

         <!-- slide 2 -->
         {{--<div class="ms-slide slide-3" data-delay="5">
            <!-- slide background -->

          <img src="js/masterslider/style/blank.gif" data-src="{{asset('/dashboard/images/slides/')}}/{{$item->image}}" alt="Slide1 background"/>



             <img src="js/masterslider/style/blank.gif" data-src="{{asset('frontend/images/333.jpg')}}" alt="Slide1 background"/>
            <h3 class="ms-layer title4 font-white font-uppercase font-thin-xs"
               style="left:120px; top:150px;"
               data-type="text"
               data-delay="2000"
               data-duration="2000"
               data-ease="easeOutExpo"
               data-effect="skewleft(30,80)">{{$item->title}}</h3>
            <h3 class="ms-layer title4 font-white font-thin-xs"
               style="left:120px; top:210px;"
               data-type="text"
               data-delay="2500"
               data-duration="2000"
               data-ease="easeOutExpo"
               data-effect="skewleft(30,80)"><span class="font-color font-thin-xs heading-color">{{$item->sub_title}}</span></h3>
            <h5 class="ms-layer text1 font-white"
               style="left: 120px; top: 280px;"
               data-type="text"
               data-effect="bottom(45)"
               data-duration="2500"
               data-delay="3000"
               data-ease="easeOutExpo">{{$item->description}}
            </h5>
            <a class="ms-layer btn3 uppercase"
               style="left:120px; top: 390px;"
               data-type="text"
               data-delay="3500"
               data-ease="easeOutExpo"
               data-duration="2000"
               data-effect="scale(1.5,1.6)"> View All Cars</a>


         </div>
         <!-- end of slide -->
         <div class="ms-slide slide-2" data-delay="4">
            <div class="ms-overlay-layers"></div>
            <!-- slide background -->
            <img src="js/masterslider/style/blank.gif" data-src="{{asset('frontend/images/333.jpg')}}" alt="Slide1 background"/>
            <h3 class="ms-layer title4 font-white font-uppercase font-thin-xs"
               style="left:120px; top:150px;"
               data-type="text"
               data-delay="2000"
               data-duration="2000"
               data-ease="easeOutExpo"
               data-effect="skewleft(30,80)">Welcome to Carspot</h3>
            <h3 class="ms-layer title4 font-white font-thin-xs"
               style="left:120px; top:210px;"
               data-type="text"
               data-delay="2500"
               data-duration="2000"
               data-ease="easeOutExpo"
               data-effect="skewleft(30,80)"><span class="font-color font-thin-xs heading-color">Find Your Dream Car</span></h3>
            <h5 class="ms-layer text1 font-white"
               style="left: 120px; top: 280px;"
               data-type="text"
               data-effect="bottom(45)"
               data-duration="2500"
               data-delay="3000"
               data-ease="easeOutExpo">Lorem Ipsum is simply dummy text of the printing typesetting<br>
               industry is proident sunt in culpa officia deserunt mollit.
            </h5>
            <a class="ms-layer btn3 uppercase"
               style="left:120px; top: 390px;"
               data-type="text"
               data-delay="3500"
               data-ease="easeOutExpo"
               data-duration="2000"
               data-effect="scale(1.5,1.6)"> View All Cars</a>
         </div>--}}
         <!-- slide 2 -->
         <!-- end of slide -->
      </div>
      <!-- end Master Slider -->
    <!-- =-=-=-=-=-=-= Advanced Search =-=-=-=-=-=-= -->
    <div class="dropdown-manage">
        <div class="advance-search ">
            <div class="section-search search-style-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 system">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs ">
                                <li class="nav-item active">
                                    <a class="nav-link" data-toggle="tab" href="#tab1">Make/Model </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab2">Body Style</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab3">Payment</a>
                                </li>
                                <li class="nav-item">
                                    <a class=" advanced" href="{{ route('autos') }}">Advanced Search<i
                                            class="fa fa-arrow-right "></i></a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content clearfix">
                                <div class="tab-pane fade in active" id="tab1">
                                    <form action="{{ route('autos') }}" method="get" id="bodyStyleFilter">
                                        <div class="search-form pull-left">
                                            <div class="search-form-inner ">
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                    <select class="form-control rounded" area-hidden="false !important"
                                                            id="makeData" name="make" >
                                                            <option selected value="">Select Make</option>
                                                            @foreach($makes_data as $make => $key)
                                                            <option value="{{ $make}}" required>{{ $make }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">
                                                    <select class="form-control ll" id="model" name="model">
                                                            <option selected disabled>Select Model</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">
                                                    <select class="form-control " name="min">
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
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">
                                                    <select class="form-control" name="max">
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
                                                </div>
                                            </div>

                                        </div>




                                        <div class="search-form pull-left">
                                            <div class="search-form-inner pull-left">

                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select  class=" form-control bg-danger" >
                                                            <option selected value="">Any Miles</option>
                                                            <option>10 Miles</option>
                                                            <option>25 Miles </option>
                                                            <option>50 Miles </option>
                                                            <option>75 Miles </option>
                                                            <option>100 Miles</option>
                                                            <option>150 Miles</option>
                                                            <option>250 Miles</option>
                                                            <option>500 Miles</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <input type="text" class="form-control"
                                                            placeholder="Zip Code" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <button type="submit" value="submit" class="btn find-button"><i
                                                            class="fa fa-search me-2"></i>FIND YOURS</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <form action="{{ route('autos') }}" method="get" id="bodyStyleFilter">
                                        <div class="search-form pull-left">
                                            <div class="search-form-inner ">
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select class="form-control" name="body">
                                                            <option selected value="">All Body</option>
                                                            @foreach($inventory_bodies as $body => $index)
                                                            <option>{{$body}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select class="form-control" name="miles">
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
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select class=" form-control" name="min">
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
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select class="form-control" name="max">
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
                                                </div>
                                            </div>

                                        </div>




                                        <div class="search-form pull-left">
                                            <div class="search-form-inner pull-left">

                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select class=" form-control">
                                                            <option selected value="">Any Miles</option>
                                                            <option>10 Miles</option>
                                                            <option>25 Miles </option>
                                                            <option>50 Miles </option>
                                                            <option>75 Miles </option>
                                                            <option>100 Miles</option>
                                                            <option>150 Miles</option>
                                                            <option>250 Miles</option>
                                                            <option>500 Miles</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <input type="text" class="form-control"
                                                            placeholder="Zip Code" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <button type="submit" value="submit" class="btn find-button"><i
                                                            class="fa fa-search me-2"></i>FIND YOURS</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>


                                <div class="tab-pane fade" id="tab3">
                                    <form action="{{ route('autos') }}" method="get" id="paymentFilter">
                                        <div class="search-form pull-left">
                                            <div class="search-form-inner ">
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select class=" form-control" name="min-payment">
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
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select class="form-control" name="max-payment">
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
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select class="form-control" name="min-year">


                                                            <option selected value="">Min Year</option>
                                                            @for($i= date('Y'); $i>= 1901 ; $i--)
                                                            <option value="{{$i}}">{{ $i }}</option>
                                                            @endfor

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select class="form-control" name="max-year">
                                                            <option selected value="">Max Year</option>
                                                            @for($i= date('Y'); $i>= 1901 ; $i--)
                                                            <option value="{{$i}}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>




                                        <div class="search-form pull-left">
                                            <div class="search-form-inner pull-left">

                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <select class=" form-control make">
                                                            <option slected disbaled>Any Miles</option>
                                                            <option>10 Miles</option>
                                                            <option>25 Miles </option>
                                                            <option>50 Miles </option>
                                                            <option>75 Miles </option>
                                                            <option>100 Miles</option>
                                                            <option>150 Miles</option>
                                                            <option>250 Miles</option>
                                                            <option>500 Miles</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 dropdown-pad no-padding">
                                                    <div class="form-group">

                                                        <input type="text" class="form-control"
                                                            placeholder="Zip Code" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <button type="submit" id="makeModelBtn" value="submit"
                                                        class="btn find-button"><i class="fa fa-search me-2"></i>FIND
                                                        YOURS</button>


                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- =-=-=-=-=-=-= Advanced Search End =-=-=-=-=-=-= -->


        <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
        <div class="main-content-area clearfix">
            <!-- =-=-=-=-=-=-= Featured Ads =-=-=-=-=-=-= -->


            <section class="custom-padding gray">

                <div class="container">
                    {{--<!-- Main Container -->
                    <div class="home-add ad-related-img">
                        <img src="{{asset('frontend/images/top.jpg')}}" class="img-responsive center-block" alt="" />
                    </div>--}}

                   <!-- Related Image  -->
                   <div style="margin-top:55px" class="banner">
                    <a href="/skco" target="_blank">
                        <img class="auto-img" src="{{asset('frontend/images/top.jpg')}}" alt="">
                    </a>

                </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <h2 class="text-center shop-title">SHOP YOUR FAVORITE BRAND</h2>
                            <p class="text-center shop-para">Start your search by choosing one of the most popular makes
                                like Chevrolet, Ford or Honda. Shop millions. Find yours!</p>
                            <div class="row card-info">
                                @foreach($counts as $key => $count)
                                @if($key < 10) <div class="col-md-2 col-lg-2 col-sm-2 col-xs-5 card-1  ">
                                    <div class="card-text mb-2" style="padding: 15px 0px;">
                                        <a href="{{ route('autos', ['make' => $count->make]) }}" style="color:black;">
                                            <h6 class="car-title hov">{{ $count->make }}</h6>
                                        </a>
                                        <p class="count ms-1">({{ $count->count }})</p>
                                    </div>
                            </div>
                            @endif

                            @if($key >= 10 && $key < 20 ) <div class="col-md-2  col-sm-2 col-xs-5 card-2 ">
                                <div class="card-text mb-2" style="padding: 15px 0px ">
                                    <a href="{{ route('autos', ['make' => $count->make]) }}" style="color:black;">
                                        <h6 class="car-title hov">{{ $count->make }}</h6>
                                    </a>
                                    <p class="count ms-1">({{ $count->count }})</p>
                                </div>
                        </div>
                        @endif

                        @if($key >= 20 && $key < 30 ) <div class="col-md-2  col-sm-2 col-xs-5 card-3 ">
                            <div class="card-text mb-2" style="padding: 15px 0px ">
                                <a href="{{ route('autos', ['make' => $count->make]) }}" style="color:black;">
                                    <h6 class="car-title hov">{{ $count->make }}</h6>
                                </a>
                                <p class="count ms-1">({{ $count->count }})</p>
                            </div>
                    </div>
                    @endif

                    @if($key >= 30 && $key < 40 ) <div class="col-md-2  col-sm-2 col-xs-6 card-4">
                        <div class="card-text mb-2" style="padding: 15px 0px ">
                            <a href="{{ route('autos', ['make' => $count->make]) }}" style="color:black;">
                                <h6 class="car-title hov">{{ $count->make }}</h6>
                            </a>
                            <p class="count ms-1">({{ $count->count }})</p>
                        </div>
                </div>
                @endif

                @if($key >= 40 && $key < 50 ) <div class="col-md-2  col-sm-2 col-xs-6 card-5">
                    <div class="card-text mb-2" style="padding: 15px 0px ">
                        <a href="{{ route('autos', ['make' => $count->make]) }}" style="color:black;">
                            <h6 class="car-title hov">{{ $count->make }}</h6>
                        </a>
                        <p class="count ms-1">({{ $count->count }})</p>
                    </div>
        </div>
        @endif
        @if($key >= 50 && $key < 60 ) <div class="col-md-2 col-sm-2 col-xs-6 card-6">
            <div class="card-text mb-2" style="padding: 15px 0px ">
                <a href="{{ route('autos', ['make' => $count->make]) }}" style="color:black;">
                    <h6 class="car-title hov">{{ $count->make }}</h6>
                </a>
                <p class="count ms-1">({{ $count->count }})</p>
            </div>
    </div>
    @endif
    @endforeach
</div>



<!-- Row -->
<div class="row">
    <!-- Heading Area -->
    <div class="heading-panel">
        <div class="col-xs-12 col-md-12 col-sm-12 left-side">
            <!-- Main Title -->
            <h1>NEWLY <span class="heading-color"> LISTED</span> CARS</h1>
        </div>
    </div>
    <!-- Middle Content Box -->
    <div class="row grid-style-2 ">

        <div class="col-md-12 col-xs-12 col-sm-12">

            @forelse($inventories as $inventory)


            <!-- asdkl;fjasdklfjasklfjalskfjlkasfjklas kiajsdflkjasedflk jasd -->

            <div class="col-md-4 col-xs-12 col-sm-6 ">
                <div class="category-grid-box-1" >
                    <div class="featured-ribbon">
                        {{-- <span>Featured</span>--}}
                    </div>
                    <div class="image">
                        @php
                            $modifiedBodyString = str_replace(' ', '+', $inventory->body);
                            $url_id = $inventory->year.'-'.$inventory->make.'-'.$inventory->model.'-'.$modifiedBodyString.'-'.$inventory->stock;
                        @endphp
                        <a title="" href="{{ route('auto.details',['vin' =>$inventory->vin, 'id' => $url_id]) }}">
                          @if ($inventory->image)
                          <img src="{{ $inventory->image }}" alt="Local cars Image" width="100%" height="275px">
                          @else
                          <img src="{{ asset('frontend/images/come.jpg') }}" alt="Local cars Image" width="100%" height="275px">
                          @endif


                        {{--@php
                            try {
                                $image = file_get_contents($inventory->image);
                                $hasError = false;
                            } catch (\Exception $e) {
                                $hasError = true;
                            }
                        @endphp

                        @if (!$hasError)
                            <img src="data:image/jpg;base64,{{ base64_encode($image) }}" alt="Loaded Image">
                        @else
                            <img src="{{ asset('frontend/images/coming-soon.jpg') }}" alt="Default Image">
                        @endif--}}

                        <div class="ribbon popular"></div>

                        <div class="price-tag ">
                            <div class="price"><span>{{ $inventory->price_formate }}
                                {{--<small class="payment-price"><sup class="doller-info">$</sup>{{ $inventory->payment_price }}/ {{'mo*'}}</small>--}}
                            </span></div>
                        </div>
                    </div>
                    @if($inventory->user->package && $inventory->is_feature == 1)
                    <img width="85px" style="left:160px; top:358px; position:absolute" src="{{asset('frontend/images/package4.png')}}" alt="Feature">
                    @endif
                    <div class="short-description-1 clearfix">
                        @php
                         $title_info_data = substr( $inventory->title,0,30);

                         $fuel_data = str_replace('Fuel','',$inventory->fuel);
                        @endphp
                        <h3><a title="" href="{{ route('auto.details',['vin' =>$inventory->vin, 'id' => $url_id]) }}"><strong>{{ $title_info_data }}</strong></a>
                        </h3>
                        <div class="category-title">
                            <p class="location no-margin"><b>{{ $inventory->dealers->dealer_name }}</b></p>
                            <p>
                            <i class="fa fa-map-marker"></i>
                            <span >
                                <a class="location-formate" href="#" >{{ $inventory->dealers->dealer_city }}, {{ $inventory->dealers->dealer_state }}.</a>
                            </span>
                            </p>

                        </div>
                        <ul class="list-unstyled">
                            <li><a href="javascript:void(0)" title="Fuel"><i class="flaticon-gas-station-1" title="Fuel"></i>{{ $fuel_data }}</a></li>
                            <li><a href="javascript:void(0)" title="Mileage"><i class="flaticon-dashboard"
                                        title="Mileage"></i>{{ $inventory->miles_formate }} miles</a></li>
                            <li><a href="javascript:void(0)" title="Drive Train"><i class="flaticon-car-2"
                                        title="Drive Train"></i>{{ $inventory->drive_train }}</a></li>
                            <li><a href="javascript:void(0)" title="Engine"><i class="flaticon-engine-2"
                                        title="Engine"></i><small>{{ $inventory->engine_description_formate }}</small></a>
                            </li>
                            <li><a href="javascript:void(0)" title="Exterior Color"><i class="flaticon-cogwheel-outline"
                                        title="Exterior Color"></i>{{ $inventory->exterior_color }}</a></li>
                        </ul>
                    </div>
                    <div class="ad-info-1">
                        @php
                        $dato_formate = \Carbon\Carbon::parse($inventory->date_in_stock);
                        @endphp
                        <p><i class="flaticon-calendar" title="Day in Stock"></i>
                            &nbsp;<span>{{ $dato_formate->diffForHumans() }}</span> </p>
                        <ul class="pull-right">

                            @php
                            $countWishList = 0;
                            if (session()->has('favourite')) {
                                $favourites = session('favourite');
                                foreach ($favourites as $favorite) {
                                    if ($favorite['id'] == $inventory->id) {
                                        $countWishList = 1;
                                        break; // No need to continue the loop if found
                                    }
                                }
                            }
                            @endphp


                            <li>
                                <a href="javascript:void(0);" class="update_wishlist"
                                    data-productid="{{ $inventory->id }}">
                                    @if($countWishList > 0)
                                    <i class="fa fa-heart" id="wishlist-icon" title="Wishlist" style="color:red"></i>
                                    @else
                                    <i class="fa fa-heart-o" id="wishlist-icon" title="Wishlist"></i>

                                    @endif
                                </a>
                            </li>
                            <li> <a href="{{ route('auto.details',['vin' =>$inventory->vin, 'id' => $url_id]) }}"><i class="flaticon-search-2"
                                        title="Go to details"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Listing Ad Grid -->
            </div>
            <!-- p;asjdfkasjdjas jaslkdjaslkdjakls djskladjkasjd klasjdlkasjdk -->


            @empty
            @endforelse


            <!-- /col -->
            {{--<div class="col-md-4 col-xs-12 col-sm-6">
                      <div class="category-grid-box-1">

                         <div class="image">
                         <a title="" href="{{ route('auto.details',$inventory->id) }}"><img alt="Carspot"
                src="{{ $inventory->image }}" class="img-responsive"></a>
            <div class="ribbon popular"></div>

        </div>
        <div class="short-description-1 clearfix">

            <h3><a title="" href="{{ route('auto.details',$inventory->id) }}">{{ $inventory->title }}</a></h3>
            <p class="newlist-para"> {{ $inventory->description }}</p>


            <ul class="list-unstyled">

                <li><a href="javascript:void(0)"><i class="flaticon-gas-station-1"
                            title="Fuel"></i>{{ $inventory->fuel }}</a></li>
                <li><a href="javascript:void(0)"><i class="flaticon-dashboard"
                            title="Mileage"></i>{{ $inventory->miles }} Miles</a></li>

                <li><a href="javascript:void(0)"><i class="flaticon-car-2"></i>SUV</a></li>

            </ul>
        </div>
        <div class="ad-info-1">
            <p class="price"><span>$ {{ $inventory->price }}</span></p>
            <ul class="pull-right">
                <li> <a href="javascript:void(0);" class="update_wishlist" data-productid="{{ $inventory->id }}"><i
                            class="flaticon-like-1" id="#wishlist-icon" title="Wishlist"></i></a></li>--}}
                {{--@php
                                    $countWishList = 0;
                                   @endphp
                                   @if(Auth::check())
                                       @php
                                          $countWishList = App\Models\Favourite::countWishList($inventory->id);
                                       @endphp
                                   @endif
                                   <li>
                                       <a href="javascript:void(0);" class="update_wishlist" data-productid="{{ $inventory->id }}">
                @if($countWishList > 0)
                <i class="fa fa-heart" id="wishlist-icon" title="Wishlist" style="color:red"></i>
                @else
                <i class="fa fa-heart-o" id="wishlist-icon" title="Wishlist"></i>

                @endif
                </a>
                </li>
                <li> <a href="{{ route('auto.details',$inventory->id )}}"><i class="flaticon-search-2"
                            title="Go to details"></i></a></li>

            </ul>
        </div>
    </div>
    <!-- Listing Ad Grid -->
</div>
--}}

</div>
</div>
<!-- Middle Content Box End -->
</div>
<!-- Row End -->
</div>
<!-- Main Container End -->
</section>
<!-- =-=-=-=-=-=-= Featured Ads End =-=-=-=-=-=-= -->

{{--<!-- =-=-=-=-=-=-= Services Section  =-=-=-=-=-=-= -->
    <section class="section-padding services-center">
       <div class="container">
          <!-- Heading Area -->
          <div class="heading-panel">
             <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                <!-- Main Title -->
                <h1>Our <span class="heading-color"> Feature </span> Services</h1>
                <!-- Short Description -->
                <p class="heading-text">Eu delicata rationibus usu. Vix te putant utroque, ludus fabellas duo eu, his dico ut debet consectetuer.</p>
             </div>
          </div>
          <div class="row clearfix">
             <!--Left Column-->
             <div class="col-md-4 col-sm-6 col-xs-12 pull-left">
             <!--Service Block -->
             <div class="services-grid">
                   <div class="icons icon-right"><i class="flaticon-engine-4"></i></div>
                   <h4>Engine Upgrades</h4>
                   <p>We have the right caring, experience and dedicated professional for you.</p>
                </div>
             <!--Service Block -->
             <div class="services-grid">
                   <div class="icons icon-right"><i class="flaticon-settings"></i></div>
                   <h4>Car Inspection</h4>
                   <p>We have the right caring, experience and dedicated professional for you.</p>
                </div>
                 <!--Service Block -->


             </div>

             <!--Right Column-->
             <div class="col-md-4 col-sm-6 col-xs-12 pull-right">
                <!--Service Block-->


                <div class="services-grid">
                   <div class="icons icon-left"><i class="flaticon-vehicle-3"></i></div>
                   <h4>Car Oil Change</h4>
                   <p>We have the right caring, experience and dedicated professional for you.</p>
                </div>
                <!--Service Block-->
                 <div class="services-grid">
                   <div class="icons icon-left"><i class="flaticon-car-steering-wheel"></i></div>
                   <h4>Power steering</h4>
                   <p>We have the right caring, experience and dedicated professional for you.</p>
                </div>

             </div>
             <!--Image Column-->
             <div class="col-md-4 col-sm-12 col-xs-12">
                <figure class="wow zoomIn  animated" data-wow-delay="0ms" data-wow-duration="3500ms" >
                   <img class="center-block" src="{{asset('/frontend')}}/images/service-car.png" alt="">
</figure>
</div>
</div>

</div>

</section>
<!-- =-=-=-=-=-=-=  Services Section End =-=-=-=-=-=-= -->--}}



{{--<!-- =-=-=-=-=-=-= Testimonials =-=-=-=-=-=-= -->
    <section class="section-padding parallex bg-img-3">
       <div class="container">
          <div class="row">
             <div class="owl-testimonial-2">
                <!--Testimonial Column-->
                <div class="single_testimonial">
                   <div class="textimonial-content">
                      <h4>Just fabulous</h4>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru.</p>
                   </div>
                   <div class="testimonial-meta-box">
                      <img src="{{asset('/frontend')}}/images/users/1.jpg" alt="">
<div class="testimonial-meta">
    <h3 class="">Jhon Emily Copper </h3>
    <p> Developer</p>
    <i class="fa fa-star"></i>
    <i class="fa fa-star"></i>
    <i class="fa fa-star"></i>
    <i class="fa fa-star"></i>
    <i class="fa fa-star"></i>
</div>
</div>
</div>
<!--Testimonial Column-->
<div class="single_testimonial">
    <div class="textimonial-content">
        <h4>Awesome ! Loving It</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru.</p>
    </div>
    <div class="testimonial-meta-box">
        <img src="{{asset('/frontend')}}/images/users/2.jpg" alt="">
        <div class="testimonial-meta">
            <h3 class="">Hania Sheikh </h3>
            <p> CEO Pvt. Inc.</p>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
</div>
<!--Testimonial Column-->
<div class="single_testimonial">
    <div class="textimonial-content">
        <h4>Very quick and Fast</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru.</p>
    </div>
    <div class="testimonial-meta-box">
        <img src="{{asset('/frontend')}}/images/users/3.jpg" alt="">
        <div class="testimonial-meta">
            <h3 class="">Jaccica Albana </h3>
            <p> CTO Albana Inc.</p>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
</div>
<!--Testimonial Column-->
<div class="single_testimonial">
    <div class="textimonial-content">
        <h4>Done in 3 Months! Awesome</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru.</p>
    </div>
    <div class="testimonial-meta-box">
        <img src="{{asset('/frontend')}}/images/users/4.jpg" alt="">
        <div class="testimonial-meta">
            <h3 class="">Humayun Sarfraz </h3>
            <p> CTO Glixen Technologies.</p>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
</div>
<!--Testimonial Column-->
<div class="single_testimonial">
    <div class="textimonial-content">
        <h4>Find It Quit Professional</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru.</p>
    </div>
    <div class="testimonial-meta-box">
        <img src="{{asset('/frontend')}}/images/users/4.jpg" alt="">
        <div class="testimonial-meta">
            <h3 class="">Massica O'Brain </h3>
            <p> Audit Officer </p>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
</div>
<!--Testimonial Column-->
<div class="single_testimonial">
    <div class="textimonial-content">
        <h4>Just fabulous</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru.</p>
    </div>
    <div class="testimonial-meta-box">
        <img src="{{asset('/frontend')}}/images/users/1.jpg" alt="">
        <div class="testimonial-meta">
            <h3 class="">Jhon Emily Copper </h3>
            <p> Developer</p>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
</div>
<!--Testimonial Column-->
<div class="single_testimonial">
    <div class="textimonial-content">
        <h4>Awesome ! Loving It</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru.</p>
    </div>
    <div class="testimonial-meta-box">
        <img src="{{asset('/frontend')}}/images/users/2.jpg" alt="">
        <div class="testimonial-meta">
            <h3 class="">Hania Sheikh </h3>
            <p> CEO Pvt. Inc.</p>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
</div>
<!--Testimonial Column-->
<div class="single_testimonial">
    <div class="textimonial-content">
        <h4>Very quick and Fast</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru.</p>
    </div>
    <div class="testimonial-meta-box">
        <img src="{{asset('/frontend')}}/images/users/3.jpg" alt="">
        <div class="testimonial-meta">
            <h3 class="">Jaccica Albana </h3>
            <p> CTO Albana Inc.</p>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
</div>
<!--Testimonial Column-->
<div class="single_testimonial">
    <div class="textimonial-content">
        <h4>Done in 3 Months! Awesome</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru.</p>
    </div>
    <div class="testimonial-meta-box">
        <img src="{{asset('/frontend')}}/images/users/4.jpg" alt="">
        <div class="testimonial-meta">
            <h3 class="">Humayun Sarfraz </h3>
            <p> CTO Glixen Tech.</p>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
</div>
<!--Testimonial Column-->
<div class="single_testimonial">
    <div class="textimonial-content">
        <h4>Find It Quit Professional</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim veniam quis notru.</p>
    </div>
    <div class="testimonial-meta-box">
        <img src="{{asset('/frontend')}}/images/users/4.jpg" alt="">
        <div class="testimonial-meta">
            <h3 class="">Massica O'Brain </h3>
            <p> Audit Officer </p>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>
<!-- =-=-=-=-=-=-= Testimonials Section End =-=-=-=-=-=-= --> --}}


<!-- =-=-=-=-=-=-= Expert Reviews Section =-=-=-=-=-=-= -->
<section class="news section-padding">
    <div class="container">
        <div class="row">
            <div class="heading-panel">
                <div class="col-xs-12 col-md-12 col-sm-12 left-side">

                    <h1>LATEST <span class="heading-color"> NEWS</span>, EXPERT <span class="heading-color">
                            REVIEWS</span> AND <span class="heading-color"> TIPS</span> FOR BUYING CARS</p>
                </div>
            </div>
            @forelse($many_news as $key => $news)
            @if($key < 1)
            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="mainimage">
                    <a>
                        <img  alt="" class="img-responsive" src="{{ asset('frontend/images/news/') }}/{{$news->image}}">

                        <div class="overlay">
                            <a><h2>{{ $news->title }}</h2></a>

                            @php

                            $news_data = strip_tags(substr($news->description,0,185));
                            @endphp
                        </div>
                        <p>{!! $news_data !!}...</p>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            @else
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="newslist">
                    <ul>
                        <li>
                            <div class="imghold"> <a><img src="{{ asset('frontend/images/news/') }}/{{$news->image}}" alt=""></a>
                            </div>
                            <div class="texthold">
                                @php
                                    $length = strlen($news->title);
                                    $extra = ' ';
                                    if($length > 68){
                                        $extra = '...';
                                    }
                                    $news_title = substr($news->title,0,65) .$extra;
                                    $news_data = strip_tags(substr($news->description,0,100));
                                @endphp
                                <h4><a>{{ $news_title }} </a></h4>
                                <p>{!! $news_data !!}...</p>
                            </div>
                            <div class="clear"></div>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
            @empty
            @endforelse

        </div>
        <div class="clearfix"></div>
    </div>
</section>

<!-- =-=-=-=-=-=-= Expert Reviews End =-=-=-=-=-=-= -->
{{-- <!-- =-=-=-=-=-=-= Our Clients =-=-=-=-=-=-= -->
    <section class="client-section gray">
       <div class="container">
          <div class="row">
             <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="margin-top-30">
                   <h3>Why Choose Us</h3>
                   <h2>Our premium Clients</h2>
                </div>
             </div>
             <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="brand-logo-area clients-bg">
                   <div class="clients-list">
                      <div class="client-logo">
                         <a href="#"><img src="{{asset('/frontend')}}/images/brands/16.png" class="img-responsive"
alt="Brand Image" /></a>
</div>
<div class="client-logo">
    <a href="#"><img src="{{asset('/frontend')}}/images/brands/2.png" class="img-responsive" alt="Brand Image" /></a>
</div>
<div class="client-logo">
    <a href="#"><img src="{{asset('/frontend')}}/images/brands/11.png" class="img-responsive" alt="Brand Image" /></a>
</div>
<div class="client-logo">
    <a href="#"><img src="{{asset('/frontend')}}/images/brands/4.png" class="img-responsive" alt="Brand Image" /></a>
</div>
<div class="client-logo">
    <a href="#"><img src="{{asset('/frontend')}}/images/brands/5.png" class="img-responsive" alt="Brand Image" /></a>
</div>
<div class="client-logo">
    <a href="#"><img src="{{asset('/frontend')}}/images/brands/6.png" class="img-responsive" alt="Brand Image" /></a>
</div>
<div class="client-logo">
    <a href="#"><img src="{{asset('/frontend')}}/images/brands/7.png" class="img-responsive" alt="Brand Image" /></a>
</div>
<div class="client-logo">
    <a href="#"><img src="{{asset('/frontend')}}/images/brands/8.png" class="img-responsive" alt="Brand Image" /></a>
</div>
<div class="client-logo">
    <a href="#"><img src="{{asset('/frontend')}}/images/brands/9.png" class="img-responsive" alt="Brand Image" /></a>
</div>
<div class="client-logo">
    <a href="#"><img src="{{asset('/frontend')}}/images/brands/17.png" class="img-responsive" alt="Brand Image" /></a>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- =-=-=-=-=-=-= Our Clients End =-=-=-=-=-=-= --> --}}
{{-- <!-- =-=-=-=-=-=-= Car Inspection =-=-=-=-=-=-= -->
    <section class="car-inspection section-padding">
       <div class="container">
          <div class="row">
             <div class="col-md-6 col-sm-6 col-xs-12 nopadding hidden-sm">
                <div class="call-to-action-img-section-right">
                   <img src="{{asset('/frontend')}}/images/banner-3.jpg" class="wow slideInLeft img-responsive"
data-wow-delay="0ms" data-wow-duration="3000ms" alt="">
</div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
    <div class="call-to-action-detail-section">
        <div class="heading-2">
            <h3> Your Auto Dealer Marketing Solution </h3>
            <h2>Car Inspection</h2>

        </div>
        <p> It's FREE! it’s a deal you can't miss! </p>
        <div class="row">
            <ul>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Transmission</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Steering</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Engine</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Tires</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Lighting</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Interior</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Suspension</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Exterior</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Brakes</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Air Conditioning</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Engine Diagnostics</li>
                <li class="col-sm-4"> <i class="fa fa-check"></i> Wheel Alignment</li>
            </ul>
        </div>
        <a href="" class="btn-theme btn-lg btn">Schedule Inspection <i class="fa fa-angle-right"></i></a>
    </div>
</div>
</div>
</div>
</section>
<!-- =-=-=-=-=-=-= Car Inspection End =-=-=-=-=-=-= --> --}}
<!-- =-=-=-=-=-=-= Buy Or Sale =-=-=-=-=-=-= -->
<section class="sell-box padding-top-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                <div class="sell-box-grid">
                    <div class="short-info">
                        <h3> Your Auto Dealer Marketing Solution</h3>
                        <h2><a href="#">It's FREE! it’s a deal you can't miss!</a></h2>
                        <p>Search your car in our Inventory and request a quote on the vehicle of your choosing.
                        </p>
                    </div>
                    <div class="text-center">
                        <img class="img-responsive slideInLeft center-block" data-wow-delay="0ms"
                            data-wow-duration="2000ms" src="{{ asset('/frontend') }}/images/banner-3.jpg" alt=""  style=" visibility: visible; animation-duration: 2000ms;animation-delay: 0ms;animation-name: none;">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                <div class="sell-box-grid">
                    <div class="short-info">
                        <h3> FOR ONLY $20/MONTH!</h3>
                        <h2> <a href="#">Do you want to sell your car?</a></h2>
                        <p>You can advertise your vehicle with your photos and videos at localcarz.com until it
                            sells! </p>

                    </div>
                    <div class="text-center">
                        <img class="img-responsive  slideInRight center-block" data-wow-delay="0ms"
                            data-wow-duration="2000ms" src="{{ asset('/frontend') }}/images/banner-4.jpg" alt="" style=" visibility: visible; animation-duration: 2000ms;animation-delay: 0ms;animation-name: none;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =-=-=-=-=-=-= Buy Or Sale End =-=-=-=-=-=-= -->

</div>
<!-- Main Content Area End -->
<!-- Back To Top -->


@php
    $userIP = $_SERVER['REMOTE_ADDR'];
@endphp
<input type="hidden" name="ip" value="{{ $userIP}}" class="ip_address">
{{-- login modal show end here --}}
@endsection

@push('js')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


//Add new data
$(document).ready(function() {

    $('#makeData').change(function() {
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

                $('#model').empty();
                $('#model').append('<option selected disabled>All Model</option>');
                $.each(data, function(index, item) {
                    $('#model').append('<option value="' + index + '">' +
                        index + '</option>');
                });
            },
            error: function(error) {
                console.log(error);
                // toastr.error(error.responseJSON.message);
            }
        });
    });


    //update wislist start
    $('.update_wishlist').click(function() {
        var inventory_id = $(this).data('productid');
        // var my_id = "{{ Auth::id() }}";

        var url = "{{ route('update.wishlist') }}";
        // if (my_id === "") {
        //     //  alert("Please login first!!");
        //     $('#inventory_id_pass').val(inventory_id);
        //     $('#favourite_add_auth_modal').modal('show');

        // }
        // console.log(inventory_id);



        $.ajax({
            url: url,
            type: 'post',
            data: {
                inventory_id: inventory_id,
            },

            success: function(response) {
                console.log(response);

                var icon = $('#wishlist-icon');

                if (response.action === 'add') {
                    $('a[data-productid=' + inventory_id + ']').html(
                        `<i class="fa fa-heart" id="wishlist-icon" title="Wishlist" style="color:red"></i>`
                    );
                    toastr.success(response.message);
                } else if (response.action === 'remove') {
                    $('a[data-productid=' + inventory_id + ']').html(
                        `<i class="fa fa-heart-o" id="wishlist-icon" title="Wishlist" ></i>`
                    );
                    toastr.error(response.message);
                }
            },
            error: function(error) {
                // Handle error here
            }


        });

    });
    //update wislist end

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
            console.log(res);
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






let slides = document.querySelectorAll('.slider-container');
let index = 0;

function next() {
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
}

function prev() {
    slides[index].classList.remove('active');
    index = (index - 1 + slides.length) % slides.length;
    slides[index].classList.add('active');
}

setInterval(next, 4000);
</script>
@endpush
