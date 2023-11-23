@extends('adminlte::page')

@section('title', 'Nutritionist Details')

@section('content_header')
@stop

@section('content')


<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0"> Nutritionist Details</h3>
                            <a class="btn btn-sm btn-success add-advance-options"
                            href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body main_body form p-3">
                            <div class="container">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link nav_nutritionist active" data-toggle="tab"
                                        href="#home">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav_nutritionist  " data-toggle="tab"
                                        href="#documents">Documents</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav_nutritionist" data-toggle="tab"
                                        href="#menus1">Appoinments</a>
                                    </li>

                                     <li class="nav-item">
                                        <a class="nav-link nav_nutritionist" data-toggle="tab"
                                        href="#AssociatedUser">Associated User</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_nutritionist" data-toggle="tab"
                                        href="#menu2">Reviews</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_nutritionist" data-toggle="tab"
                                        href="#chats">Chats</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="home" class="container tab-pane active "><br>

                                        @include('nutritionists.partial.nutritionist_profile')
                                    </div>

                                    <div id="documents" class="container tab-pane  fade"><br>

                                        @include('nutritionists.partial.nutritionist_documents')
                                    </div>

                                    <div id="menus1" class="container tab-pane fade "><br>

                                        @include('nutritionists.partial.nutritionist_appoinments');

                                    </div>

                                     <div id="AssociatedUser" class="container tab-pane fade "><br>

                                        @include('nutritionists.partial.nutritionist_web_user') 

                                    </div>

                                    <div id="menu2" class="container tab-pane fade "><br>

                                        @include('nutritionists.partial.nutritionist_reviews')

                                    </div>

                                    <div id="chats" class="container tab-pane fade "><br>

                                        @include('nutritionists.partial.nutritionist_chats')

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






<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">

      <div class="modal-body">
       <form class="form_wrap" id="addSocialMediaForm" >
           @csrf
           <div class="row">
              <input type="hidden" name="doc_id" id="doc_id">
            <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                <div class="form-group">
                    <label>Reason<span class="text-danger">*</span></label>
                    <textarea rows="10" name="reject_reason" id="reject_reason" placeholder="Type Here Reason for reject document"></textarea>
                </div>
            </div>




        </div>

    </form>

    <center>
        <div class="btn-group">
          <button type="button" id="closemodal" class="btn btn-success">Cancle</button>
          <button type="button" id="rejectSaveDoc" class="btn btn-danger">Reject & Save</button>
      </div>

  </center>       

</div>

</div>
</div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.css" />

<style>
    .information_fields {
        margin-bottom: 30px;
    }

    .address_fields {
        margin-top: 30px;
    }
</style>

<style>
    /* start mk profile upload coding */
    .profile-image-show {
        height: 161px;
        width: 161px;
        border-radius: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        border: 7px solid #dcf7d5;
        position: relative;
        margin: 0 0 20px;
        cursor: pointer;
    }

    .upload_image_wrapper {
        padding: 16px 25px 16px 25px;
        background-color: #ffffff !important;
        border: 1px solid #F0EFEF;
        height: 60px;
        box-shadow: none;
        outline-style: none;
        font-size: 13px;
        line-height: normal;
        color: #1c1c1c;
        border-radius: 10px;
        position: relative;
    }

    .upload_image_wrapper input#news_source_website_image_1 {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        z-index: 1;
        cursor: pointer;
    }

    input[type=file],
    /* FF, IE7+, chrome (except button) */
    input[type=file]::-webkit-file-upload-button {
        /* chromes and blink button */
        cursor: pointer;
    }

    .upload_image_wrapper i.far.fa-image {
        font-size: 28px;
    }


    .profile-image-show {
        background-color: #f6f7fb;
        border-radius: 20px;
        border: 1px dashed #878D8E !important;
        width: 200px;
        height: 200px;
        margin: 0px 0 20px;
        /*overflow: hidden;*/
        padding: 10px;
    }

    .remove-pro-img {
        position: absolute;
        top: -10px;
        right: -10px;
        z-index: 9;
    }

    .profile-image-show img#profileImage {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .thumb_nails {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .thumb_nails h4 {
        font-size: 14px;
        width: 100%;
        text-align: center;
        margin: 10px 0 0;
        font-weight: 600;
    }

    #profile_picture {
        border: 1px solid red;
        width: 100% !important;
        height: 100% !important;
        border-radius: 20%;
        position: absolute;
        opacity: 0;
    }


    /* end mk profile upload coding */


    .editable_field {
        position: relative;
        top: -25px;
        right: 10px;
        float: right;
    }

    .non_editable_field {
        position: relative;
        top: -25px;
        right: 10px;
        float: right;
    }

    #job_alerts_modal label.error {
        position: absolute;
        bottom: -12px;
        left: 17px;
    }
</style>



@stop

@section('js')
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>

<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="{{asset('assets/multiselect/easySelectStyle.css')}}" type="text/css">
<script type="text/javascript" src="{{asset('assets/multiselect/easySelect.js')}}"></script>
<script>
    $(function() {
        var code = "+" +
                "{{ $Nutritionist->country_code ?? 49 }}{{ $Nutritionist->phone_number }}"; // Assigning value from model.
                $('#txtPhone').val(code);
                $('#txtPhone').intlTelInput({
                    autoHideDialCode: true,
                    autoPlaceholder: "ON",
                    dropdownContainer: document.body,
                    formatOnDisplay: true,

                    initialCountry: "auto",
                    nationalMode: true,
                    placeholderNumberType: "MOBILE",
                    preferredCountries: ['US'],
                    separateDialCode: true
                });




            });

    $("#txtPhone").on('focusout', function() {
        var code = $("#txtPhone").intlTelInput("getSelectedCountryData").dialCode;
        $('#country_code').val(code);
    });


    $('#review-list,#appoinment-list,#documents-list,#chats-list').DataTable({
        columnDefs: [{
            targets: 0,
                // render: function(data, type, row) {
                //   //   return data.substr(0, 2);
                // }
        }]
    });


    $(document).on('click', '.copy_btn', function() {
        var btn = this;
        var getLink = $(this).attr('data-link');

        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(getLink).select();
        document.execCommand("copy");
        $temp.remove();

        $(btn).html('Copied !');

        setTimeout(function() {
            $(btn).html('Copy');
        }, 800);

    });



        //Document Approved .......  

    $(document).on('click','.approve_document',function(){
       var btn = this;
       var getId = $(this).attr('data-id');
             // /alert(btn);  
       //get Status TD and Actions TD
         var actionTd = btn.parentElement;
         var parentt_TR = btn.parentElement.parentElement ;
         var statusTd = parentt_TR.getElementsByTagName('TD')[2];  
       swal({
        title: "Are You Sure ?",
        text: "Do you want to Approve this document ?",
        type: "warning",
        confirmButtonText: "Approve  ",
        showCancelButton: true,
    }, function(willDelete) {
        if (willDelete) {


           $.ajax({
               type:"POST",
               url:"{{route('approve_nutritionist')}}",
               data:{
                  "_token": "{{ csrf_token() }}",
                  "id": getId
              },
              success:function(response){
               console.log(response);
               if(response.status=='success'){
                  $(statusTd).html('<span class="status_contain" style="background-color:#90EE90">Approved</span>');
                   $(actionTd).html(' <i title="Approved Document" class="fa fa-check-circle text-success" aria-hidden="true" style="font-size:18px;"></i>');
                   Swal.fire(
                      'Success',
                      'Document Approved Successfully !',
                      'success'
                      )
                //   alert(response.message);
               }

           }
       });

       }
   });
   });






        //Document Approved .......  
   var btn2 = '';
    $(document).on('click','.reject_document',function(){
        btn2 = this;
       var getId = $(this).attr('data-id');
     //alert(getId);  
       $('#doc_id').val(getId);

       $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    })


   });  


    $(document).ready(function(){
      $(document).on('click','#rejectSaveDoc',function(){
      // alert(getId);
       var getReason = $('#reject_reason').val();
       var getdocid = $('#doc_id').val();
       

        var actionTd = btn2.parentElement;
         var parentt_TR = btn2.parentElement.parentElement ;
         var statusTd = parentt_TR.getElementsByTagName('TD')[2];  

         
           $.ajax({
               type:"POST",
               url:"{{route('reject_nutritionist')}}",
               data:{
                  "_token": "{{ csrf_token() }}",
                  "id": getdocid,
                  "reason": getReason,
              },
              success:function(response){
               console.log(response);
               if(response.status=='success'){

                    $(statusTd).html('<span class="status_contain" style="background-color:#FFCCCB">Rejected</span>');
                   $(actionTd).html('<i title="Rejected Document" class="fa fa-times-circle text-danger" aria-hidden="true" style="font-size:18px;"></i>');

                   Swal.fire(
                      'Success',
                      'Document Rejected Successfully !',
                      'success'
                      )
                   //alert(response.message);
               }

           }
       });


          $('#myModal').modal('hide');
         $('#myModal').find('form').trigger('reset');
   });



      $(document).on('click','#closemodal',function(){
        $('#myModal').modal('hide');
        $('#myModal').find('form').trigger('reset');
    });


  });

  $("#specialization_id").easySelect({
        placeholder: 'Select Specialization',
        dropdownMaxHeight: 'auto',
        showEachItem: true,
        buttons: true,
        dropdownMaxHeight: 'auto',
    });


</script>

@stop
 