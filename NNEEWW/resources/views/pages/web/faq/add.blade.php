@extends('adminlte::page')

@section('title', 'Add Faq Mobile Content')

@section('content_header')


@section('content')

    <div class="container-fluid p-0">
            <div class="col-md-12">
                <div class="card order_outer rounded_circle">
                    <div class="card-body rounded_circle table p-0 mb-0">
                        <div class="order_details">
                            <div class="card-main pt-3">
                                <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="mb-0">Add Faq </h3>
                                    <a class="btn btn-sm btn-success add-advance-options"
                                        href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                                </div>
                                <div class="card-body main_body form p-3">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form id="editContentForm" method="post" action="{{ route('mobile_pages_faq_save') }}">
                                        @csrf
                                        <div class="card-body">


                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="question">Question<span class="text-danger"> *</span></label>
                                                        <input type="text" name="question" class="form-control" id="question"
                                                            maxlength="100">

                                                    </div>
                                                </div>



                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="status">Status<span class="text-danger"> *</span></label>
                                                        <select name="status" class="form-control" id="status">
                                                            @foreach ($status as $status)
                                                                <option value="{{ $status->value }}">{{ $status->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group">

                                                <label for="content" class="pb-2"> Answer<span class="text-danger">*</span></label>
                                                <textarea id="content" name="content"></textarea>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" id="update_mobile_page" class="btn btn-primary">Add</button>
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
@stop

@section('js') 
 <script src="{{ asset('assets/ckeditor_2/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/ckeditor_2/samples/js/sample.js') }}"></script>  
      <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>


    <script>
        $(document).ready(function() {
            // content

                CKEDITOR.replace('content', {
                   // customConfig: 'config.js',
                   // toolbar: 'simple'
                });

                $('#editContentForm').validate({
                    ignore: [],
                    debug: false,
                    rules: {
                        question:{
                            required: true,
                        },
                        content: {
                            required: function() {
                                CKEDITOR.instances.content.updateElement();
                            },
                            minlength: 1
                        },
                    },
                    messages: {
                        question: {
                            required: "Question is required."
                        },
                        content: {
                            required: "Answer is required.",
                            minlength: "Minimum Length must be 1"
                        },
                    }
                });


        });
    </script>
@stop
