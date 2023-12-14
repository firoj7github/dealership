@extends('layouts.master')
@section('title',__('Subscription Packages'))
@section('content')
    <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="text-right p-4">
                        <a href="{{route('superAdmin.subscriptionPackageAdd')}}" class="btn btn-primary col-sm-2">{{__('Create Package')}}</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class=" table-responsive">
                                <table class="table" id="band" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Name')}}</th>
                                        <th class="all">{{__('Price')}} (@if(allSetting('default_currency')) {!! currencySymbol(allSetting('default_currency')) !!} @else {!! "&euro;" !!} @endif )</th>
                                        <th class="all">{{__('Number Of Locations')}}</th>
                                        <th class="desktop">{{__('Number Of Calendars')}}</th>
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
            ajax: '{{route('superAdmin.subscriptionPackageList')}}',
            order: [4, 'asc'],
            autoWidth:false,
            columnDefs: [
                {"className": "text-center", "targets": "_all"}
            ],
            columns: [
                {"data": "name"},
                {"data": "price"},
                {"data": "number_of_locations"},
                {"data": "number_of_calendars"},
                {"data": "status"},
                {"data": "action", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
