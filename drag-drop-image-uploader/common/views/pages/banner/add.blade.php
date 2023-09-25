@extends('adminlte::page')

@section('title', 'Super Admin | Add Banner')

@section('content_header')
 

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
            <h3>Add Banner</h3>
            <a class="btn btn-sm btn-success" href="{{route('banners.list')}}">{{ __('adminlte::adminlte.back') }}</a>
          </div>                
          <div class="card-body table form mb-0">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
           
            <div class="tab_wrapper">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <form id="addbanner" method="post" autocomplete="off" class="dropzone" enctype="multipart/form-data" name="demoform" style="border:none;">
                    @csrf
                    <div class="card-body form">
                      <div class="row">
    				             <input type="hidden" id="userid" name="userid">
                         <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group">
                            <label>Image Type</label>
                            <select name="image_type" id="image_type" class="form-control">
                             	<option value="">Image Type</option>
                             	<option value="0">Single Image</option>
                             	<option value="1">Multiple Image</option>                       
                            </select>
                            @if($errors->has('image_type'))
                              <div class="error">{{ $errors->first('image_type') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group">
                            <label>Page Name</label>
                            <select name="page_name" id="page_name" class="form-control">  
                            <option value="">Select Page</option> 	
                              @forelse ($pages_name as $page_name)
  													    <option value="{{$page_name->value}}" {{ in_array($page_name->value,$existing_pages) ? 'disabled ':'' }}>{{$page_name->name}}</option>
  													@empty
  													   <option disabled>Pages not found</option>
  													@endforelse
                            </select>
                            @if($errors->has('page_name'))
                              <div class="error">{{ $errors->first('page_name') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12  ">
                          <div class="form-group mt-3">
                            <label>Banner Image (1440x420)</label>
                            <div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea my-0">                
                              <span class="customsvg">Upload Banner Images(1440x420)</span>
                            </div>
                            <div class="dropzone-previews"></div>
                            <small class="image_notice"  style="color:#FF0A00;font-size:12px;"></small>
                          </div>
                        </div>            
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="button btn_bg_color common_btn text-white">Save</button>
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
<link
rel="stylesheet"
href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
type="text/css"
/> 

<style>
  
  select option:disabled {
    color: #000;
    background-color: #ddd;
     
}


.dropzoneDragArea {
    background-color: #fbfdff;
    border: 1px dashed #c0ccda;
    border-radius: 6px;
    padding: 60px;
    text-align: center;
    margin-bottom: 15px;
    cursor: pointer;
}
.dropzone {
    box-shadow: none;
    border-radius: 0;
    padding: 0;
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

<script type="text/javascript">
  
$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!",
  
}) 




$(document).ready(function(){
 
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
   
  var maxImageWidth=1440;
  var maxImageHeight=420;

  Dropzone.autoDiscover = false;
  let token = $('meta[name="csrf-token"]').attr('content');
 
  $(function() {
 
 
  $(document).on('change','#image_type',function(){

  	if (Dropzone.instances.length > 0)
  	 Dropzone.instances.forEach(dz => dz.destroy()) 
 
   if($('#image_type').val()=='0')
   {

   	$('.dropzone-previews').empty();

    var dropzone = new Dropzone("div#dropzoneDragArea",{ 
			 paramName: "file",
			 url: "{{ route('banners.saveimage') }}",
			 previewsContainer: 'div.dropzone-previews',
			 addRemoveLinks: true,
			 autoProcessQueue: false,
			 uploadMultiple: true,
			 parallelUploads:20,
			 maxFilesize:500,
			 maxFiles:1,
	           renameFile: function (file) {

	                 var dt = new Date();
	                 var time = dt.getTime();
	               return time + file.name;
	           },

			     addRemoveLinks: true,
			     acceptedFiles: ".jpeg,.jpg,.png",
				 params: {
				       _token: token
				   },
			    // The setting up of the dropzone
			    init: function() {
			          this.on('thumbnail', function(file) {
							    if (file.accepted !== false) {
							      if (file.width !=maxImageWidth || file.height !=maxImageHeight) {
							        file.rejectDimensions();
							      }
							      else {
							        file.acceptDimensions();
							      }
							    }
							  });

					     var myDropzone = this;
		           this.on("uploadprogress", function(file, progress) {
		                  console.log("File progress", progress);
		                  
		                });
						     //form submission code goes here
						     $("form[name='demoform']").submit(function(event) {
						       
										    $.ajaxSetup({
															headers: {
															'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
															}
														});
    
									       if($(this).valid()){

										           if($('.dropzone-previews').html() != "")
										            {
										            
										            }
										            else{
										              $('.image_notice').html('Please Upload at least one image');
										              setTimeout(function(){
										                $('.image_notice').html('');
										              },1500);
										              return false;
										            } 
										       }
										       else{
										         return false;
										       }
						       
									       event.preventDefault();
									       var formData = new FormData(this);
													$.ajax({
													type:'POST',
													url: "{{route('banners.data')}}",
													data: formData,
													cache:false,
													contentType: false,
													processData: false,
													success: (data) => {
													        
													        if(data.status=="success"){
													            myDropzone.processQueue();
													            $('.image_notice').html('');
													          
													        }
												     	},

													error: function(data){
															console.log(data);
															}
													});
										           
		               });
							   this.on('sending', function(file, xhr, formData){
							       let userid = document.getElementById('userid').value;
							      formData.append('userid', userid);
							   });

						    this.on("success", function (file, response) {
									
								 swal({
								       title: "Banner Image",
				                     text:"Banner Image Upload Successfully",
				                     type: "success",
								     },
										   function(){ 
										        window.location.href="{{route('banners.list')}}"
										   });
									 $('#demoform')[0].reset();
						        $('.dropzone-previews').empty();
						        localStorage.setItem('success_data', 'Banner has been added successfully!'); 
						     
						    });

				       this.on("error", function(file,message){
				     
				        var messages = myDropzone.removeFile(file);
				        if(message!="Upload canceled.")
				                  swal({
				                     title: "Error",
				                     text:message,
				                     type: "warning",
				                     showCancelButton: true,
				                     });
				             
				            });     
      			  },
      			 accept: function(file, done) {
						    file.acceptDimensions = done;
						    file.rejectDimensions = function() { done("Please upload an Banner image with 1440 x 420 pixels dimension"); };
					  }, 
    			});
   }else{

	$('.dropzone-previews').empty();
    
   	var dropzone = new Dropzone("div#dropzoneDragArea", { 
			 paramName: "file",
			 url: "{{ route('banners.saveimage') }}",
			 previewsContainer: 'div.dropzone-previews',
			 addRemoveLinks: true,
			 autoProcessQueue: false,
			 uploadMultiple: true,
			 parallelUploads:20,
			 maxFilesize: 500,
	           renameFile: function (file) {
	               var dt = new Date();
	               var time = dt.getTime();
	               return time + file.name;
	           },
		     addRemoveLinks: true,
		     acceptedFiles: ".jpeg,.jpg,.png",
			 params: {
			       _token: token
			   },
			    // The setting up of the dropzone
			    init: function() {

					     this.on('thumbnail', function(file) {
							    if (file.accepted !== false) {
							      if (file.width !=maxImageWidth || file.height !=maxImageHeight) {
							        file.rejectDimensions();
							      }
							      else {
							        file.acceptDimensions();
							      }
							    }
							  });

					     var myDropzone = this;

		           this.on("uploadprogress", function(file, progress) {
				            console.log("File progress", progress);
				          }); 
					    
					     $("form[name='demoform']").submit(function(event) {
					     
					       $.ajaxSetup({
										headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										}
								});
				        
					      if($(this).valid()){

				          if($('.dropzone-previews').html() != "")
			            {
			            
			            }
			            else{
			              $('.image_notice').html('Please Upload at least one image');
			              setTimeout(function(){
			                $('.image_notice').html('');
			              },1500);
			              return false;
				          } 
					       }
					       else{
					         return false;
					       }
		          
					       event.preventDefault();

					       var formData = new FormData(this);
									$.ajax({
									type:'POST',
									url: "{{route('banners.data')}}",
									data: formData,
									cache:false,
									contentType: false,
									processData: false,
									success: (data) => {

									        if(data.status=="success"){
									            myDropzone.processQueue();
									            $('.image_notice').html('');	
									         }							
									},
									error: function(data){
									console.log(data);
									}
									});				           
		                         });
							   //Gets triggered when we submit the image.
							       this.on('sending', function(file, xhr, formData){
							     //fetch the user id from hidden input field and send that userid with our image
							       let userid = document.getElementById('userid').value;
							      formData.append('userid', userid);
							   });

				   this.on("success", function (file, response) {
				     console.log(response);
				  	
				  	  swal({
					       title: "Banner Image",
		                 text:"Banner Image Upload Successfully",
		                 type: "success",
					     },
					   function(){ 
					        window.location.href="{{route('banners.list')}}"
					   }
					 );
				       $('#demoform')[0].reset();
				       //reset dropzone
				        $('.dropzone-previews').empty();
				       
				    });
				       this.on("error", function(file,message){
				        var messages = myDropzone.removeFile(file);

				         if(message!="Upload canceled.")
				                  swal({
				                     title: "Error",
				                     text:message,
				                     type: "warning",
				                     showCancelButton: true,
				                     });   
				            });     
      			  },
      			accept: function(file, done) {
						    file.acceptDimensions = done;
						    file.rejectDimensions = function() { done("Please upload an Banner image with 1440 x 420 pixels dimension"); };
					  }, 

    			});
			   }
			});
		});

		 //Permission 
		 $(document).ready(function(){
		      $("#full_access").click(function() {
		        $("input[type=checkbox]").prop('checked', this.checked)
		      })
		 }); 

</script>
@stop
