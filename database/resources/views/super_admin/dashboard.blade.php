@extends('layouts.master')
@section('title', __('Dashboard'))
@section('content')
    <div class="row">
        {{--<div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Form Inputs</div>
                    <form>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="firstName1">First name</label>
                                <input type="text" class="form-control" id="firstName1" placeholder="Enter your first name">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="lastName1">Last name</label>
                                <input type="text" class="form-control" id="lastName1" placeholder="Enter your last name">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="phone">Phone</label>
                                <input class="form-control" id="phone" placeholder="Enter phone">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="credit1">Cradit card number</label>
                                <input class="form-control" id="credit1" placeholder="Card">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="website">Website</label>
                                <input class="form-control" id="website" placeholder="Web address">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="picker2">Birth date</label>
                                <input id="picker2" class="form-control" placeholder="yyyy-mm-dd" name="dp">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="picker1">Select</label>
                                <select class="form-control">
                                    <option>Option 1</option>
                                    <option>Option 1</option>
                                    <option>Option 1</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Form Inputs Rounded</div>
                    <form>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="firstName2">First name</label>
                                <input type="text" class="form-control form-control-rounded" id="firstName2" placeholder="Enter your first name">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="lastName2">Last name</label>
                                <input type="text" class="form-control form-control-rounded" id="lastName2" placeholder="Enter your last name">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="exampleInputEmail2">Email address</label>
                                <input type="email" class="form-control form-control-rounded" id="exampleInputEmail2" placeholder="Enter email">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="phone1">Phone</label>
                                <input class="form-control form-control-rounded" id="phone1" placeholder="Enter phone">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="credit2">Cradit card number</label>
                                <input class="form-control form-control-rounded" id="credit2" placeholder="Card">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="website2">Website</label>
                                <input class="form-control form-control-rounded" id="website2" placeholder="Web address">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="picker3">Birth date</label>
                                <input id="picker3" class="form-control form-control-rounded" placeholder="yyyy-mm-dd" name="dp">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="picker1">Select</label>
                                <select class="form-control form-control-rounded">
                                    <option>Option 1</option>
                                    <option>Option 1</option>
                                    <option>Option 1</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Switch</div>
                    <label class="switch pr-5 switch-primary mr-3">
                        <span>Primary</span>
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                    <label class="switch pr-5 switch-secondary mr-3">
                        <span>Secondary</span>
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                    <label class="switch pr-5 switch-success mr-3">
                        <span>Success</span>
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                    <label class="switch pr-5 switch-warning mr-3">
                        <span>Warning</span>
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                    <label class="switch pr-5 switch-danger mr-3">
                        <span>Danger</span>
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                    <label class="switch pr-5 switch-light mr-3">
                        <span>Light</span>
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                    <label class="switch pr-5 switch-dark mr-3">
                        <span>Dark</span>
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Checkbox Default</div>
                    <label class="checkbox checkbox-primary">
                        <input type="checkbox" checked>
                        <span>Primary</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-secondary">
                        <input type="checkbox" checked>
                        <span>Secondary</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-success">
                        <input type="checkbox" checked>
                        <span>Success</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-warning">
                        <input type="checkbox" checked>
                        <span>Warning</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-danger">
                        <input type="checkbox" checked>
                        <span>Danger</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-info">
                        <input type="checkbox" checked>
                        <span>Info</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-dark">
                        <input type="checkbox" checked>
                        <span>Dark</span>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Checkbox Outline</div>
                    <label class="checkbox checkbox-outline-primary">
                        <input type="checkbox" checked>
                        <span>Primary</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-outline-secondary">
                        <input type="checkbox" checked>
                        <span>Secondary</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-outline-success">
                        <input type="checkbox" checked>
                        <span>Success</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-outline-warning">
                        <input type="checkbox" checked>
                        <span>Warning</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-outline-danger">
                        <input type="checkbox" checked>
                        <span>Danger</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-outline-info">
                        <input type="checkbox" checked>
                        <span>Info</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox checkbox-outline-dark">
                        <input type="checkbox" checked>
                        <span>Dark</span>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Radio Button</div>
                    <label class="radio radio-primary">
                        <input type="radio" name="radio" value="0">
                        <span>Primary</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-secondary">
                        <input type="radio" name="radio" value="1">
                        <span>Secondary</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-success">
                        <input type="radio" name="radio" value="2">
                        <span>Success</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-warning">
                        <input type="radio" name="radio" value="3">
                        <span>Warning</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-danger">
                        <input type="radio" name="radio" value="4">
                        <span>Danger</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-light">
                        <input type="radio" name="radio" value="5">
                        <span>Light</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-dark">
                        <input type="radio" name="radio" value="6">
                        <span>Dark</span>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Radio Button Outline</div>
                    <label class="radio radio-outline-primary">
                        <input type="radio" name="radio" value="">
                        <span>Primary</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-outline-secondary">
                        <input type="radio" name="radio" value="">
                        <span>Secondary</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-outline-success">
                        <input type="radio" name="radio" value="">
                        <span>Success</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-outline-warning">
                        <input type="radio" name="radio" value="">
                        <span>Warning</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-outline-danger">
                        <input type="radio" name="radio" value="">
                        <span>Danger</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-outline-light">
                        <input type="radio" name="radio" value="">
                        <span>Light</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio radio-outline-dark">
                        <input type="radio" name="radio" value="">
                        <span>Dark</span>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>--}}

    </div>
@endsection
