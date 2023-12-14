@extends('layouts.master')
@section('title',__('Customers'))
@section('content')
    <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="text-right p-4">
                        <a href="{{route('superAdmin.customerAdd')}}" class="btn btn-primary col-sm-2">{{__('Create Customer')}}</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class=" table-responsive">
                                <table class="table" id="band" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Email')}}</th>
                                        <th class="all">{{__('Username')}}</th>
                                        <th class="all">{{__('Subscription Package')}}</th>
                                        <th class="all">{{__('Start Date')}}</th>
                                        <th class="all">{{__('End Date')}}</th>
                                        <th class="desktop">{{__('Status')}}</th>
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
            ajax: '{{route('superAdmin.customerList')}}',
            order: [0, 'asc'],
            autoWidth:false,
            columnDefs: [
                {"className": "text-center", "targets": "_all"}
            ],
            columns: [
                {"data": "email"},
                {"data": "user_name"},
                {"data": "subscription_package"},
                {"data": "start_date"},
                {"data": "end_date"},
                {"data": "status"},
                {"data": "action", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
