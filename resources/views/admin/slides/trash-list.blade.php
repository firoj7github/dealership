@extends('layouts.app')

@push('css')
<style>
    .table-responsive {
    overflow-x: visible;
}

.details-row {
    display: none;
}

</style>


@endpush



@section('content')



<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.slides')}}">
                    <h5>All Slides</h5>
                </a>


                <a href="#" class="btn btn-danger">
                  <h5>Trash List</h5>
                </a>
                <a  class="btn btn-info float-right text-white" data-bs-toggle="modal" data-bs-target="#slidesCreate">
                    Add Slide
                </a>

            </div>
            <div class="card-block">
                @if (session()->has('message'))
                <h3 class="text-success">{{ session()->get('message') }}</h3>
                @endif
                <div class="table-responsive dt-responsive">
                    <table id= "dom-jqry"class="table  table-bordered nowrap trash-slider-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th style="font-size:14px;" width="5%">SL.</th>
                                <th style="font-size:14px;" width="15%">Image</th>
                                <th style="font-size:14px;" width="20%">Title</th>
                                <th style="font-size:14px;" width="10%">Payment</th>
                                <th style="font-size:14px;" width="10%">Start Date</th>
                                <th style="font-size:14px;" width="10%">End Date</th>
                                <th style="font-size:14px;" width="10%">Status</th>
                                <th style="font-size:14px;" width="20%">Action</th>


                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        {{--<tbody>

                            @foreach ($slides as $slide)
                            <tr>
                                <td>
                                    <a href="#" class="toggle-details"><i class="fa-solid fa-circle-plus"></i></a>



                                </td>



                                <td class="fs-6">{{ $slide->id }}</td>


                                <td><img src="{{asset('/dashboard')}}/images/slides/{{$slide->image}}" width="30%" alt=""></td>

                                <td style="font-size:15px; opacity:97%">{{ $slide->title }}</td>

                                <td>
                                    <select class=" slide_payment form-control {{$slide->slide_payment==1 ? 'bg-success' : ''}}"
                                    data-id="{{$slide->id}}"
                                    >
                                    <option value="1" {{$slide->slide_payment==1 ?'selected':''}}>Success</option>
                                    <option value="0" {{$slide->slide_payment==0 ?'selected':''}}>Pending</option>
                                    </select>
                                </td>

                                    <td>{{$slide->slide_start_date}}</td>
                                    <td>{{$slide->slide_end_date}}</td>




                                <td><select
                                    class="status-select form-control {{ $slide->status == 1 ? 'bg-success' : '' }}"
                                    style="font-size:10px; font-weight:bold; opacity:97%" name="package"
                                    >
                                    <option value="1"
                                        {{ $slide->status == 1 ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0"
                                        {{ $slide->status == 0 ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select></td>


                                    <td>
                                    <a data-bs-toggle="modal" data-bs-target="#SlideEdit"
                                        data-id="{{$slide->id}}"
                                        data-title="{{$slide->title}}"
                                        data-status="{{$slide->status}}"
                                        data-sub_title="{{$slide->sub_title}}"
                                        data-slide_start_date="{{$slide->slide_start_date}}"
                                        data-slide_end_date="{{$slide->slide_end_date}}"
                                        data-url="{{$slide->url}}"
                                        data-slide_payment="{{$slide->slide_payment}}"
                                        data-slide_renew="{{$slide->slide_renew}}"
                                        data-description="{{$slide->description}}"
                                        data-image="{{$slide->image}}"

                                            class="btn btn-success edit_slide_form" >Edit
                                        </a>


                                        <a class="btn btn-danger delete_slides"
                                        data-id="{{$slide->id}}">Delete</a>

                                </td>


                            </tr>

                            <tr class="details-row">

                                <td colspan="11">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <img src="{{asset('/dashboard')}}/images/slides/{{$slide->image}}" width="70%" alt="">
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                </td>


                            </tr>
                            @endforeach




                        </tbody>--}}

                    </table>


            </div>
        </div>
    </div>
</div>


{{-- slide create modal start --}}

    <!-- Modal -->
    <div class="modal fade" id="slidesCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Slider</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">

                    <form action="{{route('slide.insert')}}" method="post" enctype="multipart/form-data" method="post"
                        style="background-color:#ddd;padding:20px">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 text-center">


                                <table align="center" cellpadding="10">

                                    <tr>
                                        <td>Slider Title<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="text" name="title" id="title" placeholder="slider title"
                                                class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Slider SubTitle<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="text" name="sub_title" id="sub_title" placeholder="slider subtitle"
                                                class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Slider Url<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="text" name="url" id="url" class="form-control" placeholder="slider url">
                                        </td>
                                    </tr>





                                        <td>Slider Image<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <p style=" margin-top:7px;" id="recomanded">
                                                <i style="margin-right:7px"
                                                class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 1500x500 px
                                            <p></label>
                                                <input type="file" name="image" id="image" class="form-control">
                                                <img src="" alt="Image Preview" id="imagePreview"
                                                style="display:none; max-width: 250px; max-height: 250px;margin-top:10px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payment <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="slide_payment" name="slide_payment" name="account_type" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Success</option>
                                                <option value="0">Pending</option>
                                            </select>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6 text-center">

                                <table align="center" cellpadding="10">
                                    <tr>
                                        <td>Start Date<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="date" id="slide_start_date" name="slide_start_date" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>End Date<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="date" id="slide_end_date" name="slide_end_date" class="form-control">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Dealer List <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="select_dealer" name="select_dealer" class="form-control">
                                                <option value="">~ select ~</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                            @endforeach


                                            </select>
                                        </td>
                                    </tr>
                                    </tr>




                                    <tr>
                                        <td>Status <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="status" name="status" name="account_type" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Renew <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select name="slide_renew" id="slide_renew" class="form-control">
                                                <option value="">~ select State ~</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </td>
                                    </tr>

                                </table>

                            </div>


                        </div>


                        <div class="row">
                            <div class="col-md-12" >
                                <table  cellpadding="5">
                                <tr>
                                    <td>Description<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <textarea  style="margin-left: 33px" name="description" id="description" placeholder="slider description"
                                            class="form-control" rows="2" cols="65"></textarea>
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
    {{-- slide create modal close --}}

{{-- slide edit modal start --}}
    <!-- Modal -->
    <div class="modal fade" id="SlideEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Slider</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">



                      <form id="slideEditForm" enctype="multipart/form-data" method="post"
                      style="background-color:#ddd;padding:20px">
                      @csrf

                      <input type="hidden" name="slides_id" id="slides_id">
                      <div class="row">
                          <div class="col-md-6 text-center">


                              <table align="center" cellpadding="10">

                                  <tr>
                                      <td>Slider Title<span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <input type="text" name="up_title" id="up_title" placeholder="slider title"
                                              class="form-control">
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Slider SubTitle<span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <input type="text" name="up_sub_title" id="up_sub_title" placeholder="slider subtitle"
                                              class="form-control">
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Slider Url<span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <input type="text" name="up_url" id="up_url" class="form-control" placeholder="slider url">
                                      </td>
                                  </tr>




                                      <tr>
                                      <td>Slider Image<span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <p style=" margin-top:7px;" id="recomanded">
                                              <i style="margin-right:7px"
                                              class="fa-solid fa-circle-exclamation text-info "></i>Recommended: 1500x500 px
                                          <p></label>
                                              <input type="file" name="up_image" id="up_image" class="form-control">
                                              <img src="" alt="Image Preview" id="imagePreview"
                                                  style="display:none; width: 20px !important; height: 10px !important;margin-top:2px">
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Payment <span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <select  name="up_slide_payment" id="up_slide_payment"  class="form-control">
                                              <option value="">~ select ~</option>
                                              <option value="1">Success</option>
                                              <option value="0">Pending</option>
                                          </select>
                                      </td>
                                  </tr>

                              </table>
                          </div>
                          <div class="col-md-6 text-center">

                              <table align="center" cellpadding="10">
                                  <tr>
                                      <td>Start Date<span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <input type="date" id="up_slide_start_date" name="up_slide_start_date" class="form-control">
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>End Date<span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <input type="date" id="up_slide_end_date" name="up_slide_end_date" class="form-control">
                                      </td>
                                  </tr>

                                  <tr>
                                      <td>Dealer List <span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <select id="up_select_dealer" name="up_select_dealer" class="form-control">
                                              <option value="">~ select ~</option>
                                          @foreach ($users as $user)
                                              <option value="{{ $user->id }}" >{{ $user->username }}</option>
                                          @endforeach


                                          </select>
                                      </td>
                                  </tr>
                                  </tr>




                                  <tr>
                                      <td>Status <span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <select id="up_status" name="up_status" name="account_type" class="form-control">
                                              <option value="">~ select ~</option>
                                              <option value="1">Active</option>
                                              <option value="0">Inactive</option>
                                          </select>
                                      </td>
                                  </tr>

                                  <tr>
                                      <td>Renew <span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <select name="up_slide_renew" id="up_slide_renew" class="form-control">
                                              <option value="">~ select State ~</option>
                                              <option value="yes">Yes</option>
                                              <option value="no">No</option>
                                          </select>
                                      </td>
                                  </tr>

                              </table>

                          </div>


                      </div>


                      <div class="row">
                          <div class="col-md-12" >
                              <table  cellpadding="5">
                              <tr>
                                  <td>Description<span style="color:red;font-weight:bold">*</span></td>
                                  <td>
                                      <textarea  style="margin-left: 33px" name="up_description" id="up_description" placeholder="slider description"
                                          class="form-control" rows="2" cols="65"></textarea>
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

    {{-- slide edit modal close --}}


@endsection

@push('delear_JS')

<script type="text/javascript">


$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function() {

    var table = $('.slider-table').DataTable({

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
            "url": "{{ route('admin.slides') }}",
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

        columns: [{
                name: 'check',
                data: 'check',
                sWidth: '3%',
                orderable: false,
                targets: 0
            },
            {
                name: 'DT_RowIndex',
                data: 'DT_RowIndex',
                sWidth: '3%'
            },
            {
                data: 'img',
                name: 'img'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'payment',
                name: 'payment'
            },
            {
                data: 'slide_start_date',
                name: 'slide_start_date'
            },
            {
                data: 'slide_end_date',
                name: 'slide_end_date'
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


    $(document).ready(function() {


    $.ajaxSetup({
        beforeSend: function(xhr, type) {
            if (!type.crossDomain) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
        },
    });
    $(document).ready(function() {
        $(".toggle-details").click(function() {
            $(this).closest("tr").next(".details-row").toggle();
        });
    });

        // update Slider data
        $(document).on('click','.edit_slide_form', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let title = $(this).data('title');
            let status = $(this).data('status');
            let sub_title = $(this).data('sub_title');
            let slide_start_date = $(this).data('slide_start_date');
            let slide_end_date = $(this).data('slide_end_date');
            let slide_payment = $(this).data('slide_payment');
            let slide_renew = $(this).data('slide_renew');

            let url = $(this).data('url');
            let description = $(this).data('description');

            let image = $(this).data('image');



            $('#slides_id').val(id);
            $('#up_title').val(title);
            $('#up_status').val(status);
            $('#up_sub_title').val(sub_title);
            $('#up_slide_payment').val(slide_payment);
            $('#up_slide_renew').val(slide_renew);
            $('#up_slide_start_date').val(slide_start_date);
            $('#up_slide_end_date').val(slide_end_date);
            $('#up_url').val(url);
            $('#up_description').val(description);
            $('#up_image').val(image);
        });

        // update active mode data
        $(document).on('change','.changeActiveMode', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let status = $(this).val();
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.slide.change.status') }}",
                data: {id:id,status:status},
                success: function(res) {
                    console.log(res);
                    if (res.status == 'success') {
                        toastr.success(res.message);
                         $('.slider-table').DataTable().draw(false);
                        // location.reload();
                    }
                },
                error: function(error) {
                    console.log(error);
                }

        });

        });


        // slide payment status change
        $(document).on('change','.slide_payment', function() {
        var id = $(this).data('id');
        var payment = $(this).val();

        $.ajax({
            url: "{{ route('pay.update') }}",
            type: 'PATCH',
            data: {
                payment,
                id
            },
            success: function(res) {

                if (res.status == "success") {
                    toastr.success(res.message);
                    $('.slider-table').DataTable().draw(false);
                }

            },
        });
    });



        $('#slideEditForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('slide.update') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(res) {

                    if (res.status == 'success') {
                        $('.slider-table').DataTable().draw(false);
                        $('#slideEditForm')[0].reset();
                        $('#SlideEdit').modal('hide');

                    }
                },
                error: function(error) {
                    console.log(error);
                }

        });
        });


$(document).on('click', '.delete_slides', function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    $.confirm({
        title: 'Delete Confirmation',
        content: 'Are you sure?',
        buttons: {
            cancel: {
                text: 'No',
                btnClass: 'btn-primary',
                action: function () {
                    // Do nothing on cancel
                }
            },
            confirm: {
                text: 'Yes',
                btnClass: 'btn-danger',
                action: function () {
                    $.ajax({
                        url:"{{ route('slides.delete') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function (data) {
                            // Show Toastr success message
                            if (data.status == "success") {
                                toastr.success(data.status);
                             $('.slider-table').DataTable().draw(false);
                            }
                        },
                        error: function (error) {
                            // Show Toastr error message
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }
            },

        }
    });
});
        // slides delete
        // $(document).on('click','', function(e) {
        //         e.preventDefault();
        //         let id = $(this).data('id');

        //         if (confirm('are you sure delete this dealer?')) {
        //             $.ajax({
        //                 url: "{{ route('slides.delete') }}",
        //                 type: 'post',
        //                 data: {
        //                     id: id
        //                 },
        //                 success: function(res) {
        //                     if (res.status == "success") {
        //                         // $('.table').load(location.href + ' .table');
        //                         $('.slider-table').DataTable().draw(false);
        //                         // location.reload();
        //                     }

        //                 },
        //                 error: function(err) {

        //                 }
        //             })
        //         }


        //     })


        });


        // image show when image insert
        $(document).ready(function () {
        // When the file input changes
        $("#image").change(function () {
            readURL(this);
        });

        // Function to read the URL and display the image preview
        function readURL(input) {
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
    });





</script>
@endpush


