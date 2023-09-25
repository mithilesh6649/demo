@extends('adminlte::page')

@section('title', 'Super Admin |Edit Category')

@section('content_header')
 

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Edit Category</h3>
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
                        <input type="hidden" name="category_id" value="{{ $category->id}}">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="name_en">Name{{ labelEnglish() }}<span class="text-danger"> *</span></label>
                                    <input type="text" name="name_en" class="form-control" id="name_en" value="{{ $category->name_en ?? ' '}}" maxlength="100">
                                    @if($errors->has('name_en'))
                                    <div class="error">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group">
                                     <label for="name_ar">Name{{ labelArabic() }}<span class="text-danger"> *</span></label>
                                    <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{ $category->name_ar ?? ' '}}" maxlength="100">
                                    @if($errors->has('name_ar'))
                                    <div class="error">{{ $errors->first('name_ar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!--Description in english -->
                            <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                <div class="form-group mt-3">
                                    <label for="description_en">Description{{ labelEnglish() }} </label>
                                    <textarea name="description_en">{{ $category->description_en ?? ' '}}
                                    </textarea>
                                </div>
                            </div>
                            <!--Description in english -->  
                            <!--Description in english -->
                            <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                <div class="form-group mt-3">
                                     <label for="description_ar">Description{{ labelArabic() }} </label>
                                    <textarea name="description_ar">{{ $category->description_ar ?? ' '}}
                                    </textarea>
                                </div>
                            </div>
                            <!--Description in english -->  
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                <div class="form-group mt-3">
                                     <label for="password_confirmation">Thumbnail </label>
 
                                    <input type="file" name="thumbnail" onchange="readURL(this);" class="form-control thumbnail_pic" accept="image/*">

                                    @if($errors->has('thumbnail'))
                                    <div class="error">{{ $errors->first('thumbnail') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-12  mb-3">
                                <div class="form-group mt-3">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="1" {{ $category->status == 1 ? 'selected':''  }}  >Active</option>
                                        <option  value="0" {{ $category->status == 0 ? 'selected':''  }}  >Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <!-- show thumbnail -->

                            <div class="row" style="position:relative;">
                                
                                 <a href="javascript:;" class="remove-pro-img  {{$category->image_name != null ? '':'d-none'}} delete_pdf" pdf_name="{{$category->image_name ?? ' '}}" current_id="{{$category->id}}"  style="display:block;position: absolute;right:-10px;top:-9px;">
                        <svg width="25" height="25" viewBox="0 0 257 256" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g clip-path="url(#clip0_2088_553)">
                          <path d="M254.85 141.81C253.9 157.47 249.21 172.11 241.97 185.85C222.7 222.45 192.59 244.9 152.18 253.57C150.9 253.85 149.55 253.82 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z" fill="#F7F9FA"/>
                          <path d="M254.85 141.81C251.98 142.27 250.79 139.87 249.24 138.32C230 119.18 210.83 99.9701 191.64 80.7801C190.08 79.2301 188.55 77.6401 186.86 76.2301C186.73 76.1101 186.6 76.0101 186.47 75.9101C186.37 75.8201 186.27 75.7401 186.17 75.6601C179.43 68.4101 174.9 68.2601 167.78 75.3201C156.31 86.6701 144.95 98.1401 133.52 109.53C128.75 114.28 128.21 114.29 123.52 109.63C111.61 97.7701 99.7803 85.8401 87.8503 74.0101C83.5703 69.7701 79.6603 69.0701 75.8503 71.6001C70.9103 74.8801 70.1903 80.2701 74.3803 84.8201C79.1203 89.9501 84.2103 94.7501 89.1403 99.7001C96.6603 107.24 104.24 114.72 111.71 122.31C115.58 126.24 115.59 127.4 111.66 131.37C100.3 142.84 88.8503 154.21 77.4403 165.63C76.0403 167.04 74.5503 168.4 73.4803 170.11C70.4303 174.98 71.1603 179.23 75.6803 182.84C76.5803 183.56 77.6903 184.03 78.3503 185.05C78.4203 185.21 78.4903 185.36 78.5803 185.51C78.5903 185.55 78.6103 185.59 78.6403 185.63C79.4203 187.06 80.6103 188.16 81.7603 189.31C101.43 208.97 121.13 228.61 140.72 248.36C142.99 250.65 145.76 252.04 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z" fill="#E11B1B"/>
                          <path d="M254.851 141.81C253.901 157.47 249.211 172.11 241.971 185.85C222.701 222.45 192.591 244.9 152.181 253.57C150.901 253.85 149.551 253.82 148.231 253.94C145.631 253.93 143.601 252.98 141.691 251.05C121.101 230.32 100.401 209.7 79.8109 188.98C79.0309 188.19 76.6309 187.69 78.2509 185.61C78.3609 185.58 78.471 185.55 78.581 185.51C85.011 183.79 89.421 179.22 93.911 174.65C103.951 164.44 114.101 154.34 124.281 144.26C128.391 140.18 129.551 140.18 133.721 144.32C144.961 155.46 156.111 166.68 167.301 177.86C168.361 178.92 169.391 180.01 170.501 181.02C174.681 184.83 179.601 185.14 183.031 181.84C186.531 178.46 186.521 172.88 182.621 168.86C172.881 158.82 162.871 149.04 153.001 139.13C151.001 137.13 148.991 135.13 146.991 133.12C141.341 127.44 141.331 127.19 146.851 121.66C156.381 112.11 165.821 102.47 175.501 93.0802C180.591 88.1502 185.511 83.2702 186.471 75.9102C186.521 75.5802 186.551 75.2502 186.581 74.9102C188.681 75.4402 189.791 77.2202 191.171 78.6002C211.061 98.4402 230.911 118.32 250.781 138.17C252.071 139.45 253.491 140.6 254.851 141.81V141.81Z" fill="#C30606"/>
                          <path d="M186.59 74.9098C187.91 79.9298 186.29 83.8598 182.62 87.4598C170.4 99.4598 158.43 111.72 146.19 123.7C143.59 126.25 143.08 127.63 146.03 130.49C158.57 142.64 170.82 155.09 183.14 167.46C187.36 171.69 188.23 176.25 185.8 180.48C182.3 186.59 174.86 187.29 169.34 181.82C156.93 169.53 144.51 157.25 132.36 144.72C129.44 141.71 127.98 141.78 125.1 144.75C113.17 157.04 100.91 169.01 88.8705 181.2C85.8805 184.23 82.5405 185.95 78.2505 185.62C68.6605 181.06 67.5405 174.17 75.2105 166.49C87.3205 154.35 99.3805 142.15 111.65 130.17C114.22 127.66 114 126.36 111.57 123.97C98.8505 111.49 86.3205 98.8298 73.7205 86.2298C70.1505 82.6498 69.0905 78.4998 71.5605 73.9798C73.7705 69.9098 77.4505 68.2598 82.0605 68.8998C84.8505 69.2898 86.8105 71.0798 88.7205 72.9998C100.71 85.0298 112.83 96.9298 124.67 109.11C127.65 112.18 129.28 112.74 132.58 109.3C144.34 97.0498 156.48 85.1698 168.52 73.1898C175.19 66.5498 181.31 67.1798 186.6 74.9198L186.59 74.9098Z" fill="#FEFEFE"/>
                          </g>
                          <defs>
                          <clipPath id="clip0_2088_553">
                          <rect width="256.1" height="255.86" fill="white"/>
                          </clipPath>
                          </defs>
                        </svg>
                        </a>

                      

                                <input type="hidden" name="old_image_name" value="{{$category->image_name}}">
                                <img src="{{ url('categories/thumbnail')}}/{{$category->image_name}}" id="thumbnail_preview" style="width:300;height:130px;" class="{{$category->image_name != null ? '':'d-none'}} ">
                              </div>
                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                <div class="form-group">
                                     <label for="name_ar">Category Position #</label>
                                    <input type="integer" min="1"  name="category_position" readonly class="form-control" id="category_position" value="{{ $category->category_position ??' '}}" maxlength="100">
                                    @if($errors->has('name_ar'))
                                    <div class="error">{{ $errors->first('name_ar') }}</div>
                                    @endif
                                </div>
                            </div>
                             
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
                        </div>
                    



                    </form>
                </div>
          </div>
        </div>
    </div>
</div>
 
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
 
  
@stop

@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
     
   $(document).ready(function() {
$.validator.addMethod("regex", function(value, element, regexp) {
var re = new RegExp(regexp);
return this.optional(element) || re.test(value);
}, "The Contact Number must be in numbers only.");
    $('#addCategoryForm').validate({

            ignore: [],
            debug: false,
            rules: {
            name_en: {
            required: true,
            noSpace:true
            },
            name_ar: {
            required: true,
            noSpace:true
            },
            category_position:{
                required:true,
                         remote:{
                  type:"get",
                  url:"{{route('categories.position.check')}}",
                  data: {
                        "category_position": function() { return $("#category_position").val(); },
                        "_token": "{{ csrf_token() }}",
                       
                      },
                      dataFilter: function (result) {
                       var json = JSON.parse(result);
                                    if (json.msg == 1) {
                                        return "\"" + "category position should be less than of total number of categories" + "\"";
                                    } else {
                                        return 'true';
                                    }
                      }    
                }
            }
            },
            messages: {
            name_en: {
            required: "Name(en) is required",
            },
            name_ar: {
            required: "Name(ar) is required",
            },
            }
            });
            $.validator.addMethod("noSpace", function(value, element) { 
            return $.trim(value).length!=0; 
            }, "No space please and don't leave it empty");
    });
</script>
<!-- show image on change -->
<script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function (e) {
          $('#thumbnail_preview').css('display', 'block');
           $(".remove-pro-img").removeClass("d-none");
           $('#thumbnail_preview').removeClass("d-none");
          $('#thumbnail_preview').attr('src', e.target.result);
        };
    
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>
<!-- show image on change -->
<script>
    // CKEDITOR.replace( 'description_en' ,{
        
    // });
    
    // CKEDITOR.replace( 'description_ar' ,{
        
    // });
 

  //   $(".remove-pro-img").click(function(evt){      
   
  //                 $(".remove-pro-img").addClass("d-none");
  //                 $("#thumbnail_preview").css('display', 'none');
                   
  //                 $(".thumbnail_pic").val(null);  
    
 
  // });










    $(".remove-pro-img").click(function(evt){      
              var pdf_name =  $('.delete_pdf').attr('pdf_name');
                if(pdf_name.trim() ==""){ 
                  $(".remove-pro-img").addClass("d-none");
                  $("#thumbnail_preview").css('display', 'none');
                   
                  $(".thumbnail_pic").val(null);  
                 }
 
  });


 
 

$('.delete_pdf').on('click',function(){
    var id = $(this).attr('current_id');
    var pdf_name = $(this).attr('pdf_name');

    if(pdf_name.trim() !=""){ 


      swal({
        title: "Are you sure?",
        text: "Are you sure you want to  delete this  thumbnail ?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
         
       $.ajax({
        url:"{{route('categories.image.remove')}}",
        method:"POST",
        data:{
           'id':id, 
          }, 
        dataType:"JSON",
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success:function(response){
         console.log("Response", response);
        
        //  swal("Status!", "Status Successfully Updated. ", "success");
         
               if(response.success == 1) {
                  $('.delete_pdf').attr('pdf_name',' ');
                   $(".remove-pro-img").addClass("d-none");
                   $("#thumbnail_preview").css('display', 'none');
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                  swal('Error','Something went wrong','error');
                // alert("Something went wrong! Please try again.");
                }, 500);
              } 

        }
      });
        } 
      });



     
    }
   




});

 
</script>

@stop
