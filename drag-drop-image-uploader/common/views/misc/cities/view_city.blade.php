@extends('adminlte::page')

@section('title', 'City Details')

@section('content_header')
 

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>City Details</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>            
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              <form class="form_wrap">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label>City name {{ labelEnglish() }}</label>
                      <input class="form-control" placeholder="{{ $city->city }}" readonly>
                    </div>
                  </div>

                      <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label>City name {{ labelArabic() }}</label>
                      <input class="form-control" placeholder="{{ $city->city_ar ?? 'N/A' }}" readonly>
                    </div>
                  </div>


                                 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                        <div class="form-group mt-3">
                        <label>Blocks</label>
                          <select disabled data-placeholder="Select Blocks" multiple
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

                  
                  <div class="col-6">
                    <div class="form-group">
                      <label>Created At</label>
                      <input class="form-control" placeholder="{{ $city->created_at ? date('d/m/Y', strtotime($city->created_at)) : '' }}" readonly>
                    </div>
                  </div>
                  
                  <div class="col-6">
                    <div class="form-group">
                      <label>Updated At</label>
                      <input class="form-control" placeholder="{{ $city->updated_at ? date('d/m/Y', strtotime($city->updated_at)) : '' }}" readonly>
                    </div>
                  </div>
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
 



        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",

        })

  </script>
@stop
