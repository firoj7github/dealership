@extends('layouts.app')



@section('content')

<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header">
                <div class="heading_content mb-4">
                    <h3 class="text-center fw-bold line_height">All Inventory List</h3>
                </div>
                <div class="container-fluid">
                    <div class="row">


                        @forelse ($dealer_details as $info )


                            <div class="col-md-3 mb-4">
                            <div class="card h-100 ">

                                <div class="card-header">
                                    @php
                                        $cars = $info->image_from_url;
                                        $total_cars = explode(',',$cars);
                                        $final_car =  $total_cars[0];

                                    @endphp

                                <a title="" href=""><img alt="Local Cars"
                                    src="{{$final_car}}" class="card-image" width="100%" height="220px"></a>



                                       <a title=""
                                            href=""> <h4 class="card-title mt-2 mb-2">{{$info->title }}</h4></a>

                                            <h4>{{$info->price_formate}}</h4>



                                </div>
                                <div class="card-body" style="padding: 0px;margin:0px">
                                    <table class="table" style="margin-bottom: 0px">
                                        <tr style="height: 20px">
                                            <td>Stock #</td>
                                            <td class="text-right">{{$info->stock}}</td>
                                        </tr>
                                        <tr>
                                            <td>Miles</td>
                                            <td class="text-right">{{$info->miles_formate}}</td>
                                        </tr>
                                        <tr>
                                            <td>Leads</td>
                                            <td class="text-right">0</td>
                                        </tr>
                                        <tr>
                                            <?php
                                    $dato_formate = \Carbon\Carbon::parse($info->date_in_stock);
                                    $dato_formate = $dato_formate->diffInDays(now())
                                  ?>

                                            <td>Days on Market</td>

                                            <td class="text-right"><strong style="color:rgb(15, 13, 13);padding:5px;border-radius:50px">{{$dato_formate}}</strong></td>
                                        </tr>

                                    </table>
                                    <hr/>
                                    <div class="text-center">
                                        <p class="posting">Posting Options</p>
                                    <ul class="social_block">
                                        <li class="text-center"><a href="#" title="facebook"><i class="fa-brands fa-facebook fabicon-facebook" style="color: #3772d7;"></i></a></li>
                                        <li class="text-center"><a href="#" title="youtube"> <i class="fa-brands fa-youtube fabicon-utube" style="color: #cf3726;"></i></a></li>
                                        <li class="text-center"><a href="#" title="ebay"><i class="fa-brands fa-ebay fabicon-ebay" style="color: #d1109d;"></i></a></li>


                                    </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

                        @empty

                        <h3 class="text-center">No Inventory Here....</h3>




                        @endforelse
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

<div class="custom-pagination" style="display: flex;justify-content: center; margin-bottom:30px;">
    <ul class="pagination" >
        @if ($dealer_details->onFirstPage())
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $dealer_details->previousPageUrl() }}">Previous</a></li>
        @endif

        @foreach ($dealer_details->getUrlRange(1, $dealer_details->lastPage()) as $page => $url)
            @if ($page == $dealer_details->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($dealer_details->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $dealer_details->nextPageUrl() }}">Next</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
        @endif
    </ul>
</div>

<style type="text/css">
    /* Adjust the size of previous and next pagination arrows */
    .pagination .page-item.prev .page-link,
    .pagination .page-item.next .page-link {
        font-size: 14px; /* Adjust the font size as needed */
        padding: 0.3rem 0.5rem; /* Adjust padding as needed */
    }
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
    width: 170px;
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
    width: 120px;
}
    </style>

@endsection
