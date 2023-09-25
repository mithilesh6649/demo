@extends('adminlte::page')

@section('title', 'Super Admin |Add Review')

@section('content_header')


@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
               <h3>Add Review</h3>
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body">
               <form class="form_wrap" id="addReviewsForm" method="post" action="{{ route('reviews.save') }}">
                  <div class="row">
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Customer Name <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="name" maxlength="100" />
                        </div>
                     </div>
                     <!--      <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>    
                          </select>
                        </div>
                        </div>
                     -->
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-2">
                        <div class="form-group ">
                           <label for="status">Status </label> 
                           <select class="form-control" name="status" id="status">
                              @foreach($status as $status_data)
                              <option value="{{$status_data->value}}">{{$status_data->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                        <div class="form-group mt-3">
                           <label>Message <span class="text-danger">*</span></label>
                           <textarea class="form-control" name="message" maxlength="250"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="button btn_bg_color common_btn text-white">Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection

@section('css')
@stop

@section('js')


<script> 
  $(document).ready(function() {
    
   $('#addReviewsForm').validate({
     ignore: [],
     
     rules: {
        name: {
         required: true
      },
      status: {
         required: true
      },
      message: {
         required: true,
         maxlength:250
      },
      
   },
   messages: {
     name: {
      required: "Customer Name is required"
   },
   status: {
      required: "Status is required"
   },
   message: {
      required: "Message  is required",
      maxlength:"Message Only 250 characters"
   },
}
});

   
   

});
</script>


@stop
