@extends('frontend.layouts.app')
@section('title', 'Home | ')
@section('content')
      <!-- =-=-=-=-=-=-= Breadcrumb =-=-=-=-=-=-= -->
      <div class="page-header-area-2 gray">
        <div class="container">
           <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="small-breadcrumb">
                    <div class=" breadcrumb-link">
                       <ul>
                          <li><a href="index.html">Home Page</a></li>
                          <li><a class="active" href="#">Contact</a></li>
                       </ul>
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
        <section class="section-padding gray no-top ">
           <!-- Main Container -->
           <div class="container">
              <!-- Row -->
              <div style=" margin:0 auto !important;" class="row">
                 <div style="padding: 25px; border-radius:7px; border: 1px solid rgb(201, 200, 200); box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" class="col-md-12 col-sm-12 col-xs-12 bg-success no-padding commentForm">
                    <div class="header-page">
                        <h2 style="text-align: center; margin-bottom:40px">Fell Free To Contact Us</h2>
                     </div>
                    <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                       <form method="post"  action="{{ route('contact.send.message')}}">
                        @csrf
                          <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <div  class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="form-group">
                                       <input style="border-radius:7px" type="text" placeholder="Enter Your Name" value="{{ isset($user->username) ? $user->username : ''}}" id="name" name="name" class="form-control"  @error('name') is-invalid @enderror>
                                       @error('name')
                                       <span class="invalid-feedback text-denger" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                        <input style="border-radius:7px" type="email" placeholder="Enter Your Email" id="email"  value="{{ isset($user->email) ? $user->email : ''}}" name="email" class="form-control"  @error('email') is-invalid @enderror>
                                        @error('email')
                                        <span class="invalid-feedback text-denger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                     <div class="form-group">
                                        <textarea style="border-radius:7px" cols="12" rows="7" placeholder="Type Your Message..." id="message" name="message" class="form-control"  @error('message') is-invalid @enderror></textarea>
                                        @error('message')
                                        <span class="invalid-feedback text-denger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>










                                 </div>






                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <div  class="col-lg-12 col-md-12 col-xs-12">

                                    <div class="form-group">
                                        <input style="border-radius:7px" type="text" placeholder="Enter Your Subject" id="subject" name="subject" class="form-control"  @error('subject') is-invalid @enderror>
                                        @error('subject')
                                        <span class="invalid-feedback text-denger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>








                                 </div>



                                 <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="form-group ">
                                        <div style="text-align:center" class="captcha">
                                            <span>{!! captcha_img() !!}</span>
                                            <button style="margin-left:7px; border-radius:7px" type="button" class="btn btn-danger reload" id="reload">&#x21bb</button>

                                        </div>

                                    </div>
                                    <div class="form-group">

                                        <input style="border-radius:6px" class="form-control  @error('captcha') is-invalid @enderror" type="text" name="captcha" placeholder="Enter your captcha">
                                        @error('captcha')
                                    <span class="invalid-feedback text-danger " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                        </div>
                                    </div>


                                 <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button style="margin-bottom: 10px; color:white; font-weight:bold;margin-top:10px; background: rgb(230, 81, 81);
                                    border-radius:12px" class="btn  btn-next btn-lg btn-block" type="submit">Send Message</button>
                                    @if (session()->has('message'))
                                    <span class="invalid-feedback text-success" role="alert">
                                        <strong>{{ session()->get('message') }}</strong>
                                    </span>
                                    @endif
                                 </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                             </div>


                          </div>
                       </form>
                    </div>
                    {{-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                       <div class="contactInfo">
                          <div class="singleContadds">
                             <i class="fa fa-map-marker"></i>
                             <p> Model Town Link Road Lahore, 60 Street. Pakistan 54770 </p>
                          </div>
                          <div class="singleContadds phone">
                             <i class="fa fa-phone"></i>
                             <p> 0123 456 78 90 - <span>Office</span> </p>
                             <p> 0123 456 78 90 - <span>Mobile</span> </p>
                          </div>
                          <div class="singleContadds"> <i class="fa fa-envelope"></i> <a href="mailto:contact@scriptsbundle.com">contact@scriptsbundle.com</a> <a href="mailto:contact@scriptsbundle.com">contact@scriptsbundle.com</a> </div>
                       </div>
                    </div> --}}
                 </div>
              </div>
              <!-- Row End -->
           </div>
           <!-- Main Container End -->
        </section>

     </div>
     <!-- Main Content Area End -->


@endsection
