@extends('adminlte::page')

@section('title', 'Add Car')

@section('content_header')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>Add Car</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              <form id="addcars" method="post" action="{{ route('cars.save') }}">
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
                        <div class="col-6 mb-3">
                          <div class="form-group">
                            <label for="lease">Lease No</label>
                            <input type="text" name="lease" class="form-control" id="lease" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('lease'))
                              <div class="error">{{ $errors->first('lease') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="col-6 mb-3">
                          <div class="form-group">
                            <label for="expiry_date">Expiry Date </label>
                            <input type="text" name="expiry_date" class="form-control" id="expiry_date" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('expiry_date'))
                              <div class="error">{{ $errors->first('expiry_date') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">

                        <div class="col-6 mb-3">
                          <div class="form-group">
                            <label for="no_plate">No Plate <span class="text-danger"> *</span> </label>
                            <input type="text" name="no_plate" class="form-control" id="no_plate" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('no_plate'))
                              <div class="error">{{ $errors->first('no_plate') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="col-6 mb-3">
                          <div class="form-group">
                            <label for="model">Model <span class="text-danger"> *</span></label>
                            <input type="text" name="model" class="form-control" id="model" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('model'))
                              <div class="error">{{ $errors->first('model') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row  ">

                        <div class="col-6 mb-3">
                          <div class="form-group">
                            <label for="year">Year </label>
                            <input type="text" name="year" class="form-control" id="year" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('year'))
                              <div class="error">{{ $errors->first('year') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="col-6 mb-3">
                          <div class="form-group">
                            <label for="file_no">File No </label>
                            <input type="text" name="file_no" class="form-control" id="file_no" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('file_no'))
                              <div class="error">{{ $errors->first('file_no') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row">

                        <div class="col-6 mb-3">
                          <div class="form-group">
                            <label for="document_no">Document No  </label>
                            <input type="text" name="document_no" class="form-control" id="document_no" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('document_no'))
                              <div class="error">{{ $errors->first('document_no') }}</div>
                            @endif
                          </div>
                        </div>
                       <div class="col-6 mb-3">
                          <div class="form-group">
                            <label for="chassis_no">Chassis No </label>
                            <input type="text" name="chassis_no" class="form-control" id="chassis_no" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('chassis_no'))
                              <div class="error">{{ $errors->first('chassis_no') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row  ">

                        <div class="col-6 mb-3">
                          <div class="form-group">
                            <label for="ownership_id">Ownership Name </label>
                             
                             <select class="form-control form-select" id="ownership_id" name="ownership_id">
                               <option value="">Ownership Name</option>
                               @foreach($owner as $olist)
                                <option value="{{$olist->id}}">{{$olist->ownership_name}}</option>
                               @endforeach
                               
                             </select>

                            <div id ="function_error" class="error"></div>
                            @if($errors->has('year'))
                              <div class="error">{{ $errors->first('year') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group mb-3">
                            <label for="driver_name">Driver Name </label>
                             <select class="form-control form-select" id="driver_name" name="driver_id">
                               <option value="">Driver Name</option>
                               @foreach($driver as $dlist)
                                <option value="{{$dlist->id}}">{{$dlist->drivers_name}}</option>
                               @endforeach
                             </select>
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('year'))
                              <div class="error">{{ $errors->first('year') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">

                        <div class="col-6 d-none">
                          <div class="form-group">
                            <label for="branch">Branch<span class="text-danger"> *</span></label>
                            <input type="text" name="branch" class="form-control" id="branch" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('branch'))
                              <div class="error">{{ $errors->first('branch') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group mb-3">
                            <label for="ins_no">INS No</label>
                            <input type="text" name="ins_no" class="form-control" id="ins_no" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('ins_no'))
                              <div class="error">{{ $errors->first('ins_no') }}</div>
                            @endif
                          </div>
                        </div>

                          <div class="col-6">
                          <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <input type="text" name="remarks" class="form-control" id="remarks" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('remarks'))
                              <div class="error">{{ $errors->first('remarks') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">

                      

                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="text" class="button btn_bg_color common_btn text-white" >Submit</button>
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
<link href=
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'>

@stop

@section('js')

 
      
    <script src=
"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" >
    </script>

  <script>
    $(document).ready(function() {

      $(function() {
                $( "#expiry_date" ).datepicker({
                   dateFormat: 'dd/mm/yy' 
                });
            });

      $('#addcars').validate({
        ignore: [],
        debug: false,
        rules: {
          // expiry_date: {
          //   required: true,
                   
          // },
          no_plate:{
            required:true
          },
          // model:{
          //   required:true
          // },
          // year:{
          //   required:true
          // },
          // file_no:{
          //   required:true
          // },
          // document_no:{
          //   required:true
          // },
          // chassis_no:{
          //   required:true
          // },
          // ownership_id:{
          //   required:true
          // },
          // driver_id:{
          //   required:true
          // }
          model:{
            required:true
          }

           
        },
        messages: {
          expiry_date: {
            required: "Expiry Date is required"
          },
          no_plate:{
            required:"No Plate is required"
          },
          model:{
            required:"Model is required"
          },
          year:{
            required:"Year is required"
          },
          file_no:{
            required:"File No is required"
          },
          document_no:{
            required:"Document No is required"
          },
          chassis_no:{
            required:"Chassis No is required"
          },
          ownership_id:{
            required:"Ownership Name is required"
          },
          driver_id:{
            required:"Driver Name is required"
          },
          branch:{
            required:"Branch is required"
          }
          
        }
      });
    });
  </script>
@stop
