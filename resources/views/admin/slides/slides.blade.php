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

                <h5>All Slides</h5>

                <a href="{{ route('admin.slider.trush.list')}}" class="btn btn-danger">
                  <h5>Trush List</h5>
                </a>
                <a style="margin-left: 7px" href="{{ route('slider.list')}}"
                        class="btn btn-secondary float-right text-white">
                        <i class="fa fa-list"></i>List of plans
                    </a>
                <a class="btn btn-info float-right text-white" data-bs-toggle="modal" data-bs-target="#slidesCreate">
                    Add Slide
                </a>

            </div>
            <div class="card-block">
                @if (session()->has('message'))
                <h3 class="text-success">{{ session()->get('message') }}</h3>
                @endif
                <div class="table-responsive dt-responsive">
                    <table id= "dom-jqry"class="table  table-bordered nowrap slider-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-start">
                                    <div>
                                        <input type="checkbox" id="is_check_all">
                                    </div>
                                </th>
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
                            {{-- SlideController::class,'index' --}}
                        </tbody>

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

                    <form action="{{route('slide.insert')}}" method="post" id="sliderInsert" enctype="multipart/form-data" method="post"
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
                                         <div class="text-danger error-title"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Slider SubTitle<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="text" name="sub_title" id="sub_title" placeholder="slider subtitle"
                                                class="form-control">
                                                <div class="text-danger error-sub_title"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Slider Url<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="text" name="url" id="url" class="form-control" placeholder="slider url">
                                            <div class="text-danger error-url"></div>
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

                                                <div class="text-danger error-image"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dealer List <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="select_dealer" name="select_dealer"
                                            class="form-control select_dealer">
                                                <option value="">~ select ~</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                            @endforeach


                                            </select>
                                            <div class="text-danger error-select_dealer"></div>
                                        </td>
                                    </tr>



                                </table>
                            </div>
                            <div class="col-md-6 text-center">

                                <table align="center" cellpadding="10">



                                    <tr>
                                        <td>Status <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="status" name="status" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <div class="text-danger error-status"></div>
                                        </td>
                                    </tr>
                                    <tr id="myFirstDate">
                                        <td>Start Date<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="date" id="slide_start_date" name="slide_start_date" class="form-control">
                                            <div class="text-danger error-slide_start_date"></div>
                                        </td>
                                    </tr>

                                    {{-- @endif --}}


                                    <tr id="myEndDate">
                                        <td>End Date<span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <input type="date" id="slide_end_date" name="slide_end_date" class="form-control">
                                            <div class="text-danger error-slide_end_date"></div>
                                        </td>
                                    </tr>


                                    <tr id="myPayment">
                                        <td>Payment <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select id="slide_payment" name="slide_payment" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Success</option>
                                                <option value="0">Pending</option>
                                            </select>
                                            <div class="text-danger error-slide_payment"></div>
                                        </td>
                                    </tr>

                                    <tr id="myRenew">
                                        <td>Renew <span style="color:red;font-weight:bold">*</span></td>
                                        <td>
                                            <select name="slide_renew" id="slide_renew" class="form-control">
                                                <option value="">~ select State ~</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <div class="text-danger error-slide_renew"></div>
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
                                            <div class="text-danger error-description"></div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Slide Update</h5>
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
                                              <div class="text-danger error-up_title"></div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Slider SubTitle<span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <input type="text" name="up_sub_title" id="up_sub_title" placeholder="slider subtitle"
                                              class="form-control">
                                              <div class="text-danger error-up_sub_title"></div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Slider Url<span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <input type="text" name="up_url" id="up_url" class="form-control" placeholder="slider url">
                                          <div class="text-danger error-up_url"></div>
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

                                                  <div class="text-danger error-up_image"></div>
                                      </td>
                                  </tr>
                                  <tr>
                                    <td>Dealer List <span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <select id="up_select_dealer" name="up_select_dealer" class="form-control select_dealer">
                                            <option value="">~ select ~</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" >{{ $user->username }}</option>
                                        @endforeach


                                        </select>
                                        <div class="text-danger error-up_select_dealer"></div>
                                    </td>
                                </tr>


                              </table>
                          </div>
                          <div class="col-md-6 text-center">

                              <table align="center" cellpadding="10">

                                <tr>
                                    <td>Status <span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <select id="up_status" name="up_status" name="account_type" class="form-control">
                                            <option value="">~ select ~</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="text-danger error-up_status"></div>
                                    </td>
                                </tr>
                                  <tr id="myFirstDate">
                                      <td>Start Date<span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <input type="date" id="up_slide_start_date" name="up_slide_start_date" class="form-control">
                                          <div class="text-danger error-up_slide_start_date"></div>
                                      </td>
                                  </tr>
                                  <tr id="myEndDate">
                                      <td>End Date<span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <input type="date" id="up_slide_end_date" name="up_slide_end_date" class="form-control">
                                          <div class="text-danger error-up_slide_end_date"></div>
                                      </td>
                                  </tr>








                                  <tr id="myPayment">
                                    <td>Payment <span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <select  name="up_slide_payment" id="up_slide_payment"  class="form-control">
                                            <option value="">~ select ~</option>
                                            <option value="1">Success</option>
                                            <option value="0">Pending</option>
                                        </select>
                                        <div class="text-danger error-up_slide_payment"></div>
                                    </td>
                                </tr>

                                  <tr id="myRenew">
                                      <td>Renew <span style="color:red;font-weight:bold">*</span></td>
                                      <td>
                                          <select name="up_slide_renew" id="up_slide_renew" class="form-control">
                                              <option value="">~ select State ~</option>
                                              <option value="yes">Yes</option>
                                              <option value="no">No</option>
                                          </select>
                                          <div class="text-danger error-up_slide_renew"></div>
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
                                          <div class="text-danger error-up_description"></div>
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


 function optionDisable(value){
     if(value='1'){

     }

 }


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

    //    option optionDisable
      $(document).on('change','.select_dealer', function(){
        let id = $(this).val();
        console.log(id);
        $.ajax({
            url:"{{route('slider.option.disabled')}}",
            method:'get',
            data:{id:id},
            success:function(res){
                // console.log(res.role);
                if(res.role == 1){
                    var element = $('#myFirstDate');
                   element.css('visibility', 'hidden');
                    var element = $('#myEndDate');
                   element.css('visibility', 'hidden');
                    var element = $('#myRenew');
                   element.css('visibility', 'hidden');
                    var element = $('#myPayment');
                   element.css('visibility', 'hidden');
                }else{
                    var element = $('#myFirstDate');
                   element.css('visibility', 'visible');
                    var element = $('#myEndDate');
                   element.css('visibility', 'visible');
                    var element = $('#myRenew');
                   element.css('visibility', 'visible');
                    var element = $('#myPayment');
                   element.css('visibility', 'visible');

                }
            }
        })
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
            let user = $(this).data('user');

            let url = $(this).data('url');
            let description = $(this).data('description');

            let image = $(this).data('image');



            $('#slides_id').val(id);
            $('#up_title').val(title);
            $('#up_status').val(status);
            $('#up_sub_title').val(sub_title);
            $('#up_select_dealer').val(user).attr('selected');
            $('#up_slide_payment').val(slide_payment);
            $('#up_slide_renew').val(slide_renew);
            $('#up_slide_start_date').val(slide_start_date).attr('selected');
            $('#up_slide_end_date').val(slide_end_date).attr('selected');
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


    // start slider insert ajax

    $('#sliderInsert').on('submit',function(event) {
      // Prevent the default form submission
      event.preventDefault();
      // Serialize form data
      var formData = new FormData($(this)[0]);

      // Send Ajax request
      $.ajax({
        url: $(this).attr('action'), // URL to submit to
        type: 'POST', // Method type
        data: formData, // Form data
        processData: false,
        contentType: false,
        success: function(response) {
          // Handle success response here
          var errors = response.errors;
        //   console.log(errors);
        //   return;
         if(errors)
         {
            $.each(errors, function(index,error) {

                $('.error-' + index).text(error);

            });
         }else if(response.status == 'success')
         {
            $('#sliderInsert')[0].reset();
            $('.slider-table').DataTable().draw(false);
            $('#slidesCreate').modal('hide');
            toastr.success('slider create successfully');

         }
          // Optionally, reset the form after successful submission

        },
        error: function(xhr, status, error) {
          // Handle error here
          console.error(xhr.responseText);
        }
      });
    });

    //end slider insert ajax

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
                    var errors = res.errors;
                    if(errors)
                    {
                        $.each(errors, function(index,error) {

                            $('.error-' + index).text(error);

                        });
                    }else if (res.status == 'success') {
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
        title: 'Archive Confirmation',
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

// permanent slider ajax
$(document).on('click', '.permamentDelete_slides', function (e) {
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
                        url:"{{ route('admin.permanentslides.delete') }}",
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


