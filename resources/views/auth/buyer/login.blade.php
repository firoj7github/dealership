@extends('frontend.layouts.app')
@push('css')
    <style>
        body {

            display: grid;

        }

        .forgot-para {
            text-align: center;

        }

        .btn-next {
            background-color: #E52D27 !important;
        }

        .pre-next {
            background-color: #E52D27 !important;
        }

        .sub-btn {
            background-color: #E52D27 !important;
        }

        .modal-title {
            text-align: center;
            padding-top: 25px;
        }

        .label-item {
            display: block;
            margin-bottom: 0.5rem;
            color: black;
        }

        .part {
            display: flex;
            justify-content: space-between;
            color: white;
        }

        .part-1 {
            margin-left: -5px;

        }

        .input-info {
            display: block;
            width: 220%;
            padding: 0.75rem;
            border: 1px solid #ccc;

            border-radius: 0.25rem;
            border-radius: 5px;

        }

        .select-style {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            background-color:
                #5968B1;
            border-radius: 0.25rem;
        }

        .width-50 {
            width: 50%;
        }

        .ml-auto {
            margin-left: auto;
        }

        .text-center {
            text-align: center;
            color: white;
        }

        /* Progressbar */
        .progressbar {
            position: relative;
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin: 7px 0 64px;
            margin-left: 33px;
        }

        .progressbar::before,
        .progress {
            content: "";
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 4px;
            width: 100%;
            background-color: #dcdcdc;
            z-index: 1;
        }

        .progress {
            background-color: #8D17EA;
            width: 0%;
            transition: 0.3s;
        }

        .progress-step {
            width: 35px;
            height: 35px;
            background-color: #dcdcdc;
            color: white;
            border-radius: 20%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;

        }

        .progress-step p {
            margin-top: -15px;
            width: 300px;
        }



        .progress-step::after {
            content: attr(data-title);
            position: absolute;
            top: calc(100% + 0.5rem);
            font-size: 0.85rem;
            color: #666;
        }

        .progress-step-active {
            background-color:
                #8D17EA;
            color: #f3f3f3;
        }

        /* Form */
        .form {
            width: 80%;
            margin: 0 auto;

            border-radius: 10px;

            margin-bottom: 20px;
        }

        .form-step {

            transform-origin: top;
            animation: animate 0.5s;
        }

        .form-step-active {
            display: block;
        }

        .upload-step {
            display: none;

        }

        .upload-step-active {
            display: block;
        }

        .input-group {
            margin: 2rem 0;
        }

        .upload-title {
            text-align: center;
            color: white;
        }

        .upload-title-1 {
            text-align: center;
            color: white;
            font-size: 20px;
        }

        .upload-title-3 {
            text-align: center;
            color: white;
            font-size: 20px;
        }

        .file-all {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            padding: 15px;
        }

        .file-1 {
            width: 100px;
            height: 70px;
            border: dashed;
        }

        .file-2 {
            width: 100px;
            height: 70px;
            border: dashed;
        }

        .file-3 {
            width: 100px;
            height: 70px;
            border: dashed;
        }

        .fa-solid {
            color: rgb(182, 177, 177);
            margin-top: 22px;
            margin-left: 35px;
        }

        /* radio button */
        a {
            text-decoration: none;
        }

        ul {
            list-style-type: none;
        }

        .radio-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 500px;
        }

        .radio-item [type="radio"] {
            display: none;
        }

        .radio-item+.radio-item {
            margin-top: 2px;
        }

        .radio-item label {
            display: block;
            padding: 20px 60px;
            background: #1d1d42;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 400;
            min-width: 250px;
            white-space: nowrap;
            position: relative;
        }

        .radio-item label:after,
        .radio-item label:before {
            content: "";
            position: absolute;
            border-radius: 50%;
        }

        .radio-item label:after {
            height: 20px;
            width: 20px;
            border: 2px solid #524eee;
            left: 20px;
            top: calc(50% - 12px);
        }

        .radio-item label:before {
            background: #524eee;
            height: 10px;
            width: 10px;
            left: 27px;
            top: calc(50% - 5px);
            transform: scale(5);
            transition: .4s ease-in-out 0s;
            opacity: 0;
            visibility: hidden;
        }

        .radio-item [type="radio"]:checked~label {
            border-color: #524eee;
        }

        .radio-item [type="radio"]:checked~label:before {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }

        .radio-section {
            margin-top: -180px;
            margin-left: -115px;
        }

        /* Button */
        .btns-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .btn {
            padding: 0.75rem;
            display: block;
            text-decoration: none;

            background-color: #8D17EA;
            color: #f3f3f3;
            text-align: center;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color);
        }

        .btn-size {
            padding: 0.75rem;
            display: block;
            text-decoration: none;

            background-color: #8D17EA;
            color: #f3f3f3;
            text-align: center;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: 0.3s;
            margin-top: -315px;
        }
        .btn-size:hover{
            color:black;
        }



        @keyframes animate {
            from {
                transform: scale(1, 0);
                opacity: 0;
            }

            to {
                transform: scale(1, 1);
                opacity: 1;
            }
        }

        @media (min-width:300px) and (max-width:500px) {
            .input-info {
                display: block;
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #ccc;

                border-radius: 0.25rem;
                border-radius: 5px;

            }
        }
    </style>
@endpush
@section('content')
    <!-- =-=-=-=-=-=-= Main Header End  =-=-=-=-=-=-= -->
    <!-- =-=-=-=-=-=-= Breadcrumb =-=-=-=-=-=-= -->
    <div class="page-header-area-2 gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="small-breadcrumb">
                        <div class=" breadcrumb-link">
                            <ul>
                                <li><a href="{{ route('home') }}">Home Page</a></li>
                                <li><a class="active" href="#">Login</a></li>
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
        <section class="section-padding no-top gray">
            <!-- Main Container -->
            <div class="container">
                <!-- Row -->
                <div class="row">
                    <!-- Middle Content Area -->
                    <div style="border-radius:7px; border: 1px solid rgb(201, 200, 200); box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 bg-success">
                        <!--  Form -->
                        <div class="form-grid">
                            @if (session()->has('message'))
                                <span class="invalid-feedback text-success" role="alert">
                                    <strong>{{ session()->get('message') }}</strong>
                                </span>
                            @endif
                            <span class="invalid-feedback text-success" role="alert" id="forgot_success">

                            </span>
                            <form action="{{ route('buyer.login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Email</label>
                                    <input style="border-radius:7px" placeholder="Your Email"
                                        class="form-control @error('email') is-invalid @enderror" type="email"
                                        name="email">
                                    @error('email')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input style="border-radius:7px" placeholder="Your Password"
                                        class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password">
                                    @error('password')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div   class="form-group form-primary">

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
                                            <button style="margin-left:7px; border-radius:7px" type="button" class=" btn-danger reload" id="reload">&#x21bb</button>

                                        </div>

                                    </div>
                                    </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="form-group">

                                            <input style="border-radius:6px" class="form-control  @error('captcha') is-invalid @enderror" type="text" name="captcha" placeholder="Enter your captcha">
                                            @error('captcha')
                                        <span class="invalid-feedback text-danger " role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror


                                    </div>

                                </div>




                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-5 text-right">
                                            <p class="help-block"><a data-target="#myModal" data-toggle="modal">Forgot
                                                    password?</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <button style="margin-bottom: 10px;
                                margin-top:10px; background: rgb(230, 81, 81);
                                border-radius:12px" type="submit" class="btn  btn-next btn-lg btn-block">Login With
                                    Us</button>
                            </form>

                        </div>
                        <!-- Form -->
                    </div>
                    <!-- Middle Content Area  End -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Main Container End -->
        </section>
        <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->

    </div>
    <!-- Main Content Area End -->


    {{-- old model start --}}

    {{-- <div class="custom-modal">
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
                                    <input class="input-info" type="text" placeholder="enter your email" id="email_code_send" />
                                    <div class="text-danger" id="email-error"></div>
                                    <div class="text-success" id="email-otp"></div>
                                </div>

                                <section class="radio-section"></section>
                                <div class="">
                                    <a href="#" class="btn-size btn-next width-50 ml-auto">Send Code</a>

                                </div>
                            </div>
                            <div class="form-step">

                                <div class="input-group">
                                    <label class="label-item" for="email">Enter Your Code</label>
                                    <input class="input-info" type="text" placeholder="Enter code" />
                                    {{-- <div class="text-success" id="email-otp"></div> --}}
    {{-- </div>
                                <div class="btns-group">
                                    <a href="#" class="btn  btn-prev">Previous</a>
                                    <a href="#" class="btn  btn-next">Next</a>
                                </div>
                            </div>

                            <div class="form-step">
                                <div class="input-group">
                                    <label class="label-item" for="email">Enter Your New Password</label>
                                    <input class="input-info" type="text" placeholder="New password" />
                                </div>
                                <div class="input-group">
                                    <label class="label-item" for="email">Enter Your Confirm Password</label>
                                    <input class="input-info" type="text" placeholder="Confirm password" />
                                </div>


                                <div class="btns-group">
                                    <a href="#" class="btn btn-prev">Previous</a>
                                    <input type="submit" value="Submit" class="btn sub-btn" />
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>  --}}

    {{-- old model end --}}



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
                                    <input class="input-info" type="text" placeholder="enter your email"
                                        id="email_code_send" />
                                    <div class="text-danger" id="email-error"></div>

                                </div>

                                <section class="radio-section"></section>
                                <div class="">
                                    <a href="#" class="btn-size s btn-next width-50 ml-auto" id="sendCode">Send
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
                            <div class="form-step">

                                <div class="input-group">
                                    <label class="label-item">Enter Your Code</label>
                                    <input class="input-info form-control" type="text" placeholder="Enter code" id="otp_code" name="otp"/>
                                    <span class="text-success" id="email-otp" class="otp_error"></span>
                                </div>
                                <div class="input-group">
                                    <label class="label-item">Enter Your New Password</label>
                                    <input class="input-info" type="password" placeholder="New password" id="new_password" name="password"/>
                                    <span class="text-danger" id="pwd_error"></span>
                                </div>
                                <div class="input-group">
                                    <label class="label-item">Enter Your Confirm Password</label>
                                    <input class="input-info" type="password" placeholder="Confirm password" name="confirm_password" id="confirm_password"/>
                                    <span class="text-danger" id="confirm_pwd_error"></span>
                                </div>

                                <div class="btns-group">
                                    <a href="#" class="btn btn-prev" id="NewPassword">Submit</a>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- forgot password otp modal End --}}

@endsection

@push('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {





            $('#sendCode').on('click', function() {


                var email = $('#email_code_send').val();
                $.ajax({
                    url: "{{ route('buyer.password.request') }}",
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
                    url: "{{ route('buyer.otp.check') }}",
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
                            window.location.href = "{{ route('buyer.login')}}";
                            $('#forgot_success').text(result.message);
                        }

                    }
                });


            });






        });


































        // const prevBtns = document.querySelectorAll(".btn-prev");
        // const nextBtns = document.querySelectorAll(".btn-next");
        // const formSteps = document.querySelectorAll(".form-step");

        // let formStepsNum = 0;
        // let uploadStepsNum = 0;

        // nextBtns.forEach((btn) => {
        //   btn.addEventListener("click", () => {

        //       var email = $('#email_code_send').val();
        //     $.ajax({
        //         url:"{{ route('buyer.password.request') }}",
        //         method:"post",
        //         data:{email:email},
        //         success: function(result)
        //         {
        //             console.log(result);
        //             if(result.error)
        //             {
        //                 if(result.error.email)
        //                 {
        //                     $('#email-error').text(result.error.email[0]);
        //                 }else
        //                 {
        //                     $('#email-error').text(result.error);
        //                 }


        //             }
        //             if(result.success)
        //             {

        //                 $('#email-otp').text(result.success);
        //             }

        //         }
        //     });

        //     formStepsNum++;
        //     formStepsNum++;
        //     uploadStepsNum++;


        //   });
        // });

        // prevBtns.forEach((btn) => {
        //   btn.addEventListener("click", () => {
        //     formStepsNum--;
        //     uploadStepsNum--;
        //     updateFormSteps();
        //     updateProgressbar();
        //     updateUploadSteps();
        //   });
        // });

        // function updateFormSteps() {
        //   formSteps.forEach((formStep) => {
        //     formStep.classList.contains("form-step-active") &&
        //       formStep.classList.remove("form-step-active");
        //   });

        //   formSteps[formStepsNum].classList.add("form-step-active");
        // }
        // function updateUploadSteps() {
        //   uploadSteps.forEach((uploadStep) => {
        //     uploadStep.classList.contains("upload-step-active") &&
        //     uploadStep.classList.remove("upload-step-active");
        //   });

        //   uploadSteps[uploadStepsNum].classList.add("upload-step-active");
        // }

        // function updateProgressbar() {
        //   progressSteps.forEach((progressStep, idx) => {
        //     if (idx < formStepsNum + 1) {
        //       progressStep.classList.add("progress-step-active");
        //     } else {
        //       progressStep.classList.remove("progress-step-active");
        //     }
        //   });

        //   const progressActive = document.querySelectorAll(".progress-step-active");

        //   progress.style.width =
        //     ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
        // }
    </script>
@endpush
