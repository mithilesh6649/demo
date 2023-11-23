@extends('adminlte::page')

@section('title', 'Add Account')

@section('content_header')
@stop

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>Add Account</h3>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form id="addAccountForm" method="post", action="{{ route('submit-account') }}">
            @csrf
            <div class="card-body">                
              <div class="row">

                <div class="col-6">
                  <div class="form-group">
                    <label for="account_name">Account Name<span class="text-danger"> *</span></label>
                    <input type="text" name="account_name" class="form-control" id="account_name" placeholder="Account Name">
                  </div>
                </div>


                <div class="col-6">
                  <div class="form-group">
                    <label for="account_type">Account Type<span class="text-danger"> *</span></label>
                    <select name="account_type" class="form-control" id="account_type">
                      <option value="" hidden>Account Type</option>
                      @if(@$kyc != '')
                      <option value="personalChecking">Personal</option>
                      @endif
                      @if(@$kyb != '')
                      @foreach($kybs as $kyb)
                      <option value="businessChecking">$kyb->getbusiness->legalName</option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group d-flex align-items-center position-relative">
                    <div class="custom_check">
                        <input type="checkbox" class="form-check-input" id="account_terms" name="account_terms">
                        <span></span>                                    
                    </div>
                    <label for="account_terms" class="mb-0 ml-2">Please accept Account Terms & Conditions<span class="text-danger"> *</span></label>
                    <span class="account-terms-error"></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" id="submit_btn" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
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
<script>

  $('#addAccountForm').validate({
    ignore: [],
    debug: false,
    rules: {
      account_name: {
        required: true,
        noSpace : true
      },
      account_type: {
        required: true,
      },
      account_terms: {
        required: true,
      },
    },
    messages: {
      account_name: {
        required: "The Account Name is required"
      },
      account_type: {
        required: "The Account Type is required"
      },
      account_terms: {
        required: "Please accept Account Terms & Conditions*",
      },
    }
  });

  $.validator.addMethod("noSpace", function(value, element) { 
    return $.trim(value).length!=0; 
  }, "Please don't leave it empty.");

</script>
@stop
