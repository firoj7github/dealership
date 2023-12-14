<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="description"
        content="New Cars, Used Cars, Car News, Car Reviews and Pricing, Buy and sell cars,LocalCarz, LocalCarzz, connect with dealers in the USA. Find the perfect car for you at localcarz.com." />
    <meta name="author" content="Marif Soft" />
    <meta name="keywords"
        content="'New Cars, Used Cars, Car News, Car Reviews and Pricing, car sales, car dealership, USA, buy cars, sell cars, localcarz, localcars, local cars, local, cars, SKCO, localcarz.com.">
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <![endif]-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')
        {{ 'New Cars, Used Cars, Car News, Car Reviews and Pricing | LocalCarz' ?? config('app.name') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@stack('meta')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- =-=-=-=-=-=-= Favicons Icon =-=-=-=-=-=-= -->



    <link rel="icon" href="{{ asset('/frontend') }}/images/logos.png" type="image/x-icon" />
    <!-- =-=-=-=-=-=-= Mobile Specific =-=-=-=-=-=-= -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- =-=-=-=-=-=-= Bootstrap CSS Style =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/bootstrap.css">
    <!-- =-=-=-=-=-=-= Template CSS Style =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/style.css">
    <!-- =-=-=-=-=-=-= Font Awesome =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/font-awesome.css" type="text/css">
    <!-- =-=-=-=-=-=-= Flat Icon =-=-=-=-=-=-= -->
    <link href="{{ asset('/frontend') }}/css/flaticon.css" rel="stylesheet">
    <!-- =-=-=-=-=-=-= Et Line Fonts =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/et-line-fonts.css" type="text/css">
    <!-- =-=-=-=-=-=-= Menu Drop Down =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/carspot-menu.css" type="text/css">
    <!-- =-=-=-=-=-=-= Animation =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/animate.min.css" type="text/css">
    <!-- =-=-=-=-=-=-= Select Options =-=-=-=-=-=-= -->
    {{-- <link href="{{ asset('/frontend') }}/css/select2.min.css" rel="stylesheet" /> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <!-- =-=-=-=-=-=-= noUiSlider =-=-=-=-=-=-= -->
    <link href="{{ asset('/frontend') }}/css/nouislider.min.css" rel="stylesheet">
    <!-- =-=-=-=-=-=-= Listing Slider =-=-=-=-=-=-= -->
    <link href="{{ asset('/frontend') }}/css/slider.css" rel="stylesheet">
    <!-- =-=-=-=-=-=-= Owl carousel =-=-=-=-=-=-= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend') }}/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend') }}/css/owl.theme.css">
    <!-- =-=-=-=-=-=-= Check boxes =-=-=-=-=-=-= -->
    <link href="{{ asset('/frontend') }}/skins/minimal/minimal.css" rel="stylesheet">
    <!-- =-=-=-=-=-=-= PrettyPhoto =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/jquery.fancybox.min.css" type="text/css"
        media="screen" />
    <!-- =-=-=-=-=-=-= Responsive Media =-=-=-=-=-=-= -->
    <link href="{{ asset('/frontend') }}/css/responsive-media.css" rel="stylesheet">
    <!-- =-=-=-=-=-=-= Template Color =-=-=-=-=-=-= -->
    <link rel="stylesheet" id="color" href="{{ asset('/frontend') }}/css/colors/defualt.css">
    {{-- own css --}}
    <!-- For This Page Only -->
    <!-- Base MasterSlider style sheet -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/js/masterslider/style/masterslider.css" />
    <link rel="stylesheet" href="{{ asset('/frontend') }}/js/masterslider/skins/default/style.css" />
    <link rel="stylesheet" href="{{ asset('/frontend') }}/js/masterslider/style/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600%7CSource+Sans+Pro:400,400i,600"
        rel="stylesheet">


    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600%7CSource+Sans+Pro:400,400i,600"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/rangeSlider.css">

            <!--mobile device -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@14.6.3/distribute/nouislider.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    {{-- [if lt IE 9]> --}}
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      {{-- <![endif] --}}



    <style>
        .fade-scale {
  transform: scale(0);
  opacity: 0;
  -webkit-transition: all .25s linear;
  -o-transition: all .25s linear;
  transition: all .25s linear;
}

.fade-scale.in {
  opacity: 1;
  transform: scale(1);
}
    </style>
    @stack('css')
</head>

<body>
    @include('frontend.layouts.navbar')



    @yield('content')

{{-- login modal show start here --}}

<div class="modal fade fade-scale" id="favourite_add_auth_modal" tabindex="-1" aria-labelledby="exampleModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-middle" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 p-4">
                            <form>
                                <div class="row mb-3" id="rowOne">

                                    <div class="form-group" id="replace_html">
                                        <h3 class="text-center fw-bold" style="color: black">Create a LocalCarz account</h3>
                                        <p class="text-center">Unlock more tools from price drop alerts to building your favourite list.</p>
                                        <label>E-mail</label>
                                        <input placeholder="Enter Your E-mail" class="form-control" type="text"
                                            name="email" id="email" style="width: 95% !important;">
                                        <div class="text-danger error_email"></div>
                                        <a href="#" class="btn btn-danger" style="margin: 30px;float:right"
                                            id="CheckEmail">Continue</a>
                                    </div>
                                    <div class="form-group" id="login_field" style="display: none">
                                        <h3 class="text-center fw-bold text-dark">Welcome Back !</h3>
                                        <h4 class="text-center fw-bold">Please Enter Your Password to Log In.</h4>
                                        <h4 class="text-center fw-bold"><i class="fa fa-envelope"></i> <span
                                                id="email_session_one"></span></h4><br /><br />
                                        <input type="hidden" id="inventory_id_pass">
                                        <label>Password</label>
                                        <input placeholder="Enter Your Password" class="form-control" type="password"
                                            name="password" id="password" style="width: 95% !important;">
                                        <input type="hidden" name="email_session_one" class="email_session_one">
                                        <div class="text-danger error_password"></div>
                                        <a href="#" class="btn btn-danger" style="margin: 30px;float:right"
                                            id="login">Login</a>
                                    </div>
                                </div>
                                <div class="row mb-3" style="display:none" id="rowTwo">
                                    <h3 class="text-center fw-bold">Sign up</h3>
                                    <h4 class="text-center fw-bold"><i class="fa fa-envelope"></i> <span
                                            id="email_session_two"></span></h4>
                                    {{-- <label>First Name</label>
                                            <input placeholder="Enter Your First Name" class="form-control"
                                                type="text" name="fname" id="fname"
                                                style="width: 95% !important;"><br />

                                            <label>Last Name</label>
                                            <input placeholder="Enter Your Last Name" class="form-control" type="text"
                                                name="lname" id="lname" style="width: 95% !important;"><br />

                                            <label>E-mail</label>
                                            <input placeholder="Enter Your Email" class="form-control" type="email"
                                                name="email" id="email" style="width: 95% !important;"><br />

                                            <label>Password</label>
                                            <input placeholder="Password" class="form-control" type="password"
                                                name="res_password" id="res_password" style="width: 95% !important;"><br />

                                            <label>Confirm Password</label>
                                            <input placeholder="Confirm Password" class="form-control" type="password"
                                                name="confirm_password" id="confirm_password"
                                                style="width: 95% !important;"><br /> --}}
                                    <label>Password</label>
                                    <input placeholder="choose a password" class="form-control" type="password"
                                        name="password" id="res_password" style="width: 95% !important;">
                                    <span style="text-align: center">Your password must be at least 6 characters long, and contain a number or a symbol.</span>
                                    <input type="hidden" name="email_session" class="email_session_two">
                                    <div class="text-danger sign_up_email"></div>
                                    <div class="text-danger sign_up_password"></div>
                                    <a href="#" class="btn btn-danger" style="margin: 30px;float:right"
                                        id="SignUp">Create Account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->
    <footer class="footer-bg">
        <!-- Footer Content -->
        <div class="footer-top">
            <div class="container">
                <h3 class=" footer-title">ABOUT LOCALCARZ.COM®</h3>
                <p class='footer-bilboard'>LocalCarz.com is an independent company that works side by side with
                    consumers, sellers, and dealers for transparency and fairness in the marketplace.Local Carz Vehicle
                    products are based only on information supplied to Local Carz. Local Carz does not have the complete
                    history of every vehicle. Use the Local Carz search as one important tool, along with a vehicle
                    inspection and test drive, to make a better decision about your next used car.</p>
                <div class="row">

                    <div class="col-md-4 col-sm-6 col-xs-12  mt-3 mb-3 footer-card-1">
                        <!-- Info Widget -->
                        <h3 class="text-uppercase footer-info mb-4 fw-bold middle">ABOUT LOCALCARZ</h3>

                        <p class="middle">
                            <a href="{{ route('home') }}" class="all-link text-decoration-none ">Home</a>
                        </p>
                        <p class="middle">
                            <a href="{{ route('frontend.about') }}" class="all-link text-decoration-none ">About Us</a>
                        </p>



                        {{-- <p class="middle">
                            <a class="all-link text-decoration-none ">Search</a>
                        </p> --}}
                        {{-- <p class="middle">
                            <a class="all-link text-decoration-none ">About Us</a>
                        </p> --}}
                        <p class="middle">
                            <a class="all-link text-decoration-none " href="{{route('contact.us')}}">Contact Us</a>
                        </p>
                        <!-- Info Widget Exit -->
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12  mt-3 mb-3 footer-card-2">

                        <h3 class="text-uppercase mb-4 footer-info middle">HELP & CONTACT</h3>
                        <p class="middle">
                            <a href="{{ route('news') }}" class="all-link text-decoration-none">News</a>
                        </p>
                        <p class="middle">
                            <a href="{{ route('faqs') }}" class="all-link text-decoration-none">FAQS</a>
                        </p>
                        <p  class="middle">
                            <a href="{{ route('favourite.listing') }}" class="all-link text-decoration-none">Favorite  </a>
                        </p>
                        {{-- <p class="middle">
                            <a class="all-link text-decoration-none">Terms of Use</a>
                        </p> --}}
                        {{-- <p class="middle">
                            <a class="all-link text-decoration-none">Privacy Policy</a>
                        </p> --}}

                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12  mt-3 footer-card-3">
                        <h3 class="text-uppercase mb-4 footer-info middle">
                            MORE HELPFUL Links
                        </h3>
                        {{-- <p class="middle">
                            <a class="all-link text-decoration-none">Find Car Dealers</a>
                        </p>
                        <p class="middle">
                            <a class="all-link text-decoration-none">Vehicle History Report</a>
                        </p>
                        <p class="middle">
                            <a class="all-link text-decoration-none">Free Bill of Sale</a>
                        </p> --}}
                    </div>
                    {{-- <div class="col-md-4 col-sm-6 col-xs-12 m-auto mt-3 footer-card-4">
                        <h3 class="text-uppercase mb-4 footer-info middle">
                            RESOURCES
                        </h3>

                        <p class="middle">
                            <a class="all-link text-decoration-none"></a>
                        </p>
                        <p class="middle">
                            <a class="all-link text-decoration-none">Best Cars To Buy</a>
                        </p>
                    </div> --}}
                </div>
                <hr class="my-3 line" />
                <section class="p-3 pt-0">
                    <div class="row d-flex align-items-center">

                        <div class="col-md-7 col-lg-8  text-md-start">

                            <div class="copy">
                                © 2023 Copyright:
                                <span class="text-white"> Localcarz.com</span>
                            </div>

                        </div>



                        <div class="col-md-5 icon-all col-lg-4 ml-lg-0 ">

                            <a class=" btn-outline-light btn-floating link-btn-fb m-1 fac-btn"
                                href="https://www.facebook.com/localcarzcom" target="_blank"><i
                                    class="fa fa-facebook-f"></i></a>


                            <a class=" btn-outline-light btn-floating link-btn m-1"
                                href="https://twitter.com/i/flow/login?redirect_after_login=%2Flocalcarz"
                                target="_blank"><i class="fa fa-twitter"></i></a>


                            <a class=" btn-outline-light btn-floating link-btn m-1"
                                href="https://www.pinterest.com/localcarz/?invite_code=3bb629501b8949fe870a6f680a91d14f&sender=1033717058128452304"
                                target="_blank"><i class="fa fa-pinterest"></i></a>


                            <a class=" btn-outline-light btn-floating link-btn m-1"
                                href="https://www.instagram.com/localcarzcom/?fbclid=IwAR2eN64mKf473ym7PtmDIpvVM-ZZECE9n0qtIIO2gNMg3EA6IdKonpl7h-c"
                                target="_blank"><i class="fa fa-instagram"></i></button>
                            </a>

                            <a class=" btn-outline-light btn-floating link-btn m-1"
                                href="https://www.youtube.com/@localcarz"
                                target="_blank"><i class="fa fa-youtube"></i></button>
                            </a>
                            <a class=" btn-outline-light btn-floating link-btn m-1"
                                href="https://www.snapchat.com/add/localcarz"
                                target="_blank"><i class="fa fa-snapchat"></i></button>
                            </a>
                            <a class=" btn-outline-light btn-floating link-btn m-1"
                                href="https://www.tiktok.com/@localcarzcom"
                                target="_blank"> <img style="width:8%" src="{{asset('frontend/images/tttt.png')}}" alt="" /></button>
                            </a>

                        </div>
                </section>
            </div>
        </div>

    </footer>
    <!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->

    <a href="#0" class="cd-top">Top</a>


</body>

<!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
<script src="{{ asset('/frontend') }}/js/jquery.min.js"></script>

<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js') }}" integrity="sha512-iJh0F10blr9SC3d0Ow1ZKHi9kt12NYa+ISlmCdlCdNZzFwjH1JppRTeAnypvUez01HroZhAmP4ro4AvZ/rG0UQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('/frontend') }}/js/bootstrap.min.js"></script>

<!-- Jquery Easing -->
<script src="{{ asset('/frontend') }}/js/easing.js"></script>

<!-- Menu Hover -->
<script src="{{ asset('/frontend') }}/js/carspot-menu.js"></script>

<!-- Jquery Appear Plugin -->
<script src="{{ asset('/frontend') }}/js/jquery.appear.min.js"></script>

<!-- Numbers Animation -->
<script src="{{ asset('/frontend') }}/js/jquery.countTo.js"></script>

<!-- Jquery Select Options -->
<script src="{{ asset('/frontend') }}/js/select2.min.js"></script>


<!-- noUiSlider -->
<script src="{{ asset('/frontend') }}/js/nouislider.all.min.js"></script>

<!-- Carousel Slider -->
<script src="{{ asset('/frontend') }}/js/carousel.min.js"></script>
<script src="{{ asset('/frontend') }}/js/slide.js"></script>

<!-- Image Loaded -->
<script src="{{ asset('/frontend') }}/js/imagesloaded.js"></script>
<script src="{{ asset('/frontend') }}/js/isotope.min.js"></script>

<!-- CheckBoxes -->
<script src="{{ asset('/frontend') }}/js/icheck.min.js"></script>

<!-- Jquery Migration -->
<script src="{{ asset('/frontend') }}/js/jquery-migrate.min.js"></script>

<!-- Style Switcher -->
<script src="{{ asset('/frontend') }}/js/color-switcher.js"></script>

<!-- PrettyPhoto -->
<script src="{{ asset('/frontend') }}/js/jquery.fancybox.min.js"></script>

<!-- Wow Animation -->
<script src="{{ asset('/frontend') }}/js/wow.js"></script>

<!-- Template Core JS -->
<script src="{{ asset('/frontend') }}/js/custom.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<!-- MasterSlider -->
<script src="{{ asset('/frontend') }}/js/masterslider/masterslider.min.js"></script>

{{-- Own JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- JavaScripts -->
<script src="{{ asset('/frontend') }}/js/modernizr.js"></script>
<script src="{{ asset('/frontend') }}/js/rangeSlider.js"></script>

<script src="{{ asset('dashboard') }}/assets/form-masking/inputmask.js"></script>
<script src="{{ asset('dashboard') }}/assets/form-masking/jquery.inputmask.js"></script>
<script src="{{ asset('dashboard') }}/assets/form-masking/autoNumeric.js"></script>
<script src="{{ asset('dashboard') }}/assets/form-masking/form-mask.js"></script>


<!-- mobile device -->
<script src="https://cdn.jsdelivr.net/npm/nouislider@14.6.3/distribute/nouislider.min.js"></script>

<!-- Add jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    (function($) {
        "use strict";


        var slider = new MasterSlider();

        // adds Arrows navigation control to the slider.
        slider.control('arrows');

        slider.setup('masterslider', {
            width: 1400, // slider standard width
            height: 560, // slider standard height
            layout: 'fullwidth',
            loop: true,
            preload: 0,
            fillMode: 'fill',
            instantStartLayers: true,
            autoplay: true,
            view: "basic"

        });
        // add scroll parallax effect

    })(jQuery);
    //own js
    function showNotification(type, message) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000,
        };

        toastr[type](message);
    }

    function showSuccessNotification() {
        showNotification('success', 'Operation completed successfully.');
    }

    function showErrorNotification() {
        showNotification('error', 'An error occurred while processing your request.');
    }
</script>




<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let cartContent = document.getElementById("cart-content");
    let cartCount = document.getElementById("cart-count");
    let itemCount = 0;

    function toggleCart() {
        cartContent.style.display = cartContent.style.display === "block" ? "none" : "block";
    }

    function addToCart(item) {

        let cartItem = document.createElement("div");
        cartItem.textContent = item;
        cartContent.appendChild(cartItem);
        itemCount++;
        cartCount.textContent = itemCount;
    }


    $(document).ready(function() {



        $('.deleteCart').on('click', function() {

            var clickedButton = $(this);
            var id = clickedButton.data('id');
            $.ajax({
                url: "{{ route('cart.data.delete') }}",
                method: "post",
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.status == 'success') {
                        toastr.success(res.message);
                        clickedButton.closest('tr').remove();
                    }
                }



            });

        });



    });





$(document).on('click', '#deleteComparision', function() {
    let id = $(this).data('id');
    $.ajax({
        url: "{{ route('delete.comparision') }}", // Use colons (:) instead of equal signs (=) for key-value pairs
        type: "POST", // Use all uppercase for the request method
        data: { id: id },
        success: function(res) {
            toastr.error(res.message);
            // $('.compare-table').html('');
            $('.compare-table').html(res.data);
            if ($(window).width() <= 1000) {

                $('.compare_body').html(res.data);

            }


        }
    });
});


// automatic login alert modal show code ajax start

// function showModal(ipAddress) {
//     $('#favourite_add_auth_modal').modal('show');
//     localStorage.setItem('modal_shown_' + ipAddress, true);
// }

// function checkAndShowModal() {
//     $.ajax({
//         url: "{{ route('get.ipaddress')}}",
//         type: 'GET',
//         success: function(response) {
//             var ipAddress = response.ip;
//             var modalShown = localStorage.getItem('modal_shown_' + ipAddress);

//             if (!modalShown) {
//                 showModal(ipAddress);
//                 console.log('Modal shown for IP:', ipAddress);

//                 // Set a timeout to reset the flag after 2 minutes (120000 milliseconds)
//                 setTimeout(function() {
//                     console.log('Removing item from localStorage for IP:', ipAddress);
//                     // localStorage.removeItem('modal_shown_' + ipAddress);
//                     setInterval(localStorage.removeItem('modal_shown_' + ipAddress), 30000);
//                 }, 40000); // 2 minutes in milliseconds
//             } else {
//                 console.log('Modal was shown before for IP:', ipAddress);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error("Error fetching IP address:", error);
//         }
//     });
// }

// $(document).ready(function() {
//     var userId = "{{ Auth::id() }}";
//     console.log(userId);
//     if (userId === "") {
//         // Call the function after 2 minutes (initial delay)
//         setTimeout(function() {
//             checkAndShowModal();

//             // Call the function every 2 minutes (120000 milliseconds)
//             setInterval(checkAndShowModal, 30000);
//         }, 30000); // Initial delay of 2 minutes before the first call
//     }
// });




$('#login').on('click', function() {
    var password = $('#password').val();
    $.ajax({
        url: "{{ route('favourte.auth.login')}}",
        type: 'post',
        data: {
            password: password,
        },
        success: function(res) {
            console.log(res);
            if (res.password) {
                $('.error_password').text(res.password);
            }
            if (res.message) {

                toastr.success(res.message);
                window.location.reload();

            }
            if (res.error) {

                toastr.success(res.error);
                $('.error_password').text(res.error);

            }

        }
    })
});

$('#SignUp').on('click', function() {

    var email = $('.email_session_two').val();

    var password = $('#res_password').val();

    $.ajax({
        url: "{{ route('favourte.auth.signup')}}",
        type: 'post',
        data: {
            email: email,
            password: password,
        },
        success: function(res) {
            console.log(res);
            if (res.email) {
                $('.sign_up_email').text(res.email);

            }
            if (res.password) {
                $('.sign_up_password').text(res.password);
            }
            if (res.create) {
                toastr.success(res.create);
                // window.location.href = "{{ route('buyer.login') }}";
                window.location.reload();

            }

        }
    });
});



// automatic login alert modal show code ajax end







</script>

@stack('js')

</html>
