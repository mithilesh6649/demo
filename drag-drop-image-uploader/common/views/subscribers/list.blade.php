@extends('adminlte::page')

@section('title', 'Subscribers')

@section('content_header')
 

@section('content')


 

<div class="container">
  <div class="alert d-none" role="alert" id="flash-message">
   </div>
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Subscribers</h3>
          </div>
          <div class="card-body">
            <table style="width:100%" id="deleted-jobseekers-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  
                  <th>Email</th>
                  
                  <th>Contact Number</th>
                  <th>Date of Birth</th>
                  
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              
              @foreach($allSubscribersList as $allSubscriber)
                
                       <tr>
                     
                    <td>{{ $allSubscriber->email ?? 'N/A' }} </td>
                    <td>{{ $allSubscriber->phone_number ?? 'N/A' }}</td>
                    <td>{{ $allSubscriber->date_of_birth }}</td>
                    
                    <td>
                      
                   @if($allSubscriber->status == 1)
                     <span class="badge badge-pill badge-success">Subscribed</span>
                    @else
                     <span class="badge badge-pill badge-danger">Unsubscribed</span>
                    @endif

                    </td>
                     <td>
                     
                      <!--  <a href="mailto:{{ $allSubscriber->email }}" title="Reply"><i class="text-info fa fa-reply"></i></a> -->
                        <a href="{{ route('subscribers.view', ['id' => $allSubscriber->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                       <!--   <a data-id="{{ $allSubscriber->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a> -->
                    </td>
                     
                  </tr>


              @endforeach 
              
              </tbody>
            </table>
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
      $('#deleted-jobseekers-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data ;
          }
        }]
      });
    });


 

 





  

  </script>
@stop
