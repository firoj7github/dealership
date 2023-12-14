@extends('dealer.layouts.app')
@push('css')
    <!-- =-=-=-=-=-=-= noUiSlider =-=-=-=-=-=-= -->
    {{-- <link href="{{asset('/frontend')}}/css/nouislider.min.css" rel="stylesheet"> --}}
    <!-- =-=-=-=-=-=-= Owl carousel =-=-=-=-=-=-= -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('/frontend')}}/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend')}}/css/owl.theme.css"> --}}
    <!-- =-=-=-=-=-=-= PrettyPhoto =-=-=-=-=-=-= -->
    {{-- <link rel="stylesheet" href="{{asset('/frontend')}}/css/jquery.fancybox.min.css" type="text/css" media="screen" />
 --}}


    <style>
        .line_height {
            position: relative;
            line-height: 63px;
        }

        .heading_content h3::before {
            background-color: #242424;
            bottom: 6px;
            content: "";
            height: 1px;
            left: 0;
            margin: 0 auto;
            right: 0;
            position: absolute;
            width: 99px;
        }

        .heading_content h3::after {
            background-color: #242424;
            bottom: 0;
            content: "";
            height: 1px;
            left: 0;
            margin: 0 auto;
            position: absolute;
            right: 0;
            width: 59px;
        }

        .heading_content h2::before {
            background-color: #242424;
            bottom: 6px;
            content: "";
            height: 1px;
            left: 0;
            margin: 0 auto;
            right: 0;
            position: absolute;
            width: 99px;
        }

        .heading_content h2::after {
            background-color: #242424;
            bottom: 0;
            content: "";
            height: 1px;
            left: 0;
            margin: 0 auto;
            position: absolute;
            right: 0;
            width: 59px;
        }
    </style>
@endpush
@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow p-4">

                                @if (session()->has('message'))
                                    <h3 class="text-success">{{ session()->get('message') }}</h3>
                                @endif
                                <div class="card-header">
                                    <a href="{{ route('inventory.import') }}" style="font-size: 35px" title="back to list"><i
                                            class="fa-solid fa-arrow-left" style="color: #de1767;"></i></a>
                                    <div class="heading_content">
                                        <h2 class="text-center fw-bold line_height">Add new Inventory </h2>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="edit_from_submit" action="{{ route('store.inventory')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{$dealer->id}}" name="dealer_info_id">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="heading_content">
                                                    <h3 class="text-center fw-bold line_height">Basic Information</h3>
                                                </div>

                                                <table class="table mt-4">
                                                    <tr>
                                                        <td>Vin  <span style="color: red;font-weight:bold">*</span></td>
                                                        <td><input type="text" name="vin" class="form-control"
                                                                placeholder="Enter Vin" value="{{old('vin')}}">

                                                                @error('vin')
                                                                <p style="color: red;">{{ $message }}</p>
                                                                 @enderror
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Make  <span style="color: red;font-weight:bold">*</span></td>
                                                        <td><input type="text" name="make" class="form-control"
                                                                placeholder="Enter Make" value="{{old('make')}}">
                                                                @error('make')
                                                                <p style="color: red;">{{ $message }}</p>
                                                            @enderror

                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Model  <span style="color: red;font-weight:bold">*</span></td>
                                                        <td><input type="text" name="model" class="form-control"
                                                                placeholder="Enter Model"  value="{{old('model')}}">
                                                                @error('model')
                                                                <p style="color: red;">{{ $message }}</p>
                                                            @enderror
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Model Year  <span style="color: red;font-weight:bold">*</span></td>
                                                        <td><input type="text" name="model_year" class="form-control"
                                                                placeholder="Enter Model Year"  value="{{old('model_year')}}">
                                                                @error('model_year')
                                                                <p style="color: red;">{{ $message }}</p>
                                                            @enderror
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Model Number</td>
                                                        <td><input type="text"  class="form-control"
                                                            name="model_number" placeholder="Enter Highway MPG"  value="{{old('model_number')}}"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Trim Package</td>
                                                        <td><input type="text" name="trim_package" class="form-control"
                                                                placeholder="Enter Trim Package"  value="{{old('trim_package')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Body  <span style="color: red;font-weight:bold">*</span></td>
                                                        <td><input type="text" name="body_style" class="form-control"
                                                                placeholder="Enter Body Style"  value="{{old('body_style')}}">
                                                                @error('body_style')
                                                                <p style="color: red;">{{ $message }}</p>
                                                            @enderror
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fuel Type</td>
                                                        <td> <input type="text" name="fuel" class="form-control"
                                                                placeholder="Enter Fuel Type"  value="{{old('fuel')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Transmission</td>
                                                        <td><input type="text" name="transmission" class="form-control"
                                                                placeholder="Enter Transmission"  value="{{old('transmission')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Drivetrain</td>
                                                        <td><input type="text" name="drivetrain" class="form-control"
                                                                placeholder="Enter Drivetrain"  value="{{old('drivetrain')}}"></td>
                                                    </tr>



                                                    <tr>
                                                        <td>City MPG</td>
                                                        <td> <input type="text"  class="form-control"
                                                            name="mpg_city" placeholder="Enter City MPG"  value="{{old('mpg_city')}}"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Highway MPG</td>
                                                        <td><input type="text" class="form-control"
                                                            name="mpg_hwy" placeholder="Enter Highway MPG"  value="{{old('mpg_hwy')}}"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Doors</td>
                                                        <td><input type="text" class="form-control"
                                                            name="doors" placeholder="Enter Doors"  value="{{old('doors')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Engine Cylinder</td>
                                                        <td><input type="text" class="form-control"
                                                            name="engine_cylinder" placeholder="Enter "  value="{{old('engine_cylinder')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Engine Displacement</td>
                                                        <td><input type="text" class="form-control"
                                                            name="engine_displacement" placeholder="Enter Engine Cylinder"  value="{{old('engine_displacement')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Retails</td>
                                                        <td><input type="text" class="form-control"
                                                            name="retails" placeholder="Enter Retails"  value="{{old('retails')}}"></td>
                                                    </tr>




                                                </table>


                                            </div>



                                            <div class="col-md-4">
                                                <div class="heading_content">
                                                    <h3 class="text-center fw-bold line_height">Basic Information</h3>
                                                </div>

                                                <table class="table">
                                                    <tr>
                                                        <td>Book Value</td>
                                                        <td><input type="text" class="form-control"
                                                            name="book_value" placeholder="Enter Book Value"  value="{{old('book_value')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Certified</td>
                                                        <td><input type="text" class="form-control"
                                                            name="certified" placeholder="Enter Certified"  value="{{old('certified')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Options</td>
                                                        <td><input type="text" class="form-control"
                                                            name="options" placeholder="Enter Options"  value="{{old('options')}}"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Categorized Options</td>
                                                        <td><input type="text" class="form-control"
                                                            name="categorized_options" placeholder="Enter Categorized Options"  value="{{old('categorized_options')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Exterior Color Generic</td>
                                                        <td><input type="text" class="form-control"
                                                            name="ext_color_generic" placeholder="Exterior Color Generic"  value="{{old('ext_color_generic')}}"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Exterior Color Code</td>
                                                        <td><input type="text" class="form-control"
                                                            name="ext_color_code" placeholder="Exterior Color Code"  value="{{old('ext_color_code')}}"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Exterior Color hex_Code</td>
                                                        <td><input type="text" class="form-control"
                                                            name="ext_color_hex_Code" placeholder="Exterior Color hex_Code "  value="{{old('ext_color_hex_Code')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Interior Color Generic</td>
                                                        <td><input type="text" class="form-control"
                                                            name="int_color_generic" placeholder="Interior Color Generic "  value="{{old('int_color_generic')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Interior Color Code</td>
                                                        <td><input type="text" class="form-control"
                                                            name="int_color_code" placeholder="Interior Color Code "  value="{{old('int_color_code')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Interior Color hex_Code</td>
                                                        <td><input type="text" class="form-control"
                                                            name="int_color_hex_Code" placeholder="Interior Color hex_Code "  value="{{old('int_color_hex_Code')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Engine Block Type</td>
                                                        <td><input type="text" class="form-control"
                                                            name="engine_block_type" placeholder="Engine Block Type "  value="{{old('engine_block_type')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Transmission Speed</td>
                                                        <td><input type="text" class="form-control"
                                                            name="transmission_speed" placeholder="Transmission Speed "  value="{{old('transmission_speed')}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Passenger Capacity</td>
                                                        <td><input type="text" class="form-control"
                                                            name="passenger_capacity" placeholder="Passenger Capacity "  value="{{old('passenger_capacity')}}"></td>
                                                    </tr>
                                                </table>

                                                <div class="heading_content">
                                                    <h3 class="text-center fw-bold line_height">Standard Information</h3>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Mileage <span style="color: red;font-weight:bold"> *</span></label><br />
                                                    <input type="text" value="" class="form-control" name="miles"
                                                        placeholder="Enter Mileage">
                                                    <span><input type="checkbox"> Display: "Email for Mileage"</span>
                                                    @error('miles')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Stock Number  <span style="color: red;font-weight:bold">*</span></label>
                                                    <input type="text" value="" class="form-control" name="stock"
                                                        placeholder="Enter Stock Number">
                                                        @error('stock')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                {{--<div class="form-group">
                                                    <button type="button" style="border: none"> <i class="fa fa-plus"></i>
                                                        Additional Information </button>
                                                </div>--}}



                                            </div>



                                            <div class="col-md-4">

                                                <div class="heading_content">
                                                    <h3 class="text-center line_height">Price</h3>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Price  <span style="color: red;font-weight:bold">*</span></label>
                                                            <input type="text" value="" class="form-control"
                                                                name="price" placeholder="Enter Price">
                                                            <span><input type="checkbox"> Display: "Email for Price"</span>

                                                            @error('price')
                                                            <p style="color: red;">{{ $message }}</p>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                        <a href="#" class="btn btn-primary float-right mt-4"> View Competition</a>
                                    </div> --}}

                                                </div>




                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Purchase Price</label>
                                                            <input type="text" value="" class="form-control"
                                                                name="purchase_price">
                                                        </div>
                                                        {{--<p> <a href="#" style="margin-bottom:10px"> <i
                                                                    class="fa fa-plus"></i>Price Disclaimer</a></p>--}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Purchase Date</label>
                                                        <input type="date" value="" class="form-control"
                                                            name="date_in_stock">
                                                    </div>

                                                </div>

                                                {{--<button type="button" style="border: none"> <i class="fa fa-plus"></i>
                                                    Additional Pricing </button>

                                                <div class="heading_content">
                                                    <h3 class="text-center line_height"> Payment </h3>
                                                </div>

                                                <button type="button" style="border: none"> <i class="fa fa-plus"></i>
                                                    Payment Options</button>--}}


                                                <div class="heading_content">
                                                    <h3 class="text-center line_height"> Color </h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div id="container"
                                                                    style="height:16px;width:50%;
                                        background-color: rgb(233, 26, 26);">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-11">
                                                                <div class="form-group">
                                                                    <p>Exterior Color <a data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Select the color category that best matches your vehicle to make sure consumers can find it easier on localcarz.com."
                                                                            data-original-title="Edit Ad"
                                                                            href="javascript:void(0);"><i
                                                                                class="fa-solid fa-circle-exclamation"></i></a>
                                                                    </p>

                                                                    <select id="colorlist" class="form-control"
                                                                        onchange="changecolor(container,value)">
                                                                        <option value="">Select Color</option>
                                                                        <option value="red">Red</option>
                                                                        <option value="blue">Blue</option>
                                                                        <option value="green">Green</option>
                                                                        <option value="yellow">Yellow</option>
                                                                        <option value="purple ">Purple</option>
                                                                        <option value="gray">Gray</option>
                                                                        <option value="beige">Beige</option>
                                                                        <option value="indigo">Indigo</option>
                                                                        <option value="lavender">Lavender</option>
                                                                        <option value="orange">Orange</option>
                                                                        <option value="brown">Brown</option>
                                                                        <option value="cyan">Cyan</option>
                                                                        <option value="maroon">Maroon</option>
                                                                        <option value="lime">Lime</option>
                                                                        <option value="gold">Gold</option>
                                                                        <option value="olive">Olive</option>
                                                                        <option value="black">Black</option>
                                                                        <option value="pink">Pink</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Exterior Color Description</label>
                                                            <input type="text" value="" class="form-control"
                                                                name="exterior_color"
                                                                placeholder="Exterior Color Description">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div id="interior_container"
                                                                    style="height:16px;width:50%;margin-top: 50px;
                                            position: absolute;
                                            background-color: white;">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-11">
                                                                <div class="form-group">
                                                                    <p>Interior Color <a data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Select the color category that best matches your vehicle to make sure consumers can find it easier on localcarz.com."
                                                                            data-original-title="Edit Ad"
                                                                            href="javascript:void(0);"><i
                                                                                class="fa-solid fa-circle-exclamation"></i></a>
                                                                    </p>

                                                                    <select id="colorlist" name="interior_color"
                                                                        class="form-control"
                                                                        onchange="changeInteriorcolor(interior_container,value)">
                                                                        <option value="">Select Color</option>
                                                                        <option value="red">Red</option>
                                                                        <option value="blue">Blue</option>
                                                                        <option value="green">Green</option>
                                                                        <option value="yellow">Yellow</option>
                                                                        <option value="purple ">Purple</option>
                                                                        <option value="gray">Gray</option>
                                                                        <option value="beige">Beige</option>
                                                                        <option value="indigo">Indigo</option>
                                                                        <option value="lavender">Lavender</option>
                                                                        <option value="orange">Orange</option>
                                                                        <option value="brown">Brown</option>
                                                                        <option value="cyan">Cyan</option>
                                                                        <option value="maroon">Maroon</option>
                                                                        <option value="lime">Lime</option>
                                                                        <option value="gold">Gold</option>
                                                                        <option value="olive">Olive</option>
                                                                        <option value="black">Black</option>
                                                                        <option value="pink">Pink</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Interior Color Description</label>
                                                            <input type="text" value="" class="form-control"
                                                                name="interior_color"
                                                                placeholder="Interior Color Description">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Description  <span style="color: red;font-weight:bold">*</span></label>
                                                            <textarea class="form-control" name="description" id="" cols="30" rows="10"
                                                                placeholder="Description Here"></textarea>

                                                                @error('description')
                                                                <p style="color: red;">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="heading_content">
                                                    <h3 class="text-center fw-bold line_height"> Photo Section</h3>
                                                </div>

                                                <div>
                                                    <h5>File Upload <span style="color: red;font-weight:bold">*</span></h5>
                                                    <input type="file" name="images[]" multiple accept="image/" >
                                                </div>
                                                <div class="card-footer ">
                                                    <button style="padding-left:45px; padding-right:45px; font-weight:bold; margin-top:15px" type="submit" class="btn btn-primary float-right rounded">Submit</button>
                                                </div>


                                                {{--<div class="heading_content">
                                                    <h3 class="text-center mt-4 line_height">Video Test Drives</h3>
                                                </div>

                                                <p style="text-align: justify"> Deliver an on the lot experience with
                                                    videos on localcarz.com and your dealer website !.</p>
                                                <h3>Video</h3>
                                                <p>Enter the URL to your YouTube video. or other preferred video channel
                                                    below.</p>

                                                <div class="from-group">
                                                    <label for="">Video URL</label>
                                                    <input type="url" placeholder="Enter URL" class="form-control"
                                                        name="video_url">--}}
                                                </div>

                                            </div>

                                        </div>

                                </div>







                                </form>
                            </div>


                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_js')
    <!-- noUiSlider -->
    {{-- <script src="{{asset('/frontend')}}/js/nouislider.all.min.js"></script>
<!-- Carousel Slider  -->
<script src="{{asset('/frontend')}}/js/carousel.min.js"></script>
<script src="{{asset('/frontend')}}/js/slide.js"></script>
<!-- PrettyPhoto -->
<script src="{{asset('/frontend')}}/js/jquery.fancybox.min.js"></script>
<!-- MasterSlider -->
<script src="{{asset('/frontend')}}/js/masterslider/masterslider.min.js"></script> --}}


    <script>
        function changecolor(id, color) {
            id.style.backgroundColor = color;
        }

        function changeInteriorcolor(id, color) {
            id.style.backgroundColor = color;
        }r
    </script>
@endpush
