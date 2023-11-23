@extends('adminlte::page')
@section('title', 'Promo Codes')
@section('content_header')
@stop
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
               <h3>Promo Codes</h3>
               <a class="btn btn-sm btn-success" href="{{ route('promo_codes.add') }}">Add Promo Code</a>               
            </div>

            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <div class="text-right mb-3">
               
                  <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
                    <thead>
                      <tr>
                        <th class="display-none"></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Percentage off</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="payments_list">
                      <?php for ($i=0; $i < count($promo_codes); $i++) { ?>
                      <tr>
                        <th class="display-none"></th>
                        <td>{{ $promo_codes[$i]->name }}</td>
                        <td>{{ $promo_codes[$i]->description }}</td>
                        <td>{{ $promo_codes[$i]->percentage_off }}</td>

                        <td>    
                            @if($promo_codes[$i]->status==1)

                            <span class="badge badge-success">Active</span>

                            @else

                            <span class="badge badge-warning">Inactive</span>
                            
                            @endif
                        </td>
                        
                        
                        <td>{{$promo_codes[$i]->created_at->timezone(session('timezone')??'UTC')->format('d/m/Y h:i:s A T')}}</td>


                        <td>
                            @can('view_student')
                            <a class="action-button" title="Edit" href="edit/{{$promo_codes[$i]->id}}"><i class="text-danger fa fa-edit"></i></a>
                            @endcan
                         
                        </td>
                        
                        </tr>
                      <?php } ?>
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

@stop
@section('js')

@stop