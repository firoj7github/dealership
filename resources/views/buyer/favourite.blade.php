@extends('buyer.dashboard')
@section('inner_content')
<div class="row margin-top-40">
    <!-- Middle Content Area -->
    <div class="col-md-12 col-lg-12 col-sx-12">
        <!-- Row -->
        <ul class="list-unstyled">

            <!-- Listing Grid -->
            @forelse($favorites as $favorite)
            <li>
                <div class="well ad-listing clearfix">
                    <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                        <!-- Image Box -->
                        <div class="img-box">
                            @php
                              $images = explode(',',$favorite->image_from_url);
                            @endphp
                            <img src="{{ $images[0] }}" class="img-responsive" alt="Local Cars">
                            <div class="total-images"><strong>{{count($images)}}</strong> photos </div>
                            <div class="quick-view"> <a href="#ad-preview" data-toggle="modal" class="view-button"><i
                                        class="fa fa-search"></i></a> </div>
                        </div>
                        <!-- Ad Status -->
                        {{--<span class="ad-status"> Featured </span>--}}
                        <!-- User Preview -->
                        <div class="user-preview">
                            <a href="#"> <img src="{{asset('frontend')}}/images/users/2.jpg}}"
                                    class="avatar avatar-small" alt=""> </a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-7 col-xs-12">
                        <!-- Ad Content-->
                        <div class="row">
                            <div class="content-area">


                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <!-- Ad Title -->
                                    <h3><a href="{{ route('auto.details',['vin' =>$favorite->vin, 'id' => $favorite->id]) }}">{{ $favorite->year.' '.$favorite->make.' '.$favorite->model.' '.$favorite->trim }}</a>
                                    </h3>
                                    <!-- Ad Meta Info -->
                                    <ul class="ad-meta-info">
                                        <li> <i class="fa fa-map-marker"></i><a href="#">{{ $favorite->dealers->dealer_city }},
                                                {{ $favorite->dealers->dealer_state }}</a> </li>
                                        @php
                                        $dato_formate = \Carbon\Carbon::parse($favorite->date_in_stock);
                                        @endphp
                                        <li>{{ $dato_formate->diffForHumans() }} </li>
                                    </ul>
                                    <!-- Ad Description-->
                                    <div class="ad-details">
                                        @php
                                        $desc = substr($favorite->description ,0,180)
                                        @endphp
                                        <p>{{$desc}} ... </p>
                                        <ul class="list-unstyled">
                                            <li><i class="flaticon-gas-station-1" title="Fuel"></i>{{ $favorite->fuel }}
                                            </li>
                                            <li><i class="flaticon-dashboard" title="Mileage"></i><b>{{ $favorite->miles_formate }}</b>
                                                miles</li>
                                            <li><i class="flaticon-engine-2" title="Engine"></i>{{ $favorite->engine_description_formate }}</li>
                                            <li><i class="flaticon-key" title="Condition"></i>{{ $favorite->condition }}
                                            </li>
                                            <li><i class="flaticon-calendar-2" title="Year"></i> {{ $favorite->year }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12 col-sm-12">
                                    <!-- Ad Stats -->
                                    <div class="short-info">
                                        <div class="ad-stats hidden-xs"><span>Transmission :
                                            </span>{{ $favorite->transmission }}</div>
                                        <div class="ad-stats hidden-xs"><span>Model : </span>{{ $favorite->model }}
                                        </div>
                                        <div class="ad-stats hidden-xs"><span>Make : </span>{{ $favorite->make }}</div>
                                    </div>
                                    <!-- Price -->
                                    <div class="price"> <span>{{ $favorite->price_formate }}</span> </div>
                                    <!-- Ad View Button -->
                                    <button class="btn btn-block btn-default">
                                        @php
                                        $countWishList = 0;
                                        @endphp

                                        @php
                                        $userIP = $_SERVER['REMOTE_ADDR'];
                                        $countWishList = App\Models\Favourite::countWishList($favorite->id,$userIP);
                                        @endphp

                                        <a href="javascript:void(0);" class="update_wishlist"
                                            data-productid="{{ $favorite->id }}">
                                            <i class="fa fa-times" aria-hidden="true" id="wishlist-icon"></i> UnFavorite
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Ad Content End -->
                    </div>
                </div>
            </li>
            @empty
            <h3 style="text-center mt-4 mb-4">No Favorite  Listing Here.</h3>
            @endforelse
            <!-- Listing Grid -->
            {{--<li>
             <div class="well ad-listing clearfix">
                <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                   <!-- Image Box -->
                   <div class="img-box">
                      <img src="{{asset('frontend')}}/images/posting/26.jpg" class="img-responsive" alt="">
            <div class="total-images"><strong>4</strong> photos </div>
            <div class="quick-view"> <a href="#ad-preview" data-toggle="modal" class="view-button"><i
                        class="fa fa-search"></i></a> </div>
    </div>
    <!-- Ad Status --><span class="ad-status"> Featured </span>
    <!-- User Preview -->
    <div class="user-preview">
        <a href="#"> <img src="{{asset('frontend')}}/images/users/6.jpg" class="avatar avatar-small" alt=""> </a>
    </div>
</div>
<div class="col-md-9 col-sm-7 col-xs-12">
    <!-- Ad Content-->
    <div class="row">
        <div class="content-area">
            <div class="col-md-9 col-sm-12 col-xs-12">
                <!-- Ad Title -->
                <h3><a>2010 Ford Shelby GT500 Coupe</a></h3>
                <!-- Ad Meta Info -->
                <ul class="ad-meta-info">
                    <li> <i class="fa fa-map-marker"></i><a href="#">London</a> </li>
                    <li>15 minutes ago </li>
                </ul>
                <!-- Ad Description-->
                <div class="ad-details">
                    <p>Lorem ipsum dolor sit amet consectetur adiscing das elited ultricies facilisis lacinia pell das
                        elited ultricies facilisis ... </p>
                    <ul class="list-unstyled">
                        <li><i class="flaticon-gas-station-1"></i>Diesel</li>
                        <li><i class="flaticon-dashboard"></i>35,000 km</li>
                        <li><i class="flaticon-engine-2"></i>1800 cc</li>
                        <li><i class="flaticon-key"></i>Manual</li>
                        <li><i class="flaticon-calendar-2"></i>Year 2002</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-12">
                <!-- Ad Stats -->
                <div class="short-info">
                    <div class="ad-stats hidden-xs"><span>Condition : </span>Used</div>
                    <div class="ad-stats hidden-xs"><span>Warranty : </span>7 Days</div>
                    <div class="ad-stats hidden-xs"><span>Sub Category : </span>Mobiles</div>
                </div>
                <!-- Price -->
                <div class="price"> <span>$900</span> </div>
                <!-- Ad View Button -->

                <button class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View Ad.</button>
            </div>
        </div>
    </div>
    <!-- Ad Content End -->
</div>
</div>
</li>
<!-- Listing Grid -->
<li>
    <div class="well ad-listing clearfix">
        <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
            <!-- Image Box -->
            <div class="img-box">
                <img src="{{asset('frontend')}}/images/posting/7.jpg" class="img-responsive" alt="">
                <div class="total-images"><strong>5</strong> photos </div>
                <div class="quick-view"> <a href="#ad-preview" data-toggle="modal" class="view-button"><i
                            class="fa fa-search"></i></a> </div>
            </div>
            <!-- User Preview -->
            <div class="user-preview">
                <a href="#"> <img src="{{asset('frontend')}}/images/users/5.jpg" class="avatar avatar-small" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-9 col-sm-7 col-xs-12">
            <!-- Ad Content-->
            <div class="row">
                <div class="content-area">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <!-- Ad Title -->
                        <h3><a> 2010 Lamborghini Gallardo Spyder</a></h3>
                        <!-- Ad Meta Info -->
                        <ul class="ad-meta-info">
                            <li> <i class="fa fa-map-marker"></i><a href="#">London</a> </li>
                            <li>15 minutes ago </li>
                        </ul>
                        <!-- Ad Description-->
                        <div class="ad-details">
                            <p>Lorem ipsum dolor sit amet consectetur adiscing das elited ultricies facilisis lacinia
                                pell das elited ultricies facilisis ... </p>
                            <ul class="list-unstyled">
                                <li><i class="flaticon-gas-station-1"></i>Diesel</li>
                                <li><i class="flaticon-dashboard"></i>35,000 km</li>
                                <li><i class="flaticon-engine-2"></i>1800 cc</li>
                                <li><i class="flaticon-key"></i>Manual</li>
                                <li><i class="flaticon-calendar-2"></i>Year 2002</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-12">
                        <!-- Ad Stats -->
                        <div class="short-info">
                            <div class="ad-stats hidden-xs"><span>Condition : </span>Used</div>
                            <div class="ad-stats hidden-xs"><span>Warranty : </span>7 Days</div>
                            <div class="ad-stats hidden-xs"><span>Sub Category : </span>Mobiles</div>
                        </div>
                        <!-- Price -->
                        <div class="price"> <span>$120</span> </div>
                        <!-- Ad View Button -->
                        <button class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View
                            Ad.</button>
                    </div>
                </div>
            </div>
            <!-- Ad Content End -->
        </div>
    </div>
</li>
<!-- Listing Grid -->
<li>
    <div class="well ad-listing clearfix">
        <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
            <!-- Image Box -->
            <div class="img-box">
                <img src="{{asset('frontend')}}/images/posting/2.jpg" class="img-responsive" alt="">
                <div class="total-images"><strong>3</strong> photos </div>
                <div class="quick-view"> <a href="#ad-preview" data-toggle="modal" class="view-button"><i
                            class="fa fa-search"></i></a> </div>
            </div>
            <!-- User Preview -->
            <div class="user-preview">
                <a href="#"> <img src="{{asset('frontend')}}/images/users/3.jpg" class="avatar avatar-small" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-9 col-sm-7 col-xs-12">
            <!-- Ad Content-->
            <div class="row">
                <div class="content-area">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <!-- Ad Title -->
                        <h3><a> Porsche 911 Carrera 2017 </a></h3>
                        <!-- Ad Meta Info -->
                        <ul class="ad-meta-info">
                            <li> <i class="fa fa-map-marker"></i><a href="#">London</a> </li>
                            <li>15 minutes ago </li>
                        </ul>
                        <!-- Ad Description-->
                        <div class="ad-details">
                            <p>Lorem ipsum dolor sit amet consectetur adiscing das elited ultricies facilisis lacinia
                                pell das elited ultricies facilisis ... </p>
                            <ul class="list-unstyled">
                                <li><i class="flaticon-gas-station-1"></i>Diesel</li>
                                <li><i class="flaticon-dashboard"></i>35,000 km</li>
                                <li><i class="flaticon-engine-2"></i>1800 cc</li>
                                <li><i class="flaticon-key"></i>Manual</li>
                                <li><i class="flaticon-calendar-2"></i>Year 2002</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-12">
                        <!-- Ad Stats -->
                        <div class="short-info">
                            <div class="ad-stats hidden-xs"><span>Condition : </span>Used</div>
                            <div class="ad-stats hidden-xs"><span>Warranty : </span>7 Days</div>
                            <div class="ad-stats hidden-xs"><span>Sub Category : </span>Mobiles</div>
                        </div>
                        <!-- Price -->
                        <div class="price"> <span>$1,129</span> </div>
                        <!-- Ad View Button -->
                        <button class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View
                            Ad.</button>
                    </div>
                </div>
            </div>
            <!-- Ad Content End -->
        </div>
    </div>
</li>
<!-- Listing Grid -->
<li>
    <div class="well ad-listing clearfix">
        <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
            <!-- Image Box -->
            <div class="img-box">
                <img src="{{asset('frontend')}}/images/posting/15.jpg" class="img-responsive" alt="">
                <div class="total-images"><strong>4</strong> photos </div>
                <div class="quick-view"> <a href="#ad-preview" data-toggle="modal" class="view-button"><i
                            class="fa fa-search"></i></a> </div>
            </div>
            <!-- Ad Status --><span class="ad-status"> Featured </span>
            <!-- User Preview -->
            <div class="user-preview">
                <a href="#"> <img src="{{asset('frontend')}}/images/users/7.jpg" class="avatar avatar-small" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-9 col-sm-7 col-xs-12">
            <!-- Ad Content-->
            <div class="row">
                <div class="content-area">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <!-- Ad Title -->
                        <h3><a>Bugatti Veyron Super Sport </a></h3>
                        <!-- Ad Meta Info -->
                        <ul class="ad-meta-info">
                            <li> <i class="fa fa-map-marker"></i><a href="#">London</a> </li>
                            <li>15 minutes ago </li>
                        </ul>
                        <!-- Ad Description-->
                        <div class="ad-details">
                            <p>Lorem ipsum dolor sit amet consectetur adiscing das elited ultricies facilisis lacinia
                                pell das elited ultricies facilisis ... </p>
                            <ul class="list-unstyled">
                                <li><i class="flaticon-gas-station-1"></i>Diesel</li>
                                <li><i class="flaticon-dashboard"></i>35,000 km</li>
                                <li><i class="flaticon-engine-2"></i>1800 cc</li>
                                <li><i class="flaticon-key"></i>Manual</li>
                                <li><i class="flaticon-calendar-2"></i>Year 2002</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-12">
                        <!-- Ad Stats -->
                        <div class="short-info">
                            <div class="ad-stats hidden-xs"><span>Condition : </span>Used</div>
                            <div class="ad-stats hidden-xs"><span>Warranty : </span>7 Days</div>
                            <div class="ad-stats hidden-xs"><span>Sub Category : </span>Mobiles</div>
                        </div>
                        <!-- Price -->
                        <div class="price"> <span>$350</span> </div>
                        <!-- Ad View Button -->
                        <button class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View
                            Ad.</button>
                    </div>
                </div>
            </div>
            <!-- Ad Content End -->
        </div>
    </div>
</li>
<!-- Listing Grid -->
<li>
    <div class="well ad-listing clearfix">
        <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
            <!-- Image Box -->
            <div class="img-box">
                <img src="{{asset('frontend')}}/images/posting/28.jpg" class="img-responsive" alt="">
                <div class="total-images"><strong>4</strong> photos </div>
                <div class="quick-view"> <a href="#ad-preview" data-toggle="modal" class="view-button"><i
                            class="fa fa-search"></i></a> </div>
            </div>
            <!-- Ad Status --><span class="ad-status"> Featured </span>
            <!-- User Preview -->
            <div class="user-preview">
                <a href="#"> <img src="{{asset('frontend')}}/images/users/6.jpg" class="avatar avatar-small" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-9 col-sm-7 col-xs-12">
            <!-- Ad Content-->
            <div class="row">
                <div class="content-area">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <!-- Ad Title -->
                        <h3><a>Audi A4 2.0T Quattro Premium</a></h3>
                        <!-- Ad Meta Info -->
                        <ul class="ad-meta-info">
                            <li> <i class="fa fa-map-marker"></i><a href="#">London</a> </li>
                            <li>15 minutes ago </li>
                        </ul>
                        <!-- Ad Description-->
                        <div class="ad-details">
                            <p>Lorem ipsum dolor sit amet consectetur adiscing das elited ultricies facilisis lacinia
                                pell das elited ultricies facilisis ... </p>
                            <ul class="list-unstyled">
                                <li><i class="flaticon-gas-station-1"></i>Diesel</li>
                                <li><i class="flaticon-dashboard"></i>35,000 km</li>
                                <li><i class="flaticon-engine-2"></i>1800 cc</li>
                                <li><i class="flaticon-key"></i>Manual</li>
                                <li><i class="flaticon-calendar-2"></i>Year 2002</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-12">
                        <!-- Ad Stats -->
                        <div class="short-info">
                            <div class="ad-stats hidden-xs"><span>Condition : </span>Used</div>
                            <div class="ad-stats hidden-xs"><span>Warranty : </span>7 Days</div>
                            <div class="ad-stats hidden-xs"><span>Sub Category : </span>Computer & Laptops</div>
                        </div>
                        <!-- Price -->
                        <div class="price"> <span>$250</span> </div>
                        <!-- Ad View Button -->
                        <button class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View
                            Ad.</button>
                    </div>
                </div>
            </div>
            <!-- Ad Content End -->
        </div>
    </div>
</li>
<!-- Listing Grid -->
<li>
    <div class="well ad-listing clearfix">
        <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
            <!-- Image Box -->
            <div class="img-box">
                <img src="{{asset('frontend')}}/images/posting/13.jpg" class="img-responsive" alt="">
                <div class="total-images"><strong>4</strong> photos </div>
                <div class="quick-view"> <a href="#ad-preview" data-toggle="modal" class="view-button"><i
                            class="fa fa-search"></i></a> </div>
            </div>
            <!-- Ad Status --><span class="ad-status"> Featured </span>
            <!-- User Preview -->
            <div class="user-preview">
                <a href="#"> <img src="{{asset('frontend')}}/images/users/7.jpg" class="avatar avatar-small" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-9 col-sm-7 col-xs-12">
            <!-- Ad Content-->
            <div class="row">
                <div class="content-area">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <!-- Ad Title -->
                        <h3><a>Audi Q3 2.0T Premium Plus</a></h3>
                        <!-- Ad Meta Info -->
                        <ul class="ad-meta-info">
                            <li> <i class="fa fa-map-marker"></i><a href="#">London</a> </li>
                            <li>15 minutes ago </li>
                        </ul>
                        <!-- Ad Description-->
                        <div class="ad-details">
                            <p>Lorem ipsum dolor sit amet consectetur adiscing das elited ultricies facilisis lacinia
                                pell das elited ultricies facilisis ... </p>
                            <ul class="list-unstyled">
                                <li><i class="flaticon-gas-station-1"></i>Diesel</li>
                                <li><i class="flaticon-dashboard"></i>35,000 km</li>
                                <li><i class="flaticon-engine-2"></i>1800 cc</li>
                                <li><i class="flaticon-key"></i>Manual</li>
                                <li><i class="flaticon-calendar-2"></i>Year 2002</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-12">
                        <!-- Ad Stats -->
                        <div class="short-info">
                            <div class="ad-stats hidden-xs"><span>Condition : </span>Used</div>
                            <div class="ad-stats hidden-xs"><span>Warranty : </span>7 Days</div>
                            <div class="ad-stats hidden-xs"><span>Sub Category : </span>Laptops</div>
                        </div>
                        <!-- Price -->
                        <div class="price"> <span>$440</span> </div>
                        <!-- Ad View Button -->
                        <button class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View
                            Ad.</button>
                    </div>
                </div>
            </div>
            <!-- Ad Content End -->
        </div>
    </div>
</li>
<!-- Listing Grid -->
<li>
    <div class="well ad-listing clearfix">
        <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
            <!-- Image Box -->
            <div class="img-box">
                <img src="{{asset('frontend')}}/images/posting/27.jpg" class="img-responsive" alt="">
                <div class="total-images"><strong>4</strong> photos </div>
                <div class="quick-view"> <a href="#ad-preview" data-toggle="modal" class="view-button"><i
                            class="fa fa-search"></i></a> </div>
            </div>
            <!-- Ad Status --><span class="ad-status"> Featured </span>
            <!-- User Preview -->
            <div class="user-preview">
                <a href="#"> <img src="{{asset('frontend')}}/images/users/4.jpg" class="avatar avatar-small" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-9 col-sm-7 col-xs-12">
            <!-- Ad Content-->
            <div class="row">
                <div class="content-area">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <!-- Ad Title -->
                        <h3><a>2014 Ford Fusion Titanium</a></h3>
                        <!-- Ad Meta Info -->
                        <ul class="ad-meta-info">
                            <li> <i class="fa fa-map-marker"></i><a href="#">London</a> </li>
                            <li>15 minutes ago </li>
                        </ul>
                        <!-- Ad Description-->
                        <div class="ad-details">
                            <p>Lorem ipsum dolor sit amet consectetur adiscing das elited ultricies facilisis lacinia
                                pell das elited ultricies facilisis ... </p>
                            <ul class="list-unstyled">
                                <li><i class="flaticon-gas-station-1"></i>Diesel</li>
                                <li><i class="flaticon-dashboard"></i>35,000 km</li>
                                <li><i class="flaticon-engine-2"></i>1800 cc</li>
                                <li><i class="flaticon-key"></i>Manual</li>
                                <li><i class="flaticon-calendar-2"></i>Year 2002</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-12">
                        <!-- Ad Stats -->
                        <div class="short-info">
                            <div class="ad-stats hidden-xs"><span>Condition : </span>Used</div>
                            <div class="ad-stats hidden-xs"><span>Warranty : </span>7 Days</div>
                            <div class="ad-stats hidden-xs"><span>Sub Category : </span>Furniture</div>
                        </div>
                        <!-- Price -->
                        <div class="price"> <span>$110,50</span> </div>
                        <!-- Ad View Button -->
                        <button class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View
                            Ad.</button>
                    </div>
                </div>
            </div>
            <!-- Ad Content End -->
        </div>
    </div>
</li>--}}
</ul>
{{-- <!-- Advertizing -->
       <section class="advertising">
          <a href="post-ad-1.html">
             <div class="banner">
                <div class="wrapper">
                   <span class="title">Do you want your property to be listed here?</span>
                   <span class="submit">Submit it now! <i class="fa fa-plus-square"></i></span>
                </div>
             </div>
             <!-- /.banner-->
          </a>
       </section>
       <!-- Advertizing End --> --}}
<!-- Ads Archive End -->
<div class="clearfix"></div>
<!-- Pagination -->
<div class="custom-pagination" style="display: flex;justify-content: flex-end">
    <ul class="pagination" >
        @if ($favorites->onFirstPage())
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $favorites->previousPageUrl() }}">Previous</a></li>
        @endif

        @foreach ($favorites->getUrlRange(1, $favorites->lastPage()) as $page => $url)
            @if ($page == $favorites->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($favorites->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $favorites->nextPageUrl() }}">Next</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
        @endif
    </ul>
</div>
<!-- Pagination End -->
</div>
<!-- Middle Content Area  End -->
</div>
@endsection
@push('js')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //update wislist start
    $('.update_wishlist').click(function() {
        var inventory_id = $(this).data('productid');
        // var my_id = "{{ Auth::id() }}";
        var url = "{{ route('update.wishlist') }}";


        $.ajax({
            url: url,
            type: 'post',
            data: {
                inventory_id: inventory_id,

            },

            success: function(response) {
                var icon = $('#wishlist-icon');

                if (response.action === 'remove') {
                    location.reload();
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
</script>
@endpush
