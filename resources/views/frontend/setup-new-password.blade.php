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
                                <li><a class="active" href="#">Set Password</a></li>
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
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <!--  Form -->
                        <div class="form-grid">
                            @if (session()->has('message'))
                                <span class="invalid-feedback text-success" role="alert">
                                    <strong>{{ session()->get('message') }}</strong>
                                </span>
                            @endif
                            <span class="invalid-feedback text-success" role="alert" id="forgot_success">

                            </span>
                            <form action="{{ route('setup_new_buyer.login',$user->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Email</label>
                                    <input placeholder="Your Email"
                                        class="form-control @error('email') is-invalid @enderror" type="email" value="{{ $user->email}}"
                                        name="email" readonly>
                                    @error('email')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input placeholder="Enter Your New Password"
                                        class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password">
                                    @error('password')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-theme btn-next btn-lg btn-block">Login With
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


@endsection

@push('js')
  <script>
    </script>
@endpush
