<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib" />

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

            @include('layouts.topbar')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    @include('layouts.navbar')

                    <div class="pcoded-content">
                        @yield('content')
                    </div>

                    <div id="styleSelector">
                    </div>

                </div>
            </div>
        </div>
    </div>




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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showNotification(type, message) {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 3000,
            };

            toastr[type](message);
        }





        // $(document).on('click', '.adiiifLead', function () {
        //     alert('ok');
        // });

        function updateCartData() {
            $.ajax({
                url: "{{ route('admin.get_cart_item') }}",
                method: "GET", // Corrected the method to "GET"
                success: function(res) {
                    console.log(res);
                    if (res.status === 'success') {
                        var count = res.count;
                        console.log(count);
                        $('#cart-count').text(count);
                        $('#invoice-section').html(res.data); // Use .html() to replace the content
                    }
                    if (res.count == 0) {
                        $('.checkInvoiceNull').prop('disabled', true);
                    }
                },
                error: function(err) {
                    console.error(err);
                }
            });
        }
        $(document).ready(function() {
            updateCartData();

        });
    </script>



    {{-- card add item js --}}
    <script type="text/javascript">
        let cartContent = document.getElementById("cart-content");
        let content = document.getElementById("invoice-section");
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


            $('#reload').click(function(){

            $.ajax({
            url:'reload-capta',
            type:'GET',
            success:function(res){
                // console.log(res);
            $(".captcha span").html(res.captcha);
            }
            });

            });



            // $.ajaxSetup({
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            $(document).on('click', '.deleteCart', function(e) {
                e.preventDefault();

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
                            toastr.success(res.message, {
                                timeOut: 1000
                            });
                            clickedButton.closest('tr').remove();
                            updateCartData();
                        }
                    }


                });


            });

            $(document).on('click', '.clearAllBtn', function() {
                $.ajax({
                    url: "{{ route('admin.cart.deleteAll') }}", // Updated route name
                    method: "post",
                    data: {}, // No need to send any specific data for deleting all items
                    success: function(res) {
                        console.log(res);
                        if (res.status == 'success') {
                            toastr.success(res.message, {
                                timeOut: 1000
                            });
                            // Remove all rows from the cart table or update your UI accordingly
                            $('.cart-table tbody tr').remove();
                            updateCartData();
                        }
                    }
                });
            });

            $(document).on('click', '.adfLead', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var inventory = $(this).data('inventory');
                var customer = $(this).data('customer');
                var url = "{{ route('email.send.adflead') }}";

                // console.log(`Clicked Element: id=${id}, inventory=${inventory}, customer=${customer}, url=${url}`);

                $.ajax({
                    url: url,
                    type: "post",
                    data: {
                        id: id,
                        inventory: inventory,
                        customer: customer
                    },
                    success: function(res) {
                        console.log(res);
                        toastr.success(res.message);
                        // console.log("AJAX Success:", res);
                        // Handle the success response as needed
                    },
                    error: function(error) {
                        console.error("AJAX Error:", error);
                        // Handle the error response or log it for debugging
                    }
                });
            });

        });


        $(document).on('click', '.send_email', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.email_lead.send') }}",
                method: "post",
                data: {
                    id: id
                },
                success: function(res) {
                    console.log(res);

                    if (res.status == 'success') {
                        toastr.success(res.message);

                    }
                }


            });
        });
    </script>
    @stack('delear_JS')

</body>

</html>
