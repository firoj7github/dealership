@extends('frontend.layouts.app')
@section('title', 'Recently Add | ')
@section('content')
<style>
    .pagination .page-item.prev .page-link,
.pagination .page-item.next .page-link {
    font-size: 14px; /* Adjust the font size as needed */
    padding: 0.3rem 0.5rem; /* Adjust padding as needed */
}

</style>
    <!-- =-=-=-=-=-=-= Breadcrumb =-=-=-=-=-=-= -->
      <div class="page-header-area-2 gray">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="small-breadcrumb">
                     <div class=" breadcrumb-link">
                        <ul>
                           <li><a href="{{Route('home')}}">Home Page</a></li>
                           <li><a class="active" href="#">Recently add</a></li>
                        </ul>
                     </div>
                     <div class="header-page">
                        <h1>Listing View  - ({{$total_inventory}})</h1>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- =-=-=-=-=-=-= Breadcrumb End =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding no-top gray">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-12 col-lg-12 col-sx-12">
                     <!-- Row -->
                     <ul class="list-unstyled">


                     @forelse($recent_inventory as $inventor)
                        <!-- Listing Grid -->
                        <li>
                           <div class="well ad-listing clearfix">
                              <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                                 <!-- Image Box -->
                                 <div class="img-box">
                                 @php
                                     $inventory_image_data =  explode(',',$inventor->image_from_url);
                                     $inventory_image_count = count($inventory_image_data);
                                     $date_formato = \Carbon\Carbon::parse($inventor->date_in_stock);
                                 @endphp
                                 @php
                                       $modifiedBodyString = str_replace(' ', '+', $inventor->body);
                                       $url_id = $inventor->year.'-'.$inventor->make.'-'.$inventor->model.'-'.$modifiedBodyString.'-'.$inventor->stock;
                                 @endphp
                                 <img src="{{$inventory_image_data[0]}}" class="img-responsive" alt="">
                                    <div class="total-images"><strong>{{$inventory_image_count}}</strong> photos </div>
                                    <div class="quick-view"> <a href="#ad-preview" data-toggle="modal" class="view-button"><i class="fa fa-search"></i></a> </div>
                                 </div>
                                 <!-- Ad Status --><span class="ad-status"> @if($inventor->is_feature == 1 ){{ 'Featured' }} @endif</span>
                                 <!-- User Preview -->
                                 {{--<div class="user-preview">
                                    <a href="#"> <img src="" class="avatar avatar-small" alt=""> </a>
                                 </div>--}}
                              </div>
                              <div class="col-md-9 col-sm-7 col-xs-12">
                                 <!-- Ad Content-->
                                 <div class="row">
                                    <div class="content-area">

                                       <div class="col-md-9 col-sm-12 col-xs-12">
                                          <!-- Ad Title -->
                                          <h3><a>{{$inventor->title}}</a></h3>
                                          <!-- Ad Meta Info -->
                                          <ul class="ad-meta-info">
                                             <li> <i class="fa fa-map-marker"></i><a href="#">{{ $inventor->dealers->dealer_city }}, {{ $inventor->dealers->dealer_state }}</a> </li>
                                             <li>{{$date_formato->diffForHumans()}}</li>
                                          </ul>
                                          <!-- Ad Description-->
                                          <div class="ad-details">
                                             <p>{{substr($inventor->description,0,250)}} ...</p>
                                             <ul class="list-unstyled">
                                                <li><i class="flaticon-gas-station-1"></i>{{ $inventor->fuel }}</li>
                                                <li><i class="flaticon-dashboard"></i><strong>{{ $inventor->miles_formate }}</strong> Miles</li>
                                                <li><i class="flaticon-engine-2"></i>{{ $inventor->engine_description_formate }}</li>
                                                <li><i class="flaticon-key"></i>{{ $inventor->transmission }}</li>
                                                <li><i class="flaticon-calendar-2"></i>Year {{ $inventor->year }}</li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-3 col-xs-12 col-sm-12">
                                          <!-- Ad Stats -->
                                          <div class="short-info">
                                             <div class="ad-stats hidden-xs"><span>Make  : </span>{{ $inventor->make }}</div>
                                             <div class="ad-stats hidden-xs"><span>Model : </span>{{ $inventor->model }}</div>
                                             <div class="ad-stats hidden-xs"><span>Body : </span>{{ $inventor->body_formated }}</div>
                                          </div>
                                          <!-- Price -->
                                          <div class="price"> <span>{{ $inventor->price_formate }}</span> </div>
                                          <!-- Ad View Button -->
                                          <a href="{{ route('auto.details',['vin' =>$inventor->vin, 'id' => $url_id]) }}"><button class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View Details</button></a>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Ad Content End -->
                              </div>
                           </div>
                        </li>

                    @empty
                    <span>There no recent  inventory </span>
                    @endforelse
                     </ul>
                     <!-- Advertizing -->
                     {{--<section class="advertising">
                        <a href="post-ad-1.html">
                           <div class="banner">
                              <div class="wrapper">
                                 <span class="title">Do you want your property to be listed here?</span>
                                 <span class="submit">Submit it now! <i class="fa fa-plus-square"></i></span>
                              </div>
                           </div>
                           <!-- /.banner-->
                        </a>
                     </section>--}}
                     <!-- Advertizing End -->
                     <!-- Ads Archive End -->
                     <div class="clearfix"></div>
                     <!-- Pagination -->
                     <div class="custom-pagination" style="display: flex;justify-content: flex-end">
                        <ul class="pagination" >
                            @if ($recent_inventory->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $recent_inventory->previousPageUrl() }}">Previous</a></li>
                            @endif

                            @foreach ($recent_inventory->getUrlRange(1, $recent_inventory->lastPage()) as $page => $url)
                                @if ($page == $recent_inventory->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            @if ($recent_inventory->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $recent_inventory->nextPageUrl() }}">Next</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Next</span></li>
                            @endif
                        </ul>
                    </div>
                     <!-- Pagination End -->
                  </div>
                  <!-- Middle Content Area  End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->

      </div>
      <!-- Main Content Area End -->
@endsection
