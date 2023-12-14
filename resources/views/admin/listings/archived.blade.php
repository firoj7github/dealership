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

                    <a href="{{ route('admin.listing') }}" class="btn btn-small btn-info text-white">
                        <h5> All Listings</h5>
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
                                    <th style="font-size:14px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($archived_inventories as $info)
                                    <tr>
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


                                        <td>
                                            <a href="#" data-id="{{ $info->id }}"
                                                class="listing_restore text-white btn btn-danger">
                                                Restore
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
                                    @empty
                                    <td colspan="6"><h1 class="text-center">No Inventory Archived Here</h1></td>
                                @endforelse


                            </tbody>

                        </table>

                        <div class="custom-pagination" style="display: flex; justify-content: flex-end">
                            <ul class="pagination">
                                @if ($archived_inventories->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $archived_inventories->previousPageUrl() }}">Previous</a>
                                    </li>
                                @endif

                                @php
                                    $currentPage = $archived_inventories->currentPage();
                                    $lastPage = $archived_inventories->lastPage();
                                    $maxPagesToShow = 5; // Adjust this number to determine how many page links to display
                                    $startPage = max($currentPage - floor($maxPagesToShow / 2), 1);
                                    $endPage = min($startPage + $maxPagesToShow - 1, $lastPage);
                                @endphp

                                @if ($startPage > 1)
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $archived_inventories->url(1) }}">1</a></li>
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
                                                href="{{ $archived_inventories->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endfor

                                @if ($endPage < $lastPage)
                                    @if ($endPage < $lastPage - 1)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $archived_inventories->url($lastPage) }}">{{ $lastPage }}</a>
                                    </li>
                                @endif

                                @if ($archived_inventories->hasMorePages())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $archived_inventories->nextPageUrl() }}">Next</a></li>
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


                $('.listing_restore').on('click', function() {
                    var id = $(this).data('id');

                    if (confirm('Are You Sure Want to Restore it ? ')) {

                        $.ajax({
                            url: "{{ route('listing.restore') }}",
                            type: 'post',
                            data: {
                                id: id
                            },
                            success: function(res) {
                                // Update UI based on the response


                                if (res.status == 'success') {

                                    $('.table').load(location.href + ' .table');
                                    location.reload();
                                    toastr.success('Inventory Restore Successfully ');


                                }
                            },

                        });

                    }



                });
            });
        </script>
    @endpush
