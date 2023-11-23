@extends('adminlte::page')
@section('title', 'Edit Diet Subscription Features')
@section('content_header')
@section('content')
<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">Edit Diet Subscription Features</h3>
                            <a class="btn btn-sm btn-success add-advance-options"
                            href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body main_body form p-3">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form id="addSpecializationForm" method="post"
                            action="{{ route('diet.subscription.feature.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-warning">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="information_fields mb-0">
                                    <div class="row">
                                     <input type="hidden" name="feature_id" value="{{ $data->id }}">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-1 ">
                                            <div class="form-group ">
                                                <label for="type">Select Feature Type<span class="text-danger">
                                                *</span></label>
                                                <select class="form-control" id="featur_type" name="type">
                                                    @foreach ($featurTypes as $featurType)
                                                    <option {{$data->type ==$featurType->value ? 'selected':'' }} value="{{ $featurType->value }}">
                                                        {{ $featurType->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 {{$data->type == 3 ? '':'d-none' }}" id="checkbox_div">
                                            <div class="d-flex align-items-center col-md-12 mb-1">
                                                <input type="checkbox" name="is_test" class="w-auto mr-2"
                                                id="checkbox_input" {{$data->is_genetic_test == 1 ? 'checked':'' }}>
                                                <label class="mb-0"> Is it a genetic test?</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12  {{$data->is_genetic_test == 1 ? '':'d-none' }}" id="plan_duration_div">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group"> <label>Genetic Test<span
                                                        class="text-danger">
                                                    *</span></label>
                                                    <input type="number" 
                                                    class="form-control" id="genetic_test_count"
                                                    maxlength="2" @if($data->is_genetic_test) name="genetic_test_count" @else  @endif  value="{{$data->genetic_test_count }}" >
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                <div class="form-group"> <label>Other / Nutrigenomics test </label>
                                                <input type="number" name="other_test_count"
                                                class="form-control" id="other_test_count"
                                                maxlength="2"  value="{{$data->other_test_count }}" >
                                            </div>
                                        </div>


                                        <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                            <div class="form-group"> <label>Title<span
                                                class="text-danger">
                                            *</span></label>
                                            <textarea  id="description"  @if($data->is_genetic_test) name="description" @else  @endif>{{$data->name  }}</textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 {{$data->is_genetic_test == 1 ? 'd-none':'' }}" id="title_box">
                                <div class="form-group"> <label>Title<span class="text-danger">
                                *</span></label>
                                <input type="text" class="form-control"
                                id="title" maxlength="100"   @if($data->is_genetic_test) @else value="{{$data->name}}" name="name"  @endif>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 ">
                            <div class="form-group ">
                                <label for="status">Status<span class="text-danger">
                                *</span></label>
                                <select class="form-control" id="select" name="status">
                                    @foreach ($status as $statu)
                                    <option {{$data->status == $statu->value ? 'selected':'' }} value="{{ $statu->value }}">{{ $statu->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="text"
                class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.update') }}</button>
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
<link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@stop
@section('js')
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<!-- <script src="{{ asset('docsupport/jquery-3.2.1.min.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
</script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script src="{{ asset('assets/ckeditor_2/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor_2/samples/js/sample.js') }}"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $('#addSpecializationForm').validate({
            ignore: [],

            rules: {
                name: {
                    required: true,
                    // remote: {
                    //     type: "post",
                    //     url: "{{ route('subscription.feature.check') }}",
                    //     data: {
                    //         "title": function() {
                    //             return $("#title").val();
                    //         },
                    //         "_token": "{{ csrf_token() }}",

                    //     },
                    //     dataFilter: function(result) {
                    //         var json = JSON.parse(result);
                    //         if (json.msg == 1) {
                    //             return "\"" + "Title already  exist" + "\"";
                    //         } else {
                    //             return 'true';
                    //         }
                    //     }
                    // }
                },
                description: {
                        required: function() {
                            CKEDITOR.instances.description.updateElement();
                        },
                        minlength: 1
                    },
                    genetic_test_count:{
                         required: true,
                     },
            },
            messages: {
                name: {
                    required: "Title is required"
                },
                    description: {
                        required: "Title is  required"
                    },
                     genetic_test_count: {
                        required: "Genetic test count is  required"
                    },
            },


        });

        CKEDITOR.replace('description', {
                // customConfig: 'config.js',
                // toolbar: 'simple'
        })

    });
</script>
<!-- show image on change -->
<script type="text/javascript">
  
    $(document).ready(function(){
         $('#featur_type').on('change',function(){
             var type = $(this).val();
              if(type==3){

                   $('#checkbox_div').removeClass('d-none');
                  // $('#plan_duration_div').removeClass('d-none');
                  // $('#description').addClass('d-none');
              }else{
                 $('#checkbox_div').addClass('d-none');

                 if ($("#checkbox_input").is(':checked')) {
                     $('#checkbox_input').trigger('click'); 
                 }

                 //  $('#plan_duration_div').addClass('d-none');
                 //  $('#description').addClass('d-none');
              }
         });
          
                 
            $("#checkbox_input").click(function() {
            if ($(this).is(':checked')) {
                    //show oos
                 $("#plan_duration_div").removeClass('d-none');
                 $("#title_box").addClass('d-none');
                 $('#description').attr('name', 'description');
                 $('#genetic_test_count').attr('name', 'genetic_test_count');
               // $('#title').attr('name', 'discount');
                 $('#title').removeAttr('name');
            } else {
                    //hide oos
                $("#plan_duration_div").addClass('d-none');
                $("#title_box").removeClass('d-none');
                $('#title').attr('name', 'name');
                $('#description').removeAttr('name');
                $('#genetic_test_count').removeAttr('name');
               // $('#discount').removeAttr('name');
            }
        });

         //
     });
</script>
<!-- show image on change -->
@stop
