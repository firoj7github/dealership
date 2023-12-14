@extends('frontend.layouts.app')
@section('title', 'Dealer | ')
@section('content')
<div class="main-content-area clearfix">

    <!-- =-=-=-=-=-=-= About CarSpot =-=-=-=-=-=-= -->
<section class="custom-padding pattern_dots" id="about-section-3">
<div class="container">
 <div class="row">
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
       <div class="about-title">
          <h1 style="font-weight: bold; color:black !important;">SKCO Automotive</h1>
          <div class="rating">
            {{--<span style="color:black !important;">3.8</span>
            <i class="fa fa-star text-primary"></i> <i class="fa fa-star text-primary"></i> <i class="fa fa-star text-primary"></i> <i class="fa fa-star text-primary"></i> <i class="fa fa-star-o"></i> <span style="color:black !important;" class="rating-count">(80 reviews)</span>--}}
         </div>

          <ul class="custom-links">
             <li><a target="_blank" href="https://www.google.com/maps/place/Skco+Automotive/@30.6890148,-88.2203617,21z/data=!4m6!3m5!1s0x889bb264d8d2482b:0xf6be7f6160faedaf!8m2!3d30.6877822!4d-88.2164993!16s%2Fg%2F1vc82lj1?entry=ttu">7410 Airport Blvd Mobile, AL 36608
            </a></li>
             <li><a target="_blank" class="text-danger !important" href="https://www.skcoautomotive.com/">Visit SKCO Automotive
            </a></li>

          </ul>
          <ul class="custom-links">
             <li style="color:black; font-weight:600">
                Sales hours: <span style="margin-left:28px">8:00am to 8:00pm</span>

                </li>
             <li style="color:black; font-weight:600">
                Service hours: <span style="margin-left:15px">8:00am to 5:00pm</span>

                </li>



          </ul>
       </div>
    </div>
    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
       <div class="right-side">

         <button data-toggle="modal" data-target="#contactModal" class="dea-btn" style="">Contact Seller</button>
       </div>
       <!-- /.right-side -->
    </div>
 </div>
 {{--<div class="row about-stats">
    <div style="margin-left: 7px" class="row">
       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="icons">
             <i class="flaticon-vehicle"></i>
          </div>
          <div class="number"><span class="timer" data-from="0" data-to="1238" data-speed="1500" data-refresh-interval="5">0</span>+</div>
          <h2 style="color:black">Total <span>Cars</span></h2>
       </div>
       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="icons">
             <i class="flaticon-security"></i>
          </div>
          <div class="number"><span class="timer" data-from="0" data-to="220" data-speed="1500" data-refresh-interval="5">0</span>+</div>
          <h2 style="color:black">Verified <span>Byers</span></h2>
       </div>
       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="icons">
             <i class="flaticon-like-1"></i>
          </div>
          <div class="number"><span class="timer" data-from="0" data-to="200" data-speed="1500" data-refresh-interval="5">0</span>+</div>
          <h2 style="color:black">Active <span>Users</span></h2>
       </div>
       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="icons">
             <i class="flaticon-cup"></i>
          </div>
          <div class="number"><span class="timer" data-from="0" data-to="34" data-speed="1500" data-refresh-interval="5">0</span>+</div>
          <h2 style="color:black">Featured <span>Ads</span></h2>
       </div>
    </div>
 </div>--}}
 <!-- end main-boxes -->
</div>
<!-- end container -->
</section>
<!-- =-=-=-=-=-=-= About CarSpot End =-=-=-=-=-=-= -->

<section class="custom-padding">
    <!-- Main Container -->
    <div class="container">
       <!-- Row -->
       <div class="row">
          <div class="clearfix"></div>
          <!-- Heading Area -->
          <div class="heading-panel">
             <div class="col-xs-12 col-md-12 col-sm-12">
                <!-- Main Title -->
                <h3 style="font-size: 35px;font-weight:600; color:black">Inventory</h3>
                <div
            style="width:80px; height:4px; background-color:rgb(148, 3, 3);">
              </div>

             </div>
          </div>
          <!-- Middle Content Box -->
          <div class="row">
             <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="posts-masonry">
                    @foreach ($inventories as $inventory)


                   <div class="col-md-4 col-xs-12 col-sm-6">
                      <!-- Ad Box -->
                      <div class="category-grid-box">
                         <!-- Ad Img -->
                         <div class="category-grid-img">
                            <img class="" alt="" src="{{ $inventory->image }}">
                            <!-- Ad Status -->
                            <!-- User Review -->



                            <!-- Additional Info End-->
                         </div>
                         <!-- Ad Img End -->
                         <div class="short-description">

                          @php
                              $title = substr($inventory->title, 0, 30)
                          @endphp
                            <!-- Ad Title -->
                            <h3><a title="" href="single-page-listing.html">{{$title}} </a></h3>
                            <!-- Price -->
                            <div class="price">{{$inventory->price_formate}}</div>
                         </div>
                         <!-- Addition Info -->
                         <div class="ad-info">
                            <ul>
                               <li><i class="flaticon-fuel-1"></i>{{$inventory->fuel}}</li>
                               <li><i class="flaticon-dashboard"></i>{{$inventory->miles_formate}}</li>

                            </ul>
                         </div>
                      </div>
                      <!-- Ad Box End -->
                   </div>


                   @endforeach




                </div>
                <button style="float:right!important; margin-right:12px; border-radius:4px"  class="btn btn-md  btn-theme"> View All <i class="fa fa-refresh"></i> </button>

             </div>
          </div>
          <!-- Middle Content Box End -->
          <img alt="" class="block-content wow zoomIn "  data-wow-delay="0ms" data-wow-duration="3500ms" src="images/cars.png">
       </div>
       <!-- Row End -->
    </div>
    <!-- Main Container End -->
 </section>


<div class="clearfix"></div>

{{--<section class="section-padding parallex bg-img-3">
    <div class="container">
       <div class="row">
          <div class="owl-testimonial-2">
             <div class="single_testimonial">
                <div class="textimonial-content">
                   <h4>Just fabulous</h4>
                   <p>After all you’ve done, you deserve the best. So we’re giving you big savings on top of all current offers.</p>
                </div>
                <div class="testimonial-meta-box">

                   <div class="testimonial-meta">
                      <h3 class="">Jhon Emily Copper </h3>
                      <p> Doctor</p>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                   </div>
                </div>
             </div>
             <div class="single_testimonial">
                <div class="textimonial-content">
                   <h4>Awesome ! Loving It</h4>
                   <p>Eligibility requirements and other restrictions apply. To get started, click for details and try to discription below.</p>
                </div>
                <div class="testimonial-meta-box">

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
             <div class="single_testimonial">
                <div class="textimonial-content">
                   <h4>Very quick and Fast</h4>
                   <p>Graduating from college pays off—right away. The Nissan College Grad Program turns your diploma into big savings.</p>
                </div>
                <div class="testimonial-meta-box">

                   <div class="testimonial-meta">
                      <h3 class="">Jaccica Albana </h3>
                      <p>  Engineer</p>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                   </div>
                </div>
             </div>
             <div class="single_testimonial">
                <div class="textimonial-content">
                   <h4>Awesome, Service</h4>
                   <p>Keep your Nissan rolling with our best service deals. Discover our latest service offers, available only at your local Nissan store.</p>
                </div>
                <div class="testimonial-meta-box">

                   <div class="testimonial-meta">
                      <h3 class="">Humayun Sarfraz </h3>
                      <p>  CTO Glixen Technologies.</p>
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
 </section>--}}
 <section class="custom-padding " id="about-section-3">
    <div class="container">
       <div style="margin-top:35px; margin-bottom:55px" class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
             <div class="about-title">
                <h2> About <span class="heading-color"> Our </span> Dealership</h2>
                <p style="width:360px;text-align: justify;">Welcome to Skco Automotive Located in Mobile AL
                    Your Used Car Superstore of Mobile Daphne Spanishfort Eastern Shore Gulfport Biloxi Pensacola Dealer.
                    Skco Automotive a Pre-owned dealer in Mobile AL that specializes in late model Ford Chrysler GM Toyota Honda Nissan Mazda Acura Lexus Bmw Mercedes and many other makes and models of Used Cars has been serving drivers in Mobile AL and Gulfport MS and Pensacola FL for many years. Mobile AL drivers come to us for quality affordable vehicles along with some of the best financing plans in AL.
                    The Largest Pre-owned Dealership in Mobile AL </p>
                    {{--<h4 style="margin-top: 20px; color:black; font-weight:700">  GET SOCIAL WITH SKCO AUTOMOTIVE</h4>
                    <div
                    style="width:135px; height:4px; background-color:rgb(148, 3, 3); margin-bottom:20px">
                    </div>
                    <div class="testimonial-meta">
                        <a href="https://www.facebook.com/skcoautomotive" target="_blank"><i style="margin-right: 20px; background-color:rgb(90, 46, 90);width:30px; height:30px; border-radius:5px; text-align:center; padding-top:7px; color:white" class="fa fa-facebook p-3"></i></a>
                        <a href="https://twitter.com/i/flow/login?redirect_after_login=%2Fskcoautomotive" target="_blank"><i style="margin-right: 20px; background-color:rgb(90, 46, 90);width:30px; height:30px; border-radius:5px; text-align:center; padding-top:7px; color:white" class="fa fa-twitter"></i></a>
                        <a href="https://www.pinterest.com/skcoauto/" target="_blank"><i style="margin-right: 20px; background-color:rgb(90, 46, 90);width:30px; height:30px; border-radius:5px; text-align:center; padding-top:7px; color:white" class="fa fa-pinterest"></i></a>
                        <a href="https://www.instagram.com/skcoauto/" target="_blank"><i style="margin-right: 20px; background-color:rgb(90, 46, 90);width:30px; height:30px; border-radius:5px; text-align:center; padding-top:7px; color:white" class="fa fa-instagram m-3"></i></a>
                     </div>--}}


             </div>
          </div>
          <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
             <div class="right-side">
              <h2 style="color:black; font-weight:bold ">Service Hour</h2>
              <div
            style="width:87px; height:4px; background-color:rgb(148, 3, 3);">
              </div>

              <p class="p-0 m-0" style="width:100%; color:black; margin-top:25px"><span style="float:left !important;">Monday</span style="text-center !important"><span style="margin-left:150px">8:00am–5:00pm</span></p>
              <div style="width:315px; margin-bottom:10px; height:1px; background-color:rgb(185, 183, 183); "></div>
              <p class="p-0 m-0" style="width:100%; color:black"><span style="float:left !important;">Tuesday</span style="text-center !important"><span style="margin-left:150px">8:00am–5:00pm</span></p>
              <div style="width:315px;margin-bottom:10px; height:1px; background-color:rgb(185, 183, 183); "></div>
              <p style="width:100%; color:black"><span style="float:left !important;">Wednesday</span style="text-center !important"><span style="margin-left:130px">8:00am–5:00pm</span></p>
              <div style="width:315px;margin-bottom:10px; height:1px; background-color:rgb(185, 183, 183); "></div>
              <p style="width:100%;margin-bottom:10px; color:black"><span style="float:left !important;">Thursday</span style="text-center !important"><span style="margin-left:145px">8:00am–5:00pm</span></p>
              <div style="width:315px;margin-bottom:10px; height:1px; background-color:rgb(185, 183, 183); "></div>
              <p style="width:100%; color:black"><span style="float:left !important;">Friday</span style="text-center !important"><span style="margin-left:165px">8:00am–5:00pm</span></p>
              <div style="width:315px;margin-bottom:10px; height:1px; background-color:rgb(185, 183, 183); "></div>
              <p style="width:100%; color:black"><span style="float:left !important;">Saturday</span style="text-center !important"><span style="margin-left:150px">8:00am–5:00pm</span></p>
              <div style="width:315px;margin-bottom:10px; height:1px; background-color:rgb(185, 183, 183); "></div>
              <p style="width:100%; color:black"><span style="float:left !important;">Sunday</span style="text-center !important"><span style="margin-left:157px; background:rgb(180, 27, 27); padding:4px;border-radius:5px; color:white">Closed</span></p>


             </div>
             <!-- /.right-side -->
          </div>
       </div>

    </div>
    <!-- end container -->
 </section>
 <section class="custom-padding pattern_dots" id="about-section-3">
<!-- =-=-=-=-=-=-= Services =-=-=-=-=-=-= -->

<!-- =-=-=-=-=-=-= Services End =-=-=-=-=-=-= -->
<!-- =-=-=-=-=-=-= Pricing =-=-=-=-=-=-= -->



</div>
<section class="custom-padding pattern_dots" id="about-section-3">

    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <!--  Form -->


                    <h3 style="background-color: #2F4F4F;padding:4px;color:white; padding-left:18px">CONTACT SELLER</h3>
                    <form id="dealerContact" action="{{ route('dealer.contact')}}" method="POST" style="background-color: #d6d6d6">
                        @csrf
                        <div class="container-fluid">


                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 " style="margin-top:20px">
                                    <div class="form-group ">

                                        <input style="border-radius: 5px" placeholder="First Name"
                                            class="form-control" type="text"
                                            name="fname">
                                            <span class="text-danger" id="fname_error"></span>



                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 " style="margin-top:20px">
                                    <div class="form-group ">

                                        <input style="border-radius: 5px" placeholder="Last Name"
                                            class="form-control" type="text"
                                            name="lname">
                                            <span class="text-danger" id="lname_error"></span>


                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="form-group ">

                                        <input style="border-radius: 5px" placeholder="E-mail"
                                            class="form-control" type="text"
                                            name="email">
                                            <span class="text-danger" id="email_error"></span>

                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="form-group ">

                                        <input style="border-radius: 5px"
                                            class="form-control telephoneInput " type="text"
                                            name="phone"
                                            placeholder="cell">
                                            <span class="text-danger" id="phone_error"></span>


                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="form-group ">
                                        <textarea style="border-radius: 5px" id="w3review"
                                            class="form-control"
                                            name="description" rows="4" cols="55" placeholder="Comment"></textarea>
                                            <span class="text-danger" id="description_error"></span>



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

                                            <input placeholder="Year"
                                                class="form-control " type="text"
                                                name="year">

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="form-group ">

                                            <input placeholder="Make"
                                                class="form-control" type="text"
                                                name="make">


                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="form-group ">

                                            <input placeholder="Model"
                                                class="form-control" type="text"
                                                name="model">



                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="form-group ">

                                            <input placeholder="Mileage"
                                                class="form-control" type="text"
                                                name="mileage">



                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="form-group ">

                                            <input placeholder="Color"
                                                class="form-control" type="text"
                                                name="color">



                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="form-group ">
                                            <input placeholder="VIN (optional)" class="form-control " type="text" name="vin"
                                               >

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="form-group">
                                        <button style="border-radius: 5px" type="submit" class="btn btn-theme btn-lg btn-block">Send</button>
                                    </div>






                                </div>

                            </div>
                        </div>

                    </form>
                    <!-- Form -->

                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Initialize Inputmask
    $('.telephoneInput').inputmask('(999) 999-9999');
  });
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


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

// dealer contact message add in database
$('#dealerContact').submit(function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        datatype: JSON,
        contentType: false,

        success: function(res) {

            console.log(res);

        if (res.error) {
        if (res.error.fname) {
            $('#fname_error').text(res.error.fname);
        } else {
            $('#fname_error').text('');
        }

        if (res.error.lname) {
            $('#lname_error').text(res.error.lname);
        } else {
            $('#lname_error').text('');
        }

        if (res.error.email) {
            $('#email_error').text(res.error.email);
        } else {
            $('#email_error').text('');
        }
        if (res.error.phone) {
            $('#phone_error').text(res.error.phone);
        } else {
            $('#phone_error').text('');
        }
        if (res.error.description) {
            $('#description_error').text(res.error.description);
        } else {
            $('#description_error').text('');
        }


    }

            if (res.status == 'success') {



                $('#contactModal').modal('hide');
                toastr.success(' Dealer contact message sent Successfully');

            }
        },
        error: function(error) {
            // console.log(error);
        },

    });
});

});



</script>
@endpush
