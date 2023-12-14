@extends('frontend.layouts.app')
@section('title', 'about | ')
@section('content')
<div class="page-header-area-2 gray">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="small-breadcrumb">
                <div class="breadcrumb-link">
                   <ul>
                      <li><a href="index.html">Home Page</a></li>
                      <li><a class="active" href="#">About</a></li>
                   </ul>
                </div>
                <div class="header-page">
                   <h1>About Us</h1>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- =-=-=-=-=-=-= Breadcrumb End =-=-=-=-=-=-= -->
 <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
 <div class="main-content-area clearfix">

             <!-- =-=-=-=-=-=-= About CarSpot =-=-=-=-=-=-= -->
    <section class="custom-padding pattern_dots" id="about-section-3">
       <div class="container">
          <div class="row">
             <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="about-title">
                   <h2> Who We Are</h2>
                   <p>LocalCarz.com is an independent company that works side by side with consumers, sellers, and dealers for transparency and fairness in the marketplace.Local Carz Vehicle products are based only on information supplied to Local Carz. Local Carz does not have the complete history of every vehicle. Use the Local Carz search as one important tool, along with a vehicle inspection and test drive, to make a better decision about your next used car. </p>
                   {{-- <ul class="custom-links">
                      <li><a href="#">Extend the life of your car</a></li>
                      <li><a href="#">Keep your engine cool</a></li>
                      <li><a href="#">Extend the life of your car</a></li>
                      <li><a href="#">Keep your engine cool</a></li>
                   </ul> --}}
                </div>
             </div>
             <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="right-side">
                    <div class="about-title">
                        <h2>What We Do </h2>
                   <p>We’re redefining car buying to reflect the experience people desire: flexible, convenient and shaped to their life. We do this by enabling consumers and dealers to connect through a world-class technology platform that offers more access, more choice, and more control than ever before from discovery to delivery.
                   </p>
                     </div>


                   <img src="images/mechanic.png" alt="">
                </div>
                <!-- /.right-side -->
             </div>
          </div>
          {{--<div class="row about-stats">
             <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                   <div class="icons">
                      <i class="flaticon-vehicle"></i>
                   </div>
                   <div class="number"><span>{{isset($total_inventory)? $total_inventory : ''}}</span>+</div>
                   <h4>Total <span>Cars</span></h4>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                   <div class="icons">
                      <i class="flaticon-security"></i>
                   </div>
                   <div class="number"><span >{{isset($total_dealers)? $total_dealers : ''}}</span>+</div>
                   <h4>Verified <span>Dealers</span></h4>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                   <div class="icons">
                      <i class="flaticon-like-1"></i>
                   </div>
                   <div class="number"><span>{{isset($total_active_user)? $total_active_user : ''}}</span>+</div>
                   <h4>Active <span>Users</span></h4>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                   <div class="icons">
                      <i class="flaticon-cup"></i>
                   </div>
                   <div class="number"><span>{{isset($feature_add)? $feature_add : ''}}</span>+</div>
                   <h4>Featured <span>Ads</span></h4>
                </div>
             </div>
          </div>--}}
          <!-- end main-boxes -->
       </div>
       <!-- end container -->
    </section>
 <!-- =-=-=-=-=-=-= About CarSpot End =-=-=-=-=-=-= -->

    <section class="about-us">
       <div class="container-fluid">
          <div class="row">
             <div class="col-md-12 no-padding">
                <!-- service box 3 -->
                <div class="col-sm-4 col-md-4 col-xs-12 no-padding">
                   <div class="why-us border-box text-center">
                      <h5>Why choose us</h5>
                      <p> we use our years of experience to provide the highest quality service to ensure you travel smoothly and safely. We reward you with lower rates the longer you rent a car from us and you have a wide range of vehicles to choose from. Our dedicated, friendly staff are on hand to assist you while you vacation on the island.</p>
                   </div>
                </div>
                <!-- service box end -->
                <!-- service box 3 -->
                <div class="col-sm-4 col-md-4 col-xs-12 no-padding">
                   <div class="why-us border-box text-center">
                      <h5>Our mission</h5>
                      <p> Our goal is to be an industry leader in providing unmatched quality automotive products and services.
                        We will constantly strive to meet the changing needs of our customers. </p>

                   </div>
                   <!-- end featured-item -->
                </div>
                <!-- service box end -->
                <!-- service box 3 -->
                <div class="col-sm-4 col-md-4 col-xs-12 no-padding">
                   <div class="why-us border-box text-center">
                      <h5>Our Vision</h5>
                      <p>To be the world’s most exciting leader in automotive business intelligence solutions.</p>
                   </div>
                   <!-- end featured-item -->
                </div>
                <!-- service box end -->
             </div>
          </div>
       </div>
       <!-- end container -->
    </section>
    <div class="clearfix"></div>

<!-- =-=-=-=-=-=-= Clients =-=-=-=-=-=-= -->
{{-- <section class="client-section gray">
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
                         <a href="#"><img src="images/brands/16.png" class="img-responsive" alt="Brand Image" /></a>
                      </div>
                      <div class="client-logo">
                         <a href="#"><img src="images/brands/2.png" class="img-responsive" alt="Brand Image" /></a>
                      </div>
                      <div class="client-logo">
                         <a href="#"><img src="images/brands/11.png" class="img-responsive" alt="Brand Image" /></a>
                      </div>
                      <div class="client-logo">
                         <a href="#"><img src="images/brands/4.png" class="img-responsive" alt="Brand Image" /></a>
                      </div>
                      <div class="client-logo">
                         <a href="#"><img src="images/brands/5.png" class="img-responsive" alt="Brand Image" /></a>
                      </div>
                      <div class="client-logo">
                         <a href="#"><img src="images/brands/6.png" class="img-responsive" alt="Brand Image" /></a>
                      </div>
                      <div class="client-logo">
                         <a href="#"><img src="images/brands/7.png" class="img-responsive" alt="Brand Image" /></a>
                      </div>
                      <div class="client-logo">
                         <a href="#"><img src="images/brands/8.png" class="img-responsive" alt="Brand Image" /></a>
                      </div>
                      <div class="client-logo">
                         <a href="#"><img src="images/brands/9.png" class="img-responsive" alt="Brand Image" /></a>
                      </div>
                      <div class="client-logo">
                         <a href="#"><img src="images/brands/17.png" class="img-responsive" alt="Brand Image" /></a>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section> --}}
    <!-- =-=-=-=-=-=-= Clients End =-=-=-=-=-=-= -->


 </div>
@endsection

@push('js')

@endpush
