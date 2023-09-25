@extends('adminlte::page')

@section('title', 'Super Admin | Add banner Image')

@section('content_header')
 

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>Edit Banner</h3>
          <a class="btn btn-sm btn-success" href="{{route('banners.list')}}">{{ __('adminlte::adminlte.back') }}</a>
        </div>                
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
         
       <div class="tab_wrapper">
            
          <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                
            <form id="addbanner" method="post" class="xdropzone" enctype="multipart/form-data" name="demoform" style="border:none;">
                @csrf
                <div class="card-body form">
                 
               <div class="row">
				         <input type="hidden" id="userid" name="userid">
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group">
                        <label for="image_type">Image Type<span class="text-danger"> *</span></label>
                       <select name="image_type" id="image_type" class="form-control">
                        <option value="0" @if($banner[0]->type==0) selected @endif>Single Image</option>
                       	<option value="1" @if($banner[0]->type==1) selected @endif>Multiple Image</option>
                       	
                       </select>
                        @if($errors->has('image_type'))
                          <div class="error">{{ $errors->first('image_type') }}</div>
                        @endif
                      </div>
                    </div>


                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                      <div class="form-group">
                        <label for="page_name">Pages Name<span class="text-danger"> *</span></label>
                        <input type="hidden" name="page_name" value="{{$banner[0]->page_name}}" >
                       <select name="page_name" disabled id="page_name" class="form-control">   	
                       	 <option value="">Page Name</option>
                         <option @if($banner[0]->page_name=='home_page') selected @endif>Home Page</option>

                       	 <option @if($banner[0]->page_name=='mm_cares') selected @endif>MM Cares</option>

                       	 <option @if($banner[0]->page_name=='menu') selected @endif>Menu</option>

                       	 <option @if($banner[0]->page_name=='blog') selected @endif >Blog</option> 

                       	 <option @if($banner[0]->page_name=='catering') selected @endif>Catering</option>

                       	 <option @if($banner[0]->page_name=='dine-in') selected @endif >Dine-in</option>

                       	 <option @if($banner[0]->page_name=='outlets') selected @endif>Outlets</option>

                       	 <option @if($banner[0]->page_name=='loyality_point') selected @endif >Loyality Point</option>

                       	 <option @if($banner[0]->page_name=='about_us') selected @endif >About Us</option>

                       	 <option @if($banner[0]->page_name=='contact_us') selected @endif >Contact Us</option>

                       	 <option @if($banner[0]->page_name=='order_online') selected @endif >Order Online</option>
                       </select>
                       
                        @if($errors->has('page_name'))
                          <div class="error">{{ $errors->first('page_name') }}</div>
                        @endif
                      </div>
                    </div>


        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12  ">
         <div class="form-group mt-4">
             <label for="p_name">Image <button type="button" class="btn info_btn" data-toggle="tooltip" data-placement="right" title="" data-original-title="Upload max 2 MB file. Only .jpeg,.jpg,.png files are allowed to upload.">
                          <i class="fa fa-question-circle"></i>
                        </button></label>
                <div id="dropzoneDragArea"   class="dz-default dz-message dropzoneDragArea">
                  <svg width="60" height="55" viewBox="0 0 60 55" fill="none" xmlns="http://www.w3.org/2000/svg" class="customsvg">
                    <g clip-path="url(#clip0_1530_2037)">
                    <path d="M22.5254 17.5197C19.7293 17.5384 17.4868 15.2828 17.508 12.4738C17.5291 9.72349 19.7739 7.49601 22.5042 7.51242C25.2487 7.52883 27.4583 9.75631 27.4607 12.5137C27.4653 15.2734 25.2675 17.5009 22.5254 17.5197Z" fill="#F7F9FA"></path>
                    <path d="M53.9481 0.00940304C41.2932 -0.00232054 28.6383 -0.00232054 15.9834 0.00940304C12.7956 0.0117478 10.7361 1.72339 10.0277 4.86296C9.66651 5.85478 9.80021 6.87708 9.82601 7.88999C9.80021 8.59575 9.78379 9.30151 9.76972 10.0073C9.74391 10.0917 9.70404 10.1714 9.65009 10.2488C8.90416 11.2922 8.64848 12.5138 8.34589 13.7096C7.82515 15.7682 7.07688 17.7706 6.77195 19.8856C5.20504 19.9254 4.68899 20.2724 4.32072 21.6769C2.92739 26.9924 1.52233 32.3008 0.185292 37.6257C-0.586435 40.7066 1.10714 43.5648 4.13306 44.4722C4.84146 44.6856 5.56158 44.8591 6.27701 45.0514C18.3197 48.2801 30.36 51.5158 42.4051 54.7374C45.9729 55.6917 48.8533 53.9871 49.7963 50.3833C50.181 48.9131 50.4695 47.4172 50.9011 45.9611C51.253 44.7724 50.9903 43.9001 49.9253 43.2694C49.93 42.1486 50.4038 41.131 50.6314 40.0595C51.7245 40.0454 52.8175 40.0267 53.9106 40.022C57.652 40.0056 59.993 37.696 59.9953 33.9796C60.0023 24.6875 60.0023 15.3954 59.9953 6.10332C59.993 2.37757 57.6707 0.0140925 53.9481 0.00940304V0.00940304ZM13.7527 29.7709C13.7527 21.9606 13.7503 14.1504 13.7527 6.34248C13.7527 4.32368 14.3133 3.75626 16.3118 3.75626C28.7744 3.75391 41.2369 3.75391 53.6972 3.75626C55.6253 3.75626 56.2446 4.36823 56.2446 6.25807C56.2493 12.2699 56.2469 18.2841 56.2469 24.2983V25.473C53.8309 22.6594 51.6095 20.0684 49.3858 17.4799C48.6235 16.5912 47.8799 15.6838 47.0917 14.8186C45.1472 12.6873 42.2245 12.7131 40.3526 14.9195C37.5777 18.195 34.8473 21.5128 32.0982 24.8118C31.7768 25.1963 31.4461 25.5738 31.0684 26.017C30.0762 25.0041 29.1661 24.038 28.2161 23.1119C26.2481 21.1939 23.7148 21.1728 21.7585 23.1049C19.1501 25.677 16.5839 28.2961 13.7527 31.1449V29.7709V29.7709Z" fill="#F7F9FA"></path>
                    <path d="M22.5254 17.5197C19.7293 17.5384 17.4868 15.2828 17.508 12.4738C17.5291 9.72349 19.7739 7.49601 22.5042 7.51242C25.2487 7.52883 27.4583 9.75631 27.4607 12.5137C27.4653 15.2734 25.2675 17.5009 22.5254 17.5197Z" fill="black"></path>
                    <path d="M53.9484 0.00940304C41.2934 -0.00232054 28.6385 -0.00232054 15.9836 0.00940304C12.7958 0.0117478 10.7363 1.72339 10.028 4.86296C9.9224 5.86885 9.86376 6.87708 9.82622 7.88999C9.80042 8.59575 9.784 9.30151 9.76993 10.0073C9.7582 10.5442 9.74882 11.0765 9.73709 11.6087C9.55882 19.3697 9.66437 27.1354 9.66906 34.8988C9.67141 35.7382 9.87314 36.5002 10.3071 37.2318C11.5784 39.3748 13.462 40.4065 15.9273 40.4089C26.9731 40.4182 38.0189 40.4135 49.0647 40.4089C49.6112 40.4089 50.1648 40.4229 50.6316 40.0595C51.7247 40.0454 52.8177 40.0267 53.9108 40.022C57.6522 40.0056 59.9932 37.696 59.9955 33.9796C60.0025 24.6875 60.0025 15.3954 59.9955 6.10332C59.9932 2.37757 57.6709 0.0140925 53.9484 0.00940304V0.00940304ZM13.7529 29.7709C13.7529 21.9606 13.7505 14.1504 13.7529 6.34248C13.7529 4.32368 14.3135 3.75626 16.312 3.75626C28.7746 3.75391 41.2371 3.75391 53.6974 3.75626C55.6255 3.75626 56.2448 4.36823 56.2448 6.25807C56.2495 12.2699 56.2471 18.2841 56.2471 24.2983V25.473C53.8311 22.6594 51.6097 20.0684 49.386 17.4799C48.6237 16.5912 47.8801 15.6838 47.092 14.8186C45.1474 12.6873 42.2247 12.7131 40.3528 14.9195C37.5779 18.195 34.8475 21.5128 32.0984 24.8118C31.777 25.1963 31.4463 25.5738 31.0687 26.017C30.0764 25.0041 29.1663 24.0381 28.2163 23.1119C26.2483 21.1939 23.715 21.1728 21.7587 23.1049C19.1503 25.677 16.5841 28.2961 13.7529 31.1449V29.7709V29.7709Z" fill="black"></path>
                    <path d="M50.6313 40.0594C50.4037 41.131 49.9299 42.1486 49.9252 43.2694C48.2481 43.4616 47.5842 44.5449 47.3239 46.083C47.1432 47.1569 46.8266 48.2097 46.5357 49.2625C45.9704 51.3211 45.0509 51.8885 42.9914 51.3399C36.0529 49.4922 29.1144 47.6329 22.1782 45.7735C17.1256 44.4206 12.0707 43.0818 7.02048 41.7172C6.49271 41.5741 5.95789 41.4639 5.4395 41.281C3.72246 40.6808 3.17592 39.7218 3.61691 37.9328C4.71234 33.5013 5.89925 29.0909 7.06271 24.6781C7.50135 23.0134 8.12764 21.4096 6.77184 19.8855C7.07678 17.7706 7.82505 15.7682 8.34579 13.7095C8.64838 12.5137 8.90406 11.2921 9.64998 10.2487C9.70393 10.1714 9.74381 10.0916 9.76961 10.0096C9.76961 10.0096 9.77196 10.0096 9.76961 10.0072C9.89863 9.62269 9.77196 9.17719 9.80714 8.76921C9.83295 8.47612 9.83295 8.18303 9.82591 7.88994C9.80011 6.87703 9.6664 5.85473 10.0276 4.86292C10.0206 14.5044 10.0089 24.1435 10.0159 33.785C10.0183 34.9714 9.9385 36.1367 10.7266 37.2458C12.0355 39.0887 13.7057 40.0266 15.9552 40.0243C27.0854 40.0172 38.2156 40.0243 49.3458 40.0243C49.7751 40.0243 50.202 40.0477 50.6313 40.0618V40.0594Z" fill="#D4D9DB"></path>
                    <path d="M50.9011 45.9611C50.4695 47.4172 50.181 48.9131 49.7963 50.3832C48.8533 53.987 45.9729 55.6917 42.4051 54.7374C30.36 51.5157 18.3197 48.28 6.27701 45.0513C5.56158 44.8591 4.84146 44.6856 4.13306 44.4722C1.10714 43.5648 -0.586435 40.7066 0.185292 37.6256C1.52233 32.2984 2.92739 26.99 4.32072 21.6769C4.68899 20.2724 5.20504 19.9254 6.77195 19.8855C8.13009 20.8164 8.30367 21.2923 7.87676 22.9313C6.55145 28.0217 5.21911 33.1074 3.89849 38.1977C3.49973 39.7359 3.98294 40.5495 5.54281 40.9668C18.1508 44.3432 30.7612 47.7149 43.3715 51.0819C44.99 51.5134 45.7571 51.0351 46.1769 49.3797C46.5499 47.9072 46.9111 46.4324 47.2958 44.9622C47.6922 43.4405 48.4053 42.9903 49.9253 43.2693C50.9903 43.9001 51.253 44.7723 50.9011 45.9611V45.9611Z" fill="black"></path>
                    <path d="M27.4607 12.5161C27.4653 15.2759 25.2675 17.5034 22.5254 17.5221C19.7293 17.5409 17.4868 15.2852 17.508 12.4763C17.5291 9.72593 19.7739 7.49845 22.5042 7.51486C25.2487 7.53127 27.4583 9.75875 27.4607 12.5161V12.5161Z" fill="#EBEEF0"></path>
                    <path d="M32.5415 30.1647C35.9779 26.024 39.4237 21.8902 42.8414 17.7354C43.4489 16.9968 43.911 16.8585 44.5936 17.6604C48.3068 22.0309 52.0528 26.371 55.7778 30.7321C56.4369 31.5059 56.4721 34.7393 55.8645 35.5271C55.4541 36.0593 54.8981 36.2774 54.2273 36.2751C49.1137 36.2586 43.9978 36.2516 38.8842 36.2422C38.2509 35.9913 37.8169 35.4872 37.3572 35.0183C35.7645 33.3887 34.0943 31.8365 32.5439 30.1671L32.5415 30.1647Z" fill="#86BF22"></path>
                    <path d="M32.5413 30.1648C32.7501 30.2539 33.0128 30.2891 33.1606 30.4391C35.077 32.3641 36.977 34.3032 38.8817 36.2399C31.1902 36.2493 23.4987 36.2611 15.8073 36.2728C15.3663 36.2728 14.8221 36.2775 14.6321 35.907C14.3834 35.424 14.9863 35.1989 15.2607 34.9222C18.174 31.9843 21.1343 29.0909 24.0148 26.1202C24.8029 25.3065 25.3025 25.4027 26.0039 26.1483C27.1814 27.398 28.4176 28.5938 29.6397 29.799C30.6765 30.8213 31.2183 30.8799 32.5413 30.1601V30.1648Z" fill="#94CD31"></path>
                    <path d="M27.4607 12.5161C27.4653 15.2759 25.2675 17.5034 22.5254 17.5221C19.7293 17.5409 17.4868 15.2852 17.508 12.4763C17.5291 9.72593 19.7739 7.49845 22.5042 7.51486C25.2487 7.53127 27.4583 9.75875 27.4607 12.5161V12.5161Z" fill="black"></path>
                    <path d="M23.7103 12.5255C23.6563 13.2828 23.2482 13.7611 22.4717 13.7518C21.7 13.7424 21.2637 13.2687 21.2731 12.4856C21.2825 11.7447 21.7516 11.3179 22.4389 11.2992C23.1895 11.2781 23.6516 11.7212 23.7079 12.5278L23.7103 12.5255Z" fill="#F9BD07"></path>
                    </g>
                    <defs>
                    <clipPath id="clip0_1530_2037">
                    <rect width="60" height="55" fill="white"></rect>
                    </clipPath>
                    </defs>
                  </svg>                  
                  <span class="customsvg">Upload Banner Images</span>
                </div>
                <div class="dropzone-previews">
                <!--  @foreach($banner as $image)
                   <div style="height:90px;width:150px;margin-right:10px;margin-top: 10px;">
                    <img src="{{asset('CMS/banner/'.$image->banner)}}" alt="banner image" class="img" style="height:90px;width:100%;">
                   </div>
                 @endforeach -->
                </div>
                <small class="image_notice"  style="color:#FF0A00;font-size:12px;"></small>
              </div>

 </div>            
                    
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
              </div>              
              
              <!-- image preview -->
              <div class="modal fade" id="exampleModal" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Modal heading -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Banner Image
                                    </h5>
                                    <button type="button" class="close"
                                        data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            ×
                                        </span>
                                    </button>
                                </div>
                                <!-- Modal body with image -->
                                 <div class="modal-body" class="image_preview">
                                      <div style="width:100%;height:350px">
                                         <img src="" class="image_previeww" style="width:100%;height:100%;">
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
<link
rel="stylesheet"
href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
type="text/css"
/> 

<style>


    .dropzoneDragArea {
    background-color: #fbfdff;
    border: 1px dashed #c0ccda;
    border-radius: 6px;
    padding: 60px;
    text-align: center;
    margin-bottom: 15px;
    cursor: pointer;
}
.dropzone{
  box-shadow: 0px 2px 20px 0px #f2f2f2;
  border-radius: 10px;
}

/*my code*/
.nav-pills .nav-link.active, .nav-pills .show>.nav-link{
  background-color: #1f5c7a;
}
/*my code*/

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
.another-message:after {
  content: '';
  position: absolute;
  width: 0;
  height: 0;
  border-top: 15px solid #263238;
  border-left: 15px solid transparent;
  border-right: 15px solid transparent;
  top: 0;
  left: -15px;
}
.another-message:before {
  content: '';
  position: absolute;
  width: 0;
  height: 0;
  border-top: 17px solid #263238;
  border-left: 16px solid transparent;
  border-right: 16px solid transparent;
  top: 0px;
  left: -16px;
}
.another-name {
  font-weight: bolder;
  margin-right: 0px;
}
.another-content {
    margin-top: 0px;
    margin-bottom: 0px;
    line-height: 22px;
}

.iti {
    position: relative;
    display: inline-block;
    min-width: 100%;
}

.chosen-container .chosen-choices {
  width: 100% !important;
  height: 50px !important;
  border-radius: 4px ;
}
.dz-image-preview{
  width: 15% !important;
  float:left;
  text-align:center !important;
  text-transform: capitalize;
}
.select-status{
   height: 30px !important;
    width: 120px !important;
    border-radius: 0px !important;
    position: relative;
    bottom: 3px;
}
.btn-danger{
      height: 26px;
    width: 87%;
    margin: 0px auto;
    line-height: 15px;
    position: relative;
    top: 3px;
}
.dz-success-mark,.dz-error-mark{
  display: none;
}

</style>
@stop

@section('js')
<script>
  $(document).on('click','.nav-item',function(){
    $('.nav_link').each(function(){
      if($(this).hasClass('active')){
        var target = $(this).attr('href');
        $('.tab-pane').removeClass('show');
        $('.tab-pane').removeClass('active');
        $(target).addClass('show');
        $(target).addClass('active');
      }
    })
  })
</script>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script type="text/javascript">
  
$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!",
  
}) 

$(document).ready(function(){

  $(document).on('click','.dz-image',function(){
     var src="{{asset('CMS/banner/')}}"+'/'+$(this).children("img").attr('alt');
    $('#exampleModal').modal('show');
    $('.image_previeww').attr('src',src);
  });

  $('#addbanner').validate({
    ignore: [],
    debug: false,
    rules: {
      image_type : {
        required: true, 
      },
      page_name: {
        required: true,    
      }, 
    },
    messages: {
      page_name: {
        required: "Page Type is required",
      },
      image_type: {
        required: "Image Type is required",
      },
    }
  });
});
</script>

<script> 
   
function elementr(id) {
  var pagetype=$('.removei'+id).data('deltype');
  var maxFile=1;
    if($('#image_type').val()==0)
     {
      maxFile=1;
     }
     else
     {
      maxFile=20;
     }

     if($('.dz-complete').length==1)
     { 
        swal({
                title: "Banner Image",
                text: "One Banner Image is required",
                type: "info",
             });
        return false; 
     }else
     {
     $.ajax({
        url: "{{ route('banners.delete' )}}",
        method: "POST",
        data: {
           'id': id,
           'pagetype':pagetype
        },
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "JSON",

        success: function (response) {

           if (response.status == 'success') {
                  
                  console.log(response); 
             previewImageDisplay(response.data,maxFile);

              swal({
                    title: "Banner Image",
                    text: "Banner Image Delete Successfully",
                    type: "success",
                 },
                 function () {
                    //location.reload();
                 });
           }
        }

     });
   }

}

$(document).on('change', '.select-status', function () {
  
   var status = $(this).find(':selected').val();
   var id = $(this).find(':selected').attr('data-id');
   var type=$(this).find(':selected').attr('data-page');
   var maxFile=1;
    if($('#image_type').val()==0)
     {
      maxFile=1;
     }
     else
     {
      maxFile=20;
     }

   $.ajax({
      url: "{{ route('banners.status' )}}",
      method: "POST",
      data: {
         'id': id,
         'status': status,
         'type':type
      },
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: "JSON",

      success: function (response) {
         if (response.status == 'success') {
          
                 previewImageDisplay(response.data,maxFile);
              
         }
      }

   });

});


// Dropzone has been added as a global variable.
Dropzone.autoDiscover = false;
let token = $('meta[name="csrf-token"]').attr('content');

function previewImageDisplay(asllimage,maxFile)
{
   $('.dropzone-previews').empty();

    if (Dropzone.instances.length > 0)
       Dropzone.instances.forEach(dz => dz.destroy())


      var dropzone = new Dropzone("div#dropzoneDragArea", {
         paramName: "file",
         url: "{{ route('banners.update.images') }}",
         previewsContainer: 'div.dropzone-previews',
         addRemoveLinks: true,
         autoProcessQueue: false,
         uploadMultiple: true,
         parallelUploads: 20,
         maxFilesize:500,
         maxFiles:maxFile,
         renameFile: function (file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
         },

         // addRemoveLinks: true,
         acceptedFiles: ".jpeg,.jpg,.png",
         params: {
            _token: token
         },
         // The setting up of the dropzone
         init: function () {
            var myDropzone = this;
            //form submission code goes here
            this.on("uploadprogress", function(file, progress) {
                console.log("File progress", progress);
              });

             var id = '';
             var pagetype='';
            var js_lang =asllimage;
           
            js_lang.forEach(obj => {

               Object.entries(obj).forEach(([key, value]) => {
        
                  if (`${key}` === `banner`) {
                     let key = {
                        name: `${value}`,
                        size: 12345
                     };
                     myDropzone.displayExistingFile(key, "{{ asset('CMS/banner/')}}/" + `${value}`);
                  }

                  if (`${key}` === `id`) {
                     id = value;
                  }

                   if(`${key}` === `page_name`)
                   {
                    pagetype=value;

                   }


                  if (`${key}` === `status`) {

                     var active = '';
                     var deactive = '';
                     if (value == 1)
                        active = 'selected';
                     else
                        deactive = 'selected';
                     var status = "";
                     status += "<select class='select-status' name='status[]'>";
                     status += "<option value='1'" + active + " data-id='" + id + "' data-page='" + pagetype + "'>Active</option>";
                     status += "<option value='0'" + deactive + " data-id='" + id + "' data-page='" + pagetype + "'>Deactive</option>";
                     status += "</select>";

                     $('.dz-image').last().before(status);
                    

                     var del = "<button type='button' data-delid='" + id + "' onclick='elementr(" + id + ")' class='btn btn-danger removei"+id+"' data-deltype='"+pagetype+"' >Delete</button>"
                     $('.dz-remove').last().attr('remove-id', id);

                     $('.dz-remove').last().addClass('remove-image');
                     $('.dz-remove').empty();
                     $('.dz-details').last().append(del);
                    

                  }

                  $('.dz-remove').last().attr('remove-id', id);

                  $('.dz-remove').last().addClass('remove-image');


               });
              

            });


            $('.dz-success-mark,.dz-error-mark,.dz-size,.dz-filename').empty();


            $("form[name='demoform']").submit(function (event) {
               //Make sure that the form isn't actully being sent.
               $.ajaxSetup({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });


               //Checking image upload or not

               if ($(this).valid()) {

                  if ($('.dropzone-previews').html() != "") {

                  } else {
                     $('.image_notice').html('Please Upload at least one image');
                     setTimeout(function () {
                        $('.image_notice').html('');
                     }, 1500);
                     return false;
                  }
               } else {
                  return false;
               }


               event.preventDefault();

               var formData = new FormData(this);
               $.ajax({
                  type: 'POST',
                  url: "{{route('banners.update.data')}}",
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: (data) => {
                     if (data.status == "success") {

                        if (myDropzone.files.length == 0) {
                           swal({
                                 title: "Banner Image",
                                 text: "Banner Image Upload Successfully",
                                 type: "success",
                              },
                              function () {
                                 window.location.href = "{{route('banners.list')}}"
                              });
                        }

                        myDropzone.processQueue();
                        $('.image_notice').html('');

                     }
                  },
                  error: function (data) {
                     console.log(data);
                  }
               });

            });

            //Gets triggered when we submit the image.
            this.on('sending', function (file, xhr, formData) {
               //fetch the user id from hidden input field and send that userid with our image
               let userid = document.getElementById('userid').value;
               formData.append('userid', userid);
            });

            this.on("success", function (file, response) {
            
               swal({
                     title: "Banner Image",
                     text: "Banner Image Upload Successfully",
                     type: "success",
                  },
                  function () {
                     window.location.href = "{{route('banners.list')}}"
                  }
               )

               $('#demoform')[0].reset();

               $('.dropzone-previews').empty();
               localStorage.setItem('success_data', 'Banner has been added successfully!');

            });


            this.on("error", function (file, message) {
               //alert(message);
               console.log(file);

               var messages = myDropzone.removeFile(file);

               if (message != "Upload canceled.")
                  swal({
                     title: "Error",
                     text: message,
                     type: "warning",
                     showCancelButton: true,
                  });

            });
         }
      });
}



$(function () {


   if ($('#image_type').val() == '0') {


      $('.dropzone-previews').empty();

      var dropzone = new Dropzone("div#dropzoneDragArea", {
         paramName: "file",
         url: "{{ route('banners.update.images') }}",
         previewsContainer: 'div.dropzone-previews',
         addRemoveLinks: true,
         autoProcessQueue: false,
         uploadMultiple: true,
         parallelUploads: 20,
         maxFilesize:500,
         maxFiles:0,
         renameFile: function (file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
         },

         // addRemoveLinks: true,
         acceptedFiles: ".jpeg,.jpg,.png",
         params: {
            _token: token
         },
         // The setting up of the dropzone
         init: function () {
            var myDropzone = this;
            //form submission code goes here
            this.on("uploadprogress", function(file, progress) {
                console.log("File progress", progress);
              });

             var id = '';
             var pagetype='';
            var js_lang = {!!json_encode($user_images)!!};
            js_lang.forEach(obj => {
               Object.entries(obj).forEach(([key, value]) => {
                  if (`${key}` === `banner`) {
                     let key = {
                        name: `${value}`,
                        size: 12345
                     };
                     myDropzone.displayExistingFile(key, "{{ asset('CMS/banner/')}}/" + `${value}`);
                  }

                  if (`${key}` === `id`) {
                     id = value;
                  }

                   if(`${key}` === `page_name`)
                   {
                    pagetype=value;

                   }


                  if (`${key}` === `status`) {

                     var active = '';
                     var deactive = '';
                     if (value == 1)
                        active = 'selected';
                     else
                        deactive = 'selected';
                     var status = "";
                     status += "<select class='select-status' name='status[]'>";
                     status += "<option value='1'" + active + " data-id='" + id + "' data-page='" + pagetype + "'>Active</option>";
                     status += "<option value='0'" + deactive + " data-id='" + id + "' data-page='" + pagetype + "'>Deactive</option>";
                     status += "</select>";

                     $('.dz-image').last().before(status);


                     var del = "<button type='button' data-delid='" + id + "' onclick='elementr(" + id + ")' class='btn btn-danger removei"+id+"' data-deltype='"+pagetype+"' >Delete</button>"
                     $('.dz-remove').last().attr('remove-id', id);

                     $('.dz-remove').last().addClass('remove-image');
                     $('.dz-remove').empty();
                     $('.dz-details').last().append(del);


                  }

                  $('.dz-remove').last().attr('remove-id', id);

                  $('.dz-remove').last().addClass('remove-image');


               });

            });

            $('.dz-success-mark,.dz-error-mark,.dz-size,.dz-filename').empty();


            $("form[name='demoform']").submit(function (event) {
               //Make sure that the form isn't actully being sent.
               $.ajaxSetup({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });


               //Checking image upload or not

               if ($(this).valid()) {

                  if ($('.dropzone-previews').html() != "") {

                  } else {
                     $('.image_notice').html('Please Upload at least one image');
                     setTimeout(function () {
                        $('.image_notice').html('');
                     }, 1500);
                     return false;
                  }
               } else {
                  return false;
               }


               event.preventDefault();

               var formData = new FormData(this);
               $.ajax({
                  type: 'POST',
                  url: "{{route('banners.update.data')}}",
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: (data) => {
                     if (data.status == "success") {

                        if (myDropzone.files.length == 0) {
                           swal({
                                 title: "Banner Image",
                                 text: "Banner Image Upload Successfully",
                                 type: "success",
                              },
                              function () {
                                 window.location.href = "{{route('banners.list')}}"
                              });
                        }

                        myDropzone.processQueue();
                        $('.image_notice').html('');

                     }
                  },
                  error: function (data) {
                     console.log(data);
                  }
               });

            });

            //Gets triggered when we submit the image.
            this.on('sending', function (file, xhr, formData) {
               //fetch the user id from hidden input field and send that userid with our image
               let userid = document.getElementById('userid').value;
               formData.append('userid', userid);
            });

            this.on("success", function (file, response) {
               //      $.toast({
               //     heading: 'Banner Images',
               //     text: 'Banner Images Uploaded Successfully.',
               //     position: 'top-right',
               //     stack: false
               // })

               swal({
                     title: "Banner Image",
                     text: "Banner Image Upload Successfully",
                     type: "success",
                  },
                  function () {
                     window.location.href = "{{route('banners.list')}}"
                  }
               )

               $('#demoform')[0].reset();

               $('.dropzone-previews').empty();
               localStorage.setItem('success_data', 'Banner has been added successfully!');

            });


            this.on("error", function (file, message) {
               //alert(message);
               console.log(file);

               var messages = myDropzone.removeFile(file);

               if (message != "Upload canceled.")
                  swal({
                     title: "Error",
                     text: message,
                     type: "warning",
                     showCancelButton: true,
                  });

            });
         }
      });
   } else {

      $('.dropzone-previews').empty();

      var dropzone = new Dropzone("div#dropzoneDragArea", {
         paramName: "file",
         url: "{{ route('banners.update.images') }}",
         previewsContainer: 'div.dropzone-previews',
         addRemoveLinks: true,
         autoProcessQueue: false,
         uploadMultiple: true,
         parallelUploads: 20,
         maxFilesize: 500,
         renameFile: function (file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
         },
         // addRemoveLinks: true,
         acceptedFiles: ".jpeg,.jpg,.png",
         params: {
            _token: token
         },
         // The setting up of the dropzone
         init: function () {
            var myDropzone = this;
             this.on("uploadprogress", function(file, progress) {
                  console.log("File progress", progress);
                });

            var id = '';
             var pagetype='';
            var js_lang = {!!json_encode($user_images)!!};
            js_lang.forEach(obj => {
               Object.entries(obj).forEach(([key, value]) => {
                  if (`${key}` === `banner`) {
                     let key = {
                        name: `${value}`,
                        size: 12345
                     };
                     myDropzone.displayExistingFile(key, "{{ asset('CMS/banner/')}}/" + `${value}`);
                  }

                  if (`${key}` === `id`) {
                     id = value;
                  }

                   if(`${key}` === `page_name`)
                   {
                    pagetype=value;

                   }


                  if (`${key}` === `status`) {

                     var active = '';
                     var deactive = '';
                     if (value == 1)
                        active = 'selected';
                     else
                        deactive = 'selected';
                     var status = "";
                     status += "<select class='select-status' name='status[]'>";
                     status += "<option value='1'" + active + " data-id='" + id + "' data-page='" + pagetype + "'>Active</option>";
                     status += "<option value='0'" + deactive + " data-id='" + id + "' data-page='" + pagetype + "' >Deactive</option>";
                     status += "</select>";

                     $('.dz-image').last().before(status);


                     var del = "<button type='button' data-delid='" + id + "' onclick='elementr(" + id + ")' class='btn btn-danger removei"+id+"' data-deltype='"+pagetype+"' >Delete</button>"
                     $('.dz-remove').last().attr('remove-id', id);

                     $('.dz-remove').last().addClass('remove-image');
                     $('.dz-remove').empty();
                     $('.dz-details').last().append(del);


                  }

                  $('.dz-remove').last().attr('remove-id', id);

                  $('.dz-remove').last().addClass('remove-image');


               });

            });

            $('.dz-success-mark,.dz-error-mark,.dz-size,.dz-filename').empty();

            //form submission code goes here
            $("form[name='demoform']").submit(function (event) {
               //Make sure that the form isn't actully being sent.


               $.ajaxSetup({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });

               // alert(count_disabled);

               //Checking image upload or not

               if ($(this).valid()) {

                  if ($('.dropzone-previews').html() != "") {

                  } else {
                     $('.image_notice').html('Please Upload at least one image');
                     setTimeout(function () {
                        $('.image_notice').html('');
                     }, 1500);
                     return false;
                  }
               } else {
                  return false;
               }
               //alert($(this).attr('class'));
               event.preventDefault();

               var formData = new FormData(this);
               $.ajax({
                  type: 'POST',
                  url: "{{route('banners.update.data')}}",
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: (data) => {

                     if (data.status == "success") {

                        if (myDropzone.files.length == 0) {
                           swal({
                                 title: "Banner Image",
                                 text: "Banner Image Upload Successfully",
                                 type: "success",
                              },
                              function () {
                                 window.location.href = "{{route('banners.list')}}"
                              });
                        }

                        myDropzone.processQueue();


                        $('.image_notice').html('');
                     }
                  },
                  error: function (data) {
                     console.log(data);
                  }
               });
            });
            //Gets triggered when we submit the image.
            this.on('sending', function (file, xhr, formData) {
               //fetch the user id from hidden input field and send that userid with our image
               let userid = document.getElementById('userid').value;
               formData.append('userid', userid);
            });

            this.on("success", function (file, response) {
               console.log(response);

               swal({
                     title: "Banner Image",
                     text: "Banner Image Upload Successfully",
                     type: "success",
                  },
                  function () {
                     window.location.href = "{{route('banners.list')}}"
                  }
               );
               $('#demoform')[0].reset();
               //reset dropzone
               $('.dropzone-previews').empty();

            });
            this.on("error", function (file, message) {
               var messages = myDropzone.removeFile(file);

               if (message != "Upload canceled.")
                  swal({
                     title: "Error",
                     text: message,
                     type: "warning",
                     showCancelButton: true,
                  });
            });
         }
      });
   }


   // $('#image_type').on('change',function(){
   $(document).on('change', '#image_type', function () {

      var image_type=$('#image_type').find(':selected').val();
      var page_type=$('#page_name').find(':selected').val();
      var allimage=[];
      $.ajax({
        url:"{{route('banners.update.datasta')}}",
        method:'GET',
        data:{
          'type':image_type,
           'page':page_type
         },
        dataType:"JSON",
        success:function(response)
        {
          allimage.push(response.data);
        
        }


      });
//console.log(allimage);
   

      if ($('#image_type').val() == '0') {
         if ($('.dz-preview').length > 1) {

            swal({
                  title: "Banner Image",
                  text: "You Have muliple Image Please Remove Image",
                  type: "info",
               },
               function () {
                  location.reload();
               });
         }
      }

      if (Dropzone.instances.length > 0)
         Dropzone.instances.forEach(dz => dz.destroy())

      if ($('#image_type').val() == '0') {

         $('.dropzone-previews').empty();

         var dropzone = new Dropzone("div#dropzoneDragArea", {
            paramName: "file",
            url: "{{ route('banners.update.images') }}",
            previewsContainer: 'div.dropzone-previews',
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 20,
            maxFilesize: 500,
            maxFiles: 1,
            renameFile: function (file) {
               var dt = new Date();
               var time = dt.getTime();
               return time + file.name;
            },

            // addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png",
            params: {
               _token: token
            },
            // The setting up of the dropzone
            init: function () {
               var myDropzone = this;
               //form submission code goes here
                 this.on("uploadprogress", function(file, progress) {
                  console.log("File progress", progress);
                });

               var id = '';
             var pagetype='';
            var js_lang = allimage;
            js_lang.forEach(obj => {
               Object.entries(obj).forEach(([key, value]) => {
                  if (`${key}` === `banner`) {
                     let key = {
                        name: `${value}`,
                        size: 12345
                     };
                     myDropzone.displayExistingFile(key, "{{ asset('CMS/banner/')}}/" + `${value}`);
                  }

                  if (`${key}` === `id`) {
                     id = value;
                  }

                   if(`${key}` === `page_name`)
                   {
                    pagetype=value;

                   }


                  if (`${key}` === `status`) {

                     var active = '';
                     var deactive = '';
                     if (value == 1)
                        active = 'selected';
                     else
                        deactive = 'selected';
                     var status = "";
                     status += "<select class='select-status' name='status[]'>";
                     status += "<option value='1'" + active + " data-id='" + id + "' data-page='" + pagetype + "'>Active</option>";
                     status += "<option value='0'" + deactive + " data-id='" + id + "' data-page='" + pagetype + "'>Deactive</option>";
                     status += "</select>";

                     $('.dz-image').last().before(status);


                     var del = "<button type='button' data-delid='" + id + "' onclick='elementr(" + id + ")' class='btn btn-danger removei"+id+"' data-deltype='"+pagetype+"' >Delete</button>"
                     $('.dz-remove').last().attr('remove-id', id);

                     $('.dz-remove').last().addClass('remove-image');
                     $('.dz-remove').empty();
                     $('.dz-details').last().append(del);


                  }

                  $('.dz-remove').last().attr('remove-id', id);

                  $('.dz-remove').last().addClass('remove-image');


               });

            });

            $('.dz-success-mark,.dz-error-mark,.dz-size,.dz-filename').empty();


               $("form[name='demoform']").submit(function (event) {
                  //Make sure that the form isn't actully being sent.
                  $.ajaxSetup({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                  });


                  //Checking image upload or not

                  if ($(this).valid()) {

                     if ($('.dropzone-previews').html() != "") {

                     } else {
                        $('.image_notice').html('Please Upload at least one image');
                        setTimeout(function () {
                           $('.image_notice').html('');
                        }, 1500);
                        return false;
                     }
                  } else {
                     return false;
                  }


                  event.preventDefault();

                  var formData = new FormData(this);
                  $.ajax({
                     type: 'POST',
                     url: "{{route('banners.update.data')}}",
                     data: formData,
                     cache: false,
                     contentType: false,
                     processData: false,
                     success: (data) => {
                        if (data.status == "success") {
                           if (myDropzone.files.length == 0) {
                              swal({
                                    title: "Banner Image",
                                    text: "Banner Image Upload Successfully",
                                    type: "success",
                                 },
                                 function () {
                                    window.location.href = "{{route('banners.list')}}"
                                 });
                           }

                           myDropzone.processQueue();
                           $('.image_notice').html('');

                        }
                     },
                     error: function (data) {
                        console.log(data);
                     }
                  });

               });

               //Gets triggered when we submit the image.
               this.on('sending', function (file, xhr, formData) {
                  //fetch the user id from hidden input field and send that userid with our image
                  let userid = document.getElementById('userid').value;
                  formData.append('userid', userid);
               });

               this.on("success", function (file, response) {
                  //      $.toast({
                  //     heading: 'Banner Images',
                  //     text: 'Banner Images Uploaded Successfully.',
                  //     position: 'top-right',
                  //     stack: false
                  // })

                  swal({
                        title: "Banner Image",
                        text: "Banner Image Upload Successfully",
                        type: "success",
                     },
                     function () {
                        window.location.href = "{{route('banners.list')}}"
                     }
                  )

                  $('#demoform')[0].reset();

                  $('.dropzone-previews').empty();
                  localStorage.setItem('success_data', 'Banner has been added successfully!');

               });


               this.on("error", function (file, message) {
                  //alert(message);
                  console.log(file);

                  var messages = myDropzone.removeFile(file);

                  if (message != "Upload canceled.")
                     swal({
                        title: "Error",
                        text: message,
                        type: "warning",
                        showCancelButton: true,
                     });

               });
            }
         });
      } else {

         $('.dropzone-previews').empty();

         var dropzone = new Dropzone("div#dropzoneDragArea", {
            paramName: "file",
            url: "{{ route('banners.update.images') }}",
            previewsContainer: 'div.dropzone-previews',
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 20,
            maxFilesize: 500,
            renameFile: function (file) {
               var dt = new Date();
               var time = dt.getTime();
               return time + file.name;
            },
            // addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png",
            params: {
               _token: token
            },
            // The setting up of the dropzone
            init: function () {
               var myDropzone = this;
                 this.on("uploadprogress", function(file, progress) {
                  console.log("File progress", progress);
                });

                var id = '';
             var pagetype='';
            var js_lang = allimage;
            js_lang.forEach(obj => {
               Object.entries(obj).forEach(([key, value]) => {
                  if (`${key}` === `banner`) {
                     let key = {
                        name: `${value}`,
                        size: 12345
                     };
                     myDropzone.displayExistingFile(key, "{{ asset('CMS/banner/')}}/" + `${value}`);
                  }

                  if (`${key}` === `id`) {
                     id = value;
                  }

                   if(`${key}` === `page_name`)
                   {
                    pagetype=value;

                   }


                  if (`${key}` === `status`) {

                     var active = '';
                     var deactive = '';
                     if (value == 1)
                        active = 'selected';
                     else
                        deactive = 'selected';
                     var status = "";
                     status += "<select class='select-status' name='status[]'>";
                     status += "<option value='1'" + active + " data-id='" + id + "' data-page='" + pagetype + "'>Active</option>";
                     status += "<option value='0'" + deactive + " data-id='" + id + "' data-page='" + pagetype + "' >Deactive</option>";
                     status += "</select>";

                     $('.dz-image').last().before(status);


                     var del = "<button type='button' data-delid='" + id + "' onclick='elementr(" + id + ")' class='btn btn-danger removei"+id+"' data-deltype='"+pagetype+"' >Delete</button>"
                     $('.dz-remove').last().attr('remove-id', id);

                     $('.dz-remove').last().addClass('remove-image');
                     $('.dz-remove').empty();
                     $('.dz-details').last().append(del);


                  }

                  $('.dz-remove').last().attr('remove-id', id);

                  $('.dz-remove').last().addClass('remove-image');


               });

            });

            $('.dz-success-mark,.dz-error-mark,.dz-size,.dz-filename').empty();

               //form submission code goes here
               $("form[name='demoform']").submit(function (event) {
                  //Make sure that the form isn't actully being sent.


                  $.ajaxSetup({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                  });

                  // alert(count_disabled);

                  //Checking image upload or not

                  if ($(this).valid()) {

                     if ($('.dropzone-previews').html() != "") {

                     } else {
                        $('.image_notice').html('Please Upload at least one image');
                        setTimeout(function () {
                           $('.image_notice').html('');
                        }, 1500);
                        return false;
                     }
                  } else {
                     return false;
                  }

                  event.preventDefault();

                  var formData = new FormData(this);
                  $.ajax({
                     type: 'POST',
                     url: "{{route('banners.update.data')}}",
                     data: formData,
                     cache: false,
                     contentType: false,
                     processData: false,
                     success: (data) => {

                        if (data.status == "success") {

                           if (myDropzone.files.length == 0) {
                              swal({
                                    title: "Banner Image",
                                    text: "Banner Image Upload Successfully",
                                    type: "success",
                                 },
                                 function () {
                                    window.location.href = "{{route('banners.list')}}"
                                 });
                           }

                           myDropzone.processQueue();
                           $('.image_notice').html('');
                        }
                     },
                     error: function (data) {
                        console.log(data);
                     }
                  });
               });
               //Gets triggered when we submit the image.
               this.on('sending', function (file, xhr, formData) {
                  //fetch the user id from hidden input field and send that userid with our image

                  let userid = document.getElementById('userid').value;
                  formData.append('userid', userid);
               });

               this.on("success", function (file, response) {
                  console.log(response);

                  swal({
                        title: "Banner Image",
                        text: "Banner Image Upload Successfully",
                        type: "success",
                     },
                     function () {
                        window.location.href = "{{route('banners.list')}}"
                     }
                  );
                  $('#demoform')[0].reset();
                  //reset dropzone
                  $('.dropzone-previews').empty();

               });
               this.on("error", function (file, message) {
                  var messages = myDropzone.removeFile(file);

                  if (message != "Upload canceled.")
                     swal({
                        title: "Error",
                        text: message,
                        type: "warning",
                        showCancelButton: true,
                     });
               });
            }
         });
      }


   });
});

//Permission 
$(document).ready(function () {
   $("#full_access").click(function () {
      $("input[type=checkbox]").prop('checked', this.checked)
   })
});

</script>
@stop
