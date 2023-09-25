@extends('adminlte::page')

@section('title', 'Super Admin | Gift Cards')

@section('content_header')
 
@section('content') 
<div class="container">
   <div class="alert d-none" role="alert" id="flash-message"></div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3> Deleted Gift Cards</h3>
                  <div class="d-flex align-items-center">
                    
                      @if(Gate::check('restore_gift_cards') || Gate::check('permanent_deleted_gift_cards')) 
                    <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="advance-option-margin show-advance-options ml-2">Bulk Actions<i class="fa fa-caret-down"></i></a> 

                    @endcan


                  </div>
               </div>

               <div class="advance_filter mb-3 collapse" id="advanceOptions">
                  <div class="advance-options" style="">
                     <div class="title">
                       <h5><i class="fa fa-filter mr-1"></i>Select Batch </h5>
                     </div>                      
                     <div class="left_option">
                       <div class="left_inner">
                         <h6>Select Date Range</h6>
                         <div class="button_input_wrap">
                          <div class="date_range_wrapper wrap-align-input">
                           <i class="fas fa-calendar-alt mr-2"></i>
                           <select class="form-control mr-2" id="badge_select"> 
                             <option value="select_badge">Select Batch</option>
                               @forelse ($all_badges as $all_badge)
                              <option value="{{$all_badge->badge}}">{{$all_badge->badge}}</option>
                              @empty
                              <option disabled>No Batch</option>
                              @endforelse
                           </select>
                          </div>
                          <div class="apply_reset_btn">
                  @if(Gate::check('restore_gift_cards') || Gate::check('permanent_deleted_gift_cards'))
                            @can('permanent_deleted_gift_cards')   
                            <button class="apply apply-filter mr-1" style="background-color: red !important;border: none;border-radius:4px;"><i class="fa fa-trash-alt mr-2" style="color: #ffffff;"></i>Permanent Delete</button>
                            @endcan
                            @can('restore_gift_cards')
                              <button class="apply restore-button-bulk mr-1" style="background-color: red !important;border: none;border-radius:4px;"><i class="fa fa-undo mr-2" style="color: #ffffff;"></i>Restore</button>
                            @endcan
                            <button class="btn btn-primary reset-button" style="background-color:#000000;border: none;color: #ffffff;"><i class="fas fa-sync-alt mr-2" style="color: #ffffff;"></i>Reset</button> 
                    @endcan   

                          </div>                             
                         </div>                                                    
                       </div>
                     </div>
                  </div>
               </div>

               <div class="card-body table p-0">
                  @if(session('status'))
                  <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                  </div>
                  @endif
                 <table class="table table-bordered" id="users-table">
                <thead>

                    <tr>
                    <th>Card Number</th> 
                    <th>Batch</th> 
                    <th>Type</th>  
                      @if(Gate::check('restore_gift_cards') || Gate::check('permanent_deleted_gift_cards'))
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                       @endcan 
                    </tr>
                </thead>
            </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
 <!--  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> -->

<style type="text/css">
  .ui-sortable-helper {
        display: table;
    }
</style>
 
@stop

@section('js')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  
  <script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('gift.card.deleted.list.data') !!}',
        columns: [
            { data: 'card_number', name: 'card_number' },
            { data: 'badge', name: 'badge' },
            { data: 'statusType', name: 'statusType' },

              @if(Gate::check('restore_gift_cards') || Gate::check('permanent_deleted_gift_cards'))
            { data: 'action', name: 'action' ,   searchable: true },
               @endif 
            

        ]
    });
});
</script> 




  <script type="text/javascript">
      

            //Change Status

$(document).on('click','.apply-filter',function(){
    
     var badge_select = $('#badge_select').val();

      if(badge_select.trim() != 'select_badge'){

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to Permanently Delete this batch Record  ?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            type: 'post',
            url: "{{route('gift.card.bulk.delete.permanent')}}",
            data: {
              id: badge_select
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){
                 $( "#flash-message" ).css("display","block");
                   $( "#flash-message" ).removeClass("d-none");
                   $( "#flash-message" ).addClass("alert-danger");
                $('#flash-message').html('Gift Card Deleting......');
            },
            success: function(response) {
              console.log("Response", response);
              if(response.success == 1) {
                   $( "#flash-message" ).css("display","block");
                   $( "#flash-message" ).removeClass("d-none");
                   $( "#flash-message" ).addClass("alert-danger");
                   $('#flash-message').html('Gift Card Deleted Successfully');
                   
                   setTimeout(() => {
                   $( "#flash-message" ).addClass("d-none"); 
                    location.reload();
                   },2000);
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                  swal('Error','Something went wrong','error');
                // alert("Something went wrong! Please try again.");
                }, 500);
              }
            }
          });
        } 
      });

  }

 
});





$(document).on('click','.restore-button-bulk',function(){
    
     var badge_select = $('#badge_select').val();
      
      if(badge_select.trim()!='select_badge'){

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to Restore this batch Record  ?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            type: 'post',
            url: "{{route('gift.card.bulk.restore')}}",
            data: {
              id: badge_select
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){
                 $( "#flash-message" ).css("display","block");
                   $( "#flash-message" ).removeClass("d-none");
                   $( "#flash-message" ).addClass("alert-danger");
                $('#flash-message').html('Gift Card Restoring......');
            },
            success: function(response) {
              console.log("Response", response);
              if(response.success == 1) {
                   $( "#flash-message" ).css("display","block");
                   $( "#flash-message" ).removeClass("d-none");
                   $( "#flash-message" ).addClass("alert-danger");
                   $('#flash-message').html('Gift Card Restore Successfully');
                   
                   setTimeout(() => {
                   $( "#flash-message" ).addClass("d-none"); 
                    location.reload();
                   },2000);
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                  swal('Error','Something went wrong','error');
                // alert("Something went wrong! Please try again.");
                }, 500);
              }
            }
          });
        } 
      });

  }

 
});





$(document).on('click','.reset-button',function(){
     
     var badge_select = $('#badge_select').val('select_badge');

    
 
});



 
  </script>





    <script>
   
   $(document).ready(function(){
 
//Restore Users.........    


 $('body').on('click','.restore-button',function(e){

var id = $(this).attr('data-id');
var obj = $(this);

swal({
title: "Are you sure?",
text: "Are you sure you want to restore this Gift Card ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
  $.ajax({
    url: "{{ route('gift.cards.restore') }}",
    type: 'post',
    data: {
      id: id
    },
    success: function(response) {
  
      if(response.trim() == 'success') {
        
         $( "#flash-message" ).css("display","block");
         $( "#flash-message" ).removeClass("d-none");
         $( "#flash-message" ).addClass("alert-success");
         $('#flash-message').html('Gift Card Restore Successfully');
         obj.parent().parent().remove();
         setTimeout(() => {
         $( "#flash-message" ).addClass("d-none");
         }, 5000);

       }
       else {
         console.log("FALSE");
         setTimeout(() => {
         alert("Something went wrong! Please try again.");
         }, 500);

       }

  

    }
  });
} 
});
});


 
//Permanent Delete
     
  $('body').on('click','.delete-button',function(e){

var id = $(this).attr('data-id');
var obj = $(this);

swal({
title: "Are you sure ?",
text: "Are you sure you want to Permanently Delete this Record  ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
  $.ajax({
    url: "{{ route('gift.cards.permanent_delete') }}",
    type: 'post',
    data: {
      id: id
    }, 
    success: function(response) {
  
      if(response.trim() == 'success') {
        
         $( "#flash-message" ).css("display","block");
         $( "#flash-message" ).removeClass("d-none");
         $( "#flash-message" ).addClass("alert-danger");
         $('#flash-message').html('Gift Card Deleted Successfully');
         obj.parent().parent().remove();
         setTimeout(() => {
         $( "#flash-message" ).addClass("d-none");
         }, 5000);

       }
       else {
         console.log("FALSE");
         setTimeout(() => {
         alert("Something went wrong! Please try again.");
         }, 500);

       }

    







    }
  });
} 
});
});
 


});
 
  </script>
@stop
