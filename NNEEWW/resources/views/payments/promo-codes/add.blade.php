@extends('adminlte::page')

@section('title', 'Add Promo Code')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Add Promo Code</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addSchoolForm" method="post" action="{{route('promo_codes.save')}}">
              @csrf
              <div class="card-body">
                @if ($errors->any())
                  <div class="alert alert-warning">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="name" class="pb-2">Name<span class="text-danger"> *</span></label>
                      <input type="text" name="name" class="form-control" id="name" maxlength="100">
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="description" class="pb-2">Description<span class="text-danger"> *</span></label>
                      <input type="text" name="description" class="form-control" id="description" maxlength="100">
                      @if($errors->has('description'))
                        <div class="error">{{ $errors->first('description') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="percentage_off" class="pb-2">Percentage Off<span class="text-danger"> *</span></label>
                      <input type="text" name="percentage_off" class="form-control" id="percentage_off" maxlength="100">
                      @if($errors->has('percentage_off'))
                        <div class="error">{{ $errors->first('percentage_off') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="type" class="pb-2">Status<span class="text-danger"> *</span></label>
                      <select name="status" class="form-control" id="status">
                        <option value="" selected disabled="">Select</option>

                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        
                      </select>  
                      @if($errors->has('status'))
                        <div class="error">{{ $errors->first('status') }}</div>
                      @endif
                    </div>
                  </div>


              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="text" class="btn btn-primary" >{{ __('adminlte::adminlte.save') }}</button>
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
      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      }, "The Contact Number must be in numbers only.");
      $('#addSchoolForm').validate({
      
        rules: {
          name: {
            required: true,
            noSpace:true
          },
          description: {
            required: true,
            noSpace:true
          },
          status: {
            required: true
          },
          percentage_off: {
            required: true,
            noSpace:true,
            check_float : true
          },
        },
        messages: {
          name: {
            required: "The Promo Code Name is required."
          },
          description: {
            required: "The Description is required."
          },
          type: {
            required: "The Status is required."
          },
          percentage_off: {
            required: "The Percentage Off is required."
          },
        }
      });

      $.validator.addMethod("noSpace", function(value, element) { 
        return $.trim(value).length!=0; 
      }, "No space please and don't leave it empty");

      $.validator.addMethod("check_float", function(value, element) { 
        return /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/.test(value) && value<=100; 
      }, "Please specify a valid value for percentage");

    });
  </script>
@stop
