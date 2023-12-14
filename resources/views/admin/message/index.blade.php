@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-11 pt-5 m-auto rounded">
            <div class="card">

                <div class="card-block">
                    @if (session()->has('message'))
                        <h3 class="text-success">{{ session()->get('message') }}</h3>
                    @endif
                    <div class="table-responsive dt-responsive">
                        <table id="dom-jqry" class="table table-striped table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width:5%">S.L</th>
                                    <th style="width:5%">Name</th>
                                    <th style="width:10%">Email</th>
                                    <th style="width:15%">Subject</th>
                                    <th style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($messages as $message)
                                @php
                                    $status = 0;
                                @endphp
                                    <tr class="{{($message->status == 0) ? 'bg-info' : ''}}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$message->name}}</td>

                                        <td>
                                            {{$message->email}}
                                        </td>

                                        <td>{{$message->subject}}</td>


                                        <td>
                                            <a title="message view"
                                            data-id="{{ $message->id }}"
                                            data-status="{{ $message->status }}"
                                            data-message="{{$message->message}}"
                                            class="btn btn-info view_message">
                                            <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-warning delete_message" data-id="{{ $message->id}}"><i class="fa fa-delete-left"></i></a>
                                            <a class="btn btn-danger permanent_delete_message" data-id="{{ $message->id}}"><i class="fa fa-trash"></i></a>
                                        </td>


                                    </tr>
                                @empty
                                <tr >
                                    <td colspan="5" class="text-center">No Message Available</td>
                                </tr>
                                @endforelse

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- message view modal --}}

    <div class="modal fade" id="adminMessageView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message View</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div style="background-color: rgb(216, 233, 247); border-radius:3px" class="modal-body">

                <div id="MessageAdminSee" >


                </div>
                </div>

            </div>
        </div>
    </div>




@endsection

@push('delear_JS')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){

        $('.view_message').on('click',function(){
            var message = $(this).data('message');
            var id = $(this).data('id');
            var status = $(this).data('status');
            $('#MessageAdminSee').text( message );
            console.log(message);
            $('#adminMessageView').modal('show');

            if(status == 0)
            {
                $.ajax({

                    url:"{{ route('admin.contact-message.status-update') }}",
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (res) {
                        console.log(res);

                    },
                    error: function (error) {
                        // Show Toastr error message
                        toastr.error(error.responseJSON.message);
                    }
               });
            }

        });


    });



    $('.delete_message').on('click', function(e) {
                e.preventDefault();

      let id = $(this).data('id');
    $.confirm({
        title: 'Archive Confirmation',
        content: 'Are you sure?',
        buttons: {
            cancel: {
                text: 'No',
                btnClass: 'btn-primary',
                action: function () {
                    // Do nothing on cancel
                }
            },
            confirm: {
                text: 'Yes',
                btnClass: 'btn-danger',
                action: function () {
                    $.ajax({
                        url:"{{ route('admin.contact-message.delete') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function (res) {
                            console.log(res);
                            // Show Toastr success message
                            if (res.status == "success") {
                                toastr.success('message archived successfully.');
                                $('.table').load(location.href + ' .table');
                                location.reload();
                            }
                        },
                        error: function (error) {
                            // Show Toastr error message
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }
            },

        }
    });

});

// permanent delete ajax
    $('.permanent_delete_message').on('click', function(e) {
                e.preventDefault();

      let id = $(this).data('id');
    $.confirm({
        title: 'Delete Confirmation',
        content: 'Are you sure?',
        buttons: {
            cancel: {
                text: 'No',
                btnClass: 'btn-primary',
                action: function () {
                    // Do nothing on cancel
                }
            },
            confirm: {
                text: 'Yes',
                btnClass: 'btn-danger',
                action: function () {
                    $.ajax({
                        url:"{{ route('admin.contact-message-permanent.delete') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function (res) {
                            console.log(res);
                            // Show Toastr success message
                            if (res.status == "success") {
                                toastr.success('message delete successfully.');
                                $('.table').load(location.href + ' .table');
                                location.reload();
                            }
                        },
                        error: function (error) {
                            // Show Toastr error message
                            toastr.error(error.responseJSON.message);
                        }
                    });
                }
            },

        }
    });

});

    </script>

@endpush
