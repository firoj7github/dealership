@extends('dealer.layouts.app')



@section('content')


<div class="row">

    <div class="col-md-11 ms-3 pt-5 m-auto rounded col-sm-11 col-xs-11">
        <div class="card">
            <div class="card-header">

                <h5>All Sales Person</h5>
                <a class="btn btn-info float-right text-white" data-toggle="modal" data-target="#addModal">Add Sales Person<a>

            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>S.L</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($salers as $key=>$sale )





                           <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$sale->name}}</td>
                            <td>{{$sale->email}}</td>
                            <td>{{$sale->phone}}</td>
                            <td>{{$sale->address}}</td>
                            <td>
                                <a
                                data-toggle="modal"
                                data-target="#EditModal"
                                class="btn btn-success update_product_form"
                                data-id="{{$sale->id}}"
                                    data-name="{{$sale->name}}"
                                    data-email="{{$sale->email}}"
                                    data-address="{{$sale->address}}"
                                    data-phone="{{$sale->phone}}"

                                >Edit<a>

                                <a
                                data-id="{{$sale->id}}"
                                class="btn btn-danger delete_sales">Delete<a>
                            </td>


                           </tr>
                           @empty


                           @endforelse

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- add sales persion modal start--}}



  <!-- Modal -->
  <div id="addModal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="SaleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Sales Person</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body">
            <form id="salesForm" class="form-horizontal   mt-2 sales-form"   enctype="multipart/form-data">

                <div class="d-flex">

                    <div class="form-group">

                        <div class="col-sm-6">
                          <input type="text" class="form-control sales-input" id="name" placeholder="Enter your name">
                        </div>
                      </div>
                      <div class="form-group">

                        <div class="col-sm-6">
                          <input type="email" class="form-control sales-input" id="email" placeholder="Enter your email">
                        </div>
                      </div>

                </div>

                <div class="d-flex">
                    <div class="form-group">

                        <div class="col-md-6">
                          <input type="text" class="form-control sales-input" id="address" placeholder="Enter your address">
                        </div>
                      </div>
                      <div class="form-group">

                        <div class="col-md-6">
                          <input type="text" maxlength="12" class="form-control sales-input phone_us" id="phone" placeholder="Cell Number (xxx-xxx-xxxx)">
                        </div>
                </div>



                </div>
                <div>

                    <div class="form-group">

                        <input class="img-file" type="file" id="image">

                      </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-primary" id="sales_add" >Submit</button>
                  </div>
                </div>
              </form>
        </div>

      </div>
    </div>
  </div>


{{-- add sales persion modal close--}}


{{-- Edit sales persion modal start --}}
 <!-- Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body">

            <form id="EditForm" class="form-horizontal   mt-2 sales-form"   enctype="multipart/form-data">
                <input type="hidden" name="up_id" id="up_id">

                <div class="d-flex">

                    <div class="form-group">

                        <div class="col-sm-6">
                          <input type="text" class="form-control sales-input" id="up_name" placeholder="Enter your name">
                        </div>
                      </div>
                      <div class="form-group">

                        <div class="col-sm-6">
                          <input type="email" class="form-control sales-input" id="up_email" placeholder="Enter your email">
                        </div>
                      </div>

                </div>

                <div class="d-flex">
                    <div class="form-group">

                        <div class="col-md-6">
                          <input type="text" class="form-control sales-input" id="up_address" placeholder="Enter your address">
                        </div>
                      </div>
                      <div class="form-group">

                        <div class="col-md-6">
                            <input type="text" maxlength="12" class="form-control sales-input phone_up" id="up_phone" placeholder="Cell Number">

                        </div>
                </div>



                </div>
                <div>

                    <div class="form-group">

                        <input class="img-file" type="file" id="image">

                      </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-primary update_product"  >Update</button>
                  </div>
                </div>
              </form>

        </div>

      </div>
    </div>
  </div>

{{-- Edit sales persion modal close --}}



@endsection

@push('page_js')

<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js" type="text/javascript"></script>


<script type="text/javascript">

$(document).ready(function () {

$(".phone_us").keyup(function (e) {
    var value = $(".phone_us").val();
    if (e.key.match(/[0-9]/) == null) {
        value = value.replace(e.key, "");
        $(".phone_us").val(value);
        return;
    }

    if (value.length == 3) {
        $(".phone_us").val(value + "-")
    }
    if (value.length == 7) {
        $(".phone_us").val(value + "-")
    }
});
});
$(document).ready(function () {

$(".phone_up").keyup(function (e) {
    var value = $(".phone_up").val();
    if (e.key.match(/[0-9]/) == null) {
        value = value.replace(e.key, "");
        $(".phone_up").val(value);
        return;
    }

    if (value.length == 3) {
        $(".phone_up").val(value + "-")
    }
    if (value.length == 7) {
        $(".phone_up").val(value + "-")
    }
});
});


$(document).ready(function(){


    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });



        $('#sales_add').on('click',function(e){
         e.preventDefault();

            let name= $('#name').val();
            let email= $('#email').val();
            let address= $('#address').val();
            let phone= $('#phone').val();

            $.ajax({
            url:"{{route('sales.store')}}",
            type:'post',
            data:{name:name,email:email,address:address,phone:phone},
            success:function(res){



                if(res.status=='success'){
                    $('#salesForm')[0].reset();
                    // $('#addModal').modal('hide');
                    $('.table').load(location.href+' .table');
                    location.reload();


                }

            },
        });

            });


            // update sales person
            // update product
            $(document).on('click','.update_product_form',function(){
                let id=$(this).data('id');
                let name=$(this).data('name');
                let email= $(this).data('email');
                let address= $(this).data('address');
                let phone= $(this).data('phone');

                $('#up_id').val(id);
                $('#up_name').val(name);
                $('#up_email').val(email);
                $('#up_address').val(address);
                $('#up_phone').val(phone);

            });

            $(document).on('click', '.update_product', function(e){
               e.preventDefault();
               let up_id = $('#up_id').val();
               let up_name= $('#up_name').val();
               let up_email= $('#up_email').val();
               let up_address= $('#up_address').val();
               let up_phone= $('#up_phone').val();


             $.ajax({
                url:'{{route('sales.update')}}',
                method:'post',
                data:{up_id:up_id,up_name:up_name, up_email:up_email, up_address:up_address, up_phone:up_phone  },
                success:function(res){
                    if(res.status=='success'){
                        // $('#EditModel').modal('hide');

                        $('#EditForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        location.reload();

                    }

                }, error: function(err){

                }


             })
            });

            //   delete sales person
            $('.delete_sales').on('click', function(e){
                e.preventDefault();
                let id = $(this).data('id');

                if(confirm('are you sure to delete salse person??')){

                    $.ajax({
                    url:"{{route('sales.dalete')}}",
                    type:'post',
                    data:{id:id},
                    success:function(res){
                       if(res.status=='success'){
                        $('.table').load(location.href+' .table');
                       }
                    },
                    error:function(err){

                    }


                })

                }


            })


});
</script>

@endpush
