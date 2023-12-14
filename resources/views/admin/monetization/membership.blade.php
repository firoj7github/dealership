@extends('layouts.app')

@push('css')
<style>


</style>


@endpush



@section('content')
<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header">

                <h5>All Memberships</h5>



                <a data-bs-toggle="modal" data-bs-target="#membershipCreate"
                    class="btn btn-info float-right text-white">
                    <i class="fa-solid fa-plus"></i>Add Membership
                </a>

            </div>
            <div class="card-block">

                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap membership-table"
                        style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-start">
                                    <div>
                                        <input type="checkbox" id="is_check_all">
                                    </div>
                                </th>
                                <th style="width:5%">SL</th>
                                <th style="width:20%">Membership Type</th>
                                <th style="width:15%">Membership Price($)</th>

                                <th style="width:10%">Status</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- MembershipController::class,'index' --}}

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- membership create modal start --}}

<!-- Modal -->
<div class="modal fade" id="membershipCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Membership</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">

                <form action="{{route('membership.add')}}" method="post" enctype="multipart/form-data" method="post"
                    style="background-color:#ddd;padding:20px" id="membershipAddForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 text-center">


                            <table align="center" cellpadding="10">

                                <tr>
                                    <td>Type<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="text" name="membership_type" id="membership_type"
                                            placeholder="Membership type" class="form-control">
                                            <div class="text-danger error-membership_type"  style="float: left;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Price<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="text" name="membership_price" id="membership_price"
                                            placeholder="Membership price" class="form-control">
                                            <div class="text-danger error-membership_price"  style="float: left;"></div>
                                    </td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-6 text-center">

                            <table align="center" cellpadding="10">

                                <tr>
                                    <td>Status <span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <select id="status" name="status" name="account_type" class="form-control">
                                            <option value="">~ select ~</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="text-danger error-status"  style="float: left;"></div>
                                    </td>
                                </tr>
                            </table>
                            <button style="padding-left:28px; padding-right:28px; margin-left:22%; margin-top:12px"
                                class="btn btn-success" type="submit">Submit</button>

                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
{{-- membership create modal close --}}

{{-- membership edit modal start --}}
<!-- Modal -->
<div class="modal fade" id="membershipEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Membership Update</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">


                <form id="membershipupdate" action="{{route('membership.update')}}" method="post"
                    enctype="multipart/form-data" method="post" style="background-color:#ddd;padding:20px">
                    @csrf

                    <input type="hidden" name="membership_id" id="membership_id">
                    <div class="row">
                        <div class="col-md-6 text-center">


                            <table align="center" cellpadding="10">

                                <tr>
                                    <td>Type<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="text" name="up_membership_type" id="up_membership_type"
                                            placeholder="Membership type" class="form-control">
                                            <div class="text-danger error-up_membership_type"  style="float: left;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Price<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="text" name="up_membership_price" id="up_membership_price"
                                            placeholder="Membership price" class="form-control">
                                            <div class="text-danger error-up_membership_price"  style="float: left;"></div>
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




                            </table>
                            <button style="padding-left:28px; padding-right:28px; margin-left:22%; margin-top:12px"
                                class="btn btn-success" type="submit">Submit</button>

                        </div>


                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

{{-- membership edit modal close --}}



@endsection



@push('delear_JS')

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// member ship add modal ajax start

$(document).ready(function() {
    $('#membershipAddForm').on('submit',function(event) {
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
                    $('.membership-table').DataTable().draw(false);
                    $('#membershipCreate').modal('hide');
                    toastr.success('Membership added successfully');

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


$(document).ready(function() {

    $(function() {

        var table = $('.membership-table').DataTable({

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
                "url": "{{ route('admin.membership') }}",
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
                    data: 'membership_type',
                    name: 'membership_type'
                },
                {
                    data: 'membership_price',
                    name: 'membership_price'
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


// $(document).on('click', '.delete', function(e) {
//             e.preventDefault();
//             var url = $(this).attr('href');
//             $('#delete_form').attr('action', url);
//             $('#delete_form').submit();
//                 // toastr.success(data);
//             $('.employee-table').DataTable().draw(false);
// alert(url)
//             // $.confirm({
//             //     'title': 'Delete Confirmation',
//             //     'message': 'Are you sure?',
//             //     'buttons': {
//             //         'Yes': {
//             //             'class': 'yes btn-danger',
//             //             'action': function() {
//             //                 // $('#delete_form').submit();
//             //                 $.ajax({
//             //                     url: url,
//             //                     type: 'DELETE',
//             //                     success: function(data) {
//             //                         toastr.success(data);
//             //                         $('.loading_button').hide();
//             //                         $('.employee-table').DataTable().draw(false);
//             //                     },
//             //                     error: function(error) {
//             //                         $('.loading_button').hide();
//             //                         toastr.error(error.responseJSON.message);
//             //                     }
//             //                 });
//             //             }
//             //         },
//             //         'No': {
//             //             'class': 'no btn-primary',
//             //             'action': function() {}
//             //         }
//             //     }
//             // });
//         });
</script>
<script type="text/javascript">
$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

//   show membership data
$(document).ready(function() {
    $(document).on('click', '.edit_membership', function(e) {
        let id = $(this).data('id');
        let membership_type = $(this).data('membership_type');
        let membership_price = $(this).data('membership_price');
        let status = $(this).data('status');

        console.log(membership_price);

        $('#membership_id').val(id);
        $('#up_membership_type').val(membership_type);
        $('#up_membership_price').val(membership_price);
        $('#up_status').val(status);




    });

    // update membership data

    $('#membershipupdate').submit(function(e) {
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


                var errors = res.errors;
                if(errors)
                {
                    $.each(errors, function(index,error) {

                        $('.error-' + index).text(error);

                    });
                }else if(res.status == 'success')
                {
                    $('.membership-table').DataTable().draw(false);
                    $('#membershipEdit').modal('hide');
                    toastr.success('Membership Updated successfully');

                }

            },
            error: function(error) {
                console.log(error);
            }

        });
    });

    $(document).on('change','.membership_status',function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let status = $(this).val();

        $.ajax({
            url : "{{ route('membership.status.update.ajax') }}",
            type: 'post',
            data : { id: id, status:status},
            success: function(res) {

                $('.membership-table').DataTable().draw(false);
                toastr.success(res.message);
            }
        });
    });

    // delete membership data
    $(document).on('click', '.delete_member', function(e) {
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
                                    url:"{{ route('membership.delete') }}",
                                    type: 'post',
                                    data: {
                                        id: id
                                    },
                                    success: function(res) {
                                        // Show Toastr success message
                                        if (res.status == "success") {
                                        $('.membership-table').DataTable().draw(false);
                                        toastr.success('Archived Successfully')
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

// permanent delete ajax

$(document).on('click', '.permanent_delete', function(e) {
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
                                    url:"{{ route('admin.membership.permanent.delete') }}",
                                    type: 'post',
                                    data: {
                                        id: id
                                    },
                                    success: function(res) {
                                        // Show Toastr success message
                                        if (res.status == "success") {
                                        $('.membership-table').DataTable().draw(false);
                                        toastr.success('Delete Successfully');
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

</script>




@endpush
