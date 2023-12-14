@extends('layouts.app')
@section('content')


<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header">





                <h5 style="font-weight:600;">Listings Details</h5>


                <h6 style="margin-top: 32px;">{{$packages->title}}</h6>
                <p class="">Price : {{$packages->price_formate}}</p>
                <p style="margin-top: -10px;">Engine : {{$packages->engine_description_formate}}</p>
                <p style="margin-top: -10px;">Drive Train : {{$packages->drive_train}}</p>
                <p style="margin-top: -10px;">Exterior Color : {{$packages->exterior_color}}</p>


            </div>
            <div class="card-block">
                <p style="font-weight: 600; margin-bottom:15px;">Picture Manager</p>
                <hr/>

                @php
                                        $cars = $packages->image_from_url;
                                        $inventory_cars = explode(',',$cars);



                                    @endphp
                <div class="row">
                    @foreach ($inventory_cars as $car)

                    <div class="col-md-2 ">
                        <div class="card card-body shadow" style="padding: 0px; margin:0px;margin-bottom:10px">
                         <a href="javascript:void(0)" ><img alt="" src="{{ $car }}" width="100%"/></a>
                         <div class="card-footer">
                             <a href="{{ $car }}" class="text-dark" data-fancybox="group"><i class="fa-solid fa-magnifying-glass-plus"></i></a>
                             <a href="javascript:void(0)" class="text-danger float-right"><i class="fa fa-trash"></i></a>
                         </div>
                        </div>
                     </div>
{{--
                    <div class="col-md-2  mb-2">
                        <img alt="Local Cars"
                                    src="{{$car}}" class="card-image rounded" width="100%">
                                    <div class="card-footer">
                                        <a href="{{ $car }}" class="text-dark" data-fancybox="group"><i class="fa-solid fa-magnifying-glass-plus"></i></a>
                                        <a href="javascript:void(0)" class="text-danger float-right"><i class="fa fa-trash"></i></a>
                                    </div>
                    </div> --}}



                    @endforeach

                </div>



            </div>
        </div>
    </div>
</div>



@endsection
