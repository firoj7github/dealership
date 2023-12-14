@extends('dealer.layouts.app')

@section('title', 'Message List | ')

@section('content')
<div class="row">

    <div class="col-md-11 pt-5 m-auto rounded">
        <div class="card">
            <div class="card-header">

                <h5>Dealer Banner</h5>


                <a data-bs-toggle="modal" data-bs-target="#bannerCreate" class="btn btn-info float-right text-white">
                    <i class="fa-solid fa-plus"></i>Add Banner
                </a>




            </div>
            <div class="card-block">

                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table banner_table table-striped table-bordered nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width:5%">S.L</th>
                                <th style="width:20%">Banner Image</th>
                                <th style="width:15%">Banner Name</th>
                                <th style="width:15%">Position</th>
                                <th style="width:10%">Start Date</th>
                                <th style="width:10%">End Date</th>
                                <th style="width:10%">Payment</th>
                                <th style="width:10%">Status</th>



                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @foreach ($banners as $key=>$banner)








                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <img src="{{asset('/dashboard')}}/images/banners/{{$banner->image}}" width="25%" alt="Banner Image">
                                    </td>

                                    <td>{{$banner->name}}</td>
                                    <td>{{$banner->position}}</td>
                                    @if (!empty($banner->start_date))
                                    <td>{{$banner->start_date}}</td>
                                    @else
                                    <td>null</td>
                                    @endif

                                    @if (!empty($banner->end_date))
                                    <td>{{$banner->end_date}}</td>
                                    @else
                                    <td>null</td>
                                    @endif

                                    <td><select class=" banner_payment form-control {{$banner->payment==1 ?'bg-success':''}}"
                                        data-id="{{$banner->id}}"
                                        >
                                        <option value="1" {{$banner->payment==1 ?'selected':''}}>Success</option>
                                        <option value="0" {{$banner->payment==0 ?'selected':''}}>Pending</option>
                                        </select></td>

                                        <td><select class="banner_active form-control

                                            {{$banner->status==1?'bg-success':''}}"
                                            data-id="{{$banner->id}}"
                                            >
                                            <option value="1" {{$banner->status==1 ?'selected':''}}>Active</option>
                                            <option value="0" {{$banner->status==0 ?'selected':''}}>Inactive</option>
                                            </select></td>





                                    <td>

                                        <a data-bs-toggle="modal" data-bs-target="#BannerEdit"
                                        data-id="{{ $banner->id }}"
                                        data-name="{{ $banner->name }}"
                                        data-banner_price="{{ $banner->banner_price }}"
                                        data-status="{{ $banner->status }}"
                                        data-renew="{{ $banner->renew }}"
                                        data-position="{{ $banner->position }}"


                                        class="btn btn-success update_banner_form" >Edit
                                        </a>


                                        <a class="btn btn-danger delete_banner"
                                         data-id="{{$banner->id}}"
                                        >Delete</a>
                                    </td>


                                </tr>

                                @endforeach --}}


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
