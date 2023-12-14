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
    </style>
@endpush

@section('content')
    <div class="page-content-tab">

        <div class="container-fluid" id="contentToConvert">
            <div class="row">
                <div class="col-md-12">
                                    @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3>'{{$user->username}}' Account Details</h3>

                                </div>
                                <div class="col-md-8 text-right">
                                    <a href="{{ route('admin.dealer.account-edit', $user->id) }}" class=" btn btn-primary"><i
                                            class="fa fa-edit"></i> Edit Account</a>
                                    <a href="#" class=" btn btn-danger"> <i class="fa fa-delete-left"></i> Remove
                                        Account</a>
                                    <a href="{{ route('dealer.management') }}" class=" btn btn-info"><i
                                            class="fa fa-list"></i> All Account</a>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <a href="{{ route('admin.user.information', $user->id) }}"
                                        class="btn btn-small btn-primary text-white">Account Information<a>
                                     <a href="{{ route('admin.dealer.listing', $user->id) }}"
                                         class="btn btn-small btn-primary text-white">Listing<a>
                                     <a href="{{ route('admin.dealer.lead', $user->id)}}" class="btn btn-small btn-info text-white">Leads<a>
                                     <a href="{{ route('admin.dealer.banner', $user->id)}}" class="btn btn-small btn-success text-white">Banners<a>
                                     <a href="{{ route('admin.dealer.slider', $user->id)}}" class="btn btn-small btn-success text-white">Sliders<a>
                                     <a href="#" class="btn btn-small btn-primary text-white">Archived<a>
                                     <a href="{{ route('admin.dealer.invoice', $user->id) }}"
                                         class="btn btn-small btn-secondary text-white">Invoice<a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if ($user->img)
                                        <img src="{{ asset('/dashboard') }}/images/dealers/{{ $user->img }}"
                                            width="60px">
                                    @else
                                        <img src="{{ asset('/dashboard/images/avatar.png') }}"
                                            width="80%">
                                    @endif
                                    <br />
                                    <a href="#"
                                        class="btn btn-primary">Contact Dealer</a>
                                </div>
                                <div class="col-md-8">
                                    @php
                                        $dateTime = new DateTime($user->created_at);
                                        // Format the date as "j F Y" (day, month, year)
                                        $formattedDate = $dateTime->format('F j, Y');
                                    @endphp
                                    <h4 class="fw-bold">{{ $user->username }}</h4>
                                    <p>User Name : {{ $user->username }}</p>
                                    <p>First Name : {{ $user->fname }}</p>
                                    <p>Last Name : {{ $user->laname }}</p>
                                    <p>E-mail : {{ $user->email }}</p>
                                    <p>ADF for email : {{ $user->adf_email }}</p>
                                    <p>Cell : {{ $user->phone }}</p>
                                    <p>Address : {{ $user->address }}</p>
                                    <p>Registration Date : {{ $formattedDate }}</p>


                                    <!--Google map-->
                                    <div id="map-container-google-1"
                                        class="z-depth-1-half map-container"
                                        style="height: 500px">
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2040.136745551729!2d-88.21802248422375!3d30.687818273244527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x889bb264d8d2482b%3A0xf6be7f6160faedaf!2sSkco%20Automotive!5e0!3m2!1sen!2sbd!4v1696739415060!5m2!1sen!2sbd"
                                            width="600" height="450"
                                            style="border:0;" allowfullscreen=""
                                            loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>

                                    <!--Google Maps-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('delear_JS')
@endpush
