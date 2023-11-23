@extends('adminlte::page')

@section('title', 'Redeem Wallet')

@section('content_header')
@stop

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Redeem Wallet</h3>
          </div>

          
          <img id="loader" src="{{asset('images/loader.gif')}}" style="margin: 0 auto;height: 100px;widows: 100px;display:none;margin-bottom:-80px;z-index:1;">
          
          <div class="card-body">                
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="user_name">Select Account<span class="text-danger"> *</span></label>
                  <input type="text" name="amount" class="form-control" id="amount" maxlength="100" autocomplete="nope" value="">
                  <label class="error" style="display:none;" id="amount_error"></label>
                  @if($errors->has('amount'))
                    <div class="error">{{ $errors->first('amount') }}</div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  <script type="text/javascript">

    // add new bank
    $(document).on('click','#add_new_bank',function(){

      $('#add_new_bank').prop('disabled','disabled');
      $('#loader').css('display','block');

      $.ajax({
        type:"GET",
        url:"{{ route('create-plaid-token') }}",
        success: function(response) {
          console.log('Create plaid link token');
          console.log(response);
          if(response.status==200){

            $('#add_new_bank').prop('disabled','');
            $('#loader').css('display','none');

          }else{
            swal('',response.message,'warning');
          }
        }
      });
    })
    // add new bank

    // get account balance
    $(document).on('click','.get_balance',function(){
      var account_name = $(this).attr('data-accountName');
      console.log(account_name);
      $('#loader').css('display','block');
      $.ajax({
        type:"POST",
        url:"{{ route('get-account-balance') }}",
        data: {
          account_name: account_name
        },
        success: function(response) {
          console.log(response);
          $('#loader').css('display','none');
          if(response.status==200){
            swal('Account balance fetched successfully!','Your account balance is: $'+response.data.availableBalance,'success');
            // location.reload();
          }else{
            swal('',response.message,'warning');
          }
          
        }
      });

    })
    // get account balance

    // delete account
    $(document).on('click','.delete_account',function(e){
      e.preventDefault();
      
      var account_name = $(this).attr('data-accountName');
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to remove this account?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $('#loader').css('display','block');
          $.ajax({
            url: "{{ route('remove-account') }}",
            type: 'post',
            data: {
              account_name: account_name
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              console.log("Response", response);
              if(response.statusCode==200){
                swal(response.accountName,response.message,'success');
                location.reload();
              }else{
                swal('',response.message,'warning');
              }
              $('#loader').css('display','none');
            }
          });
        } 
      });
    })
    // delete account

  </script>

@stop
