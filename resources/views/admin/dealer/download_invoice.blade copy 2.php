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
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="100%" style="padding: 0px; text-align: center;">
              <a href="#" target="_blank"><img src="{{ asset('dashboard') }}/assets/images/localcarz.png" width="100" height="auto" alt="Logo" align="center" border="0"></a> <br>
            </td>
        </tr>
        <tr>
            <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
              INVOICE
            </td>
        </tr>
        <tr>
          <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="49%" style="border: 0.1mm solid #eee;">Name: <strong>{{ $inventory->user->username }}</strong><br>Cell: <strong> {{ $inventory->user->phone }}</strong><br>Address: <br><strong>{{ ($inventory->user->address)? $inventory->user->address :'' }}</strong></td>
            <td width="2%">&nbsp;</td>
            @php
            $dateTime = new DateTime(now());
            // Format the date as "j F Y" (day, month, year)
            $formattedDate = $dateTime->format('j F Y');
            @endphp
            <td width="49%" style="border: 0.1mm solid #eee; text-align: right;"><strong>Stock Number</strong><br><strong>#{{ $inventory->stock}}</strong><br><strong>Date:<br>{{$formattedDate}}</strong><br></td>
        </tr>
    </table>

    <br>
    <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr>
                <td width="15%" style="text-align: left;"><strong>#</strong></td>
                <td width="45%" style="text-align: left;"><strong>Feature Item</strong></td>
                <td width="20%" style="text-align: left;"><strong>Quantity</strong></td>
                <td width="20%" style="text-align: left;"><strong>Unit Price</strong></td>
                <td width="20%" style="text-align: left;"><strong>Total</strong></td>
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            <tr>
                <td style="padding: 0px 7px; line-height: 20px;">1</td>
                <td style="padding: 0px 7px; line-height: 20px;">{{ $inventory->title }}</td>
                <td style="padding: 0px 7px; line-height: 20px;">1</td>
                <td style="padding: 0px 7px; line-height: 20px;">$20</td>
                <td style="padding: 0px 7px; line-height: 20px;">$20</td>
            </tr>

        </tbody>
    </table>
    <br>
    <table width="100%" style="font-family: sans-serif; font-size: 14px;" >
        <tr>
            <td>
                <table width="60%" align="left" style="font-family: sans-serif; font-size: 14px;" >
                    <tr>
                        <td style="padding: 0px; line-height: 20px;">&nbsp;</td>
                    </tr>
                </table>
                <table width="40%" align="right" style="font-family: sans-serif; font-size: 14px;" >
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Total Amount</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">$20</td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" style="font-family: sans-serif; font-size: 14px; position: absolute; bottom:50%;">
        <br>
        <tr>
            <td>
                <table width="50%" align="center" style="font-family: sans-serif; font-size: 13px; text-align: center;" >
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
    </table>
</body>
</html>
