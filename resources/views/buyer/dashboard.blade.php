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
                                <li><a href="#">Home Page</a></li>
                                <li><a class="active" href="#">Profile</a></li>
                            </ul>
                        </div>
                        <div class="header-page">
                            <h1>
                                @if (session()->has('message'))
                                <span class="invalid-feedback text-success" role="alert">
                                <strong>{{ session()->get('message') }}</strong>
                            </span>
                                @endif
                            </h1>
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
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <section class="search-result-item">
                            @if (isset($buyer->img))
                            <a class="image-link" href="#"><img class="image center-block" alt=""
                                src="{{ asset('frontend') }}/images/users/{{$buyer->img}}"> </a>
                                @else
                                <a class="image-link" href="#"><img class="image center-block" alt=""
                                    src="{{ asset('frontend') }}/images/users/user.png"> </a>
                            @endif

                            <div class="search-result-item-body">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <h4 class="search-result-item-heading"><a
                                                href="#">{{ (auth()->user()->username)? auth()->user()->username : 'User Name'}}</a></h4>
                                        <p class="info">
                                            <span><a href="#profile" data-toggle="tab"><i class="fa fa-user "></i>Profile
                                                </a></span>
                                            <span><a href="#edit" data-toggle="tab"><i class="fa fa-edit"></i>Edit Profile
                                                </a></span>
                                        </p>

                                         @php
                                        $dateTime = new DateTime(auth()->user()->created_at);
                                        // Format the date as "j F Y" (day, month, year)
                                        $formattedDate = $dateTime->format('F j, Y');
                                        @endphp
                                        <p class="description">You last logged in at: {{$formattedDate}}</p>
                                        {{-- <p class="description">You last logged in at: 14-01-2017 6:40 AM | USA time (GMT +
                                            6:00hrs)</p> --}}
                                        {{-- <span class="label label-warning">Unpaid Package</span>
                                        <span class="label label-success">Buyer</span> --}}
                                    </div>
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <div class="row ad-history">
                                            {{-- <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="user-stats">
                                                    <h2>0</h2>
                                                    <small>Ad Sold</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="user-stats">
                                                    <h2>0</h2>
                                                    <small>Total Listings</small>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="user-stats">
                                                  <?php
                                                    $countWishList = 0;
                                                    if (session()->has('favourite')) {
                                                      ?>

                                                    <h2>{{ session('favourite') ? count(session('favourite')) : 0}}</h2>
                                                    <?php
                                                    }
                                                    ?>


                                                    <small>Favorites Lists</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="dashboard-menu-container">
                            <ul>
                                <li class="active">
                                    <a href="{{ route('buyer.dashboard')}}">
                                        <div class="menu-name"> Profile </div>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="#">
                                        <div class="menu-name">Archives</div>
                                    </a>
                                </li> --}}
                                {{-- <li>
                                    <a href="#">
                                        <div class="menu-name">My Listings</div>
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('buyer.favourite')}}">
                                        <div class="menu-name">Favorites</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('buyer.message')}}">
                                        <div class="menu-name">Messages</div>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="#">
                                        <div class="menu-name">Close Account</div>
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <div class="menu-name">Log out</div>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Middle Content Area  End -->
                </div>
                <!-- Row End -->
                @yield('inner_content')
            </div>
            <!-- Main Container End -->
        </section>
        <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->

    </div>
    <!-- Main Content Area End -->
@endsection
