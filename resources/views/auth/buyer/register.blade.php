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
                      <li><a href="{{  route('home') }}">Home Page</a></li>
                      <li><a class="active" href="#">Registration</a></li>
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
    <!-- =-=-=-=-=-=-= Registration Form =-=-=-=-=-=-= -->

    <section class="section-padding no-top gray ">
       <!-- Main Container -->
       <div class="container">
          <!-- Row -->
          <div class="row register-card">
             <!-- Middle Content Area -->
             <div style="padding: 7px; border-radius:7px; border: 1px solid rgb(201, 200, 200); box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 bg-success">
                <!--  Form -->
                {{-- <div class="form-grid"> --}}
                   <form action="{{ route('register.store')}}" method="POST">
                    @csrf
                    <div class="col-md-12 no-padding">
                    <div class="col-md-6 ">
                     <div class="form-group">
                            <label>First Name</label>
                            <input style="border-radius:6px" placeholder="Enter Your First Name" class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ old('first_name')}}">
                            @error('first_name')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                     </div>
                    </div>
                    <div class="col-md-6 ">
                     <div class="form-group">
                            <label>Last Name</label>
                            <input style="border-radius:6px" placeholder="Enter Your Last Name" class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name')}}">
                            @error('last_name')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                     </div>
                    </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input style="border-radius:6px" placeholder="Enter Your Email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email')}}">
                            @error('email')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                         </div>
                    </div>

                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirm Email</label>
                            <input placeholder="Confirm Your Email" class="form-control @error('confirm_email') is-invalid @enderror" type="email" name="confirm_email" value="{{ old('confirm_email')}}">
                            @error('confirm_email')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                         </div>
                    </div> --}}

                    <div col-md-12 no-padding>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input style="border-radius:6px" placeholder=" Password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" value="{{ old('password')}}">
                            @error('password')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                         </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input style="border-radius:6px" placeholder="Confirm Password" class="form-control @error('confirm_password') is-invalid @enderror" type="password" name="confirm_password" value="{{ old('confirm_password')}}">
                            @error('confirm_password')
                             <span class="invalid-feedback text-danger" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                             @enderror
                         </div>
                    </div>
                      <div class="col-md-12">
                      <button style="background: rgb(230, 81, 81);
                       color:white;margin-bottom:15px; border-radius:12px; margin-top:20px;" type="submit" class="btn  btn-next btn-lg btn-block">Register</button>
                      </div>


                   </form>
                {{-- </div> --}}
                <!-- Form -->
             </div>
             <!-- Middle Content Area  End -->
          </div>
          <!-- Row End -->
       </div>
       <!-- Main Container End -->
    </section>
     <!-- =-=-=-=-=-=-= Registration Form End =-=-=-=-=-=-= -->


 </div>

 <!-- Main Content Area End -->
@endsection

