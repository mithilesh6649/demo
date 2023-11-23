@extends('adminlte::page')

@section('title', 'Edit Mobile Content')

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
                                    <h3 class="mb-0">Edit Mobile Content</h3>
                                    <a class="btn btn-sm btn-success add-advance-options"
                                        href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                                </div>
                                <div class="card-body main_body form p-3">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form id="editContentForm" method="post" action="{{ route('update_mobile_page') }}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="page_title">Title</label>
                                                <input type="hidden" name="id" value="{{ $pageContent->id }}" readonly>
                                                <input type="title" name="title" class="form-control" id="page_title"
                                                    value="{{ $pageContent->title }}" readonly>
                                                @if ($errors->has('title'))
                                                    <div class="error">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>

                                            <label for="content">Page Content</label>
                                            <textarea id="content" name="content">{{ $pageContent->content }}</textarea>
                                            <div class="form-group mb-0">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="content" class="custom-control-input">
                                                    @if ($errors->has('content'))
                                                        <div class="error">{{ $errors->first('content') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
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
  <!--   <script src="{{ asset('assets/ckeditor/ckeditor.jsss') }}"></script>
    <script src="{{ asset('assets/ckeditor/samples/js/sample.jsss') }}"></script>
    
     <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
      <script type="text/javascript" src="{{asset('assets/ckeditor/adapters/jquery.js') }}"></script> -->
       <script src="{{ asset('assets/ckeditor_2/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/ckeditor_2/samples/js/sample.js') }}"></script>
    <script>
        $(document).ready(function() {
            // content
            // CKEDITOR.replace('content', {
            //     // customConfig: 'config.js',
            //     // toolbar: 'simple'
            // })

            $(function() {
    // $('#content').ckeditor({
    //     toolbar: 'Full',
    //     enterMode : CKEDITOR.ENTER_BR,
    //     shiftEnterMode: CKEDITOR.ENTER_P
    // });
    //  $('#content').ckeditor({
    //     toolbar: 'Full',
    //     enterMode : CKEDITOR.ENTER_BR,
    //     shiftEnterMode: CKEDITOR.ENTER_P
    // });

                  CKEDITOR.replace('content', {
                // customConfig: 'config.js',
                // toolbar: 'simple'
            })

});
            
            $('#editContentForm').validate({
                ignore: [],
                debug: false,
                rules: {
                    title: {
                        required: true
                    },
                    content: {
                        required: function() {
                            CKEDITOR.instances.content.updateElement();
                        },
                        minlength: 10
                    }
                },
                messages: {
                    title: {
                        required: "The Page Title field is required."
                    },
                    content: {
                        required: "The Page Content field is required.",
                        minlength: "Minimum Length must be 10"
                    }
                }
            });
        });
    </script>
@stop
