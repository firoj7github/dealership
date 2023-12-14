@extends('dealer.layouts.app')

@section('content')
{{-- <link rel="stylesheet" href="{{ asset('css/custom-pagination.css') }}"> --}}
<div class="page-content-tab">

    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Localcarz</a>
                            </li><!--end nav-item-->
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Inventory Import</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row justify-content-center">
            <div class="col">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 fw-semibold">Bulk Import</p>
                                <form action="{{ route('car.import.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                {{--<h4 class="my-1">77</h4>
                                <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-checkbox-marked-circle-outline me-1"></i></span>26 Project Complete</p>--}}
                                    <div class="card">
                                          <div class="card-body">
                                                <div class="d-block d-flex">
                                                    <input type="file" name="import_file" class="form-control">
                                                    <button class='btn btn-success'>{{ __('Import') }}</button>
                                                </div>

                                          </div>

                                          <a href="{{ asset('dashboard/demo_import/mat.xlsx') }} " class="btn btn-info" download>Demo Download</a>
                                    </div>
                                </form>
                            </div>

                            {{--<div class="col-auto align-self-center">
                                <div class="bg-light-alt d-flex justify-content-center align-items-center thumb-md  rounded-circle">
                                    <i data-feather="layers" class="align-self-center text-muted icon-sm"></i>
                                </div>
                            </div>--}}
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->

        </div><!--end row-->

        <div class="container">
       <div class="row">


            @forelse($cars as $car)
            @php
                $data = explode(',' , $car->image );
                $imageInfo = @getimagesize($car->image);

            @endphp


<div class="col">
            <div class="card" style="width: 18rem;">
              <img src="{{ $data[0] }}" class="card-img-top" alt="...">
              <div class="card-body">

                <h4 class="card-title">{{ $car->title }}</h4>

                <p><strong class="text-danger" style="font-size:20px">$ {{ $car->price }}</strong></p>
                @php
                    $desc = substr($car->description,0,40);

                @endphp
                <p>{{ $desc }}</p>
                <a href="">View comprehensive</a>
                <p class="card-text">
                   </p>
                {{-- <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a href="#" class="btn btn-primary"><i class="fa fa-trash"></i></a> --}}
              </div>
            </div>

        </div>
            @empty
                        <div class="card text-center" style="width: 100%;">
                            <strong>Heres no data please insert!</strong>
                        </div>

            @endforelse


        </div>
        </div>


        <div class="custom-pagination" style="display: flex;justify-content: flex-end">
            <ul class="pagination" >
                @if ($cars->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $cars->previousPageUrl() }}">Previous</a></li>
                @endif

                @foreach ($cars->getUrlRange(1, $cars->lastPage()) as $page => $url)
                    @if ($page == $cars->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                @if ($cars->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $cars->nextPageUrl() }}">Next</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </div>
    </div><!-- container -->


     <!--end Rightbar-->

    <!--Start Footer-->
    <!-- Footer Start -->
    {{-- <footer class="footer text-center text-sm-start">
        &copy; <script>
            document.write(new Date().getFullYear())
        </script> Metrica <span class="text-muted d-none d-sm-inline-block float-end">Crafted with <i
                class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
    </footer> --}}
    <!-- end Footer -->
    <!--end footer-->
</div>

{{--<div class="card">
  <div class="card-body">
    This is some text within a card body.
  </div>
</div>--}}

<style type="text/css">
/* Adjust the size of previous and next pagination arrows */
.pagination .page-item.prev .page-link,
.pagination .page-item.next .page-link {
    font-size: 14px; /* Adjust the font size as needed */
    padding: 0.3rem 0.5rem; /* Adjust padding as needed */
}
</style>
@endsection
