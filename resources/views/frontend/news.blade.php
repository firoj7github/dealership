@extends('frontend.layouts.app')
@section('title', 'News | ')
@section('content')


<div class="page-header-area-2 gray">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="small-breadcrumb">
                <div class=" breadcrumb-link">
                   <ul>
                      <li><a href="/">Home</a></li>
                      <li><a class="active" href="#">Blog</a></li>
                   </ul>
                </div>
                <div class="header-page">
                   <h1>Latest News & Trends</h1>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>




 <div class="main-content-area clearfix">
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding no-top error-page pattern-bgs gray ">
       <!-- Main Container -->
       <div class="container">
          <!-- Row -->
          <div class="row">
             <!-- Middle Content Area -->
             <div class="col-md-8 col-xs-12 col-sm-12 ">
                <div class="row">
                   <!-- Blog Archive -->
                   <div class="posts-masonry">
                      <!-- Blog Post-->
                      @foreach ($news as $new)
                      <div class="col-md-6 col-sm-6 col-xs-12">



                         <div class="blog-post">
                            @php
                            $news_data = strip_tags($new->description);
                            $description_item = substr($news_data,0,180);

                            $title =substr($new->title,0,50);
                            $date_str = strtotime($new->created_at);
                            $date = date('M',$date_str).' '.date('d',$date_str).', '.date('Y',$date_str);
                            @endphp
                            <div>
                               <a href="{{ route('news.details', $new->id) }}"> <img width="370px !important" height="220px !important"  alt="" src="{{asset('/frontend')}}/images/news/{{$new->image}}"> </a>

                               <div class="user-preview">

                               </div>
                            </div>


                            <h3 class="post-title bg-success"> <a href="#"> {{$title}}.. </a> </h3>

                            <h6 class="post-excerpt">{!! $description_item !!}... </h6>

                            <a href="{{ route('news.details', $new->id) }}" class="btn  float-right">Read More</a>


                         </div>

                      </div>
                      @endforeach



                      </div>
                      <!-- Blog Grid -->


                </div>
             </div>
             <!-- Right Sidebar -->
             <div class="col-md-4 col-xs-12 col-sm-12">
                <!-- Sidebar Widgets -->
                <div class="blog-sidebar">

                   <!-- Latest News -->
                   <div class="widget">
                      <div class="widget-heading">
                         <h4 class="panel-title"><a>Latest News</a></h4>
                      </div>
                      <div class="recent-ads">
                        @foreach($news as $new)
                         <!-- Ads -->
                         <div class="recent-ads-list">
                            <div class="recent-ads-container">
                               <div class="recent-ads-list-image">
                                  <a href="#" class="recent-ads-list-image-inner">
                                  <img src="{{asset('/frontend')}}/images/news/{{$new->image}}" alt="">
                                  </a><!-- /.recent-ads-list-image-inner -->
                               </div>
                               <!-- /.recent-ads-list-image -->
                               <div class="recent-ads-list-content">
                                  <h5 class="recent-ads-list-title">
                                     <a href="#">{{$new->title}}</a>
                                  </h5>

                                  <!-- /.recent-ads-list-price -->
                               </div>
                               <!-- /.recent-ads-list-content -->
                            </div>
                            <!-- /.recent-ads-container -->
                         </div>



                         <!-- Ads -->
                         @endforeach

                      </div>
                   </div>

                   <!-- Gallery -->
                   <div class="widget">
                      <div class="widget-heading">
                         <h4 class="panel-title"><a>Gallery</a></h4>
                      </div>
                      <div class="gallery">
                         <div class="gallery-image">
                            @foreach($news as $new)
                            <a href="#"><img alt="" src="{{asset('/frontend')}}/images/news/{{$new->image}}">
                            </a>
                            @endforeach

                         </div>
                      </div>
                   </div>

                <!-- Sidebar Widgets End -->
             </div>
             <!-- Middle Content Area  End -->
          </div>
          <!-- Row End -->
       </div>
       <!-- Main Container End -->

       {{-- !-- Pagination --> --}}
    <div class="text-center margin-top-30">
        <ul class="pagination ">


        {{-- Previous Page Link --}}
        @if ($news->onFirstPage())
            <li class="disabled"><span><i class="fa fa-chevron-left"></i></span></li>
            @else
            <li><a href="{{ $news->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a></li>
        @endif

        {{-- Pagination Links --}}
        @foreach ($news->getUrlRange(max($news->currentPage() - 2, 1),
            min($news->currentPage() + 2, $news->lastPage())) as $page => $url)
            @if ($page == $news->currentPage())
            <li class="active"><a>{{ $page }}</a></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif

        @if ($page < $news->lastPage() - 1 && $page == $news->currentPage() + 1)
            <li class="disabled"><span>...</span></li>
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($news->hasMorePages())
                <li><a href="{{ $news->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a></li>
            @else
            <li class="disabled"><span><i class="fa fa-chevron-right"></i></span></li>
            @endif
            </ul>
    </div>

    <!-- Pagination End -->
    </section>
    <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
    <!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->

    <!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
 </div>


@endsection
