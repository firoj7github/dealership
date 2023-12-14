<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') {{ 'Localcarz' ?? config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Buy and sell cars, connect with dealers in the USA. Find the perfect car for you at localcarz.com." />
    <meta name="keywords"
        content="car sales, car dealership, USA, buy cars, sell cars, localcarz, localcars, local cars, local, cars, SKCO, localcarz.com.">
    <meta name="author" content="Marif Soft" />
    <meta name="csrf-token" content="{{ csrf_token() }}">



    {{-- <link rel="icon" href="{{ asset('dashboard') }}/assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/bower_components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/waves.min.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/icon/feather/css/feather.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/bower_components/chartist/css/chartist.css" type="text/css" media="all">
    <link href="{{asset('/frontend')}}/css/flaticon.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/widget.css">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/assets/css/pages.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/bower_components/sweetalert/css/sweetalert.css">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/assets/css/component.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
{{-- file link --}}
    <link href="{{ asset('dashboard') }}/assets/css/jquery.filer.css" type="text/css" rel="stylesheet" />
    <link href="{{ asset('dashboard') }}/assets/css/jquery.filer-dragdropbox-theme.css" type="text/css"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/bower_components/select2/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/pages/waves/css/waves.min.css" type="text/css"
        media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard') }}/assets/icon/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard') }}/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard') }}/bower_components/multiselect/css/multi-select.css" />--}}

    <link rel="icon" href="{{ asset('dashboard') }}/assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard') }}/bower_components/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/waves.min.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/icon/feather/css/feather.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/font-awesome-n.min.css">

    <link rel="stylesheet" href="{{ asset('dashboard') }}/bower_components/chartist/css/chartist.css" type="text/css"
        media="all">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/widget.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <style>
        .cart-container {
            position: relative;

        }

        .cart-icon {
            cursor: pointer;
            position: relative;
        }

        .cart-icon img {
            width: 30px;
        }

        .badge {
            position: absolute;
            top: 0;
            right: 200;
            background-color: red;
            color: white;
            padding: 5px 8px;
            border-radius: 50%;
        }

        .cart-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 500px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px;
            z-index: 1;
        }
    </style>

    @stack('css')
</head>

<body>
    @php
        $invoices = Session::get('invoices');
    @endphp

    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @include('dealer.layouts.topbar')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    @include('dealer.layouts.navbar')

                    <div class="pcoded-content">
                        @yield('content')
                    </div>

                    <div id="styleSelector">
                    </div>

                </div>
            </div>
        </div>
    </div>



    {{-- <script type="text/javascript" src="{{ asset('dashboard') }}/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="{{ asset('dashboard') }}/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('dashboard') }}/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="{{ asset('dashboard') }}/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ asset('dashboard') }}/bower_components/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="{{asset('dashboard')}}/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/bower_components/modernizr/js/css-scrollbars.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script src="{{ asset('dashboard') }}/bower_components/chartist/js/chartist.js"></script>

<script src="{{asset('dashboard')}}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('dashboard')}}/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('dashboard')}}/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('dashboard')}}/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('dashboard')}}/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('dashboard')}}/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('dashboard')}}/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="{{ asset('dashboard') }}/assets/js/waves.min.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/jquery.flot.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/jquery.flot.categories.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/jquery.flot.tooltip.min.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/curvedLines.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/amcharts.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/serial.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/light.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/pcoded.min.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/vertical/vertical-layout.min.js"></script>
<script type="text/javascript" src="{{ asset('dashboard') }}/assets/js/custom-dashboard.min.js"></script>
<script type="text/javascript" src="{{ asset('dashboard') }}/assets/js/script.min.js"></script>

<script src="{{asset('dashboard')}}/data-table/js/jszip.min.js"></script>
<script src="{{asset('dashboard')}}/data-table/js/pdfmake.min.js"></script>
<script src="{{asset('dashboard')}}/data-table/js/vfs_fonts.js"></script>

<script src="{{asset('dashboard')}}/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/assets/js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

<script src="{{asset('dashboard')}}/assets/js/dropzone-amd-module.min.js"></script>
<script src="{{asset('dashboard')}}/assets/pages/waves/js/waves.min.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/assets/pages/advance-elements/select2-custom.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/assets/js/jquery.quicksearch.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="{{asset('dashboard')}}/assets/js/common-pages.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>

    <script src="{{ asset('dashboard') }}/assets/js/waves.min.js"></script>

    <script type="text/javascript"
        src="{{ asset('dashboard') }}/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

    <script src="{{ asset('dashboard') }}/assets/js/jquery.flot.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/jquery.flot.categories.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/curvedLines.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/jquery.flot.tooltip.min.js"></script>

    <script src="{{ asset('dashboard') }}/bower_components/chartist/js/chartist.js"></script>

    <script src="{{ asset('dashboard') }}/assets/js/amcharts.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/serial.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/light.js"></script>

    <script src="{{ asset('dashboard') }}/assets/js/pcoded.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/vertical/vertical-layout.min.js"></script>
    <script type="text/javascript" src="{{ asset('dashboard') }}/assets/js/custom-dashboard.min.js"></script>
    <script type="text/javascript" src="{{ asset('dashboard') }}/assets/js/script.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="{{ asset('dashboard') }}/assets/form-masking/inputmask.js"></script>
    <script src="{{ asset('dashboard') }}/assets/form-masking/jquery.inputmask.js"></script>
    <script src="{{ asset('dashboard') }}/assets/form-masking/autoNumeric.js"></script>
    <script src="{{ asset('dashboard') }}/assets/form-masking/form-mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    {{-- card add item js --}}
    <script>

        function updateCartData()
        {
        $.ajax({
        url: "{{ route('dealer.get_cart_item') }}",
        method: "GET",  // Corrected the method to "GET"
        success: function(res) {
                console.log(res);
                if (res.status === 'success') {
                    var count = res.count;
                    console.log(count);
                    $('#cart-count').text(count);
                    $('#invoice-section').html(res.data);  // Use .html() to replace the content
                }
                if(res.count == 0)
                {
                    $('.checkInvoiceNull').prop('disabled', true);
                }
            },
            error: function(err) {
                console.error(err);
            }
        });
        }
        $(document).ready(function () {
        updateCartData();

        });
        </script>



        {{-- card add item js --}}
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










        $(document).ready(function(){

            $(document).on('click','.deleteCart',function(){

                var clickedButton = $(this);
            var id = clickedButton.data('id');
               $.ajax({
                url: "{{ route('dealer.cart.data.delete')}}",
                method: "post",
                data: { id: id},
                success: function(res){
                  if(res.status == 'success')
                  {
                    toastr.success(res.message,{ timeOut: 1000 });
                    clickedButton.closest('tr').remove();
                    updateCartData();
                  }
                }


               });


            });



            $(document).on('click', '.clearAllBtn', function () {
                $.ajax({
                    url: "{{ route('dealer.cart.deleteAll') }}", // Updated route name
                    method: "post",
                    data: {}, // No need to send any specific data for deleting all items
                    success: function (res) {
                        console.log(res);
                        if (res.status == 'success') {
                            toastr.success(res.message, { timeOut: 1000 });
                            // Remove all rows from the cart table or update your UI accordingly
                            $('.cart-table tbody tr').remove();
                            updateCartData();
                        }
                    }
                });
            });



        });

        </script>




        <script>
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



    <script>
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


    @stack('page_js')
</body>

</html>
