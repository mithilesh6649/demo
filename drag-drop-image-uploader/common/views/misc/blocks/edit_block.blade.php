@extends('adminlte::page')

@section('title', 'Edit City')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Edit Block</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body table p-0 mb-0">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <form id="editblockForm" method="post" action="{{ route('update_blocks') }}">
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
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="block">Block<span class="text-danger"> *</span></label>
                        <input type="hidden" name="id" value="{{ $block->id }}">
                        <input type="text" name="block" class="form-control" id="block" value="{{ $block->block }}" maxlength="100">
                        <div id ="function_error" class="error"></div>
                        @if($errors->has('block'))
                          <div class="error">{{ $errors->first('block') }}</div>
                        @endif
                      </div>
                    </div>
                    

                

                          
                       <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                          <div class="form-group">
                             <label for="status">Status </label> 
                             <select class="form-control" name="status" id="status">
                             @foreach($status as $status_data)
                             <option value="{{$status_data->value}}" {{ $status_data->value == $block->status ? 'selected':'' }} >{{$status_data->name}}</option>
                             @endforeach
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
      $('#editblockForm').validate({
        ignore: [],
        debug: false,
        rules: {
          block: {
            required: true
          },
            
        },
        messages: {
          block: {
            required: "Block is required"
          },
          
        }
      });
    });
  </script>
@stop
