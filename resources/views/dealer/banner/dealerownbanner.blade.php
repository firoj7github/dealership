@extends('dealer.layouts.app')

@section('title', 'Banner List | ')

@section('content')

<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header adding">

                <h5>Dealer Banner</h5>


                <a data-bs-toggle="modal" data-bs-target="#bannerCreate" class="btn btn-info float-right text-white">
                    <i class="fa-solid fa-plus"></i>Add Banner
                </a>




            </div>
            <div class="card-block">
                @if (session()->has('message'))
                    <h3 class="text-success">{{ session()->get('message') }}</h3>
                @endif
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table banner_table table-striped table-bordered nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width:5%">S.L</th>
                                <th style="width:20%">Banner Image</th>
                                <th style="width:15%">Banner Name</th>
                                <th style="width:15%">Position</th>
                                <th style="width:10%">Start Date</th>
                                <th style="width:10%">End Date</th>
                                <th style="width:10%">Payment</th>
                                <th style="width:10%">Status</th>



                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @foreach ($banners as $key=>$banner)








                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <img src="{{asset('/dashboard')}}/images/banners/{{$banner->image}}" width="25%" alt="Banner Image">
                                    </td>

                                    <td>{{$banner->name}}</td>
                                    <td>{{$banner->position}}</td>
                                    @if (!empty($banner->start_date))
                                    <td>{{$banner->start_date}}</td>
                                    @else
                                    <td>null</td>
                                    @endif

                                    @if (!empty($banner->end_date))
                                    <td>{{$banner->end_date}}</td>
                                    @else
                                    <td>null</td>
                                    @endif

                                    <td><select class=" banner_payment form-control {{$banner->payment==1 ?'bg-success':''}}"
                                        data-id="{{$banner->id}}"
                                        >
                                        <option value="1" {{$banner->payment==1 ?'selected':''}}>Success</option>
                                        <option value="0" {{$banner->payment==0 ?'selected':''}}>Pending</option>
                                        </select></td>

                                        <td><select class="banner_active form-control

                                            {{$banner->status==1?'bg-success':''}}"
                                            data-id="{{$banner->id}}"
                                            >
                                            <option value="1" {{$banner->status==1 ?'selected':''}}>Active</option>
                                            <option value="0" {{$banner->status==0 ?'selected':''}}>Inactive</option>
                                            </select></td>





                                    <td>

                                        <a data-bs-toggle="modal" data-bs-target="#BannerEdit"
                                        data-id="{{ $banner->id }}"
                                        data-name="{{ $banner->name }}"
                                        data-banner_price="{{ $banner->banner_price }}"
                                        data-status="{{ $banner->status }}"
                                        data-renew="{{ $banner->renew }}"
                                        data-position="{{ $banner->position }}"


                                        class="btn btn-success update_banner_form" >Edit
                                        </a>


                                        <a class="btn btn-danger delete_banner"
                                         data-id="{{$banner->id}}"
                                        >Delete</a>
                                    </td>


                                </tr>

                                @endforeach --}}


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- banner create modal start --}}
    <!-- Modal -->
    <div class="modal  fade" id="bannerCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Banner Add</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">

                    <form id="banneradd" action="{{ route('banner.add') }}" enctype="multipart/form-data" method="post"
                    style="background-color:#ddd;padding:20px">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 text-center">


                            <table align="center" cellpadding="10">

                                <tr>
                                    <td>Packages<span style="color:red;font-weight:bold">*</span> </td>
                                    <td>
                                        <select id="banner_price" name="banner_price" class="form-control">
                                            <option value="">~ select packages ~</option>
                                            <option value="100">Header Banner - $100</option>
                                            <option value="">Home Bottom - Free</option>



                                        </select>
                                        <span class="text-danger" id="banner_price_error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Banner Name<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="text" name="name" id="name" placeholder="banner name"
                                            class="form-control">
                                            <span class="text-danger" id="banner_name_error"></span>
                                    </td>
                                </tr>


                                <tr>
                                    <td>Banner Position<span style="color:red;font-weight:bold">*</span> </td>
                                    <td>
                                        <select id="position" name="position" class="form-control"
                                            onchange="createPositionChange(this.value)">
                                            <option value="">~ select position ~</option>
                                            <option value="left_sidebar">Left Sidebar</option>
                                            <option value="Right_sidebar">Right Sidebar</option>
                                            <option value="top">Top</option>
                                            <option value="Bottom">Bottom</option>
                                            <option value="middle">Middle</option>


                                            <option value="header_banner">Header Banner</option>
                                        </select>
                                        <span class="text-danger" id="banner_position_error"></span>
                                    </td>
                                </tr>

                                <tr>


                                    <td>Banner Image<span style="color:red;font-weight:bold">*</span></td>
                                    <td class="p-0 m-0">
                                        <p style=" margin-top:7px;" id="recomanded">
                                        <p></label>
                                            <input type="file" name="image" id="image" class="form-control"
                                                disabled>
                                                <span class="text-danger" id="image_error_add"></span>


                                    </td>
                                </tr>
                                <tr class="p-0 m-0">


                                    <td></td>
                                    <td class="p-0 m-0">
                                        <img src="" alt="Image Preview" id="addImagePreview"
                                                    style="display:none;max-width: 150px; max-height: 150px;padding:0px !important; border-radius:5px">


                                    </td>
                                </tr>




                            </table>
                        </div>
                        <div class="col-md-6 text-center">

                            <table align="center" cellpadding="10">


                                </tr>





                                <tr>
                                    <td>Status </td>
                                    <td>
                                        <select id="status" name="status" name="account_type" class="form-control">
                                            <option value="">~ select ~</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Renew</td>
                                    <td>
                                        <select name="renew" id="renew" class="form-control">
                                            <option value="">~ select State ~</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </td>
                                </tr>

                            </table>
                            <button style="padding-left:22px; padding-right:22px; margin-left:127px; margin-top:13px; font-weight:bold; border-radius:3px"
                                class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                </form>

                </div>

            </div>
        </div>
    </div>

    {{-- banner create modal close --}}



    {{-- banner edit modal start --}}
    <!-- Modal -->
    <div class="modal  fade" id="BannerEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Banner Update</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <form action="{{ route('banner.edit') }}" method="POST" id="bannerupdate"
                        enctype="multipart/form-data" style="background-color:#ddd;padding:20px">
                        @csrf
                        <input type="hidden" name="banner_id" id="banner_id">
                        <div class="row">
                            <div class="col-md-6 text-center">


                                <table align="center" cellpadding="10">

                                    <tr>
                                        <td>Packages<span style="color:red;font-weight:bold">*</span> </td>
                                        <td>
                                            <select id="up_banner_price" name="up_banner_price" class="form-control">
                                                <option value="">~ select packages ~</option>
                                                <option value="100">Header Banner - $100</option>
                                                <option value="00">Home Bottom - Free</option>



                                            </select>
                                            <span class="text-danger" id="price_error"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Banner Name<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="text" name="up_name" id="up_name" placeholder="banner name"
                                                class="form-control">
                                                <span class="text-danger" id="name_error"></span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Banner Position<span style="color:red;font-weight:bold">*</span> </td>
                                        <td>
                                            <select id="up_position" name="up_position" class="form-control"
                                                onchange="positionChange(this.value)">
                                                <option value="">~ select position ~</option>
                                                <option value="left_sidebar">Left Sidebar</option>
                                                <option value="Right_sidebar">Right Sidebar</option>
                                                <option value="top">Top</option>
                                                <option value="bottom">Bottom</option>
                                                <option value="middle">Middle</option>


                                                <option value="header_banner">Header Banner</option>
                                            </select>
                                            <span class="text-danger" id="position_error"></span>
                                        </td>
                                    </tr>

                                    <tr>


                                        <td>Banner Image<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <p style=" margin-top:7px;" id="recomanded">
                                            <p></label>
                                                <input type="file" name="up_image" id="up_image"
                                                    class="form-control" id="imageInput" accept="image/*" disabled>
                                                    <span class="text-danger" id="image_error"></span>


                                        </td>

                                    </tr>
                                    <tr>


                                        <td></td>
                                        <td>

                                                    <img src="" alt="Image Preview" id="imagePreview"
                                                    style="display:none;max-width: 150px; max-height: 150px;padding:0px !important; border-radius:5px">

                                        </td>

                                    </tr>



                                </table>
                            </div>
                            <div class="col-md-6 text-center">

                                <table align="center" cellpadding="10">







                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <select id="up_status" name="up_status" name="account_type"
                                                class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Renew</td>
                                        <td>
                                            <select name="up_renew" id="up_renew" class="form-control">
                                                <option value="">~ select State ~</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </td>
                                    </tr>

                                </table>
                                <button style="padding-left:22px; padding-right:22px; margin-left:113px; margin-top:10px"
                                    class="btn btn-success " type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- banner edit modal close --}}

@endsection



@push('page_js')
<script type="text/javascript">

$.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });



        //   datatabe code start
$(document).ready(function() {

$(function() {

    var table = $('.banner_table').DataTable({

        dom: "lBfrtip",
                buttons: [{
                    extend: 'pdf',
                    text: '<i class="fa-thin fa-file-pdf fa-2x"></i><br>PDF',
                    className: 'pdf btn text-white btn-sm px-1',
                    exportOptions: {
                        columns: [2, 4, 5, 6, 7, 8]
                    }
                }, {
                    extend: 'excel',
                    text: '<i class="fa-thin fa-file-excel fa-2x"></i><br>Excel',
                    className: 'pdf btn text-white btn-sm px-1',
                    exportOptions: {
                        columns: [2, 4, 5, 6, 7, 8]
                    }
                }, {
                    extend: 'print',
                    text: '<i class="fa-thin fa-print fa-2x"></i><br>Print',
                    className: 'pdf btn text-white btn-sm px-1',
                    exportOptions: {
                        columns: [2, 4, 5, 6, 7, 8]
                    }
                }, ],

        "pageLength": 50,
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        processing: true,
        serverSide: true,
        searchable: true,
        "ajax": {
            "url": "{{ route('dealer.ownbanner') }}",
            "data": function(data) {
                //filter options
                // data.hrm_department_id = $('#hrm_department_id').val();
                // data.shift_id = $('#shift_id').val();
                // data.grade_id = $('#grade_id').val();
                // data.designation_id = $('#designation_id').val();
                // data.date_range = $('.submitable_input').val();
                // data.employment_status = $('#employment_status').val();
            }
        },

        "drawCallback": function(data) {
            allRow = data.json.allRow;
            // $('#all_item').text('All (' + allRow + ')');
            $('#is_check_all').prop('checked', false);
            // $('#trashed_item').text('');
            // $('#trash_separator').text('');
            // $("#bulk_action_field option:selected").prop("selected", false);

        },

        columns: [
            {
                name: 'DT_RowIndex',
                data: 'DT_RowIndex',
                sWidth: '3%'
            },
            {
                data: 'image',
                name: 'image'
            },
            {
                data: 'name',
                name: 'name'
            },

            {
                data: 'position',
                name: 'position'
            },
            {
                data: 'start_date',
                name: 'start_date'
            },
            {
                data: 'end_date',
                name: 'end_date'
            },
            {
                data: 'payment',
                name: 'payment'
            },
            {
                data: 'status',
                name: 'status'
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },

        ],
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
    });
    table.buttons().container().appendTo('#exportButtonsContainer');

    $(document.body).on('click', '#is_check_all', function(event) {
        alert('Checkbox clicked!');
        var checked = event.target.checked;
        if (true == checked) {
            $('.check1').prop('checked', true);
        }
        if (false == checked) {
            $('.check1').prop('checked', false);
        }
    });

    $('#is_check_all').parent().addClass('text-center');

    $(document.body).on('click', '.check1', function(event) {

        var allItem = $('.check1');

        var array = $.map(allItem, function(el, index) {
            return [el]
        })

        var allChecked = array.every(isSameAnswer);

        function isSameAnswer(el, index, arr) {
            if (index === 0) {
                return true;
            } else {
                return (el.checked === arr[index - 1].checked);
            }
        }

        if (allChecked && array[0].checked) {
            $('#is_check_all').prop('checked', true);
        } else {
            $('#is_check_all').prop('checked', false);
        }
    });

    //Submit filter form by select input changing
    $(document).on('change', '.submitable', function() {

        table.ajax.reload();

    });


});

});

// datatable code close








        // image show when image insert
        $(document).ready(function () {
        // When the file input changes
        $("#up_image").change(function () {
            UpdatereadURL(this);
        });

        // Function to read the URL and display the image preview
        function UpdatereadURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // Display the image preview
                    $("#imagePreview").attr("src", e.target.result).show();
                };

                // Read the file as a data URL
                reader.readAsDataURL(input.files[0]);
            }
        }



        $('#image').change(function(){
          addReadUrl(this);
        })
        function addReadUrl(input){
            if(input.files && input.files[0]){
                var addReader = new FileReader();
                addReader.onload = function (e){
                 $('#addImagePreview').attr("src", e.target.result).show();
                };
                addReader.readAsDataURL(input.files[0]);
            }
        }





    });


        function createPositionChange(value) {

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



        function positionChange(value) {
            // console.log(value);
            if (value == 'left_sidebar') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML = `<i style="margin-right:7px"
                                        class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 50x300 px`;

            }
            if (value == 'Right_sidebar') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML = `<i style="margin-right:7px"
                                        class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 50x300 px`;

            }
            if (value == 'top') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML =
                `<i style="margin-right:7px"
                                        class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 1000x100 px`;

            }
            if (value == 'bottom') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML =
                `<i style="margin-right:7px"
                                        class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 1000x100 px`;

            }
            if (value == 'middle') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML = `<i style="margin-right:7px"
                                        class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 500x80 px`;

            }
            if (value == 'header_banner') {

                var element = document.getElementById('up_image');
                element.removeAttribute('disabled');


                var recomanded = document.getElementById("recomanded");
                recomanded.innerHTML = `<i style="margin-right:7px"
                                        class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 800x80 px`;

            }


            if (value == '') {
                console.log('hello');
                var element = document.getElementById('up_image');

                // Remove an attribute, for example, the 'disabled' attribute
                element.setAttribute('disabled', 'disabled');

                var recomanded = document.getElementById("recomanded");
                recomanded.style.visibility = "hidden";
            }

        }


        $(document).ready(function() {





// update banner data
$(document).on('click','.update_banner_form', function(e) {
     e.preventDefault();
     let id = $(this).data('id');
     let name = $(this).data('name');
     let position = $(this).data('position');
     let renew = $(this).data('renew');
     let status = $(this).data('status');
       let banner_price = $(this).data('banner_price');

    //  console.log( banner_price);





    $('#banner_id').val(id);
    $('#up_name').val(name);
    $('#up_position').val(position);

    $('#up_status').val(status);

    $('#up_renew').val(renew);
    $('#up_banner_price').val(banner_price);
});


  $('#banneradd').submit(function(e) {
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

            console.log(res.error);

            if (res.error) {
        if (res.error.name) {
            $('#banner_name_error').text(res.error.name);
        } else {
            $('#banner_name_error').text('');
        }

        if (res.error.banner_price) {
            $('#banner_price_error').text(res.error.banner_price);
        } else {
            $('#banner_price_error').text('');
        }

        if (res.error.position) {
            $('#banner_position_error').text(res.error.position);
        } else {
            $('#banner_position_error').text('');
        }
        if (res.error.image) {
            $('#image_error_add').text(res.error.image);
        } else {
            $('#image_error_add').text('');
        }


    }

            if (res.status == 'success') {

                $('.banner_table').DataTable().draw(false);

                $('#bannerCreate').modal('hide');
                toastr.success(' Banner Add Successfully');

            }
        },
        error: function(error) {
            console.log(error);
        },

    });
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

            console.log(res.error);

            if (res.error) {
        if (res.error.up_name) {
            $('#name_error').text(res.error.up_name);
        } else {
            $('#name_error').text('');
        }

        if (res.error.up_banner_price) {
            $('#price_error').text(res.error.up_banner_price);
        } else {
            $('#price_error').text('');
        }

        if (res.error.up_position) {
            $('#position_error').text(res.error.up_position);
        } else {
            $('#position_error').text('');
        }
        if (res.error.up_image) {
            $('#image_error').text(res.error.up_image);
        } else {
            $('#image_error').text('');
        }


    }

            if (res.status == 'success') {

                $('.banner_table').DataTable().draw(false);

                $('#BannerEdit').modal('hide');
                toastr.success(' Banner Update Successfully');

            }
        },
        error: function(error) {
            console.log(error);
        },

    });
});


// banner payment status change
  $(document).on('change', '.banner_payment', function() {
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
            console.log(res);
            if (res.status == "success") {
                $('.table').load(location.href + ' .table');
                location.reload();
            }

        },
    });
});


// banner active inactive status change
$(document).on('change', '.banner_active', function(){
   let id= $(this).data('id');
   let status = $(this).val();


   $.ajax({
    url:"{{route('status.change')}}",
    type:"patch",
    data:{
        id:id, status:status
    },
    success:function(res){
        console.log(res);
        if(res.status == 'success'){
            $('.table').load(location.href + ' .table');
                location.reload();

        }
    }
   })
})



$(document).on('click','.delete_banner', function(e) {
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
                        url: "{{ route('banner.delete') }}",
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


});


</script>

@endpush
