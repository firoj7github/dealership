@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-11 pt-5 m-auto rounded">
            <div class="card">
                <div class="card-header">

                    <h5>All Car News</h5>
                    {{-- <a class="btn btn-info float-right" data-toggle="modal" data-target="#dealerCreate">Create Dealer<a> --}}
                    <a class="btn btn-info float-right text-white" data-bs-toggle="modal" data-bs-target="#newsCreate">
                        Add News
                    </a>

                </div>
                <div class="card-block">
                    @if (session()->has('message'))
                        <h3 class="text-success">{{ session()->get('message') }}</h3>
                    @endif
                    <div class="table-responsive dt-responsive">
                        <table id="dom-jqry" class="table table-striped table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Inventory Image</th>
                                    <th>Inventory Title</th>


                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($news as $key=>$new)
                                    <tr>
                                        <td width="5%">{{ $key + 1 }}</td>
                                        <td width="20%"><img src="{{ asset('/frontend') }}/images/news/{{ $new->image }}"
                                                width="80px"></td>

                                        <td width="65%">{{ $new->title }}</td>

                                        <td width="10%">
                                            <a href="javascript:void(0)" data-id="{{ $new->id }}" {{-- data-bs-toggle="modal" data-bs-target="#newsView" --}}
                                                class="btn btn-sm btn-info view_news text-white" title="View"><i class="fa fa-eye"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#newsEdit" title="Edit"
                                                class="btn btn-sm btn-success edit_news_form text-white" data-id="{{ $new->id }}"
                                                data-title="{{ $new->title }}" data-description="{{ $new->description }}"
                                                data-image="{{ $new->image }}"><i class="fa fa-edit"></i>
                                            </a>


                                            <a class="btn  btn-sm btn-warning delete_news text-white" data-id="{{ $new->id }}" title="Archive"> <i class="fa fa-delete-left"></i></a>
                                            <a class="btn btn-danger btn-sm permanent_delete text-white" data-id="{{ $new->id }}" title="Delete"> <i class="fa fa-trash"></i></a>
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

    {{-- news create modal start --}}

    <!-- Modal -->
    <div class="modal fade" id="newsCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Dealer</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
                </div>
                <div class="modal-body">
                    <form  method="POST" id="newsForm" class="form-horizontal   mt-2 sales-form" enctype="multipart/form-data">
                        @csrf


                        <div class="row mb-3">
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label class="control-label">Car Title <span style="color:red;font-weight:bold">*</span></label>
                                <input id="title" name="title" class="form-control rounded" placeholder="car title"
                                    type="text">
                                    <div class="text-danger  error-title"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
                                <label class="control-label">Car Description</small> <span style="color:red;font-weight:bold">*</span></label>
                                <textarea name="description" id="summernote" rows="12" class="form-control rounded" placeholder=""></textarea>
                                <div class="text-danger  error-description"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label class="control-label">Car Image Upload <span style="color:red;font-weight:bold">*</span></label>
                                <br />
                                <input name="img" type="file" id="image">
                                <div class="text-danger  error-img"></div>
                            </div>
                        </div>

                        <button class="btn btn-primary float-right" type="submit">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- news create modal close --}}




    {{-- news edit modal start --}}

    <!-- Modal -->
    <div class="modal fade" id="newsEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">News Edit</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <form id="NewsEditFrom" class="form-horizontal mt-2 sales-form" enctype="multipart/form-data">


                        <input type="hidden" name="news_id" id="news_id">


                        <div class="row mb-3">
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label class="control-label">Car Title  <span style="color:red;font-weight:bold">*</span></label>
                                <input id="up_title" name="up_title" class="form-control rounded" placeholder="car title"
                                    type="text">
                                    <div class="text-danger  error-up_title"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
                                <label class="control-label">Car Description </small>  <span style="color:red;font-weight:bold">*</span></label>
                                <textarea name="up_description"  rows="12" class="form-control rounded description"
                                    placeholder=""></textarea>
                                <div class="text-danger  error-up_description"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label class="control-label">Car Image Upload</label>
                                <br />
                                <input name="up_img" type="file" id="up_image">
                                <img src="{{ asset('/frontend') }}/images/news/{{isset($new->image) ? $new->image : ''  }}" width="20%" />
                                <div class="text-danger  error-up_img"></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- news edit modal close --}}
    {{-- news view modal start --}}

    <!-- Modal -->
    <div class="modal fade" id="newsView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View News</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">


                    <div class="card">
                        <div id="title_img">

                        </div>
                        {{-- <img id="title_img" width="100%" src="" class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                            <h5 id="title_news" class="card-title"></h5>
                            <p id="des_news" style="text-align:justify" class="card-text"></p>

                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

    {{-- news view modal close --}}
@endsection

@push('delear_JS')
    <script type="text/javascript">
        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });



        $(document).ready(function() {


            $('#summernote').summernote();

            $('#newsForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Gather form data
            var formData = new FormData($(this)[0]);

            // Make an AJAX request
            $.ajax({
                url: '{{ route("news.post") }}', // Replace with your route
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {

                    var errors = res.errors;
                    if (errors) {
                        $.each(errors, function(index,error) {

                        $('.error-' + index).text(error);

                        });

                    } else if (res.status == 'success') {
                        // Reset form, close modal, update table, show success message
                        $('#newsForm')[0].reset();
                        $('#newsCreate').modal('hide');
                        toastr.success('News Added Successfully!');
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(error);
                }
            });
        });

            // update news data
            $('.edit_news_form').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let title = $(this).data('title');
                let description= $(this).data('description');
                let image = $(this).data('image');
                console.log(description);
                var tempElement = document.createElement('div');
                tempElement.innerHTML = description;
                var textOnly = tempElement.textContent || tempElement.innerText || '';


                $('#news_id').val(id);
                $('#up_title').val(title);
                $('.description').text(textOnly);
                //   $('#up_image').val(image);




            });



        });



        $(document).ready(function() {
            $('#NewsEditFrom').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('news.update') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(res) {

                    var errors = res.errors;
                    if (errors) {
                        $.each(errors, function(index,error) {

                        $('.error-' + index).text(error);

                        });

                    } else if (res.status == 'success') {
                        // Reset form, close modal, update table, show success message
                        $('#NewsEditFrom')[0].reset();
                        $('#newsEdit').modal('hide');
                        toastr.success('News update Successfully!');
                        window.location.reload();
                    }


                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // news delete
            $('.delete_news').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                $.confirm({
                    title: 'Archive Confirmation',
                    content: 'Are you sure?',
                    buttons: {
                        cancel: {
                            text: 'No',
                            btnClass: 'btn-primary',
                            action: function() {
                                // Do nothing on cancel
                            }
                        },
                        confirm: {
                            text: 'Yes',
                            btnClass: 'btn-danger',
                            action: function() {
                                $.ajax({
                                    url: "{{ route('news.delete') }}",
                                    type: 'post',
                                    data: {
                                        id: id
                                    },
                                    success: function(res) {

                                        // Show Toastr success message
                                        if (res.status == "success") {
                                        $('.table').load(location.href + ' .table');
                                        location.reload();
                                    }
                                    },
                                    error: function(error) {
                                        // Show Toastr error message
                                        toastr.error(error.responseJSON.message);
                                    }
                                });
                            }
                        },

                    }
                });




            })

            // permanent delete

            $('.permanent_delete').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                $.confirm({
                    title: 'Delete Confirmation',
                    content: 'Are you sure?',
                    buttons: {
                        cancel: {
                            text: 'No',
                            btnClass: 'btn-primary',
                            action: function() {
                                // Do nothing on cancel
                            }
                        },
                        confirm: {
                            text: 'Yes',
                            btnClass: 'btn-danger',
                            action: function() {
                                $.ajax({
                                    url: "{{ route('news.permanent.delete') }}",
                                    type: 'post',
                                    data: {
                                        id: id
                                    },
                                    success: function(res) {
                                        // console.log(res);
                                        // return;
                                        // Show Toastr success message
                                        if (res.status == "success") {
                                        $('.table').load(location.href + ' .table');
                                        location.reload();
                                    }
                                    },
                                    error: function(error) {
                                        // Show Toastr error message
                                        toastr.error(error.responseJSON.message);
                                    }
                                });
                            }
                        },

                    }
                });




            })


            // news view
            $('.view_news').on('click', function(e) {
                e.preventDefault();

                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('news.view') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        var show_all = res.show;
                        //  console.log(show_all);
                        console.log(show_all);

                        var des_all = stripTags(show_all.description);

                        var img_url = "/frontend/images/news/" + show_all.image;

                        $('#newsView').modal('show');
                        $('#title_img').html('<img src= " ' + img_url +
                            ' " alt="Image" width="100%"/>');
                        $('#title_news').text(show_all.title);
                        $('#des_news').text(des_all);


                    }
                })

            })




        });

        function stripTags(input) {
            return input.replace(/<\/?[^>]+(>|$)/g, "");
        }
    </script>
@endpush
