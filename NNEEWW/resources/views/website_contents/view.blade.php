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
            <h3>View {{@$type}}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">Back</a>
          </div>
          <div class="card-body">
            <div class="tabs_wrap">
                <div id="accordion">
                  <div class="card">
                    <div class="card-header active" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          {{@$type}} (English)
                          <i class="fas fa-caret-down"></i>
                        </button>
                      </h5>
                    </div>

                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body pt-0">
                          <div class="information_fields">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group mt-2">
                                  <label for="title">Title (English)<span class="text-danger">*</span></label>
                                  <input type="text" name="title" class="form-control" id="title" maxlength="100" value="{{@$content->title}}" readonly>
                                </div>
                              </div>
                            </div>

                            <input type="hidden" name="id" value="{{$content->id}}">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group mb-0">
                                  <label for="content"> 
                                     Content (English)</label>
                                  <textarea name="content" class="ckeditor form-control" readonly>
                                    {{@$content->content}}
                                  </textarea>
                                 
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
                <button class="btn btn-link collapsed d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  {{@$type}} (French) 
                  <i class="fas fa-caret-down"></i>
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body pt-0">
                <div class="information_fields">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group mt-2">
                            <label for="title">Title (French)</label>
                            <input type="text" name="title" class="form-control" id="title" maxlength="100" value="{{@$content->title}}" readonly>
                            
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="id" value="{{$content->id}}">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="content"> 
                               Content (French)</label>
                            <textarea name="content" class="ckeditor form-control" readonly>
                              {{@$content->content}}
                            </textarea>
                            
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
                <button class="btn btn-link collapsed d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  {{@$type}} (Spanish) 
                  <i class="fas fa-caret-down"></i>
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body pt-0">
                <div class="information_fields">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group mt-2">
                            <label for="title">Title (Spanish)</label>
                            <input type="text" name="title" class="form-control" id="title" maxlength="100" value="{{@$content->title}}" readonly>
                           
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="id" value="{{$content->id}}">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="content"> 
                               Content (Spanish)</label>
                            <textarea name="content" class="ckeditor form-control" readonly>
                              {{@$content->content}}
                            </textarea>
                            
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
                <button class="btn btn-link collapsed d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  {{@$type}} (Haitian Creole)  
                  <i class="fas fa-caret-down"></i>
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body pt-0">
                <div class="information_fields">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group mt-2">
                            <label for="title">Title (Haitian Creole)</label>
                            <input type="text" name="title" class="form-control" id="title" maxlength="100" value="{{@$content->title}}" readonly>
                           
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="id" value="{{$content->id}}">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="content"> 
                               Content (Haitian Creole)</label>
                            <textarea name="content" class="ckeditor form-control" readonly>
                              {{@$content->content}}
                            </textarea>
                          
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

<script type="text/javascript">
  $(".card-header").on("click", function(){
    $(".card-header").addClass("active");
    $(".card-header").not($(this)).removeClass('active');
  });
</script>
<!-- @stop -->
