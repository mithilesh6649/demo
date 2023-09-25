@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')


@section('content')

<div class="container">


  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Cars</h3>
                @can('add_car')
               <a class="btn btn-sm btn-success" href="{{ route('cars.add') }}">Add Cars</a>
               @endcan
            </div>
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <div class="alert d-none" role="alert" id="flash-message">
               </div>

              <table style="width:100%" id="citiesList" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="display-none"></th>

                    <th>Expiry Date</th>
                    <th>No Plate</th>
                    <th>Model</th>
                    <th>Chassis No</th>
                    <th>Ownership</th>
                    <th>Driver Name</th>
                     <th>Allocated Branch</th>
                    <th>Status</th>
                 @if(Gate::check('view_car') || Gate::check('edit_car') || Gate::check('delete_car'))
                 <th>{{ __('adminlte::adminlte.actions') }}</th>
                 @endif
                  </tr>
                </thead>
                <tbody>

                     @forelse($list as $cars_lsit)
                       <tr>
                          <td class="display-none"></td>
                         <?php
                              $strtotime =  strtotime($cars_lsit->expiry_date);
                              $one_month_back = date("Y-m-d", strtotime("-1 month", $strtotime));
                              $current_month =  date("Y-m-d");

                              if($one_month_back <= $current_month){
                                $color = "bg-danger";
                              }else{
                                $color = "";
                              }

                          ?>

                          <td class="{{ $cars_lsit->expiry_date =="" ? 'N/A' : $color  }}"> {{ $cars_lsit->expiry_date =="" ? 'N/A' : date('d/M/Y',strtotime($cars_lsit->expiry_date))}} </td>
                          <td class="{{ $cars_lsit->expiry_date =="" ? 'N/A' : $color  }}"">{{$cars_lsit->no_plate ?? 'N/A'}}</td>
                          <td class="{{ $cars_lsit->expiry_date =="" ? 'N/A' : $color  }}"">{{$cars_lsit->model ?? 'N/A' }}</td>
                          <td class="{{ $cars_lsit->expiry_date =="" ? 'N/A' : $color  }}"">{{$cars_lsit->chassis_no ?? 'N/A'}}</td>
                          <td >{{$cars_lsit->owner->ownership_name ?? 'N/A'}}</td>
                          <td>{{$cars_lsit->driver->drivers_name ?? 'N/A'}}</td>
                          <td>{{@$cars_lsit->carBranch->branch->title_en ?? 'N/A'}}</td>
                          <td><span class="{{$cars_lsit->status==1?'text-success':'text-danger'}}">{{$cars_lsit->status==1?'Active':'Inactive'}}</span></td>
                 @if(Gate::check('view_car') || Gate::check('edit_car') || Gate::check('delete_car'))
                           <td>
                              @can('view_car')
                              <a class="action-button" title="View" href="{{route('cars.view',['id'=>$cars_lsit->id])}}"><i class="text-info fa fa-eye"></i></a>
                              @endcan
                              @can('edit_car')
                              <a class="action-button" title="Edit" href="{{route('cars.edit',['id'=>$cars_lsit->id])}}"><i class="text-warning fa fa-edit"></i></a>
                               @endcan
                               @can('delete_car')
                              <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{$cars_lsit->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                                @endcan
                          </td>
                    @endif

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
</div>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#citiesList').DataTable( {
        "ordering": false,
      });
    });




     $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Cars to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url:  '{{ route("cars.deletes") }}',
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
                $('#flash-message').html('Car deleted Successfully');
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
