@extends('layouts.master')
@section('title', __('General Settings'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">{{ __('Settings') }}</div>
                    {{ Form::open(['route' => 'admin.settingsSaveProcess', 'files' => true ]) }}
                        <div class="row">
                            <div class="col-md-4 form-group mb-3">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" name="{{'phone'  . '_' . Auth::id()}}" class="form-control" id="phone" value="{{ (isset($settings) && isset($settings['phone' . '_' . Auth::id()])) ? $settings['phone' . '_' . Auth::id()] : '' }}">
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="default_appointment_time">{{ __('Default Appointment Time (in minutes)') }}</label>
                                <input type="number" min="1" name="{{'default_appointment_time'  . '_' . Auth::id()}}" class="form-control" id="default_appointment_time" value="{{ (isset($settings) && isset($settings['default_appointment_time' . '_' . Auth::id()])) ? $settings['default_appointment_time' . '_' . Auth::id()] : '' }}">
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="about_us">{{ __('About Us') }}</label>
                                <textarea rows="5" class="form-control" name="{{'about_us'  . '_' . Auth::id()}}">{{ isset($settings) && isset($settings['about_us_' . Auth::id()]) ? $settings['about_us_' . Auth::id()] : (old("about_us_" . Auth::id()) ? old("about_us_" . Auth::id()) : "") }}</textarea>
                                <pre class="text-danger">{{$errors->first("about_us_" . Auth::id())}}</pre>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
