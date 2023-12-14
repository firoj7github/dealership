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
                                <table id="dom-jqry" class="table  table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th> <input type="checkbox"
                                                id="checkAll" /> All</th>

                                            <th></th>
                                            <th style="font-size:14px;">Stock</th>
                                            <th style="font-size:14px;">Title</th>
                                            <th style="font-size:14px;">Dealer</th>
                                            <th style="font-size:14px;">Category
                                            </th>
                                            <th style="font-size:14px;">Payment Date
                                            </th>
                                            <th style="font-size:14px;">Active till
                                            </th>
                                            <th style="font-size:14px;">Featured
                                                till</th>
                                            <th style="font-size:14px;">Package/Plan
                                            </th>
                                            <th style="font-size:14px;">Visibility
                                            </th>
                                            {{-- <th style="font-size:14px;">Status</th> --}}
                                            <th style="font-size:14px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>
                                                    <input type="checkbox"
                                                        class="check-row"
                                                        data-id="{{ $inventory->id }}">
                                                </td>
                                                <td>
                                                    <a href="#" class="toggle-details"><i
                                                            class="fa-solid fa-circle-plus"></i></a>
                                                    @php
                                                        $cars = $inventory->image_from_url;
                                                        $total_cars = explode(',', $cars);
                                                        $final_car = $total_cars[0];

                                                    @endphp


                                                </td>



                                                <td class="fs-6">
                                                    {{ $inventory->stock }}</td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{ $inventory->title }}</td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    Skco Automotive</td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{ $inventory->make }}/{{ $inventory->model }}
                                                </td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{ $inventory->payment_date ? Carbon\Carbon::parse($inventory->payment_date)->format('m-d-Y') : 'Null' }}
                                                </td>

                                                {{-- @php
                                                        $carbonDate_active = \Carbon\Carbon::parse($inventory->active_till);
                                                        $carbonDate_featured = \Carbon\Carbon::parse($inventory->featured_till);

                                                        // Format the date as 'm-d-Y'
                                                        $active_till = $carbonDate_active->format('m-d-Y');
                                                        $featured_till = $carbonDate_featured->format('m-d-Y');
                                                    @endphp --}}
                                                <td style="font-size:10px; font-weight:bold; opacity:97%" id="active_till">

                                                    {{ $inventory->active_till ? Carbon\Carbon::parse($inventory->active_till)->format('m-d-Y') : 'Null' }}
                                                </td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%" id="feature_till">
                                                    {{ $inventory->featured_till ? Carbon\Carbon::parse($inventory->featured_till)->format('m-d-Y') : 'Null' }}
                                                </td>
                                                @php
                                                    $activeValue = App\Enums\VisibilityStatusOrInventoryStatus::Active->value;
                                                    $inactiveValue = App\Enums\VisibilityStatusOrInventoryStatus::Inactive->value;
                                                    $archiveValue = App\Enums\VisibilityStatusOrInventoryStatus::Archived->value;
                                                    $ExpireValue = App\Enums\VisibilityStatusOrInventoryStatus::Expired->value;
                                                    $invalidValue = App\Enums\VisibilityStatusOrInventoryStatus::Invalid->value;
                                                    $blockedValue = App\Enums\VisibilityStatusOrInventoryStatus::Blocked->value;

                                                    $standardeListingPlanorpackageStatus = App\Enums\ListingPlanOrPackageType::Standard->value;
                                                    // $featuredListingPlanorpackageStatus = App\Enums\ListingPlanOrPackageType::Feature->value;
                                                @endphp

                                                <td>
                                                    {{-- <select
                                                        class="status-select form-control {{ $inventory->package == $featuredListingPlanorpackageStatus ? 'bg-warning' : '' }}"
                                                        style="font-size:10px; font-weight:bold; opacity:97%" name="package"
                                                        data-id="{{ $inventory->id }}" disabled>
                                                        <option value="{{ $standardeListingPlanorpackageStatus }}"
                                                            {{ $inventory->package == $standardeListingPlanorpackageStatus ? 'selected' : '' }}>
                                                            Standard Package</option>
                                                        {{-- <option value="{{ $featuredListingPlanorpackageStatus }}"
                                                            {{ $inventory->package == $featuredListingPlanorpackageStatus ? 'selected' : '' }}>
                                                            Featured Package
                                                        </option> --}}

                                                   {{-- </select> --}}
                                                   @php
                                                   switch ($user->package) {
                                                    case App\Enums\MembershipType::Copper->value == $user->package:
                                                            $result = App\Enums\MembershipType::Copper->name;
                                                        break;

                                                    case App\Enums\MembershipType::Standard->value == $user->package:
                                                            $result = App\Enums\MembershipType::Standard->name;
                                                        break;
                                                    case App\Enums\MembershipType::Silver->value == $user->package:
                                                            $result = App\Enums\MembershipType::Silver->name;
                                                        break;
                                                    case App\Enums\MembershipType::Gold->value == $user->package:
                                                            $result = App\Enums\MembershipType::Gold->name;
                                                        break;
                                                    case App\Enums\MembershipType::Platinum->value == $user->package:
                                                            $result = App\Enums\MembershipType::Platinum->name;
                                                        break;
                                                    case App\Enums\MembershipType::Premium->value == $user->package:
                                                            $result = App\Enums\MembershipType::Premium->name;
                                                        break;
                                                    case App\Enums\MembershipType::Exclusive->value == $user->package:
                                                            $result = App\Enums\MembershipType::Exclusive->name;
                                                        break;

                                                    default:
                                                        $result = App\Enums\MembershipType::Blocked->name;
                                                        break;
                                                   }
                                                   @endphp

                                                   {{  $result }}

                                                </td>
                                                <td>
                                                    <select
                                                        class="display-select
                                                        @if ($inventory->is_visibility == $activeValue) {{ 'bg-success text-white' }}
                                                        @elseif($inventory->is_visibility == $inactiveValue) {{ 'bg-light' }}
                                                        @elseif($inventory->is_visibility == $archiveValue) {{ 'bg-inventory text-white' }}
                                                        @elseif($inventory->is_visibility == $ExpireValue) {{ 'bg-dark text-white' }}
                                                        @elseif($inventory->is_visibility == $invalidValue) {{ 'bg-warning text-white' }}
                                                        @else($inventory->is_visibility == $blockedValue) {{ 'bg-danger text-white' }} @endif form-control "
                                                        style="font-size:10px; font-weight:bold; opacity:97%"
                                                        data-id="{{ $inventory->id }}">
                                                        >

                                                        <option
                                                            {{ $inventory->is_visibility == $activeValue ? 'selected' : '' }}
                                                            value="{{ $activeValue }}">
                                                            Active
                                                        </option>
                                                        <option
                                                            {{ $inventory->is_visibility == $inactiveValue ? 'selected' : '' }}
                                                            value="{{ $inactiveValue }}">
                                                            Inactive</option>
                                                        <option
                                                            {{ $inventory->is_visibility == $ExpireValue ? 'selected' : '' }}
                                                            value="{{ $ExpireValue }}">
                                                            Expired</option>
                                                        <option
                                                            {{ $inventory->is_visibility == $archiveValue ? 'selected' : '' }}
                                                            value="{{ $archiveValue }}">
                                                            Archived</option>
                                                        <option
                                                            {{ $inventory->is_visibility == $invalidValue ? 'selected' : '' }}
                                                            value="{{ $invalidValue }}">
                                                            Invalid</option>
                                                        <option
                                                            {{ $inventory->is_visibility == $blockedValue ? 'selected' : '' }}
                                                            value="{{ $blockedValue }}">
                                                            Blocked</option>

                                                    </select>
                                                </td>

                                                <td>

                                                    <a href="{{ route('img.show', $inventory->id) }}"
                                                        class="text-secondary"><i class="fa fa-image"></i>
                                                    </a>
                                                    <a href="{{ route('listing.show', $inventory->id) }}"
                                                        class="text-inventory"><i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('listing.edit', $inventory->id) }}"
                                                        class="edit_news_form text-inventory"><i class="fa fa-edit"></i>
                                                    </a>


                                                    <a href="#" data-id="{{ $inventory->id }}"
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
                                                                        class="card-image rounded" width="100%"
                                                                        height="220px">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p class="mt-2">
                                                                        Title :
                                                                        <span
                                                                            style="font-weight:500;">{{ $inventory->title }}</span>
                                                                    </p>
                                                                    <p class="mt-2">
                                                                        Price :
                                                                        <span
                                                                            style="font-weight:500;">{{ $inventory->price_formate }}</span>
                                                                    </p>
                                                                    <p class="mt-2">
                                                                        Engine :
                                                                        <span
                                                                            style="font-weight:500;">{{ $inventory->engine_description_formate }}</span>
                                                                    </p>

                                                                    <p class="mt-2">
                                                                        Drive Train
                                                                        : <span
                                                                            style="font-weight:500;">{{ $inventory->drive_train }}</span>
                                                                    </p>
                                                                    <p class="mt-2">
                                                                        Exterior
                                                                        Color :
                                                                        <span
                                                                            style="font-weight:500;">{{ $inventory->exterior_color }}</span>
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
                                <div class="col-md-9 float-right">
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
                            </div>

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
            $('.display-select').on('change', function() {
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

                            $('.table').load(location.href + ' .table', () => location
                                .reload());
                            toastr.success(`Visivility ${message} Successfully`);

                        }
                    },
                });
            });

            // listing display end


            // listing delete

            $('.listing_delete').on('click', function() {
                var id = $(this).data('id');

                if (confirm('Are You Sure Want to Archive it? ')) {

                    $.ajax({
                        url: "{{ route('listing.delete') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            // Update UI based on the response
                            if (res.status == 'success') {

                                $('.table').load(location.href + ' .table');
                                location.reload();
                                toastr.success('Inventory Archived Successfully ');


                            }
                        },

                    });

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
