<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a href="{{ route('dealer.dashboard') }}">
                <img class="img-fluid" src="{{ asset('dashboard') }}/assets/images/localcarz.png"
                    alt="Theme-Logo" width="80"/>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#">
                <i class="feather icon-menu icon-toggle-right"></i>
            </a>
            <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
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
                        <span class="badge" id="cart-count"></span>
                    </div>
                    <div class="cart-content" id="cart-content" style="height: 200px; overflow:auto">


                        <div id="invoice-section">

                        </div>
{{--
                        <table class="table">
                            <tbody> --}}
                                {{-- @if (isset($invoices))
                                    <form action="{{ route('dealer.invoice.show')}}" method="POST">
                                        @csrf
                                        @forelse ($invoices as $invoice)
                                            <tr>
                                                @if ($invoice->banner_id)
                                                    <td style="padding: 0px">{{$invoice->banner->name}}</td>
                                                    <td style="padding: 0px"><input type="hidden" name="banner_ids[]" value="{{ $invoice->banner_id}}"></td>
                                                    <td style="padding: 0px"><a href="#" class="deleteCart" data-id="{{ $invoice->banner_id}}"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>
                                                @endif
                                                @if ($invoice->slider_id)
                                                    <td style="padding: 0px">{{$invoice->slider->title}}</td>
                                                    <td style="padding: 0px"><input type="hidden" name="slider_ids[]" value="{{ $invoice->slider_id}}"></td>
                                                    <td style="padding: 0px"><a href="#" class="deleteCart" data-id="{{ $invoice->slider_id}}"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>
                                                @endif
                                                @if ($invoice->inventory_id)
                                                    <td style="padding: 0px"># {{($invoice->inventory->stock) ? $invoice->inventory->stock : ''}}</td>
                                                    <td style="padding: 0px">{{$invoice->inventory->title}}</td>
                                                    <td style="padding: 0px"><input type="hidden" name="inventory_ids[]" value="{{ $invoice->inventory_id}}"></td>
                                                    <td style="padding: 0px"><a href="#" class="deleteCart" data-id="{{ $invoice->inventory_id}}"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>
                                                @endif
                                            </tr>
                                        @empty
                                            <p>No listing here</p>
                                        @endforelse

                                        </tbody> <!-- Close tbody here -->
                                    </table> <!-- Close table here -->

                                    <button class="btn btn-success" type="submit">Go Invoice</button>
                                </form>
                            @endif --}}

                        {{-- <a class="btn btn-sm btn-primary float-right p-2" href="{{ route('admin.invoice.show')}}">Go Invoice</a> --}}

                    </div>
                </div>
                </li>
                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        {{-- <div class="dropdown-toggle" data-toggle="dropdown" onclick="toggleCart()">

                            <span class="badge bg-c-red">5</span>

                            <div class="cart-content" id="cart-content">
                                <!-- Selected data will be displayed here -->
                            </div>
                        </div> --}}

                        <ul class="show-notification notification-view dropdown-menu"
                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            {{-- <li>
                                <h6>Notifications</h6>
                                <label class="label label-danger">New</label>
                            </li> --}}
                            {{-- <li>
                                <div class="media">
                                    <img class="img-radius"
                                        src="{{ asset('dashboard') }}/assets/images/avatar-4.jpg"
                                        alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="notification-user">John Doe</h5>
                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                            elit.</p>
                                        <span class="notification-time">30 minutes ago</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="img-radius"
                                        src="{{ asset('dashboard') }}/assets/images/avatar-3.jpg"
                                        alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="notification-user">Joseph William</h5>
                                        <p class="notification-msg">Lorem ipsum dolor sit amet,
                                            consectetuer elit.</p>
                                        <span class="notification-time">30 minutes ago</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="img-radius"
                                        src="{{ asset('dashboard') }}/assets/images/avatar-4.jpg"
                                        alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="notification-user">Sara Soudein</h5>
                                        <p class="notification-msg">Lorem ipsum dolor sit amet,
                                            consectetuer elit.</p>
                                        <span class="notification-time">30 minutes ago</span>
                                    </div>
                                </div>
                            </li> --}}
                        </ul>
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
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('dashboard') }}/assets/images/avatar-4.jpg"
                                class="img-radius" alt="User-Profile-Image">
                            <span>{{ auth()->user()->name }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu"
                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                            <li>

                                <a href="{{ route('dealer.profile')}}">
                                    <i class="feather icon-user"></i> Profile
                                </a>

                            </li>
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





