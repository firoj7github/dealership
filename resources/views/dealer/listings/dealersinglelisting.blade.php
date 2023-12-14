@extends('dealer.layouts.app')

@push('css')


<style>


</style>


@endpush

@section('content')
<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header">

                <h5 style="margin-left: 22px">Listing View</h5>



            <div class="card-block">





            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            @php
                            $cars = $lists->image_from_url;
                            $total_cars = explode(',',$cars);
                            @endphp
                            <div class="row">
                                @foreach ($total_cars as $car)
                                <div class="col-md-3 col-sm-6 col-xs-12 mb-2">
                                    <img alt="" src="{{ $car }}" width="100%"/>
                                </div>

                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="row ms-5">
                                <div class="col-md-3">
                                    <p>Title :</p>
                                    <p>Retail :</p>
                                    <p>Mileage :</p>
                                    <p>Make :</p>
                                    <p>Model :</p>
                                    <p>Engine :</p>
                                    <p>Drive Train :</p>
                                    <p>Body Style :</p>
                                    <p>Fuel :</p>
                                    <p>Vin :</p>
                                    <p>Trim :</p>
                                    <p>Year :</p>
                                    <p>Transmission :</p>
                                    <p>Interior Color :</p>
                                    <p>Exterior Color :</p>


                                </div>
                                <div class="col-md-9">
                                    <p style="font-weight: 600;">{{$lists->title}}</p>
                                    <p style="font-weight: 600;">{{$lists->price_formate}}</p>
                                    <p style="font-weight: 600;">{{$lists->miles_formate}} Miles</p>
                                    <p style="font-weight: 600;">{{$lists->make}}</p>
                                    <p style="font-weight: 600;">{{$lists->model}}</p>
                                    <p style="font-weight: 600;">{{$lists->engine_displacement}}</p>
                                    <p style="font-weight: 600;">{{$lists->drive_train}}</p>
                                    <p style="font-weight: 600;">{{$lists->body}}</p>
                                    <p style="font-weight: 600;">{{$lists->fuel}}</p>
                                    <p style="font-weight: 600;">{{$lists->vin}}</p>
                                    <p style="font-weight: 600;">{{$lists->trim}}</p>
                                    <p style="font-weight: 600;">{{$lists->year}}</p>
                                    <p style="font-weight: 600;">{{$lists->transmission}}</p>
                                    <p style="font-weight: 600;">{{$lists->interior_color}}</p>
                                    <p style="font-weight: 600;">{{$lists->exterior_color}}</p>

                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>





            </div>
        </div>
    </div>
</div>
@endsection


