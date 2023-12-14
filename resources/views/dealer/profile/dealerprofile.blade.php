@extends('dealer.layouts.app')
@section('title', 'Dealer Profile | ')
@section('content')
<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header">

                <h5>Dealer Profile</h5>




            </div>
            <div class="card-block">
                @if (session()->has('message'))
                    <h3 class="text-success">{{ session()->get('message') }}</h3>
                @endif
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap profile-table user_update_table" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width:5%">S.L</th>
                                <th style="width:20%">User Image</th>
                                <th style="width:15%">User Name</th>
                                <th style="width:15%">User Email</th>
                                <th style="width:15%">Cell Number</th>

                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>






                                {{-- <tr>
                                    <td>1</td>
                                    <td>
                                        @if($user->img)
                                        <img src="" width="25%" alt="jkjak">
                                        @else
                                        <img src="{{asset('dashboard/images/avatar.png')}}" width="10%" alt="jkjak">
                                        @endif
                                    </td>

                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>




                                    <td>

                                        <a data-bs-toggle="modal" data-bs-target="#dealerUpdateModal"

                                        data-id="{{$user->id}}"
                                        data-fname="{{$user->fname}}"
                                        data-lname="{{$user->lname}}"
                                        data-email="{{$user->email}}"
                                        data-phone="{{$user->phone}}"
                                        data-address="{{$user->address}}"
                                        class="btn btn-success update_dealer_form" >Edit
                                        </a>


                                        <a class="btn btn-danger delete_profile"
                                        data-id="{{$user->id}}"
                                        >Delete</a>
                                    </td>


                                </tr> --}}


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Dealer update modal start --}}








<div class="modal fade" id="dealerUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profile Update</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">


                <form id="update_dealer"  action="{{ route('dealer.update') }}" method="POST"
                    enctype="multipart/form-data" style="background-color:#ddd;padding:20px">
                     @csrf

                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6 text-center">


                            <table align="center" cellpadding="10">

                                <tr>
                                    <td>First Name<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="text" class="form-control sales-input" id="up_fname" name="up_fname"
                            placeholder="First name">
                            <span class="text-danger float-left" id="first_name_error"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>Last Name<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="text" class="form-control sales-input" id="up_lname" name="up_lname"
                            placeholder="Last name">
                            <span class="text-danger float-left" id="last_name_error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email<span style="color:red;font-weight:bold">*</span></td>
                                    <td>
                                        <input type="email" class="form-control sales-input" id="up_email" name="up_email"
                            placeholder="Email">
                            <span class="text-danger float-left" id="email_error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ADF Email</td>
                                    <td>
                                        <input type="email" class="form-control sales-input" id="up_adf_email" name="up_adf_email"
                            placeholder="Email">

                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 text-center">

                            <table align="center" cellpadding="10">

                                <tr>
                                    <td>Cell <span style="color:red;font-weight:bold">*</span></td>
                                                <td><input type="text" class="form-control sales-input telephoneInput"
                                               id="up_phone"
                                                name="up_phone">
                                                <span class="text-danger float-left" id="cell_error"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Address <span style="color:red;font-weight:bold">*</span></td>
                                                <td>
                                                    <input type="text" class="form-control sales-input" id="up_address" name="up_address"
                                        placeholder="Address">
                                        <span class="text-danger float-left" id="address_error"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Image</td>
                                                <td>
                                                    <input style="margin-left: -0px" class="img-file" name="up_image" type="file" id="up_image">
                                                </td>
                                            </tr>




                            </table>
                            <button style="padding-left:28px; padding-right:28px; margin-left:40%; margin-top:25px, text-bold"
                                class="btn btn-success"
                                {{-- id="update_dealer"  --}}
                                type="submit">Submit</button>

                        </div>


                    </div>

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

@push('page_js')
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

//   datatabe code start
$(document).ready(function() {

$(function() {

    var table = $('.profile-table').DataTable({

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
            "url": "{{ route('dealer.profile') }}",
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

  $(document).ready(function(){


    // update dealer data
    $(document).on('click', '.update_dealer_form', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let fname = $(this).data('fname');
        let lname = $(this).data('lname');
        let email = $(this).data('email');
        let adf_email = $(this).data('adf_email');
        let phone = $(this).data('phone');
        let address = $(this).data('address');

        $('#id').val(id);
        $('#up_fname').val(fname);
        $('#up_lname').val(lname);
        $('#up_email').val(email);
        $('#up_phone').val(phone);
        $('#up_address').val(address);
        $('#up_adf_email').val(adf_email);



    });

//     $(document).on('click', '#update_dealer', function(e) {
//         e.preventDefault();
//         let id = $('#id').val();
//         let up_fname = $('#up_fname').val();
//         let up_lname = $('#up_lname').val();
//         let up_email = $('#up_email').val();
//         let up_adf_email = $('#up_adf_email').val();
//         let up_phone = $('#up_phone').val();
//         let up_address = $('#up_address').val();




//         $.ajax({
//             url: "{{route('dealer.update')}}",
//             type: 'post',
//             data: {
//                 id: id,
//                 up_fname: up_fname,
//                 up_lname: up_lname,
//                 up_email: up_email,
//                 up_adf_email: up_adf_email,
//                 up_phone: up_phone,
//                 up_address: up_address,
//             },
//             success: function(res) {
//       console.log(res);

//       if (res.error) {
//         if (res.error.up_fname) {
//             $('#first_name_error').text(res.error.up_fname);
//         } else {
//             $('#first_name_error').text('');
//         }

//         if (res.error.up_lname) {
//             $('#last_name_error').text(res.error.up_lname);
//         } else {
//             $('#last_name_error').text('');
//         }

//         if (res.error.up_email) {
//             $('#email_error').text(res.error.up_email);
//         } else {
//             $('#email_error').text('');
//         }

//         if (res.error.up_phone) {
//             $('#cell_error').text(res.error.up_phone);
//         } else {
//             $('#cell_error').text('');
//         }

//         if (res.error.up_address) {
//             $('#address_error').text(res.error.up_address);
//         } else {
//             $('#address_error').text('');
//         }
//     }

//     if (res.status === 'success') {
//         $('.user_update_table').DataTable().draw(false);
//         $('#updateForm')[0].reset();
//         $('#dealerUpdateModal').modal('hide');
//     }
// },

//             error: function(err) {

//             }
//         })
//     });




    $(document).on('submit', '#update_dealer', function(e) {
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
        if (res.error.up_fname) {
            $('#first_name_error').text(res.error.up_fname);
        } else {
            $('#first_name_error').text('');
        }

        if (res.error.up_lname) {
            $('#last_name_error').text(res.error.up_lname);
        } else {
            $('#last_name_error').text('');
        }

        if (res.error.up_email) {
            $('#email_error').text(res.error.up_email);
        } else {
            $('#email_error').text('');
        }

        if (res.error.up_phone) {
            $('#cell_error').text(res.error.up_phone);
        } else {
            $('#cell_error').text('');
        }

        if (res.error.up_address) {
            $('#address_error').text(res.error.up_address);
        } else {
            $('#address_error').text('');
        }
    }

    if (res.status === 'success') {
        $('.user_update_table').DataTable().draw(false);
        $('#update_dealer')[0].reset();
        $('#dealerUpdateModal').modal('hide');
        toastr.success(' Dealer Profile Update Successfully');
    }
},
        error: function(err) {
            // Your existing error handling code
        }
    });
});


    // dealer delete
    $(document).on('click','.delete_profile', function(e) {
        e.preventDefault();
       let id = $(this).data('id');

    $.confirm({
        title: 'Deactive account Confirmation',
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
                        url: "{{route('dealer.delete')}}",
                        type: 'post',
                        data:{ id: id},
                        success: function (data) {
                            // Show Toastr success message
                            toastr.success(data.status);
                            window.location.href = "{{ route('login')}}";
                            // Reload or redraw your data table if needed

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




  })


</script>



@endpush
