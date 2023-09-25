@extends('adminlte::page')

@section('title', 'Subscribers Details')

@section('content_header')
 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Subscribers Details</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
           
            <form class="form_wrap">
              <div class="row">
                
                <div  class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" placeholder="{{ $ParticularSubscriber->email ?? '' }}" readonly>
                  </div>
                </div>

               <div  class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input class="form-control" placeholder="{{ $ParticularSubscriber->phone_number  ?? '' }}" readonly>
                  </div>
                </div>
            
             <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                <div class="form-group  ">
                    <label>Date of Birth</label>
                  <input class="form-control px-0" placeholder="{{$ParticularSubscriber->date_of_birth ?? '' }}" readonly>
                </div>
              </div>


                   <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group  ">
                        <label for="email">Status </label>
                        <select class="form-control"  disabled>
                          <option value="0" {{ $ParticularSubscriber->status== 0 ? 'selected':'' }}>Unsubscribed  </option>
                          <option  value="1" {{ $ParticularSubscriber->status== 1 ? 'selected':'' }}>Subscribed</option>
                        </select>
                      </div>
                    </div>


                
             <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                <div class="form-group  ">
                    <label>Subscribed At</label>
                  <input class="form-control px-0" placeholder="{{date('d/m/Y ',strtotime($ParticularSubscriber->created_at)) }}" readonly>
                </div>
              </div>
            
            
             <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mb-3 {{ $ParticularSubscriber->status == 1 ? 'd-none':'' }} ">
                <div class="form-group  ">
                    <label>Reason</label>
                  <textarea class="form-control px-0" readonly style="height:60px;">{{ $ParticularSubscriber->reason ?? 'N/A'  }}
                  </textarea>
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