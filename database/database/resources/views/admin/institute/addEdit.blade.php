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
                        {{Form::open(['route' => 'admin.instituteAddProcess', 'files' => true])}}
                            <input type="hidden" class="form-control" name="id" @if(isset($item)) value="{{$item->id}}" @else value="{{old('id')}}" @endif>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="name">{{__('Name')}}</label>
                                    <input type="text" class="form-control" name="name" id="name" @if(isset($item)) value="{{$item->name}}" @else value="{{old('name')}}" @endif>
                                    <pre class="text-danger">{{$errors->first('name')}}</pre>
                                </div>
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
        $(document).ready(function () {
            $('.dropify').dropify();
            $('#last_blood_donate_date').datetimepicker({
                format:'d-m-Y',
                timepicker:false,
            });
            getUpozila();
            $("#district").change(function () {
                getUpozila();
            });
        });
        let upozilas = '<?php echo json_encode(upozila(), JSON_FORCE_OBJECT); ?>';

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
    </script>
@endsection
