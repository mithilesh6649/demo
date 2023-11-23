@extends('adminlte::page')

@section('title', 'Contact Us Details')

@section('content_header')
 

@section('content')
<div class="container-fluid p-0">
  <div class="col-lg-12">
    <div class="card order_outer rounded_circle">
      <div class="card-body rounded_circle table p-0 mb-0">
        <div class="order_details">
          <div class="card-main pt-3">
            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
              <h3 class="mb-0">Contact Us Details</h3>
              <a class="btn btn-sm btn-success add-advance-options" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body main_body form p-3">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif 
            
              <form class="form_wrap">
                <div class="row">
                  <div class="col-6 mb-3">
                    <div class="form-group">
                      <label>First Name</label>
                      <input class="form-control" placeholder="{{ $contactUsMessage->first_name ?? '' }} " readonly>
                    </div>
                  </div>

                   <div class="col-6 mb-3">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input class="form-control" placeholder="{{ $contactUsMessage->first_name ?? '' }} " readonly>
                    </div>
                  </div>
                  <div class="col-6 mb-3">
                    <div class="form-group">
                      <label>Email</label>
                      <input class="form-control" placeholder="{{ $contactUsMessage->email ?? '--' }}" readonly>
                    </div>
                  </div>
                
                   
                 
                  <div class="col-6">
                   <div class="form-group">
                       <label for="password">Phone Number </label>

                       <input type="tel" name="contact_number" class="form-control" id="txtPhone"
                           value="{{ $contactUsMessage->contact_number ?? '' }}" readonly>
                       <input type="hidden" name="country_code" class="form-control" id="country_code"
                           value="{{ $contactUsMessage->country_code ?? '' }}" readonly />
                   </div>
               </div>


                 
                </div>


                  <div class="row">
                  <div class="col-6  ">
                    <div class="form-group">
                      <label>Country</label>
                      <input class="form-control" placeholder="{{ $contactUsMessage->country  ?? '--'}}" readonly>
                    </div>
                  </div>
                  <div class="col-6  ">
                    <div class="form-group">
                      <label>City</label>
                      <input class="form-control" placeholder="{{ $contactUsMessage->city ?? '--' }}" readonly>
                    </div>
                  </div>
                </div>

                

              
                
                

                

                <div class="row mt-3">

                    <div class="col-md-6">
                    <div class="form-group">
                      <label>Zip Code</label>
                      <input class="form-control" placeholder="{{ $contactUsMessage->zip_code ?? '--' }}" readonly>
                    </div>
                  </div>
                    
                     <div class="col-6 mb-3">
                    <div class="form-group">
                      <label>Address</label>
                      <input class="form-control" placeholder="{{ $contactUsMessage->address ?? '--' }}" readonly>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Created At</label>
                      <input class="form-control" placeholder="{{ date('d/m/Y', strtotime($contactUsMessage->created_at)) }}" readonly>
                    </div>
                  </div>
                
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />

    <style>
        .information_fields {
            margin-bottom: 30px;
        }

        .address_fields {
            margin-top: 30px;
        }

        input#txtPhone {
            padding-left: 95px !important;
        }

        .iti--allow-dropdown .iti__flag-container .iti__selected-flag {
            width: 90px;
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        $('#appoinment-list').DataTable({});

        $('#weight-tracker-list , #water-tracker-list , #report-list').DataTable({
            'ordering': false
        });
    </script>

    <script>
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

        $(function() {
            var code = "+" +
                "{{ $contactUsMessage->country_code ?? 91 }}{{ $contactUsMessage->contact_number }}"; // Assigning value from model.
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
    </script>

@stop
