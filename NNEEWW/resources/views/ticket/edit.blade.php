@extends('adminlte::page')
@section('title', 'Edit Diet Category')
@section('content_header')
@section('content')


    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="card order_outer rounded_circle">
                <div class="card-body rounded_circle table p-0 mb-0">
                    <div class="order_details">
                        <div class="card-main pt-3">
                            <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                <h3 class="mb-0">Edit Ticket</h3>
                                <a class="btn btn-sm btn-success add-advance-options"
                                    href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                            </div>
                            <div class="card-body main_body form p-3">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form id="EditSpecializationForm" method="post" action="{{ route('ticket.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="ticket_id" value="{{ $data->id }}">

                                    <input type="hidden" name="ticket_type" value="{{ $data->ticket_type }}">

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


                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group"> <label>Author Name
                                                        </label>
                                                        <input readonly type="text" name="ticket_owner_name"
                                                            class="form-control" id="ticket_owner_name" maxlength="100"
                                                            value="{{ @$data->user->name ?? '' }}">
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group"> <label>Author Email
                                                        </label>
                                                        <input readonly type="text" name="ticket_owner_email"
                                                            class="form-control" id="ticket_owner_email" maxlength="100"
                                                            value="{{ @$data->user->email ?? '' }}">
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group"> <label>Category
                                                        </label>
                                                        <input readonly type="text" name="category" class="form-control"
                                                            id="category" maxlength="100"
                                                            value="{{ $data->category ?? '' }}">
                                                    </div>
                                                </div>








                                                <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                                                    <div class="form-group ">
                                                        <label for="priority">Priority <span class="text-danger">
                                                                *</span></label>
                                                        <select class="form-control" id="select" name="priority">

                                                            <option {{ $data->priority == 'low ' ? 'selected' : '' }}
                                                                value="low">Low</option>
                                                            <option {{ $data->priority == 'medium' ? 'selected' : '' }}
                                                                value="medium">Medium</option>
                                                            <option {{ $data->priority == 'high' ? 'selected' : '' }}
                                                                value="high">High</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                                                    <div class="form-group ">
                                                        <label for="status">Status <span class="text-danger">
                                                                *</span></label>
                                                        <select class="form-control" id="select" name="status">

                                                            <option {{ $data->status_id == 10 ? 'selected' : '' }}
                                                                value="10">Reviewing</option>
                                                            <option {{ $data->status_id == 11 ? 'selected' : '' }}
                                                                value="11">Close</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group"> <label>Current Nutiritionist
                                                        </label>
                                                        <input readonly type="text" name=" " class="form-control"
                                                            id=" " maxlength="100"
                                                            value=" {{ @$data->nutritionist->name ?? '--' }}">
                                                    </div>
                                                </div>
                                               
                                            @if($data->ticket_assigned_to == null && $data->ticket_assigned_to_guard == null)
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                                  <span class="badge badge-success px-4 p-1 text-dark">Ticket not assigned yet </span>
                                                </div>
                                            @else
                                              <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                                <span class="badge badge-success px-4 p-1 text-dark"> This ticket assigned to :- {{@$data->nutritionist->name}}  <span class="text-danger">  If you want to change select anoter nutiritionist</span></span>
                                              </div>
                                            @endif
                                                
                                                 

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                                                    <div class="form-group ">
                                                        <label for="ticket_assigned_to">Assign To Nutiritionist<span
                                                                class="text-danger">
                                                                *</span></label>
                                                        <select class="form-control" id="ticket_assigned_to"
                                                            name="ticket_assigned_to">
                                                            <option>Select Nutiritionist</option>
                                                            @foreach ($nutiritionists as $nutiritionist)
                                                                <option
                                                                    {{ $data->ticket_assigned_to == $nutiritionist->id ? 'selected' : '' }}
                                                                    value="{{ @$nutiritionist->id }}">
                                                                    {{ @$nutiritionist->name }}</option>
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
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#ticket_assigned_to').select2();
        });
    </script>


@stop
