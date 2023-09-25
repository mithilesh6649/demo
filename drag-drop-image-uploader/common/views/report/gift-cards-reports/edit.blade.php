 @extends('adminlte::page')

 @section('title', 'Super Admin | Edit Gift Cards')

 @section('content_header')
 


 @section('content')
 <div class="container">
 	<div class="row justify-content-center">
 		<div class="col-md-12">
 			<div class="card">
 				<div class="card-main">
 					<div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
 						<h3>Edit Gift Cards Report</h3>
 						<a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
 					</div>
 					<div class="card-body table p-0 mb-0">
 						@if (session('status'))
 						<div class="alert alert-success" role="alert">
 							{{ session('status') }}
 						</div>
 						@endif
 						<form name="gift_card_report" id="gift_card_report" method="POST"
 						enctype="multipart/form-data"
 						action="{{route('report.updateGift')}}">
 						@csrf

 						<input type="hidden" name="gift_id" id="gift_ids" value="{{$gift->id}}">

 						<div class="card-body main_body form mb-3">
 							<div class="row">
 								<div class="col-md-12 col-lg-12 col-xl-12 col-12">
 									<div class="form-group mb-0">
 										<label for="category">Date </label>
 										<input type="text" name="report_date"
 										id="report_date" readonly value="{{date('d/m/Y',strtotime($gift->date))}}" class="form-control"
 										autocomplete="off">
 									</div>
 								</div>
 							</div>
 						</div>

 						<div class="card-body main_body form">
 							<div class="row">
 								<div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
 									<div class="form-group mb-0">
 										<label for="guest_name">Guest Name<span
 											class="text-danger">*</span></label>
 											<input type="text" name="guest_name" value="{{$gift->guest_name}}" id="guest_name"
 											class="form-control" placeholder="Guest Name">
 										</div>
 									</div>

 									<div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
 										<div class="form-group mb-0">
 											<label for="mobile_number">Mobile Number<span
 												class="text-danger">*</span></label>
 												<input type="number" name="mobile_number"
 												id="mobile_number" class="form-control"
 												placeholder="Mobile Number" value="{{$gift->mobile_number}}">
 											</div>
 										</div>



 										<div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
 											<div class="form-group mb-0">
 												<label for="doc_ref_no">Document Reference Number<span
 													class="text-danger">*</span></label>
 													<input type="text" name="doc_ref_no" id="doc_ref_no"
 													class="form-control"
 													placeholder="Document Reference Number"
 													value="{{$gift->doc_ref_no}}" readonly>
 												</div>
 											</div>

                      <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                        <div class="form-group mb-0">
                          <label style="opacity: 0;display: block;" for="pos_invoice_no">Pos Invoice Number<span
                            class="text-danger">*</span></label>
                          <button type="button" class="btn btn-primary"  id="modal_button">
                              Gift Card
                          </button>
                        </div>
                      </div>

 											<div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
 												<div class="form-group mb-0">
 													<label for="pos_invoice_no">Pos Invoice Number<span
 														class="text-danger">*</span></label>
 														<input type="text" name="pos_invoice_no"
 														id="pos_invoice_no" class="form-control"
 														placeholder="Pos Invoice Number"  value="{{$gift->pos_invoice_number}}">
 													</div>
 												</div>

 												<div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
 													<div class="form-group mb-0">
 														<label for="pos_invoice_amount">Pos Invoice Amount<span
 															class="text-danger">*</span></label>
 															<input type="number" name="pos_invoice_amount"
 															id="pos_invoice_amount" class="form-control"
 															placeholder="Pos Invoice Amount"  value="{{number_format($gift->pos_invoice_amount, 3, '.', '')}}">
 														</div>
 													</div>

 													<div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
 														<div class="form-group mb-0">
 															<label for="card_amount">Card Amount<span
 																class="text-danger">*</span></label>
 																<input type="number" name="card_amount"
 																id="card_amount" class="form-control"
 																placeholder="Card Amount"  value="{{number_format($gift->card_amount, 3, '.', '')}}" readonly>
 															</div>
 														</div>
 													</div>
 													<div class="card-footer submit_btn">
 														<button
 														class="button btn_bg_color common_btn text-white">Update</button>
 													</div>
 												</div>
 											</form>
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>
 					</div>


 					<!-- Modal -->
 					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 						<div class="modal-dialog modal-dialog-centered" role="document">
 							<div class="modal-content">
 								<div class="modal-header">
 									<h5 class="modal-title" id="exampleModalCenterTitle">Gift Cards</h5>
 									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 										<span aria-hidden="true">&times;</span>
 									</button>
 								</div>
 								<div class="modal-body pb-0">
 								<form id="gift-card-form">
 									<div id="multiple_printed_gift_card_parent" class="add_multiple_wrapper d-flex align-items-center flex-wrap">
 									</div>
 								</form> 
 							</div>
 							<div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add-gift-card">Add</button>
 								<button type="button" class="btn btn-primary" id="update-gift-card">Update</button>
 							</div>
 						</div>
 					</div>
 				</div>

 				@endsection

 				@section('css')
 				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
 				<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
 				<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

 				<style>
 					.disabled_button {
 						opacity: .6;
 					}

 					.dz-details {
 						display: none;
 					}

 					.dz-preview.dz-image-preview a.dz-remove {
 						color: #f43127 !important;
 						font-weight: 600 !important;
 					}

 					.dz-preview.dz-image-preview a.dz-remove:hover {
 						text-decoration: underline !important;
 						color: #f43127 !important;
 					}
 				</style>

 				@stop

 				@section('js')
 				<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
 				<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 				<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
 				<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

 				<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



 				<script type="text/javascript">
 					$(document).ready(function(){
 						$('#gift-card-form').click(function(e){
 							e.preventDefault();
    			//alert();
    		});
 					});
 				</script>

 				<script type="text/javascript">
    	 //open modal.............
    	 $(document).ready(function(){

    	 	$('#modal_button').click(function(){

    	 		$('#exampleModalCenter').modal({
    	 			'show':true,
    	 			backdrop: 'static',
    	 			keyboard: false
    	 		});

    	 		$.ajax({
    	 			type:"post",
    	 			url:"{{route('all.purchased.cards.show')}}",
    	 			data:{
    	 				"_token": "{{ csrf_token() }}",
    	 				id: "{{$gift->id}}"
    	 			},
    	 			dataType: "JSON",
    	 			success:function(response){
    	 				$('#multiple_printed_gift_card_parent').html(response.html);


    	 				$(document).ready(function(){
    	 					$('.printed_gift_card_remove_btn_old').each(function(){
    	 						$(this).click(function(){
    	 							var parent_data = $(this).parent()[0];

    	 							var data_card_number = $(parent_data).attr('data-card-number');
    	 							var data_gift_card_id = $(parent_data).attr('data-gift');
			              // console.log(data_gift_card_id);


			              swal({
			              	title: "Are you sure ?",
			              	text: "Are you sure you want to Permanently Delete this Gift Cards  ?",
			              	type: "warning",
			              	showCancelButton: true,
			              }, function(willDelete) {
			              	if (willDelete) {

			              		$.ajax({
			              			type:"POST",
			              			url:"{{route('gift.card.number.delete')}}",
			              			data:{ 
			              				"_token": "{{ csrf_token() }}",
			              				data_card_number:data_card_number,
			              				data_gift_card_id:data_gift_card_id
			              			},
			              			success:function(response){
			              				if(response.status == 1){
			              					$('#card_amount').val(response.card_amount.toFixed(3));
			              					parent_data.parentElement.remove();
			              				} 
			              			}
			              		});

			              	} 
			              });




			          });
    	 					});
    	 				});


    	 			}



    	 		});



    	 	});

    	 }); 

    	</script>


    	<script type="text/javascript"> 

    		$('#gift_card_report').validate({
    			rules: {
    				guest_name: {
    					required: true,
    				},
    				mobile_number: {
    					required: true
    				},
    				doc_ref_no: {
    					required: true
    				},
    				pos_invoice_no: {
    					required: true
    				},
    				pos_invoice_amount: {
    					required: true
    				},
    				card_amount: {
    					required: true
    				},
    			},
    			messages: {
    				guest_name: {
    					required: "Guest Name is required",
    				},
    				mobile_number: {
    					required: "Mobile Number is required"
    				},
    				doc_ref_no: {
    					required: "Document Reference Number is required"
    				},
    				pos_invoice_no: {
    					required: "Pos Invoice Number is required"
    				},
    				pos_invoice_amount: {
    					required: "Pos Invoice Amount is required"
    				},
    				card_amount: {
    					required: "Card Amount is required"
    				},
    			}
    		});
    	</script>


    	<script type="text/javascript">


    		$(document).ready(function(){
    			$('#add-gift-card').each(function(){
    				$(this).click(function(){
    					var html = `<div class="gift-card-contain">
    					<input type="number"  step="1" name="printed_gift_card_input_value" class="gift-card-input">
    					<span><i class="text-danger fa fa-trash-alt printed_gift_card_remove_btn"
    					style="font-size:16px;cursor:pointer;margin:0 10px;"></i></span>
    					</div>`	 

    					$('#multiple_printed_gift_card_parent').append(html);
    					$('.gift-card-input').focus();



    				});
    			});
    		});

    	</script>


    	<script type="text/javascript">
    		$(document).ready(function(){
    			$('#exampleModalCenter').keyup(function(e){
    				var keyCode = e.keyCode || e.which;
    				if(keyCode==13){

    					$('#add-gift-card').trigger('click');
    					return false;
    				}else{
    					return false;
    				}	
    			});
    		});
    	</script>










    	<script type="text/javascript">
    	// $(document).ready(function(){
    	// 	$('.printed_gift_card_remove_btn_old').each(function(){
    	// 		$(this).click(function(){
    	// 			var parent_data = $(this).parent()[0];

    	// 			var data_card_number = $(parent_data).attr('data-card-number');
    	// 			var data_gift_card_id = $(parent_data).attr('data-gift');
			  //             // console.log(data_gift_card_id);


			  //             swal({
			  //             	title: "Are you sure ?",
			  //             	text: "Are you sure you want to Permanently Delete this Gift Cards  ?",
			  //             	type: "warning",
			  //             	showCancelButton: true,
			  //             }, function(willDelete) {
			  //             	if (willDelete) {

			  //             		$.ajax({
			  //             			type:"POST",
			  //             			url:"{{route('gift.card.number.delete')}}",
			  //             			data:{ 
			  //             				"_token": "{{ csrf_token() }}",
			  //             				data_card_number:data_card_number,
			  //             				data_gift_card_id:data_gift_card_id
			  //             			},
			  //             			success:function(response){
			  //             				if(response.status == 1){
			  //             					$('#card_amount').val(response.card_amount.toFixed(3));
			  //             					parent_data.parentElement.remove();
			  //             				} 
			  //             			}
			  //             		});

			  //             	} 
			  //             });




			  //         });
    	// 	});
    	// });
    </script>


    <script type="text/javascript">

    	$(document).on("change", ".gift-card-input", function() {
    		var current_obj = this;

    		$.ajax({
    			type:"POST",
    			url:"{{route('gift.card.number.valid')}}",
    			data:{
    				"_token": "{{ csrf_token() }}",
    				data_card_number:current_obj.value,
    			},
    			success:function(response){
    				if(response.status == 1){
   	  	 			//alert(current_obj.value);
   	  	 			current_obj.style.border = '1px solid #CCC';
   	  	 			$(current_obj).removeClass('errors_gift');


   	  	 			var flag = 0;
   	  	 			$("#multiple_printed_gift_card_parent .gift-card-input").each(function(){
   	  	 				if(this.value == current_obj.value){
   	  	 					flag++;
   	  	 					if(flag==2){
   	  	 						toastr.error('Duplicate Entry');
   	  	 						current_obj.style.border = '1px solid red';
   	  	 						$(current_obj).addClass('errors_gift');	
   	  	 					}else{
   	  	 						current_obj.style.border = '1px solid #CCC';
   	  	 						$(current_obj).removeClass('errors_gift');

   	  	 					}
   	  	 				}  
   	  	 			});


   	  	 		}else{
   	  	 			toastr.error('Card Number Not Valid');
   	  	 			current_obj.style.border = '1px solid red';
   	  	 			$(current_obj).addClass('errors_gift');
   	  	 		}
   	  	 	}
   	  	 }); 



    	});

    </script>






    <script type="text/javascript">
    	$(document).ready(function(){
    		$('#update-gift-card').click(function(){ 

    			$("#multiple_printed_gift_card_parent .gift-card-input").each(function(){
    				var current_obj = this;
             // alert(current_obj.value);
              

             $.ajax({
             	type:"POST",
             	url:"{{route('gift.card.number.valid')}}",
             	data:{
             		"_token": "{{ csrf_token() }}",
             		data_card_number:current_obj.value,
             	},
             	success:function(response){
             		if(response.status == 1){
              			//alert(current_obj.value);
              		}else{

                       if(current_obj.value == ''){
		              	toastr.error('Fields Should Not Be Empty !');
		              }else{
                        toastr.error('Card Number Not Valid !');
		              }
              			current_obj.style.border = '1px solid red';
              			$(current_obj).addClass('errors_gift');	
              		}
              	}
              }); 


         });


    			setTimeout(function(){

    				var container = document.getElementById('multiple_printed_gift_card_parent');
    				var errors_gift_input = container.getElementsByClassName("errors_gift");
    				let all_numbers = [];
    				if(errors_gift_input.length == 0){

    					var container = document.getElementById('multiple_printed_gift_card_parent');
    					var all_input = container.getElementsByTagName("INPUT");
    					$(all_input).each(function(){
    						all_numbers.push(this.value);
    					});


               //Submit Gift Cards......


               $.ajax({
               	type:"POST",
               	url:"{{route('gift.card.number.update')}}",
               	data:{
               		"_token": "{{ csrf_token() }}",
               		data_card_numbers:all_numbers,
               		id: "{{$gift->id}}"
               	},
               	success:function(response){
               		if(response.status == 1){
               			$('#card_amount').val(response.card_amount.toFixed(3));
               			$('#exampleModalCenter').modal('hide');

               		} 
               	}
               }); 




           }

       },100)



    		}); 	 
    	});
    </script> 



    <script type="text/javascript">

    	$(document).on("click", ".printed_gift_card_remove_btn", function() {
    		this.parentElement.parentElement.remove();
    	});

    </script>



    @stop
