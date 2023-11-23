@extends('adminlte::page')

@section('title', 'Interest Details')

@section('content_header')
@stop

@section('content')



<div class="container">
 <div class="row justify-content-center">
   <div class="col-md-12">
     <div class="card">
       <div class="card-header alert d-flex justify-content-between align-items-center">
         <div class="d-flex align-items-center">
           <div class="icon_main">

           </div>
           <h3>Ticket Detail <span
             class="badge {{ $ticket->status == '10' ? 'badge-danger' : 'badge-success' }} p-2">{{ $ticket->status == '11' ? 'Open' : 'Reviewing ' }}</span>
          </h3>
       </div>
       <a class="btn btn-sm btn-success add-advance-options"
       href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
    </div>
    <div class="card-body">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
       {{ session('status') }}
    </div>
    @endif


    <form id="addUserForm" style="pointer-events: none;">
     @csrf
     <div class="">

       <div class="row">
         <div class="col-sm-6">
           <div class="form-group">
             <label for="name">Ticket Id</label>
             <input type="text" name="name" class="form-control" id="name"
             maxlength="100" value="{{ $ticket->unique_ticket_id }}">
          </div>
       </div>

                                    <!--     <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Created At</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    maxlength="100"
                                                    value="{{ date('d/m/Y H:i:A', strtotime($ticket->created_at)) ?? '' }}">

                                            </div>
                                         </div> -->

                                         <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group"> <label>Category
                                            </label>
                                            <input readonly type="text" name="category" class="form-control"
                                            id="category" maxlength="100" value="{{ $ticket->category ?? '' }}">
                                         </div>
                                      </div>
   
                        </div>


                     </div>



                  </form>

                  <section class="chat_main position-relative">
                    <div class="chat_wrapper">
                       <div class="right">
                          <div class="wrapper_chat_ticket">
                             <div class="chat_message" style="display: block;">
                                <div class="header" style="display: block;">
                                   <div class="left-header-container">
                                      <div class="name">
                                         <label>{{ @$ticket->user->name ?? '' }}</label>
                                      </div>
                                      <div class="ticket_help_chat" id="ticket_unqiue_id">{{ $ticket->unique_ticket_id }} </div>
                                   </div>
                                </div>
                                <div class="overflow-help-chat" id="messages_list">
                                   <div class="left-body">
                                      <div class="left-body-container">

                                        @forelse($ticketInfo->ticketmessages->messages as $message)
                                        @if ($message->sender_guard == 'users')



                                        <div class="first">
                                         <div class="avt">
                                            <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/default_img.png" alt="avatar" class="avataar_img">
                                         </div>
                                         <div class="message" style="width:50%;">
                                            <p class="chat_name"> {{ @$ticket->user->name ?? '' }} </p>
                                            <div class="chat_ticket" style="width:100%;">
                                               <p class="mb-0"> {{ $message->message }}
                                               </p>
                                               <span class="left_span">{{ $message->created_at->format('H:i') }}</span>
                                            </div>
                                         </div>
                                      </div>


                                      @else

                                      <div class="second">
                                         <div class="message" style="width:50%;">
                                           <p class="chat_name text-right">{{App\Models\Ticket::getNutiritionistName($message->sender_id)}}</p>
                                            <div class="chat_ticket_right" style="width:100%;">
                                               <p class="mb-0">{{ $message->message }}
                                               </p>
                                               <span class="right_span">{{ $message->created_at->format('H:i') }}</span>
                                            </div>
                                         </div>
                                         <div class="avt">
                                            <img src="https://i.postimg.cc/8zVFGCfR/Contact-Name.png" alt="avatar" class="avataar_img">
                                         </div>
                                      </div>

                                      @endif
                                      @empty
                                      <p>No messages!</p>
                                      @endforelse





                                   </div>
                                </div>
                             </div>
                             <div class="footer d-none">
                              <div class="left-footer-container">
                               <div class="input-group">
                                <div class="input-container w-100">
                                 <div class="w-100">
                                  <div class="share position-relative">
                                   <input type="file" name="">  
                                   <img src="{{ asset('assets/images/attachment.svg') }}" class="d-block w-100" alt="share">
                                </div>
                                <div class="inp w-100">
                                   <input type="text" name="message" id="message_text" class="w-100" placeholder="Type something..." />
                                </div>
                             </div>
                          </div>
                       </div>
                       <div class="btn-container">
                          <button class="send_message">
                           <img
                           src="https://i.postimg.cc/5t4hhvd2/Union-1.png" alt="send"
                           />
                        </button>
                     </div>
                  </div>
               </div>                               
            </div>
         </div>
      </div>
   </div>
   <div class="empty_folder_dash" style="display:none;">
     <div class="container">
        <div class="no_data">
           <div>
              <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/nochat.png">
              <p>There's no Chat/Tickets Yet!</p>
           </div>
        </div>
     </div>
  </div>
</section>                        

</div>
</div>
</div>
</div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
@stop

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
        // $(document).ready(function() {
        //   $('#roles-list').DataTable( {
        //     stateSave: true,
        //     columnDefs: [ {
        //       targets: 0,
        //       render: function ( data, type, row ) {
        //         return data.substr( 0, 2 );
        //       }
        //     }]
        //   });
        // });




        // $('.send_response').click(function(){
        //          var id = $("#ticket_id").val();
        //          var message = $("#message").val();

        //          $.ajax({
        //                type:"post",
        //                url:"{{ route('ticket.send.message') }}",
        //                data:{
        //                   "_token": "{{ csrf_token() }}", 
        //             id:id,
        //             message:message,
        //             },
        //             success:function(response){
        //             if(response.success==true){
        //                 $("<div class='chat-log-heading darker col-12'><div class='chat-box'><p>"+message+"</p><span class='time-left'>11:01</span></div><img src='https://cdn2.vectorstock.com/i/thumb-large/23/81/default-avatar-profile-icon-vector-18942381.jpg' alt='Avatar' class='right' style='width:100%;'></div>").insertAfter($('.chat-log-heading').last());
        //                 $(".chat-div-wrapper").stop().animate({ scrollTop: $(".chat-div-wrapper")[0].scrollHeight}, 800);
        //                 $("#message").val(' ');
        //             }
        //             }
        //          }); 
        //       }); 
        // $(".chat-div-wrapper").stop().animate({ scrollTop: $(".chat-div-wrapper")[0].scrollHeight}, 3000);
        //   
</script>
@stop
