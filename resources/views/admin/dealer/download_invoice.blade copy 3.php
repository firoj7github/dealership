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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table width="100%" style="font-family: sans-serif;" cellpadding="10">
                    <tr style="background-color: #d1d1d1;">
                        <td width="100%" style=" font-size: 20px;  padding: 40px;">
                            INVOICE
                        </td>
                        <td  width="100%" style="font-size: 14px;  padding: 40px; ">
                            Invoice No: <?php echo rand(1234,9999);?> <br/>
                            @php
                            $dateTime = new DateTime(now());
                            // Format the date as "j F Y" (day, month, year)
                            $formattedDate = $dateTime->format('j F Y');

                            @endphp
                            Date: {{ $formattedDate }}
                        </td>
                    </tr>
                    <tr>
                        <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;
                        </td>
                    </tr>
                </table>
                <table width="100%" style="font-family: sans-serif; " cellpadding="10" >
                    <tr>
                        <td width="100%" style=" font-size: 14px;  padding: 40px;">
                            <p style="font-weight: bold">Dealer Information</p><br/>
                            @if ($inventories)
                            @isset($inventories[0]->user)
                            <p>Name: {{ $inventories[0]->user->username ?? '' }}</p><br/>
                            <p>Cell: +1 {{ $inventories[0]->user->phone ?? '' }}</p><br/>
                            <p>Address: 7410 Airport Blvd Mobile, AL 36608</p>

                            @endisset

                        @endif

                        </td>
                        <td  width="100%" style="font-size: 14px;  padding: 40px; ">
                            <p style="font-weight: bold">Company Information</p><br/>
                            <p>Name: localcarz</p><br/>
                            <p>E-mail: ofarid@accessenterprise.com</p><br/>
                        </td>
                    </tr>
                    <tr>
                        <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;
                        </td>
                    </tr>
                </table>

                <br>
                <table class="items table table-bordered" width="100%" style="font-size: 14px;"
                    cellpadding="8">
                    <thead style="background: red;color:#fff">
                        <tr>
                            <td width="15%" style="text-align: left;"><strong>#</strong></td>
                            <td width="45%" style="text-align: left;"><strong>Description</strong></td>
                            <td width="20%" style="text-align: left;"><strong>Miles</strong></td>
                            <td width="20%" style="text-align: left;"><strong>Unit Price</strong></td>
                            <td width="20%" style="text-align: left;"><strong>Total</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ITEMS HERE -->
                        @php
                        $total = 0;
                        @endphp
                        @forelse ($inventories as $inventory )

                        <tr>
                            <td style="padding:3px 7px; line-height: 20px;">{{$loop->iteration}}</td>
                            <td style="padding:3px 7px; line-height: 20px;">{{$inventory->title}}</td>
                            <td style="padding:3px 7px; line-height: 20px;">{{$inventory->miles}}</td>
                            <td style="padding:3px 7px; line-height: 20px;">$20</td>
                            <td style="padding: 3px 7px; line-height: 20px;">$20</td>
                        </tr>
                        @php
                        $total += 20; // Update the total based on your actual calculation
                        @endphp
                        @empty
                        <tr>
                            <td colspan="4" style="padding:5px 7px; line-height: 20px;"><h3 class="text-center">No Feature Car</h3></td>

                        </tr>
                        @endforelse

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
                            <table width="40%" align="right" style="font-family: sans-serif; font-size: 14px;">
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Total Amount</strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">${{$total}}</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
                <br>
                {{-- <table width="100%" style="font-family: sans-serif; font-size: 14px; position: absolute; bottom:50%;">
                    <br>
                    <tr>
                        <td>
                            <table width="50%" align="center"
                                style="font-family: sans-serif; font-size: 13px; text-align: center;">
                                <tr>
                                    <td style="padding: 0px; line-height: 20px;">
                                        <strong>Company Name</strong>
                                        <br>
                                        Localcarz
                                        <br>
                                        Tel: +00 000 000 0000 | Email: info@localcarz.com
                                        <br>
                                        Company Registered in America. Company Reg. 12121212.
                                        <br>
                                        VAT Registration No. 021021021 | ATOL No. 1234
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <br>
                </table> --}}
            </div>

        </div>
    </div>
</body>
</html>
