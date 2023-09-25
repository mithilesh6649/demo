@extends('adminlte::page')

@section('title', 'Add ownership')

@section('content_header')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Add Ownership</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              <form id="addownerships" method="post" action="{{ route('ownerships.save') }}">
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
                  <div class="information_fields mb-0">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="ownership">Ownership Name<span class="text-danger"> *</span></label>
                          <input type="text" name="ownership" class="form-control" id="ownership" maxlength="100">
                          <div id ="function_error" class="error"></div>
                          @if($errors->has('ownership'))
                            <div class="error">{{ $errors->first('ownership') }}</div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="text" class="button btn_bg_color common_btn text-white" >Submit</button>
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
      $('#addownerships').validate({
        ignore: [],
        debug: false,
        rules: {
          ownership: {
            required: true,
                   
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
