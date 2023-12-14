@extends('buyer.dashboard')
@section('inner_content')
<div class="row margin-top-40">
    <!-- Middle Content Area -->
    <div class="col-md-12 col-lg-12 col-sx-12">
        <!-- Row -->
        <div class="main-content-area clearfix">
            <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
            <!-- COURSE CONCERN -->
            <section class="section-padding no-top gray">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="message-body">

                           <div class="col-md-4 message-person col-sm-5 col-xs-12">
                              <div class="message-inbox">

                                 <ul class="message-history">
                                    @foreach ($lead_messages as $message )

                                    <li class="message-grid bg-warning">
                                        @if($message->user->role ==2)
                                       <a
                                       href="#"
                                       data-sender_id="{{$message->sender_id}}" id="messageSelect"
                                       data-lead_id="{{$message->lead_id}}" id="messageSelect"
                                       >
                                       <div  class="image">
                                        <img style="margin-top:9px" src={{$message->lead->inventories_car->image}} alt="">
                                     </div>

                                          <div class="user-name">
                                             <div class="author">

                                                    <span id="title">{{$message->lead->inventories_car->title}}
                                                        <br>#{{$message->lead->inventories_car->stock}}</span>



                                                {{-- <div class="user-status"></div> --}}



                                             </div>
                                             {{-- <p>{{$message->lead->lead_id}}</p> --}}
                                             <div class="time">
                                               <span><i class="icon-envelope"></i></span>
                                             </div>
                                          </div>
                                       </a>
                                       @endif
                                    </li>
                                    <!-- END / LIST ITEM -->



                                 @endforeach
                                 </ul>
                              </div>
                           </div>
                           <div  style="background-color:honeydew"  class="col-md-8 clearfix col-sm-5 col-xs-12 message-content">
                            <h2 id="chose" style="margin-top:150px; text-align:center;margin-bottom:170px;color:rgb(4, 0, 255)6, 79, 11)">Select a listing for show your dealer message</h2>
                              <div style="position:relative"  class="message-details">





                                 <div  id="message_all">

                                    {{-- <div id="messageSender" class="my-message clearfix">


                                        </div>
                                    </div>
                                    <div id="messageDealer" class="friend-message clearfix ">


                                    </div> --}}







                                </div>
                                 <div style="margin-bottom:20px; margin-top:50px" class="chat-form">
                                    <form id="message_form" role="form" action="{{route('byermessage.add')}}" class="form-inline" method="post"  enctype="multipart/form-data">
                                        @csrf
                                       <div class="form-group">
                                          <input name="message" style="width: 100%" placeholder="Type a message here..." class="form-control" type="text">
                                          <input name="lead_id" id="lead_id" value="" class="form-control" type="hidden">

                                          <input name="receiver_id" id="reciver_id" value="" class="form-control" type="hidden">
                                       </div>
                                       <button class="btn btn-theme" type="submit">Send</button>
                                    </form>
                                 </div>


                              </div>

                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- END / COURSE CONCERN -->

         </div>
</div>
<!-- Middle Content Area  End -->
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

    $(document).on('click', '#messageSelect', function(){
        let sender_id = $(this).data('sender_id');
        let lead_id = $(this).data('lead_id');

        $.ajax({
            url: "{{ route('message.collect') }}",
            method: "post",
            data: { sender_id: sender_id,lead_id:lead_id},
            success: function(res) {
                console.log(res.data);
                $('#message_all').empty();



                $('#lead_id').val(res.data[0].lead_id);

                $('#reciver_id').val(res.data[0].receiver_id);

                if (res.status == 'success' && res.data.length > 0) {




                res.data.forEach(function(message) {
                    console.log(message);

                    var formattedTime = new Intl.DateTimeFormat('en-US', { day: 'numeric', month: 'short', hour: 'numeric', minute: 'numeric', hour12: true }).format(new Date(message.created_at));

                    if(message.sender_id == <?php echo Auth::id(); ?>){
                        $('#message_all').append('<p  style="color:white;background-color:rgb(2, 41, 88);padding:10px; border-radius:3px;width:390px !important;" >' + message.message + '<span style="margin-left:10px; float:right; margin-top:13px;color:orange">' + formattedTime + '</span></p>');
                        $('#chose').css('display', 'none');
                    }else{

                        $('#message_all').append('<p style="color:white;background-color:gray;padding:10px; border-radius:3px;width:390px !important; margin-left:300px">' + message.message + '<span style="margin-left:10px; float:right; margin-top:13px; color:orange">' + formattedTime + '</span></p>');

                    }



                });



              }







            }
        });
    });
});


</script>
@endpush
