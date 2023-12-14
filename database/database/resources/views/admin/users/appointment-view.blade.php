@extends('layouts.master')
@section('title',__('User Appointments'))
@section('content')
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
    <script>
        $('#band').DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            ajax: '{{route('admin.userAppointmentList' , ['user' => $userId])}}',
            order: [0, 'asc'],
            autoWidth:false,
            columnDefs: [
                {"className": "text-center", "targets": "_all"}
            ],
            columns: [
                {"data": "name"},
                {"data": "phone"},
                {"data": "clinic"},
                {"data": "service"},
                {"data": "calendar"},
                {"data": "schedule"},
                {"data": "status"},
                {"data": "action", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
