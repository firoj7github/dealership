@extends('frontend.layouts.app')
@section('title', 'FAQs | ')
@section('content')

<div class="page-header-area-2 gray">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="small-breadcrumb">
                <div class="breadcrumb-link">
                   <ul>
                      <li><a href="{{ route('home')}}">Home Page</a></li>
                      <li><a class="active" href="#">FAQS</a></li>
                   </ul>
                </div>
                <div class="header-page">
                   <h1>Support Center</h1>
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
    <section class="section-padding gray no-top">
       <!-- Main Container -->
       <div class="container">
          <!-- Row -->
          <div class="row">
             <!-- Middle Content Area -->
             <div class="col-md-8 col-xs-12 col-sm-12">
                <ul class="accordion">
                   <li class="in">
                      <h3 class="accordion-title"><a href="#">What is Localcarz?</a></h3>
                      <div class="accordion-content">
                         <p>Localcarz is an information and technology platform that enables its users to communicate with Localcarz Certified Dealers for a great car buying experience. Our mission is simple: make the car buying process simple, fair and fun. Achieving this goal begins with us analyzing the most accurate, timely and comprehensive pricing information available and then making it easy to understand and available to all; free of charge. This kind of pricing information, which has only recently become available, will allow you to recognize a fair price based on what others actually paid. The result: consumers and dealers now have a guide that helps them establish a baseline of trust and agree on the parameters of a fair deal.

                        </p>
                      </div>
                   </li>
                   <li class="">
                      <h3 class="accordion-title"><a href="#">How do I use the Price Report?</a></h3>
                      <div class="accordion-content">
                         <p>On the Localcarz Price Report, we show you what you can expect to pay on average for new cars in your area, based on what other people actually paid for their cars. We do all this so you’ll be confident in your car purchase. Harness the power of this information, recognize a fair deal and essentially become a car buying expert.</p>
                      </div>
                   </li>
                   <li class="">
                      <h3 class="accordion-title"><a href="#">What should I do if the dealer does not have my exact vehicle?</a></h3>
                      <div class="accordion-content">
                         <p>Dealers generally will do their best to match the vehicle you have configured on Localcarz, but many times they will not have an exact match for the car you are looking to purchase. This is not the dealer's fault, but rather a challenge with the way cars and trucks are manufactured and marketed. While some vehicles are produced in large numbers, other vehicles are produced in smaller numbers. To further complicate things, many options or colors will be produced in even more limited combinations. This creates a great deal of confusion for buyers that want a very specific configuration. Ultimately this can affect your expectations when contacting a dealer, so it may be helpful to keep an open mind about what the dealer may be offering as an alternative.</p>
                      </div>
                   </li>
                   <li class="">
                      <h3 class="accordion-title"><a href="#">Where can I find more car buying tips and advice? Is there a fee for using this service?</a></h3>
                      <div class="accordion-content">
                         <p>You can visit the localcarz company blog. <a href="#"> Click here</a> to read it for yourself.</p>
                      </div>
                   </li>
                   <li>
                      <h3 class="accordion-title"><a href="#">Is there a fee for using this service?</a></h3>
                      <div class="accordion-content">
                         <p>We do not charge you any fees for using the services. We ordinarily receive fees from our Certified Dealers in connection with the services. In some instances, we also receive fees from automobile manufacturers and/or third-party service providers.</p>
                      </div>
                   </li>

                </ul>
             </div>
             <div class="col-md-4 col-xs-12 col-sm-12">
                <!-- Sidebar Widgets -->
                <div class="blog-sidebar">
                   <!-- Categories -->
                   <div class="widget">
                      <div class="widget-heading">
                         <h4 class="panel-title"><a>Saftey Tips </a></h4>
                      </div>
                      <div class="widget-content">
                         <p class="lead">Posting an ad on <a href="{{ route('home')}}">Localcarz</a> is free! However, all ads must follow our rules:</p>
                         <ol>
                            <li>Make sure you post in the correct category.</li>
                            <li>Do not upload pictures with watermarks.</li>
                            <li>Do not post ads containing multiple items unless it's a package deal.</li>
                            <li>Do not put your email or phone numbers in the title or description.</li>
                            <li>Make sure you post in the correct category.</li>
                            <li>Do not post the same ad more than once or repost an ad within 48 hours.</li>
                         </ol>
                      </div>
                   </div>
                   <!-- Latest News -->
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

 </div>
@endsection

@push('js')

@endpush
