   <!-- =-=-=-=-=-=-= Preloader =-=-=-=-=-=-= -->
   {{-- <div class="preloader"></div> --}}

   <!-- =-=-=-=-=-=-= Main Header =-=-=-=-=-=-= -->
   {{--<div class="colored-header">
      <!-- Top Bar -->
      <div class="header-top dark">
         <div class="container">
            <div class="row">
               <!-- Header Top Left -->
               <div class="header-top-left col-md-6 col-sm-6 col-xs-12 hidden-xs">
                  <ul class="listnone">
                     <li><a href="{{ route('frontend.about') }}"><i class="fa fa-heart-o" aria-hidden="true"></i> About</a></li>
                     <li><a href="{{ route('faqs') }}"><i class="fa fa-folder-open-o" aria-hidden="true"></i> FAQS</a></li>
                  </ul>
               </div>
               <!-- Header Top Right Social -->
               <div class="header-right col-md-6 col-sm-6 col-xs-12 ">
                  <div class="pull-right">
                     <ul class="listnone">

                        @if (!auth()->check())

                        <li><a href="{{route('buyer.login')}}"><i class="fa fa-sign-in"></i> Log in</a></li>
                        <li ><a href="{{ route('buyer.register')}}"><i class="fa fa-unlock" aria-hidden="true"></i> Register</a></li>

                        <li>
                            <a href="{{ route('login')}}" style="background-color:rgb(233, 68, 68) !important" class="btn btn-theme">Become a Dealer</a>
                         </li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                        @if (isset($buyer->img))
                        <img class="img-circle resize" alt="" src="{{asset('/frontend')}}/images/users/{{$buyer->img}}">
                           @else
                           <img class="img-circle resize" alt="" src="{{asset('/frontend')}}/images/users/user.png">
                        @endif

                        <span class="myname hidden-xs"> {{auth()->user()->username}} </span> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="{{ url('/home')}}">Profile</a></li>
                           <li><a href="{{ url('/buyer/favorite')}}">Favorite</a></li>
                           <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a></li>
                              </ul>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                              </form>
                         </li>

                        @endif
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Top Bar End -->--}}



            <!-- =-=-=-=-=-=-=  Header =-=-=-=-=-=-= -->
            <div class="colored-header">
         <!-- Top Bar -->
         <div class="header-top dark">
            <div class="container">
               <div class="row">
                  <!-- Header Top Left -->
                  <div class="header-top-left col-md-8 col-sm-6 col-xs-12 hidden-xs">
                     <ul class="listnone">
                        <li><a href="{{ route('frontend.about') }}"><i class="fa fa-heart-o" aria-hidden="true"></i> About</a></li>
                        <li><a href="{{ route('faqs') }}"><i class="fa fa-folder-open-o" aria-hidden="true"></i> FAQS</a></li>
                        {{--<li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe" aria-hidden="true"></i> Language <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              <li><a href="#">English</a></li>
                              <li><a href="#">Swedish</a></li>
                              <li><a href="#">Arabic</a></li>
                              <li><a href="#">Russian</a></li>
                              <li><a href="#">chinese</a></li>
                           </ul>
                        </li>--}}
                     </ul>
                  </div>
                  <!-- Header Top Right Social -->
                  <div class="header-right col-md-4 col-sm-6 col-xs-12 ">
                     <div class="pull-right">
                        <ul class="listnone">
                        @if (!auth()->check())

                        <li><a href="{{ route('buyer.register')}}"><i class="fa fa-unlock" aria-hidden="true"></i> Register</a></li>



                           <li><a href="{{route('buyer.login')}}"><i class="fa fa-sign-in"></i> Log in</a></li>

                           <li><a href="{{ route('login')}}" style="background-color:rgb(233, 68, 68) !important" class="btn btn-theme">Become a Dealer</a></li>
                        @else
                           {{--<li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="img-circle resize" alt="" src="images/users/3.jpg"> <span class="myname hidden-xs"> Umair </span> <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                 <li><a href="profile.html">User Profile</a></li>
                                 <li><a href="archives.html">Archives</a></li>
                                 <li><a href="active-ads.html">Active Ads</a></li>
                                 <li><a href="favourite.html">Favourite Ads</a></li>
                                 <li><a href="messages.html">Message Panel</a></li>
                                 <li><a href="deactive.html">Account Deactivation</a></li>
                              </ul>
                           </li>--}}

                           <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                                @if (isset($buyer->img))
                                <img class="img-circle resize" alt="" src="{{asset('/frontend')}}/images/users/{{$buyer->img}}">
                                    @else
                                    <img class="img-circle resize" alt="" src="{{asset('/frontend')}}/images/users/user.png">
                                @endif

                                <span class="myname hidden-xs"> {{auth()->user()->username}} </span> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                               <li><a href="{{ url('/home')}}">Profile</a></li>
                               <li><a href="{{ url('/buyer/favorite')}}">Favorite</a></li>
                               <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a></li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                         </li>
                           @endif
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Top Bar End -->



      <!-- Navigation Menu -->
      <div class="clearfix"></div>
      <!-- menu start -->
      <nav id="menu-1" class="mega-menu ">
         <!-- menu list items container -->
         <section class="menu-list-items">
            <div class="container">
               <div class="row ">
                  <div class="col-lg-12 col-md-12 ">
                     <!-- menu logo -->
                     <ul class="menu-logo">
                        <li>
                           <a href="{{ route('home') }}"><img class="localcarz-logo" src="{{asset('/frontend')}}/images/logos.png" alt="logo" > </a>
                        </li>
                     </ul>
                     <!-- menu links -->
                     <ul class="menu-links ">
                        <!-- active class -->
                        <li class="login-remove">
                            <a class="hello-user" href="#">Hello!</a>
                            @if (!auth()->check())
                            <a class="pull-right login-responsive" href="{{route('buyer.login')}}"><i class="fa fa-sign-in"></i> Log in</a>
                            @else
                            <a class="pull-right login-responsive" href="{{ url('/home')}}"><i class="fa fa-sign-in"></i> Profile</a>

                               @endif
                        </li>
                        <li>
                           <a href="{{ route('home') }}">Home</a>

                        </li>
                        <li>
                           <a href="{{ route('autos') }}"> Autos </a>

                        </li>
                        <li>
                           <a href="{{ route('news') }}">News </a>

                        </li>
                        <li>
                           <a href="{{ route('recently.added') }}">Recently Added</a>

                        </li>
                        <li>

                            <a href="{{ route('favourite.listing') }}">Favorites</a>
                         </li>
                         @if (auth()->check())
                         <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >Log out</a></li>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                           </form>
                           @endif
                        {{-- <li>

                            <a  href="javascript:void(0)">Search </a>


                        </li> --}}

                        <li> <a title="Search" href="javascript:void(0)">
                        <span
                        style="
                        width:50px;
                        heigth:50px;
                        background-color:white;
                        color:white;
                        "> Search </span></a></li>









                        <li class="dealer-remove">
                            {{-- <p class="inventory-heading">Add your inventory to localcarz</p> --}}

                        <a
                        href="{{ route('login')}}"
                        style="color:rgb(16, 145, 219);" class="">
                        Become a Dealer
                        </a></li>

                     </ul>
                  </div>
               </div>
            </div>
         </section>
      </nav>
      <!-- menu end -->
   </div>
   <!-- =-=-=-=-=-=-= Main Header End  =-=-=-=-=-=-= -->
