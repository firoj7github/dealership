<!DOCTYPE html>
<html lang="en">

<head>
    <title>Localcarz | Login </title>


    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="colorlib" />

    <link rel="icon" href="{{asset('dashboard')}}/assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/bower_components/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/waves.min.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/assets/icon/feather/css/feather.css">

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/assets/icon/themify-icons/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/assets/icon/icofont/css/icofont.css">

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/assets/icon/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/assets/css/pages.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* .btn-next {
            background-color: #E52D27 !important;
        } */

    </style>

</head>

<body themebg-pattern="theme1">

    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="login-block">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @if(session()->has('message'))
                    <div class="alert alert-success" style="color: black">
                        {{ session()->get('message') }}
                    </div>
                @endif

                    <form class="md-float-material form-material" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="text-center">
                            <img src="{{asset('dashboard')}}/assets/images/localcarz.png" alt="logo.png" height="auto" width="100">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Sign In</h3>
                                    </div>
                                </div>
                                <div class="row m-b-20">
                                    {{-- <div class="col-md-6">
                                        <button class="btn btn-facebook m-b-20 btn-block"><i
                                                class="icofont icofont-social-facebook"></i>facebook</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-twitter m-b-20 btn-block"><i
                                                class="icofont icofont-social-twitter"></i>twitter</button>
                                    </div> --}}
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  value="{{ old('email') }}">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  id="userpassword">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Password</label>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                {{-- <div class="form-group form-primary">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}

                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                </div> --}}
                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="form-group ">
                                        <div style="text-align: center" class="captcha">
                                            <span>{!! captcha_img() !!}</span>
                                            <button style="margin-left:7px; border-radius:7px" type="button" class="btn btn-danger reload" id="reload">&#x21bb</button>

                                        </div>

                                    </div>
                                    </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="form-group">

                                            <input  style="border-radius:6px" class="form-control cap @error('captcha') is-invalid @enderror" type="text" name="captcha" placeholder="Enter your captcha">
                                            @error('captcha')
                                        <span class="invalid-feedback text-danger " role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </div>

                                </div>





                                <div class="row">
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i
                                                        class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="forgot-phone text-right float-right">
                                            <a href="#" data-target="#myModal" data-toggle="modal" class="text-right f-w-600"> Forgot
                                                Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                                    </div>
                                </div>
                                <p class="text-inverse text-center">Don't have an account?<a
                                        href="{{ route('dealer.register')}}"> <b>Register here </b></a>for free!</p>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

        </div>

    </section>

  {{-- forgot password email model --}}
  <div class="custom-modal">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header rte">
                    <h2 class="modal-title">Forgot Your Password ?</h2>
                </div>
                <div class="modal-body">
                    <form action="#" class="form">
                        <!-- Steps -->
                        <div class="form-step form-step-active">
                            <p class="forgot-para">Enter your email address and we’ll send you a reset code.</p>

                            <div class="input-group">
                                <label class="label-item" for="email">Email : </label>
                                <input class="input-info form-control" type="text" placeholder="enter your email"
                                    id="email_code_send" />
                                <div class="text-danger" id="email-error"></div>

                            </div>

                            <section class="radio-section"></section>
                            <div class="">
                                <a href="#" class="btn btn-sm btn-success float-right" id="sendCode">Send
                                    Code</a>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
    {{-- forgot password otp modal --}}
    <div class="custom-modal">
        <div id="OtpModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header rte">
                        <h2 class="modal-title">Please Enter Your Otp</h2>

                    </div>
                    <div class="modal-body">
                        <form action="#" class="form">

                            <label class="label-item">Enter Your Code</label>
                            <input class=" form-control" type="text" placeholder="Enter code" id="otp_code" name="otp"/> <br>
                            <span class="text-success" id="email-otp" class="otp_error"></span><br><br>

                            <label class="label-item">Enter Your New Password</label>
                            <input class=" form-control" type="password" placeholder="New password" id="new_password" name="password"/> <br>
                            <span class="text-danger" id="pwd_error"></span><br>
                            <div class="form-step">

                                <label class="label-item">Enter Your Confirm Password</label>
                                <input class=" form-control"  type="password" placeholder="Confirm password" name="confirm_password" id="confirm_password"/><br>
                                <span class="text-danger" id="confirm_pwd_error"></span><br>


                                <div class="btns-group">
                                    <a href="#" class="btn btn-sm btn-success" id="NewPassword">Submit</a>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- forgot password otp modal End --}}
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/bootstrap/js/bootstrap.min.js"></script>

    <script src="{{asset('dashboard')}}/assets/js/waves.min.js"></script>

    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/modernizr/js/css-scrollbars.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/assets/js/common-pages.js"></script>


<script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {

            $('#reload').click(function(){
                $.ajax({
                 url:'reload-capta',
                 type:'GET',
                  success:function(res){
                $(".captcha span").html(res.captcha);
               }
               });

                });

            $('#sendCode').on('click', function() {


                var email = $('#email_code_send').val();
                $.ajax({
                    url: "{{ route('dealer.password.request') }}",
                    method: "post",
                    data: {
                        email: email
                    },
                    success: function(result) {
                        console.log(result);
                        if (result.error) {
                            if (result.error.email) {
                                $('#email-error').text(result.error.email[0]);
                            } else {
                                $('#email-error').text(result.error);
                            }
                        }
                        if (result.success) {
                            $('#myModal').modal('hide');
                            $('#OtpModal').modal('show');
                            $('#email-otp').text(result.success);
                        }

                    }
                });


            });

            $('#NewPassword').on('click', function() {

                var otp = $('#otp_code').val();
                var new_password = $('#new_password').val();
                var confirm_password = $('#confirm_password').val();
                console.log(otp);
                $.ajax({
                    url: "{{ route('dealer.otp.check') }}",
                    method: "post",
                    data: {
                        otp: otp,
                        password:new_password,
                        confirm_password: confirm_password
                    },
                    success: function(result) {
                        console.log(result);
                        if (result.otp)
                        {
                           $('#email-otp').text("");
                           $('#email-otp').text(result.otp).addClass('text-danger');
                        }
                        if (result.password)
                        {
                            $('#pwd_error').text(result.password);
                        }
                        if (result.confirm_password)
                        {
                            $('#confirm_pwd_error').text(result.confirm_password);
                        }
                        if(result.error)
                        {
                            $('#email-otp').text("");
                            $('#email-otp').text(result.error).addClass('text-danger');
                        }
                        if(result.message)
                        {
                            window.location.href = "{{ route('login')}}";
                            $('#forgot_success').text(result.message);
                        }

                    }
                });


            });






        });


    </script>
</body>

</html>
