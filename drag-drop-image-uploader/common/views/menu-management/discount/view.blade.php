@extends('adminlte::page')
@section('title', 'Super Admin | Menu Category Details')
@section('content_header')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Category Details</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body p-0">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form id="addCategoryForm" method="post" action="{{ route('categories.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body form">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group">
                                    <label>Name{{ labelEnglish() }}</label>
                                    <input type="text" name="name_en" class="form-control" id="name_en" value="{{ $category->name_en ?? ''  }}"  readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group">
                                    <label>Name{{ labelArabic() }}</label>
                                    <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{ $category->name_ar ?? ''}}" readonly>
                                </div>
                            </div>
                            <!--Description in english -->
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label>Description{{ labelEnglish() }}</label>
                                    <div class="description" name="description_en" >{!!$category->description_en ?? 'N/A' !!}
                                    </div>
                                </div>
                            </div>
                            <!--Description in english -->  
                            <!--Description in english -->
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label>Description{{ labelArabic() }}</label>
                                    <div class="description" name="description_ar">
                                        {!! $category->description_ar ?? 'N/A' !!}
                                    </div>
                                </div>
                            </div>
                            <!--Description in english -->  
                      
                            
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label class="d-block">Thumbnail</label>
                                    <div class="description" 
                                      @if($category->image_name != null)
                                    </div>
                                    <img src="{{ url('categories/thumbnail')}}/{{$category->image_name}}" id="thumbnail_preview" style="width:300;height:130px;cursor: pointer;"  class="category_image">
                                    @else
                                      N/A
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                    <label>Status</label>
                                        <select disabled class="form-control" name="status">
                                        <option value="1" {{ $category->status == 1 ? 'selected':''  }}  >Active</option>
                                        <option  value="0" {{ $category->status == 0 ? 'selected':''  }}  >Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                              <div class="form-group mt-3">
                                <label for="name_ar">Category Position #</label>
                                <input type="integer" min="1"  name="category_position" class="form-control" id="category_position" value="{{ $category->category_position ??' '}}" maxlength="100" readonly>
                                @if($errors->has('name_ar'))
                                <div class="error">{{ $errors->first('name_ar') }}</div>
                                @endif
                              </div>
                           </div>
                        </div>
                      </div>
                    </form>
                
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Category Thumbnail</h5>
                              <button type="button" class="close"
                                  data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">
                                      ×
                                  </span>
                              </button>
                            </div>
                            <div class="modal-body" class="image_preview">
                              <div class="carousel-inner" style=" width:100%; height:400px !important;">
                                <div class="carousel-item  active"  >
                                  <img class="d-block " style="width: 100%; height: 400px;"     src="{{url('categories/thumbnail')}}/{{$category->image_name}}" alt="First slide">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

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
  $(document).ready(function(){
    $('.click_me').click(function(){
       $('#exampleModal').modal('show');
    });
  });


  $(document).ready(function(){
   $('.category_image').each(function(){
     $(this).click(function(){
         
        

          
          $('#exampleModal').modal('show');

       

        
     });
   });
  });



   $(document).ready(function(){
 
  $('.carousel').carousel({
  interval: false,
});
 });



</script>



@stop
