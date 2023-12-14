@extends('layouts.master')
@section('title', $title)
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dropify.min.css')}}">
@endsection
@section('content')
    <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        {{Form::open(['route' => 'admin.newsAddProcess', 'files' => true])}}
                            <input type="hidden" class="form-control" name="id" @if(isset($item)) value="{{$item->id}}" @else value="{{old('id')}}" @endif>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title">{{__('Title')}}</label>
                                    <input type="text" class="form-control" name="title" id="title" @if(isset($item)) value="{{$item->title}}" @else value="{{old('title')}}" @endif>
                                    <pre class="text-danger">{{$errors->first('title')}}</pre>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label class="form-label">{{__('Status')}}</label>
                                            <select class="form-control" name="status">
                                                @foreach(newsStatus() as $key => $value)
                                                    <option value="{{$key}}"
                                                            @if((isset($item) && $item->status == $key) || ($key == old('status'))) selected  @elseif(!isset($item) && ($key != old('status')) && $key == ACTIVE_STATUS) selected @endif>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <pre class="text-danger">{{$errors->first('status')}}</pre>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="news">{{ __('News') }}</label>
                                    <textarea rows="10" class="form-control" name="news">{{ isset($item) ? $item->news : "" }}</textarea>
                                    <pre class="text-danger">{{$errors->first('news')}}</pre>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="logo">{{__('Upload Image')}}</label>
                                    <input type="file" name="image" id="input-file-now" class="dropify" data-default-file="{{ isset($item->image) ? asset(newsImageViewPath() . $item->image) : '' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">{{$buttonTitle}}</button>
                                </div>
                            </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script type='text/javascript' src='{{ asset('assets/js/dropify.min.js') }}'></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endsection
