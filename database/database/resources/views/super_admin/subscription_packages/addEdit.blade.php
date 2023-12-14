@extends('layouts.master')
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    {{Form::open(['route' => 'superAdmin.subscriptionPackageAddProcess', 'files' => true])}}
                    <input type="hidden" class="form-control" name="id" @if(isset($item))value="{{$item->id}}"
                           @else value="{{old('id')}}" @endif>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="name">{{__('Package Name')}}</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   @if(isset($item)) value="{{$item->name}}" @else value="{{old('name')}}" @endif>
                            <pre class="text-danger">{{$errors->first('name')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="price">{{__('Price')}}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="price" id="price"
                                       @if(isset($item)) value="{{$item->price}}" @else value="{{old('price')}}" @endif>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@if(allSetting('default_currency')) {!! currencySymbol(allSetting('default_currency')) !!} @else {!! "&euro;" !!} @endif</span>
                                </div>
                            </div>
                            <pre class="text-danger">{{$errors->first('price')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="number_of_locations">{{__('Number Of Locations')}}</label>
                            <input type="number" min="1" class="form-control" name="number_of_locations"
                                   id="number_of_locations"
                                   @if(isset($item)) value="{{$item->number_of_locations}}"
                                   @else value="{{old('number_of_locations')}}" @endif>
                            <pre class="text-danger">{{$errors->first('number_of_locations')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="number_of_calendars">{{__('Number Of Calendars')}}</label>
                            <input type="number" min="1" class="form-control" name="number_of_calendars"
                                   id="number_of_calendars"
                                   @if(isset($item)) value="{{$item->number_of_calendars}}"
                                   @else value="{{old('number_of_calendars')}}" @endif>
                            <pre class="text-danger">{{$errors->first('number_of_calendars')}}</pre>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label class="form-label">{{__('Status')}}</label>
                                    <select class="form-control" name="status">
                                        @foreach(subscriptionPackageStatus() as $key => $value)
                                            <option value="{{$key}}"
                                                    @if((isset($item) && $item->status == $key) || ($key == old('status'))) selected  @elseif(!isset($item) && ($key != old('status')) && $key == ACTIVE_STATUS) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <pre class="text-danger">{{$errors->first('status')}}</pre>
                            </div>
                        </div>
                    </div>

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
