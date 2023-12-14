@extends('layouts.master')
@section('title', $title)
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-picker/spectrum.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dropify.min.css')}}">
@endsection
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    {{Form::open(['route' => 'superAdmin.customerAddProcess', 'files' => true, 'autocomplete' => "off"])}}
                    <input type="hidden" class="form-control" name="id" @if(isset($item))value="{{$item->id}}"
                           @else value="{{old('id')}}" @endif>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="email">{{__('Email')}}</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   @if(isset($item->customer->user)) value="{{$item->customer->user->email}}" @else value="{{old('email')}}" @endif>
                            <pre class="text-danger">{{$errors->first('email')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="username">{{__('Username')}}</label>
                            <input type="text" class="form-control" name="username" id="username"
                                   @if(isset($item->customer->user)) value="{{$item->customer->user->user_name}}" @else value="{{old('username')}}" @endif>
                            <pre class="text-danger">{{$errors->first('username')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="password">{{__('Password')}}</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" autocomplete="new-password"
                                       @if(isset($item->customer)) value="{{$item->customer->password_text}}" @else value="{{old('password')}}" @endif>
                                <div class="input-group-prepend password-click" style="cursor: pointer">
                                    <a class="input-group-text"><i class="i-Close"></i></a>
                                </div>
                            </div>
                            <pre class="text-danger">{{$errors->first('password')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="company_name">{{__('Company Name')}}</label>
                            <input type="text" class="form-control" name="company_name" id="company_name"
                                   @if(isset($item->customer)) value="{{$item->customer->company_name}}" @else value="{{old('company_name')}}" @endif>
                            <pre class="text-danger">{{$errors->first('company_name')}}</pre>
                        </div>
                        {{--<div class="col-md-4 form-group">--}}
                            {{--<label for="vat_number">{{__('Vat Number')}}</label>--}}
                            {{--<input type="text" class="form-control" name="vat_number"--}}
                                   {{--id="vat_number"--}}
                                   {{--@if(isset($item->customer)) value="{{$item->customer->vat_number}}"--}}
                                   {{--@else value="{{old('vat_number')}}" @endif>--}}
                            {{--<pre class="text-danger">{{$errors->first('vat_number')}}</pre>--}}
                        {{--</div>--}}
                        <div class="col-md-4 form-group">
                            <label for="address">{{__('Address')}}</label>
                            <input type="text" class="form-control" name="address"
                                   id="address"
                                   @if(isset($item->customer->user)) value="{{$item->customer->user->address}}"
                                   @else value="{{old('address')}}" @endif>
                            <pre class="text-danger">{{$errors->first('address')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="zip_code">{{__('Zip Code')}}</label>
                            <input type="text" class="form-control" name="zip_code"
                                   id="zip_code"
                                   @if(isset($item->customer->user)) value="{{$item->customer->user->zip_code}}"
                                   @else value="{{old('zip_code')}}" @endif>
                            <pre class="text-danger">{{$errors->first('zip_code')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="city">{{__('Country')}}</label>
                            <select class="form-control" name="country">
                                @foreach(country() as $value)
                                    <option value="{{ $value }}"
                                            @if((isset($item->customer->user) && $item->customer->user->country == $value) || ($value == old('country'))) selected @elseif(!isset($item) && $value == 'Bangladesh') selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            <pre class="text-danger">{{$errors->first('country')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="city">{{__('City')}}</label>
                            <select class="form-control" name="city">
                                @foreach(districts() as $value)
                                    <option value="{{ $value['id'] }}"
                                            @if((isset($item->customer->user) && $item->customer->user->city == $value["id"]) || ($value["id"] == old('city'))) selected @endif>{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                            <pre class="text-danger">{{$errors->first('city')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="start_date">{{__('Start Date')}}</label>
                            <input type="text" class="form-control" autocomplete="off" name="start_date"
                                   id="start_date"
                                   @if(isset($item)) value="{{$item->start_date}}"
                                   @else value="{{old('start_date')}}" @endif>
                            <pre class="text-danger">{{$errors->first('start_date')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="end_date">{{__('End Date')}}</label>
                            <input type="text" class="form-control" autocomplete="off" name="end_date"
                                   id="end_date"
                                   @if(isset($item)) value="{{$item->end_date}}"
                                   @else value="{{old('end_date')}}" @endif>
                            <pre class="text-info">{{ __('If you don\'t select end time, it will take :time months as default value', ['time' => DEFAULT_SUBSCRIPTION_TIME]) }}</pre>
                            <pre class="text-danger">{{$errors->first('end_date')}}</pre>
                        </div>
                        {{--<div class="col-md-4 form-group">--}}
                            {{--<label for="end_date">{{__('Credit')}}</label>--}}
                            {{--<input type="number" min="0" class="form-control" autocomplete="off" name="credit"--}}
                                   {{--id="credit"--}}
                                   {{--@if(isset($item)) value="{{$item->credit}}"--}}
                                   {{--@elseif(!empty(old('credit'))) value="{{old('credit')}}" @else value="0" @endif>--}}
                            {{--<pre class="text-danger">{{$errors->first('credit')}}</pre>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2 form-group">--}}
                            {{--<label for="color_1">{{__('Color 1')}}</label>--}}
                            {{--<div style="display: -webkit-box">--}}
                                {{--<input type='text' name='color_1' id='color_1' @if(isset($item)) value="{{$item->color_1}}"--}}
                                       {{--@else value="{{old('color_1')}}" @endif/>--}}
                            {{--</div>--}}
                            {{--<pre class="text-danger">{{$errors->first('color_1')}}</pre>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2 form-group">--}}
                            {{--<label for="color_2">{{__('Color 2')}}</label>--}}
                            {{--<div style="display: -webkit-box">--}}
                                {{--<input type='text' name='color_2' id='color_2' @if(isset($item)) value="{{$item->color_2}}"--}}
                                       {{--@else value="{{old('color_2')}}" @endif/>--}}
                            {{--</div>--}}
                            {{--<pre class="text-danger">{{$errors->first('color_2')}}</pre>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-4">--}}
                            {{--<div class="form-group">--}}
                                {{--<div class="controls">--}}
                                    {{--<label class="form-label">{{__('Subscription Packages')}}</label>--}}
                                    {{--<select class="form-control" name="subscription_package_id">--}}
                                        {{--<option value="0">{{ __('Select Package') }}</option>--}}
                                        {{--@foreach(subscriptionPackages() as $value)--}}
                                            {{--<option value="{{$value->id}}"--}}
                                                    {{--@if((isset($item) && $item->subscription_package_id == $value->id) || ($value->id == old('subscription_package_id'))) selected @endif>{{$value->name}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                {{--<pre class="text-danger">{{$errors->first('subscription_package_id')}}</pre>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label class="form-label">{{__('Status')}}</label>
                                    <select class="form-control" name="status">
                                        @foreach(customerStatus() as $key => $value)
                                            <option value="{{$key}}"
                                                    @if((isset($item) && $item->status == $key) || ($key == old('status'))) selected  @elseif(!isset($item) && ($key != old('status')) && $key == ACTIVE_STATUS) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <pre class="text-danger">{{$errors->first('status')}}</pre>
                            </div>
                        </div>

                        {{--<div class="col-md-6 form-group">--}}
                            {{--<label for="logo">{{__('Upload Logo')}}</label>--}}
                            {{--<input type="file" name="logo" id="input-file-now" class="dropify" data-default-file="{{ isset($item->logo) ? asset(logoViewPath() . $item->logo) : '' }}" />--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6 form-group">--}}
                            {{--<label for="logo">{{__('Upload Image')}}</label>--}}
                            {{--<input type="file" name="image" id="input-file-now" class="dropify" data-default-file="{{ isset($item->image) ? asset(imageViewPath() . $item->image) : '' }}" />--}}
                        {{--</div>--}}
                    </div>
                    
                    {{--<div class="row">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<label class="form-label">{{__('Comment')}}</label>--}}
                            {{--<textarea name="comment" id="" style="width: 100%" rows="5">{{ isset($item) ? $item->customer->comment : '' }}</textarea>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">{{$buttonTitle}}</button>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{--<script type='text/javascript' src='{{ asset('assets/js/color-picker/spectrum.js') }}'></script>--}}
    {{--<script type='text/javascript' src='{{ asset('assets/js/dropify.min.js') }}'></script>--}}
    <script>
        $(document).ready(function () {
            // $("#color_1").spectrum({
            //     showInput: true,
            //     preferredFormat: true,
            // });
            // $("#color_2").spectrum({
            //     showInput: true,
            //     preferredFormat: true,
            // });
            $('.password-click').click(function () {
                var icon = $(this).find("i");
                icon.toggleClass("i-Close i-Eye");
                var parentDiv = $(this).parent('div');
                var input = parentDiv.find('input');
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            // $('.dropify').dropify();
        });
    </script>
    <script type="text/javascript">
        $('#start_date').datetimepicker({
            minDate: new Date(),
            format:'d-m-Y',
            timepicker:false,
        });
        $('#end_date').datetimepicker({
            minDate: new Date(),
            format:'d-m-Y',
            timepicker:false,
        });
    </script>
@endsection
