@extends('layouts.app')

@push('css')
<style>
    .divide
    {
        height: 2px;
        width: 100%;
        background-color: #ddd;
        margin: 30px 0px;
    }
    .map-container{
  overflow:hidden;
  padding-bottom:56.25%;
  position:relative;
  height:0;
}
.map-container iframe{
  left:0;
  top:0;
  height:100%;
  width:100%;
  position:absolute;
}
.line_height
    {
        position: relative;
        line-height: 63px;
    }
    .heading_content h3::before {
    background-color: #242424;
    bottom: 6px;
    content: "";
    height: 1px;
    left: 0;
    margin: 0 auto;
    right: 0;
    position: absolute;
    width: 99px;
}
.heading_content h3::after {
    background-color: #242424;
    bottom: 0;
    content: "";
    height: 1px;
    left: 0;
    margin: 0 auto;
    position: absolute;
    right: 0;
    width: 59px;
}
</style>
@endpush

@section('content')
<div class="page-content-tab">

    <div class="container-fluid" id="contentToConvert">
        <div class="row">
            <div class="col-md-12">
                <h2>Create New <span class="invoice_type">Invoice</span> </h2>
                <!-- <hr> -->

                <div id="response" class="alert alert-success" style="display:none;">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <div class="message"></div>
                </div>

                <form method="post" id="create_invoice">
                    <div class="row">
                        <div class="col-md-4" style="margin-top: 67px">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3>Select User:</h3>
                                </div>
                                <div class="col-md-8">
                                    <select name="user_select" class="form-control">
                                        <option value="">~select user ~ </option>
                                        @forelse ($users as $user)
                                        <option value="{{$user->id}}">{{$user->username}}</option>
                                        @empty
                                            no user
                                        @endforelse

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="float-right">Select Type:</h3>
                                </div>
                                <div class="col-md-3">
                                    <select name="invoice_type" id="invoice_type" class="form-control">
                                        <option value="invoice" selected>Invoice</option>
                                        <option value="receipt">Receipt</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="invoice_status" id="invoice_status" class="form-control">
                                        <option value="open" selected>Open</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                                <div class="col-md-4 no-padding-right">
                                    <div class="form-group">
                                        <label for="">Invoice Date</label>
                                        <div class="input-group date" id="invoice_date">
                                         <input type="date" class="form-control required" name="invoice_date"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Due Date</label>
                                        <div class="input-group date" id="invoice_due_date">
                                            <input type="date" class="form-control required" name="invoice_due_date" />

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Invoice Number</label>
                                        <div class="input-group">
                                            <input type="text" name="invoice_id" id="invoice_id" class="form-control required" placeholder="Invoice Number">

                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>

                    <!-- / end client details section -->
                    <table class="table table-bordered table-hover table-striped" id="invoice_table">
                        <thead>
                            <tr>
                                <th width="500">
                                    <h4><a href="#" class="btn  btn-xs add-row"><i class="fa-solid fa-circle-plus"></i></a>Listing</h4>
                                </th>
                                <th>
                                    <h4>Qty</h4>
                                </th>
                                <th>
                                    <h4>Price</h4>
                                </th>
                                <th width="300">
                                    <h4>Discount</h4>
                                </th>
                                <th>
                                    <h4>Sub Total</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group form-group-sm  no-margin-bottom">
                                        <a href="#" class="btn btn-danger btn-xs delete-row"><i class="fa-solid fa-circle-minus"></i></a>
                                        <input type="text" class="form-control form-group-sm item-input invoice_product" name="invoice_product[]" placeholder="Enter Product Name OR Description">
                                        <p class="item-select">or <a href="#">select a product</a></p>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="form-group form-group-sm no-margin-bottom">
                                        <input type="number" class="form-control invoice_product_qty calculate" name="invoice_product_qty[]" value="1">
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="input-group input-group-sm  no-margin-bottom">
                                        <span class="input-group-addon"><?php //echo CURRENCY ?></span>
                                        <input type="number" class="form-control calculate invoice_product_price required" name="invoice_product_price[]" aria-describedby="sizing-addon1" placeholder="0.00">
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="form-group form-group-sm  no-margin-bottom">
                                        <input type="text" class="form-control calculate" name="invoice_product_discount[]" placeholder="Enter % OR value (ex: 10% or 10.50)">
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon"><?php //echo CURRENCY ?></span>
                                        <input type="text" class="form-control calculate-sub" name="invoice_product_sub[]" id="invoice_product_sub" value="0.00" aria-describedby="sizing-addon1" disabled>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </form>


            </div>
        </div>
    </div>
</div>


@endsection
@push('delear_JS')
 <script>
       $.ajaxSetup({
        beforeSend: function(xhr, type) {
            if (!type.crossDomain) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
        },
    });


// $(document).ready(function(){

// $('#changePasswordForm').on('submit',function(e){
//     e.preventDefault();
//     $.ajax({
//         url: $(this).attr("action"),
//         method: $(this).attr("method"),
//         data: new FormData(this),
//         processData: false,
//         datatype: JSON,
//         contentType: false,
//         success: function (response) {


//             var errors = response.errors;
//             if(response.old_password)
//                 {
//                     $('.invalid-feedback1').text(response.old_password);
//                 }

//             if(errors)
//             {
//                 if(errors.confirm_password)
//                 {
//                     $('.invalid-feedback3').text(errors.confirm_password);
//                 }
//                 if(errors.current_password)
//                 {
//                     $('.invalid-feedback1').text(errors.current_password);
//                 }
//                 if(errors.new_password)
//                 {
//                     $('.invalid-feedback2').text(errors.new_password);
//                 }

//             }




//             if(response.message)
//             {
//                 toastr.success(response.message);
//                 $('#changePassword').modal('hide');
//                 $('#changePasswordForm')[0].reset();

//             }



//         }
//     });


// });

// });


//      $(document).ready(function () {
//         // When the file input changes
//         $("#imageInput").change(function () {
//             readURL(this);
//         });

//         // Function to read the URL and display the image preview
//         function readURL(input) {
//             if (input.files && input.files[0]) {
//                 var reader = new FileReader();

//                 reader.onload = function (e) {
//                     // Display the image preview
//                     $("#imagePreview").attr("src", e.target.result).show();
//                 };

//                 // Read the file as a data URL
//                 reader.readAsDataURL(input.files[0]);
//             }
//         }
//     });
 </script>
  @endpush

