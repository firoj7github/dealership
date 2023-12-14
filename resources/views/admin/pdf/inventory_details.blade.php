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
                <table class="items table table-bordered" width="100%" style="font-size: 14px;"
                   >

                    <tbody align="center">
                        <tr>
                            <td align="center">

                                <img src="{{ $data['image'] }} " alt="" width="100%"/> <br>
                            </td>
                        </tr>

                        <tr>
                            <td align="left"
                                style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;color:#575757;font-size:16px;line-height:150%;padding:0px 50px 30px 50px">
                                <p>Title : {{$data['title']}}</p>
                                <p>Stock : {{ $data['stock']}}</p>
                                <p>Vin : {{ $data['vin']}}</p>
                                <p>Fuel Type : {{ $data['fuel']}}</p>
                                <p>Mileage : {{$data['miles']}}</p>
                                <p>Engine : {{$data['engine_cylinder']}}</p>
                                </td>
                            <td align="right"
                                style="text-align:justify;vertical-align:top;padding-right:50px;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;color:#575757;font-size:16px;line-height:150%;padding:0px 50px 30px 50px">
                                <p>Year:  {{ $data['year']}}</p>
                                <p>Condition :  {{ $data['condition']}}</p>
                                <p>Transmission :  {{ $data['transmission']}}</p>
                                <p>Model:  {{ $data['model']}}</p>
                                <p> Color :  {{$data['ext_color_generic']}}</p>
                                <p> Drive Train : {{$data['drive_train']}}</p>
                            </td>
                        </tr>




                    </tbody>
                </table>

            </div>

        </div>
    </div>
</body>
</html>
