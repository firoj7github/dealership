@extends('frontend.layouts.app')
@section('title', 'News Details | ')
@section('content')


<div class="page-header-area-2 gray">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="small-breadcrumb">
                <div class=" breadcrumb-link">
                   <ul>
                      <li><a href="index.html">Home Page</a></li>
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
    <section class="section-padding no-top gray ">
       <!-- Main Container -->
       <div class="container">
          <!-- Row -->
          <div class="row">
             <!-- Middle Content Area -->
             <div class="col-md-8 col-xs-12 col-sm-12">
                <div class="blog-detial">
                   <!-- Blog Archive -->
                   <div class="clearfix"></div>
                   <div class="blog-post">


                    <div class="clearfix"></div>
                      <div class="post-img">
                         <a href="images/blog/2.jpg" data-fancybox="group" > <img class="img-responsive large-img" alt=""  src="{{asset('/frontend')}}/images/news/{{$single->image}}"> </a>
                      </div>
                      {{-- <div class="post-info"> <a href="">Aug 30, 2017</a> <a href="#">23 comments</a> </div> --}}
                      <h3 style="width:500px;" class="post-title"> <a href="#"> {{$single->title}} </a> </h3>
                      <div class="post-excerpt">
                         <p>
                            {!! $single->description !!}
                         </p>

                         <div class="clearfix"></div>
                         <div class="blog-section">
                            <div class="blog-heading">
                               <h2>Comments (0)</h2>
                               <hr>
                            </div>
                            <ol class="comment-list">
                               <!-- comment-list    -->
                               <li class="comment">
                                  {{-- <div class="comment-info">
                                     <img class="pull-left hidden-xs img-circle" src="images/blog/c1.png" alt="author">
                                     <div class="author-desc">
                                        <div class="author-title">
                                           <strong>Curt Alex</strong>
                                           <ul class="list-inline pull-right">
                                              <li><a href="#">22 Feb 2017</a>
                                              </li>
                                              <li><a href="#"><i class="fa fa-reply"></i> Reply</a>
                                              </li>
                                           </ul>
                                        </div>
                                        <p>You wanna be where everyboody knows Your name. And a we knooow Flipper lives in a world full of wonder flying there-under under the sea creepy and kooky</p>
                                     </div>
                                  </div> --}}
                                  <ol class="children">
                                     <li class="comment">
                                        {{-- <div class="comment-info">
                                           <img class="pull-left hidden-xs img-circle" src="images/blog/c2.png" alt="author">
                                           <div class="author-desc">
                                              <div class="author-title">
                                                 <strong>Emilly Copper</strong>
                                                 <ul class="list-inline pull-right">
                                                    <li><a href="#">22 Feb 2017</a>
                                                    </li>
                                                    <li><a href="#"><i class="fa fa-reply"></i> Reply</a>
                                                    </li>
                                                 </ul>
                                              </div>
                                              <p>The first mate and his Skipper too this is will do their very best to make the most others comfortable in their tropic lives in a world of wonder.</p>
                                           </div>
                                        </div> --}}
                                        <!-- .comment-info -->
                                     </li>
                                     <li style="margin-left:-65px">No comment here</li>
                                  </ol>
                                  <!-- .children -->
                               </li>
                               <!-- comment -->

                               <!-- .comment -->
                            </ol>
                         </div>
                         <div class="clearfix"></div>
                         <div class="blog-section">
                            <div class="blog-heading">
                               <h2>leave your comment </h2>
                               <hr>
                            </div>
                            <div class="commentform">
                               <form>
                                  <div class="row">
                                     <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                           <label>Name <span class="required">*</span>
                                           </label>
                                           <input type="text" class="form-control" placeholder="">
                                        </div>
                                     </div>
                                     <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                           <label>Email <span class="required">*</span>
                                           </label>
                                           <input type="email" class="form-control" placeholder="">
                                        </div>
                                     </div>
                                     <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                           <label>Comment <span class="required">*</span>
                                           </label>
                                           <textarea class="form-control" placeholder="" rows="8" cols="6"></textarea>
                                        </div>
                                     </div>
                                     <div class="col-md-12 col-sm-12 margin-top-20 clearfix">
                                        <button type="submit"  class="btn btn-theme">Post Your Comment</button>
                                     </div>
                                  </div>

                               </form>

                            </div>

                      </div>

                    </div>
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
                      <div class="widget-content recent-ads">
                         <!-- Ads -->
                         <div class="recent-ads-list">
                            @foreach ($news as $new)
                            @php
                                $title = substr($new->title,0,40)
                            @endphp


                            <div class="recent-ads-container">
                               <div class="recent-ads-list-image">
                                  <a href="#" class="recent-ads-list-image-inner">
                                  <img src="{{asset('/frontend')}}/images/news/{{$new->image}}" alt="">
                                  </a><!-- /.recent-ads-list-image-inner -->
                               </div>
                               <!-- /.recent-ads-list-image -->
                               <div class="recent-ads-list-content">
                                  <h3 class="recent-ads-list-title">
                                     <a href="#">{{$title}}...</a>
                                  </h3>

                                  <!-- /.recent-ads-list-price -->
                               </div>
                               <!-- /.recent-ads-list-content -->
                            </div>
                            <!-- /.recent-ads-container -->
                            @endforeach
                         </div>
                         <!-- Ads -->

                      </div>
                   </div>


                   <!-- Gallery -->
                   <div class="widget">
                      <div class="widget-heading">
                         <h4 class="panel-title"><a>Gallery</a></h4>
                      </div>
                      <div class="widget-content gallery">
                         <div class="gallery-image">
                            <a href="#"><img alt="" src="images/blog/small-5.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-6.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-7.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-8.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-9.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-10.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-1.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-2.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-3.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-4.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-11.png">
                            </a>
                            <a href="#"><img alt="" src="images/blog/small-12.png">
                            </a>
                         </div>
                      </div>
                   </div>
                   <!-- Tags -->
                   <div class="widget">
                      <div class="widget-heading">
                         <h4 class="panel-title"><a>Tags cloud</a></h4>
                      </div>
                      <div class="widget-content">
                         <div class="tagcloud">

                            <a href="#.">Body</a>
                            <a href="#.">Make</a>
                            <a href="#.">Model</a>


                         </div>
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
    </section>
    <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->

 </div>


@endsection
