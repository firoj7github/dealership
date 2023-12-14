@extends('layouts.app')

@push('css')
@endpush



@section('content')
    <div class="row">

        <div class="col-md-11 pt-5 m-auto rounded">
            <div class="card">
                <div class="card-header">

                    <h5>All Banners</h5>


                    <a style="margin-left: 7px" href="{{ route('banner.list') }}"
                        class="btn btn-secondary float-right text-white">
                        <i class="fa fa-list"></i>List of plans
                    </a>
                    <a data-bs-toggle="modal" data-bs-target="#bannerCreate"  class="btn btn-info float-right text-white">
                        <i class="fa-solid fa-plus"></i>Add Banner
                    </a>

                </div>
                <div class="card-block">
                    @if (session()->has('message'))
                        <h3 class="text-success">{{ session()->get('message') }}</h3>
                    @endif
                    <div class="table-responsive dt-responsive">
                        <table id="dom-jqry" class="table table-striped table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width:5%">S.L</th>
                                    <th style="width:20%">Banner Image</th>
                                    <th style="width:15%">Banner Name</th>
                                    <th style="width:10%">Position</th>
                                    <th style="width:10%">Payment</th>
                                    <th style="width:10%">Start Date</th>
                                    <th style="width:10%">End Date</th>
                                    <th style="width:10%">Status</th>
                                    <th style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($banners as $banner)
                                <tr>
                                    <td>1</td>
                                    <td><img src="{{ asset('/dashboard') }}/images/banners/{{ $banner->image }}"
                                            width="25%" alt=""></td>

                                    <td>{{ $banner->name }}</td>
                                    <td>{{ $banner->position }}</td>
                                    <td><select
                                            class=" banner_payment form-control {{ $banner->payment == 1 ? 'bg-success' : '' }}"
                                            data-id="{{ $banner->id }}">
                                            <option value="1" {{ $banner->payment == 1 ? 'selected' : '' }}>Success
                                            </option>
                                            <option value="0" {{ $banner->payment == 0 ? 'selected' : '' }}>Pending
                                            </option>
                                        </select></td>
                                    <td>{{ $banner->start_date }}</td>
                                    <td>{{ $banner->end_date }}</td>


                                    <td>
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
                                            data-user_id="{{ $banner->user_id }}"
                                            {{-- data-user_id="{{$banner->user_id}}" --}} class="btn btn-success edit_banner_form"><i class="fa fa-edit"></i>
                                        </a>


                                        <a class="btn btn-danger delete_banner"
                                            data-id="{{ $banner->id }}" title="Archive"><i class="fa fa-delete-left"></i></a>

                                        <a class="btn btn-danger delete_permanent_banner"
                                            data-id="{{ $banner->id }}" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>


                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="9"><p class="text-center">No Banner Available Now.</p></td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="bannerCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.banner.add') }}" method="post" enctype="multipart/form-data" method="post"
                        style="background-color:#ddd;padding:20px" id="bannerAddForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 text-center">


                                <table align="left" cellpadding="10">

                                    <tr>
                                        <td align="left">Packages<span style="color:red;font-weight:bold">*</span> </td>
                                        <td>
                                            <select id="banner_price" name="banner_price" class="form-control">
                                                <option value="">~ select packages ~</option>
                                                <option value="100">Header Banner - $100</option>
                                                <option value="0">Home Bottom - Free</option>
                                            </select>
                                            <div class="text-danger error-banner_price"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">Banner Name<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="text" name="name" id="name" placeholder="banner name"
                                                class="form-control">
                                                <div class="text-danger error-name"  style="float: left;"></div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td align="left">Banner Position<span style="color:red;font-weight:bold">*</span> </td>
                                        <td>
                                            <select id="position" name="position" class="form-control"
                                                onchange="positionChange(this.value)">
                                                <option value="">~ select position ~</option>
                                                <option value="left_sidebar">Left Sidebar</option>
                                                <option value="Right_sidebar">Right Sidebar</option>
                                                <option value="top">Top</option>
                                                <option value="Bottom">Bottom</option>
                                                <option value="middle">Middle</option>
                                                <option value="header_banner">Header Banner</option>
                                            </select>
                                            <div class="text-danger error-position"  style="float: left;"></div>
                                        </td>
                                    </tr>

                                    <tr>


                                        <td align="left">Banner Image<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <p style=" margin-top:7px;" id="recomanded">
                                            <p></label>
                                                <input type="file" name="image" id="image" class="form-control image" disabled>
                                                <div class="text-danger error-image"  style="float: left;"></div>
                                        </td>
                                    </tr>

                                    <tr>


                                        <td align="left"></td>
                                        <td align="left">
                                            <img src="" alt="Image Preview" id="imagePreview"
                                            class="imgshow" >

                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">Start Date<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="date" name="start_date" class="form-control">
                                            <div class="text-danger error-start_date"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">End Date<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="date" name="end_date" class="form-control">
                                            <div class="text-danger error-end_date"  style="float: left;"></div>
                                        </td>
                                    </tr>



                                </table>
                            </div>
                            <div class="col-md-6 text-center">

                                <table align="center" cellpadding="10">



                                    <tr>
                                        <td align="left">Dealer List <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="user_id"   name="user_id" class="form-control">
                                                <option value="">~ select ~</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                                @endforeach

                                            </select>
                                            <div class="text-danger error-user_id"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    </tr>




                                    <tr>
                                        <td align="left">Status <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="status" name="status" name="account_type" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <div class="text-danger error-status"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">Payment <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="payment" name="payment" name="account_type" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Success</option>
                                                <option value="0">Pending</option>
                                            </select>
                                            <div class="text-danger error-payment"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">Renew <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select name="renew" id="renew" class="form-control">
                                                <option value="">~ select State ~</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <div class="text-danger error-renew"  style="float: left;"></div>
                                        </td>
                                    </tr>

                                </table>

                            </div>


                        </div>


                        <div class="row">
                            <div class="col-md-12" >
                                <table  cellpadding="5">
                                <tr>
                                    <td align="left"> Description<span style="color:red;font-weight:bold">*</span></td>
                                    <td align="left">
                                        <textarea name="description" id="description" placeholder="banner description"
                                            class="form-control" rows="2" cols="65"></textarea>
                                            <div class="text-danger error-description" style="float: left;"></div>
                                    </td>
                                </tr>
                            </table>


                            </div>
                        </div>


                        <button style="padding-left:25px; padding-right:25px; margin-left:81%; margin-top:12px"
                        class="btn btn-success" type="submit">Submit</button>



                    </form>

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
                                            <div class="text-danger error-up_name"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Start Date<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="date" id="up_start_date" name="up_start_date"
                                                class="form-control">
                                                <div class="text-danger error-up_start_date"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>End Date<span style="color:red;font-weight:bold">*</span></td>
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
                                        <td>Dealer List <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="up_dealer_list" name="up_dealer_list" class="form-control">
                                                <option value="">~ select ~</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                                @endforeach

                                            </select>
                                            <div class="text-danger error-up_dealer_list"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    </tr>




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
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });


 // banner add ajax code

$(document).ready(function() {
    $('#bannerAddForm').on('submit',function(event) {
        event.preventDefault(); // Prevent normal form submission

        // Collect form data
        var formData = new FormData($(this)[0]);

        // Send Ajax request
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                var errors = res.errors;
                if(errors)
                {
                    $.each(errors, function(index,error) {

                        $('.error-' + index).text(error);

                    });
                }else if(res.status == 'success')
                {
                    $('#bannerAddForm')[0].reset();
                    $('#bannerCreate').modal('hide');
                    toastr.success('Banner create successfully');
                    window.location.reload();

                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error("Form submission error:", error);
                // You can display an error message or handle the error as needed
            }
        });
    });
});



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
                let dealer_list = $(this).data('dealer_list');
                let payment = $(this).data('payment');
                let renew = $(this).data('renew');
                let description = $(this).data('description');
                let user_id = $(this).data('user_id');
                // let dealer_list = $(this).data('dealer_list');

                $('#banner_id').val(id);
                $('#up_name').val(name);
                $('#up_position').val(position);
                $('#up_start_date').val(start_date);
                $('#up_end_date').val(end_date);
                $('#up_payment').val(payment);
                $('#up_status').val(status);
                // $('#up_dealer_list').val(dealer_list);
                $('#up_renew').val(renew);
                $('#up_dealer_list').val(user_id).attr('selected');
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
                                        $('.table').load(location.href + ' .table');
                                        location.reload();
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
                                        $('.table').load(location.href + ' .table');
                                        location.reload();
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
    </script>
@endpush
