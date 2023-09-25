@extends('adminlte::page')

@section('title', 'Super Admin | Current Offers')

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
                  <h3> Current Offers</h3>
                  @can('add_current_offer')
                  <a class="btn btn-success" href="{{ route('current.offers.homepage.add') }}">Add Current Offer</a>
                  @endcan
               </div>
               <div class="card-body table form mb-0">
                  <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th class="display-none"></th>
                           <th>Offer Name</th>
                           <th>Start Date/ Time</th>
                           <th>End Date/ Time</th>
                           <th>Status</th>
                           <th>Popup Image Status</th>
                           @if (Gate::check('view_current_offer') ||
                           Gate::check('edit_current_offer') ||
                           Gate::check('delete_current_offer'))
                           <th>Action</th>
                           @endif
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($allHomePageCurrentOffers as $offer)
                        <tr>
                           <td class="display-none"></td>
                           <td>{{ $offer->offer_name }}</td>
                           <td>{{ date('d/m/Y h:00 A', strtotime($offer->start_date)) }}</td>
                           <td>{{ date('d/m/Y h:00 A', strtotime($offer->end_date)) }}</td>
                           <td>
                              <label class="switch">
                              <input @can('edit_current_offer') @else disabled @endcan type="checkbox" class="change_status_of_status"
                              data-id="{{$offer->id}}"
                              {{ $offer->status == '1' ? 'checked' : '' }}> 
                              <span class="slider round"></span>
                              </label> 
                           </td>
                           <td>
                              <!-- @foreach ($status as $status_data)
                                 @if ($status_data->value == $offer->status)
                                     <label
                                         class="badge {{ $offer->status == 1 ? 'badge-success' : 'badge-danger' }} p-1">{{ $status_data->name }}</label> 
                                 @endif 
                                 @endforeach -->
                              <label class="switch">
                              <input  @can('edit_current_offer') @else disabled @endcan type="checkbox" class="change_status_of_popup"
                              data-id="{{$offer->id}}"
                              {{ $offer->pop_up_image_status == '1' ? 'checked' : '' }}>
                              <span class="slider round"></span>
                              </label>
                           </td>
                           @if (Gate::check('view_current_offer') ||
                           Gate::check('edit_current_offer') ||
                           Gate::check('delete_current_offer'))
                           <td>
                              @can('view_current_offer')
                              <a class="action-button" title="View"
                                 href="{{ route('current.offers.homepage.view', ['id' => $offer->id]) }}"><i
                                 class="text-info fa fa-eye"></i></a>
                              @endcan
                              @can('edit_current_offer')
                              <a href="{{ route('current.offers.homepage.edit', ['id' => $offer->id]) }}"
                                 title="Edit"><i class="text-warning fa fa-edit"></i></a>
                              @endcan
                              @can('delete_current_offer')
                              <a class="action-button delete-button" title="Delete"
                                 href="javascript:void(0)" data-id="{{ $offer->id }}"><i
                                 class="text-danger fa fa-trash-alt"></i></a>
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
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
   $('#pages-list').DataTable({
       columnDefs: [{
           targets: 0,
           render: function(data, type, row) {
               return data.substr(0, 2);
           }
       }]
   });
   
   
   // delete
   $('.delete-button').click(function(e) {
       var id = $(this).attr('data-id');
       var obj = $(this);
   
   // console.log({id});
       swal({
           title: "Are you sure?",
           text: "Are you sure you want to  delete this Current Offer Offer ?",
           type: "warning",
           showCancelButton: true,
       }, function(willDelete) {
           if (willDelete) {
               $.ajax({
                   url: "{{ route('current.offers.home.delete') }}",
                   type: 'post',
                   data: {
                       id: id
                   },
                   dataType: "JSON",
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   success: function(response) {
                       console.log("Response", response);
                       if (response.success == 1) {
                           $("#flash-message").css("display", "block");
                           $("#flash-message").removeClass("d-none");
                           $("#flash-message").addClass("alert-danger");
                           $('#flash-message').html(
                               ' Current Offer  Deleted Successfully');
                           obj.parent().parent().remove();
                           setTimeout(() => {
                               $("#flash-message").addClass("d-none");
                           }, 5000);
                       } else {
                           console.log("FALSE");
                           setTimeout(() => {
                               swal('Error',
                                   "Something went wrong! Please try again.",
                                   'error');
                           }, 500);
               // swal("Error!", "Something went wrong! Please try again.", "error");
               // swal("Something went wrong! Please try again.");
                       }
                   }
               });
           }
       });
   });
   // delete
</script>
<script type="text/javascript">
   //Active and incactive choices

$(document).ready(function() {
$(document).on('change', '.change_status_of_status', function() {
   var id = $(this).data("id");
   var status_value = $(this).prop('checked') == true ? 1 : 0;

   $.ajax({
       type: "post",
       url: "{{ route('current.offers.image.status') }}",
       data: {
           "_token": "{{ csrf_token() }}",
           id: id,
           status_value: status_value,
       },
       success: function(response) {
//toastr.success(response.message);
           console.log(response);
       }
   });
})
   
       //        $('.change_status_of_group').change(function(){
   
       // });
   
   
   
                   });
               
</script>
<script type="text/javascript">
   //Active and incactive choices
   
    $(document).ready(function() {
    $(document).on('change', '.change_status_of_popup', function() {
    var id = $(this).data("id");
    var status_value = $(this).prop('checked') == true ? 1 : 0;

    $.ajax({
    type: "post",
    url: "{{ route('current.offers.popup.image.status') }}",
    data: {
    "_token": "{{ csrf_token() }}",
    id: id,
    status_value: status_value,
    },
    success: function(response) {
    //toastr.success(response.message);
    console.log(response);
    }
    });
    })

    //        $('.change_status_of_group').change(function(){

    // });



    });
               
</script>

         
@stop
