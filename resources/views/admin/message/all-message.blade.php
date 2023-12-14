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
                                    <th style="width:5%">Stock</th>
                                    <th style="width:10%">Image</th>
                                    <th style="width:15%">Title</th>
                                    <th style="width:10%">Sender</th>
                                    <th style="width:10%">Receiver</th>
                                    <th style="width:5%">Is_feature</th>
                                    <th style="width:10%">Package</th>
                                    <th style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($leads as $message)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>#{{$message->lead->inventories_car->stock}}</td>
                                        @php
                                            $image = $message->lead->inventories_car->image_from_url;
                                            $img = explode(',', $image);
                                        @endphp
                                        <td>
                                            <img width="25%" src="{{ $img[0]}}" alt="Image">
                                        </td>

                                        <td>{{$message->lead->inventories_car->title}}</td>
                                        <td>{{ $message->user->username }}</td>
                                        <td>{{ $message->receiver->username }}</td>
                                        <td>
                                            @if($message->lead->inventories_car->is_feature == 0)
                                                No
                                            @else
                                                Yes
                                            @endif
                                        </td>
                                        <td>
                                            @if($message->lead->inventories_car->package == 1)
                                                Standard
                                            @elseif($message->lead->inventories_car->package == 1)
                                                Copper
                                            @elseif($message->lead->inventories_car->package == 2)
                                               Sliver
                                            @elseif($message->lead->inventories_car->package == 3)
                                                Gold
                                            @elseif($message->lead->inventories_car->package == 4)
                                                Paltinum
                                            @endif
                                        </td>


                                        <td>
                                            <a title="message view" id="messaging"
                                            data-lead_id="{{ $message->lead_id }}"

                                            class="btn btn-warning view_news">
                                            <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-danger delete_message" data-id="{{ $message->id}}"><i class="fa fa-delete-left"></i></a>
                                            <a class="btn btn-danger permanent_delete_message" data-id="{{ $message->id}}"><i class="fa fa-trash"></i></a>
                                        </td>


                                    </tr>
                                @empty
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

                <div style="height:400px; overflow-y:scroll; z-index:0;" id="MessageAdminSee"></div>








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
         $(document).on('click','#messaging',function(){
            let lead_id = $(this).data('lead_id');

            $.ajax({
                url:"{{route('message.view')}}",
                type:"get",
                data:{lead_id:lead_id },
                success: function(res) {
    console.log(res);
    $('#MessageAdminSee').empty();

    res.data.forEach(function(message) {
        console.log(message.user.role);

        var formattedTime = new Intl.DateTimeFormat('en-US', { day: 'numeric', month: 'short', hour: 'numeric', minute: 'numeric', hour12: true }).format(new Date(message.created_at));

        if (message.user.role == 0) {
            $('#MessageAdminSee').append('<p class="w-50" style="background-color:rgb(2, 41, 88); padding:15px;border-radius:7px; color:white; margin-left:0px">' + message.message + '<span style="margin-left:10px; float:right; margin-top:13px" class="text-warning">' + formattedTime + '</span></p>');
        } else {
            $('#MessageAdminSee').append('<p class="mt-3 w-50 text-left" style="background-color:rgb(88, 87, 87); padding:15px;  border-radius:7px; color:white;margin-left:335px">' + message.message + '<span style="margin-left:10px; float:right; margin-top:13px" class="text-warning">' + formattedTime + '</span></p>');
        }
    });

    $('#adminMessageView').modal('show');
},

            })
         })
    })



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
                        url:"{{ route('admin.message.delete') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function (res) {
                            console.log(res);
                            // Show Toastr success message
                            if (res.status == "success") {
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
                        url:"{{ route('admin.permanent.message.delete') }}",
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function (res) {
                            console.log(res);
                            // Show Toastr success message
                            if (res.status == "success") {
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
