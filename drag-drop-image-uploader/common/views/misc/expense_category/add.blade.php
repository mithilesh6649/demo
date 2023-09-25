@extends('adminlte::page')

@section('title', 'Add Petty Expense Category')

@section('content_header')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3> Add Petty Expense Category</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              <form id="addCityForm" method="post" action="{{ route('save_expense_category') }}">
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
                          <label for="city">Petty Expense Category Name<span class="text-danger"> *</span></label>
                          <input type="text" name="cat_name" class="form-control" id="city" maxlength="100">
                           
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="text" class="button btn_bg_color common_btn text-white" >{{ __('adminlte::adminlte.save') }}</button>
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
      $('#addCityForm').validate({
        ignore: [],
        debug: false,
        rules: {
          cat_name: {
            required: true,
                    remote:{
                  type:"post",
                  url:"{{route('check_city')}}",
                  data: {
                        "city": function() { return $("#city").val(); },
                        "_token": "{{ csrf_token() }}",
                        
                      },
                      dataFilter: function (result) {
                       var json = JSON.parse(result);
                                    if (json.msg == 1) {
                                        return "\"" + "City name already  exist" + "\"";
                                    } else {
                                        return 'true';
                                    }
                      }    
                }
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
