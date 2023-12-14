<html>
<head>
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
        text-align: "."center;
    }
</style>

</head>

<body>
    <div class="container-fluid" id="contentToConvert">
        <div class="row">
            <div class="col-md-12">
                <table width="100%" style="font-family: sans-serif;" cellpadding="10">
                    <tr >
                        <td width="100%"></td>
                        <td width="100%" style="padding: 0px 40px;">
                            <h1 style="font-weight: bold"> INVOICE</h1>
                        </td>
                    </tr>
                    <tr>
                        <td width="100%" style=" font-size: 20px; font-weight: bold; padding: 40px;">
                            <img src="{{ asset('dashboard') }}/assets/images/localcarz.png" alt="logo.png" height="auto"
                        width="100">
                        </td>
                        <td  width="100%" style="font-size: 14px; padding: 40px; ">

                            <p>LocalCarz.com</p>
                            <p>8080 Howells Ferry Rd. <br/>Semmes, AL 36575</p><br/>


                            <p>Phone: (251) 281-8666</p>
                           <a href="https://localcarz.com/">localcarz.com</a>

                        </td>
                    </tr>
                </table>
                <hr>
                <table width="100%" style="font-family: sans-serif; " cellpadding="10" >
                    <tr>
                        <td width="100%" style=" font-size: 14px;  padding: 40px;">
                            <p style="font-weight: bold; opacity:50%">BILL TO</p>
                            <p>{{ $products->user->username ?? '' }}</p>
                            <p>Contact Name - {{ $products->user->username ?? '' }}</p><br/>
                            <p>+1 {{ $products->user->phone ?? '' }}</p>
                            <p>{{ $products->user->email ?? '' }}</p>


                        </td>
                        <td  width="100%" style="font-size: 14px;  padding: 40px; ">
                          <p> <span style="font-weight: bold">Invoice No:</span>  {{$products->invoice_id}}</p>
                        @php
                        $dateTime = new DateTime(now());
                        // Format the date as "j F Y" (day, month, year)
                        $formattedDate = $dateTime->format('F j, Y');

                        @endphp
                         <p> <span style="font-weight: bold">Invoice Date:</span> {{ $formattedDate }}</p>
                         <p> <span style="font-weight: bold">Amount Due (USD):</span> {{ $products->total}}</p>
                         <p style="margin:2px;"><img src="{{ asset('dashboard') }}/images/credit.jpg" alt="card" height="auto"
                            width="20"> <a href="#" target="_blank" style="color:#2FB4CC"> Pay Securely Online</a></p>
                        </td>
                    </tr>

                </table>
                <table class="items table table-bordered" width="100%" style="font-size: 14px;"
                    cellpadding="8">
                    <thead >
                        <tr style="background-color: #EB172C;color:white;font-weight:bold">
                            <td width="20%" style="text-align: left;"><strong>Listing</strong></td>
                            <td width="20%" style="text-align: center;"><strong>Quantity</strong></td>
                            <td width="20%" style="text-align: center;"><strong>Amount</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_inventory = 0;
                        $total_banner = 0;
                        $total_slider = 0;
                     @endphp

                     <!-- ITEMS HERE -->
                     @if (!empty($inventory))
                     @foreach ($inventory as $in)
                     @php
                     $total_inventory += 20; // Update the total based on your actual calculation
                     @endphp

                     @endforeach

                     <tr>
                        {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                        <td style="padding:3px 7px; line-height: 20px;"> Feature Listing
                        </td>
                        <td style="padding:3px 7px; line-height: 20px;"  align="center">
                          {{ count($inventory) }}

                        </td>
                        <td style="padding: 3px 7px; line-height: 20px;" align="center"> <input type="text" value="${{$total_inventory}}" disabled class="amount-input"></td>
                    </tr>

                    @endif
                    @if (!empty($banner))

                    @foreach ($banner as $bn)
                    @php
                    $total_banner += 100; // Update the total based on your actual calculation
                    @endphp

                    @endforeach
                    <tr>
                        {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                        <td style="padding:3px 7px; line-height: 20px;" >Banner
                        </td>
                        <td style="padding:3px 7px; line-height: 20px;"  align="center">
                          {{ count($banner) }}

                        </td>

                        <td style="padding: 3px 7px; line-height: 20px;"  align="center" class="amount-input"><input type="text" class="amount-input" disabled value=" ${{$total_banner}}"></td>
                    </tr>
                    @endif

                    @if (!empty($slider))

                    @foreach ($slider as $si)
                        @php
                        $total_slider += 200; // Update the total based on your actual calculation
                        @endphp

                    @endforeach
                    <tr>
                        {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                        <td style="padding:3px 7px; line-height: 20px;">Slider
                        </td>
                        <td style="padding:3px 7px; line-height: 20px;"  align="center">
                          {{ count($slider) }}

                        </td>

                        <td style="padding: 3px 7px; line-height: 20px;"  align="center" class="amount-input"><input type="text" disabled value=" ${{$total_slider}}" class="amount-input"></td>
                    </tr>
                    @endif



                    </tbody>
                </table>
                <br>
                <table width="100%" style="font-family: sans-serif; font-size: 14px;">
                    <tr>
                        <td>
                            <table width="60%" align="left" style="font-family: sans-serif; font-size: 14px;">
                                <tr>
                                    <td style="padding: 0px; line-height: 20px;">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="30%" align="right" style="font-family: sans-serif; font-size: 14px;">
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Subtotal: </strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$products->subtotal}}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Discount :</strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{($products->discount)? $products->discount .'%' : ''}}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Total :</strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$products->total}}</td>
                                </tr>

                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Amount Due (USD):</strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$products->total}}</td>

                                </tr>




                            </table>
                        </td>
                    </tr>
                </table>
                <div style="height: 110px;
                width: 30%;
                background-color: #ddd;
                float: right; margin:0 auto;margin-top:20px;border-radius:10px;">

                <button style="border: none;
                background-color: black;
                color: white;
                margin-top: 19px;
                margin-left: 10%;
                padding: 10px;
                border-radius: 10px;font-weight:bold;margin-bottom:15px">Pay Securely Online</button><br/>
                <img src="{{asset('dashboard/images/visa.jpg')}}" alt="" width="30px" style="margin-left:2px ">
                <img src="{{asset('dashboard/images/mastercard.png')}}" alt="" width="30px"  style="margin-left:2px " >
                <img src="{{asset('dashboard/images/discover.png')}}" alt="" width="30px"  style="margin-left:2px ">
                <img src="{{asset('dashboard/images/bank-transfer.png')}}" alt="" width="30px"  style="margin-left:2px ">
                <img src="{{asset('dashboard/images/american.png')}}" alt="" width="30px"  style="margin-left:2px ">

                </div>


                <div style="display: block;margin-top:60px;margin-bottom:50px">
                   <p style="font-weight: bold">Notes / Terms</p>
                   <p> Make check payable to 'Local Carz' or you can <br/>
                    electronically send the payment. ACH info</p>
                    <p> Account name- Local Carz</p>
                    <p> Account name- Anryd Enterprises LLC.</p>
                    <p>  Bank Name- Wells Fargo, N.A.</p>
                    <p> Account number- 12345678</p>
                    <p>  Routing number- 062000080</p>
                    <p style="margin-left:4%;font-size:12px;opacity:50%; margin-top:10px">PS: Please ignore the credit card payment option. (Charges 3.5% credit card processing/transaction fee).</p>
                </div>


                <table width="100%" style="font-family: sans-serif;margin-top:60px;" cellpadding="10">
                    <tr >
                        <td width="100%"></td>
                        <td width="100%" style="padding: 0px 40px;">
                            <h1 style="font-weight: bold"> INVOICE</h1>
                        </td>
                    </tr>
                    <tr>
                        <td width="100%" style=" font-size: 20px; font-weight: bold; padding: 40px;">
                            <img src="{{ asset('dashboard') }}/assets/images/localcarz.png" alt="logo.png" height="auto"
                        width="100">
                        </td>
                        <td  width="100%" style="font-size: 14px; padding: 40px; ">

                            <p>LocalCarz.com</p>
                            <p>8080 Howells Ferry Rd. <br/>Semmes, AL 36575</p><br/>


                            <p>Phone: (251) 281-8666</p>
                           <a href="https://localcarz.com/">localcarz.com</a>

                        </td>
                    </tr>
                </table>


                <table class="items table table-bordered" width="100%" style="font-size: 14px;"
                    cellpadding="8">
                    <thead >
                        <tr style="background-color: #EB172C;color:white;font-weight:bold">
                            <td width="10%" style="text-align: left;"  ><strong>Stock#</strong></td>
                            <td width="40%" style="text-align: left;" ><strong>Title</strong></td>
                            <td width="25%" style="text-align: center;" ><strong>Feature Start</strong></td>
                            <td width="25%" style="text-align: center;" ><strong>Feature End</strong></td>
                        </tr>
                    </thead>
                    <tbody>


                     <!-- ITEMS HERE -->
                     @if (!empty($inventory))
                     @foreach ($inventory as $inven)
                     <tr>
                        {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                        <td style="padding:3px 7px; line-height: 20px;" >{{ $inven->stock}}
                        </td>
                        <td style="padding:3px 7px; line-height: 20px;">
                            {{  $inven->title }}

                        </td>

                        <td style="padding:3px 7px; line-height: 20px;"  align="center">
                            {{  $products->created_at ? Carbon\Carbon::parse( $products->created_at)->format('m-d-Y') : 'Null' }}

                        </td>
                        <td style="padding:3px 7px; line-height: 20px;"  align="center">
                            {{ $products->created_at ? Carbon\Carbon::parse($products->created_at)->addDays(30)->format('m-d-Y') : 'Null' }}

                        </td>

                     @endforeach



                    @endif

                    @if (!empty($banner))
                    @foreach ($banner as $banner)
                    <tr>
                       {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                       <td style="padding:3px 7px; line-height: 20px;"  align="center">
                       </td>
                       <td style="padding:3px 7px; line-height: 20px;"  align="center">{{ $banner->name}}
                       </td>
                       {{-- <td style="padding:3px 7px; line-height: 20px;"  align="center">
                           {{  $banner->created_at ? Carbon\Carbon::parse(  $banner->created_at)->format('m-d-Y') : 'Null' }}

                       </td>
                       <td style="padding:3px 7px; line-height: 20px;"  align="center">

                           {{   $banner->created_at ? Carbon\Carbon::parse(  $banner->created_at)->addDays(30)->format('m-d-Y') : 'Null' }}

                       </td> --}}
                       <td style="padding:3px 7px; line-height: 20px;"  align="center">
                           {{  $products->created_at ? Carbon\Carbon::parse( $products->created_at)->format('m-d-Y') : 'Null' }}

                       </td>
                       <td style="padding:3px 7px; line-height: 20px;"  align="center">
                           {{ $products->created_at ? Carbon\Carbon::parse($products->created_at)->addDays(30)->format('m-d-Y') : 'Null' }}

                       </td>

                    @endforeach



                   @endif

                   @if (!empty($slider))
                   @foreach ($slider as $slider)
                   <tr>
                      {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                      <td style="padding:3px 7px; line-height: 20px;"  align="center">
                      </td>
                      <td style="padding:3px 7px; line-height: 20px;"  align="center">{{ $slider->title}}
                      </td>
                      {{-- <td style="padding:3px 7px; line-height: 20px;"  align="center">
                          {{  $slider->created_at ? Carbon\Carbon::parse(  $slider->created_at)->format('m-d-Y') : 'Null' }}

                      </td>
                      <td style="padding:3px 7px; line-height: 20px;"  align="center">

                          {{   $slider->created_at ? Carbon\Carbon::parse(  $slider->created_at)->addDays(30)->format('m-d-Y') : 'Null' }}

                      </td> --}}
                      <td style="padding:3px 7px; line-height: 20px;"  align="center">
                          {{  $products->created_at ? Carbon\Carbon::parse( $products->created_at)->format('m-d-Y') : 'Null' }}

                      </td>
                      <td style="padding:3px 7px; line-height: 20px;"  align="center">
                          {{ $products->created_at ? Carbon\Carbon::parse($products->created_at)->addDays(30)->format('m-d-Y') : 'Null' }}

                      </td>

                   @endforeach



                  @endif



                    </tbody>
                </table>

            </div>

        </div>
    </div>
</body>
</html>
