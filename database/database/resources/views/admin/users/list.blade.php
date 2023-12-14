@extends('layouts.master')
@section('title',__('User List'))
@section('content')
    <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="text-right p-4">
                        <a href="{{route('admin.userAdd')}}" class="btn btn-primary col-sm-2">{{__('Create User')}}</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table" id="band" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="all">{{__('Name')}}</th>
                                            <th class="all">{{__('Email')}}</th>
                                            <th class="all">{{__('Phone')}}</th>
                                            <th class="all">{{__('Address')}}</th>
                                            <th class="all">{{__('Zip Code')}}</th>
                                            <th class="all">{{__('City')}}</th>
                                            <th class="all">{{__('Country')}}</th>
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
            ajax: '{{route('admin.userList')}}',
            order: [0, 'asc'],
            autoWidth:false,
            columnDefs: [
                {"className": "text-center", "targets": "_all"}
            ],
            columns: [
                {"data": "first_name"},
                {"data": "email"},
                {"data": "phone"},
                {"data": "address"},
                {"data": "zip_code"},
                {"data": "city"},
                {"data": "country"},
                {"data": "status"},
                {"data": "action", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
