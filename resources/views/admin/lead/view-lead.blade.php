@extends('layouts.app')

@push('css')

@endpush

@section('content')
    <div class="page-content-tab">

        <div class="container-fluid" id="contentToConvert">
            <div class="row">
                <div class="col-md-12">
                     <!-- Lead Details Modal  -->
    {{-- <div class="modal fade" id="LeadDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document"> --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lead Details-Source: Localcarz.com</h5>

            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow h-100">
                                <div class="card-header" style="background-color: #d9dcdf">
                                    <span> <i class="fa-solid fa-car"></i> | Vehicle: <span id="vehicle_name"
                                            style="display: inline"> {{$lead->inventories_car->title}}</span> </span>
                                </div>
                                <div class="card-body ">
                                    <div class="media">
                                        <img src="{{$lead->inventories_car->image}}" alt="" class="img-thumbnail"
                                            style="max-width: 50% !important;" id="email_image_car">
                                        <div class="media-body align-self-center ms-3 text-truncate ml-4">
                                            <h3 class="my-0 mb-2 "><b>Price:</b>$ <span id="price"
                                                    style="display: inline">{{$lead->inventories_car->price}}</span></h3>
                                            {{--<p class="my-0 mb-2 "><b>Average Price:</b>$ <span id="average_price"
                                                    style="display: inline"></span></p>--}}
                                            <h3 class="my-0 mb-2 "><b>Milleage:</b> <span id="milleage"
                                                    style="display: inline">{{$lead->inventories_car->miles}}</span> mi</h3>
                                            <h3 class="my-0 mb-2 "><b>Stock #:</b> <span id="stock"
                                                    style="display: inline">{{$lead->inventories_car->stock}}</span></h3>
                                            <h3 class="my-0 mb-2 "><b>Invoice Price:</b> <span id="days_listed"
                                                    style="display: inline">${{$lead->inventories_car->invoice}}</span></h3>
                                            {{--<p class="my-0 "><b>Leads:</b> <span id="total_lead"
                                                    style="display: inline"></span></p>--}}


                                        </div><!--end media-body-->
                                    </div>
                                    {{-- <button type="button" class="btn btn-sm btn-primary mt-4"
                                        style="align-items: center">View Vehicle</button> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow h-100">
                                <div class="card-header" style="background-color: #d9dcdf">
                                    <span><i class="fa fa-user"></i> | Contact: <span class="name_customer"
                                            style="display: inline">{{$lead->user->username}}</span> </span>
                                </div>
                                <div class="card-body ">
                                    <h3 class="my-0 "><b>Phone:</b> <span id="customer_phone">{{$lead->user->phone}}</span></h3>
                                    <h3 class="my-0 "><b>Address:</b> <span id="address" style="display: inline">
                                            Not Provided</span></h3>
                                    <h3 class="my-0 "><b>Salesperson:</b> <span id="salesPerson"
                                            style="display: inline">Unassigned</span></h3>
                                    <h3 class="my-0 "><b>Email:</b> <span id="customer_email">{{$lead->user->email}}</span></h3>

                                    {{-- <button type="button" class="btn btn-sm btn-primary mt-5"
                                        style="align-items: center">View Contact</button> --}}
                                </div>
                            </div>
                        </div>
                        <div class="divide"></div>
                        <div class="col-md-12">
                            <div class="warpper">

                                <div class="tabs">
                                    <label class="tab mt-4" id="one-tab" for="one">Message :</label>
                                </div>

                                <div class="panels">
                                    <div class="panel" id="one-panel">
                                        <div class="wrapper-message">
                                            <div class="row">
                                                <div class="col-md-3 p-4">
                                                    <p class="p-0 m-0"><span class="name_customer"></span></p>
                                                    <p class="p-0 m-0" id="date_message"></p>
                                                </div>
                                                <div class="col-md-9 p-4">
                                                    <p>You Have a NEW Lead!</p>
                                                    <p id="lead_description"></p>
                                                    <p class="text-danger">Trade In :</p>
                                                    <p>Year:<span class="T_year"></span> | Make:<span
                                                            class="T_make"></span> | Model: <span
                                                            class="T_model"></span>| Mileage: <span
                                                            class="T_mileage"></span>| Color: <span
                                                            class="T_color"></span> |Vin: <span class="T_vin"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="#" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row message_body">
                                                <input type="hidden" name="lead_id" id="lead_id_send_message">
                                                <div class="col-md-9">
                                                    <p class="mt-4">Send a message to <span
                                                            class="name_customer"></span></p>
                                                    <textarea name="message" style="width:100%; height:159px" placeholder="Type your Response and click send"></textarea>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row mb-3">
                                                        <p class="mt-4">Attach</p>
                                                        <input type="file" name="image" id="fileInput"
                                                            style="display: none">
                                                        <button
                                                            style="border: none;padding:5px; text-align:left; font-size: 14px;
                                                   background: #fff;
                                                   width: 92%;
                                                   padding: 14px;"
                                                            id="openFileButton" type="button"> <i
                                                                class="fa-solid fa-paperclip"></i>
                                                            File</button>
                                                    </div>
                                                    {{-- <div class="row mb-3">
                                                        <input type="file" name="file"
                                                            style="display: none"><button type="button"
                                                            style="border: none;padding:5px; text-align:left; font-size: 14px;
                                                    background: #fff;
                                                    width: 92%;
                                                    padding: 14px;"><i
                                                                class="fa-solid fa-link-slash"></i> Vehicle History
                                                            Report</button>
                                                    </div> --}}
                                                    <div class="row mb-3 mt-4">
                                                        <button type="button" class="btn btn-primary mt-5"
                                                            style="font-size: 14px; width: 92%;"><i
                                                                class="fa-regular fa-paper-plane"></i> Send</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div>
    </div> --}}
    {{-- end modal --}}




</div><!-- container -->
                    {{-- <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Car Information</h4>
                                    <tr>
                                        <td><img src="{{$lead->tmp_inventories_car->image}}" alt="" width="50%"></td>
                                        <td>{{$lead->tmp_inventories_car->stock}}</td>
                                    </tr>
                                </div>
                                <div class="col-md-6">
                                    <h4>Customer Information</h4>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">


                            </div>

                        </div> --}}
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

</script>
@endpush
