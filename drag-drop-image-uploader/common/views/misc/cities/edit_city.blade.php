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
            <h3>{{ __('adminlte::adminlte.edit_city') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body table p-0 mb-0">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <form id="editCityForm" method="post" action="{{ route('update_city') }}">
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
                        <label for="city">City name {{ labelEnglish() }}<span class="text-danger"> *</span></label>
                        <input type="hidden" name="id" value="{{ $city->id }}">
                        <input type="text" name="city" class="form-control" id="city" value="{{ $city->city }}" maxlength="100">
                        <div id ="function_error" class="error"></div>
                        @if($errors->has('city'))
                          <div class="error">{{ $errors->first('city') }}</div>
                        @endif
                      </div>
                    </div>
                    


                             <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="city">City name {{ labelArabic() }}<span class="text-danger"> *</span></label>
                          <input type="text" name="city_ar" class="form-control" id="city_ar" maxlength="100" value="{{ $city->city_ar }}">
                          <div id ="city_ar" class="error"></div>
                         
                        </div>
                      </div>


                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                        <div class="form-group mt-3">
                        <label>Blocks</label>
                          <select data-placeholder="Select Blocks" multiple
                                                                class="chosen-select form-control" name="blocks_id[]"
                                                                id="managers">
                                                                <option value="" disabled>Select Block</option>
                                                                @forelse ($blocks as $manager)
                                                                    <option value="{{ $manager->id }}"
                                                                        @foreach ($CityBlock as $mm)
                  @if ($mm['block_id'] == $manager->id)
                  selected
                  @endif @endforeach>
                                                                        {{ $manager->block ?? ' ' }}  
                                                                        </option>
                                                                @empty
                                                                    <option disabled>Block Not Found
                                                                    </option>
                                                                @endforelse
                                                            </select>
                        </div>
                        </div>


                     <div class="col-md-12 mb-3">
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
     <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
     
    <link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />

  <script>
    $(document).ready(function() {
      $('#editCityForm').validate({
        ignore: [],
        debug: false,
        rules: {
          city: {
            required: true
          },
              city_ar:{ 
            required:true,
          },
        },
        messages: {
          city: {
            required: "City name (en) is required"
          },
          city_ar:{ 
            required:"City name (ar) is required"
          },
        }
      });
    });



        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",

        })

  </script>
@stop
