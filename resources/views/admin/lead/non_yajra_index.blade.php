@extends('layouts.app')

@push('css')

@endpush

@section('content')
    <div class="page-content-tab">

        <div class="container-fluid" id="contentToConvert">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                        </div>

                        <div class="card-body">
                            @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table  table-bordered nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="font-size:14px;">#Stock</th>
                                            <th style="font-size:14px;">Title</th>
                                            <th style="font-size:14px;">Dealer</th>
                                            <th style="font-size:14px;">Package</th>
                                            <th style="font-size:14px;">Listing Type</th>
                                            <th style="font-size:14px;">Category</th>
                                            <th style="font-size:14px;">Customer Name</th>
                                            <th style="font-size:14px;">Customer Phone</th>
                                            <th style="font-size:14px;">
                                                Customer Email
                                            </th>
                                            <th style="font-size:14px;">
                                                Status
                                            </th>
                                            <th style="font-size:14px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($leads as $lead )
                                            <tr class=" {{ ($lead->status == 1)? 'bg-warning' : ''}}">
                                                <td>{{$lead->tmp_inventories_car->stock}}</td>
                                                <td>{{$lead->tmp_inventories_car->title}}</td>
                                                <td>{{$lead->tmp_inventories_car->user->username}}</td>
                                                <td>
                                                    @php
                                                    $package = '';
                                                        if ($lead->tmp_inventories_car->user->package == 0 || $lead->tmp_inventories_car->user->package == 1) {
                                                            if ($lead->tmp_inventories_car->user->role == 2) {
                                                                $package = 'Copper';
                                                            }elseif ($lead->tmp_inventories_car->user->role == 0) {
                                                                $package = 'Standard';
                                                            }
                                                        }
                                                        elseif ($lead->tmp_inventories_car->user->package == 2) {
                                                            $package = 'Silver';
                                                        }
                                                        elseif ($lead->tmp_inventories_car->user->package == 3) {
                                                            $package = 'Gold';
                                                        }
                                                        elseif ($lead->tmp_inventories_car->user->package == 4) {
                                                            $package = 'Plutinum';
                                                        }
                                                        elseif ($lead->tmp_inventories_car->user->package == 5) {
                                                            $package = 'Blocked';
                                                        }else {
                                                            $package = '';
                                                        }
                                                    @endphp
                                                    {{$package}}
                                                </td>
                                                <td>
                                                    {{ ($lead->tmp_inventories_car->is_feature == 1)? 'Featured' : 'Free'}}
                                                </td>
                                                <td>{{$lead->tmp_inventories_car->category}}</td>
                                                <td>{{$lead->customer->full_name}}</td>
                                                <td>{{$lead->customer->phone}}</td>
                                                <td>{{$lead->customer->email}}</td>
                                                <td>
                                                    <select class="form-control">
                                                        <option {{ ($lead->stage == 0)? 'selected' : ''}}>Pending</option>
                                                        <option {{ ($lead->stage == 1)? 'selected' : ''}}>Working</option>
                                                        <option {{ ($lead->stage == 2)? 'selected' : ''}}>Completed</option>
                                                        <option {{ ($lead->stage == 3)? 'selected' : ''}}>Blocked</option>
                                                    </select>

                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.view.lead',$lead->id)}}" class="btn btn-sm btn-success" title="view"><i class="fa fa-eye"></i></a>
                                                    <a href="#" class="btn btn-sm btn-info contact_dealer" title="contact dealer" data-id="{{$lead->id}}" data-name="{{$lead->tmp_inventories_car->user->username}}" data-email="{{$lead->tmp_inventories_car->user->email}}" data-phone="{{$lead->tmp_inventories_car->user->phone}}"><i class="fa-regular fa-address-card"></i></a>
                                                    <a href="#" class="btn btn-sm btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="11"><p class="text-center">No Lead Available </p></td>
                                        </tr>
                                        @endforelse

                                    </tbody>

                                </table>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- contact dealer modal --}}

  <!-- Modal -->
  <div class="modal fade" id="Contact_dealer_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Contact : <span class="dealer_name"></span></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.lead-contact.dealer')}}" method="POST" id="leadSendForm">
            @csrf
        <div class="modal-body">
            <h5>Cell : <span class="dealer_phone"></span></h5>
            <h5>OR</h5>
            <h5>E-mail : <span class="dealer_email"></span></h5>
            <p>Message</p>
            <textarea name="message" class="form-control message"></textarea>
            <input type="hidden" class="lead_id_form" name="lead_id">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary sendlead">Send</button>
        </div>
    </form>
      </div>
    </div>
  </div>
@endsection
@push('delear_JS')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function(){
            $('.contact_dealer').on('click',function(){

                var lead_id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                $('.dealer_name').text(name);
                $('.dealer_phone').text(phone);
                $('.dealer_email').text(email);
                $('.lead_id_form').val(lead_id);
                $('#Contact_dealer_modal').modal('show');
                console.log(email);

            });

            $('.sendlead').on('click',function(){

                var message = $('.message').val();
                if(message == '')
                {
                    toastr.warning('message field is reqired');
                    return;
                }
                $('#leadSendForm').submit();
            })

        });

</script>
@endpush
