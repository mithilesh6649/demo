@extends('adminlte::page')

@section('title', 'Super Admin |Edit Security Question')

@section('content_header')
 

@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
              <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                 <h3>Edit Security Question</h3>
                 <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
              </div>
              <div class="card-body table p-0 mb-0">
                 <form class="form_wrap" id="addQuestionForm" method="post" action="{{ route('update.security.question') }}">
                    <div class="row">
                     <input type="hidden" name="question_id" value="{{$question->id}}">
                       <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                          <div class="form-group">
                             <label>Title {{ labelEnglish() }}<span class="text-danger">*</span></label>
                             <input type="text" class="form-control" name="title_en" maxlength="100" value="{{ $question->title_en ?? '' }}" />
                          </div>
                       </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                          <div class="form-group">
                             <label>Title {{ labelArabic() }}<span class="text-danger">*</span></label>
                             <input type="text" class="form-control" name="title_ar" value="{{ $question->title_ar ?? '' }}" maxlength="100" />
                          </div>
                       </div>
                       
                          
                       <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                          <div class="form-group">
                             <label for="status">Status </label> 
                             <select class="form-control" name="status" id="status">
                             @foreach($status as $status_data)
                             <option value="{{$status_data->value}}" {{ $status_data->value == $question->status ? 'selected':'' }} >{{$status_data->name}}</option>
                             @endforeach
                             </select>
                          </div>
                       </div>
                    </div>
           
                    <div class="card-footer">
                       <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
                    </div>
                 </form>
              </div>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection

@section('css')
@stop

@section('js')


 <script> 
    $(document).ready(function() {
     
      $('#addQuestionForm').validate({
             ignore: [],
            
        rules: {
          title_en: {
            required: true
          },
          title_ar: {
            required: true
          },
        
       
        },
        messages: {
          title_en: {
            required: "Title (en) is required"
          },
          status: {
            required: "Status is required"
          },
           title_ar: {
            required: "Title (ar) is required",
             
          },
      }
      });

 
 

    });
  </script>
 

@stop
