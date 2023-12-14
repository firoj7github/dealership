@extends('layouts.app')

@push('css')

@endpush

@section('content')
    <div class="page-content-tab">

        <div class="container-fluid" id="contentToConvert">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h5>All Leads</h5>
                        </div>

                        <div class="card-body">
                            @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap lead-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                        <th class="text-start">
                                                <div>
                                                    <input type="checkbox" id="is_check_all">
                                                </div>
                                            </th>
                                            <th style="font-size:14px;">SL</th>
                                            <th style="font-size:14px;">#Stock</th>
                                            <th style="font-size:14px;">Title</th>
                                            <th style="font-size:14px;">Dealer</th>
                                            <th style="font-size:14px;">Package</th>
                                            <th style="font-size:14px;">Listing Type</th>
                                            <th style="font-size:14px;">Category</th>
                                            <th style="font-size:14px;">Customer Name</th>
                                            <th style="font-size:14px;">Customer Phone</th>
                                            <th style="font-size:14px;">
                                                Customer Email
                                            </th>
                                            <th style="font-size:14px;">
                                                Status
                                            </th>
                                            <th style="font-size:14px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        {{-- AdminLeadController::class,'index' --}}


                                        {{--@forelse ($leads as $lead )
                                            <tr class=" {{ ($lead->status == 1)? 'bg-warning' : ''}}">
                                                <td>{{$lead->tmp_inventories_car->stock}}</td>
                                                <td>{{$lead->tmp_inventories_car->title}}</td>
                                                <td>{{$lead->tmp_inventories_car->user->username}}</td>
                                                <td>
                                                    @php
                                                    $package = '';
                                                        if ($lead->tmp_inventories_car->user->package == 0 || $lead->tmp_inventories_car->user->package == 1) {
                                                            if ($lead->tmp_inventories_car->user->role == 2) {
                                                                $package = 'Copper';
                                                            }elseif ($lead->tmp_inventories_car->user->role == 0) {
                                                                $package = 'Standard';
                                                            }
                                                        }
                                                        elseif ($lead->tmp_inventories_car->user->package == 2) {
                                                            $package = 'Silver';
                                                        }
                                                        elseif ($lead->tmp_inventories_car->user->package == 3) {
                                                            $package = 'Gold';
                                                        }
                                                        elseif ($lead->tmp_inventories_car->user->package == 4) {
                                                            $package = 'Plutinum';
                                                        }
                                                        elseif ($lead->tmp_inventories_car->user->package == 5) {
                                                            $package = 'Blocked';
                                                        }else {
                                                            $package = '';
                                                        }
                                                    @endphp
                                                    {{$package}}
                                                </td>
                                                <td>
                                                    {{ ($lead->tmp_inventories_car->is_feature == 1)? 'Featured' : 'Free'}}
                                                </td>
                                                <td>{{$lead->tmp_inventories_car->category}}</td>
                                                <td>{{$lead->customer->full_name}}</td>
                                                <td>{{$lead->customer->phone}}</td>
                                                <td>{{$lead->customer->email}}</td>
                                                <td>
                                                    <select class="form-control">
                                                        <option {{ ($lead->stage == 0)? 'selected' : ''}}>Pending</option>
                                                        <option {{ ($lead->stage == 1)? 'selected' : ''}}>Working</option>
                                                        <option {{ ($lead->stage == 2)? 'selected' : ''}}>Completed</option>
                                                        <option {{ ($lead->stage == 3)? 'selected' : ''}}>Blocked</option>
                                                    </select>

                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.view.lead',$lead->id)}}" class="btn btn-sm btn-success" title="view"><i class="fa fa-eye"></i></a>
                                                    <a href="#" class="btn btn-sm btn-info contact_dealer" title="contact dealer" data-id="{{$lead->id}}" data-name="{{$lead->tmp_inventories_car->user->username}}" data-email="{{$lead->tmp_inventories_car->user->email}}" data-phone="{{$lead->tmp_inventories_car->user->phone}}"><i class="fa-regular fa-address-card"></i></a>
                                                    <a href="#" class="btn btn-sm btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="11"><p class="text-center">No Lead Available </p></td>
                                        </tr>
                                        @endforelse--}}

                                    </tbody>

                                </table>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- contact dealer modal --}}

  <!-- Modal -->
  <div class="modal fade" id="Contact_dealer_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Contact : <span class="dealer_name"></span></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.lead-contact.dealer')}}" method="POST" id="leadSendForm">
            @csrf
        <div class="modal-body">
            <h5>Cell : <span class="dealer_phone"></span></h5>
            <h5>OR</h5>
            <h5>E-mail : <span class="dealer_email"></span></h5>
            <p>Message</p>
            <textarea name="message" class="form-control message"></textarea>
            <input type="hidden" class="lead_id_form" name="lead_id">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary sendlead">Send</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <form id="deleted_form" action="" method="post">
        @csrf
        @method('DELETE')
    </form>
@endsection
@push('delear_JS')

<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $(function() {

            var table = $('.lead-table').DataTable({

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
                    "url": "{{ route('admin.leads') }}",
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

                    "drawCallback": function(settings) {
                        // Get DataTables API instance
                        var api = new $.fn.dataTable.Api(settings);

                        // Iterate through each row and add class based on 'status'
                        api.rows().every(function(index, element) {
                            var status = this.data().sta;
                            if (status == 0) {
                                $(this.node()).addClass('bg-warning');
                            }
                        });

                        // Additional code as needed
                        $('#is_check_all').prop('checked', false);

                    // // $('#all_item').text('All (' + allRow + ')');
                    // $('#is_check_all').prop('checked', false);
                    // // $('#trashed_item').text('');
                    // // $('#trash_separator').text('');
                    // // $("#bulk_action_field option:selected").prop("selected", false);
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
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'dealer',
                        name: 'dealer'
                    },
                    {
                        data: 'package',
                        name: 'package'
                    },
                    {
                        data: 'listing',
                        name: 'listing'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'cus_name',
                        name: 'cus_name'
                    },
                    {
                        data: 'cus_phone',
                        name: 'cus_phone'
                    },
                    {
                        data: 'cus_email',
                        name: 'cus_email'
                    },
                    {
                        data: 'stage',
                        name: 'stage'
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


    $(document).on('click', '.deleteLead', function (e) {
    e.preventDefault();

    var id = $(this).data('id');
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
                        url: "{{ route('admin.lead.delete')}}",
                        type: 'DELETE',
                        data: {id:id},
                        success: function (res) {

                            // Show Toastr success message
                            toastr.success(res.message);
                            // Reload or redraw your data table if needed
                            $('.lead-table').DataTable().draw(false);
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

// permanent delete ajax

    $(document).on('click', '.permanentDeleteLead', function (e) {
    e.preventDefault();

    var id = $(this).data('id');
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
                        url: "{{ route('admin.lead.permanent.delete')}}",
                        type: 'DELETE',
                        data: {id:id},
                        success: function (res) {

                            // Show Toastr success message
                            toastr.success(res.message);
                            // Reload or redraw your data table if needed
                            $('.lead-table').DataTable().draw(false);
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function(){
            $(document).on('click','.contact_dealer',function(){

                var lead_id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                $('.dealer_name').text(name);
                $('.dealer_phone').text(phone);
                $('.dealer_email').text(email);
                $('.lead_id_form').val(lead_id);
                $('#Contact_dealer_modal').modal('show');
                console.log(email);

            });

            $('.sendlead').on('click',function(){

                var message = $('.message').val();
                if(message == '')
                {
                    toastr.warning('message field is reqired');
                    return;
                }
                $('#leadSendForm').submit();
            })

        });



</script>
@endpush
