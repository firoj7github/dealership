<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a href="{{ route('dashboard')}}">
                <img class="img-fluid" src="{{ asset('dashboard') }}/assets/images/localcarz.png"
                    alt="Theme-Logo" width="80" />
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu icon-toggle-right"></i>
            </a>
            <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container">
            <ul class="nav-left">
                <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-prepend search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Enter Keyword">
                            <span class="input-group-append search-btn">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()"
                        class="waves-effect waves-light">
                        <i class="full-screen feather icon-maximize"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="header-notification">
                <div class="cart-container">
                    <div class="cart-icon" onclick="toggleCart()">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="badge" id="cart-count">{{ (isset($invoices)) ? count($invoices) : '' }}</span>
                    </div>
                    <div class="cart-content" id="cart-content" style="height: 200px; overflow:auto">

                        {{-- <table class="table">
                            <tbody id="">


                        </tbody> <!-- Close tbody here -->
                        </table> <!-- Close table here --> --}}

                        <div id="invoice-section">

                        </div>

                    </div>
                </div>
                </li>

                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-message-square"></i>
                            <span class="badge bg-c-green">3</span>
                        </div>
                    </div>
                </li>
{{--
               <li class="header-notification">
                <div class="cart-container">
                    <div class="cart-icon" onclick="toggleCart()">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="badge" id="cart-count">{{ (isset($invoices)) ? count($invoices) : '' }}</span>
                    </div>
                    <div class="cart-content" id="cart-content" style="height: 200px; overflow:auto">

                        {{-- <table class="table">
                            <tbody id="">


                        </tbody> <!-- Close tbody here -->
                        </table> <!-- Close table here --> --}}
{{--


                    </div>
                </div>
                </li> --}}

                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('dashboard') }}/assets/images/avatar-4.jpg"
                                class="img-radius" alt="User-Profile-Image">
                            <span>{{isset( auth()->user()->name)?  auth()->user()->name :'' }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu"
                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
{{--
                            <li>

                                <a href="{{ route('dealer.profile')}}">
                                    <i class="feather icon-user"></i> Profile
                                </a>


                            </li> --}}

                            <li>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                </li>


            </ul>
        </div>
    </div>
</nav>
