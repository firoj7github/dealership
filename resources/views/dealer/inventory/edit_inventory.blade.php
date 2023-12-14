@extends('dealer.layouts.app')
@push('css')

  <!-- =-=-=-=-=-=-= noUiSlider =-=-=-=-=-=-= -->
  <link href="{{asset('/frontend')}}/css/nouislider.min.css" rel="stylesheet">
  <!-- =-=-=-=-=-=-= Owl carousel =-=-=-=-=-=-= -->
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend')}}/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend')}}/css/owl.theme.css">
  <!-- =-=-=-=-=-=-= PrettyPhoto =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="{{asset('/frontend')}}/css/jquery.fancybox.min.css" type="text/css" media="screen" />



<style>
    .line_height
    {
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
                                <h3 class="text-success">{{ session()->get('message')}}</h3>
                            @endif
                            <div class="card-header">
                               <h1>Edit : {{ $inventory->title }}</h1>
                            </div>
                            <div class="card-body">
                            <form  id="edit_from_submit" action="{{ route('update.inventory',$inventory->id)}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$inventory->dealer_id}}" name="dealer_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="heading_content">
                                        <h3 class="text-center fw-bold line_height">Information</h3>
                                    </div>

                                  <table class="table table-striped mt-4">
                                    <tr>
                                    <td>Vin</td>
                                    <td>{{ $inventory->vin}}</td>
                                    </tr>
                                    <tr>
                                        <td>Make</td>
                                        <td>{{ $inventory->make}}</td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td>{{ $inventory->model}}</td>
                                    </tr>
                                    <tr>
                                        <td>Model Year</td>
                                        <td>{{ $inventory->year}}</td>
                                    </tr>
                                    <tr>
                                        <td>Trim Package</td>
                                        <td>{{ $inventory->trim}}</td>
                                    </tr>
                                    <tr>
                                        <td>Body Style</td>
                                        <td>{{ $inventory->body}}</td>
                                    </tr>
                                    <tr>
                                        <td>Engine</td>
                                        <td>{{ $inventory->engine_displacement }} {{ $inventory->engine_block_type}} {{   $inventory->engine_cylinder}} </td>
                                    </tr>
                                    <tr>
                                        <td>Fuel Type</td>
                                        <td>{{ $inventory->fuel}}</td>
                                    </tr>
                                    <tr>
                                        <td>Transmission</td>
                                        <td>{{ $inventory->transmission_description}}</td>
                                    </tr>
                                    <tr>
                                        <td>Drivetrain</td>
                                        <td>{{ $inventory->drive_train}}</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="">City MPG</label><br/>
                                                <input type="text" value="{{ $inventory->mpg_city}}" class="form-control" name="mpg_city">
                                            </div>

                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="">Highway MPG</label><br/>
                                                <input type="text" value="{{ $inventory->mpg_hwy}}" class="form-control" name="mpg_hwy">
                                            </div>

                                        </td>
                                    </tr>

                                  </table>
                                  <div class="heading_content">
                                 <h3 class="text-center fw-bold line_height">Standard Information</h3>
                                  </div>

                                 <div class="form-group">
                                    <label for="">Mileage *</label><br/>
                                    <input type="text" value="{{ $inventory->miles}}" class="form-control" name="miles">
                                    <span ><input type="checkbox"> Display: "Email for Mileage"</span>
                                </div>
                                <div class="form-group">
                                    <label for="">Stock Number *</label>
                                    <input type="text" value="{{ $inventory->stock}}" class="form-control" name="stock">
                                </div>
                                {{--<div class="form-group">
                                    <button type="button" style="border: none"> <i class="fa fa-plus"></i> Additional Information </button>
                                </div>--}}

                               <div class="heading_content">
                                <h3 class="text-center line_height">Price</h3>
                               </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Price *</label>
                                            <input type="text" value="{{ $inventory->price}}" class="form-control" name="price">
                                            <span ><input type="checkbox"> Display: "Email for Price"</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" class="btn btn-primary float-right mt-4"> View Competition</a>
                                    </div>

                                </div>


                            <table class="table table-bordered">
                              <label for="">Price History</label>

                              @foreach ($inventory_logs as $inventory_log )
                              <tr>
                                <td>$ {{ $inventory_log->price_formate}}</td>

                                @php
                                    $timestamp = $inventory_log->edited_at;
                                    $dateTime = Carbon\Carbon::parse($timestamp);
                                    $formattedDateTime = $dateTime->format('m-d-Y h:i:s a');
                                @endphp

                                <td>{{ $formattedDateTime }}  ( {{ Carbon\Carbon::createFromTimestamp(strtotime($inventory_log->edited_at))
                                    ->diff(\Carbon\Carbon::now())->days }} days )</td>
                            </tr>

                              @endforeach

                               </table>

                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Purchase Price</label>
                                        <input type="text" value="{{ $inventory->invoice}}" class="form-control" name="purchase_price">
                                    </div>
                                   {{--<p> <a href="#" style="margin-bottom:10px"> <i class="fa fa-plus"></i>Price Disclaimer</a></p>--}}
                                </div>
                                <div class="col-md-6">
                                    <label for="">Purchase Date</label>
                                    <input type="date" value="{{ $inventory->stock_date_formated}}" class="form-control" name="purchase_date">
                                </div>

                               </div>

                               {{--<button type="button" style="border: none"> <i class="fa fa-plus"></i> Additional Pricing </button>


                               <div class="heading_content">
                                <h3 class="text-center line_height"> Payment </h3>
                               </div>

                               <button type="button" style="border: none"> <i class="fa fa-plus"></i> Payment Options</button>--}}


                               <div class="heading_content">
                               <h3 class="text-center line_height"> Color </h3>
                               </div>
                               <div class="row">
                                <div class="col-md-6">
                                   <div class="row">
                                    <div class="col-md-1">
                                        <div id="container" style="height:16px;width:50%;margin-top: 50px;
                                        position: absolute;
                                        background-color: white;"></div>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <p>Exterior Color <a data-toggle="tooltip" data-placement="top" title="Select the color category that best matches your vehicle to make sure consumers can find it easier on localcarz.com." data-original-title="Edit Ad" href="javascript:void(0);"><i class="fa-solid fa-circle-exclamation"></i></a></p>

                                            <select id="colorlist" class="form-control" onchange="changecolor(container,value)">
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
                                        <input type="text" value="{{ $inventory->exterior_color}}" class="form-control" name="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div id="interior_container" style="height:16px;width:50%;margin-top: 50px;
                                            position: absolute;
                                            background-color: white;"></div>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <p>Interior Color <a data-toggle="tooltip" data-placement="top" title="Select the color category that best matches your vehicle to make sure consumers can find it easier on localcarz.com." data-original-title="Edit Ad" href="javascript:void(0);"><i class="fa-solid fa-circle-exclamation"></i></a></p>

                                                <select id="colorlist" name="interior_color" class="form-control" onchange="changeInteriorcolor(interior_container,value)">
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
                                        <input type="text" value="{{ $inventory->interior_color}}" class="form-control" name="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ $inventory->description}}</textarea>
                                    </div>
                                </div>

                               </div>
                                </div>
                                <div class="col-md-6">
                                    <span>'{{ count($all_images) }}' Photos</span>
                                    <a href="#" class="float-right btn btn-primary">Apply Photo Overlay</a>
                                        <img src="{{ $inventory->image}}" alt="" width="100%" class="mt-4" >
                                   <div class="row mt-4 mb-2">
                                    {{-- <div id="single-slider" class="flexslider">
                                        <ul class="slides">


                                            @foreach($all_images as $image)
                                            <div class="row">
                                            <div class="col-md-3 ">
                                            <li><a href="{{ $image }}" data-fancybox="group"><img alt="" src="{{ $image }}" width="100%"/></a></li>
                                            </div>
                                        </div>
                                            @endforeach

                                        </ul>
                                    </div> --}}
                                    @foreach ($all_images as $image)
                                    <div class="col-md-3 ">
                                       <div class="card card-body shadow" style="padding: 0px; margin:0px;margin-bottom:10px">
                                        <a href="javascript:void(0)" ><img alt="" src="{{ $image }}" width="100%"/></a>
                                        <div class="card-footer">
                                            <a href="{{ $image }}" class="text-dark" data-fancybox="group"><i class="fa-solid fa-magnifying-glass-plus"></i></a>
                                            <a href="javascript:void(0)" class="text-danger float-right"><i class="fa fa-trash"></i></a>
                                        </div>
                                       </div>
                                    </div>
                                    @endforeach

                                   </div>
                                   {{--<div class="heading_content">
                                    <h3 class="text-center mt-4 line_height">Video Test Drives</h3>
                                   </div>

                                   <p style="text-align: justify"> Deliver an on the lot experience with videos on localcarz.com and your dealer website !.</p>
                                   <h3>Video</h3>
                                   <p>Enter the URL to your YouTube video. or other preferred video channel below.</p>

                                   <div class="from-group">
                                    <label for="">Video URL</label>
                                    <input type="url" placeholder="Enter URL" class="form-control" name="purcchase_date">
                                   </div>--}}




                                </div>
                            </div>
                        </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Save changes</button>
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
<script src="{{asset('/frontend')}}/js/nouislider.all.min.js"></script>
<!-- Carousel Slider  -->
<script src="{{asset('/frontend')}}/js/carousel.min.js"></script>
<script src="{{asset('/frontend')}}/js/slide.js"></script>
<!-- PrettyPhoto -->
<script src="{{asset('/frontend')}}/js/jquery.fancybox.min.js"></script>
<!-- MasterSlider -->
<script src="{{asset('/frontend')}}/js/masterslider/masterslider.min.js"></script>


<script>
    function changecolor(id,color){
    id.style.backgroundColor=color;
    }

    function changeInteriorcolor(id,color){
    id.style.backgroundColor=color;
    }
 </script>
@endpush
