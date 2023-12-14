@extends('layouts.app')

@push('css')
<style>
    .fname-error {
        font-size: 12px;
        width: 210px;
        margin-top: 5px
    }

    .lname-error {
        font-size: 12px;
        width: 210px;
        margin-top: 5px
    }

    .email-error {
        font-size: 12px;
        width: 210px;
        margin-top: 5px
    }

    .phone-error {
        font-size: 12px;
        width: 210px;
        margin-top: 5px
    }

    .address-error {
        font-size: 12px;
        width: 210px;
        margin-top: 5px
    }

    .password-error {
        font-size: 12px;
        width: 210px;
        margin-top: 5px
    }

    .cpassword-error {
        font-size: 12px;
        width: 210px;
        margin-top: 5px
    }

    .img-file {
        margin-left: 9px
    }
</style>


@endpush

@section('content')

<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header">
                <h5>All User</h5>
                {{-- <a class="btn btn-info float-right" data-toggle="modal" data-target="#dealerCreate">Create User<a> --}}
                <a class="btn btn-info float-right text-white mb-2" data-bs-toggle="modal" data-bs-target="#dealerCreate">
                    Add User
                </a>

                @if (session()->has('error'))
                    <div class="alert alert-danger mt-4">{{session()->get('error')}}</div>
                @endif

            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap inventory-table">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <div>
                                        <input type="checkbox" id="is_check_all">
                                    </div>
                                </th>
                                <th class="text-center">SL.</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Cell Number</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Membership</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            {{--Incoming DealerManagementController.php ->index method --}}

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- Dealer create modal start --}}

<!-- Modal -->
<div class="modal fade" id="dealerCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">

                <form  style="background-color:#ddd;padding:20px" id="DelearForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 text-center">


                            <table align="center" cellpadding="10">

                                <tr>
                                    <td>First Name<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                    <input type="text" class="form-control sales-input" id="fname" name="fname" placeholder="First name">
                                    <div class="text-danger  fname-error"></div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Last Name<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="text" class="form-control sales-input" id="lname" name="lname" placeholder="Last name">
                                        <div class="text-danger lname-error"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-mail<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="email" class="form-control sales-input " id="email" name="email" placeholder="Email">
                                        <div class="text-danger email-error"></div>
                                    </td>
                                </tr>





                                    <td>ADF E-mail</td>
                                    <td>
                                        <input type="email" class="form-control sales-input " id="adf_email" name="adf_email" placeholder="ADF Email">

                                    </td>
                                </tr>
                                <tr>
                                    <td>Password<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="password" class="form-control sales-input" id="password" name="password" placeholder="Password">
                                        <div class="text-danger password-error"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Confirm Password<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="password" class="form-control sales-input" id="confirm_password" name="confirm_password" placeholder="Confirm password">
                                        <div class="text-danger cpassword-error"></div>
                                    </td>
                                </tr>



                            </table>
                        </div>
                        <div class="col-md-6 text-center">

                            <table align="center" cellpadding="10">

                                <tr >
                                    <td>Cell</td>
                                    <td>
                                        <input type="text" class="form-control sales-input telephoneInput" id="phone" name="phone"
                                        placeholder="cell">
                                        <div class="text-danger phone-error"></div>
                                    </td>
                                </tr>


                                <tr>
                                    <td>Address </td>
                                    <td>
                                        <input type="text" class="form-control sales-input" id="address" name="address" placeholder="Address">
                                    </td>
                                </tr>
                                <tr >
                                    <td>Image</td>
                                    <td>
                                        <input class="img-file" name="img" type="file" id="create_img">
                                    </td>
                                </tr>

                                {{-- @endif --}}



                            </table>

                        </div>


                    </div>


                    <button style="padding-left:25px; padding-right:25px; margin-left:81%; margin-top:12px"
                                class="btn btn-success" id="delear_create">Submit</button>



                </form>

            </div>

        </div>
    </div>
</div>



{{-- Dealer update modal start --}}

<div class="modal fade" id="dealerUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">

                <form  style="background-color:#ddd;padding:20px" id="updateForm" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 text-center">


                            <table align="center" cellpadding="10">

                                <tr>
                                    <td>First Name<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="hidden" name="dealer_id" id="dealer_id">
                                        <input type="text" class="form-control sales-input" id="up_fname" name="up_fname" placeholder="First name">
                                         <div class="text-danger  up-fname-error"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Last Name<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="text" class="form-control sales-input" id="up_lname" name="up_lname" placeholder="Last name">
                                        <div class="text-danger up-lname-error"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-mail<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="email" class="form-control sales-input" id="up_email" name="up_email" placeholder="Email">
                                        <div class="text-danger up-email-error"></div>
                                    </td>
                                </tr>





                                    <td>ADF E-mail</td>
                                    <td>
                                        <input type="email" class="form-control sales-input " id="up_adf_email" name="up_adf_email" placeholder="ADF Email">

                                    </td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>
                                        <input type="password" class="form-control sales-input" id="up_password" name="up_password" placeholder="Password">
                                        <div class="text-danger password-error"></div>
                                    </td>
                                </tr>



                            </table>
                        </div>
                        <div class="col-md-6 text-center">

                            <table align="center" cellpadding="10">

                                <tr >
                                    <td>Cell</td>
                                    <td>
                                        <input type="text"  class="form-control sales-input telephoneInput
                                        " id="up_phone" name="up_phone" placeholder="Cell">
                                    </td>
                                </tr>


                                <tr>
                                    <td>Address </td>
                                    <td>
                                        <input type="text" class="form-control sales-input" id="up_address" name="up_address" placeholder="Address">
                                    </td>
                                </tr>
                                <tr >
                                    <td>Image</td>
                                    <td>
                                        <input class="img-file" name="up_img" type="file" id="up_img">

                                    </td>
                                </tr>

                                <tr >
                                    <td></td>
                                    <td align="left">
                                        <img  alt="" id="update_image" width="90%" height="200" >
                                    </td>
                                </tr>

                                {{-- @endif --}}



                            </table>

                        </div>


                    </div>


                    <button style="padding-left:25px; padding-right:25px; margin-left:81%; margin-top:12px"
                                class="btn btn-success" id="delear_update">Submit</button>



                </form>

            </div>

        </div>
    </div>
</div>




<!-- Delete Form -->
<form id="delete_form" action="" method="post">
    @method('DELETE')
    @csrf
</form>

{{-- Dealer update modal close --}}


@endsection



@push('delear_JS')


<script type="text/javascript">

$(document).ready(function() {
    // Initialize Inputmask
    $('.telephoneInput').inputmask('(999) 999-9999');
  });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        $(function() {

            var table = $('.inventory-table').DataTable({

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
                    "url": "{{ route('dealer.management') }}",
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
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'membership',
                        name: 'membership'
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


        // package updated
        $(document).on('change','.packages',function(e){
            e.preventDefault();
           var package = $(this).val();
           var id = $(this).data('id');

           $.confirm({
            title: 'Membership Update confirm',
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
                    btnClass: 'btn-success',
                    action: function () {
                        $.ajax({
                            url : "{{ route('dealer.management.ajax') }}",
                            type: "get",
                            data: {package: package,id:id},
                            success: function(res){
                                $('.inventory-table').DataTable().draw(false);
                                toastr.success(res.status);
                            },
                            error:function(error){

                            }
                        });
                    }
                },

            }
        });

     });

        //is active or not
        $(document).on('change','.status',function(e){
            e.preventDefault();
           var status = $(this).val();
           var id = $(this).data('id');
            $.ajax({
                url : "{{ route('dealer.management.is_active.ajax') }}",
                type: "get",
                data: {status: status,id:id},
                success: function(res){
                    $('.inventory-table').DataTable().draw(false);
                    toastr.success(res.status);
                },
                error:function(error){

                }
            });
        });

    });

// soft  delete ajax start
    $(document).on('click', '.delete', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
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
                        url: url,
                        type: 'DELETE',
                        success: function (data) {
                            // Show Toastr success message
                            toastr.success(data.status);
                            // Reload or redraw your data table if needed
                            $('.inventory-table').DataTable().draw(false);
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

// permanent delete ajax start

    $(document).on('click', '.permanent_delete', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.confirm({
        title: ' Delete Confirmation',
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
                        url: url,
                        type: 'DELETE',
                        success: function (data) {
                            // Show Toastr success message
                            toastr.success(data.status);
                            // Reload or redraw your data table if needed
                            $('.inventory-table').DataTable().draw(false);
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
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $(".phone_us").keyup(function(e) {
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
    $(document).ready(function() {

        $(".phone_up").keyup(function(e) {
            var value = $(".phone_up").val();
            if (e.key.match(/[0-9]/) == null) {
                value = value.replace(e.key, "");
                $(".phone_up").val(value);
                return;
            }

            if (value.length == 3) {
                $(".phone_up").val(value + "-")
            }
            if (value.length == 7) {
                $(".phone_up").val(value + "-")
            }
        });
    });

    $.ajaxSetup({
        beforeSend: function(xhr, type) {
            if (!type.crossDomain) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
        },
    });

    $(document).ready(function() {


        $(document).on('click', '#delear_create', function(e) {
    e.preventDefault();

    let formData = new FormData($('#DelearForm')[0]); // Assuming DelearForm is your form ID

    $.ajax({
        url: "{{ route('dealer.create') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {

            var errors = res.errors;
            if (errors) {
                        if (errors.fname) {
                            $('.fname-error').text(errors.fname)
                        }
                        if (errors.lname) {
                            $('.lname-error').text(errors.lname)
                        }
                        if (errors.email) {
                            $('.email-error').text(errors.email)
                        }
                        if (errors.phone) {
                            $('.phone-error').text(errors.phone)
                        }
                        if (errors.address) {
                            $('.address-error').text(errors.address)
                        }
                        if (errors.password) {
                            $('.password-error').text(errors.password)
                        }
                        if (errors.confirm_password) {
                            $('.cpassword-error').text(errors.confirm_password)
                        }

            } else if (res.status == 'success') {
                // Reset form, close modal, update table, show success message
                $('#DelearForm')[0].reset();
                $('#dealerCreate').modal('hide');
                $('.inventory-table').DataTable().draw(false);
                toastr.success('User created successfully');
            }
        },
        error: function(err) {
            console.log(err);
            // Handle AJAX errors here
        }
    });
});


        // update dealer data
        $(document).on('click', '#update_dealer_Form', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let fname = $(this).data('fname');
            let lname = $(this).data('lname');
            let email = $(this).data('email');
            let phone = $(this).data('phone');
            let address = $(this).data('address');
            let adf_email = $(this).data('adf_email');
            let img = $(this).data('img');

            $('#dealer_id').val(id);
            $('#up_fname').val(fname);
            $('#up_lname').val(lname);
            $('#up_email').val(email);
            $('#up_phone').val(phone);
            $('#up_address').val(address);
            $('#up_adf_email').val(adf_email);
            $('#update_image').attr('src', '/dashboard/images/dealers/' + img);


        });

        $(document).on('click', '#delear_update', function(e) {
            e.preventDefault();

            let formData = new FormData($('#updateForm')[0]); // Assuming DelearForm is your form ID

    $.ajax({
        url: "{{ route('admin.dealer.update') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            var errors = res.errors;
            if (res.status == 'success') {
                        // $('.table').load(location.href + ' .table');
                        $('#updateForm')[0].reset();
                        $('#dealerUpdateModal').modal('hide');
                        $('.inventory-table').DataTable().draw(false);
                        toastr.success(res.status);
             }else if(errors)
             {
                if (errors.up_fname) {
                            $('.up-fname-error').text(errors.up_fname)
                        }
                if (errors.up_lname) {
                    $('.up-lname-error').text(errors.up_lname)
                }
                if (errors.up_email) {
                    $('.up-email-error').text(errors.up_email)
                }
             }
        }

        });

            // let dealer_id = $('#dealer_id').val();
            // let up_fname = $('#up_fname').val();
            // let up_lname = $('#up_lname').val();
            // let up_email = $('#up_email').val();
            // let up_phone = $('#up_phone').val();
            // let up_address = $('#up_address').val();
            // let up_adf_email = $('#up_adf_email').val();
            // let password = $('#up_password').val();

            // $.ajax({
            //     url: "{{ route('admin.dealer.update') }}",
            //     type: 'post',
            //     data: {
            //         dealer_id: dealer_id,
            //         up_fname: up_fname,
            //         up_lname: up_lname,
            //         up_email: up_email,
            //         up_phone: up_phone,
            //         up_address: up_address,
            //     },
            //     success: function(res) {
            //         if (res.status == 'success') {
            //             // $('.table').load(location.href + ' .table');
            //             $('#updateForm')[0].reset();
            //             $('#dealerUpdateModal').modal('hide');
            //             $('.inventory-table').DataTable().draw(false);
            //             toastr.success(res.status);
            //         }
            //     },
            //     error: function(err) {

            //     }
            // })
        });
        // delete dealer data
    });
</script>
@endpush
