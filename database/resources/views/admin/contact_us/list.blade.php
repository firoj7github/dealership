@extends('layouts.master')
@section('title',__('Contact Us Message List'))
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table" id="band" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Name')}}</th>
                                        <th class="all">{{__('Email')}}</th>
                                        <th class="all">{{__('Message')}}</th>
                                        <th class="all">{{__('Time')}}</th>
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
    <!-- Modal -->
    <!-- Modal -->
    <div class="modal" id="message-modal">
        <div class="modal-sandbox" ></div>
        <div class="modal-box">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Message Details') }}</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="message"></p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary ml-2 read-button">{{ __('Mark as read') }}</a>
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
            aaSorting: [],
            ajax: '{{route('admin.supportMessageList')}}',
            autoWidth:false,
            columnDefs: [
                {"className": "text-center data-center", "targets": "_all"}
            ],
            columns: [
                {"data": "name"},
                {"data": "email"},
                {"data": "message", className: 'large-text text-center data-center'},
                {"data": "created_at"},
                {"data": "action", orderable: false, searchable: false}
            ]
        });
    </script>

    <script>
        $(document).ready(function () {

            $(document).on("click", ".modal-trigger", function(e){
                $("#message-modal").css({"display":"block"});
                $("body").css({"overflow-y": "hidden"});
                $("#message-modal").find(".message").text($(this).data('contact-message'));
                if ($(this).data("read") == "yes") {
                    $(".read-button").attr("href", "#");
                    $(".read-button").text("{{ __('Close') }}");
                    $(".read-button").addClass("close-modal");
                } else {
                    var link = $(this).data("link");
                    $(".read-button").attr("href", link);
                    $(".read-button").text("{{ __('Mark as read') }}");
                    $(".read-button").removeClass("close-modal");
                }
            });

            $(".modal-sandbox").click(function(){
                $(".modal").css({"display":"none"});
                $("body").css({"overflow-y": "auto"});
            });

            $("#message-modal").on("click", ".close-modal", function () {
                $(".modal").css({"display":"none"});
                $("body").css({"overflow-y": "auto"});
            });
        });
    </script>
@endsection
