@extends('adminlte::page')
@section('title', ' Team Details')
@section('content_header')
@section('content')


    <div class="container-fluid p-0">
            <div class="col-md-12">
                <div class="card order_outer rounded_circle">
                    <div class="card-body rounded_circle table p-0 mb-0">
                        <div class="order_details">
                            <div class="card-main pt-3">
                                <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="mb-0"> Team Details</h3>
                                    <a class="btn btn-sm btn-success add-advance-options"
                                        href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                                </div>
                                <div class="card-body main_body form p-3">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form id="addCurrentOfferForm" method="post" action="{{ route('save_genetic_test') }}"
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
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                        <div class="form-group"> <label>Name </label>
                                                            <input type="text" name="name" class="form-control" id="name"
                                                                maxlength="100" value="{{ $data->name ?? '' }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                        <div class="form-group"> <label>Experience( Years)  </label>
                                                            <input type="number" name="experience" class="form-control" id="experience"
                                                                maxlength="100" value="{{ $data->experience ?? '' }}" readonly>
                                                        </div>
                                                    </div>
        


                                                

                                                        <div class="col-md-12   mb-3">
                                                        <label for="description">Description </label>
                                                    
                                                        <div style="background-color: transparent; padding: 15px; border-radius: 10px;border: 1px solid #ced4da;" class="form-group mt-3">
                                                            {!! $data->description !!} 
                                                        </div>

                                                    </div>


                                        






                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                                        <div class="list mb-3">
                                                            <label>Image (500 x 300) </label>

                                                            <div class="list-img">
                                                                @if (!empty($data->image))
                                                                    <img src="{{ $data->image }}" class="offer_image_box show-modal "
                                                                        current_image='pic_one' style="height:130px;">
                                                                @else
                                                                    Image not available
                                                                @endif
                                                            </div>

 
                                                        </div>
                                                    </div>

                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                                                        <div class="form-group ">
                                                            <label for="status">Status </label>
                                                            <select disabled class="form-control" id="select" name="status">


                                                                @foreach ($status as $statu)
                                                                    <option {{ $statu->value == $data->status ? 'selected' : '' }}
                                                                        value="{{ $statu->value }}">{{ $statu->name }}</option>
                                                                @endforeach


                                                            </select>
                                                        </div>
                                                    </div>


                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="mb-0">Is CEO</label><input class="w-auto ml-2"
                                                            {{ $data->is_ceo != null ? 'checked' : '' }}
                                                            type="checkbox" name="is_ceo">
                                                    </div>
                                                </div>


                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>



     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Image</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div>
                          <img src="{{ @$data->image }}" id="put_me" width="100%" height="100%">
                      </div>
                  </div> 
                  <div class="modal-footer">

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
    
    <script type="text/javascript">
        $(document).on("click",".show-modal",function() {
          // $(".big1").click(function() {
              // id = $(this).attr('id');
              // src = $("." + 'view_full' + id).attr('src');
              // $("#put_me").attr("src", src);
              $("#exampleModal").modal('show');
          });
 </script>


@stop
