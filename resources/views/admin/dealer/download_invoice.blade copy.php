<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Invoice Generate</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="row mt-4" style="padding: 20px">
               <div class="col-md-6">
                    <div class="log">
                        <img src="{{ asset('dashboard') }}/assets/images/localcarz.png" alt="logo.png" height="auto"
                            width="100">
                    </div>
                    <div class="details mt-4">
                        <h3>Billed To:</h3>
                        <p>Name : {{ $inventory->user->username }}</p>
                        <p><i class="fa-solid fa-phone" style="color: #40d822;"></i> {{ $inventory->user->phone }}</p>
                        <p> {{ ($inventory->user->address)? '<i class="fa-solid fa-address-book" style="color: #299950;"></i>'.  $inventory->user->address :'' }}</p>
                    </div>
                </div>
                <div class="col-md-6 ">
                  <div class="invoice float-right" style="float: right">
                   <h3>Invoice</h3>
                    <h4 class="mt-4">Stock No: #{{ $inventory->stock}}</h4>
                    @php
                        $dateTime = new DateTime(now());
                        // Format the date as "j F Y" (day, month, year)
                        $formattedDate = $dateTime->format('j F Y');
                    @endphp
                    <p>{{ $formattedDate }}</p>
                  </div>
                </div>
            </div>

            <div class="col-md-12">
                <table class="table table-sm" border="1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Feature Item</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp

                            <tr>
                                <td>1</td>
                                <td>{{ $inventory->title }}</td>
                                <td>1</td>
                                <td>$20</td>
                                <td>$20</td>
                            </tr>
                            @php
                                $total += 20; // Update the total based on your actual calculation
                            @endphp



                        <tr>
                            <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                            <td>${{ $total }}</td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
