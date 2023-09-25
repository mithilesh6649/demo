@extends('adminlte::page')

@section('title', 'Edit  Designation')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Edit Designation</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body table p-0 mb-0">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <form id="editDesignation" method="post" action="{{ route('designations.update') }}">
              @csrf
              <div class="card-body mb-0">
                @if ($errors->any())
                  <div class="alert alert-warning">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="information_fields mb-0">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="driver">Designation<span class="text-danger"> *</span></label>
                        <input type="hidden" name="id" value="{{ $designations->id }}">
                        <input type="text" name="designation" class="form-control" id="designation" value=" {{$designations->designation}}" maxlength="100">
                        <div id ="function_error" class="error"></div>
                     
                      </div>
                    </div>
                   
                     <div class="col-md-6">
                      <div class="form-group">
                        <label>Status</label>
                          <select class="form-control" name="status">
                              <option value="1" {{ $designations->status == 1 ? 'selected':''  }}  >Active</option>
                              <option  value="0" {{ $designations->status == 0 ? 'selected':''  }}  >Inactive</option>
                          </select>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="text" class="button btn_bg_color common_btn text-white" >{{ __('adminlte::adminlte.update') }}</button>
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
  <script>
    $(document).ready(function() {
      $('#editDesignation').validate({
        ignore: [],
        debug: false,
        rules: {
          designation: {
            required: true
          },
        },
        messages: {
          designation: {
            required: "Designation  is required"
          },
        }
      });
    });
  </script>
@stop
