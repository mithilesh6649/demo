@extends('adminlte::page')

@section('title', 'Join Us Details')

@section('content_header')
 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Join Us Details</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
           
            <form class="form_wrap">
              <div class="row">
                
                <div class="col-6 mb-3">
                  <div class="form-group">
                    <label>First Name</label>
                    <input class="form-control" placeholder="{{ $joinus->first_name }}" readonly>
                  </div>
                </div>

               <div class="col-6 mb-3">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input class="form-control" placeholder="{{ $joinus->last_name }}" readonly>
                  </div>
                </div>


                <div class="col-6 mb-3">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" placeholder="{{ $joinus->email }}" readonly>
                  </div>
                 </div>

                <div class="col-6 mb-3">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input class="form-control" placeholder="{{ $joinus->phone_number }}" readonly>
                  </div>
                </div>


                <div class="col-6 mb-3">
                  <div class="form-group">
                    <label>Position</label>
                    <input class="form-control" placeholder="{{ $joinus->positions }}" readonly>
                  </div>
                </div>
             
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group  ">
                    <label>Apply Date</label>
                  <input class="form-control px-0" placeholder="{{date('d/m/Y H:i A',strtotime($joinus->created_at)) }}" readonly>
                </div>
              </div>


               <div class="col-md-6 col-sm-6 col-12 mt-3">
                                <div class="form-group  ">
                                    <label class="d-block">Resume</label>
                                    <a href="{{ $joinus->resume_file }}" target="_blank"><i class="fas fa-file-pdf fa-10x text-danger"></i></a>
                                </div>

                           
                            </div>


                               <div class="col-md-6 col-sm-6 col-12 mt-3">

                <div class="form-group ">
                                    <label class="d-block">Status</label>
                                   <select class="form-control changestatus" name="status" data-id="{{ $joinus->id}}" disabled >

                        @foreach($join_us_status as $join_us_all_status)
                         
                          <option value="{{ $join_us_all_status->value }}" {{ $join_us_all_status->value == $joinus->status ? 'selected':'' }} > {{ $join_us_all_status->name }}</option>         
                        @endforeach
 
            
 
                      </select>
                                </div>


                   
            </div>


                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group mt-3">
                    <label>Interested City  </label>
                   
                     @php
                     if(json_decode($joinus->interested_city)[0] == ""){
                        echo '<li class="p-2 border text-center mb-2" style="width:400px;">No Preference</li>';
                     }
                     @endphp 
                   
                    
                  <ul>
                    
                     @foreach ($interested_city as $interested_city_list)
                        <li class="p-2 border text-center mb-2" style="width:400px;">{{ $interested_city_list->city}}</li>
                    @endforeach

                  </ul>

                </div>
              </div>
              
            
        
 
                                
             






         




              </div>

           

      

            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection