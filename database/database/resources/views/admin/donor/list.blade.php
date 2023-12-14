@extends('layouts.master')
@section('title',__('Donors List'))
@section('content')
    <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="text-right p-4">
                        <a href="{{route('admin.donorAdd')}}" class="btn btn-primary col-sm-2">{{__('Create Donor')}}</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-md-12">
                                    <div class="offset-11 col-md-1 float-right form-group">
                                        <label for="">Blood Group</label>
                                        <select name="" id="blood_group" class="form-control">
                                            <option value=""> {{ 'Select Group' }}</option>
                                            @foreach(bloodGroups() as $key => $group)
                                                <option value="{{ $key }}"> {{ $group }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="band" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="all">{{__('Name')}}</th>
                                            <th class="all">{{__('Phone')}}</th>
                                            <th class="all">{{__('Blood Group')}}</th>
                                            <th class="all">{{__('Last Blood Donation Date')}}</th>
                                            <th class="all">{{__('Eligible')}}</th>
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
        var table = $('#band').DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            ajax: {
                url: "{{route('admin.donorList')}}",
                data: function (d) {
                    d.donor = $('#blood_group').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            autoWidth:false,
            columnDefs: [
                {"className": "text-center data-center", "targets": "_all"}
            ],
            columns: [
                {"data": "name"},
                {"data": "phone"},
                {"data": "blood_group"},
                {"data": "last_blood_donate_date"},
                {"data": "eligible"},
                {"data": "status"},
                {"data": "action", orderable: false, searchable: false}
            ]
        });
        $('#blood_group').change(function(){
            table.draw();
        });
    </script>
@endsection
