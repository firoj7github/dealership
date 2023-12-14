@extends('layouts.master')
@section('title', __('Sms Notification'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">{{ __('Send Sms Notification') }}</div>
                    {{ Form::open(['route' => 'admin.sendSmsNotification']) }}
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="credit2">{{ __('Notification Body') }}</label>
                                <pre class="text-info">{{ __('Notification body should not be greater than 160 characters') }}</pre>
                                <textarea rows="5" class="form-control" name="body" placeholder="{{ __('Enter notification body') }}"></textarea>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary">{{ __('Send Sms Notification') }}</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
