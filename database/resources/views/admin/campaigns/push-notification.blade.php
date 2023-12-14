@extends('layouts.master')
@section('title', __('Push Notification'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">{{ __('Send Push Notification') }}</div>
                    {{ Form::open(['route' => 'admin.sendPushNotification']) }}
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="firstName2">{{ __('Title') }}</label>
                                <input type="text" name="title" class="form-control" placeholder="{{ __('Enter notification title') }}">
                            </div>

                            <div class="col-md-12 form-group mb-3">
                                <label for="credit2">{{ __('Notification Body') }}</label>
                                <pre class="text-info">{{ __('Notification body should not be greater than 250 characters') }}</pre>
                                <textarea rows="5" class="form-control" name="body" placeholder="{{ __('Enter notification body') }}"></textarea>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label class="form-label">{{__('News (optional)')}}</label>
                                        <select class="form-control" name="news" id="news">
                                            <option value="0">{{ __('Select news') }}</option>
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
                                <button class="btn btn-primary">{{ __('Send Push Notification') }}</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
