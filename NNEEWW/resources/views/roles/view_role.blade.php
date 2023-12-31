@extends('adminlte::page')

@section('title', 'Role Information')

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
                  <h3 class="mb-0">{{ __('adminlte::adminlte.role') }}</h3>
                  <a class="btn btn-sm btn-success add-advance-options" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                </div>
                <div class="card-body main_body form p-3">
                  @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                  @endif
                  <form class="form_wrap">

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.role_name') }}</label>
                          <input class="form-control" placeholder="{{ $role->name }}" readonly>
                        </div>
                      </div>
                      
                      <div class="col-6">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.role_tag') }}</label>
                          <input class="form-control" placeholder="{{ $role->tag }}" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.role_permissions') }}</label>
                          <?php 
                            $permissions = $role->permissions;
                            $permissionNames = [];
                            for($i=0; $i<count($permissions);$i++) {
                              array_push($permissionNames, $permissions[$i]->slug);
                            }
                          ?>
                          <div class="permission-names row">
                            <?php foreach($permissionNames as $name) {
                              echo '<li class="col-3">'.ucwords(str_replace('_', ' ', $name)).'</li>';
                            } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                      
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.created_date') }}</label>
                          <input class="form-control" placeholder="{{ $role->created_at ?  $role->created_at->format('m/d/Y') : '' }}" readonly>
                        </div>
                      </div>
                      
                      <div class="col-6">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                          <input class="form-control" placeholder="{{ $role->updated_at ? $role->updated_at->format('m/d/Y') : '' }}" readonly>
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
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <style>
  .permission-names {
    background-color: #efefef;
    border: 1px solid #efefef;
    padding: 15px;
    border-radius: 5px;
  }
  </style>
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
    $('#delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      console.log("ID - ", id);
      var obj = $(this);
      console.log("obj - ", obj);
      e.preventDefault();
      swal({
        title: "Are you sure you want to delete Role?",
        text: "",
        icon: "warning",
        buttons:{
          confirm: {
            text : 'Yes',
            className : 'btn btn-success'
          },
          cancel: {
            visible: true,
            className: 'btn btn-danger'
          }
        },
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url:"{{url('delete_role')}}",
            type:'post',
            data:{
              id:id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
              window.location.reload();
              /* console.log("response", response);
              obj.parent().parent().remove(); */
            }
          });
        } 
      });
    });
  </script>
@stop
