@extends('adminlte::page')

@section('title', 'view Car details')

@section('content_header')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
              <h3>View Car Details</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body table p-0 mb-0">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
 
              <form  method="post"  >
               
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

                    <input type="hidden" name="id" value="{{$driver->id}}">
                    <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="lease">Lease No</label>
                            <input type="text" name="lease" class="form-control" id="lease" readonly value="{{$driver->lease_no ?? 'N/A'}}" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('lease'))
                              <div class="error">{{ $errors->first('lease') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="expiry_date">Expiry Date</label>
                            <input type="text" name="expiry_date" class="form-control" readonly value="{{$driver->expiry_date =='' ? 'N/A':date('d/m/Y ',strtotime($driver->expiry_date)) }}" id="expiry_date" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('expiry_date'))
                              <div class="error">{{ $errors->first('expiry_date') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">

                        <div class="col-6">
                          <div class="form-group">
                            <label for="no_plate">No Plate</label>
                            <input type="text" name="no_plate" class="form-control" readonly value="{{$driver->no_plate ?? 'N/A'}}" id="no_plate" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('no_plate'))
                              <div class="error">{{ $errors->first('no_plate') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" name="model" class="form-control" readonly value="{{$driver->model ?? 'N/A'}}" id="model" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('model'))
                              <div class="error">{{ $errors->first('model') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">

                        <div class="col-6">
                          <div class="form-group">
                            <label for="year">Year</label>
                            <input type="text" name="year" class="form-control" readonly value="{{$driver->year ?? 'N/A'}}" id="year" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('year'))
                              <div class="error">{{ $errors->first('year') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="file_no">File No</label>
                            <input type="text" name="file_no" class="form-control" readonly value="{{$driver->file_no ?? 'N/A'}}" id="file_no" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('file_no'))
                              <div class="error">{{ $errors->first('file_no') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">

                        <div class="col-6">
                          <div class="form-group">
                            <label for="document_no">Document No</label>
                            <input type="text" name="document_no" readonly value="{{$driver->document_no ?? 'N/A'}}" class="form-control" id="document_no" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('document_no'))
                              <div class="error">{{ $errors->first('document_no') }}</div>
                            @endif
                          </div>
                        </div>
                       <div class="col-6">
                          <div class="form-group">
                            <label for="chassis_no">Chassis No</label>
                            <input type="text" name="chassis_no" readonly value="{{$driver->chassis_no ?? 'N/A'}}" class="form-control" id="chassis_no" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('chassis_no'))
                              <div class="error">{{ $errors->first('chassis_no') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">

                        <div class="col-6">
                          <div class="form-group">
                            <label for="ownership_id">Ownership Name</label>
                             
                             <select class="form-control form-select" disabled id="ownership_id" name="ownership_id">
                               <option value="">Ownership Name</option>
                               @foreach($owner as $olist)
                                <option value="{{$olist->id}}" {{$driver->owner_id==$olist->id?'selected':''}}> {{$olist->ownership_name}}</option>
                               @endforeach
                               
                             </select>

                            <div id ="function_error" class="error"></div>
                            @if($errors->has('year'))
                              <div class="error">{{ $errors->first('year') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label for="driver_name">Driver Name</label>
                             <select class="form-control form-select" disabled id="driver_name" name="driver_id">
                               <option value="">Driver Name</option>
                               @foreach($drivers as $dlist)
                                <option value="{{$dlist->id}}" {{$driver->driver_id==$dlist->id?'selected':''}}>{{$dlist->drivers_name}}</option>
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
                            <label for="branch">Branch</label>
                            <input type="text" name="branch" readonly class="form-control" value="{{$driver->branch ?? 'N/A'}}" id="branch" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('branch'))
                              <div class="error">{{ $errors->first('branch') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label for="ins_no">INS No</label>
                            <input type="text" name="ins_no" readonly class="form-control" value="{{$driver->ins_no ?? 'N/A'}}" id="ins_no" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('ins_no'))
                              <div class="error">{{ $errors->first('ins_no') }}</div>
                            @endif
                          </div>
                        </div>

                             <div class="col-6">
                          <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <input type="text" name="remarks" readonly class="form-control" value="{{$driver->remarks ?? 'N/A'}}" id="remarks" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('remarks'))
                              <div class="error">{{ $errors->first('remarks') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">

                   

                        <div class="col-12">
                          <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" name="status" readonly class="form-control" value="{{$driver->status==1?'Active':'Inactive'}}" id="status" maxlength="100">
                            <div id ="function_error" class="error"></div>
                            @if($errors->has('status'))
                              <div class="error">{{ $errors->first('status') }}</div>
                            @endif
                          </div>
                        </div>

                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                 
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

@stop
