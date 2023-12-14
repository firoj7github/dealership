@extends('frontend.layouts.app')
@section('title', 'Favorites | ')
@section('content')


<div class="container">


    <div class="row">

        <div class="col-md-12 col-lg-12 offset-md-4">
            <!-- Row -->
            <ul class="list-unstyled">

                <!-- Listing Grid -->
                @forelse($favorites as $favorite)
                <li>
                    <div class="well ad-listing clearfix">
                        <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                            <!-- Image Box -->
                            <div class="img-box">
                                @php
                                  $images = explode(',',$favorite->inventory->image_from_url);
                                @endphp
                                <img src="{{ $images[0] }}" class="img-responsive" alt="Local Cars">
                                <div class="total-images"><strong>{{count($images)}}</strong> photos </div>
                                <div class="quick-view"> <a href="#ad-preview" data-toggle="modal" class="view-button"><i
                                            class="fa fa-search"></i></a> </div>
                            </div>
                            <!-- Ad Status -->
                            {{--<span class="ad-status"> Featured </span>
                            <!-- User Preview -->
                            <div class="user-preview">
                                <a href="#"> <img src="{{asset('frontend')}}/images/users/2.jpg}}"
                                        class="avatar avatar-small" alt=""> </a>
                            </div>--}}
                        </div>
                        <div class="col-md-9 col-sm-7 col-xs-12">
                            <!-- Ad Content-->
                            <div class="row">
                                <div class="content-area">


                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <!-- Ad Title -->
                                        <h3><a>{{ $favorite->inventory->year.' '.$favorite->inventory->make.' '.$favorite->inventory->model.' '.$favorite->inventory->trim }}</a>
                                        </h3>
                                        <!-- Ad Meta Info -->
                                        <ul class="ad-meta-info">
                                            <li> <i class="fa fa-map-marker"></i><a href="#">{{ $favorite->inventory->dealers->dealer_city }},
                                                    {{ $favorite->inventory->dealers->dealer_state }}</a> </li>
                                            @php
                                            $dato_formate = \Carbon\Carbon::parse($favorite->inventory->date_in_stock);
                                            @endphp
                                            <li>{{ $dato_formate->diffForHumans() }} </li>
                                        </ul>
                                        <!-- Ad Description-->
                                        <div class="ad-details">
                                            @php
                                            $desc = substr($favorite->inventory->description ,0,180)
                                            @endphp
                                            <p>{{$desc}} ... </p>
                                            <ul class="list-unstyled">
                                                <li><i class="flaticon-gas-station-1" title="Fuel"></i>{{ $favorite->inventory->fuel }}
                                                </li>
                                                <li><i class="flaticon-dashboard" title="Mileage"></i><b>{{ $favorite->inventory->miles_formate }}</b>
                                                    miles</li>
                                                <li><i class="flaticon-engine-2" title="Engine"></i>{{ $favorite->inventory->engine_description_formate }}</li>
                                                <li><i class="flaticon-key" title="Condition"></i>{{ $favorite->inventory->condition }}
                                                </li>
                                                <li><i class="flaticon-calendar-2" title="Year"></i> {{ $favorite->inventory->year }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12 col-sm-12">
                                        <!-- Ad Stats -->
                                        <div class="short-info">
                                            <div class="ad-stats hidden-xs"><span>Transmission :
                                                </span>{{ $favorite->inventory->transmission }}</div>
                                            <div class="ad-stats hidden-xs"><span>Model : </span>{{ $favorite->inventory->model }}
                                            </div>
                                            <div class="ad-stats hidden-xs"><span>Make : </span>{{ $favorite->inventory->make }}</div>
                                        </div>
                                        <!-- Price -->
                                        <div class="price"> <span>{{ $favorite->inventory->price_formate }}</span> </div>
                                        <!-- Ad View Button -->
                                        <button class="btn btn-block btn-default">
                                            @php
                                            $countWishList = 0;
                                            @endphp

                                            @php
                                            $userIP = $_SERVER['REMOTE_ADDR'];
                                            $countWishList = App\Models\Favourite::countWishList($favorite->inventory->id,$userIP);
                                            @endphp

                                            <a href="javascript:void(0);" class="update_wishlist"
                                                data-productid="{{ $favorite->inventory->id }}">
                                                <i class="fa fa-times" aria-hidden="true" id="wishlist-icon"></i> UnFavorite
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Ad Content End -->
                        </div>
                    </div>
                </li>
                @empty
                <h3 style="margin-top:80px; margin-bottom:150px; text-align:center">No Favourite  Listing Here.</h3>
                @endforelse

    <div class="clearfix"></div>
    <!-- Pagination -->
    <div class="custom-pagination" style="display: flex;justify-content: flex-end">
        <ul class="pagination" >
            @if ($favorites->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $favorites->previousPageUrl() }}">Previous</a></li>
            @endif

            @foreach ($favorites->getUrlRange(1, $favorites->lastPage()) as $page => $url)
                @if ($page == $favorites->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            @if ($favorites->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $favorites->nextPageUrl() }}">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
        </ul>
    </div>
    <!-- Pagination End -->
    </div>
    <!-- Middle Content Area  End -->
    </div>

    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //update wislist start
        $('.update_wishlist').click(function() {
            var inventory_id = $(this).data('productid');
            // var my_id = "{{ Auth::id() }}";
            var url = "{{ route('update.wishlist') }}";


            $.ajax({
                url: url,
                type: 'post',
                data: {
                    inventory_id: inventory_id,
                },

                success: function(response) {
                    var icon = $('#wishlist-icon');

                    if (response.action === 'remove') {
                        location.reload();
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    // Handle error here
                }


            });

        });
        //update wislist end
    });
    </script>
@endpush
