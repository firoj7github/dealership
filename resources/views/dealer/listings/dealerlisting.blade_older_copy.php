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

        <div class="col-md-11 pt-5 m-auto rounded">
            <div class="card">
                <div class="card-header">

                    <h5>All Listings</h5>
                    {{-- <a class="btn btn-info float-right" data-toggle="modal" data-target="#dealerCreate">Create Dealer<a> --}}
                    <a href="{{ route('insert.inventory') }}" class="btn btn-small btn-info float-right text-white">
                        Add Inventory
                    </a>

                </div>
                <div class="card-block">
                    @if (session()->has('message'))
                        <h3 class="text-success">{{ session()->get('message') }}</h3>
                    @endif
                    <div class="table-responsive dt-responsive">
                        <table id="dom-jqry" class="table  table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th> <input type="checkbox"
                                        id="checkAll" /> All</th>
                                    <th></th>
                                    <th style="font-size:14px;">ID</th>
                                    <th style="font-size:14px;">Title</th>
                                    <th style="font-size:14px;">Dealer</th>
                                    <th style="font-size:14px;">Category</th>
                                    <th style="font-size:14px;">Payment Date</th>
                                    <th style="font-size:14px;">Active till</th>
                                    <th style="font-size:14px;">Featured till</th>
                                    <th style="font-size:14px;">Package/Plan</th>
                                    <th style="font-size:14px;">Status</th>
                                    <th style="font-size:14px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($infos as $info)
                                    <tr>
                                        <td>
                                            <input type="checkbox"
                                            class="check-row"
                                            data-id="{{ $info->id }}">
                                            </td>
                                        <td>
                                            <a href="#" class="toggle-details"><i
                                                    class="fa-solid fa-circle-plus"></i></a>
                                            @php
                                                $cars = $info->image_from_url;
                                                $total_cars = explode(',', $cars);
                                                $final_car = $total_cars[0];

                                            @endphp


                                        </td>



                                        <td class="fs-6">{{ $info->id }}</td>
                                        <td style="font-size:10px; font-weight:bold; opacity:97%">{{ $info->title }}</td>
                                        <td style="font-size:10px; font-weight:bold; opacity:97%">Skco Automotive</td>
                                        <td style="font-size:10px; font-weight:bold; opacity:97%">
                                            {{ $info->make }}/{{ $info->model }}</td>
                                        <td style="font-size:10px; font-weight:bold; opacity:97%">10/01/2023</td>
                                        {{-- @php
                                            $carbonDate_active = \Carbon\Carbon::parse($info->active_till);
                                            $carbonDate_featured = \Carbon\Carbon::parse($info->featured_till);

                                            // Format the date as 'm-d-Y'
                                            $active_till = $carbonDate_active->format('m-d-Y');
                                            $featured_till = $carbonDate_featured->format('m-d-Y');
                                        @endphp --}}
                                        <td style="font-size:10px; font-weight:bold; opacity:97%" id="active_till">

                                            {{ $info->active_till ? Carbon\Carbon::parse($info->active_till)->format('m-d-Y') : 'null' }}
                                        </td>
                                        <td style="font-size:10px; font-weight:bold; opacity:97%" id="feature_till">
                                            {{ $info->featured_till ? Carbon\Carbon::parse($info->featured_till)->format('m-d-Y') : 'null' }}
                                        </td>
                                        <td>
                                            <select
                                                class="status-add form-control {{ $info->package == 'featured' ? 'bg-warning' : '' }}"
                                                style="font-size:10px; font-weight:bold; opacity:97%" name="package"
                                                data-id="{{ $info->id }}">
                                                <option value="free" {{ $info->package == 'free' ? 'selected' : '' }}>
                                                    Free Package</option>
                                                <option value="featured"
                                                    {{ $info->package == 'featured' ? 'selected' : '' }}>Featured Package
                                                </option>

                                            </select>
                                        </td>


                                        <td><select
                                                class="action-add {{ $info->status == 'active' ? 'bg-success' : '' }} form-control "
                                                style="font-size:10px; font-weight:bold; opacity:97%"
                                                data-id="{{ $info->id }}">
                                                >
                                                <option {{ $info->status == 'active' ? 'selected' : '' }} value="active">Active
                                                </option>
                                                <option {{ $info->status == 'inactive' ? 'selected' : '' }} value="inactive">
                                                    Inactive</option>

                                            </select></td>

                                        <td>

                                            <a href="{{ route('picture.show', $info->id) }}" class="text-secondary"><i
                                                    class="fa fa-image"></i>
                                            </a>
                                            <a href="{{ route('listing.single', $info->id) }}" class="text-info"><i
                                                    class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('inventory.edit', $info->id) }}"
                                                class="edit_news_form text-info"><i class="fa fa-edit"></i>
                                            </a>


                                            <a href="#"
                                            data-id="{{ $info->id }}"
                                            class="listing_delete text-danger">
                                                <i class="fa fa-delete-left"></i>
                                            </a>
                                        </td>


                                    </tr>

                                    <tr class="details-row">

                                        <td colspan="11">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <img alt="Local Cars" src="{{ $final_car }}"
                                                                class="card-image rounded" width="100%" height="220px">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="mt-2">Title : <span
                                                                    style="font-weight:500;">{{ $info->title }}</span></p>
                                                            <p class="mt-2">Price : <span
                                                                    style="font-weight:500;">{{ $info->price_formate }}</span>
                                                            </p>
                                                            <p class="mt-2">Engine : <span
                                                                    style="font-weight:500;">{{ $info->engine_description_formate }}</span>
                                                            </p>

                                                            <p class="mt-2">Drive Train : <span
                                                                    style="font-weight:500;">{{ $info->drive_train }}</span>
                                                            </p>
                                                            <p class="mt-2">Exterior Color : <span
                                                                    style="font-weight:500;">{{ $info->exterior_color }}</span>
                                                            </p>
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








                        <div class="custom-pagination" style="display: flex; justify-content: flex-end">
                            <ul class="pagination">
                                @if ($infos->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $infos->previousPageUrl() }}">Previous</a>
                                    </li>
                                @endif

                                @php
                                    $currentPage = $infos->currentPage();
                                    $lastPage = $infos->lastPage();
                                    $maxPagesToShow = 5; // Adjust this number to determine how many page links to display
                                    $startPage = max($currentPage - floor($maxPagesToShow / 2), 1);
                                    $endPage = min($startPage + $maxPagesToShow - 1, $lastPage);
                                @endphp

                                @if ($startPage > 1)
                                    <li class="page-item"><a class="page-link" href="{{ $infos->url(1) }}">1</a></li>
                                    @if ($startPage > 2)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                @endif

                                @for ($page = $startPage; $page <= $endPage; $page++)
                                    @if ($page == $currentPage)
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $infos->url($page) }}">{{ $page }}</a></li>
                                    @endif
                                @endfor

                                @if ($endPage < $lastPage)
                                    @if ($endPage < $lastPage - 1)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $infos->url($lastPage) }}">{{ $lastPage }}</a>
                                    </li>
                                @endif

                                @if ($infos->hasMorePages())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $infos->nextPageUrl() }}">Next</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                                @endif
                            </ul>
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

                $(".toggle-details").click(function() {
                    $(this).closest("tr").next(".details-row").toggle();
                });
            });

            // check control start

            $(document).ready(function() {
            // Check all checkboxes
            $("#checkAll").change(function() {
                var atLeastOneChecked = $(".check-row:checked").length > 0;
                $(".check-row").prop('checked', $(this).prop("checked"));
                //   $('#go_invoice').prop('disabled', false);
                $('#go_invoice').prop('disabled', (atLeastOneChecked) ? true : false);
            });

            // Check individual checkbox
            $(".check-row").change(function() {
                var atLeastOneChecked = $(".check-row:checked").length > 0;
                if (!$(this).prop("checked")) {

                    $("#checkAll").prop("checked", false);

                }
                $('#go_invoice').prop('disabled', (atLeastOneChecked) ? false : true);
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
        url: " {{ route('dealer.invoice.store') }}",
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

                    $('.action-add').on('change', function() {
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

                                    $('.table').load(location.href + ' .table');
                                    location.reload();


                                }
                            },

                        });
                    });





                });
            });


            // listing delete

            $(document).ready(function() {

                $('.listing_delete').on('click', function() {
                    var id = $(this).data('id');

                    if(confirm('are you sure want to delete it')){

                        $.ajax({
                        url:"{{ route('listing.softdelete') }}",
                        type:'post',
                        data: {id: id
                        },
                        success: function(res) {
                            // Update UI based on the response


                            if (res.status == 'success') {

                                $('.table').load(location.href + ' .table');
                                location.reload();


                            }
                        },

                    });

                    }



                });





            });
        </script>
    @endpush

