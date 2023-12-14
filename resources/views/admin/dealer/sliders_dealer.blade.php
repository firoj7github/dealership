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
                                    <h3>'{{ $user->username }}' Account Details</h3>

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
                                            <th style="font-size:14px;"> Renew </th>
                                            <th style="font-size:14px;" >Start Date</th>
                                            <th style="font-size:14px;" >End Date</th>
                                            <th style="font-size:14px;">Status</th>
                                            <th style="font-size:14px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($sliders as $slider)
                                            <tr>
                                                <td>
                                                    <input type="checkbox"
                                                        class="check-row"
                                                        data-id="{{ $slider->id }}">
                                                </td>
                                                <td>
                                                    <a href="#" class="toggle-details"><i
                                                            class="fa-solid fa-circle-plus"></i></a>

                                                </td>



                                                <td class="fs-6">
                                                    {{ $loop->iteration }}</td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{ $slider->title }}</td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    Skco Automotive</td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{$slider->slide_renew }}
                                                </td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{$slider->slide_start_date }}
                                                </td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{$slider->slide_end_date }}
                                                </td>

                                                {{-- @php
                                                        $carbonDate_active = \Carbon\Carbon::parse($inventory->active_till);
                                                        $carbonDate_featured = \Carbon\Carbon::parse($inventory->featured_till);

                                                        // Format the date as 'm-d-Y'
                                                        $active_till = $carbonDate_active->format('m-d-Y');
                                                        $featured_till = $carbonDate_featured->format('m-d-Y');
                                                    @endphp --}}
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    <select class="form-control {{$slider->status==1?'bg-success':''}} changeActiveMode" data-id={{$slider->id}}>
                                                        <option {{$slider->status==1 ?'selected':''}} value="1">Active</option>
                                                        <option {{$slider->status==0 ?'selected':''}} value="0">Inactive</option>
                                                        </select>

                                                    </td>




                                                <td>

                                                    <a  data-bs-toggle="modal" data-bs-target="#SlideEdit" data-id=" {{ $slider->id }} " data-title=" {{$slider->title }}" data-status=" {{$slider->status }}" data-user="{{$user->id}}"
                                                        data-url=" {{$slider->url }}" data-slide_payment=" {{$slider->slide_payment }}" data-slide_renew=" {{$slider->slide_renew }}"
                                                        data-sub_title=" {{$slider->sub_title }}" data-slide_start_date=" {{$slider->slide_start_date }}" data-slide_end_date=" {{$slider->slide_end_date }}" data-description=" {{$slider->description }}" data-image=" {{$slider->image }}"  class="btn btn-success  text-white edit_slide_form"><i class="fa fa-edit"></i></a>
                                                     <a class="btn btn-warning delete text-white delete_slides" data-id=" {{$slider->id }}" href=" route('dealer.delete', ['id' => $slider->id]) "><i class="fa fa-delete-left"></i></a>
                                                     <a class="btn btn-danger delete text-white permamentDelete_slides" data-id=" {{$slider->id }}" href=" route('dealer.delete', ['id' => $slider->id]) "><i class="fa fa-trash"></i></a>
                                                </td>


                                            </tr>

                                            <tr class="details-row">

                                                <td colspan="11">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <img alt="Local Cars" src="{{asset('/dashboard')}}/images/slides/{{$slider->image}}"
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
                                        @if ($sliders->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link">Previous</span>
                                            </li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $sliders->previousPageUrl() }}">Previous</a>
                                            </li>
                                        @endif

                                        @php
                                            $currentPage = $sliders->currentPage();
                                            $lastPage = $sliders->lastPage();
                                            $maxPagesToShow = 5; // Adjust this number to determine how many page links to display
                                            $startPage = max($currentPage - floor($maxPagesToShow / 2), 1);
                                            $endPage = min($startPage + $maxPagesToShow - 1, $lastPage);
                                        @endphp

                                        @if ($startPage > 1)
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $sliders->url(1) }}">1</a>
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
                                                        href="{{ $sliders->url($page) }}">{{ $page }}</a>
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
                                                    href="{{ $sliders->url($lastPage) }}">{{ $lastPage }}</a>
                                            </li>
                                        @endif

                                        @if ($sliders->hasMorePages())
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $sliders->nextPageUrl() }}">Next</a>
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
                                <input type="hidden" id="up_select_dealer" name="up_select_dealer">
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
                                      <td>Slider Url</td>
                                      <td>
                                          <input type="text" name="up_url" id="up_url" class="form-control" placeholder="slider url">
                                          <div class="text-danger error-up_url"></div>
                                      </td>
                                  </tr>




                                      <tr>
                                      <td>Slider Image</td>
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
                                      <td>Start Date</td>
                                      <td>
                                          <input type="date" id="up_slide_start_date" name="up_slide_start_date" class="form-control">
                                          <div class="text-danger error-up_slide_start_date"></div>
                                      </td>
                                  </tr>
                                  <tr id="myEndDate">
                                      <td>End Date</td>
                                      <td>
                                          <input type="date" id="up_slide_end_date" name="up_slide_end_date" class="form-control">
                                          <div class="text-danger error-up_slide_end_date"></div>
                                      </td>
                                  </tr>

                                  <tr id="myPayment">
                                    <td>Payment </td>
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
                                      <td>Renew </td>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

               // update Slider data
        $('.edit_slide_form').on('click', function(e) {
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

            // console.log(id, title, status, sub_title, slide_start_date, slide_end_date, slide_payment, slide_renew,user);

            // return;
            let url = $(this).data('url');
            let description = $(this).data('description');
            $('#slides_id').val(id);
            $('#up_title').val(title);
            $('#up_status').val(status).attr('selected');
            $('#up_sub_title').val(sub_title);
            $('#up_select_dealer').val(user);
            $('#up_slide_payment').val(slide_payment).attr('selected');
            $('#up_slide_renew').val(slide_renew).attr('selected');
            $('#up_slide_start_date').val(slide_start_date).attr('selected');
            $('#up_slide_end_date').val(slide_end_date).attr('selected');
            $('#up_url').val(url);
            $('#up_description').val(description);
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
                    var errors = res.errors;
                    if(errors)
                    {
                        $.each(errors, function(index,error) {

                            $('.error-' + index).text(error);

                        });
                    }else if (res.status == 'success') {

                        toastr.success("update successfully");
                        $('#SlideEdit').modal('hide');
                        window.location.reload();

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
                                window.location.reload()
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
                                window.location.reload();
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


$(document).ready(function() {
            $(".toggle-details").click(function() {
                $(this).closest("tr").next(".details-row").toggle();
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
                            $('.table').load(location.href + '.table', () => location
                                .reload());
                            toastr.success(`Status ${message} Successfully`);


                        }
                    },

                });
            });



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
                        window.location.reload();
                    }
                },
                error: function(error) {
                    console.log(error);
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
        url: " {{ route('admin.slider.store') }}",
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
