@extends('adminlte::page')

@section('title', 'KYC Verification')

@section('content_header')
@stop

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Linked Accounts</h3>
            <!-- <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> -->
          </div>

          
          <img id="loader" src="{{asset('images/loader.gif')}}" style="margin: 0 auto;height: 100px;widows: 100px;display:none;margin-bottom:-80px;z-index:1;">
          
          @if($status==400)
          
            <p style="margin:30px 20px;">{{$message}}</p>
          
          @elseif($status==403)
            <p style="margin:30px 20px;">{{$message}}</p>
            <div class="card-footer">
              <button type="button" id="add_new_bank" class="btn btn-primary">Add New Bank Account</button>
            </div>
          @else
            <!-- <p style="margin:30px 20px;">{{$message}}</p> -->
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th>Account Name</th>
                  <th>Account Number</th>
                  <th>Account Type</th>
                  <th>Account Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              @foreach($accounts as $account)
              <tbody>
                <tr>
                  <td>{{$account->accountName}}</td>
                  <td>{{$account->accountNumber}}</td>
                  <td>{{$account->accountType}}</td>
                  <td>{{ucfirst($account->accountStatus)}}</td>
                  <td>
                    <a href="javascript:void(0)" title="Delete account" class="delete_account" data-accountName="{{$account->accountName}}"><i class="fa fa-trash" style="color:red;"></i></a>
                    <a href="javascript:void(0)" class="get_balance" title="Check Balance" data-accountName="{{$account->accountName}}"><i class="fa fa-money-check-alt" style="color:green;margin: 0px 5px;"></i></a>
                  </td>
                </tr>
              </tbody>
              
              @endforeach
            </table>
            <div class="card-footer">
              <button type="button" id="add_new_bank" class="btn btn-primary">Add New Bank Account</button>
            </div>
          @endif

          
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

  <script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>

  <script type="text/javascript">

    function launchPlaid(plaid_token) {

      const handler = Plaid.create({
          token: plaid_token,
          onSuccess: (public_token, metadata) => {  
            $('#loader').css('display','block');
            var counter = 0;
            $.each(metadata.accounts,function(ind,val){
              counter = counter + 1;
              
              $.ajax({
                type:"POST",
                url:"{{ route('add-bank-account') }}",
                data: {
                  public_token: public_token,
                  account: val,
                },
                success: function(response) {
                  console.log(response);
                  if(counter==metadata.accounts.length){
                    if(response.status==200){
                      swal('',response.message,'success');
                      location.reload();
                    }else{
                      swal('',response.message,'warning');
                    }
                    $('#loader').css('display','none');
                  }
                }
              });
            });                
          },
          onLoad: () => { },
          onExit: (err, metadata) => { 
            // document.getElementById('plaidToken').innerHTML = err;
            // document.getElementById('plaidMetadata2').value = JSON.stringify(metadata, null, 2); 
          },
          onEvent: (eventName, metadata) => { },
          receivedRedirectUri: null,
      });
    
      handler.open();
    }


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
            launchPlaid(response.data.link_token);

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
