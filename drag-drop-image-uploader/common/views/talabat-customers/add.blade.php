@extends('adminlte::page')

@section('title', 'Super Admin | Add Talabat Customer Info')

@section('content_header')


@section('content')
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-main">
              <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                <h3>Add Talabat Customer Info</h3>
              </div>
              <div class="card-body table form mb-0"> @if (session('status')) <div class="alert alert-success" role="alert"> {{ session('status') }} </div> @endif <form id="editContentManagementForm" method="post" action="{{ route('talabat.customers.save') }}" enctype="multipart/form-data"> @csrf <div class="card-body">
                    <div class="form-group mt-3">
                      <label>Customer Info</label>
                      <textarea id="customer_info" name="customer_info"></textarea>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="button btn_bg_color common_btn text-white">Submit</button>
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

    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>


    <script>
        $(document).ready(function() {

            initSample();

            CKEDITOR.replace('customer_info', {
                customConfig: 'config.js',
                toolbar: 'simple',
                 extraPlugins:'lineheight',
                removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor',
                colorButton_colors: 'CF5D4E,454545,FFF,DDD,CCEAEE,66AB16',
                colorButton_enableAutomatic: 'false',
                allowedContent: true
            });

            CKEDITOR.replace('content_ar', {
                customConfig: 'config.js',
                toolbar: 'simple',
                allowedContent: true,
                 extraPlugins:'lineheight',
            });

            $('#editContentManagementForm').validate({
                ignore: [],

                rules: {

                    customer_info: {
                        required: function() {
                            CKEDITOR.instances.customer_info.updateElement();
                        },
                        minlength: 10

                    },
                },
                messages: {
                  
                    customer_info: {
                        required: "Customer Info is required"
                    },
                }
            });
        });
    </script>


@stop
