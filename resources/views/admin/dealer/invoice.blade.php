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
                                <div class="col-md-12 mt-4">
                                    <a href="{{ route('admin.user.information', $user->id) }}"
                                        class="btn btn-small btn-primary text-white">Account Information<a>
                                            <a href="{{ route('admin.dealer.listing', $user->id) }}"
                                                class="btn btn-small btn-primary text-white">Listing<a>
                                            <a href="#" class="btn btn-small btn-info text-white">Leads<a>
                                            <a href="{{ route('admin.dealer.banner', $user->id) }}"
                                                class="btn btn-small btn-success text-white">Banners<a>
                                            <a href="{{ route('admin.dealer.slider', $user->id) }}"
                                                class="btn btn-small btn-success text-white">Sliders<a>
                                            <a href="#"
                                                class="btn btn-small btn-primary text-white">Archived<a>
                                            <a href="{{ route('admin.dealer.invoice', $user->id) }}"
                                                class="btn btn-small btn-secondary text-white">Invoice<a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table  table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="font-size:14px;">S.N</th>
                                            <th style="font-size:14px;">Order_id</th>
                                            <th style="font-size:14px;">Inventory</th>
                                            <th style="font-size:14px;">Banner</th>
                                            <th style="font-size:14px;">
                                                Slider
                                            </th>
                                            <th style="font-size:14px;">
                                                Total
                                            </th>
                                            <th style="font-size:14px;">Status</th>
                                            <th style="font-size:14px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($invoicesTwo as $invoice)
                                            {{-- @dd($invoice) --}}
                                            <tr>

                                                <td class="fs-6">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    {{ $invoice->invoice_id }}
                                                </td>
                                                @php
                                                    $inventory = explode(',', $invoice->inventory_id);
                                                @endphp
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    @if (!empty($inventory))
                                                        {{ count($inventory) }}
                                                    @else
                                                        null
                                                    @endif
                                                </td>
                                                @php
                                                    $banner = explode(',', $invoice->banner_id);
                                                @endphp
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    @if (is_array($banner) && !empty($banner))
                                                        {{ count(array_filter($banner)) }}
                                                    @else
                                                        null
                                                    @endif
                                                </td>
                                                @php
                                                    $slider = explode(',', $invoice->slider_id);
                                                @endphp
                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    @if (is_array($slider) && !empty($slider))
                                                        {{ count(array_filter($slider)) }}
                                                    @else
                                                        null
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ $invoice->total }}
                                                </td>

                                                <td style="font-size:10px; font-weight:bold; opacity:97%">
                                                    <select class="form-control {{ $invoice->status == 1 ? 'bg-success' : '' }} status" onchange="statusChange({{ $invoice }})">
                                                        <option {{ $invoice->status == 1 ? 'selected' : '' }} value ="1">Paid</option>
                                                        <option {{ $invoice->status == 0 ? 'selected' : '' }} value ="0">Pending</option>
                                                    </select>
                                                </td>

                                                </td>


                                                <td>
                                                    <a href="{{ route('admin.invoice.pdf', ['id' => $invoice->id]) }}" target="_blank" title="download pdf" style="font-size: 20px;padding-right:5px"><i
                                                        class="fa-solid fa-file-pdf"></i></a>
                                                    <a href="{{ route('admin.invoice.email', ['id' => $invoice->id]) }}" title="send e-mail" target="_blank"  style="font-size: 20px;padding-right:5px">
                                                        <i class="fa-regular fa-paper-plane"></i>
                                                    </a>

                                                    <a href="#"
                                                    data-id="{{$invoice->id}}"
                                                    class="text-danger delete_two"  style="font-size: 20px;padding-right:5px">
                                                        <i class="fa fa-delete-left"></i>
                                                    </a>
                                                </td>


                                            </tr>
                                        @endforeach




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


        function statusChange(invoices)
        {
            var status = $('.status').val();


            $.ajax({
                url:"{{ route('admin.invoice.paid_pending')}}",
                method:"POST",
                data: {status:status,invoices:invoices},
                success: function(res){
                    console.log(res);
                    if(res.status == 'success')
                    {
                        toastr.success(res.message);
                        location.reload();
                    }
                    if(res.status == 'error')
                    {
                        toastr.warning(res.message);
                    }
                }

            });

        }

        $(document).ready(function(){
           $('.delete_two').on('click',function(){

            let id = $(this).data('id');
            $.confirm({
        title: 'Delete Confirmation',
        content: 'Are you sure?',
        buttons: {
            cancel: {
                text: 'No',
                btnClass: 'btn-primary',
                action: function() {
                    // Do nothing on cancel
                }
            },
            confirm: {
                text: 'Yes',
                btnClass: 'btn-danger',
                action: function() {
                    $.ajax({
                url:"{{route('admin.invoice.delete')}}",
                method:'post',
                data:{id:id},
                success:function(res){
                    console.log(res)
                }
            });

                }
            },

        }
    });





           });
        });


    </script>
@endpush
