@extends('adminlte::page')
@section('title', 'Import CSV File')
@section('content_header')
@section('content')


<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">Upload Zip file</h3>
                            <a class="btn btn-sm btn-success add-advance-options"
                            href="{{ route('food.list') }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body main_body form p-3">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                               <form id="addCityForm" method="post" action="{{route('food.upload')}}" enctype="multipart/form-data">
                <span class="badge badge-pill badge-danger p-2 mb-3">Note :- Please Upload a food Zip file . The folder must be named "food". </span>
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
                <div class="information_fields">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="city">Upload a Food Zip<span class="text-danger"> *</span></label>
                        <input type="file" name="file" class="form-control"  maxlength="100" accept="application/zip">
                        <div id ="function_error" class="error"></div>
                        @if($errors->has('city'))
                          <div class="error">{{ $errors->first('city') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="text" class="btn btn-primary" >Upload</button>
              </div>
            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />



@stop
@section('js')
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<!-- <script src="{{ asset('docsupport/jquery-3.2.1.min.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
</script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
<script>
    $(document).ready(function(){


        const container = document.getElementById('edamam_food_list');
        let nextPageUrl = '' ;
        container.addEventListener('scroll', function() {
          if (container.scrollTop + container.clientHeight >= container.scrollHeight) {

                // User has scrolled to the bottom of the container
                // Make AJAX call here to fetch more content
             console.log('next page url', nextPageUrl);
             $.ajax({
              type:"POST",
              url:"{{route('get.edamam.food')}}",
              data:{
               'next_page_url':nextPageUrl
           },
           dataType: "JSON",
           beforeSend:function(){
             $('#edamam_food_list_msg').html('Loading...');
         },
         success: function(response) {
            console.log(response);
            $('#edamam_food_list_msg').html('');
            $('#edamam_food_list').append(response.html);
            nextPageUrl = response.next_page_url;
            console.log('next page url lla', nextPageUrl);
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });


         }
     });




        $('#search_food').on('input',function(){
          var value = $(this).val();
          if(value.length == 0){
              $('#edamam_food_list').html('');
          }
      });

        $('#search_food').keypress(function(event) {
          if (event.keyCode === 13) {
            event.preventDefault(); // prevent default behavior of "Enter" key
            var inputValue = $(this).val(); // get the input value
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
              type:"POST",
              url:"{{route('get.edamam.food')}}",
              data:{
               'ingr':inputValue
           },
           dataType: "JSON",
           beforeSend:function(){
              $('#edamam_food_list').html('Loading...');
          },
          success: function(response) {
            console.log(response);
            nextPageUrl = response.next_page_url;

            $('#edamam_food_list').html(response.html);
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
        }
    });


    });

    $(document).on('click','.food_add',function(){
     var currentObj = this;  

     var getFoodId = $(this).attr('food-id');
     var getFoodImage = $(this).attr('food-image');
         // alert(getFoodId);
     $.ajax({
      type:"POST",
      url:"{{route('add.edamam.food.by.id')}}",
      data:{
       'food_id':getFoodId,
       'food_image':getFoodImage,
   },
   dataType: "JSON",
   beforeSend:function(){
     $(currentObj).html('Processing...');
 },
 success: function(response) {
  console.log(response);
  toastr.success('Food added Successfully');
  $(currentObj).attr('disabled',true);
  $(currentObj).removeClass('btn-primary');
  $(currentObj).addClass('btn-success');
  $(currentObj).html('Added');
                // $('#edamam_food_list').html(response.html);
},
error: function(xhr) {
    console.log(xhr.responseText);
}
});
 });
</script>


@stop
