@extends('layouts.master')
@section('title', $title)
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="text-right p-4">
                    {{--<a href="{{route('admin.userAppointmentList', ['user' => $item->id])}}" class="btn btn-primary col-sm-2">{{__('View Appointments')}}</a>--}}
                    <a href="{{route('admin.userEdit', ['user' => encrypt($item->id)])}}" class="btn btn-primary col-sm-2">{{__('Edit user details')}}</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input readonly type="text" class="form-control" name="name" id="name"
                                   @if(isset($item)) value="{{$item->name}}" @else value="{{old('name')}}" @endif>
                            <pre class="text-danger">{{$errors->first('name')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="email">{{__('Email')}}</label>
                            <input readonly type="text" class="form-control" name="email" id="email"
                                   @if(isset($item)) value="{{$item->email}}" @else value="{{old('email')}}" @endif>
                            <pre class="text-danger">{{$errors->first('email')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="phone">{{__('Phone')}}</label>
                            <input readonly type="text" class="form-control" name="phone" id="phone"
                                   @if(isset($item)) value="{{$item->phone}}" @else value="{{old('phone')}}" @endif>
                            <pre class="text-danger">{{$errors->first('phone')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="address">{{__('Address')}}</label>
                            <input readonly type="text" class="form-control" name="address"
                                   id="address"
                                   @if(isset($item)) value="{{$item->address}}"
                                   @else value="{{old('address')}}" @endif>
                            <pre class="text-danger">{{$errors->first('address')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="zip_code">{{__('Zip Code')}}</label>
                            <input readonly type="text" class="form-control" name="zip_code"
                                   id="zip_code"
                                   @if(isset($item)) value="{{$item->zip_code}}"
                                   @else value="{{old('zip_code')}}" @endif>
                            <pre class="text-danger">{{$errors->first('zip_code')}}</pre>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="city">{{__('City')}}</label>
                            <input readonly type="text" class="form-control" name="city"
                                   id="city"
                                   @if(isset($item)) value="{{$item->city}}"
                                   @else value="{{old('city')}}" @endif>
                            <pre class="text-danger">{{$errors->first('city')}}</pre>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label class="form-label">{{__('Country')}}</label>
                                    <select class="form-control" name="country" disabled>
                                        @foreach(country() as $value)
                                            <option value="{{ $value }}"
                                                    @if((isset($item) && $item->country == $value) || ($value == old('country'))) selected @elseif(!isset($item) && $value == 'Portugal') selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <pre class="text-danger">{{$errors->first('country')}}</pre>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label class="form-label">{{__('Status')}}</label>
                                    <select class="form-control" name="status" disabled>
                                        @foreach(userStatus() as $key => $value)
                                            <option value="{{$key}}"
                                                    @if((isset($item) && $item->status == $key) || ($key == old('status'))) selected  @elseif(!isset($item) && ($key != old('status')) && $key == USER_ACTIVE_STATUS) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <pre class="text-danger">{{$errors->first('status')}}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="text-right p-4">
                    <a href="{{route('admin.appointmentAdd', ['user' => $userId])}}" class="btn btn-primary col-sm-2">{{__('Create Appointment')}}</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table" id="band" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Name')}}</th>
                                        <th class="all">{{__('Phone')}}</th>
                                        <th class="all">{{__('Location')}}</th>
                                        <th class="all">{{__('Service')}}</th>
                                        <th class="all">{{__('Calendar')}}</th>
                                        <th class="all">{{__('Schedule')}}</th>
                                        <th class="all">{{__('Status')}}</th>
                                        <th class="desktop">{{__('Actions')}}</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/jquery.timepicker.min.js') }}"></script>

    <script type="text/javascript">
        $('.form-control.time').timepicker({
            timeFormat: 'H:mm',
            interval: 30,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('.holiday').click(function () {
           if ($(this).prop("checked")) {
               $(this).closest('.checkbox').find('input[type=hidden]').val(1);
           } else {
               $(this).closest('.checkbox').find('input[type=hidden]').val(0);
           }
        });
    </script>
    <script>
        $('#band').DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            ajax: '{{route('admin.userAppointmentList' , ['user' => $userId])}}',
            order: [5, 'desc'],
            autoWidth:false,
            columnDefs: [
                {"className": "text-center", "targets": "_all"}
            ],
            columns: [
                {"data": "first_name", "name": "user.first_name"},
                {"data": "phone", "name": "user.phone"},
                {"data": "clinic", "name": "clinic.name"},
                {"data": "service", "name": "service.title"},
                {"data": "calendar", "name": "doctor.name"},
                {"data": "schedule", "name": "appointments.scheduled_at"},
                {"data": "status", "name": "appointments.status"},
                {"data": "action", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
