<!DOCTYPE html>
<html lang="en">

<head>
    <title>Localcarz | Register</title>
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

                    <form class="md-float-material form-material" action="{{route('dealer.submit')}}" method="POST">
                        @csrf
                        <div class="text-center">
                            <img src="{{asset('dashboard')}}/assets/images/localcarz.png" alt="logo.png" width="100">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Create Dealer Account</h3>
                                    </div>
                                </div>
                                {{-- <div class="row m-b-20">
                                    <div class="col-md-6">
                                        <a href="#!"
                                            class="btn btn-facebook m-b-20 btn-block waves-effect waves-light"><i
                                                class="icofont icofont-social-facebook"></i>facebook</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#!"
                                            class="btn btn-twitter m-b-0 btn-block waves-effect waves-light"><i
                                                class="icofont icofont-social-twitter"></i>twitter</a>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-primary">

                                            <input type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" name="fname" value="{{ old('fname')}}">
                                            <span class="form-bar"></span>
                                            <label class="float-label" for="fname">First Name</label>
                                            @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-primary">

                                            <input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" value="{{ old('lname')}}">
                                            <span class="form-bar"></span>
                                            <label class="float-label" for="lname">Last Name</label>
                                            @error('lname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                 <div class="form-group form-primary">

                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" id="useremail" name="email" value="{{ old('email')}}">
                                    <span class="form-bar"></span>
                                    <label class="float-label" for="useremail">Email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="text" class="form-control telephoneInput  @error('phone') is-invalid @enderror" name="phone"  value="{{ old('phone')}}">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Cell</label>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" id="userpassword">
                                            <span class="form-bar"></span>
                                            <label class="float-label"> Password</label>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="password" class="form-control  @error('confirm_password') is-invalid @enderror" name="confirm_password" id="userconfirm_password">
                                            <span class="form-bar"></span>
                                            <label class="float-label"> Confirm Password</label>
                                            @error('confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row m-t-25 text-left">
                                    <div class="col-md-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i
                                                        class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">I read and accept <a href="#">Terms
                                                        &amp; Conditions.</a></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i
                                                        class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Send me the <a
                                                        href="#">Newsletter</a> weekly.</span>
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign
                                            up now</button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Already have an account ? </p>
                                        <p class="text-inverse text-left"><a href="{{ route('login')}}"><b>Sign In</b></a></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{asset('dashboard')}}/assets/images/auth/Logo-small-bottom.png"
                                            alt="small-logo.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </section>


    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/bootstrap/js/bootstrap.min.js"></script>

    <script src="{{asset('dashboard')}}/assets/js/waves.min.js"></script>

    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/modernizr/js/css-scrollbars.js"></script>

    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript"
        src="{{asset('dashboard')}}/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/assets/js/common-pages.js"></script>


<script src="{{ asset('dashboard') }}/assets/form-masking/inputmask.js"></script>
<script src="{{ asset('dashboard') }}/assets/form-masking/jquery.inputmask.js"></script>
<script src="{{ asset('dashboard') }}/assets/form-masking/autoNumeric.js"></script>
<script src="{{ asset('dashboard') }}/assets/form-masking/form-mask.js"></script>



    <script>
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
    // Initialize Inputmask
    $('.telephoneInput').inputmask('(999) 999-9999');
  });

    </script>
</body>

</html>
