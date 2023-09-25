@extends('adminlte::page')

@section('title', 'Edit Petty Expense Sub Category')

@section('content_header')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3> Edit Petty Expense Sub Category</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              <form id="addCityForm" method="post" action="{{ route('update_expense_sub_category') }}">
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

                    <input type="hidden" name="id" value="{{ $city->id }}">
                  <div class="information_fields mb-0">
                    <div class="row">
                        <div class="col-md-6">

                             



                                    <div class="form-group mb-3">
                          <label for="city">Petty Expense   Category Name<span class="text-danger"> *</span></label>
                          <select class="advance_category_search catselect form-control" name="category_id" >
                                <option value="">Select Petty Expense Category</option>
                               
                                @forelse ($DailyPettyExpenseCategory as $allCateogry)
                                    <option  value="{{$allCateogry->id}}"   {{$city->category_id == $allCateogry->id ? 'selected':''}}>{{ $allCateogry->cat_name }}</option>
                                 @empty
                                     <option class="disabled">Category not found</option>
                                @endforelse

                              </select> 
                           
                        </div>

                      </div>


                       <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="city">Petty Expense Sub Category Name<span class="text-danger"> *</span></label>
                          <input type="text" name="sub_cat_name" class="form-control" id="city" maxlength="100" value="{{$city->sub_cat_name}}">
                           
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
<style>
    label#category_id-error{
    position: relative;
    top: 92px;
    left: -196px;
  }

</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


  <script>
    $(document).ready(function() {
      $('#addCityForm').validate({
        ignore: [],
        debug: false,
        rules: {
          sub_cat_name: {
            required: true,
          },
          category_id:{
            required:true,
          }
           
        },
        messages: {
          sub_cat_name: {
            required: "Petty expense sub category name  is required"
          },
          category_id:{
            required:"Petty expense category name is required "
          },
        }
      });
    });
  </script>


  <script type="text/javascript">
      $(".catselect").select2();
</script>
@stop
