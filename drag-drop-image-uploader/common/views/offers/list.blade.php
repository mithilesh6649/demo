@extends('adminlte::page')

@section('title', 'Add Contest')

@section('content_header')
@stop

@section('content')
<?php
error_reporting(0);
?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Add</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addAdminForm" method="post", action="{{route('lotteries.save')}}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">                
                <div class="row">
                    
                    <div class="col-md-6">
                       <div class="form-group">
                          <label for="cat_id"> Contest Name<span
                             class="text-danger"> *</span></label>
                          <select class="advance_category_search contest_id form-control"
                             name="contest_id" id="contest_id">
                             <option value="">Select  Contest</option>
                             @forelse ($allContests as $allContest)
                             <option value="{{ $allContest->id }}">
                                {{ $allContest->name }}
                             </option>
                             @empty
                             @endforelse
                          </select>
                       </div>
                    </div>
                    
                       <div class="col-6">
                    <div class="form-group">
                      <label for="name">Draw Type<span class="text-danger"> *</span></label>
                       <select class="advance_category_search draw_type form-control"
                             name="draw_type" id="draw_type">
                             <option value="">Draw Type</option>
                             <option value="manual">Manual</option>
                             <option value="auto">Auto</option>
                          </select>
                      
                    </div>
                  </div>
                    
                  <div class="col-6">
                    <div class="form-group">
                      <label for="name">Ticket Quantity<span class="text-danger"> *</span></label>
                      <input type="number" name="ticket_quantity" class="form-control" id="ticket_quantity" maxlength="100">
                    </div>
                  </div>
                  
                    <div class="col-6">
                    <div class="form-group">
                      <label for="name">Available Ticket<span class="text-danger"> *</span></label>
                      <input type="number" name="available_tickets" class="form-control" id="available_tickets" maxlength="100">
                    </div>
                  </div>
                  
                
                  
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                    <div class="form-group "> <label for="start_date">Start Date<span class="text-danger"> *</span></label> <input type="date" name="start_date" class="form-control" id="start_date" maxlength="100"> </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                  <div class="form-group  "> <label for="end_date">End Date<span class="text-danger"> *</span></label> <input type="date" name="end_date" class="form-control" id="end_date" maxlength="100"> </div>
                                </div>
                                
                                 <div class="col-6">
                    <div class="form-group">
                      <label for="name">Number Of Winner<span class="text-danger"> *</span></label>
                      <input type="number" name="number_of_winners" class="form-control" id="number_of_winners" maxlength="100">
                    </div>
                  </div>
                  
                    <div class="col-6">
                    <div class="form-group">
                      <label for="name">Price For Winner<span class="text-danger"> *</span></label>
                      <input type="number" name="price_for_winner" class="form-control" id="price_for_winner" maxlength="100">
                    </div>
                  </div>
                  
                      <div class="col-6">
                    <div class="form-group">
                      <label for="name">Select Game Status<span class="text-danger"> *</span></label>
                       <select class="advance_category_search game_status form-control"
                             name="game_status" id="game_status">
                             <option value="">Select Game Status</option>
                             <option value="scheduled">Scheduled</option>
                             <option value="live">Live</option>
                             <option value="completed">Completed</option>
                          </select>
                      
                    </div>
                  </div>
                  
                  
                      <div class="col-6">
                    <div class="form-group">
                      <label for="name">Status<span class="text-danger"> *</span></label>
                       <select class="advance_category_search draw_type form-control"
                             name="status" id="status">
                            
                             <option value="1">Active</option>
                             <option value="0">Inactive</option>
                          </select>
                      
                    </div>
                  </div>
                  
                   
               </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="text" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    
  <script>
    $(document).ready(function() {
      $('#addAdminForm').validate({
        ignore: [],
        debug: false,
        rules: {
          contest_id: {
            required: true,
          },
          ticket_quantity: {
            required: true
          },
          available_tickets: {
            required: true
          },
          start_date: {
            required: true
          },
           end_date: {
            required: true
          },
           draw_type: {
            required: true
          },
           number_of_winners: {
            required: true
          },
           price_for_winner: {
            required: true
          },
          game_status:{
            required:true
          }
        },
        messages: {
          name: {
            required: "The Name is required."
          },
          description: {
            required: "The Description is required."
          },
          price: {
            required: "The Price is required."
          },
          image: {
            required: "The Contest Image is required."
          },
        }
      });
    });
    
     $(".contest_id").select2({
            placeholder: "Select Contest ",
        });
        
        $(".draw_type").select2({
        placeholder: "Select Draw Type ",
        });
        
        $(".game_status").select2({
        placeholder: "Select Game Status ",
        });
  </script>
@stop
