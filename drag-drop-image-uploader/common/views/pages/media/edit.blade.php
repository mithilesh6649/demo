@extends('adminlte::page')

@section('title', 'Super Admin | Add banner Image')

@section('content_header')
 

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Edit Media</h3>
            <a class="btn btn-sm btn-success"href="{{route('media-page.edit',$page_slug)}}">{{ __('adminlte::adminlte.back') }}</a>
          </div>                
          <div class="card-body table form mb-0">
            
            <div class="tab_wrapper">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                   <form class="form-sample" method="post" action="{{route('media-section.save')}}" enctype="multipart/form-data"  id="form-section">
                        @csrf
                      <div class="card-body main_body form p-0">
                        <div class="upload_img row row_justify justify-content-center">
                          <input type="hidden" name="id" value="{{$data->id}}" id="id">
                          <input type="hidden" name="page_slug" id="page_slug" value="{{$page_slug}}">
                          <!-- <label>{{$data->image_width}} x {{$data->image_height}}</label> -->
                        <div class="exsist_image img_upload_one" style="display: {{$data->image?'block':'none'}}">
                           <img style="object-fit:contain;" src="{{asset('media/'.$data->image)}}">
                           <label>Upload Image</label>
                           <i class="remove_image fa fa-times" aria-hidden="true" id="{{$data->id}}"></i>
                         </div>
                      
                        <div class="new_image img_upload_one" style="display: {{$data->image?'none':'block'}}" style="display:none;">
                          <img id="image_pre" src="{{asset('images/add-image.png')}}" alt="">
                          <label>Upload Image</label>
<!--                           <img id="image_pre" src="images/add-image.png" class="upload_img" width="100" height="100px"> -->
                           <i class="remove_temp_image remove_image_new fa fa-times" aria-hidden="true" style="display: none;"></i>
                          <input type="file" name="Media_image" id="product_image" accept=".png, .jpg, .jpeg">
                       </div>
                          <input type="hidden" name="error_msg" id="error_msg" value="">
                        </div>
                        <input type="submit" name="save" class="button btn_bg_color mt-4 common_btn text-white" value="Save">
                      </div>
                    </form>
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

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

<style>

#profileImage {
  height: 150px;
  width: 200px;
  border-radius: 10px;
  object-fit: contain;
  background-color: #fbfbfb;
  border: 1px solid #343d49;
  padding: 10px;
}
.messageArea {
  margin-left: 0;
  padding-left: 0;
}
.my-message {
  margin-right: 10px;
  background: #ebebeb;
  color: #333333;
  border-radius: 10px;
  padding: 10px;
  max-width: 50vw;
  display: inline-block;
  position: relative;
  margin-bottom: 22px;
}
.my-name {
  font-weight: bolder;
  margin-right: 0px;
}
.my-content {
  margin-top: 0px;
  margin-bottom: 0px;
}
.my-message:after {
  content: '';
  position: absolute;
  width: 0;
  height: 0;
  border-top: 15px solid #ebebeb;
  border-left: 15px solid transparent;
  border-right: 15px solid transparent;
  top: 0;
  right: -15px;
}
.my-message:before {
  content: '';
  position: absolute;
  width: 0;
  height: 0;
  border-top: 17px solid #ebebeb;
  border-left: 16px solid transparent;
  border-right: 16px solid transparent;
  top: 0px;
  right: -16px;
}
.butDel {
  width: 10px;
  height: 25px;
}
.butDelText {
  position: relative;
  right: 3.5px;
  top: -1px;
}
.another-message {
  margin-left: 10px;
  background: #263238;
  color: #ffffff;
  border-radius: 10px;
  padding: 10px;
  max-width: 50vw;
  display: inline-block;
  position: relative;
  margin-bottom: 22px;
}

</style>
@stop

@section('js')

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>

<script type="text/javascript">
  
$(document).ready(function(){

  $('#form-section').on('submit',function(e){
  
    var val=$('#error_msg').val();
    if(val)
    {
      return false;
    }
  })

$('#form-section').validate({
    ignore: [],
    debug: false,
    rules: {
      Media_image : {
        required:true,
      },
    
    },
    messages: {
     
      Media_image: {
        required:"Image is required",
      },
    }
  });
});

</script>

<script>


 $('.remove_image').click(function(){
    id = $(this).attr('id');
    swal({
          title: "Are you sure?",
          text: "Are you sure you want to delete?",
          type: "warning",
          showCancelButton: true,
        }, function(willDelete) {
          if (willDelete) {
           $.ajax({
                url: "{{route('media-section.delete')}}",
                type: 'post',
                data:{'id':id,"_token":"{{ csrf_token()}}" },
                success: function(data) {

                  $(".exsist_image").css('display','none');
                  $(".new_image").css('display','block');
              }
          });
        } 
      });
 });

    $("#product_image").change(function(evt){

        const [file] = product_image.files
        if (file) {

          if(file.type=="image/png" || file.type=="image/jpeg" ||  file.type=="image/jpg")
          {
             if(file.size>10546513)
            {

               toastr.error("File size should be less then 8 MB");
            }else{
                 // $('#product_image').css('display','none');
                 // $('#image_pre').css('display','block');
                 // $('.remove_temp_image').css('display','block');
                
                 image_pre.src = URL.createObjectURL(file);
                 image_pre.onload = function() {
                 width = image_pre.naturalWidth;
                 height = image_pre.naturalHeight;
                 console.log(width);
                 console.log(height);

                 if(width=={{$data->image_width}} && height=={{$data->image_height}} )
                 {
                  $('#product_image').css('display','none');
                  $('#image_pre').css('display','block');
                  $('.remove_temp_image').css('display','block');
                  $('#error_msg').val('');
                 }else{
                  
                  toastr.error('Please upload an image with {{$data->image_width}} x {{$data->image_height}} pixels dimension');
                  $('#product_image').css('display','block');
                  //$('#image_pre').css('display','block');
                  $('#error_msg').val(1);
                   //$('.remove_temp_image').css('display','none');
                  }
              }

            }
          }
          else{

             alert("Invalid File type !");
          }
      }
    });

    $(".remove_temp_image").click(function(evt){
         $("#product_image").val('');
         $('#image_pre').attr('src',"{{asset('images/add-image.png')}}");
         $('#product_image').css('display','block');
        //  $('#image_pre').css('display','none');
          $('.remove_temp_image').css('display','none');
      });
</script>
@stop

