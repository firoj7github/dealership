@extends('frontend.layouts.app')

@section('content')
      <!-- =-=-=-=-=-=-= Breadcrumb =-=-=-=-=-=-= -->
      <div class="page-header-area-2 gray">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="small-breadcrumb">
                     <div class=" breadcrumb-link">
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
            <div class="container ">
                    <!-- Related Image  -->
                    <div class="banner">
                        <img class="auto-img" src="{{asset('frontend/images/top.jpg')}}" alt="">
                    </div>
               <!-- Row -->
               <div class="row ">
                  <!-- Middle Content Area -->
                  <div class="col-md-8 col-md-push-4 col-lg-8 col-sx-12 add_ajax">
                        {{--auto-ajax content goes here--}}
                        <div class="filter_data"></div>
                  </div>
                  <!-- Middle Content Area  End -->
                  <!-- Left Sidebar -->
                  <div class="col-md-4 col-md-pull-8 col-sx-12">
                     <!-- Sidebar Widgets -->
                     <div class="sidebar">
                        <!-- Panel group -->
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <!-- Clear all Condition Panel -->    
                           <div class="panel panel-default">
                              <!-- Heading -->
                              <div class="panel-heading" role="tab" id="heading9">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse9_clear_all" aria-expanded="false" aria-controls="collapse9">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Clear All
                                    </a>
                                 </h4>
                              </div>
                              <!-- Content -->
                              <div id="collapse9_clear_all" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading9">
                                 <div class="panel-body">
                                    <div class="">
                                            <div class="">
                                                <h4><strong>Are you confirm ?</strong></h4>
                                                <p>This action will clear all your queries.</p>

                                                <button class="btn btn-info" id="cancelButton">Cancel</button>
                                                <a href="{{ route('autos') }}" class="btn btn-danger">Clear All</a>
                                            </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Condition Panel End -->  
                           <!-- Brands Panel -->    
                           <div class="panel panel-default">
                              <!-- Heading -->
                              <div class="panel-heading" role="tab" id="headingTwo">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Brand
                                    </a>
                                 </h4>
                              </div>
                              <!-- Content -->
                              <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                                 <div class="panel-body">
                                    <!-- Search -->
                                    <div class="search-widget">
                                       <input placeholder="Search by Car Name" type="text">
                                       <button type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                    <!-- Brands List -->                              
                                    <div class="skin-minimal">
                                       <ul class="list">
                                          <li>
                                             <input  type="checkbox" id="minimal-checkbox-1">
                                             <label for="minimal-checkbox-1">All Brand</label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" id="minimal-checkbox-2">
                                             <label for="minimal-checkbox-2">Audi </label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" id="minimal-checkbox-3">
                                             <label for="minimal-checkbox-3">BMW </label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" id="minimal-checkbox-4">
                                             <label for="minimal-checkbox-4">Mercedes </label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" id="minimal-checkbox-5">
                                             <label for="minimal-checkbox-5">Lamborghini </label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" id="minimal-checkbox-6">
                                             <label for="minimal-checkbox-6">Honda</label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" id="minimal-checkbox-7">
                                             <label for="minimal-checkbox-7">Bugatti </label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" id="minimal-checkbox-8">
                                             <label for="minimal-checkbox-8">Acura </label>
                                          </li>
                                       </ul>
                                       <a href=".cat_modal_make" data-toggle="modal" class="pull-right"><strong>View All</strong></a>
                                    </div>
                                    <!-- Brands List End -->                 
                                 </div>
                              </div>
                           </div>
                           <!-- Brands Panel End -->

                            <!-- Condition make-model/body Panel -->    
                            <div class="panel panel-default">
                              <!-- Heading -->
                              <div class="panel-heading" role="tab" id="headingThreeWebTab">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree_web_makeModelBody" aria-expanded="false" aria-controls="collapseThree_web_makeModelBody">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Make /Model & Body
                                    </a>
                                 </h4>
                              </div>
                              <!-- Content -->
                              <div id="collapseThree_web_makeModelBody" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThreeWebTab">
                                    <select name="" id="">
                                        <option value="">1</option>
                                        <option value="">1</option>
                                        <option value="">1</option>
                                    </select>
                              </div>
                           </div>
                           <!-- Condition make-model/body  End -->  
                           <!-- Condition Panel -->    
                           <div class="panel panel-default">
                              <!-- Heading -->
                              <div class="panel-heading" role="tab" id="heading9">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse9_web_make" aria-expanded="false" aria-controls="collapse9_web_make">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Make
                                    </a>
                                 </h4>
                              </div>
                              <!-- Content -->
                              <div id="collapse9_web_make" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading9">
                                 <div class="panel-body">
                                    <div class="">
                                       <ul class="list">
                                       <li>
                                             <input  type="checkbox" class="common_selector brand" >
                                             <label for="minimal-checkbox-1">&nbsp;&nbsp;&nbsp;All Make</label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" class="common_selector brand" value="Audi">
                                             <label for="minimal-checkbox-2">&nbsp;&nbsp;&nbsp;Audi </label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" class="common_selector brand" value="BMW">
                                             <label for="minimal-checkbox-3">&nbsp;&nbsp;&nbsp;BMW </label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" class="common_selector brand" value="Mercedes">
                                             <label for="minimal-checkbox-4">&nbsp;&nbsp;&nbsp;Mercedes </label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" class="common_selector brand" value="Lamborghini">
                                             <label for="minimal-checkbox-5">&nbsp;&nbsp;&nbsp;Lamborghini </label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" class="common_selector brand" value="Honda">
                                             <label for="minimal-checkbox-6">&nbsp;&nbsp;&nbsp;Honda</label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" class="common_selector brand" value="Bugatti">
                                             <label for="minimal-checkbox-7">&nbsp;&nbsp;&nbsp;Bugatti </label>
                                          </li>
                                          <li>
                                             <input  type="checkbox" class="common_selector brand" value="Acura">
                                             <label for="minimal-checkbox-8">&nbsp;&nbsp;&nbsp;Acura </label>
                                          </li>
                                       </ul>
                                       <a href=".cat_modal_web_make" data-toggle="modal" class="pull-right"><strong>View All</strong></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Condition Panel End -->  
                           <!-- Condition Panel -->    
                           <div class="panel panel-default">
                              <!-- Heading -->
                              <div class="panel-heading" role="tab" id="headingThree">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Transmission
                                    </a>
                                 </h4>
                              </div>
                              <!-- Content -->
                              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
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
                           <!-- Condition Panel End -->  
                           <!-- Body Type Panel -->    
                           <div class="panel panel-default">
                              <!-- Heading -->
                              <div class="panel-heading" role="tab" id="heading7">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Body Type
                                    </a>
                                 </h4>
                              </div>
                              <!-- Content -->
                              <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading7">
                                 <div class="panel-body">
                                    <div class="">
                                       <ul class="list">
                                            @php
                                                $body_count = count($inventory_body);
                                            @endphp
                                            @foreach($inventory_body as $body => $body_id)
                                                <li>
                                                    <input type="checkbox" class="common_selector body" value="{{ $body }}" style="color:black" @checked(request('body')===$body ? 'checked' : '' )>
                                                    <label for="body">&nbsp;&nbsp;&nbsp;{{ $body }}</label>
                                                    {{--<a href="{{ route('autos', ['body&filter' => $body]) }}" {{ $body }}</a>--}}
                                                </li>
                                            @endforeach

                                            @if($body_count >= 10)
                                            <a href=".cat_modal036" data-toggle="modal" class="pull-right"><strong>View All</strong></a>
                                            @endif
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Condition Panel End -->  
                           <!-- Pricing Panel -->
                           <div class="panel panel-default">
                              <!-- Heading -->
                              <div class="panel-heading" role="tab" id="headingfour">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Price
                                    </a>
                                 </h4>
                              </div>
                              <!-- Content -->
                              <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
                                 <div class="panel-body">
                                    <span class="price-slider-value">Price ($) <span id="price-min"></span> - <span id="price-max"></span></span>
                                    <div id="price-slider"></div>
                                    <a class="btn btn-theme btn-sm margin-top-20">Search</a>
                                 </div>
                              </div>
                           </div>
                           <!-- Pricing Panel End -->
                           <!-- Year Panel -->    
                           <div class="panel panel-default">
                              <!-- Heading -->
                              <div class="panel-heading" role="tab" id="heading8">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Select Year
                                    </a>
                                 </h4>
                              </div>
                              <!-- Content -->
                              <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
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
                              <div class="panel-heading" >
                                 <h4 class="panel-title">
                                    <a>
                                    Recent Listings
                                    </a>
                                 </h4>
                              </div>
                              <!-- Content -->
                              <div class="panel-collapse">
                                 <div class="panel-body recent-ads">
                                    <!-- Ads -->
                                    @forelse($inventory_related_ad as $related_ad)
                                    <div class="recent-ads-list">
                                       <div class="recent-ads-container">
                                          <div class="recent-ads-list-image">
                                             <a href="{{ route('auto.details', $related_ad->id) }}" class="recent-ads-list-image-inner">
                                             <img src="{{ $related_ad->image }}" alt="local cars related listing image">
                                             </a><!-- /.recent-ads-list-image-inner -->
                                          </div>
                                          <!-- /.recent-ads-list-image -->
                                          <div class="recent-ads-list-content">
                                             <h3 class="recent-ads-list-title">
                                                <a href="{{ route('auto.details', $related_ad->id) }}">{{ $related_ad->title }}</a>
                                             </h3>
                                             <ul class="recent-ads-list-location">
                                             {{ $related_ad->dealer_address_formate }}
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
      </div>
      <!-- Main Content Area End -->
@endsection

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
<div class="search-modal modal fade cat_modal_web_make" tabindex="-1" role="dialog" aria-hidden="true">
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
                <button type="button" class="btn btn-block btn-block">Search</button>
            </div>
        </div>
    </div>
</div>

<style>
    #loading {
        text-align: center;
        background: url("{{ asset('frontend/images/loader.gif') }}") no-repeat center;
        height: 150px;
    }
</style>
@push('js')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


            
            function filter_data(page){
                $('.filter_data').html('<div id="loading" style=""></div>');
                var action = 'fetch_data';
                var body = get_filter('body');
                var brand = get_filter('brand');
                var year = get_filter('year');
                var transmission = get_filter('transmission');
                var page = $(this).data('page');
                $.ajax({
                    url : "{{ route('auto_filter.ajax') }}",
                    type : 'get',
                    data: {
                        action: action,
                        ajaxbody: body,
                        ajaxbrand: brand,
                        ajaxyear: year,
                        ajaxtransmission: transmission,
                        page:page
                    },
                    success: function(res){
                        $('.add_ajax').html(res)
                        console.log(res)
                    },
                    error:function(error){

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

            filter_data();

            $(document).on("click change",".common_selector", function(event) {
                event.stopPropagation();
               //  console.log('asgasdjasdg')
                filter_data();
            });





            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                function filter_data(page) {
                    $('.filter_data').html('<div id="loading" style=""></div>');
                    var action = 'fetch_data';
                    var brand = get_filter('brand');
                    var body = get_filter('body');
                    var year = get_filter('year');
                    var transmission = get_filter('transmission');

                        $.ajax({
                        url : "{{ route('auto_filter.ajax') }}",
                        type : 'get',
                        data: {
                            action: action,
                            ajaxbody: body,
                            ajaxbrand: brand,
                            ajaxyear: year,
                            ajaxtransmission: transmission,
                            page:page
                        },
                        success: function(res){
                            $('.add_ajax').html(res)
                            console.log(res)
                        },
                        error:function(error){

                        }
                    });
                }
            });
                //update wislist start
                //goto auto ajax blade file
                //update wislist end

                //checkavailaibality start
                //goto auto ajax blade file
                //checkavailaibality end

                $(document).on('change','#tradeChecked', function() {

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

            $('#cancelButton').on('click', function() {
                $("#collapse9_clear_all").collapse("hide");
            });
        });
      </script>
@endpush