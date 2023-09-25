@extends('adminlte::page')

@section('title', 'Super Admin | Security questions details')

@section('content_header')
 

@section('content')
  
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-main">
<!--                 <div class="ard-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                  <h3>Security Question Details</h3>
                </div> -->
                <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0" style="display: none;">
                   <h3>Security Question Details</h3>
                   <a class="btn btn-sm btn-success" href="https://server3.rvtechnologies.in/MMMission22/Super-Admin/public/misc/security/questions/list">{{ __('adminlte::adminlte.back') }}</a>
                </div>
                <div class="card-body table p-0 mb-0">
                  @if (session('status'))
                  <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                  @endif
                <div class="modal-body p-0">
                  <div class="portlet-body">
                    <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                        <div class="form-group">
                           <label>Title {{ labelEnglish() }}</label>
                           <input class="form-control" placeholder="{{$question->title_en ??'N/A'}}" readonly>
                        </div>
                     </div>
                     
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                        <div class="form-group">
                           <label>Title {{ labelArabic() }}</label>
                           <input class="form-control" placeholder="{{$question->title_ar ??'N/A'}}" readonly>
                        </div>
                     </div>

                     <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                        <div class="form-group ">
                           <label for="status">Status </label> 
                           <select class="form-control" name="status" id="status" disabled>
                           @foreach($status as $status_data)
                           <option value="{{$status_data->value}}" {{ $status_data->value == $question->status ? 'selected':'' }} >{{$status_data->name}}</option>
                           @endforeach
                           </select>
                        </div>
                     </div>
                   </div>
                </div>
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