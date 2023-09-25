@extends('adminlte::page')

@section('title', 'Edit Ownership')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Edit Ownership</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body table p-0 mb-0">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <form id="editOwnership" method="post" action="{{ route('ownerships.update') }}">
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
                        <label for="ownership">Ownership Name<span class="text-danger"> *</span></label>
                        <input type="hidden" name="id" value="{{ $owner->id }}">
                        <input type="text" name="ownership" class="form-control" id="ownership" value=" {{$owner->ownership_name}}" maxlength="100">
                        <div id ="function_error" class="error"></div>
                        @if($errors->has('ownership'))
                          <div class="error">{{ $errors->first('ownership') }}</div>
                        @endif
                      </div>
                    </div>
                   
                     <div class="col-md-6">
                      <div class="form-group">
                        <label>Status</label>
                          <select class="form-control" name="status">
                              <option value="1" {{ $owner->status == 1 ? 'selected':''  }}  >Active</option>
                              <option  value="0" {{ $owner->status == 0 ? 'selected':''  }}  >Inactive</option>
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
      $('#editOwnership').validate({
        ignore: [],
        debug: false,
        rules: {
          ownership: {
            required: true
          },
        },
        messages: {
          ownership: {
            required: "Ownership Name  is required"
          },
        }
      });
    });
  </script>
@stop
