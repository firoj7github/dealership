@extends('layouts.master')
@section('title',__('Appointment List'))
@section('style')
    <style>
        .large-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 500px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table" id="band" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="all">{{__('Notification Type')}}</th>
                                            <th class="all">{{__('Notification Details')}}</th>
                                            <th class="all">{{__('Number Of Users')}}</th>
                                            <th class="all">{{__('Credit Used')}}</th>
                                            <th class="all">{{__('Time')}}</th>
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
            ajax: '{{route('admin.campaignHistory')}}',
            order: [4, 'desc'],
            autoWidth:false,
            columnDefs: [
                {"className": "text-center", "targets": "_all"}
            ],
            columns: [
                {"data": "notification_type"},
                {"data": "notification_details", className: 'large-text'},
                {"data": "number_of_users"},
                {"data": "credit_used"},
                {"data": "created_at"},
            ]
        });
    </script>
@endsection
