@extends('adminlte::page')

@section('title', 'Super Admin | Deleted Checkout Offers')

@section('content_header')
 

@section('content')

<div class="container">
   <div class="alert d-none" role="alert" id="flash-message">        
    </div>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Deleted Checkout Offers </h3>
          </div>    
          <div class="card-body table p-0 mb-0">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

          
            <table style="width:100%" id="users-list" class="table table-bordered table-hover yajra-datatable">
              <thead>
                <tr>
                
                  <th>Offer Name</th>
                      <th>Offer Type</th>
                      <th>Percentage/Amount</th>
                      <th>Start Date/ Time</th>
                      <th>End Date/ Time</th>
                      <th>Status</th>
                @if(Gate::check('restore_checkout_offer') || Gate::check('permanent_deleted_checkout_offer'))
                  <th>Actions</th>  
               @endif
   
                </tr>
              </thead>
              <tbody>
                 @foreach($offersList as $offer)
                       
                             <tr>
                       <td class="display-none"></td>
                       <td>{{$offer->offer_name}}</td>
                       <td>
                        @foreach($offerType as $oftype)
                         @if($oftype->value==$offer->offer_type)
                          {{$oftype->name}}
                         @endif
                        @endforeach
                       
                       </td>
                       <td>
                        @if($offer->offer_type=='1')
                         {{$offer->offer_amount." ".env('AMOUNT_SIGN')}}
                        @else
                          {{$offer->offer_amount." ".env('AMOUNT_PERCENTAGE')}}
                        @endif
                       </td>
                       <td>{{date('d/m/Y h:00 A',strtotime($offer->start_date))}}</td>
                       <td>{{date('d/m/Y h:00 A',strtotime($offer->end_date))}}</td>
                          <td>
                            @foreach($status as $status_data)
                             @if($status_data->value==$offer->status)
                              <label class="badge {{$offer->status==1?'badge-success':'badge-danger'}} p-1">{{$status_data->name}}</label>
                             @endif
                            @endforeach
                        </td>
                @if(Gate::check('restore_checkout_offer') || Gate::check('permanent_deleted_checkout_offer'))

                           <td>

                            @can('restore_checkout_offer')
                            <a class="action-button restore-button" title="Restore" href="javascript:void(0)"  data-id="{{ $offer->id}}"><i class="text-success fa fa-undo"></i></a>
                            @endcan

                             @can('permanent_deleted_checkout_offer')
                            <a class="action-button delete-button" title=" Permanent Delete" href="javascript:void(0)" data-id="{{ $offer->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                           @endcan
                        </td>  
                        @endif           
                      </tr> 
                      
                      @endforeach
              </tbody>
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
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  
  
  <script>
   
   $(document).ready(function(){

    $(document).ready(function() {
      $('#users-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 100 );
          }
        }]
      });
    });


//Restore Users.........    


 $('body').on('click','.restore-button',function(e){

var id = $(this).attr('data-id');
var obj = $(this);

swal({
title: "Are you sure?",
text: "Are you sure you want to restore this Checkout Offer ?",
type: "warning",
showCancelButton: true,
}, function(willDelete) {
if (willDelete) {
  $.ajax({
    url: "{{ route('restore_offer') }}",
    type: 'post',
    data: {
      id: id
    },
    success: function(response) {
  
      if(response.trim() == 'success') {
        
         $( "#flash-message" ).css("display","block");
         $( "#flash-message" ).removeClass("d-none");
         $( "#flash-message" ).addClass("alert-success");
         $('#flash-message').html('Checkout Offer Restore Successfully');
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
    url: "{{ route('permanent_delete_offer') }}",
    type: 'post',
    data: {
      id: id
    }, 
    success: function(response) {
  
      if(response.trim() == 'success') {
        
         $( "#flash-message" ).css("display","block");
         $( "#flash-message" ).removeClass("d-none");
         $( "#flash-message" ).addClass("alert-danger");
         $('#flash-message').html(' Checkout Offer Deleted Successfully');
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
