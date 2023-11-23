@extends('adminlte::page')

@section('title', @$type)

@section('content_header')
@stop

@section('content')
<div class="container">
<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Edit {{@$type}}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">Back</a>
         </div>
         <div class="card-body">
            <!-- @if (session('success'))
               <div class="alert alert-success" role="alert">
                 {{ session('success') }}
               </div>
               @endif -->
        	<form id="makeVehicleForm" method="post" action="{{ route('website-contents.update') }}">
               @csrf
	            <div class="card-body">
	               	<div class="tabs_wrap">

	               		@if($type == "Contact Us")
		               		<div class="row">
		                     	<div class="col-sm-12">
		                       		<div class="form-group">
		                        		<label for="title">Contact Number<span class="text-danger">*</span></label>
		                        		<input type="text" name="contact_number" class="form-control" id="title" maxlength="100" value="{{@$content->contact_number}}">
		                        		@error('contact_number_error')
		                        			<div id ="contact_number_error" class="error">{{ $message }}</div>
		                        		@enderror
		                        	</div>
		                     	</div>
		                  	</div>
	                  	@endif

	                  	<div id="accordion">
	                     	<div class="card">
	                        	<div class="card-header active" id="headingOne">
	                           		<h5 class="mr-1 mb-0">
		                              	<span class="btn btn-link d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		                              		{{@$type}} (English)
		                              		<i class="fas fa-caret-down"></i>
		                              	</span>
	                           		</h5>
	                        	</div>

	                        	<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
		                           	<div class="card-body mt-2 pt-0">
		                              	<div class="information_fields">
		                                 	<div class="row">
		                                    	<div class="col-sm-12">
		                                      		<div class="form-group">
	                                          		<label for="title">Title (English)<span class="text-danger">*</span></label>
	                                          		<input type="text" name="title" class="form-control" id="title" maxlength="100" value="{{@$content->title}}">
	                                          		@error('title')
	                                          			<div id ="title_error" class="error">{{ $message }}</div>
	                                          		@enderror
		                                       	</div>
		                                    	</div>
		                                 	</div>
		                                 	<input type="hidden" name="id" value="{{$content->id}}">
		                                 	<div class="row">
		                                    	<div class="col-sm-12">
	                                       		<div class="form-group">
	                                          		<label for="content"> Content (English)<span class="text-danger">*</span></label>
	                                          		<textarea name="content" class="ckeditor form-control" id="content">
							                          			{{@$content->content}}
							                        		</textarea>
	                                          		@error('content')
	                                          			<div id ="content_error" class="error">{{ $message }}</div>
	                                          		@enderror

	                                          		<span class="error content_en hide" style="color: #a80000;font-weight: bold; font-weight: 400 !important;"> The Content (English) is required.</span>
	                                       		</div>
		                                    	</div>
		                                 	</div>
		                              </div>
		                           </div>
	                        	</div>
	                     	</div>

	                     	<div class="card">
	                        	<div class="card-header" id="headingTwo">
	                           		<h5 class="mb-0">
	                              		<span class="btn btn-link collapsed d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	                              		{{@$type}} (French)
	                              			<i class="fas fa-caret-down"></i>
	                              		</span>
	                           		</h5>
	                        	</div>

	                        	<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
	                           		<div class="card-body mt-2 pt-0">
	                              		<div class="information_fields">
	                                 		<div class="row">
	                                    		<div class="col-sm-12">
	                                       			<div class="form-group">
			                                          	<label for="title">Title (French)<span class="text-danger">*</span></label>
			                                          	<input type="text" name="title_fr" class="form-control" id="title" maxlength="100" value="{{@$content->title_fr}}">
			                                          	@error('title_fr')
			                                          		<div id ="title_error" class="error">{{ $message }}</div>
			                                          	@enderror
	                                       			</div>
	                                    		</div>
	                                 		</div>
	                                 		<input type="hidden" name="id" value="{{$content->id}}">
	                                 		
	                                 		<div class="row">
	                                    		<div class="col-sm-12">
	                                       			<div class="form-group">
		                                          		<label for="content"> Content (French)<span class="text-danger">*</span></label>
			                                          	<textarea name="content_fr" class="ckeditor form-control" id="content_fr">
					                          						{{@$content->content_fr}}
					                        					</textarea>
				                                       	@error('content_fr')
				                                          	<div id ="content_error" class="error">{{ $message }}</div>
				                                       	@enderror

				                                       	<span class="error content_fr hide" style="color: #a80000;font-weight: bold; font-weight: 400 !important;"> The Content (French) is required.</span>
	                                       			</div>
	                                    		</div>
	                                 		</div>
	                              		</div>
	                           		</div>
	                        	</div>
	                     	</div>

		                    <div class="card">
		                        <div class="card-header" id="headingThree">
		                           <h5 class="mb-0">
		                              <span class="btn btn-link collapsed d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		                              {{@$type}} (Spanish)
		                              <i class="fas fa-caret-down"></i>
		                              </span>
		                           </h5>
		                        </div>
		                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
		                           <div class="card-body mt-2 pt-0">
		                              <div class="information_fields">
		                                 <div class="row">
		                                    <div class="col-sm-12">
		                                       <div class="form-group">
		                                          <label for="title">Title (Spanish)<span class="text-danger">*</span></label>
		                                          <input type="text" name="title_es" class="form-control" id="title" maxlength="100" value="{{@$content->title_es}}">
		                                          @error('title_es')
		                                          <div id ="title_error" class="error">{{ $message }}</div>
		                                          @enderror
		                                       </div>
		                                    </div>
		                                 </div>
		                                 <input type="hidden" name="id" value="{{$content->id}}">
		                                 <div class="row">
		                                    <div class="col-sm-12">
		                                       <div class="form-group">
		                                          <label for="content"> 
		                                          Content (Spanish)<span class="text-danger">*</span></label>
		                                          <textarea name="content_es" class="ckeditor form-control" id="content_es">
				                          			{{@$content->content_es}}
				                       			 </textarea>
		                                          @error('content_es')
		                                          <div id ="content_error" class="error">{{ $message }}</div>
		                                          @enderror

		                                          <span class="error content_es hide" style="color: #a80000;font-weight: bold; font-weight: 400 !important;"> The Content (Spanish) is required.</span>
		                                       </div>
		                                    </div>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                    </div>

		                    <div class="card">
		                        <div class="card-header" id="headingFour">
		                           <h5 class="mb-0">
		                              <span class="btn btn-link collapsed d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
		                              {{@$type}} (Haitian Creole)
		                              <i class="fas fa-caret-down"></i>
		                              </span>
		                           </h5>
		                        </div>
		                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
		                           <div class="card-body mt-2 pt-0">
		                              <div class="information_fields">
		                                 <div class="row">
		                                    <div class="col-sm-12">
		                                       <div class="form-group">
		                                          <label for="title">Title (Haitian Creole)<span class="text-danger">*</span></label>
		                                          <input type="text" name="title_ht" class="form-control" id="title" maxlength="100" value="{{@$content->title_ht}}">
		                                          @error('title_ht')
		                                          <div id ="title_error" class="error">{{ $message }}</div>
		                                          @enderror
		                                       </div>
		                                    </div>
		                                 </div>
		                                 <input type="hidden" name="id" value="{{$content->id}}">
		                                 <div class="row">
		                                    <div class="col-sm-12">
		                                       <div class="form-group">
		                                          <label for="content"> 
		                                          Content (Haitian Creole)<span class="text-danger">*</span></label>
		                                          <textarea name="content_ht" class="ckeditor form-control" id="content_ht">
				                          			{{@$content->content_ht}}
				                        			</textarea>
		                                          @error('content_ht')
		                                          <div id ="content_error" class="error">{{ $message }}</div>
		                                          @enderror

		                                          <span class="error content_ht hide" style="color: #a80000;font-weight: bold; font-weight: 400 !important;"> The Content (Haitian Creole) is required.</span>
		                                       </div>
		                                    </div>
		                                 </div>
		                              </div>
		                           </div>
		                        </div>
		                    </div>

	                 	</div>
	               	</div>
	               	<div class="card-footer">
	                  <button type="submit" class="btn btn-primary" id="submit" >Update</button>
	               	</div>
	            </div>
        	</form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('css')
  <style>
	  	.btn-link{
		  	color: #121A27;
		   font-weight: 500;
		   font-size: 14px;
		   background-color: transparent;
		   border: transparent;
		   width: 100%;
		   padding-left: 0;
		   text-align: left 
	 	}
	  	.collapse, .collapsing {padding: 0 22px;}
	   .information_fields { margin-bottom: 30px;}
	   .address_fields { margin-top: 30px; }
  	</style>
@stop
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<!-- @section('js') -->
  <script>
 
     $('#makeVehicleForm').validate({
         rules: {
            title: {
                required: true
            },
            content: {
                required: true
            },
            title_fr: {
                required: true
            },
            content_fr: {
                required: true
            },
            title_ht: {
                required: true
            },
            content_ht: {
                required: true
            },
            title_es: {
                required: true
            },
            content_es: {
                required: true
            },
            contact_number: {
            	required: true
            }
             
         },
         messages: {
            title: {
               required: "The Title (English) is required."
            },            
            content: {
               required: "The Content (English) is required."
            },
            title_fr: {
               required: "The Title (French) is required."
            },            
            content_fr: {
               required: "The Content (French) is required."
            },
            title_ht: {
               required: "The Title (Haitian Creole) is required."
            },            
            content_ht: {
               required: "The Content (Haitian Creole) is required."
            },
            title_es: {
               required: "The Title (Spanish) is required."
            },            
            content_es: {
               required: "The Content (Spanish) is required."
            },
            contact_number: {
               required: "The Contact Number is required."
            },
                           
         }
     });
 </script>
 <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
 <script type="text/javascript">
    	$(document).ready(function() {
    		CKEDITOR.replace('content');
    		CKEDITOR.config.allowedContent = true; 
    	  	
    	  	$("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['content'].getData().replace(/<[^>]*>/gi, '').length;
            
            var messageLength_fr = CKEDITOR.instances['content_fr'].getData().replace(/<[^>]*>/gi, '').length;

            var messageLength_es = CKEDITOR.instances['content_es'].getData().replace(/<[^>]*>/gi, '').length;

            var messageLength_ht = CKEDITOR.instances['content_ht'].getData().replace(/<[^>]*>/gi, '').length;
           
           	if(!messageLength ) {
               $(".content_en").removeClass("hide");
               return false;
               e.preventDefault();
            }

            if(!messageLength_fr) {
            	$(".content_fr").removeClass("hide");
               return false;
               e.preventDefault();
            }

            if(!messageLength_es) {
            	$(".content_es").removeClass("hide");
               return false;
               e.preventDefault();
            } 

            if(!messageLength_ht) {
            	$(".content_ht").removeClass("hide");
               return false;
               e.preventDefault();
            }
        	});
    	});
   
</script>
<!-- @stop -->
