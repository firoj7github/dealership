@extends('layouts.master')
@section('title',__('News List'))
@section('style')
    <style>
        .large-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 205px;
        }
        .data-center {
            vertical-align: middle !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="text-right p-4">
                        <a href="{{route('admin.newsAdd')}}" class="btn btn-primary col-sm-2">{{__('Create News')}}</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table" id="band" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="all">{{__('Image')}}</th>
                                            <th class="all">{{__('Title')}}</th>
                                            <th class="all">{{__('News')}}</th>
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
            ajax: '{{route('admin.newsList')}}',
            autoWidth:false,
            columnDefs: [
                {"className": "text-center data-center", "targets": "_all"}
            ],
            columns: [
                {"data": "image"},
                {"data": "title"},
                {"data": "news", className: 'large-text data-center'},
                {"data": "status"},
                {"data": "action", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
