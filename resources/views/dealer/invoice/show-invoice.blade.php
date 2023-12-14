@extends('dealer.layouts.app')
@section('title', 'Inventory Invoice List | ')
@push('css')
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        p {
            margin: 0pt;
        }

        table.items {
            border: 0.1mm solid #e7e7e7;
        }

        td {
            vertical-align: top;
        }

        .items td {
            border-left: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }

        table thead td {
            text-align: center;
            border: 0.1mm solid #e7e7e7;
        }

        .items td.blanktotal {
            background-color: #EEEEEE;
            border: 0.1mm solid #e7e7e7;
            background-color: #FFFFFF;
            border: 0mm none #e7e7e7;
            border-top: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }

        .items td.totals {
            text-align: right;
            border: 0.1mm solid #e7e7e7;
        }

        .items td.cost {
            text-align: "." center;
        }
    </style>
@endpush
@php
    $invoiceData = Session::get('invoice_data');
@endphp
@section('content')
    <div class="page-content-tab">

        <div class="container-fluid" id="contentToConvert">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                            <a href="#" onclick="NewInvoice()" class="btn btn-primary float-right ">
                                <i class="fa-solid fa-file-invoice-dollar"></i> Create Invoice
                            </a>




                        </div>
                    </div>
                </div>
                <div class="col-md-12">

                    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
                        <tr>
                            <td width="100%"></td>
                            <td width="100%" style="padding: 0px 40px;">
                                <h1 style="font-weight: bold"> INVOICE</h1>
                            </td>
                        </tr>
                        <tr>
                            <td width="100%" style=" font-size: 20px; font-weight: bold; padding: 40px;">
                                <img src="{{ asset('dashboard') }}/assets/images/localcarz.png" alt="logo.png"
                                    height="auto" width="100">
                            </td>
                            <td width="100%" style="font-size: 14px; padding: 40px; ">

                                <p>LocalCarz.com</p>
                                <p>8080 Howells Ferry Rd. <br /> Semmes, AL 36575</p><br />


                                <p>Phone: (251) 281-8666</p>
                                <a href="https://localcarz.com/">localcarz.com</a>

                            </td>
                        </tr>
                    </table>
                    <hr>

                    <table width="100%" style="font-family: sans-serif; " cellpadding="10">
                        <tr>
                            <td width="100%" style=" font-size: 14px;  padding: 40px;">
                                <p style="font-weight: bold; opacity:50%">BILL TO</p>
                                @if (!empty($userInfo))
                                    @foreach ($userInfo as $user)
                                        <p>Contact Name - {{ $user->user->username ?? '' }}</p>
                                        <p>+1 {{ $user->user->phone ?? '' }}</p>
                                        <p>{{ $user->user->email ?? '' }}</p>
                                        <input type="hidden" value="{{ $user->user->id }}" id="user_id">
                                        <br />
                                    @endforeach
                                @endif

                            </td>
                            <td width="100%" style="font-size: 14px;  padding: 40px; ">
                                <p> <span style="font-weight: bold">Invoice No:</span></p>
                                @php
                                    $dateTime = new DateTime(now());
                                    // Format the date as "j F Y" (day, month, year)
                                    $formattedDate = $dateTime->format('F j, Y');

                                @endphp
                                <p> <span style="font-weight: bold">Invoice Date:</span> {{ $formattedDate }}</p>
                                <p id="top-total"> <span style="font-weight: bold">Amount Due (USD):</span></p>
                                <p style="margin:2px;"> <a href="#" target="_blank" style="color:#2FB4CC"> <i
                                            class="fa-regular fa-credit-card" style="margin-right: 3px"></i> Pay Securely
                                        Online</a></p>
                            </td>
                        </tr>

                    </table>
                    @if (!empty($invoiceData))
                            <table class="items table table-bordered" width="100%" style="font-size: 14px;"
                                cellpadding="8">
                                <thead>
                                    <tr style="background-color: #EB172C;color:white;font-weight:bold">
                                        {{-- <td width="15%" style="text-align: left;"><strong>Stock#</strong></td> --}}
                                        <td width="20%" style="text-align: left;" align="center"><strong>Listing</strong>
                                        </td>
                                        <td width="20%" style="text-align: left;" align="center">
                                            <strong>Quantity</strong>
                                        </td>
                                        {{-- <td width="20%" style="text-align: left;"><strong>Start Date</strong></td>
                                <td width="20%" style="text-align: left;"><strong>End Date</strong></td> --}}
                                        <td width="20%" style="text-align: left;" align="center"><strong>Amount</strong>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_inventory = 0;
                                        $total_banner = 0;
                                        $total_slider = 0;
                                    @endphp
                                    <!-- ITEMS HERE -->
                                    @if (!empty($invoiceData['inventory_ids']))
                                        @foreach ($invoiceData['inventory_ids'] as $inventoryId)
                                            @php
                                                $total_inventory += 20; // Update the total based on your actual calculation
                                            @endphp
                                        @endforeach
                                        <tr>
                                            {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                                            <td style="padding:3px 7px; line-height: 20px;" align="center"> Feature Listing
                                            </td>
                                            <td style="padding:3px 7px; line-height: 20px;" align="center">
                                                {{ count($invoiceData['inventory_ids']) }}

                                            </td>
                                            <td style="padding: 3px 7px; line-height: 20px;" align="center"> <input
                                                    type="text" value="{{ $total_inventory }}" disabled
                                                    class="amount-input"></td>
                                        </tr>
                                    @endif
                                    @if (!empty($invoiceData['banner_ids']))
                                        @foreach ($invoiceData['banner_ids'] as $inventoryId)
                                            @php
                                                $total_banner += 100; // Update the total based on your actual calculation
                                            @endphp
                                        @endforeach
                                        <tr>
                                            {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                                            <td style="padding:3px 7px; line-height: 20px;" align="center">Banner
                                            </td>
                                            <td style="padding:3px 7px; line-height: 20px;" align="center">
                                                {{ count($invoiceData['banner_ids']) }}

                                            </td>

                                            <td style="padding: 3px 7px; line-height: 20px;" align="center"
                                                class="amount-input"><input type="text" class="amount-input" disabled
                                                    value="{{ $total_banner }}"></td>
                                        </tr>
                                    @endif

                                    @if (!empty($invoiceData['slider_ids']))
                                        @foreach ($invoiceData['slider_ids'] as $inventoryId)
                                            @php
                                                $total_slider += 200; // Update the total based on your actual calculation
                                            @endphp
                                        @endforeach
                                        <tr>
                                            {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                                            <td style="padding:3px 7px; line-height: 20px;" align="center">Slider
                                            </td>
                                            <td style="padding:3px 7px; line-height: 20px;" align="center">
                                                {{ count($invoiceData['slider_ids']) }}

                                            </td>

                                            <td style="padding: 3px 7px; line-height: 20px;" align="center"
                                                class="amount-input"><input type="text" disabled
                                                    value="{{ $total_slider }}" class="amount-input"></td>
                                        </tr>
                                    @endif



                                </tbody>
                            </table>
                            <br>
                            <table width="100%" style="font-family: sans-serif; font-size: 14px;">
                                <tr>
                                    <td>
                                        <table width="60%" align="left"
                                            style="font-family: sans-serif; font-size: 14px;">
                                            <tr>
                                                <td style="padding: 0px; line-height: 20px;">&nbsp;</td>
                                            </tr>
                                        </table>
                                        <table width="20%" align="right"
                                            style="font-family: sans-serif; font-size: 14px;">
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                                    <strong>Subtotal: </strong>
                                                </td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"
                                                    >
                                                   <input type="text" id="subtotal" class="subtotal" value="${{ $total_inventory+ $total_slider + $total_banner  }}" disabled />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                                    <strong>Discount: </strong>
                                                </td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                                    <div class="input-group">
                                                        <input type="text" name="discount" class="form-control"
                                                            id="discount">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                                    <strong>Total :</strong>
                                                </td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                                    <input type="text" id="total" disabled>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                                    <strong>Amount Due (USD):</strong>
                                                </td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"
                                                    id="another-total"></td>

                                            </tr>


                                        </table>
                                    </td>
                                </tr>
                            </table>
                    @endif
                    <div
                        style="height: 125px;
                    width: 20%;
                    background-color: #ddd;
                    float: right; margin:0 auto;margin-top:20px;border-radius:10px">

                        <button
                            style="border: none;
                    background-color: black;
                    color: white;
                    margin-top: 19px;
                    margin-left: 30%;
                    padding: 10px;
                    border-radius: 10px;font-weight:bold;margin-bottom:5px">Pay
                            Securely Online</button><br />

                        <ul style="margin-left:20%;margin-top:10px">

                            <li style="float: left;margin-left:10px"> <img src="{{ asset('dashboard/images/visa.jpg') }}"
                                    alt="" width="30px"></li>
                            <li style="float: left;margin-left:10px"> <img
                                    src="{{ asset('dashboard/images/mastercard.png') }}" alt="" width="30px">
                            </li>
                            <li style="float: left;margin-left:10px"> <img
                                    src="{{ asset('dashboard/images/discover.png') }}" alt="" width="30px">
                            </li>
                            <li style="float: left;margin-left:10px"><img
                                    src="{{ asset('dashboard/images/bank-transfer.png') }}" alt=""
                                    width="30px"></li>
                            <li style="float: left;margin-left:10px"> <img
                                    src="{{ asset('dashboard/images/american.png') }}" alt="" width="30px">
                            </li>
                        </ul>

                    </div>

                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />

                    <table width="100%"
                        style="font-family: sans-serif; font-size: 14px; position: absolute; bottom:0;margin-top:20px">
                        <br>
                        <tr>
                            <td>
                                <table style="font-family: sans-serif; font-size: 13px;">
                                    <tr>
                                        <td style="padding: 0px; line-height: 20px;">
                                            <span style="font-weight: bold">Notes / Terms</span>
                                            <br>
                                            Make check payable to 'Local Carz' or you can <br />
                                            electronically send the payment. ACH info
                                            <br>
                                            Account name- Local Carz
                                            <br>
                                            Bank Name- Wells Fargo, N.A.
                                            <br>
                                            Account number- 12345678
                                            <br>
                                            Routing number- 062000080
                                            <br>
                                            <br>
                                            <br>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <br>
                    </table>
                    <p style="margin-left:4%; opacity:50%;font-size:12px">PS: Please ignore the credit card payment option.
                        (Charges 3.5% credit card processing/transaction fee).</p>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('page_js')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Assuming you have jQuery included
    $(document).ready(function() {
        // Watch for changes in the amount input
        $('.amount-input').on('input', function() {
            updateSubtotalAndTotal();
        });

        // Watch for changes in the discount input
        $('#discount').on('input', function() {
            updateSubtotalAndTotal();
        });

        // Function to update subtotal and total
        function updateSubtotalAndTotal() {
            var total = 0;

            // Loop through each row
            $('.amount-input').each(function() {
                var amount = parseFloat($(this).val()) || 0;
                total += amount;
            });

            // Get the discount percentage value
            var discountPercentage = parseFloat($('#discount').val()) || 0;

            // Calculate the updated subtotal
            var subtotal = total - (total * discountPercentage / 100);

            // Update the Subtotal and Total fields with the updated values
            $('#total').val('$' + subtotal.toFixed(2));
            $('#subtotal').text('$' + total.toFixed(2));
            $('#another-total').text('$' + subtotal.toFixed(
                2)); // Assuming you want 'another-total' to have the same value as subtotal
            $('#top-total').text('Amount Due (USD): $' + subtotal.toFixed(2));
        }

        updateSubtotalAndTotal();
    });


    // click new invoice create button

    function NewInvoice() {


        var user_id = $('#user_id').val();
        var discount = $('#discount').val();
        var total = $('#total').val();
        var subtotal = $('#subtotal').val();
        //  console.log(user_id);

        $.ajax({
            url: "{{ route('dealer.invoice.new.store') }}", // Replace with your server endpoint
            method: 'POST',
            dataType: 'json',
            data: {
                invoiceData: @json($invoiceData),
               user_id:user_id,
               discount:discount,
               total:total,
               subtotal:subtotal,
            },
            success: function(response) {

                // console.log(response);
                // Handle the response from the server
                if(response.status == 'success')
                {

                    toastr.success("Invoice create successfully");
                    window.location.href = '/dealer/invoice/'+user_id;

                }
            },

        });
    }


</script>
@endpush
