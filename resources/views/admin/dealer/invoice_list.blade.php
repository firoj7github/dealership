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
                                    <a href="{{ route('admin.dealer.account-edit', $user->id) }}"
                                        class=" btn btn-primary"><i class="fa fa-edit"></i> Edit Account</a>
                                    <a href="#" class=" btn btn-danger"> <i class="fa fa-delete-left"></i> Remove
                                        Account</a>
                                    <a href="{{ route('dealer.management') }}" class=" btn btn-dark"><i
                                            class="fa fa-list"></i> All Account</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <a href="{{ route('admin.user.information', $user->id) }}"
                                class="btn btn-small btn-primary text-white">Account Information<a>

                                    <a href="#" class="btn btn-small btn-primary text-white">Archived<a>
                                            <a href="#" class="btn btn-small btn-info text-white">All Lead<a>
                                                    <a href="#" class="btn btn-small btn-success text-white">Ads<a>
        <a href="{{ route('dealer.invoice', $user->id) }}"
        class="btn btn-small btn-secondary text-white">Invoice<a>

        <div class="divide"></div>
        <button class="btn btn-link" type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseOne" aria-expanded="true"
        aria-controls="collapseOne">
        Feature Listing
        </button>
        <button class="btn btn-link" type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        Banners
        </button>
        <button class="btn btn-link" type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseOne" aria-expanded="true"
        aria-controls="collapseOne">
        Sliders
        </button>
        <button class="btn btn-link" type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseOne" aria-expanded="true"
        aria-controls="collapseOne">
        Leads
        </button>
        <button class="btn btn-link" id="go_invoice"
        type="button" disabled>
        Go Invoice
        </button>

        <div class="table-responsive dt-responsive collapse show"
        id="collapseOne" aria-labelledby="headingOne"
        data-parent="#accordionExample">
        <table id="dom-jqry"
            class="table  table-bordered nowrap"
            style="width: 100%">
    <thead>
        <tr>
            <th> <input type="checkbox"
                    id="checkAll" /> All</th>
            <th>More</th>
            <th style="font-size:14px;">ID</th>
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
            <th style="font-size:14px;">Price</th>
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
                    <a href="#"
                        class="toggle-details"><i
                            class="fa-solid fa-circle-plus"></i></a>
                    @php
                        $cars = $inventory->image_from_url;
                        $total_cars = explode(',', $cars);
                        $final_car = $total_cars[0];

                    @endphp


                </td>



                    <td class="fs-6">
                        {{ $inventory->id }}</td>
                    <td
                        style="font-size:10px; font-weight:bold; opacity:97%">
                        {{ $inventory->title }}</td>
                    <td
                        style="font-size:10px; font-weight:bold; opacity:97%">
                        Skco Automotive</td>
                    <td
                        style="font-size:10px; font-weight:bold; opacity:97%">
                        {{ $inventory->make }}/{{ $inventory->model }}
                    </td>
                    <td
                        style="font-size:10px; font-weight:bold; opacity:97%">
                        {{ $inventory->payment_date ? Carbon\Carbon::parse($inventory->featured_till)->format('m-d-Y') : 'Null' }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; opacity:97%"
                        id="active_till">

                        {{ $inventory->active_till ? Carbon\Carbon::parse($inventory->active_till)->format('m-d-Y') : 'Null' }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; opacity:97%"
                        id="feature_till">
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
                        $featuredListingPlanorpackageStatus = App\Enums\ListingPlanOrPackageType::Feature->value;
                    @endphp

                    <td>
                        <select
                            class="status-select form-control {{ $inventory->package == $featuredListingPlanorpackageStatus ? 'bg-warning' : '' }}"
                            style="font-size:10px; font-weight:bold; opacity:97%"
                            name="package"
                            data-id="{{ $inventory->id }}">
                            <option
                                value="{{ $standardeListingPlanorpackageStatus }}"
                                {{ $inventory->package == $standardeListingPlanorpackageStatus ? 'selected' : '' }}>
                                Free Package</option>
                            <option
                                value="{{ $featuredListingPlanorpackageStatus }}"
                                {{ $inventory->package == $featuredListingPlanorpackageStatus ? 'selected' : '' }}>
                                Featured Package
                            </option>

                        </select>
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
                        <p> $20</p>
                    </td>


                </tr>

                <tr class="details-row">

                    <td colspan="11">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div
                                        class="col-lg-6">
                                        <img alt="Local Cars"
                                            src="{{ $final_car }}"
                                            class="card-image rounded"
                                            width="100%"
                                            height="220px">
                                    </div>
                                    <div
                                        class="col-lg-6">
                                        <p
                                            class="mt-2">
                                            Title :
                                            <span
                                                style="font-weight:500;">{{ $inventory->title }}</span>
                                        </p>
                                        <p
                                            class="mt-2">
                                            Price :
                                            <span
                                                style="font-weight:500;">{{ $inventory->price_formate }}</span>
                                        </p>
                                        <p
                                            class="mt-2">
                                            Engine :
                                            <span
                                                style="font-weight:500;">{{ $inventory->engine_description_formate }}</span>
                                        </p>

                                        <p
                                            class="mt-2">
                                            Drive Train
                                            : <span
                                                style="font-weight:500;">{{ $inventory->drive_train }}</span>
                                        </p>
                                        <p
                                            class="mt-2">
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

</div>



                        </div>

                        <div class="card-footer">

                            {{-- banner table  --}}
                            <div class="table-responsive dt-responsive collapse show" id="collapseTwo"
                                aria-labelledby="headingOne" data-parent="#accordionExample">
                                <table id="dom-jqry" class="table  table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th> <input type="checkbox" id="checkBanner" /> All</th>

                                            <th style="font-size:14px;">ID</th>
                                            <th style="font-size:14px;">Title</th>
                                            <th style="font-size:14px;">Image</th>
                                            <th style="font-size:14px;">Start Date</th>
                                            <th style="font-size:14px;">End Date
                                            </th>
                                            <th style="font-size:14px;">Position
                                            </th>
                                            <th style="font-size:14px;">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($banners as $banner)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="banner-check-row"
                                                        data-id="{{ $inventory->id }}">
                                                </td>
                                                <td>{{ $banner->id }}</td>
                                                <td>{{ $banner->name }}</td>
                                                <td><img src="{{ asset('dashboard/images/banners/' . $banner->image) }}"
                                                        alt="" width="50" height="50"></td>
                                                <td>{{ $banner->start_date }}</td>
                                                <td>{{ $banner->end_date }}</td>
                                                <td>{{ $banner->position }}</td>
                                                <td>$100</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">
                                                    <p class="text-center">No Banner Available</p>
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>

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
        });


        $(document).ready(function() {
            // Check all checkboxes
            $("#checkBanner").change(function() {
                var atLeastOneChecked = $(".banner-check-row:checked").length > 0;
                $(".banner-check-row").prop('checked', $(this).prop("checked"));
                //   $('#go_invoice').prop('disabled', false);
                $('#go_invoice').prop('disabled', (atLeastOneChecked) ? true : false);
            });

            // Check individual checkbox
            $(".banner-check-row").change(function() {
                var atLeastOneChecked = $(".banner-check-row:checked").length > 0;
                if (!$(this).prop("checked")) {

                    $("#checkBanner").prop("checked", false);

                }
                $('#go_invoice').prop('disabled', (atLeastOneChecked) ? false : true);
            });
        });




        $("#go_invoice").click(function() {
            var listingCheckedRows = $(".check-row:checked");
            var BannercheckedRows = $(".banner-check-row:checked");

            var ListingSelectedData = [];
            listingCheckedRows.each(function() {
                var id = $(this).data("id");
                ListingSelectedData.push(id);
            });

            var BannerSelectedData = [];
            BannercheckedRows.each(function() {
                var id = $(this).data("id");
                BannerSelectedData.push(id);
            });

            var dataToSend = {}; // Initialize an empty object for data

            // Check the condition and add data to the object accordingly
            if (ListingSelectedData.length > 0) {
                dataToSend.inventory = ListingSelectedData;
            }

            if (BannerSelectedData.length > 0) {
                dataToSend.banners = BannerSelectedData;
            }

            // Check if no data is available
            if (Object.keys(dataToSend).length === 0) {
                alert('Select at least one item.');
                // Do not proceed with the AJAX request
            }

            $.ajax({
                url: "{{ route('admin.invoice.store') }}",
                type: 'POST',
                data: dataToSend, // Use the dynamically created object
                success: function(response) {
                    console.log(response);
                    // if (response.status == 'success') {
                    //     window.location.href = "{{ route('admin.invoice-create') }}";
                    //     toastr.success('Invoice Create Successfully ');
                    // }
                },
                error: function(xhr, status, error) {
                    // Handle the error here
                    console.error(error);
                    alert('An error occurred while processing the request.');
                }
            });
        });
    </script>
@endpush
