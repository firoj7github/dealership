@extends('dealer.layouts.app')
@section('title', 'Inventory Import | ')
@push('css')
<style>
.invoice_btn {
    border: none;
    border-radius: 50px;
    padding: 5px;
    margin-bottom: 10px;

}

.invoice_btn a {
    color: rgb(24, 169, 226)
}

.social_block li {
    float: left;
    padding: 10px;
    margin-left: 10px;
}

.social_block {
    margin-left: 86px;
}

.social_block li a {
    font-size: 18px;
}

.table td,
.table th {
    padding: 0.5rem 0.5rem;
}
</style>
@endpush
@section('content')

{{-- <style>
        .inventory {
            width: 80%;
            margin: 0 auto;
        }
    </style> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/custom-pagination.css') }}"> --}}
<div class="page-content-tab">

    <div class="container-fluid">

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}

            @if (isset($insertedCount))
            You new inserted{{ $insertedCount }}
            @endif
            @if (isset($notInsertedCount))
            and exist {{ $insertedCount }}
            @endif
        </div>
        @endif
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Localcarz</a>
                            </li>
                            <!--end nav-item-->
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Inventory Import</h4>
                    <a href="{{ route('insert.inventory')}}" class="btn btn-info float-right mb-4"><i
                        class="fa-solid fa-circle-plus"></i> Add Inventory</a>
                    <div class="row">

                        <div class="col-md-2">
                            <select name="make"  class="form-control a js-example-basic-single " id="make">
                                <option value="" class="text-white">Select Make </option>
                                @foreach($inventory_make_list as $make => $key)
                                <option value="{{ $make }}">{{ $make}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="model"  class="form-control a js-example-basic-single" id="model">
                            <option selected disabled>Select Model</option>
                            </select>
                        </div>



                        <div class="col-md-2">
                            <select name="body"  class="form-control a js-example-basic-single" id="body">
                                <option value="">Select Body </option>
                                @foreach($inventory_body as $body => $key)
                                <option value="{{ $body }}">{{ $body}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="year"  class="form-control a js-example-basic-single" id="year">
                                <option value="">Select Year </option>
                                @foreach($inventory_year as $year => $key)
                                <option value="{{ $year }}">{{ $year}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="min_price"  id="min_price" class="form-control a js-example-basic-single">
                                <option value="">Select minimum price </option>
                                @if($inventory_min_price < 1000)
                                <option value="{{$inventory_min_price}}">${{$inventory_min_price}}</option>
                                @endif
                                <option value="1000">$1000</option>
                                <option value="2000">$2000</option>
                                <option value="3000">$3000</option>
                                <option value="4000">$4000</option>
                                <option value="5000">$5000</option>
                                <option value="6000">$6000</option>
                                <option value="7000">$7000</option>
                                <option value="8000">$8000</option>
                                <option value="10000">$10000</option>
                                <option value="12000">$12000</option>
                                <option value="15000">$15000</option>
                                <option value="20000">$20000</option>
                                <option value="25000">$25000</option>
                                <option value="30000">$30000</option>
                                <option value="40000">$40000</option>
                                <option value="50000">$50000</option>
                                <option value="75000">$75000</option>
                                @if($inventory_max_price > 75000)
                                <option value="{{$inventory_max_price}}">${{$inventory_max_price}}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="max_price" id="max_price"  class="form-control a js-example-basic-single">
                                <option value="">Select maximum price</option>
                                @if($inventory_min_price < 1000)
                                <option value="{{$inventory_min_price}}">${{$inventory_min_price}}</option>
                                @endif
                                <option value="1000">$1000</option>
                                <option value="2000">$2000</option>
                                <option value="3000">$3000</option>
                                <option value="4000">$4000</option>
                                <option value="5000">$5000</option>
                                <option value="6000">$6000</option>
                                <option value="7000">$7000</option>
                                <option value="8000">$8000</option>
                                <option value="10000">$10000</option>
                                <option value="12000">$12000</option>
                                <option value="15000">$15000</option>
                                <option value="20000">$20000</option>
                                <option value="25000">$25000</option>
                                <option value="30000">$30000</option>
                                <option value="40000">$40000</option>
                                <option value="50000">$50000</option>
                                <option value="75000">$75000</option>
                                @if($inventory_max_price > 75000)
                                <option value="{{$inventory_max_price}}">${{$inventory_max_price}}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row justify-content-center">
            <div class="col">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 fw-semibold">Bulk Import</p>
                                <form action="{{ route('inventory.import.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-block d-flex">
                                                <input type="file" name="import_file" class="form-control" required>
                                                <button class='btn btn-success'>{{ __('Import') }}</button>
                                            </div>

                                        </div>

                                        <a href="{{ asset('dashboard/demo_import/homenetauto.csv') }} "
                                            class="btn btn-info" download>Demo Download</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->

        </div>
        <!--end row-->

    </div>
<div id="inventoryContainer"></div>

</div>

<style type="text/css">
/* Adjust the size of previous and next pagination arrows */
.pagination .page-item.prev .page-link,
.pagination .page-item.next .page-link {
    font-size: 14px;
    /* Adjust the font size as needed */
    padding: 0.3rem 0.5rem;
    /* Adjust padding as needed */
}
</style>
@endsection
@push('page_js')
<script>

    // Ajax function to load inventory data
    function loadInventoryData(page = 1) {
            var action = 'fetch_data';
            var make = $('#make').val();
            var model = $('#model').val();
            var body = $('#body').val();
            var year = $('#year').val();
            var min_price = $('#min_price').val();
            var max_price = $('#max_price').val();
        $.ajax({
            url: "{{ route('inventory.import.ajax') }}",
            type: 'GET',
            data: {
                action: action,
                make: make,
                model: model,
                body: body,
                year: year,
                min_price: min_price,
                max_price: max_price,
                page: page,
            },
            success: function(response) {
                // Update the inventory container with the fetched data
                $('#inventoryContainer').html(response.view);
                // Update the pagination container with the fetched pagination
                $('#paginationContainer').html(response.pagination);
            },
            error: function(error) {
                console.error('Error fetching inventory data:', error);
            }
        });
    }

    // Trigger on document ready
    $(document).ready(function() {
        loadInventoryData();

        $('#make').on('change', function(){
          make = $(this).val();
          $.ajax({
            url : "{{ route('frontend.ajax.model') }}",
            type: 'GET',
            data:{
                make: make
            },
            success: function(res){
                console.log(res);
                $('#model').empty();
                $('#model').append('<option selected value="">All Model</option>');
                $.each(res, function(index, item) {
                    $('#model').append('<option value="' + index + '">' +
                        index + '</option>');
                });
            },
            error: function(err){

            }
          });
        });
    });

    // Trigger on change of input values
    $('.a').on('change',function() {
        loadInventoryData();
    });

    // Pagination click event
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        loadInventoryData(page);
    });
</script>

@endpush
