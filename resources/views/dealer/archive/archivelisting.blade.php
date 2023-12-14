@extends('dealer.layouts.app')
@section('title', 'Inventory Listing | ')
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

        <div class="col-md-12 pt-5 m-auto rounded">
            <div class="card">
                <div class="card-header">
                    <h5>All Listings</h5>
                    {{-- <a class="btn btn-info float-right" data-toggle="modal" data-target="#dealerCreate">Create Dealer<a> --}}
                    {{-- <a href="{{ route('insert.inventory') }}" class="btn btn-small btn-info float-right text-white">
                        Add Inventory
                    </a> --}}

                </div>
                <div class="card-block">
                    @if (session()->has('message'))
                        <h3 class="text-success">{{ session()->get('message') }}</h3>
                    @endif
                    <div class="table-responsive dt-responsive">
                        <table id="dom-jqry" class="table table-striped table-bordered nowrap listing-table">
                            <thead>
                                <tr>
                                    <th class="text-center"> <input type="checkbox"
                                        id="checkAll" /></th>
                                    <th class="text-center">#Stock</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Listing Start</th>
                                    <th class="text-center">Listing End</th>
                                    <th class="text-center">Payment Date</th>
                                    <th class="text-center">Active Till</th>
                                    <th class="text-center">Feature Till</th>
                                    {{-- <th style="font-size:14px;">Payment</th> --}}
                                    <th class="text-center">Package</th>
                                    <th class="text-center">Action</th>
                                </tr>

                            </thead>
                            <tbody>

                            </tbody>

                        </table>



                        <div class="col-md-3 mt-4">

                            <select name="packagePlan" id="selectPlan" class="form-control" style="width: 50%; display:inline;font-size:12px">
                                <option value="">Select Action</option>
                                <option value="0">Restore</option>
                            </select>
                            <button class="btn btn-small btn-primary" style="font-size:12px;color:white" id="submit_action">Go</button>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('page_js')
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).ready(function() {
                $(function() {

                    var table = $('.listing-table').DataTable({

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
                            "url": "{{ route('dealer.archive.listing') }}",
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
                                name: 'stock',
                                data: 'stock',
                            },
                            {
                                data: 'title',
                                name: 'title'
                            },

                            {
                                data: 'active_start',
                                name: 'active_start'
                            },
                            {
                                data: 'active_end',
                                name: 'active_end'
                            },
                            {
                                data: 'payment',
                                name: 'payment'
                            },
                            {
                                data: 'active_till',
                                name: 'active_till'
                            },
                            {
                                data: 'featured_till',
                                name: 'featured_till'
                            },

                            {
                                data: 'package',
                                name: 'package'
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

                $(document).on('click',".toggle-details",function() {
                    $(this).closest("tr").next(".details-row").toggle();
                });
            });

            // check control start

            $(document).ready(function() {
            // Check all checkboxes
            // $("#checkAll").on('change',function() {
                $(document).on('change',"#checkAll",function() {
                var atLeastOneChecked = $(".check-row:checked").length > 0;
                $(".check-row").prop('checked', $(this).prop("checked"));
                //   $('#go_invoice').prop('disabled', false);
                $('#go_invoice').prop('disabled', (atLeastOneChecked) ? true : false);
            });

            // Check individual checkbox
            $(document).on('change',".check-row",function() {
                var atLeastOneChecked = $(".check-row:checked").length > 0;
                if (!$(this).prop("checked")) {

                    $("#checkAll").prop("checked", false);

                }
                $('#go_invoice').prop('disabled', (atLeastOneChecked) ? false : true);
            });



            // $("#submit_action").click(function() {
        $('#submit_action').on('click', function(){



        var packagePlan = $('#selectPlan').val();
        var listingCheckedRows = $(".check-row:checked");
        var ListingSelectedData = [];
        listingCheckedRows.each(function() {
            var id = $(this).data("id");
            ListingSelectedData.push(id);
        });


    //  console.log(ListingSelectedData);
    // Check if no data is available
    if (Object.keys(ListingSelectedData).length === 0) {
        alert('Select at least one item.');
       // Do not proceed with the AJAX request
    }


    $.ajax({
        url: " {{ route('listing.restore') }}",
        method: "POST",
        data:{ ListingSelectedData: ListingSelectedData,
            packagePlan: packagePlan,
        },
        success: function(res) {

            if (res.status == 'success') {
                toastr.success('Inventory Restore Successfully.');
                $('.listing-table').DataTable().draw(false);
            }else
            {
                toastr.warning(res.message);
            }
}

    });
});





        });

             // check control close


            $(document).ready(function() {

                $('.status-add').on('change', function() {
                    var id = $(this).data('id');
                    var package = $(this).val();
                    console.log(id);

                    $.ajax({
                        url: "{{ route('package-insert') }}",
                        type: 'PATCH',
                        data: {
                            package: package,
                            id: id
                        },
                        success: function(res) {
                            // Update UI based on the response


                            if (res.status == 'success') {
                                // toastr.success(response.message);
                                // $('.status-select').append('<i class="fa fa-facebook"></i>');
                                $('.table').load(location.href + ' .table');
                                location.reload();


                            }
                        },

                    });
                });

                //  Active Inactive Working Ajax


                $(document).ready(function() {

                    $(document).on('change','.action-add', function() {
                        var id = $(this).data('id');
                        var status = $(this).val();
                        console.log(id, status);

                        $.ajax({
                            url: "{{ route('status-insert') }}",
                            type: 'PATCH',
                            data: {
                                status: status,
                                id: id
                            },
                            success: function(res) {
                                // Update UI based on the response


                                if (res.status == 'success') {

                                    $('.listing-table').DataTable().draw(false);
                                     toastr.success('Visibility Change Successfully');


                                }
                            },

                        });
                    });





                });
            });


            // listing delete



                $(document).on('click','.listing_restore', function() {
                    var id = $(this).data('id');

                    $.confirm({
                    title: 'Restore Confirmation',
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
                                    url: "{{ route('listing.restore') }}",
                                    type: 'post',
                                    data: {
                                            id: id
                                        },
                                    success: function (data) {

                                         // Show Toastr success message
                                        if(data.status == 'success')
                                        {
                                            toastr.success('Inventory Restore Successfully ');
                                        // Reload or redraw your data table if needed
                                        $('.listing-table').DataTable().draw(false);
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

        </script>
    @endpush

