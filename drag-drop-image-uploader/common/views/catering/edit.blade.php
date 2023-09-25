@extends('adminlte::page')

@section('title', 'Super Admin | Edit Catering Order details')

@section('content_header')
 

@section('content')
  
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Edit Catering Order  info</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body p-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <form id="editCatering" method="post" action="{{route('catering.update')}}">
                @csrf
                <div class="card-body form">
                  <input type="hidden" name="cate_id" value="{{ $cateringList->id }}">
                  <div class="row">
        
                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group">
                        <label>First name <span class="text-danger"> *</span></label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{$cateringList->first_name ?? ''}}" maxlength="100" >
                       
                        @if($errors->has('item_name'))
                          <div class="error">{{ $errors->first('item_name') }}</div>
                        @endif
                      </div>
                    </div>
   
                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group">
                        <label>Last name <span class="text-danger"> *</span></label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{$cateringList->last_name ?? ''}}"  maxlength="100"	>
                       
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>


                      <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mt-3">
                        <label>Phone Number <span class="text-danger"> *</span></label>
                        <input type="number" name="phone_number" class="form-control" id="phone_number" value="{{$cateringList->phone_number ?? ''}}" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mt-3">
                        <label>Email <span class="text-danger"> *</span></label>
                        <input type="email" name="email" class="form-control" id="email" value="{{$cateringList->email ?? ''}}" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mt-3">
                        <label>Menu Type <span class="text-danger"> *</span></label>
                          <select class="form-control changestatus" name="menu_type"  >
                        @foreach ($menu_type as $menu_type)

                       <option value="{{$menu_type->value}}"  {{ $menu_type->value == $cateringList->menu_type ? 'selected':'' }} > {{ $menu_type->value }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mt-3">
                        <label>Celebration Type <span class="text-danger"> *</span></label>
                       <select class="form-control changestatus" name="celebration_type"  >
                        @foreach ($celebration_type as $celebration_type)

                       <option value="{{$celebration_type->value}}"  {{ $celebration_type->value == $cateringList->celebration_type ? 'selected':'' }} > {{ $celebration_type->value }}</option>
                          @endforeach
   
                        </select>                      
                      </div>
                    </div>


                       <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mt-3">
                        <label>City<span class="text-danger"> *</span></label>
                        <input type="text" name="city" class="form-control" id="city" value="{{$cateringList->city->city ?? ''}}" readonly>
                      </div>
                    </div>

                    
                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group mt-3">
                        <label>Date of Celebration <span class="text-danger"> *</span></label>
                        <input type="date" name="date_of_celebrations" class="form-control" id="status" value="{{$cateringList->date_of_celebrations }}"  >
                      </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group mt-3">
                        <label>Status <span class="text-danger"> *</span></label>
                        
                        <select class="form-control changestatus" name="status"  >
                        @foreach ($catering_order_status as $order_status)

                       <option value="{{$order_status->value}}"  {{ $order_status->value == $cateringList->status ? 'selected':'' }} > {{ $order_status->name }}</option>
                          @endforeach
   
                        </select>
                      </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group mt-3">
                        <label>Address <span class="text-danger"> *</span></label>
                         
                         <textarea name="complete_address" style="height:120px;" maxlength="500">{{$cateringList->complete_address ?? ''}}</textarea>
                       
                        @if($errors->has('status'))
                          <div class="error">{{ $errors->first('status') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="card-footer">
                  <button type="btn"  class="button btn_bg_color common_btn text-white">Update</button>
                </div>
              </form>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $("select.multiple").select2();
    $(document).ready(function() {
      
      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      }, "The Contact Number must be in numbers only.");
      $('#editCatering').validate({
        ignore: [],
        debug: false,
        rules: {
          first_name: {
            required: true,
            noSpace:true
          },
          last_name: {
            required: true,
            noSpace:true
          },
          date_of_celebrations:{
          	 required:true,
          },
          complete_address:{
          	required:true,
          },


      
           
        },
        messages: {
          first_name: {
            required: "First name is required",
          },
          last_name: {
            required: "Last name is required",
          },
          date_of_celebrations: {
            required: "Date of celebration is required",
          },
          complete_address:{
          	required:"Address is required",
          }, 
          
        }
      });


        $.validator.addMethod("noSpace", function(value, element) { 
            return $.trim(value).length!=0; 
        }, "No space please and don't leave it empty");

        $.validator.addMethod("pass_check", function(value, element) {
            var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/; 
            return value.match(regex); 
        }, "Password must be 8 characters long containing atleast one upper case, one lower case and one number.");

    });
  </script>


  <!-- show image on change -->
  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#thumbnail_preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <!-- show image on change -->


@stop
