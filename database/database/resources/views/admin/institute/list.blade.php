@extends('layouts.master')
@section('title',__('Institutes List'))
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
        .modal,
        .modal-box {
            z-index: 900;
        }

        .modal-sandbox {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: transparent;
        }

        .modal {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: rgb(0,0,0);
            background: rgba(0,0,0,.8);
            overflow: auto;
        }

        .modal-box {
            position: relative;
            width: 80%;
            max-width: 920px;
            margin: 100px auto;
            animation-name: modalbox;
            animation-duration: .4s;
            animation-timing-function: cubic-bezier(0,0,.3,1.6);
        }

        .modal-header {
            background: #fff;
            color: #000;
        }

        .modal-body {
            background: #fff;
        }

        .modal-footer {
            background: #fff;
        }

        /* Close Button */
        .close-modal {
            text-align: right;
            cursor: pointer;
        }

        /* Animation */
        @-webkit-keyframes modalbox {
            0% {
                top: -150px;
                opacity: 0;
            }
            100% {
                top: 0;
                opacity: 1;
            }
        }

        @keyframes modalbox {
            0% {
                top: -150px;
                opacity: 0;
            }
            100% {
                top: 0;
                opacity: 1;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="text-right p-4">
                    <a href="#" id="uploadExcel" class="btn btn-primary col-sm-2">{{__('Add Institute From Excel')}}</a>
                    <a href="{{route('admin.instituteAdd')}}"
                       class="btn btn-primary col-sm-2">{{__('Create Institute')}}</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table" id="band" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Name')}}</th>
                                        <th class="all">{{__('District')}}</th>
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
    <div class="modal" id="message-modal">
        <div class="modal-sandbox"></div>
        <div class="modal-box">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Add Institute') }}</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{Form::open(['route' => 'admin.addInstituteFromExcel', 'files' => true])}}
                <div class="row">
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
                    <div class="col-md-4 form-group">
                        <label for="name">{{__('File')}}</label>
                        <input type="file" class="form-control" name="file" id="name">
                        <pre class="text-danger">{{$errors->first('file')}}</pre>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
            <div class="modal-footer">
                <button type="button" class="close close-modal btn btn-primary ml-2" data-dismiss="modal"
                        aria-label="Close">
                    Close
                </button>
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
            ajax: '{{route('admin.instituteList')}}',
            autoWidth: false,
            columnDefs: [
                {"className": "text-center data-center", "targets": "_all"}
            ],
            columns: [
                {"data": "name"},
                {"data": "district"},
                {"data": "status"},
                {"data": "action", orderable: false, searchable: false}
            ]
        });
        $("#uploadExcel").click(function () {
            // $("#message-modal").modal();
            $("#message-modal").css({"display":"block"});
            $("body").css({"overflow-y": "hidden"});
        });
        $(".modal-sandbox").click(function(){
            $(".modal").css({"display":"none"});
            $("body").css({"overflow-y": "auto"});
        });

        $("#message-modal").on("click", ".close-modal", function () {
            $(".modal").css({"display":"none"});
            $("body").css({"overflow-y": "auto"});
        });
        let upozilas = '<?php echo json_encode(upozila(), JSON_FORCE_OBJECT); ?>';

        $(document).ready(function () {
            getUpozila();
            $("#district").change(function () {
                getUpozila();
            });
        });

        function getUpozila() {
            let district = $("#district").val();
            let options = "";
            let upozils = $.parseJSON(upozilas);
            $.each(upozils, function (index, item) {
                if (district == item.district_id) {
                    options += "<option value='" + item.id + "'>" + item.name + "</option>";

                }
            });
            $("#upozila").empty();
            $("#upozila").append(options);
        }
    </script>
@endsection
