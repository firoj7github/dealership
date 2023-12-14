


<div class="compare-table">

</div>


<div class="row">




    <!-- Sorting Filters -->
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <div class="clearfix"></div>
        <div class="listingTopFilterBar">
            <div class="col-md-7 col-xs-12 col-sm-7 no-padding">
                <ul class="filterAdType">
                    <li class="active"><a href="">All ads <small>({{ $totalCount }})</small></a> </li>
                    <li class=""><a href="">Featured <small>({{ $totalIsFeature }})</small></a> </li>
                </ul>
            </div>
            <div class="col-md-5 col-xs-12 col-sm-5 no-padding">
                <div class="header-listing">
                    <h6>Sort by :</h6>
                    <div class="custom-select-box">
                        <select name="order" class="custom-select">
                            <option value="0">Most popular</option>
                            <option value="1">The latest</option>
                            <option value="2">The best rating</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sorting Filters End-->


    <div class="clearfix"></div>
    <!-- Ads Archive -->
    <div class="grid-style-2 ">
        <div class="posts-masonry">

            @forelse($inventories as $inventory)
            <div class="ads-list-archive ">
                <!-- Image Block -->
                <div class="col-lg-5  col-md-5 col-sm-5">
                    <!-- Img Block -->
                    @php
                        $modifiedBodyString = str_replace(' ', '+', $inventory->body);
                        $url_id = $inventory->year.'-'.$inventory->make.'-'.$inventory->model.'-'.$modifiedBodyString.'-'.$inventory->stock;
                    @endphp
                    <div class="ad-archive-img">
                        <a href="{{ route('auto.details',['vin' =>$inventory->vin, 'id' => $url_id]) }}">
                            <img class="img-responsive" src="{{ $inventory->image }}" alt="Local Cars">
                        </a>
                    </div>
                    <!-- Img Block -->
                </div>
                <!-- Ads Listing -->
                <div class="clearfix visible-xs-block"></div>
                <!-- Content Block -->
                <div class="col-lg-7 col-md-7 col-sm-7 no-padding ">
                    <!-- Ad Desc -->
                    <div class="ad-archive-desc">
                        <!-- Price -->
                        {{--<img alt="" class="pull-right"
                        src="{{asset('frontend/images/certified.png')}}">--}}
                        <!-- Title -->
                        @if($inventory->user->package && $inventory->is_feature == 1)
                             <img width="71px" class="pac-image"  src="{{asset('frontend/images/package4.png')}}" alt="Feature">
                        @endif
                        <h3><a class="car-title" href="{{ route('auto.details',['vin' =>$inventory->vin, 'id' => $url_id]) }}"
                                id="inventory_title">{{ $inventory->title }}</a>
                        </h3>


                        <!-- Category -->
                        <div class="category-title"> <span>
                                <h4><strong style="color:black">{{ $inventory->dealers->dealer_name }}
                                    </strong> </h4>
                            </span>
                            <i class="fa fa-map-marker" style="color:black"></i>
                            <a href="#" style="color:black">{{ $inventory->dealers->dealer_city }}, {{ $inventory->dealers->dealer_state }}.</a>
                        </div>
                        <!-- Short Description -->
                        <div class="clearfix visible-xs-block"></div>
                        @php
                        $desc = substr($inventory->description,0,110);
                        @endphp
                        <p class="hidden-sm">{{ $desc }}...</p>
                        <!-- Ad Features -->
                        <ul class="short-meta list-inline">
                            <li>
                                <i class="flaticon-dashboard" title="Mileage"></i>
                                <strong style="color:black"> &nbsp; {{ $inventory->miles_formate }} miles</strong>
                            </li>
                            <li>
                                <i class="flaticon-gas-station-1" title="Fuel"></i> &nbsp; {{ $inventory->fuel }}
                            </li>
                            <li>
                                <i class="flaticon-key" title="Transmission"> </i>&nbsp; {{ $inventory->transmission }}
                            </li>
                            <li>
                                <i class="flaticon-engine-2" title="Engine"></i> &nbsp; {{ $inventory->engine_description_formate }}
                            </li>
                            <li>
                                <i class="flaticon-car-2" title="Drive Train"></i>&nbsp;{{ $inventory->drive_train }}
                            </li>
                            <li>
                                <i class="flaticon-car-2" title="Body"></i>&nbsp;{{ $inventory->body_formated }}
                            </li>
                        </ul>
                        <!-- Ad History -->
                        <div class="ad-price-simple">{{ $inventory->price_formate }}
                            <small class="payment-price_auto"><sup class="doller-info">$</sup>{{ $inventory->payment_price }}/ {{'mo*'}}</small></div>
                        <div class="clearfix archive-history">
                            @php
                            $dato_formate = \Carbon\Carbon::parse($inventory->date_in_stock);
                            @endphp
                            <div  class="last-updated" style="color:black">Last Updated:
                                {{ $dato_formate->diffForHumans() }}</div>

                                <a href="javascript:void(0);"
                                data-id="{{ $inventory->id }}"
                                class="compare_listing"
                                ><i style="margin-left: 10px" class="fa fa-compress "></i></a>
                            <div class="ad-meta">
                                @php
                                $countWishList = 0;
                                @endphp

                                @php
                                $countWishList = 0;
                                if (session()->has('favourite')) {
                                    $favourites = session('favourite');
                                    foreach ($favourites as $favorite) {
                                        if ($favorite['id'] == $inventory->id) {
                                            $countWishList = 1;
                                            break; // No need to continue the loop if found
                                        }
                                    }
                                }
                                @endphp




                                <a href="javascript:void(0);" class="update_wishlist"
                                    data-productid="{{ $inventory->id }}">
                                    @if($countWishList > 0)
                                    <i class="fa fa-heart btn save-ad" id="wishlist-icon" title="Wishlist"
                                        style="color:red">&nbsp;Save Fav.</i>
                                    @else
                                    <i class="fa fa-heart-o btn save-ad" id="wishlist-icon" title="Wishlist">&nbsp;Save
                                        Fav.</i>
                                    @endif
                                </a>

                                <a class="btn btn-success check_availability" data-inventoryid="{{ $inventory->id }}">
                                    Check Availability</a>
                            </div>
                        </div>
                    </div>
                    <!-- Ad Desc End -->
                </div>
                <!-- Content Block End -->
            </div>
            @empty
            @endforelse
        </div>
    </div>
    {{-- check activity modal start --}}
    <!-- Modal -->
    <div class="modal fade" id="leadModalone_TWO" tabindex="-1" aria-labelledby="exampleModalLabel0" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel0">MESSAGE SELLER</h3>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    @if (session()->has('message'))
                    <div class="text-success">
                        <h3>{{ session()->get('message') }}</h3>
                    </div>
                    @endif
                    @php
                    $user = auth()->user();
                    @endphp
                    @if(isset($inventory))
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 p-4">
                                <form id="lead_store" action="{{ route('lead.store')}}" method="POST" style="background-color: #d6d6d6">
                                    @csrf
                                    <div class="container-fluid">
                                        <input type="hidden" class="tmp_inventories_id" name="tmp_inventories_id"
                                            value="{{ $inventory->id}}">
                                        <input type="hidden"  name="user_id"
                                            value="{{ $inventory->user_id}}">
                                        <input type="hidden" class="vichele_name" name="vichele_name"
                                            value="{{ $inventory->title}}">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12 " style="margin-top:20px">
                                                <div class="form-group ">

                                                    <input placeholder="First Name*" class="form-control fname"
                                                        type="text" name="first_name"
                                                        value="{{ ($user ? $user->fname : old('first_name'))}}">
                                                    <span id="first_name_error" class="text-danger" role="alert"></span>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12 " style="margin-top:20px">
                                                <div class="form-group ">

                                                    <input placeholder="Last Name*" class="form-control lname"
                                                        type="text" name="last_name"
                                                        value="{{ ($user ? $user->lname : old('last_name'))}}">

                                                        <span id="last_name_error" class="text-danger" role="alert"></span>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                <div class="form-group ">

                                                    <input placeholder="E-mail*" class="form-control email" type="text"
                                                        name="email" value="{{ ($user ? $user->email : old('email'))}}">

                                                        <span id="email_error" class="text-danger" role="alert"></span>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                <div class="form-group ">

                                                    <input class="form-control phone telephoneInput" type="text"
                                                    placeholder="cell"
                                                        name="phone" value="{{ ($user ? $user->phone : old('phone'))}}">

                                                        <span id="phone_error" class="text-danger" role="alert"></span>

                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                <div class="form-group ">
                                                    <textarea id="w3review" class="form-control description"
                                                        name="description" rows="4" cols="55">I am interested and want to know more about the {{ $inventory->title }} Sport Utility, you have listed for $ {{ $inventory->price }} on Localcarz.
                                                                        </textarea>

                                                        <span id="description_error" class="text-danger" role="alert"></span>

                                                </div>

                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                <div class="form-group ">
                                                    <div style="text-align: center" class="captcha">
                                                        <span>{!! captcha_img() !!}</span>
                                                        <button style="margin-left:7px; border-radius:7px" type="button" class="btn btn-danger reload" id="reload">&#x21bb</button>

                                                    </div>

                                                </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                <div class="form-group">

                                                        <input style="border-radius:6px" class="form-control cap" type="text" name="captcha" placeholder="Enter your captcha">
                                                        <span id="captcha_error" class="text-danger" role="alert"></span>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                <div class="form-group ">
                                                    <p style="color: black"><input type="checkbox" name="ask_trade"
                                                            id="tradeChecked" style="cursor: pointer"> Do you have a
                                                        trade-in?</p>

                                                </div>

                                            </div>



                                            <div class="row" style="margin-left: 0px; margin-right:0px; display:none"
                                                id="Trade_block_content">



                                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                    <div class="form-group ">

                                                        <input placeholder="Year*" class="form-control year_trade"
                                                            type="text" name="year" value="{{old('year')}}">



                                                        </span>

                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                    <div class="form-group ">

                                                        <input placeholder="Make*" class="form-control make_trade"
                                                            type="text" name="make" value="{{ old('make')}}">

                                                        <span class="invalid-feedback7 text-danger" role="alert">

                                                        </span>

                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                    <div class="form-group ">

                                                        <input placeholder="Model*" class="form-control model_trade"
                                                            type="text" name="model" value="{{old('model')}}">

                                                        <span class="invalid-feedback8 text-danger" role="alert"></span>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                    <div class="form-group ">

                                                        <input placeholder="Mileage*" class="form-control mileage"
                                                            type="text" name="mileage" value="{{ old('mileage')}}">

                                                        <span class="invalid-feedback9 text-danger" role="alert">

                                                        </span>

                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                    <div class="form-group ">

                                                        <input placeholder="Color*" class="form-control color"
                                                            type="text" name="color" value="{{ old('color')}}">

                                                        <span class="invalid-feedback10 text-danger" role="alert">
                                                        </span>

                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                    <div class="form-group ">
                                                        <input placeholder="VIN (optional)" class="form-control vin"
                                                            type="text" name="vin" value="{{ old('vin')}}">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                <div class="form-group ">
                                                    <p style="color: black"><input type="checkbox" class="isEmailSend"
                                                            name="isEmailSend" style="cursor: pointer" checked> Email
                                                        me
                                                        price
                                                        drops for this vehicle </p>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-theme btn-lg btn-block Send">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- Form -->
                                <p
                                    style="font-size: 12px; line-height: 11px; color: #999; margin-top: 5px;text-align:justify">
                                    By clicking "SEND EMAIL", I
                                    consent to be contacted by localcarz.com and the dealer selling
                                    this car at any telephone number I provide, including, without
                                    limitation, communications sent via text message to my cell
                                    phone or communications sent using an autodialer or prerecorded
                                    message. This acknowledgment constitutes my written consent to
                                    receive such communications. I have read and agree to the Terms
                                    and Conditions of Use and Privacy Policy of localcarz.com. This
                                    site is protected by reCAPTCHA and the Google Privacy Policy and
                                    Terms of Service apply.</p>
                                {{--</div>--}}

                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- check activity modal end --}}
    <!-- Ads Archive End -->
    <div class="clearfix"></div>
    <!-- Pagination -->
    <div class="text-center margin-top-30">
        <ul class="pagination">


        {{-- Previous Page Link --}}
       @if ($inventories->onFirstPage())
            <li class="disabled"><span><i class="fa fa-chevron-left"></i></span></li>
            @else
            <li><a href="{{ $inventories->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a></li>
        @endif

        {{-- Pagination Links --}}
       @foreach ($inventories->getUrlRange(max($inventories->currentPage() - 2, 1),
            min($inventories->currentPage() + 2, $inventories->lastPage())) as $page => $url)
            @if ($page == $inventories->currentPage())
            <li class="active"><a>{{ $page }}</a></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif

        @if ($page < $inventories->lastPage() - 1 && $page == $inventories->currentPage() + 1)
            <li class="disabled"><span>...</span></li>
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($inventories->hasMorePages())
                <li><a href="{{ $inventories->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a></li>
            @else
            <li class="disabled"><span><i class="fa fa-chevron-right"></i></span></li>
            @endif
            </ul>
    </div>

    <!-- Pagination End -->


    {{-- compare modal show start here --}}

<div class="modal fade" class="compareModal" id="compareModal" tabindex="-1" aria-labelledby="exampleModalLabel10" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel10">Comparision</h3>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body compare_body">
            </div>
        </div>
    </div>
</div>


{{-- compare modal show end here --}}


<form action="{{route('compare.view')}}" method="POST" id="compareForm">
@csrf
</form>



</div>

<script>

$(document).ready(function() {
    // Initialize Inputmask
    $('.telephoneInput').inputmask('(999) 999-9999');
  });




$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

$(document).ready(function () {


$('#reload').click(function(){
    url = "{{ route('reload.capcha') }}";
    $.ajax({
    url: url,
    type:'GET',
    success:function(res){
        // console.log(res);
     $(".captcha span").html(res.captcha);
    }
 });

});



$(".phone_us").keyup(function (e) {
    var value = $(".phone_us").val();
    if (e.key.match(/[0-9]/) == null) {
        value = value.replace(e.key, "");
        $(".phone_us").val(value);
        return;
    }

    if (value.length == 3) {
        $(".phone_us").val(value + "-")
    }
    if (value.length == 7) {
        $(".phone_us").val(value + "-")
    }
});
});







$('.update_wishlist').on('click', function() {
    var inventory_id = $(this).data('productid');
    // var my_id = "{{ Auth::id() }}";
    var url = "{{ route('update.wishlist') }}";
    // if (my_id === "") {
    //     //  alert("Please login first!!");
    //     $('#inventory_id_pass').val(inventory_id);
    //     $('#favourite_add_auth_modal').modal('show');

    // }


    $.ajax({
        url: url,
        type: 'post',
        data: {
            inventory_id: inventory_id,

        },

        success: function(response) {
            var icon = $('#wishlist-icon');

            if (response.action === 'add') {
                $('a[data-productid=' + inventory_id + ']').html(
                    `<i class="fa fa-heart btn save-ad" id="wishlist-icon" title="Wishlist" style="color:red">&nbsp;Save Fav.</i>`
                );
                toastr.success(response.message);
            } else if (response.action === 'remove') {
                $('a[data-productid=' + inventory_id + ']').html(
                    `<i class="fa fa-heart-o btn save-ad" id="wishlist-icon" title="Wishlist" >&nbsp;Save Fav.</i>`
                );
                toastr.error(response.message);
            }
        },
        error: function(error) {
            // Handle error here
        }


    });

});


$('#CheckEmail').on('click', function() {

    var email = $('#email').val();
    $.ajax({
        url: "{{ route('favourte.check.auth') }}",
        type: 'post',
        data: {
            email: email
        },
        success: function(res) {
            if (res.email) {
                $('.error_email').text(res.email);
            }
            if (res.status == 1) {
                $('#replace_html').css('display', 'none');
                $('#login_field').css('display', 'block');
                $('#email_session_one').text(res.email);
                $('.email_session_one').val(res.email);
            }

            if (res.status == 0) {
                $('#rowOne').css('display', 'none');
                $('#rowTwo').css('display', 'block');
                $('#email_session_two').text(res.email);
                $('.email_session_two').val(res.email);

            }



        }
    })
});

$('#login').on('click', function() {
    var password = $('#password').val();
    var inventory_id = $('#inventory_id_pass').val();
    $.ajax({
        url: "{{ route('favourte.auth.login')}}",
        type: 'post',
        data: {
            password: password,
            inventory_id: inventory_id
        },
        success: function(res) {
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
    var inventory_id = $('#inventory_id_pass').val();
    $.ajax({
        url: "{{ route('favourte.auth.signup')}}",
        type: 'post',
        data: {
            email: email,
            password: password,
            inventory_id: inventory_id
        },
        success: function(res) {
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

$('.check_availability').click(function() {


    var temp_id = $(this).data('inventoryid');
    $.ajax({
        url: "{{ route('get_lead_details') }}",
        type: 'GET',
        data: {
            id: temp_id
        },
        success: function(result) {

            var title = result.year + ' ' + result.make + ' ' + result.model + ' ' +
                result.trim;
            var id = result.id;
            var price = result.price;

            $('#tmp_inventories_id').val(id);
            $('#vichele_name').val(title);
            $('#w3review').text('I am interested and want to know more about the ' +
                title +
                ' Sport Utility, you have listed for $ ' + price + ' on Localcarz.');
            $('#leadModalone_TWO').modal('show');
        }
    });
});


// compare listing
$('.compare_listing').on('click', function(){
    let id = $(this).data('id');
    compare_data(id);
});

function compare_data(id)
{
    $.ajax({
    url:"{{route('compare.listing')}}",
    method:"post",
    data:{id:id},
    success: function (res) {

    $('.compare-table').html(res.data);
    if ($(window).width() <= 1000) {
            $('.compare_body').html(res.data);
            $('#compareModal').modal('show');
        }
        toastr.success(res.message);
    },
    error:function(err){
        toastr.err(res.message);
        $('.compare-table').html(res.data);
       if ($(window).width() <= 1000) {
            $('.compare_body').html(res.data);
            $('#compareModal').modal('show');
        }
    }
   });
}

$(document).on('click','#compare_data', function(){
    $('#compareForm').submit();
});











// $('.Send').on('click', function() {

// var first_name = $('.fname').val();
// var last_name = $('.lname').val();
// var captcha = $('.cap').val();
// var email = $('.email').val();
// var phone = $('.phone').val();
// var description = $('.description').val();
// var year = $('.year_trade').val();
// var make = $('.make_trade').val();
// var model = $('.model_trade').val();
// var mileage = $('.mileage').val();
// var color = $('.color').val();
// var vin = $('.vin').val();
// var isEmailSend = $('.isEmailSend').val();
// var vichele_name = $('.vichele_name').val();
// var tmp_inventories_id = $('.tmp_inventories_id').val();
// var user_id = $('.user_id').val();
// if (first_name == '') {
//     $('.invalid-feedback1').text('first name required');
// }
// if (captcha == '') {
//     $('.captcha-error').text('captcha required');
// }
// if (last_name == '') {
//     $('.invalid-feedback2').text('last name required');
// }
// if (email == '') {
//     $('.invalid-feedback3').text('email is required');
// }
// if (phone == '') {
//     $('.invalid-feedback4').text('cell is required');
// }
// if (description == '') {
//     $('.invalid-feedback5').text('description is required');
// }

// $.ajax({
//     url: "{{ route('lead.store')}}",
//     type: 'post',
//     data: {
//         first_name: first_name,
//         last_name: last_name,
//         email: email,
//         phone: phone,
//         description: description,
//         year: year,
//         make: make,
//         model: model,
//         mileage: mileage,
//         color: color,
//         vin: vin,
//         captcha: captcha,
//         isEmailSend: isEmailSend,
//         vichele_name: vichele_name,
//         tmp_inventories_id: tmp_inventories_id,
//         user_id:user_id,

//     },
//     success: function(res) {
//     console.log(res);
//     return;
//         if (res.message) {
//             $('#leadModalone_TWO').modal('hide');
//             toastr.success(res.message);
//         }
//     }

// });


// });

$(document).on('submit', '#lead_store', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        datatype: JSON,
        contentType: false,
        success: function(res) {
         console.log(res);

        if (res.error) {
        if (res.error.first_name) {
            $('#first_name_error').text(res.error.first_name);
        } else {
            $('#first_name_error').text('');
        }

        if (res.error.last_name) {
            $('#last_name_error').text(res.error.last_name);
        } else {
            $('#last_name_error').text('');
        }

        if (res.error.email) {
            $('#email_error').text(res.error.email);
        } else {
            $('#email_error').text('');
        }

        if (res.error.phone) {
            $('#phone_error').text(res.error.phone);
        } else {
            $('#phone_error').text('');
        }

        if (res.error.description) {
            $('#description_error').text(res.error.description);
        } else {
            $('#description_error').text('');
        }
        if (res.error.captcha) {
            $('#captcha_error').text(res.error.captcha);
        } else {
            $('#captcha_error').text('');
        }
    }

    if (res.status === 'success') {
        $('#leadModalone_TWO').modal('hide');
        toastr.success(res.message);
    }
},
        error: function(err) {
            // Your existing error handling code
        }
    });
});


</script>
