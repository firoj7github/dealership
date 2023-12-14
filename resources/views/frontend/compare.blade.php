

@extends('frontend.layouts.app')

@section('content')

<div class="page-header-area-2 gray">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="small-breadcrumb">
                <div class="breadcrumb-link">
                   <ul>
                      <li><a href="/">Home Page</a></li>
                      <li><a class="active" href="#">Compare</a></li>
                   </ul>
                </div>

             </div>
          </div>
       </div>
    </div>
 </div>






 <div class="main-content-area clearfix">
    <!-- =-=-=-=-=-=-= Car Comparison =-=-=-=-=-=-= -->
    <section class="section-padding no-top compare-detial gray ">
       <!-- Main Container -->
       <div class="container">
          <!-- Row -->
          <div class="row">
             <!-- Middle Content Area -->
             <div class="col-md-12 col-xs-12 col-sm-12">

                <ul class="accordion row">
                   <li>
                      <h3 class="accordion-title"><a href="#">Comparision Table </a></h3>
                      <div class="accordion-content">
                         <table class="table table-bordered table-striped compare_table">
                            <tbody>



                                <tr>
                                  <td class="compare_side">
                                     Image
                                  </td>

                                        @foreach ($items as $item)
                                        @php
                                            $image = explode(',',$item->lists->image_from_url);
                                        @endphp
                                        <td>
                                            <img class="compare_responsive_image"
                                            src="{{ $image[0]}}">

                                        </td>
                                        @endforeach

                               </tr>
                                <tr>
                                  <td class="compare_side">
                                     Title
                                  </td>

                                        @foreach ($items as $item)
                                        <td >
                                            <span class="compare_title">{{$item->lists->title}}</span>


                                        </td>
                                        @endforeach

                               </tr>
                                <tr>
                                  <td>
                                     Price
                                  </td>

                                        @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->price_formate}}
                                        </td>
                                        @endforeach

                               </tr>
                                <tr>
                                  <td>
                                    Mileage
                                  </td>

                                        @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->miles_formate}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                <td>
                                  Year
                                </td>
                                @foreach ($items as $item)
                                      <td>
                                      {{$item->lists->year}}
                                      </td>
                                      @endforeach

                             </tr>
                               <tr>
                                <td>
                                 Make
                                </td>
                                @foreach ($items as $item)
                                <td>
                                {{$item->lists->make}}
                                </td>
                                @endforeach

                             </tr>
                               <tr>
                                <td>
                                 Model
                                </td>
                                @foreach ($items as $item)
                                <td>
                                {{$item->lists->model}}
                                </td>
                                @endforeach

                             </tr>
                               <tr>
                                <td>
                                 Trim
                                </td>
                                @foreach ($items as $item)
                                <td>
                                {{$item->lists->trim}}
                                </td>
                                @endforeach

                             </tr>

                             <tr>
                                <td>
                                  Body Style
                                </td>
                                @foreach ($items as $item)
                                      <td>
                                      {{$item->lists->body}}
                                      </td>
                                      @endforeach

                             </tr>
                               <tr>
                                  <td>
                                     Engine Type
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->engine_description_formate}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                     Transmission
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->transmission}}
                                        </td>
                                        @endforeach

                               </tr>




                               <tr>
                                  <td>
                                    Fuel Type
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->fuel}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                    Drive Train
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->drive_train}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                    Doors
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->doors}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                    Stock
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->stock}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                    Vin
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                            <p class="compare_vin">  {{$item->lists->vin}}</p>

                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                    Exterior Color
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->ext_color_generic}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                    Interior Color
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->int_color_generic}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                    MPG City
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->mpg_city}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                    MPG Hwy
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->mpg_hwy}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                    Retail
                                  </td>
                                  @foreach ($items as $item)
                                        <td>$
                                        {{$item->lists->retails}}
                                        </td>
                                        @endforeach

                               </tr>
                               <tr>
                                  <td>
                                    Condition
                                  </td>
                                  @foreach ($items as $item)
                                        <td>
                                        {{$item->lists->condition}}
                                        </td>
                                        @endforeach

                               </tr>


                            </tbody>
                         </table>
                      </div>
                   </li>



                </ul>
             </div>
          </div>
          <!-- Row End -->
       </div>
       <!-- Main Container End -->
    </section>
    <!-- =-=-=-=-=-=-= Comparison End =-=-=-=-=-=-= -->

    <!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
 </div>




@endsection
