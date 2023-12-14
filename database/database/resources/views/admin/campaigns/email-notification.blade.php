@extends('layouts.master')
@section('title', __('Email Notification'))
@section('style')
    <link href="{{ asset('assets/css/jquery.multiselect.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dropify.min.css')}}">
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">{{ __('Send Email Notification') }} <div class="float-right"><button class="btn btn-primary" id="testEmail">{{ __('Test Email') }}</button>
                        </div></div>
                    {{ Form::open(['route' => 'admin.sendEmailNotification', 'files' => true, 'id' => 'form']) }}
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="subject">{{ __('Subject') }}</label>
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="{{ __('Enter subject') }}" @if(!empty(old('subject'))) value="{{ old('subject') }}" @endif>
                                <pre class="text-danger">{{$errors->first('subject')}}</pre>
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="credit2">{{ __('Email Body') }}</label>
                                <pre class="text-info">{{ __('Description should not be greater than 500 characters') }}</pre>
                                <textarea rows="5" class="form-control" id="body" name="body" placeholder="{{ __('Enter email body') }}">{{ !empty(old('body')) ? old('body') : "" }}</textarea>
                                <pre class="text-danger">{{$errors->first('body')}}</pre>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="logo">{{__('Upload Image')}}</label>
                                <input type="file" name="image" id="input-file-now" class="dropify" data-default-file="{{old('image')}}" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="link">{{__('Button Link (optional)')}}</label>
                                <input type="text" class="form-control" name="link" id="link" @if(!empty(old('link'))) value="{{ old('link') }}" @endif>
                                <pre class="text-danger">{{$errors->first('link')}}</pre>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label class="form-label">{{__('News (optional)')}}</label>
                                        <select class="form-control" name="news[]" multiple="multiple" id="news">
                                            @foreach($allNews as $news)
                                                <option value="{{$news->id}}"
                                                        @if(($news->id == old('news'))) selected @endif>{{$news->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <pre class="text-danger">{{$errors->first('news')}}</pre>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary">{{ __('Send Email Notification') }}</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/jquery.multiselect.js') }}"></script>
    <script type='text/javascript' src='{{ asset('assets/js/dropify.min.js') }}'></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
    <script>
        $('#news').multiselect({
            columns  : 1,
            search   : true,
            selectAll: false,
            texts    : {
                placeholder: 'Select News',
                search     : 'Search News'
            },
            checked: true
        });

        $(document).on("change", "#news", function() {
            var count = 0;
            for (var i = 0; i < this.options.length; i++)
            {
                var option = this.options[i];
                option.selected ? count++ : null;
                if (count > 2) {
                    option.selected = false;
                } else {
                    option.disabled = false;
                }
            }
            var count = 0;
            $('.ms-options ul li').each(function(i)
            {
                if ($(this).find('input:checkbox').is(':checked')) {
                    count++;
                }
                if (count > 2) {
                    $(this).selected = false;
                    $(this).find('input:checkbox').prop( "checked", false );
                    $('#alert').removeClass('alert-danger');
                    $('#alert').addClass('alert-success');
                    $('#alert').show();
                    $('#alert .message').text("{{ __('Sorry! You can not select more than 2 news.') }}");
                    $("#alert").fadeTo(5000, 500).slideUp(500, function() {
                        $("#alert").slideUp(500);
                    });
                }
            });
        });

        $('#testEmail').click(function (e) {
            e.preventDefault();
            $("#testEmail").attr("disabled", true);
            $("#testEmail").text("{{ __('Sending..') }}");
            var form = $('#form')[0];

            var formData = new FormData(form);
            var request = $.ajax({
                url: "{{ route('admin.testEmailNotification') }}",
                type: "post",
                data:formData,
                contentType: false,
                cache: false,
                processData:false,
            });
            request.done(function (response) {
                if (response.status) {
                    $("#alert").removeClass('alert-danger');
                    $("#alert").addClass('alert-success');
                    $('#alert').show();
                    $("#alert .message").text(response.message);
                    $("#alert").fadeTo(5000, 500).slideUp(500, function() {
                        $("#alert").slideUp(500);
                    });
                } else {
                    $("#alert").removeClass('alert-success');
                    $("#alert").addClass('alert-danger');
                    $('#alert').show();
                    $("#alert .message").text(response.message);
                    $("#alert").fadeTo(5000, 500).slideUp(500, function() {
                        $("#alert").slideUp(500);
                    });
                }
                $("#testEmail").attr("disabled", false);
                $("#testEmail").text("{{ __('Test Email') }}");
            });
        });
    </script>
@endsection
