@extends('adminlte::page')
@section('title', 'Super Admin | Loyalty Details')
@section('content_header')

@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-12">
    <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Loyalty Details</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @if($loyalty->loyalty_slug == 1)  
            <form id="editLoyaltyForm" method="post" action="{{route('loyalty.update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="loyalty_id" value="{{$loyalty->id}}">
                <div class="card-body form">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                            <div class="form-group">
                                <label>Loyalty Type <span class="text-danger"> *</span></label>
                                <input type="text" name="loyalty_type" class="form-control" id="loyalty_type" value="{{ $loyalty->loyalty_type ?? ''  }}"   maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 mt-3">Applicable for orders 
                             
                            </label> 
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                            <div class="form-group">
                                <label>From<span class="text-danger"> *</span></label>
                                <input type="number" name="applicable_from" class="form-control" id="applicable_from" value="{{ $loyalty->applicable_from ?? ''}}" min="0"  >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                                <label>To </label>
                                <input type="number" name="applicable_to" class="form-control" id="applicable_to" value="{{ $loyalty->applicable_to ?? ''}}"  min="0"  >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                                <label>Get Loyalty Points description<span class="text-danger"> *</span></label>
                                <input type="text" name="amount_text" class="form-control" id="amount_text" value="{{ $loyalty->amount_text ?? ''}}" maxlength="100" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                            <div class="form-group">
                                <label>Amount(%)<span class="text-danger"> *</span></label>
                                <input type="number" name="amount" class="form-control" id="amount" value="{{ $loyalty->amount ?? ''}}"  min="0" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                                <label>Redeem Loyalty Points description<span class="text-danger"> *</span></label>
                                <input type="text" name="redeem_text" class="form-control" id="redeem_text" value="{{ $loyalty->redeem_text ?? ''}}" maxlength="100"  >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                                <label>Amount(%)<span class="text-danger"> *</span></label>
                                <input type="number" name="redeem_amount" class="form-control" id="redeem_amount" value="{{ $loyalty->redeem_amount ?? ''}}"  min="0" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group mt-3">
                                <label for="password_confirmation">Thumbnail<span class="text-danger"> *</span></label>
                                <input type="file" name="thumbnail" onchange="readURL(this);" class="form-control thumbnail_pic" accept="image/*">
                                @if($errors->has('thumbnail'))
                                <div class="error">{{ $errors->first('thumbnail') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                            <div class="form-group mt-3">
                                <label>Status</label>
                                <select  class="form-control" name="status">
                                <option value="1" {{ $loyalty->status == 1 ? 'selected':''  }}  >Active</option>
                                <option  value="0" {{ $loyalty->status == 0 ? 'selected':''  }}  >Inactive</option>
                                </select>
                            </div>
                        </div>
                        <!-- show thumbnail -->
                        <div class="row" >
                            <img src="{{ url('loyalty/thumbnail')}}/{{$loyalty->loyalty_image}}" id="thumbnail_preview" style="width:300;height:130px;" class="{{$loyalty->loyalty_image != null ? '':'d-none'}} ">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
                    </div>
            </form>
            @else
            <form id="editLoyaltyFormSignUp" method="post" action="{{route('loyalty.update')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="loyalty_id" value="{{$loyalty->id}}">
            <div class="card-body form">
            <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3">
            <div class="form-group">
            <label>Loyalty Type <span class="text-danger"> *</span></label>
            <input type="text" name="loyalty_type" class="form-control" id="loyalty_type" value="{{ $loyalty->loyalty_type ?? ''  }}" maxlength="100" >
            </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
            <div class="form-group">
            <label>Amount<span class="text-danger"> *</span></label>
            <input type="number" name="amount" class="form-control" id="amount" value="{{ $loyalty->amount ?? ''}}"  min="0">
            </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
            <div class="form-group mt-3">
            <label for="password_confirmation">Thumbnail<span class="text-danger"> *</span></label>
            <input type="file" name="thumbnail" onchange="readURL(this);" class="form-control thumbnail_pic" accept="image/*">
            @if($errors->has('thumbnail'))
            <div class="error">{{ $errors->first('thumbnail') }}</div>
            @endif
            </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-6">
            <div class="form-group mt-3">
            <label>Status</label>
            <select  class="form-control" name="status">
            <option value="1" {{ $loyalty->status == 1 ? 'selected':''  }}  >Active</option>
            <option  value="0" {{ $loyalty->status == 0 ? 'selected':''  }}  >Inactive</option>
            </select>
            </div>
            </div>
            <!-- show thumbnail -->
            <div class="row" >
            <img src="{{ url('loyalty/thumbnail')}}/{{$loyalty->loyalty_image}}" id="thumbnail_preview" style="width:300;height:130px;" class="{{$loyalty->loyalty_image != null ? '':'d-none'}} ">
            </div>
            </div>
            <div class="card-footer">
            <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
            </div>
            </form>
            @endif
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
 
$(document).ready(function(){

     $('#editLoyaltyForm').validate({

            ignore: [],
            debug: false,
            rules: {
            loyalty_type: {
            required: true,
            
            },
            applicable_from: {
            required: true,
            },
             sapplicable_to: {
            required: true,
            },
             amount_text: {
            required: true,
            },
             amount: {
            required: true,
            },
             redeem_text: {
            required: true,
            },
             redeem_amount: {
            required: true,
            },

            },
            messages: {
            loyalty_type: {
            required: "Loyalty type is required",
            },
            applicable_from: {
            required: "From is required",
            },
             sapplicable_to: {
            required: "To is required",
            },
             amount_text: {
            required: "Loyalty description is required",
            },
             amount: {
            required: "Loyalty amount(%) is required",
            },
             redeem_text: {
            required: "Redeeem description is required",
            },
             redeem_amount: {
            required: "Redeeem amount(%) is required",
            },
             
            }
            });


       $('#editLoyaltyFormSignUp').validate({

            ignore: [],
            debug: false,
            rules: {
            loyalty_type: {
            required: true,
            
            },
            
             amount: {
            required: true,
            },
            

            },
            messages: {
            loyalty_type: {
            required: "Loyalty type is required",
            },
            
             amount: {
            required: "Loyalty amount(%) is required",
            },
             
             
            }
            });
});

</script>


<script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function (e) {
          $('#thumbnail_preview').css('display', 'block');
          // $(".remove-pro-img").removeClass("d-none");
           $('#thumbnail_preview').removeClass("d-none");
          $('#thumbnail_preview').attr('src', e.target.result);
        };
    
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>



@stop
