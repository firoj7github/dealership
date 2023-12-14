@extends('dealer.layouts.app')
@section('title', 'Lead List | ')
@push('css')
<style>
div#dom-jqry_filter {
    float: right;
}

@import url(https://fonts.googleapis.com/css?family=Open+Sans);

.form-label {
    margin-bottom: 0.5rem;
    color: #656d9a;
    font-size: 14px;
}

body {
    background: #f2f2f2;
    font-family: 'Open Sans', sans-serif;
}

.search {
    width: 100%;
    position: relative;
    display: flex;
}

.searchTerm {
    width: 100%;
    border: none;
    border-right: none;
    padding: 5px;
    border-radius: 5px 0 0 5px;
    outline: none;
    color: #9DBFAF;
}

.searchTerm:focus {
    color: #00B4CC;
}

.searchButton {
    width: 40px;
    height: 36px;
    border: 1px solid #00B4CC;
    background: #00B4CC;
    text-align: center;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
}

/*Resize the wrap to see the search bar change!*/
.wrap {
    width: 100%;
    position: absolute;
    top: 59%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.divide {
    width: 100%;
    height: 5px;
    background-color: #dfdfdf;
    margin-top: 20px;
}

/* tab design */
.warpper {
    display: flex;
    flex-direction: column;
    margin-top: 35px;
}

.tab {
    cursor: pointer;
    padding: 10px 20px;
    margin: 0px 2px;
    background: #32557f;
    display: inline-block;
    color: #fff;
    border-radius: 3px 3px 0px 0px;
    box-shadow: 0 0.5rem 0.8rem #00000080;
}

.panels {
    background: #fff;
    box-shadow: 0 2rem 2rem #00000080;
    min-height: 200px;
    width: 100%;
    border-radius: 3px;
    overflow: hidden;
    padding: 20px;
}


/*
                                            .panel {
                                                display: none;
                                                animation: fadein 0.8s;
                                            } */

@keyframes fadein {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.panel-title {
    font-size: 1.5em;
    font-weight: bold;
}

.radio {
    display: none;
}

#one:checked~.panels #one-panel,
#two:checked~.panels #two-panel,
#three:checked~.panels #three-panel {
    display: block;
}

#one:checked~.tabs #one-tab,
#two:checked~.tabs #two-tab,
#three:checked~.tabs #three-tab {
    background: #fff;
    color: #000;
    border-top: 3px solid #32557f;
}


.wrapper-message {
    background-color: #E9ECEF;
}

.message_body {
    background-color: #E9ECEF;
    margin-top: 20px;
}



/* Important part */
/* .modal-dialog{
                            overflow-y: initial !important
                        }
                        .modal-body{
                            height: 80vh;
                            overflow-y: auto;
                        } */
</style>
@endpush
@section('content')

{{-- purchase modal start --}}
    <!-- Modal -->
    <div class="modal  fade" id="purchase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Purchase</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="row" >
                        <div class="col-md-8 m-auto">
                            <a href="{{route('lead.purchase')}}"> <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Only $20">Purchase Lead </button></a>
                        <a href="{{route('upgrade.listing')}}"> <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Only $20">Upgrade Listing </button></a>
                        <a href="#"><button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" >Upgrade Membership</button></a>
                        </div>






                    </div>










                </div>

            </div>
        </div>
    </div>

    {{-- purchase modal close --}}


<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row justify-content-center">
                    <div class="col-md-12" style="background-color: #F7F7F7">
                        @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-8">
                                <h4>Email Leads</h4>
                                <select name="" id="" style="padding: 5px;" class="px-4">
                                    <option value="">All Leads</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-md-4" style="text-align: end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Add Lead
                                </button>

                                <!-- Add Lead Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Add a New Lead</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="card-body h-100">

                                                <form action="{{ route('lead.post') }}" method="POST" id="Lead_submit">
                                                    @csrf
                                                    <div class="container">
                                                        <h6 class="text-left">Add a customer to this lead : </h6>
                                                        <div class="row">
                                                            <div class="col-md-5 mb-3">
                                                                <select name="customer_id" id="" class="form-control ">
                                                                    <option value="">Select a Customer</option>
                                                                    @foreach ($leads as $lead)
                                                                    <option value="{{ $lead->user->id }}">
                                                                    {{$lead->user->username }}</option>
                                                                    @endforeach

                                                                </select>

                                                            </div>
                                                            <div class="col-md-7 text-left mb-3">
                                                                <span style="margin-right:23px">or</span>
                                                                <label for="create_new_customer"
                                                                    class="btn btn-primary"><i
                                                                        class="fa-solid fa-user-plus"></i>Create a
                                                                    customer</label>
                                                                <input type="checkbox" id="create_new_customer"
                                                                    style="display: none">
                                                            </div>
                                                        </div>
                                                        <div class="row create_hidden_button" id="create_hidden_button"
                                                            style="display: none">
                                                            <div class="col-md-12">
                                                                <div class="form-group ">

                                                                    <input placeholder="First Name*"
                                                                        class="form-control fname" type="text"
                                                                        name="first_name"
                                                                        value="{{ old('first_name') }}">
                                                                    <span class="invalid-feedback1 text-danger"
                                                                        role="alert"></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-3">

                                                                    <input placeholder="Last Name*"
                                                                        class="form-control lname" type="text"
                                                                        name="last_name" value="{{ old('last_name') }}">

                                                                    <span class="invalid-feedback2 text-danger"
                                                                        role="alert"></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-3">

                                                                    <input placeholder="E-mail*"
                                                                        class="form-control email" type="text"
                                                                        name="email" value="{{ old('email') }}">

                                                                    <span class="invalid-feedback3 text-danger"
                                                                        role="alert"></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-3">

                                                                    <input class="form-control phone telephoneInput"
                                                                        type="text" name="phone"
                                                                        value="{{ old('phone') }}">

                                                                    <span class="invalid-feedback4 text-danger"
                                                                        role="alert"></span>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-3">
                                                                    <select name="phone_type" class="form-control"
                                                                        id="">
                                                                        <option value="">Phone Type</option>
                                                                        <option value="Cell Phone">Cell Phone</option>
                                                                        <option value="Work Phone">Work Phone</option>
                                                                        <option value="Home Phone">Home Phone</option>
                                                                    </select>
                                                                    <span class="invalid-feedback5 text-danger"
                                                                        role="alert"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-3">
                                                                    <select name="contact_type" class="form-control"
                                                                        id="">
                                                                        <option value="">Contact Type</option>
                                                                        <option value="Retail">Retail</option>
                                                                        <option value="WholeSale">WholeSale</option>
                                                                    </select>
                                                                    <span class="invalid-feedback6 text-danger"
                                                                        role="alert"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-3">
                                                                    <select name="salespersion" class="form-control"
                                                                        id="">
                                                                        <option value="">SalesPerson</option>
                                                                        <option value="Unassigned">Unassigned</option>
                                                                        @foreach ($salesmans as $saleman )
                                                                        <option value="{{ $saleman->id }}">
                                                                            {{ $saleman->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                    <span class="invalid-feedback7 text-danger"
                                                                        role="alert"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <h6 style="margin-left:10px " class="mt-4 mb-3">Add a
                                                                Vehicle to this lead: (optional)</h6>
                                                            <div class="col-md-6 text-left">
                                                                <div class="form-group mb-3 selected_car">

                                                                    <span style="font-size: 10px">No Vechile
                                                                        chosen</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <a href="javasceipt:void(0)" class="btn btn-primary choose_vechile"
                                                                        id="choose_vechile"><i
                                                                            class="fa-solid fa-car"></i> Choose a
                                                                        Vehicle</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <select name="lead_type" id="" class="form-control">
                                                                        <option value="">Lead Type</option>
                                                                        <option value="Walk-In">Walk-In</option>
                                                                        <option value="E-mail">E-mail</option>
                                                                    </select>
                                                                    <span class="invalid-feedback8 text-danger"
                                                                        role="alert"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select name="source" id="" class="form-control">
                                                                    <option value="">Lead Source</option>
                                                                    <option value="Other Customer">Other Customer
                                                                    </option>
                                                                    <option value="Other">Other</option>
                                                                    <option value="Migrated">Migrated</option>
                                                                </select>
                                                                <span class="invalid-feedback9 text-danger"
                                                                    role="alert"></span>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <textarea cols="50" rows="5" placeholder="note"
                                                                        name="note"></textarea>

                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Lead</button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- choose vechile modal start --}}
                                <div class="modal fade" id="chose_vechile_modal" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header " style="background-color: #103a6a">
                                                <span class="modal-title text-white" id="staticBackdropLabel">Select a
                                                    Vehicle</span>
                                                <input type="search" name="search" class="search_query"
                                                    placeholder="search"
                                                    style="margin-left: 22%;border: none; padding-right: 11px;" />
                                                <button type="button" class="close text-white" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="card-body" style="height: 50vh; overflow-y: auto;">

                                                <div class="container" id="carShow">
                                                    @foreach ($cars as $car)
                                                    <div class="row">
                                                        <div class="col-md-2 mb-3 p-0">
                                                            <img src="{{ $car->image }}" alt="" style="width: 100%">
                                                        </div>
                                                        <div class="col-md-8 mb-3 text-left">
                                                            <span class="text-left"
                                                                style="font-weight:bold">{{ $car->title }} <span
                                                                    style="color: #bdbaba"> #
                                                                    {{ $car->stock }}</span></span><br />
                                                            <span class="text-left" style="font-weight:bold;color:red">$
                                                                {{ $car->price }}</span>
                                                        </div>
                                                        <div class="col-md-2 mb-3 p-0 text-right">
                                                            <button type="button" class="btn text-white select_car"
                                                                style="background-color: #103a6a"
                                                                value="{{ $car->id }}">select</button>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade chose_vechile_modal" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header " style="background-color: #103a6a">
                                            <span class="modal-title text-white" id="staticBackdropLabel">Select a
                                                Vehicle</span>
                                            <input type="search" name="search" class="search_query_one"
                                                placeholder="search"
                                                style="margin-left: 22%;border: none; padding-right: 11px;" />
                                            <button type="button" class="close text-white" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="card-body" style="height: 50vh; overflow-y: auto;">

                                            <div class="container carShow">
                                                @foreach ($cars as $car)
                                                <div class="row">
                                                    <div class="col-md-2 mb-3 p-0">
                                                        <img src="{{ $car->image }}" alt="" style="width: 100%">
                                                    </div>
                                                    <div class="col-md-8 mb-3 text-left">
                                                        <span class="text-left"
                                                            style="font-weight:bold">{{ $car->title }} <span
                                                                style="color: #bdbaba"> #
                                                                {{ $car->stock }}</span></span><br />
                                                        <span class="text-left" style="font-weight:bold;color:red">$
                                                            {{ $car->price }}</span>
                                                    </div>
                                                    <div class="col-md-2 mb-3 p-0 text-right">
                                                        <button type="button" class="btn text-white select_car_one"
                                                            style="background-color: #103a6a"
                                                            value="{{ $car->id }}">select</button>
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                                {{-- choose vechile modal end --}}

                            </div>
                            <!-- Add Lead Modal -->



                            {{-- Edit lead modal start --}}

                            <div class="modal fade" id="EditModal" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Lead</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="card-body">

                                            <form class="md-float-material form-material" id="UpdateLead">

                                                <div class="auth-box card">
                                                    <div class="card-block">
                                                        <div class="form-group form-primary">
                                                            <input type="text" class="form-control" id="vichele_name"
                                                                name="vichele_name" value="{{ old('vichele_name') }}">
                                                            <input type="hidden" name="lead_id" id="lead_id">
                                                            <span class="form-bar"></span>
                                                            <span class="text-danger error-text vichele_name"></span>
                                                        </div>
                                                        <div class="form-group form-primary">

                                                            <input type="text" class="form-control " id="customer"
                                                                name="customer_name" value="{{ old('customer_name') }}">
                                                            <span class="form-bar"></span>
                                                            <span class="text-danger error-text customer_name"></span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group form-primary">
                                                                    <input type="date" class="form-control " id="date"
                                                                        name="date">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label"></label>
                                                                    <span class="error-text"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-3">
                                                                    <select name="lead_type" class="custom-select "
                                                                        id="lead_type">
                                                                        <option value="">~ select lead type ~
                                                                        </option>
                                                                        <option value="Vehicle Inquiry">Vehicle
                                                                            Inquiry</option>
                                                                        <option value="Loan Application">Loan
                                                                            Application</option>
                                                                        <option value="Vehicle History Report">
                                                                            Vehicle History Report</option>

                                                                    </select>
                                                                    <span
                                                                        class="text-danger error-text lead_type"></span>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="row m-t-30">
                                                            <div class="col-md-12">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20 mt-4">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Edit lead modal end --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 p-4" style=" background-color:#F7F7F7">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Filter by
                                    Inventory</label>
                                <button class="btn btn-primary search_choose_vechile" id="">Select Vehicle</button>
                                <span class="form-group mb-3 vechile_selected_car">


                                </span>

                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Make</label>
                                <select name="" id="" class="form-control">
                                    <option value="">All </option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Model</label>
                                <select name="" id="" class="form-control">
                                    <option value="">All </option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Lead Type</label>
                                <select name="" id="" class="form-control">
                                    <option value="">All Lead Types</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label ">Read/Unread</label>
                                <select name="is_read" id="is_read" class="form-control submitable">
                                    <option value="">All </option>
                                    <option value="0">Read</option>
                                    <option value="1">Unread</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Search Leads</label>
                                <div class="wrap">
                                    <div class="search">
                                        <input type="text" class="searchTerm">
                                        <button type="submit" class="searchButton">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>All Leads</h5>

                        </div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap lead-table">
                                    <thead>
                                        <tr>
                                            <th class="text-start">
                                                <div>
                                                    <input type="checkbox" id="is_check_all">
                                                </div>
                                            </th>
                                            <th> SL</th>
                                            <th> #Stock </th>
                                            {{--<th data-type="date" data-format="YYYY/DD/MM"> Date</th>--}}
                                            <th>Title</th>
                                            <th>Membership</th>
                                            <th>Listing Type</th>
                                            <th>Category</th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Customer Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Lead Details Modal  -->
<div class="modal fade" id="LeadDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lead Details-Source: Localcarz.com</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow h-100">
                                <div class="card-header" style="background-color: #d9dcdf">
                                    <span> <i class="fa-solid fa-car"></i> | Vehicle: <span id="vehicle_name"
                                            style="display: inline"></span> </span>
                                </div>
                                <div class="card-body ">
                                    <div class="media">
                                        <img src="" alt="" class="img-thumbnail" style="max-width: 45% !important;"
                                            id="email_image_car">
                                        <div style="margin-left:10px" class="media-body align-self-center ms-3 text-truncate">
                                            <p class="my-0"><b>Price:</b>$ <span id="price"
                                                    style="display: inline"></span></p>
                                            {{--<p class="my-0 "><b>Average Price:</b>$ <span id="average_price"
                                                        style="display: inline"></span></p>--}}
                                            <p class="my-0 "><b>Milleage:</b> <span id="milleage"
                                                    style="display: inline"></span> mi</p>
                                            <p class="my-0 "><b>Stock #:</b> <span id="stock"
                                                    style="display: inline"></span></p>
                                            <p class="my-0 "><b>Date Listed:</b> <span id="days_listed"
                                                    style="display: inline"></span></p>
                                            {{--<p class="my-0 "><b>Leads:</b> <span id="total_lead"
                                                        style="display: inline"></span></p>--}}


                                        </div>
                                        <!--end media-body-->
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
                                            style="display: inline"></span> </span>
                                </div>
                                <div class="card-body ">
                                    <p class="my-0 "><b>Phone:</b> <span id="customer_phone"></span></p>
                                    <p class="my-0 "><b>Address:</b> <span id="address" style="display: inline">
                                            Not Provided</span></p>
                                    <p class="my-0 "><b>Salesperson:</b> <span id="salesPerson"
                                            style="display: inline">Unassigned</span></p>
                                    <p class="my-0 "><b>Email:</b> <span id="customer_email"></span></p>

                                    {{-- <button type="button" class="btn btn-sm btn-primary mt-5"
                                            style="align-items: center">View Contact</button> --}}
                                </div>
                            </div>
                        </div>
                        <div class="divide"></div>
                        <div class="col-md-12">


                            <ul class="nav nav-tabs mt-3" id="myTabs">
                                <li class="nav-item">
                                  <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home">Details</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="menu1-tab" data-bs-toggle="tab" href="#menu1">Message</a>
                                </li>

                              </ul>

                              <!-- Tab panes -->
                              <div class="tab-content">
                                <div class="tab-pane fade show active" id="home">
                                    <div class="panel" id="one-tab">
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


                                    </div>
                                </div>
                                <div  class="tab-pane fade mt-3" id="menu1">

                                    <div style="height:250px; overflow-y:scroll; z-index:0;"  id="messageAll" >



                                    </div>







                                    <form  action="{{ route('email.send.lead') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div  class="row message_body mt-3">
                                        <input type="hidden" name="lead_id" id="lead_id_send_message">
                                        <div class="col-md-9">
                                            <h6 style="font-weight:bold; margin-left:5px;margin-bottom:10px;" class="mt-4">Send a message to <span
                                                    class="name_customer"></span></h6>
                                            <textarea name="message" style="width:100%; height:159px; border-radius:8px; padding:8px"
                                                placeholder="Type your Response and click send"></textarea>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row mb-3">
                                                <p class="mt-4">Attach</p>
                                                <input type="file" name="image" id="fileInput"
                                                    style="display: none">
                                                <button style="border: none;padding:5px; text-align:left; font-size: 14px;
                                               background: #fff;
                                               width: 92%;
                                               padding: 14px;" id="openFileButton" type="button"> <i
                                                        class="fa-solid fa-paperclip"></i>
                                                    File</button>
                                            </div>

                                            <div class="row mb-3">
                                                <button type="submit" class="btn btn-primary"
                                                    style="font-size: 14px; width: 92%;"><i
                                                        class="fa-regular fa-paper-plane"></i> Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                </div>



                              </div>
                            </div>

















                            {{-- <div class="warpper">
                                <input class="radio" id="one" name="group" type="radio" checked>

                                <div class="tabs">
                                    <label class="tab" id="one-tab" for="one">Message</label>
                                    <label class="tab" id="two-tab" for="two">Chat</label>
                                </div>


                                <div class="panels">
                                    <div class="panel" id="one-tab">
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

                                        <form action="{{ route('email.send.lead') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row message_body">
                                                <input type="hidden" name="lead_id" id="lead_id_send_message">
                                                <div class="col-md-9">
                                                    <p class="mt-4">Send a message to <span
                                                            class="name_customer"></span></p>
                                                    <textarea name="message" style="width:100%; height:159px"
                                                        placeholder="Type your Response and click send"></textarea>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row mb-3">
                                                        <p class="mt-4">Attach</p>
                                                        <input type="file" name="image" id="fileInput"
                                                            style="display: none">
                                                        <button style="border: none;padding:5px; text-align:left; font-size: 14px;
                                                       background: #fff;
                                                       width: 92%;
                                                       padding: 14px;" id="openFileButton" type="button"> <i
                                                                class="fa-solid fa-paperclip"></i>
                                                            File</button>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <button type="submit" class="btn btn-primary"
                                                            style="font-size: 14px; width: 92%;"><i
                                                                class="fa-regular fa-paper-plane"></i> Send</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="panel" id="two-tab">
                                       <p>jjjjjjjjjjjjjj</p>
                                    </div>

                                </div>
                            </div> --}}



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}








</div><!-- container -->
@endsection

@push('page_js')

@include('dealer.lead.js.lead_page_js')

<script>

// $(function () {
//   $('[data-toggle="tooltip"]').tooltip()
// })









        $(document).on('click', '.lead_delete', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.confirm({
        title: 'Delete Confirmation',
        content: 'Are you sure?',
        buttons: {
            cancel: {
                text: 'No',
                btnClass: 'btn-primary',
                action: function () {
                    // Do nothing on cancel
                }
            },
            confirm: {
                text: 'Yes',
                btnClass: 'btn-danger',
                action: function () {
                    $.ajax({
                        url: "{{ route('dealer.lead.delete')}}",
                        type: 'DELETE',
                        data: {id:id},
                        success: function (res) {

                            // Show Toastr success message
                            toastr.success(res.message);
                            // Reload or redraw your data table if needed
                            $('.lead-table').DataTable().draw(false);
                        },
                        error: function (error) {
                            // Show Toastr error message
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }
            },

        }
    });
});

// search select modal show vichele

    // choose vevhile modal open
    $(document).ready(function(){
            // $('.search_choose_vechile').on('click',function(){
            //     console.log('hellow');
            //     // $('#chose_vechile_modal').modal('show');
            // });


            $('.search_query').on('keyup',function(){

               var search_type = $(this).val();
               $.ajax({
                url:"{{ route('vichele.dealer.lead')}}",
                type:"get",
                data:{search:search_type},
                success: function(data){
                    var cars = data.cars;
                    if(cars.length > 0)
                    {
                        $('#carShow').html("");
                        $.each(cars, function(key,car){
                            var car_image = car.image_from_url.split(',');
                            $('#carShow').append('<div class="row">\
                                                            <div class="col-md-2 mb-3 p-0">\
                                                                <img src="'+ car_image[0]+'"\
                                                                    alt="" style="width: 100%">\
                                                            </div>\
                                                            <div class="col-md-8 mb-3 text-left">\
                                                                <span class="text-left " style="font-weight:bold">'+ car.year + ' ' + car.make  + ' ' +  car.model +' <span style="color: #bdbaba"> # '+ car.stock +'</span></span><br/>\
                                                                <span class="text-left" style="font-weight:bold;color:red">$ '+ car.price+'</span>\
                                                            </div>\
                                                            <div class="col-md-2 mb-3 p-0 text-right">\
                                                                <button type="button" class="btn text-white select_car" style="background-color: #103a6a" value="'+car.id+'">select</button>\
                                                            </div>\
                                                        </div>');
                        });

                    }else
                    {
                        $('#carShow').append('<div class="row"><h3>No Car Found! </h3></div>');
                    }




                }
               });
            });


        });


           // lead index button click vechile search script
           $('.search_choose_vechile').on('click', function() {
            console.log('hellow');
            $('.chose_vechile_modal').modal('show');
        });

        $('.select_car_one').on('click', function() {
            var id = $(this).val();
            console.log(id);
            $.ajax({
                url: "{{ route('select.car') }}",
                type: "post",
                data: {
                    car_id: id
                },
                success: function(res) {
                    var select_car = res.car;
                    console.log(select_car);
                    $('.vechile_selected_car').html(""); // Clear the content

                    var $carInfo = $('<div class="col-md-12 mb-3 p-0"></div>');
                    $carInfo.append($('<img>').attr('src', res.car.image).attr('alt', '').css('width',
                        '30%'));
                    $carInfo.append($('<span>').text(res.car.title).css('font-weight', 'bold'));
                    $carInfo.append('<br/>');
                    $carInfo.append($('<input>').attr('type', 'text').attr('value', res.car.stock).attr(
                        'name', 'stock'));
                    $carInfo.append('<br/>');
                    $carInfo.append($(
                        '<a href="javascript:void(0)" class="remove_car" style="color: rgb(92, 55, 55); text-decoration: underline">Remove Vehicle Selection</a>'
                        ));
                    $carInfo.append($('<input>').attr('type', 'hidden').attr('value', res.car.id).attr(
                        'name', 'vechile_id'));
                    $('.vechile_selected_car').append($carInfo);
                    $('.chose_vechile_modal').modal('hide');

                }


            });
        });


        $(document).on('click','.select_car_one',function() {
            var id = $(this).val();
            console.log(id);
            $.ajax({
                url: "{{ route('select.car') }}",
                type: "post",
                data: {
                    car_id: id
                },
                success: function(res) {
                    var select_car = res.car;
                    console.log(select_car);
                    $('.vechile_selected_car').html(""); // Clear the content

                    var $carInfo = $('<div class="col-md-12 mb-3 p-0"></div>');
                    $carInfo.append($('<img>').attr('src', res.car.image).attr('alt', '').css('width',
                        '30%'));
                    $carInfo.append($('<span>').text(res.car.title).css('font-weight', 'bold'));
                    $carInfo.append('<br/>');
                    $carInfo.append($('<input>').attr('type', 'text').attr('value', res.car.stock).attr(
                        'name', 'stock'));
                    $carInfo.append('<br/>');
                    $carInfo.append($(
                        '<a href="javascript:void(0)" class="remove_car" style="color: rgb(92, 55, 55); text-decoration: underline">Remove Vehicle Selection</a>'
                        ));
                    $carInfo.append($('<input>').attr('type', 'hidden').attr('value', res.car.id).attr(
                        'name', 'vechile_id'));
                    $('.vechile_selected_car').append($carInfo);
                    $('.chose_vechile_modal').modal('hide');

                }


            });
        });

        $('.search_query_one').on('keyup', function() {

            var search_type = $(this).val();
            $.ajax({
                url: "{{ route('vichele.dealer.lead') }}",
                type: "get",
                data: {
                    search: search_type
                },
                success: function(data) {
                    var cars = data.cars;
                    console.log(cars);
                    if (cars.length > 0) {
                        $('.carShow').html("");
                        $.each(cars, function(key, car) {
                            var car_image = car.image_from_url.split(',');
                            $('.carShow').append('<div class="row">\
                                                 <div class="col-md-2 mb-3 p-0">\
                                                     <img src="' + car_image[0] + '"\
                                                         alt="" style="width: 100%">\
                                                 </div>\
                                                 <div class="col-md-8 mb-3 text-left">\
                                                     <span class="text-left " style="font-weight:bold">' + car.year + ' ' +
                                car.make + ' ' + car.model +
                                ' <span style="color: #bdbaba"> # ' + car.stock + '</span></span><br/>\
                                                     <span class="text-left" style="font-weight:bold;color:red">$ ' + car
                                .price +
                                '</span>\
                                                 </div>\
                                                 <div class="col-md-2 mb-3 p-0 text-right">\
                                                     <button type="button" class="btn text-white select_car_one" style="background-color: #103a6a" value="' +
                                car.id + '">select</button>\
                                                 </div>\
                                             </div>');
                        });

                    } else {
                        $('.carShow').append('<div class="row"><h3>No Car Found! </h3></div>');
                    }




                }
            });
        });

        $(document).on('click', '.remove_car', function(e) {
            e.preventDefault();

            $('.vechile_selected_car').html("");


        });


        // $(document).on('click','.select_car',function(e){
        //     e.preventDefault();
        //     var id = $(this).val();
        //    $.ajax({
        //     url:"{{ route('select.car')}}",
        //     type:"post",
        //     data:{car_id:id},
        //     success:function(res){
        //         console.log(res);
        //         var select_car = res.car;
        //        if(select_car)
        //        {
        //         $('.vechile_selected_car').html("");
        //         $('.vechile_selected_car').append('<div class="col-md-12 mb-3 p-0">\
        //                                                                     <img src="'+select_car.image+'"\
        //                                                                         alt="" style="width: 30%">\
        //                                                                         <span class="text-left" style="font-weight:bold">'+select_car.title+'</span><br/>\

        //                                                                         <a href="javascript:void(0)" type="button" class="remove_car" style="color: rgb(92, 55, 55);text-decoration:underline">Remove Vechile Selection</a>\
        //                                                                         <input type="hidden" value ="'+select_car.id+'" name="vechile_id" />\

        //                                                                 </div>');

        //        }

        //        $('#chose_vechile_modal').modal('hide');

        //     }

        //    });
        // });

</script>
@endpush
