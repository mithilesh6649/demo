@extends('adminlte::page')

@section('title', 'Terms & Conditions')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3><!-- {{ __('adminlte::adminlte.add_job_industry') }} --></h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">back</a>
          </div>
          <div class="card-body">
            <!-- @if (session('success'))
              <div class="alert alert-success" role="alert">
                {{ session('success') }}
              </div>
            @endif -->
            <form id="makeVehicleForm" method="post" action="{{ route('save-terms-and-conditions') }}">
              @csrf
              <div class="card-body">
                

                <div class="information_fields">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" id="title" maxlength="100" value="{{@$content->title}}">
                        @error('title')
                        <div id ="title_error" class="error">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="content"> 
                           Content<span class="text-danger">*</span></label>
                        <textarea name="content" class="ckeditor form-control" id="content">
                          {{@$content->content}}
                        </textarea>
                        @error('content')
                        <div id ="content_error" class="error">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" >save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <style>
    .information_fields { margin-bottom: 30px; }
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
             
         },
         messages: {
             title: {
                 required: "The Title is required."
             },            
             content: {
                 required: "The Content is required."
             },
                           
         }
     });
 </script>
 <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
 <script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
<!-- @stop -->
