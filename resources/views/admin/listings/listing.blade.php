@extends('layouts.app')
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
                <a href="{{ route('admin.archived.listing')}}" class="btn btn-small btn-info text-white">Archive
                    Listing<a>
                        <a href="{{ route('add.carinventory') }}" class="btn btn-small btn-info float-right text-white">
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
                                <th></th>
                                <th style="font-size:14px;">ID</th>
                                <th style="font-size:14px;">Title</th>
                                <th style="font-size:14px;">Dealer</th>
                                <th style="font-size:14px;">Category</th>
                                <th style="font-size:14px;">Payment Date</th>
                                <th style="font-size:14px;">Active till</th>
                                <th style="font-size:14px;">Featured till</th>
                                <th style="font-size:14px;">Package/Plan</th>
                                <th style="font-size:14px;">Visibility</th>
                                {{-- <th style="font-size:14px;">Status</th> --}}
                                <th style="font-size:14px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($infos as $info)
                            <tr>
                                <td>
                                    <a href="#" class="toggle-details"><i class="fa-solid fa-circle-plus"></i></a>
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
                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                    {{ $info->payment_date ? Carbon\Carbon::parse($info->featured_till)->format('m-d-Y') : 'Null' }}
                                </td>

                                {{-- @php
                                            $carbonDate_active = \Carbon\Carbon::parse($info->active_till);
                                            $carbonDate_featured = \Carbon\Carbon::parse($info->featured_till);

                                            // Format the date as 'm-d-Y'
                                            $active_till = $carbonDate_active->format('m-d-Y');
                                            $featured_till = $carbonDate_featured->format('m-d-Y');
                                        @endphp --}}
                                <td style="font-size:10px; font-weight:bold; opacity:97%" id="active_till">

                                    {{ $info->active_till ? Carbon\Carbon::parse($info->active_till)->format('m-d-Y') : 'Null' }}
                                </td>
                                <td style="font-size:10px; font-weight:bold; opacity:97%" id="feature_till">
                                    {{ $info->featured_till ? Carbon\Carbon::parse($info->featured_till)->format('m-d-Y') : 'Null' }}
                                </td>
                                @php
                                $activeValue = App\Enums\VisibilityStatusOrInventoryStatus::Active->value;
                                $inactiveValue = App\Enums\VisibilityStatusOrInventoryStatus::Inactive->value;
                                $archiveValue = App\Enums\VisibilityStatusOrInventoryStatus::Archived->value;
                                $ExpireValue = App\Enums\VisibilityStatusOrInventoryStatus::Expired->value;
                                $invalidValue = App\Enums\VisibilityStatusOrInventoryStatus::Invalid->value;
                                $blockedValue = App\Enums\VisibilityStatusOrInventoryStatus::Blocked->value;

                                $standardeListingPlanorpackageStatus = App\Enums\ListingPlanOrPackageType::Standard->value;
                                // $featuredListingPlanorpackageStatus =  App\Enums\ListingPlanOrPackageType::Feature->value;
                                @endphp

                                <td>
                                    <select
                                        class="status-select form-control {{ $info->package == $standardeListingPlanorpackageStatus ? 'bg-warning' : '' }}"
                                        style="font-size:10px; font-weight:bold; opacity:97%" name="package"
                                        data-id="{{ $info->id }}">
                                        <option value="{{ $standardeListingPlanorpackageStatus }}"
                                            {{ $info->package == $standardeListingPlanorpackageStatus ? 'selected' : '' }}>
                                           Standard</option>
                                        {{-- <option value="{{ $featuredListingPlanorpackageStatus }}"
                                            {{ $info->package == $featuredListingPlanorpackageStatus ? 'selected' : '' }}>
                                            Featured Package
                                        </option> --}}

                                    </select>
                                </td>
                                <td>
                                   <select
                                    class="display-select
                                    @if($info->is_visibility == $activeValue) {{ 'bg-success text-white' }}
                                    @elseif($info->is_visibility == $inactiveValue) {{ 'bg-light' }}
                                    @elseif($info->is_visibility == $archiveValue) {{ 'bg-info text-white' }}
                                    @elseif($info->is_visibility == $ExpireValue) {{ 'bg-dark text-white' }}
                                    @elseif($info->is_visibility == $invalidValue) {{ 'bg-warning text-white' }}
                                    @else($info->is_visibility == $blockedValue) {{ 'bg-danger text-white' }}
                                    @endif form-control "
                                        style="font-size:10px; font-weight:bold; opacity:97%" data-id="{{ $info->id }}">
                                        >

                                        <option {{ $info->is_visibility == $activeValue ? 'selected' : '' }}
                                            value="{{ $activeValue }}">
                                            Active
                                        </option>
                                        <option {{ $info->is_visibility == $inactiveValue ? 'selected' : '' }}
                                            value="{{ $inactiveValue }}">
                                            Inactive</option>
                                            <option {{ $info->is_visibility == $ExpireValue ? 'selected' : '' }}
                                                value="{{ $ExpireValue }}">
                                                Expired</option>
                                        <option {{ $info->is_visibility == $archiveValue ? 'selected' : '' }}
                                            value="{{ $archiveValue }}">
                                            Archived</option>
                                        <option {{ $info->is_visibility == $invalidValue ? 'selected' : '' }}
                                            value="{{ $invalidValue }}">
                                            Invalid</option>
                                        <option {{ $info->is_visibility == $blockedValue ? 'selected' : '' }}
                                            value="{{ $blockedValue }}">
                                            Blocked</option>

                                    </select></td>
                                {{-- <td><select
                                        class="action-select {{ $info->status == $activeValue ? 'bg-success' : '' }} form-control "
                                        style="font-size:10px; font-weight:bold; opacity:97%" data-id="{{ $info->id }}">
                                        >

                                        <option {{ $info->status == $activeValue ? 'selected' : '' }}
                                            value="{{ $activeValue }}">
                                            Active
                                        </option>
                                        <option {{ $info->status == $inactiveValue ? 'selected' : '' }}
                                            value="{{ $inactiveValue }}">
                                            Inactive</option>
                                    </select></td> --}}




                                <td>

                                    <a href="{{ route('img.show', $info->id) }}" class="text-secondary"><i
                                            class="fa fa-image"></i>
                                    </a>
                                    <a href="{{ route('listing.show', $info->id) }}" class="text-info"><i
                                            class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('listing.edit', $info->id) }}" class="edit_news_form text-info"><i
                                            class="fa fa-edit"></i>
                                    </a>


                                    <a href="#" data-id="{{ $info->id }}" class="listing_delete text-danger">
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
                    {{-- <div class="container">
                        <h2>Collapsible Table</h2>
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>
                                  <button class="btn btn-info btn-sm toggle-details">Show Details</button>
                                </td>
                              </tr>
                              <tr class="details-row">
                                <td></td>
                                <td colspan="2">
                                  <!-- Details content goes here -->
                                  <p>Email: john@example.com</p>
                                  <p>Phone: 123-456-7890</p>
                                </td>
                              </tr>
                              <!-- Add more rows with unique details and buttons -->
                            </tbody>
                          </table>
                        </div>
                      </div> --}}


                    {{-- <div class="custom-pagination" style="display: flex;justify-content: center; margin-bottom:30px;">
                        <ul class="pagination" >
                            @if ($infos->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $infos->previousPageUrl() }}">Previous</a>
                    </li>
                    @endif

                    @foreach ($infos->getUrlRange(1, $infos->lastPage()) as $page => $url)
                    @if ($page == $infos->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $infos->previousPageUrl() }}">Previous</a></li>
                    @endif

                    @if ($infos->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $infos->nextPageUrl() }}">Next</a></li>
                    @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                    @endif
                    </ul>
                </div> --}}
                <div class="custom-pagination" style="display: flex; justify-content: flex-end">
                    <ul class="pagination">
                        @if ($infos->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $infos->previousPageUrl() }}">Previous</a>
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

                        @for ($page = $startPage; $page <= $endPage; $page++) @if ($page==$currentPage) <li
                            class="page-item active"><span class="page-link">{{ $page }}</span>
                            </li>
                            @else
                            <li class="page-item"><a class="page-link" href="{{ $infos->url($page) }}">{{ $page }}</a>
                            </li>
                            @endif
                            @endfor

                            @if ($endPage < $lastPage) @if ($endPage < $lastPage - 1) <li class="page-item disabled">
                                <span class="page-link">...</span></li>
                                @endif
                                <li class="page-item"><a class="page-link"
                                        href="{{ $infos->url($lastPage) }}">{{ $lastPage }}</a>
                                </li>
                                @endif

                                @if ($infos->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $infos->nextPageUrl() }}">Next</a>
                                </li>
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
                    $('.table').load(location.href + ' .table', () => location.reload());
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
                    if(res.current_display == 1){
                        message = 'Active';
                    }
                    if(res.current_display == 0){
                        message = 'Inactive';
                    }
                    if(res.current_display == 2){
                        message = 'Expired';
                    }
                    if(res.current_display == 3){
                        message = 'Archived';
                    }
                    if(res.current_display == 4){
                        message = 'Invalid';
                    }
                    if(res.current_display == 5){
                        message = 'Blocked';
                    }

                    $('.table').load(location.href + ' .table', () => location.reload());
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
</script>
@endpush
