@extends('adminlte::page')
@section('title', 'Super Admin |  Category Details')
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
                     <div class="card-body table form mb-0">
                        <div class="row">
                           <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                              <div class="form-group">
                                 <label>Name{{ labelEnglish() }}</label>
                                 <input type="text" name="name_en" class="form-control" id="name_en" value="{{ $category->name_en ?? 'N/A' }}"  readonly>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                              <div class="form-group">
                                 <label>Name{{ labelArabic() }}</label>
                                 <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{ $category->name_ar ?? 'N/A'}}" readonly>
                              </div>
                           </div>
                           <!--Description in english -->
                           <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                              <div class="form-group mt-3">
                                 <label>Description{{ labelEnglish() }}</label>
                                 <textarea readonly>{!!$category->description_en ?? 'N/A' !!}
                                 </textarea>
                              </div>
                           </div>
                           <!--Description in english -->  
                           <!--Description in english -->
                           <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                              <div class="form-group mt-3">
                                 <label>Description{{ labelArabic() }}</label>
                                 <textarea readonly>{!! $category->description_ar ?? 'N/A' !!}</textarea>
                              </div>
                           </div>
                           <!--Description in english -->  
                           <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                              <div class="form-group mt-3">
                                 <label class="image d-block">Image</label>
                                 @if($category->image_name!="")
                                 <div class="upload-img" style="width:250px;">
                                    <img src="{{ url('categories/thumbnail')}}/{{$category->image_name}}" id="thumbnail_preview" style="width: 100%;height:100%;cursor: pointer;margin-top: 0;"  class="category_image">
                                 </div>
                                 @else
                                 <img src="" alt="Image">
                                 @endif
                              </div>
                           </div>
                           <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                              <div class="form-group mt-3">
                                 <label>Status</label>
                                 <select disabled class="form-control" name="status">
                                    @foreach($status as $status_data)
                                    <option @if($status_data->value==$category->status) selected @endif>{{$status_data->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>



                        </div>
                     </div>
                  </div>



               <label class="mb-3 mt-3">Select Branch
                <a class="btn info_btn" data-toggle="tooltip" data-placement="right"
                title="Select Branch and Category/ Menu Item">
                <i class="fa fa-question-circle"></i>
             </a>
          </label>


          <div>
           <div class="btn-group d-flex flex-wrap justify-content-between w-100">
             <div class="left_tab">
               <button type="button" class="btn btn-warning w-100"
               id="branch-modal">Branch</button>
               <div class="border mt-3 edit" id="all_selected_branch_container">
                 <ul id='show_all_selected_branch'>
                   @foreach ($category->BranchMenuCategory  as $d_branch)
                   <li><strong class="list-text">
                     {{ @$d_branch->branch->title_en }}</strong></li>
                     @endforeach
                  </ul>
               </div>
            </div>

         </div>
      </div>
         </div>

   </form>
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Category Image</h5>
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
<style type="text/css">
  .form-group textarea{
    height: 90px !important;
 }
</style>
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
