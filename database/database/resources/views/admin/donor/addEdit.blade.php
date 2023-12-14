@extends('layouts.master')
@section('title', $title)
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dropify.min.css')}}">
@endsection
@section('content')
    <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        {{Form::open(['route' => 'admin.donorAddProcess', 'files' => true])}}
                            <input type="hidden" class="form-control" name="id" @if(isset($item)) value="{{$item->id}}" @else value="{{old('id')}}" @endif>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">{{__('Name')}}</label>
                                    <input type="text" class="form-control" name="name" id="name" @if(isset($item)) value="{{$item->name}}" @else value="{{old('name')}}" @endif>
                                    <pre class="text-danger">{{$errors->first('name')}}</pre>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="phone">{{__('Phone')}}</label>
                                    <input type="text" class="form-control" name="phone" id="phone" @if(isset($item)) value="{{$item->phone}}" @else value="{{old('phone')}}" @endif>
                                    <pre class="text-danger">{{$errors->first('phone')}}</pre>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label class="form-label">{{__('District')}}</label>
                                            <select class="form-control" name="district" id="district">
                                                @foreach(districts() as $key => $value)
                                                    <option value="{{$value['id']}}"
                                                            @if((isset($item) && $item->district == $value['id']) || ($value['id'] == old('district'))) selected  @elseif(!isset($item) && ($value['id'] != old('district')) && $value['id'] == ACTIVE_STATUS) selected @endif>{{$value['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <pre class="text-danger">{{$errors->first('district')}}</pre>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label class="form-label">{{__('Upozila')}}</label>
                                            <select class="form-control" name="upozila" id="upozila">
                                                <option value="">Select District First</option>
                                            </select>
                                        </div>
                                        <pre class="text-danger">{{$errors->first('upozila')}}</pre>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="institution">{{__('Institution')}}</label>
                                    <select class="form-control" name="institution" id="institution">
                                        <option>Select Institute</option>
                                    </select>

                                    <pre class="text-danger">{{$errors->first('institution')}}</pre>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label class="form-label">{{__('Blood Group')}}</label>
                                            <select class="form-control" name="blood_group">
                                                @foreach(bloodGroups() as $key => $value)
                                                    <option value="{{$key}}"
                                                            @if((isset($item) && $item->blood_group == $key) || ($key == old('blood_group'))) selected  @elseif(!isset($item) && ($key != old('blood_group')) && $key == ACTIVE_STATUS) selected @endif>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <pre class="text-danger">{{$errors->first('blood_group')}}</pre>
                                    </div>
                                </div>

                                {{--Change gender value before active --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label class="form-label">{{__('Gender')}}</label>
                                            <select class="form-control" name="gender">
                                                @foreach(genders() as $key => $value)
                                                    <option value="{{$key}}"
                                                            @if((isset($item) && $item->gender == $key) || ($key == old('gender'))) selected  @elseif(!isset($item) && ($key != old('gender')) && $key == ACTIVE_STATUS) selected @endif>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <pre class="text-danger">{{$errors->first('gender')}}</pre>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="start_date">{{__('Last Blood Donation Date')}}</label>
                                    <input type="text" class="form-control" autocomplete="off" name="last_blood_donate_date"
                                           id="last_blood_donate_date"
                                           @if(isset($item)) value="{{$item->last_blood_donate_date}}"
                                           @else value="{{old('last_blood_donate_date')}}" @endif>
                                    <pre class="text-danger">{{$errors->first('last_blood_donate_date')}}</pre>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label class="form-label">{{__('Status')}}</label>
                                            <select class="form-control" name="status">
                                                @foreach(donorStatus() as $key => $value)
                                                    <option value="{{$key}}"
                                                            @if((isset($item) && $item->status == $key) || ($key == old('status'))) selected  @elseif(!isset($item) && ($key != old('status')) && $key == ACTIVE_STATUS) selected @endif>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <pre class="text-danger">{{$errors->first('status')}}</pre>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="logo">{{__('Upload Image')}}</label>
                                    <input type="file" name="image" id="input-file-now" class="dropify" data-default-file="{{ isset($item->image) ? asset(donorImageViewPath() . $item->image) : '' }}" />
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
@section('script')
    <script type='text/javascript' src='{{ asset('assets/js/dropify.min.js') }}'></script>
    <script>
        let upozilas = '<?php echo json_encode(upozila(), JSON_FORCE_OBJECT); ?>';
        $(document).ready(function () {
            $('.dropify').dropify();
            $('#last_blood_donate_date').datetimepicker({
                format:'Y-m-d',
                timepicker:false,
            });
            getUpozila();
            getInstitutes();
            $("#district").change(function () {
                getUpozila();
            });

            $("#district, #upozila").change(function () {
                getInstitutes();
            });
        });

        function getUpozila() {
            let district = $("#district").val();
            let selected = '<?php echo isset($item) && ($item->upozila) ? $item->upozila : ""?>';
            let options = "";
            let upozils = $.parseJSON(upozilas);
            $.each(upozils, function(index, item) {
                if (district == item.district_id) {
                    if (selected == item.id) {
                        options += "<option value='" + item.id +"' selected>" + item.name + "</option>";
                    } else {
                        options += "<option value='" + item.id +"'>" + item.name + "</option>";
                    }
                }
            });
            $("#upozila").empty();
            $("#upozila").append(options);
        }

        function getInstitutes() {
            let district = $("#district").val();
            let upozila = $("#upozila").val();
            console.log(district, upozila);
            let selected = '<?php echo isset($item) && ($item->institution) ? $item->institution : ""?>';
            let options = "";
            let request = $.ajax({
                url: "{{ route('admin.getInstitutes') }}",
                type: "get",
                data: {
                    district: district,
                    upozila: upozila,
                }
            });
            request.done(function (response) {
                if (response.status) {
                    $.each(response.data.institutes, function(index, item) {
                        if (selected == item.id) {
                            options += "<option value='" + item.id +"' selected>" + item.name + "</option>";
                        } else {
                            options += "<option value='" + item.id +"'>" + item.name + "</option>";
                        }
                    });
                    $("#institution").empty();
                    $("#institution").append(options);
                }
            });
        }
    </script>
@endsection
