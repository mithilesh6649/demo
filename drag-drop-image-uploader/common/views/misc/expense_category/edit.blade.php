@extends('adminlte::page')

@section('title', 'Edit Petty Expense Category')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Edit Petty Expense Category</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              <form id="editCityForm" method="post" action="{{ route('update_expense_category') }}">
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
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="city">Petty Expense Category Name<span class="text-danger"> *</span></label>
                          <input type="hidden" name="id" value="{{ $city->id }}">
                          <input type="text" name="cat_name" class="form-control" id="city" value="{{ $city->cat_name }}" maxlength="100">
                          <div id ="function_error" class="error"></div>
                          @if($errors->has('city'))
                            <div class="error">{{ $errors->first('city') }}</div>
                          @endif
                        </div>
                      </div>
                     
                       <div class="col-md-6">
                        <div class="form-group">
                          <label>Status</label>
                                      <select class="form-control" name="status">
                                          <option value="1" {{ $city->status == 1 ? 'selected':''  }}  >Active</option>
                                          <option  value="0" {{ $city->status == 0 ? 'selected':''  }}  >Inactive</option>
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
      $('#editCityForm').validate({
        ignore: [],
        debug: false,
        rules: {
          cat_name: {
            required: true
          },
        },
        messages: {
          cat_name: {
            required: "Petty expense category name  is required"
          },
        }
      });
    });
  </script>
@stop
