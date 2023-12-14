@extends('layouts.master')
@section('title', __('Notification'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Send Notification</div>
                    {{ Form::open(['route' => 'sendNotification']) }}
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label for="firstName2">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter notification title">
                        </div>

                        <div class="col-md-12 form-group mb-3">
                            <label for="credit2">Notification Body</label>
                            <textarea rows="5" class="form-control" name="body" placeholder="Enter notification body"></textarea>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary">Send Notification</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
