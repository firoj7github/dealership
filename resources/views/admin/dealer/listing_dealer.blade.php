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
                                     <a href="{{ route('admin.dealer.lead', $user->id)}}" class="btn btn-small btn-info text-white">Leads<a>
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
                                    <table id="dom-jqry" class="table table-striped table-bordered nowrap listing-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th> <input type="checkbox"
                                                    id="checkAll" /> All
                                                </th>
                                                <th></th>
                                                <th>Stock</th>
                                                <th>Title</th>
                                                <th>Dealer</th>
                                                {{-- <th>Category</th> --}}
                                                <th>Active Start</th>
                                                <th>Active End</th>
                                                <th>Payment Date </th>
                                                <th>Active till </th>
                                                <th>Featured till</th>
                                                <th>Package/Plan </th>
                                                <th>Visibility </th>
                                                {{-- <th style="font-size:14px;">Status</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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
                                    {{--<div class="col-md-9 float-right">
                                    <div class="custom-pagination" style="display: flex; justify-content: flex-end">
                                        <ul class="pagination">
                                            @if ($inventories->onFirstPage())
                                                <li class="page-item disabled"><span class="page-link">Previous</span>
                                                </li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $inventories->previousPageUrl() }}">Previous</a>
                                                </li>
                                            @endif

                                            @php
                                                $currentPage = $inventories->currentPage();
                                                $lastPage = $inventories->lastPage();
                                                $maxPagesToShow = 5; // Adjust this number to determine how many page links to display
                                                $startPage = max($currentPage - floor($maxPagesToShow / 2), 1);
                                                $endPage = min($startPage + $maxPagesToShow - 1, $lastPage);
                                            @endphp

                                            @if ($startPage > 1)
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $inventories->url(1) }}">1</a>
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
                                                            href="{{ $inventories->url($page) }}">{{ $page }}</a>
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
                                                        href="{{ $inventories->url($lastPage) }}">{{ $lastPage }}</a>
                                                </li>
                                            @endif

                                            @if ($inventories->hasMorePages())
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $inventories->nextPageUrl() }}">Next</a>
                                                </li>
                                            @else
                                                <li class="page-item disabled"><span class="page-link">Next</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>--}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('delear_JS')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // jkasdhgsadjksja fsdijksdjfksd sdjfksj fkjsdkfj sdfjsdkfjks jfkjfkjfksjfksjdfjk j

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
                            "url": "{{ route('admin.dealer.listing', $user->id) }}",
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
                                name: 'plus',
                                data: 'plus',
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
                                data: 'dealer',
                                name: 'dealer'
                            },
                            // {
                            //     data: 'category',
                            //     name: 'category'
                            // },

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

                $(document).on('click',".toggle-details",function() {
                    $(this).closest("tr").next(".details-row").toggle();
                });
            });
        // jkasdhgsadjksja fsdijksdjfksd sdjfksj fkjsdkfj sdfjsdkfjks jfkjfkjfksjfksjdfjk j



    // $(document).ready(function() {
    //     // Get references to the "Check All" checkbox and individual checkboxes
    //     var $checkAll = $('#checkAll');
    //     var $checkRows = $('.check-row');

    //     // Add a click event handler to the "Check All" checkbox
    //     $checkAll.on('click', function() {
    //         var isChecked = $(this).prop('checked');

    //         // Set the checked status of individual checkboxes
    //         $checkRows.prop('checked', isChecked);

    //         // Check if all individual checkboxes are disabled
    //         var allDisabled = $checkRows.filter(':disabled').length === $checkRows.length;

    //         // Disable the "Check All" checkbox if all individual checkboxes are disabled
    //         if (allDisabled) {
    //             $checkAll.prop('disabled', true);
    //         } else {
    //             $checkAll.prop('disabled', false);
    //         }
    //     });

    //     // Disable "Check All" if all checkboxes are initially disabled
    //     var allDisabled = $checkRows.filter(':disabled').length === $checkRows.length;
    //     if (allDisabled) {
    //         $checkAll.prop('disabled', true);
    //     }
    // });



        $(document).ready(function() {
            $(".toggle-details").click(function() {
                $(this).closest("tr").next(".details-row").toggle();
            });
        });


        $(document).ready(function() {

            $('.status-select').on('change', function() {
                var id = $(this).data('id');
                var package = $(this).val();

                $.ajax({
                    url: "{{ route('package-add') }}",
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
                            $('.table').load(location.href + ' .table', () => location
                                .reload());
                            toastr.success(`Status ${message} Successfully`);


                        }
                    },

                });
            });


            // listing display start
            $(document).on('change','.action-add', function() {
                var id = $(this).data('id');

                var status = $(this).val();

                $.ajax({
                    url: "{{ route('display-status') }}",
                    type: 'PATCH',
                    data: {
                        status,
                        id
                    }, // Shortened object syntax
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {

                            let message = '';
                            if (res.current_display == 1) {
                                message = 'Active';
                            }
                            if (res.current_display == 0) {
                                message = 'Inactive';
                            }
                            if (res.current_display == 2) {
                                message = 'Expired';
                            }
                            if (res.current_display == 3) {
                                message = 'Archived';
                            }
                            if (res.current_display == 4) {
                                message = 'Invalid';
                            }
                            if (res.current_display == 5) {
                                message = 'Blocked';
                            }

                            // $('.table').load(location.href + ' .table', () => location
                            //     .reload());
                            $('.listing-table').DataTable().draw(false);
                            toastr.success(`Visivility ${message} Successfully`);

                        }
                    },
                });
            });

            // listing display end


            // listing delete

            $(document).on('click','.listing_delete', function() {
                var id = $(this).data('id');
                // var url = $(this).attr('href');
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
                                    url: "{{ route('listing.delete') }}",
                                    type: 'post',
                                    data: {
                                            id: id
                                        },
                                    success: function (data) {
                                        // Show Toastr success message
                                        toastr.success('Inventory Archived Successfully ');
                                        // Reload or redraw your data table if needed
                                        $('.listing-table').DataTable().draw(false);
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

            //permanent delete listing

            $(document).on('click','.listing_permanent_delete', function() {
                var id = $(this).data('id');
                // var url = $(this).attr('href');
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
                                    url: "{{ route('admin.listing.delete.permanent') }}",
                                    type: 'post',
                                    data: {
                                            id: id
                                        },
                                    success: function (data) {
                                        // Show Toastr success message
                                        toastr.success('Inventory Delete Successfully ');
                                        // Reload or redraw your data table if needed
                                        $('.listing-table').DataTable().draw(false);
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




    // Check if no data is available
    if (Object.keys(ListingSelectedData).length === 0) {

        toastr.warning('Opps! select at least one item.');
        return;
       // Do not proceed with the AJAX request
    }

    if(packagePlan == '')
    {
        toastr.warning('Opps! select a package.');
        return;
    }


        $.ajax({
        url: "{{ route('admin.invoice.store') }}",
        method: "POST",
        data:{ ListingSelectedData: ListingSelectedData,
            packagePlan: packagePlan,
        },
        success: function(response) {


            if (response.status == 'success') {
                toastr.success(response.message);
                location.reload();
            }else
            {
                toastr.warning(response.message);
            }

        },

    });



});

    </script>
@endpush
