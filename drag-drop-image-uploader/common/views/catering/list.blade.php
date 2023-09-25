@extends('adminlte::page')

@section('title', 'Super Admin | Online Caterings Orders')

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
              <h3>Online Catering Orders</h3>
            </div>           
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <table style="width:100%" id="categories-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                
                  <th>Customer info</th>
                   <th>City name</th>
                   <th>Celebration type </th>
                  <th>Menu type</th>
                  <th>Status</th>
                   <th>Celebration date </th>
                   @if(Gate::check('view_catering') || Gate::check('edit_catering') || Gate::check('delete_catering'))
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                   @foreach($cateringList as $catering)

                <tr>
                  <th class="display-none"></th>
                  
                  <td>
                     
                      <span>{{ucfirst($catering->first_name) ?? ''}} {{ ucfirst($catering->last_name) ?? ''}}</span>
                      <span>({{ $catering->phone_number ?? ''}})</span>
                    
                  </td>
                   <td>{{$catering->city->city ?? ''}}</td>
                  <td>{{ucfirst($catering->celebration_type) ?? ''}}</td>
                  <td>{{$catering->menu_type ?? 'N/A'}}</td>
                  
                  <td>
                     <select class="form-control changestatus" name="status" disabled >
                        @foreach ($catering_order_status as $order_status)

                       <option   {{ $order_status->value == $catering->status ? 'selected':'' }} > {{ $order_status->name }}</option>
                          @endforeach
   
                        </select>

                  </td> 

                  <td>{{date('d/m/Y',strtotime($catering->date_of_celebrations)) }}</td>
                  
                  @if(Gate::check('view_catering') || Gate::check('edit_catering') || Gate::check('delete_catering'))   
                  <td>
                      @can('view_catering')
                      <a class="action-button" title="View" href="{{route('catering.view',['id'=>$catering->id])}}"><i class="text-info fa fa-eye"></i></a>
                      @endcan
                       @can('edit_catering')
                       <a class="action-button" title="Edit" href="{{route('catering.edit',['id'=>$catering->id])}}"><i class="text-warning fa fa-edit"></i></a>
                       @endcan

                       @can('delete_catering')
                        <a data-id="{{$catering->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
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
    $('#categories-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });
    
  
     $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this Catering  ?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url:  '{{ route("catering.delete") }}',
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
              if(response.success == 1) {
                $( "#flash-message" ).css("display","block");
                $( "#flash-message" ).removeClass("d-none");
                $( "#flash-message" ).addClass("alert-danger");
                $('#flash-message').html('Catering Deleted Successfully');
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
  </script>
@stop
