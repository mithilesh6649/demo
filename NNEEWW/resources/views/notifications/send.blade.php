@extends('adminlte::page')
@section('title', 'Edit Notification')
@section('content_header')
@section('content')
  
    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <h3 class="mb-0">Send Notification</h3>
                                <a class="btn btn-sm btn-success add-advance-options"
                                    href="{{ route('notification_list') }}">{{ __('adminlte::adminlte.back') }}</a>
                            </div>
                            <div class="card-body main_body form p-3">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form id="EditSpecializationForm" method="post" action="{{ route('send_store_notification') }}"
                                    enctype="multipart/form-data">
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


                                                <div class="row">

                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 ">
                                                        <div class="form-group ">
                                                            <label for="notification_template">Select Notification
                                                                Template<span class="text-danger"> *</span></label>
                                                            <select class="form-control" id="select"
                                                                name="notification_template">
                                                                <option value=""> Select Notification Template</option>
                                                                @foreach ($allNotificationTemplates as $allNotificationTemplate)
                                                                    <option data-msg="{{$allNotificationTemplate->body}}" value="{{ $allNotificationTemplate->id }}">
                                                                        {{ $allNotificationTemplate->title ?? '' }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                                        <div class="form-group"> <label>Subject<span class="text-danger">
                                                                    *</span></label>
                                                            <input type="text" name="body" id="notification_body" class="form-control"
                                                                id="body" maxlength="100">
                                                        </div>
                                                    </div>


                                                    <label class="mb-3 mt-3 d-block">Notification applied on
                                                        <a class="btn info_btn" data-toggle="tooltip" data-placement="right"
                                                            title="Select Users or  Nutritionist ">
                                                            <i class="fa fa-question-circle"></i>
                                                        </a>
                                                    </label>




                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 ">
                                                        {{-- start discount input  --}}

                                                        <div class="d-flex align-items-center">
                                                            <label class="mb-0">User</label><input type="checkbox"
                                                                name="is_user" class="w-auto ml-2" id="is_user"
                                                                {{ @$data->Notification[0]['notification_to_guard'] == 'users' ? 'checked' : '' }}>
                                                            <label class="mb-0 ml-4">Nutritionist</label><input
                                                                type="checkbox" class="w-auto ml-2" name="is_nutritionist"
                                                                id="is_nutritionist"
                                                                {{ @$data->Notification[0]['notification_to_guard'] == 'web_users' ? 'checked' : '' }}>
                                                        </div>





                                                        {{-- End discount input --}}

                                                    </div>



                                                    <div
                                                        class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 UserPanel {{ @$data->Notification[0]['notification_to_guard'] == 'users' ? '' : 'd-none' }} ">
                                                        <div class="">
                                                            <div class="column" style="">
                                                                <select id="demo3" name="users[]" multiple="multiple"
                                                                    style="">
                                                                    @forelse($allUsers as $allUser)
                                                                        <option
                                                                           
                                                                            value="{{ $allUser->id }}">
                                                                            {{ $allUser->name }} (
                                                                            {{ $allUser->email ?? '--' }} )</option>
                                                                    @empty
                                                                        <option disabled>User not found !</option>
                                                                    @endforelse

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div
                                                        class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 nutritionistPanel  {{ @$data->Notification[0]['notification_to_guard'] == 'web_users' ? '' : 'd-none' }}">
                                                        <div class="">
                                                            <div class="column" style="">
                                                                <select id="demo2" name="nutritionists[]"
                                                                    multiple="multiple" style="">
                                                                    @forelse($allNutritionists as $allUser)
                                                                        <option
                                                                             
                                                                            value="{{ $allUser->id }}">
                                                                            {{ $allUser->name }} (
                                                                            {{ $allUser->email ?? '--' }} )</option>
                                                                    @empty
                                                                        <option disabled>Nutritionist not found !</option>
                                                                    @endforelse

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>






                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="text"
                                                class="button btn_bg_color common_btn text-white">Send</button>
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
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/multiselect/easySelectStyle.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('assets/multiselect/easySelect.js') }}"></script>



    <script>
        $("#demo3").easySelect({
            buttons: true,
            search: true,
            placeholder: 'Select User',
            placeholderColor: 'black',
            selectColor: 'lila',
            itemTitle: 'User selected',
            showEachItem: false,
            width: '100%',
            dropdownMaxHeight: '300px',
        });

        $("#demo2").easySelect({
            buttons: true,
            search: true,
            placeholder: 'Select Nutritionist',
            placeholderColor: 'black',
            selectColor: 'lila',
            itemTitle: 'Nutritionist selected',
            showEachItem: false,
            width: '100%',
            dropdownMaxHeight: '150px',
        });


        $(document).ready(function() {
            $('#EditSpecializationForm').validate({
                ignore: [],

                rules: {
                    notification_template: {
                        required: true
                    },
                },
                messages: {
                    notification_template: {
                        required: "Notification Template is required"
                    },

                },


            });

        });
    </script>
    
   

 


    <script>
        $(document).ready(function() {
            $('#is_nutritionist').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.UserPanel').addClass('d-none');
                    $('.nutritionistPanel').removeClass('d-none');
                    $('#is_user').prop('checked', false);;
                } else {
                    $('.nutritionistPanel').addClass('d-none');
                }
            });
        });





        $(document).ready(function() {
            $('#is_user').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.nutritionistPanel').addClass('d-none');
                    $('.UserPanel').removeClass('d-none');
                    $('#is_nutritionist').prop('checked', false);
                } else {
                    $('.UserPanel').addClass('d-none');
                }
            });
        });


      $(document).ready(function(){
        $('select[name="notification_template"]').on('change',function(){
            var dataMsg = $(this).find(":selected").attr('data-msg'); 
            $('#notification_body').val(dataMsg);
        });
      });

    </script>
    <!-- show image on change -->

    {{-- <script>
        $(document).ready(function(){
            $('.searchInputeasySelect').on('input',function(){
                 var currentobj = this;
                 $('.scrolableDiv')
            });
        });
    </script> --}}

@stop
