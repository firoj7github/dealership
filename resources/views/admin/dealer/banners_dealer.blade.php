@extends('layouts.app')

@push('css')
    <style>
        .divide {
            height: 2px;
            width: 100%;
            background-color: #ddd;
            margin: 30px 0px;
        }

        .map-container {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-container iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }

        .table-responsive {
            overflow-x: visible;
        }

        .details-row {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="page-content-tab">

        <div class="container-fluid" id="contentToConvert">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3>
                                        @isset($user->username)
                                        '{{$user->username }}' Account Details
                                    @endisset</h3>

                                </div>
                                <div class="col-md-8 text-right">
                                    <a href="{{ route('admin.dealer.account-edit', $user->id) }}" class=" btn btn-primary"><i
                                            class="fa fa-edit"></i> Edit Account</a>
                                    <a href="#" class=" btn btn-danger"> <i class="fa fa-delete-left"></i> Remove
                                        Account</a>
                                    <a href="{{ route('dealer.management') }}" class=" btn btn-dark"><i
                                            class="fa fa-list"></i> All Account</a>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <a href="{{ route('admin.user.information', $user->id) }}"
                                     class="btn btn-small btn-primary text-white">Account Information<a>
                                  <a href="{{ route('admin.dealer.listing', $user->id) }}"
                                      class="btn btn-small btn-primary text-white">Listing<a>
                                  <a href="#" class="btn btn-small btn-info text-white">Leads<a>
                                  <a href="{{ route('admin.dealer.banner', $user->id)}}" class="btn btn-small btn-success text-white">Banners<a>
                                  <a href="{{ route('admin.dealer.slider', $user->id)}}" class="btn btn-small btn-success text-white">Sliders<a>
                                  <a href="#" class="btn btn-small btn-primary text-white">Archived<a>
                                  <a href="{{ route('admin.dealer.invoice', $user->id) }}"
                                      class="btn btn-small btn-secondary text-white">Invoice<a>
                                      </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table  table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th> <input type="checkbox"
                                                id="checkAll" /> All</th>

                                            <th></th>
                                            <th style="font-size:14px;">S.N</th>
                                            <th style="font-size:14px;">Title</th>
                                            <th style="font-size:14px;">Dealer</th>
                                            <th style="font-size:14px;">Position
                                            </th>
                                            <th style="font-size:14px;">
                                                Renew
                                            </th>
                                            <th style="font-size:14px;">Start Date</th>
                                            <th style="font-size:14px;">End Date</th>
                                            <th style="font-size:14px;">Status</th>
                                            <th style="font-size:14px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($banners as $banner)
                                            <tr>
                                                <td>
                                                    <input type="checkbox"
                                                        class="check-row"
                                                        data-id="{{ $banner->id }}">
                                                </td>
                                                <td>
                                                    <a href="#" class="toggle-details"><i
                                                            class="fa-solid fa-circle-plus"></i></a>

                                                </td>



                                                <td class="fs-6">
                                                    {{ $loop->iteration }}</td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{ $banner->name }}</td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    Skco Automotive</td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{$banner->position }}
                                                </td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{$banner->renew }}
                                                </td>
                                                <td>{{ $banner->start_date }}</td>
                                                <td>{{ $banner->end_date }}</td>
                                                {{-- @php
                                                        $carbonDate_active = \Carbon\Carbon::parse($inventory->active_till);
                                                        $carbonDate_featured = \Carbon\Carbon::parse($inventory->featured_till);

                                                        // Format the date as 'm-d-Y'
                                                        $active_till = $carbonDate_active->format('m-d-Y');
                                                        $featured_till = $carbonDate_featured->format('m-d-Y');
                                                    @endphp --}}
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    <select
                                                        class="form-control {{ $banner->status == 1 ? 'bg-success' : '' }} banner_activeInactive"
                                                        data-id="{{ $banner->id }}">
                                                        <option {{ $banner->status == 1 ? 'selected' : '' }} value="1">Active
                                                        </option>
                                                        <option {{ $banner->status == 0 ? 'selected' : '' }} value="0">Inactive
                                                        </option>
                                                    </select>
                                                </td>


                                                <td>
                                                    <a data-bs-toggle="modal" data-bs-target="#BannerEdit"
                                                    data-id="{{ $banner->id }}" data-name="{{ $banner->name }}"
                                                    data-start_date="{{ $banner->start_date }}"
                                                    data-end_date="{{ $banner->end_date }}"
                                                    data-status="{{ $banner->status }}" data-payment="{{ $banner->payment }}"
                                                    data-renew="{{ $banner->renew }}" data-position="{{ $banner->position }}" data-description="{{ $banner->description }}"
                                                    data-user_id="{{$user->id }}"
                                                    {{-- data-user_id="{{$banner->user_id}}" --}} class="btn btn-sm btn-success edit_banner_form text-white"><i class="fa fa-edit"></i>
                                                </a>


                                                <a class="btn btn-warning btn-sm  delete_banner text-white"
                                                    data-id="{{ $banner->id }}" title="Archive"><i class="fa fa-delete-left"></i></a>

                                                <a class="btn btn-danger btn-sm delete_permanent_banner text-white"
                                                    data-id="{{ $banner->id }}" title="Delete"><i class="fa fa-trash"></i></a>
                                                </td>


                                            </tr>

                                            <tr class="details-row">

                                                <td colspan="11">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <img alt="Local Cars" src="{{asset('/dashboard')}}/images/banners/{{$banner->image}}"
                                                                        class="card-image rounded" width="100%"
                                                                        height="220px">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                </td>


                                            </tr>
                                        @endforeach




                                    </tbody>

                                </table>

                                <div class="col-md-3 mt-4">

                                    <select name="packagePlan" id="selectPlan" class="form-control" style="width: 50%; display:inline;font-size:12px">
                                        <option value="">Select Action</option>
                                        <option value="0">Make Free</option>
                                        <option value="1">Make Featured</option>
                                        <option value="2">Make Premium</option>
                                    </select>
                                    <button class="btn btn-small btn-primary" style="font-size:12px;color:white" id="submit_action">Go</button>

                                </div>
                                <div class="col-md-9 float-right">
                                <div class="custom-pagination" style="display: flex; justify-content: flex-end">
                                    <ul class="pagination">
                                        @if ($banners->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link">Previous</span>
                                            </li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $banners->previousPageUrl() }}">Previous</a>
                                            </li>
                                        @endif

                                        @php
                                            $currentPage = $banners->currentPage();
                                            $lastPage = $banners->lastPage();
                                            $maxPagesToShow = 5; // Adjust this number to determine how many page links to display
                                            $startPage = max($currentPage - floor($maxPagesToShow / 2), 1);
                                            $endPage = min($startPage + $maxPagesToShow - 1, $lastPage);
                                        @endphp

                                        @if ($startPage > 1)
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $banners->url(1) }}">1</a>
                                            </li>
                                            @if ($startPage > 2)
                                                <li class="page-item disabled">
                                                    <span class="page-link">...</span>
                                                </li>
                                            @endif
                                        @endif

                                        @for ($page = $startPage; $page <= $endPage; $page++)
                                            @if ($page == $currentPage)
                                                <li class="page-item active"><span
                                                        class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $banners->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endfor

                                        @if ($endPage < $lastPage)
                                            @if ($endPage < $lastPage - 1)
                                                <li class="page-item disabled">
                                                    <span class="page-link">...</span>
                                                </li>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $banners->url($lastPage) }}">{{ $lastPage }}</a>
                                            </li>
                                        @endif

                                        @if ($banners->hasMorePages())
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $banners->nextPageUrl() }}">Next</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link">Next</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    {{-- banner create modal close --}}

    {{-- banner edit modal start --}}
    <!-- Modal -->
    <div class="modal fade" id="BannerEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Banner Update</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.banner.edit') }}" method="POST" id="bannerupdate"
                        enctype="multipart/form-data" style="background-color:#ddd;padding:20px">
                        @csrf
                        <input type="hidden" name="banner_id" id="banner_id">
                        <div class="row">
                            <div class="col-md-6 text-center">


                                <table align="center" cellpadding="10">

                                    <tr>
                                        <td>Banner Name<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="text" name="up_name" id="up_name" placeholder="banner name"
                                                class="form-control">

                                            <input type="hidden" id="dealer_id" name="dealer_id"/>
                                            <div class="text-danger error-up_name"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Start Date</td>
                                        <td>
                                            <input type="date" id="up_start_date" name="up_start_date"
                                                class="form-control">
                                                <div class="text-danger error-up_start_date"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>End Date</td>
                                        <td>
                                            <input type="date" id="up_end_date" name="up_end_date" class="form-control">
                                            <div class="text-danger error-up_end_date"  style="float: left;"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Banner Position<span style="color:red;font-weight:bold">*</span> </td>
                                        <td>
                                            <select id="up_position" name="up_position" class="form-control"
                                                onchange="updatepositionChange(this.value)">
                                                <option value="">~ select position ~</option>
                                                <option value="left_sidebar">Left Sidebar</option>
                                                <option value="Right_sidebar">Right Sidebar</option>
                                                <option value="top">Top</option>
                                                <option value="bottom">Bottom</option>
                                                <option value="middle">Middle</option>
                                                <option value="header_banner">Header Banner</option>
                                            </select>
                                            <div class="text-danger error-up_position"  style="float: left;"></div>
                                        </td>
                                    </tr>

                                    <tr>


                                        <td>Banner Image</td>
                                        <td>
                                            <p style=" margin-top:7px;" id="recomanded">
                                            <p></label>
                                                <input type="file" name="up_image" id="up_image"
                                                    class="form-control" id="imageInput" accept="image/*" disabled>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                        <img src="" alt="Image Preview" id="imagePreview"
                                            style="display:none; max-width: 300px; max-height: 300px;margin-top:10px">
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6 text-center">

                                <table align="center" cellpadding="10">

                                    <tr>
                                        <td>Status <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="up_status" name="up_status" name="account_type"
                                                class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <div class="text-danger error-up_status"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payment <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="up_payment" name="up_payment" name="account_type"
                                                class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Success</option>
                                                <option value="0">Pending</option>
                                            </select>
                                            <div class="text-danger error-up_payment"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Renew <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select name="up_renew" id="up_renew" class="form-control">
                                                <option value="">~ select State ~</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <div class="text-danger error-up_renew"  style="float: left;"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Description <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                           <textarea name="up_description" id="up_description" class="form-control" ></textarea>
                                            <div class="text-danger error-up_description"  style="float: left;"></div>
                                        </td>
                                    </tr>

                                </table>
                                <button style="padding-left:22px; padding-right:22px; margin-left:183px; margin-top:10px"
                                    class="btn btn-success " type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- slide edit modal close --}}

@endsection
@push('delear_JS')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //banner table ajax
           // image show when image insert
    $(document).ready(function () {
        // When the file input changes
        $(".image").change(function () {
            readURL(this);
        });

        // Function to read the URL and display the image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // Display the image preview
                    $("#imagePreview").attr("src", e.target.result).show().css({ "height": "100px", "width": "100px" });

                };

                // Read the file as a data URL
                reader.readAsDataURL(input.files[0]);
            }
        }
    });


        function positionChange(value) {

            // console.log(value);
            if (value == 'left_sidebar') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info">
                                                    </i>Recommended: 50x300 px`;

            }
            if (value == 'Right_sidebar') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 50x300 px`;

            }
            if (value == 'top') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 1000x100 px`;

            }
            if (value == 'Bottom') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 1000x100 px`;

            }
            if (value == 'middle') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 500x80 px`;

            }
            if (value == 'header_banner') {

                var element = document.getElementById('image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 800x80 px`;

            }


            if(value == '')
            {
                console.log('hello');
                var element = document.getElementById('image');

                // Remove an attribute, for example, the 'disabled' attribute
                element.setAttribute('disabled','disabled');
            }

        }
        function updatepositionChange(value) {

            // console.log(value);
            if (value == 'left_sidebar') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info">
                                                    </i>Recommended: 50x300 px`;

            }
            if (value == 'Right_sidebar') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 50x300 px`;

            }
            if (value == 'top') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 1000x100 px`;

            }
            if (value == 'Bottom') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 1000x100 px`;

            }
            if (value == 'middle') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 500x80 px`;

            }
            if (value == 'header_banner') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML=`<i style="margin-right:7px"
                                                    class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 800x80 px`;

            }


            if(value == '')
            {
                console.log('hello');
                var element = document.getElementById('up_image');

                // Remove an attribute, for example, the 'disabled' attribute
                element.setAttribute('disabled','disabled');
            }

        }
        $(document).ready(function() {


// update banner data
$('.edit_banner_form').on('click', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    let name = $(this).data('name');
    let position = $(this).data('position');
    let start_date = $(this).data('start_date');
    let end_date = $(this).data('end_date');
    let status = $(this).data('status');
    let dealer_id = $(this).data('user_id');
    let payment = $(this).data('payment');
    let renew = $(this).data('renew');
    let description = $(this).data('description');

    $('#banner_id').val(id);
    $('#up_name').val(name);
    $('#up_position').val(position);
    $('#up_start_date').val(start_date);
    $('#up_end_date').val(end_date);
    $('#up_payment').val(payment);
    $('#up_status').val(status);
    $('#dealer_id').val(dealer_id);
    $('#up_renew').val(renew);
    $('#up_description').text(description);

});

$('#bannerupdate').submit(function(e) {
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

            var errors = res.errors;
            if(errors)
            {
                $.each(errors, function(index,error) {

                    $('.error-' + index).text(error);

                });
            }else if(res.status == 'success')
            {

                $('.edit_banner_form').modal('hide');
                toastr.success('Banner update successfully');
                window.location.reload();

            }
        },
        error: function(error) {
            console.log(error);
        }

    });
});


// banner payment status change
$('.banner_payment').on('change', function() {
    var id = $(this).data('id');
    var payment = $(this).val();
    $.ajax({
        url: "{{ route('payment.update') }}",
        type: 'PATCH',
        data: {
            payment,
            id
        },
        success: function(res) {
            if (res.status == "success") {
                $('.table').load(location.href + ' .table');
                location.reload();
            }

        },
    });
});



$('.delete_banner').on('click', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    $.confirm({
        title: 'Archive Confirmation',
        content: 'Are you sure?',
        buttons: {
            cancel: {
                text: 'No',
                btnClass: 'btn-primary',
                action: function() {
                    // Do nothing on cancel
                }
            },
            confirm: {
                text: 'Yes',
                btnClass: 'btn-danger',
                action: function() {
                    $.ajax({
                        url: "{{ route('admin.banner.delete') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            // Show Toastr success message
                        if (res.status == "success") {
                           toastr.success('Archived Successfully');
                            window.location.reload();
                        }
                        },
                        error: function(error) {
                            // Show Toastr error message
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }
            },

        }
    });

});

//permanent delete  banner ajax
$('.delete_permanent_banner').on('click', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    $.confirm({
        title: 'Delete Confirmation',
        content: 'Are you sure?',
        buttons: {
            cancel: {
                text: 'No',
                btnClass: 'btn-primary',
                action: function() {
                    // Do nothing on cancel
                }
            },
            confirm: {
                text: 'Yes',
                btnClass: 'btn-danger',
                action: function() {
                    $.ajax({
                        url: "{{ route('admin.banner.permanent.delete') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            // Show Toastr success message
                            if (res.status == "success") {
                                toastr.success('Delete Successfully');
                                window.location.reload();
                        }
                        },
                        error: function(error) {
                            // Show Toastr error message
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }
            },

        }
    });

});

// banner active inactive
$('.banner_activeInactive').on('change', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    let status = $(this).val();
    $.ajax({
        type: 'POST',
        url: "{{ route('admin.banner.change.status') }}",
        data: {
            id: id,
            status: status
        },
        success: function(res) {
            console.log(res);
            if (res.status == 'success') {
                toastr.success(res.message);
                location.reload();
            }
        },
        error: function(error) {
            console.log(error);
        }

    });


});
});
        //end
        $(document).ready(function() {
            $(".toggle-details").click(function() {
                $(this).closest("tr").next(".details-row").toggle();
            });
        });


        $(document).ready(function() {

            $('.status-select').on('change', function() {
                var id = $(this).data('id');
                var package = $(this).val();

                $.ajax({
                    url: "{{ route('package-add') }}",
                    type: 'PATCH',
                    data: {
                        package: package,
                        id: id
                    },
                    success: function(res) {
                        // Update UI based on the response


                        if (res.status == 'success') {
                            // toastr.success(response.message);
                            // $('.status-select').append('<i class="fa fa-facebook"></i>');
                            $('.table').load(location.href + ' .table');
                            location.reload();


                        }
                    },

                });
            });

            //  Active Inactive Working Ajax

            $('.action-select').on('change', function() {
                var id = $(this).data('id');
                var status = $(this).val();


                $.ajax({
                    url: "{{ route('status-add') }}",
                    type: 'PATCH',
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(res) {
                        // Update UI based on the response


                        if (res.status == 'success') {

                            const message = res.current_status === 1 ? 'Active' : 'Inactive';
                            $('.table').load(location.href + ' .table', () => location
                                .reload());
                            toastr.success(`Status ${message} Successfully`);


                        }
                    },

                });
            });


            // listing display start
            $('.display-select').on('change', function() {
                var id = $(this).data('id');
                var status = $(this).val();
                $.ajax({
                    url: "{{ route('display-status') }}",
                    type: 'PATCH',
                    data: {
                        status,
                        id
                    }, // Shortened object syntax
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {

                            let message = '';
                            if (res.current_display == 1) {
                                message = 'Active';
                            }
                            if (res.current_display == 0) {
                                message = 'Inactive';
                            }
                            if (res.current_display == 2) {
                                message = 'Expired';
                            }
                            if (res.current_display == 3) {
                                message = 'Archived';
                            }
                            if (res.current_display == 4) {
                                message = 'Invalid';
                            }
                            if (res.current_display == 5) {
                                message = 'Blocked';
                            }

                            $('.table').load(location.href + ' .table', () => location
                                .reload());
                            toastr.success(`Visivility ${message} Successfully`);

                        }
                    },
                });
            });

            // listing display end


            // listing delete

            $('.listing_delete').on('click', function() {
                var id = $(this).data('id');

                if (confirm('Are You Sure Want to Archive it? ')) {

                    $.ajax({
                        url: "{{ route('listing.delete') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            // Update UI based on the response
                            if (res.status == 'success') {

                                $('.table').load(location.href + ' .table');
                                location.reload();
                                toastr.success('Inventory Archived Successfully ');


                            }
                        },

                    });

                }



            });





        });


        $(document).ready(function() {
            // Check all checkboxes
            $("#checkAll").change(function() {
                var atLeastOneChecked = $(".check-row:checked").length > 0;
                $(".check-row").prop('checked', $(this).prop("checked"));
                //   $('#go_invoice').prop('disabled', false);

            });

            // Check individual checkbox
            $(".check-row").change(function() {
                var atLeastOneChecked = $(".check-row:checked").length > 0;
                if (!$(this).prop("checked")) {

                    $("#checkAll").prop("checked", false);

                }

            });
        });




    $("#submit_action").click(function() {


        var packagePlan = $('#selectPlan').val();
        var listingCheckedRows = $(".check-row:checked");
        var ListingSelectedData = [];
        listingCheckedRows.each(function() {
            var id = $(this).data("id");
            ListingSelectedData.push(id);
        });


     console.log(ListingSelectedData);
    // Check if no data is available
    if (Object.keys(ListingSelectedData).length === 0) {
        alert('Select at least one item.');
       // Do not proceed with the AJAX request
    }


    $.ajax({
        url: " {{ route('admin.banner.store') }}",
        method: "POST",
        data:{ ListingSelectedData: ListingSelectedData,
            packagePlan: packagePlan,
        },
        success: function(response) {

            if (response.status == 'success') {
                toastr.success(' Add to Invoice Successfully');
                location.reload();
            }
        },

    });
});

    </script>
@endpush
