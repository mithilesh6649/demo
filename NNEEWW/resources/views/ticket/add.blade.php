@extends('adminlte::page')

@section('title', 'Add Advertisement')

@section('content_header')

@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
               <div class="d-flex align-items-center">
                  <div class="icon_main">
                     <i class="fas fa-fw fa-universal-access "></i>
                  </div>
                  <h3> Add Ticket</h3>
               </div>
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <form id="addAdvertisementForm" autocomplete="off" method="post" action="{{ route('ticket.save') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="name">Subject<span class="text-danger"> *</span></label>
                              <input type="text" name="subject" class="form-control" id="subject" maxlength="100" value="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="name">Description<span class="text-danger"> *</span></label>
                              <textarea id="descripiton" name="description" rows="4" cols="50" class="form-control">
                             
                              </textarea>
                           </div>
                        </div>
                     </div>
                      <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="name">Attachment(Optional)</label>
                              <input type="file" name="attachment" class="form-control" id="attachment">
                           </div>
                        </div>
                     </div>

                  
                  </div>
                 
            </div>
            <div class="card-footer text-left">
            <button type="text" class="btn btn-primary common_btn">Save</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
 
 

@endsection

@section('css')
 
@stop

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
  
  <script>
  
  $(document).ready(function() {
$('#addAdvertisementForm').validate({
   ignore: [],
   debug: false,
   rules: {
   subject: {
      required: true
   },
   description: {
      required: true
   },
   attachment: {
      extension: "jpg|jpeg|png|ico|bmp",
      filesize: 1000000
   },
   },
   messages: {
      subject: {
         required: "Subject text is required",
      },
      description: {
         required: "Descripiton is required"
      },
      attachment: {
         required: "Advertisement image is required",
         extension: "Image must be of type: jpg, jpeg, png, ico,bmp"
      }
   }
   });

$.validator.addMethod('filesize', function(value, element, param) {
  return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than 1 MB');


  
 });

 
    
 
  </script>
@stop
