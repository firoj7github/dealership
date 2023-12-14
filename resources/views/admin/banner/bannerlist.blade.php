@extends('layouts.app')
@push('css')

@endpush

@section('content')

<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header">

                <h5>All plans</h5>


                <a style="margin-left: 7px" href="/admin/content/banner" class="btn btn-secondary float-right text-white">
                    <i class="fa fa-list"></i>List of banners
                </a>
                <a  href="" class="btn btn-info float-right text-white" data-bs-toggle="modal" data-bs-target="#planCreate">
                    <i class="fa-solid fa-plus"></i>Add Plan
                </a>

            </div>
            <div class="card-block">

                <div class="table-responsive dt-responsive">
                    <table id="" class="table table-striped table-bordered nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width:5%">SL</th>
                                <th style="width:20%">Name</th>
                                <th style="width:15%">Administrator Only</th>
                                <th style="width:10%">Price($)</th>
                                <th style="width:10%">Position</th>

                                <th style="width:10%">Status</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($plans as $key => $plan)
                            <tr>
                                <td>{{$key+1}} </td>
                                   <td>{{$plan->name}}</td>

                                   <td>{{$plan->administrator_only}}</td>
                                   <td>{{$plan->price}}</td>
                                   <td>{{$plan->position}}</td>
                                   <td><select class="form-control {{$plan->status==1?'bg-success':''}} package_status" data-id="{{$plan->id}}">
                                       <option {{$plan->status==1 ?'selected':''}} value="1">Active</option>
                                       <option {{$plan->status==0 ?'selected':''}} value="0">Inactive</option>
                                       </select></td>


                                    <td>
                                       <a data-bs-toggle="modal" data-bs-target="#planEdit"
                                       data-id="{{$plan->id}}"
                                       data-name="{{$plan->name}}"
                                       data-price="{{$plan->price}}"
                                       data-description="{{$plan->description}}"
                                       data-status="{{$plan->status}}"
                                       data-administrator_only="{{$plan->administrator_only}}"
                                       data-user_id="{{$plan->user_id}}"
                                       data-position="{{$plan->position}}"


                                           class="btn btn-success plan_banner_form" title="Edit " ><i class="fa fa-edit"></i>
                                       </a>
                                       <a
                                       data-id="{{$plan->id}}"
                                       class="btn btn-danger list_delete" title="Archive">
                                       <i class="fa fa-delete-left"></i>
                                       </a>
                                       <a
                                       data-id="{{$plan->id}}"
                                       class="btn btn-danger list_delete_permanent" title="Delete">
                                       <i class="fa fa-trash"></i>
                                       </a>



                                   </td>


                               </tr>
                            @empty
                                <tr>
                                    <td colspan="7"><p class="text-center">No Banner Plan Available.</p></td>
                                </tr>
                            @endforelse




                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- plan create modal start --}}

    <!-- Modal -->
    <div class="modal fade" id="planCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Plan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">

                    <form action="{{route('plan.add')}}" method="post" enctype="multipart/form-data"
                        style="background-color:#ddd;padding:20px" id="planAddBanner">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 text-center">


                                <table align="center" cellpadding="10">

                                    <tr>
                                        <td align="left">Name<span style="color:red;font-weight:bold">*</span></td>
                                        <td align="left">
                                            <input type="text" name="name" id="name" placeholder="Enter name"
                                                class="form-control">
                                                <div class="text-danger error-name"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">Price<span style="color:red;font-weight:bold">*</span></td>
                                        <td align="left">
                                            <input type="text" name="price" id="price" placeholder="Enter Price"
                                                class="form-control">
                                                <div class="text-danger error-price"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">Position<span style="color:red;font-weight:bold">*</span> </td>
                                        <td align="left">
                                            <select id="position" name="position" class="form-control"
                                               >
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

                                </table>
                            </div>
                            <div class="col-md-6 text-center">

                                <table align="center" cellpadding="10">


                                    <tr>
                                        <td align="left">Dealer List <span style="color:red;font-weight:bold">*</span></td>
                                        <td align="left">
                                            <select id="user_id" name="user_id" class="form-control">
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
                                        <td align="left">Administrator Only <span style="color:red;font-weight:bold">*</span></td>
                                        <td align="left">
                                            <select id="administrator" name="administrator" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="yes">yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <div class="text-danger error-administrator"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">Status <span style="color:red;font-weight:bold">*</span></td>
                                        <td align="left">
                                            <select id="status" name="status" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <div class="text-danger error-status"  style="float: left;"></div>
                                        </td>
                                    </tr>



                                </table>

                            </div>


                        </div>


                        <div class="row">
                            <div class="col-md-12" >
                                <table align="center" cellpadding="10">
                                <tr>
                                    <td align="left">Description<span style="color:red;font-weight:bold">*</span></td>
                                    <td align="left">
                                        <textarea   name="description" id="description" placeholder="Description"
                                            class="form-control" rows="2" cols="72"></textarea>
                                            <div class="text-danger error-description"  style="float: left;"></div>
                                    </td>
                                </tr>
                            </table>


                            </div>
                        </div>


                        <button style="padding-left:25px; padding-right:25px; margin-left:84%; margin-top:12px"
                                    class="btn btn-success" type="submit">Submit</button>



                    </form>

                </div>

            </div>
        </div>
    </div>
    {{-- plan create modal close --}}

    {{-- banner edit modal start --}}
    <!-- Modal -->
    <div class="modal  fade" id="planEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Banner Update</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <form id="planupdate" action="{{route('admin.plan.update')}}" method="post" enctype="multipart/form-data" method="post"
                        style="background-color:#ddd;padding:20px">
                        @csrf
                        <input type="hidden" name="plan_id" id="plan_id">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-6 text-center">


                                <table align="center" cellpadding="10">

                                    <tr>
                                        <td align="left">Name<span style="color:red;font-weight:bold">*</span></td>
                                        <td align="left">
                                            <input type="text" name="up_name" id="up_name" placeholder="Enter name"
                                                class="form-control">
                                            <div class="text-danger error-up_name"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">Price<span style="color:red;font-weight:bold">*</span></td>
                                        <td align="left">
                                            <input type="text" name="up_price" id="up_price" placeholder="Enter Price"
                                                class="form-control">
                                                <div class="text-danger error-up_price"  style="float: left;"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="left">Position<span style="color:red;font-weight:bold">*</span> </td>
                                        <td align="left">
                                            <select id="up_position" name="up_position" class="form-control"
                                               >
                                                <option value="">~ select position ~</option>
                                                <option value="left_sidebar">Left Sidebar</option>
                                                <option value="Right_sidebar">Right Sidebar</option>
                                                <option value="top">Top</option>
                                                <option value="Bottom">Bottom</option>
                                                <option value="middle">Middle</option>
                                                <option value="header_banner">Header Banner</option>
                                            </select>
                                            <div class="text-danger error-up_position"  style="float: left;"></div>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6 text-center">

                                <table align="center" cellpadding="10">


                                    <tr>
                                        <td align="left">Dealer List <span style="color:red;font-weight:bold">*</span></td>
                                        <td align="left">
                                            <select id="up_user_id" name="up_user_id" class="form-control">
                                                <option value="">~ select ~</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                            @endforeach


                                            </select>
                                            <div class="text-danger error-up_user_id"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    </tr>




                                    <tr>
                                        <td align="left">Administrator Only <span style="color:red;font-weight:bold">*</span></td>
                                        <td align="left">
                                            <select id="up_administrator" name="up_administrator" name="account_type" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="yes">yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <div class="text-danger error-up_administrator"  style="float: left;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">Status <span style="color:red;font-weight:bold">*</span></td>
                                        <td align="left">
                                            <select id="up_status" name="up_status" name="account_type" class="form-control">
                                                <option value="">~ select ~</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <div class="text-danger error-up_status"  style="float: left;"></div>
                                        </td>
                                    </tr>



                                </table>

                            </div>


                        </div>


                        <div class="row">
                            <div class="col-md-12" >
                                <table align="center" cellpadding="10">
                                <tr>
                                    <td align="left">Description<span style="color:red;font-weight:bold">*</span></td>
                                    <td align="left">
                                        <textarea  name="up_description" id="up_description" placeholder="Description"
                                            class="form-control" rows="2" cols="72"></textarea>
                                            <div class="text-danger error-up_description"  style="float: left;"></div>
                                    </td>
                                </tr>
                            </table>


                            </div>
                        </div>


                        <button style="padding-left:25px; padding-right:25px; margin-left:84%; margin-top:12px"
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
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

 // banner plan add ajax code

 $(document).ready(function() {
    $('#planAddBanner').on('submit',function(event) {
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
                console.log(res);

                var errors = res.errors;
                if(errors)
                {
                    $.each(errors, function(index,error) {

                        $('.error-' + index).text(error);

                    });
                }else if(res.status == 'success')
                {
                    $('#planAddBanner')[0].reset();
                    $('#planCreate').modal('hide');
                    toastr.success('plan create successfully');
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


  $(document).ready(function(){





// update plan data
$('.plan_banner_form').on('click', function(e) {
e.preventDefault();
let id = $(this).data('id');
let name = $(this).data('name');
let position = $(this).data('position');
let price = $(this).data('price');
let description = $(this).data('description');
let status = $(this).data('status');
let administrator = $(this).data('administrator_only');
let user_id = $(this).data('user_id');



$('#plan_id').val(id);
$('#up_name').val(name);
$('#up_position').val(position);
$('#up_price').val(price);
$('#up_description').val(description);
$('#up_administrator').val(administrator);
$('#up_status').val(status);
$('#up_user_id').val(user_id).attr('selected');



});

$('#planupdate').submit(function(e) {
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

        // console.log(res);
        // return;

        var errors = res.errors;
                if(errors)
                {
                    $.each(errors, function(index,error) {

                        $('.error-' + index).text(error);

                    });
                }else if(res.status == 'success')
                {
                    $('.table').load(location.href + ' .table');
                    $('#planEdit').modal('hide');
                    toastr.success('plan create successfully');
                    window.location.reload();

                }


    },
    error: function(error) {
        console.log(error);
    }
});
});


// list delete
$('.list_delete').on('click', function(e) {
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
                        url:"{{ route('planlist.delete') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function (res) {
                            console.log(res);
                            // Show Toastr success message
                            if (res.status == "success") {
                                $('.table').load(location.href + ' .table');
                                location.reload();
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
$('.list_delete_permanent').on('click', function(e) {
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
                        url:"{{ route('admin.planlist.delete.permanent') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function (res) {
                            console.log(res);
                            // Show Toastr success message
                            if (res.status == "success") {
                                $('.table').load(location.href + ' .table');
                                location.reload();
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


  // package active inactive
  $('.package_status').on('change', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let status = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.banner.package.change.status') }}",
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(res) {

                        if (res.status == 'success') {
                            toastr.success('change successfully');
                            window.location.reload();
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
