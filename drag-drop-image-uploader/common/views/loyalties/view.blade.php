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
            <form id="addCategoryForm" method="post" action="{{ route('categories.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body form">
                    <div class="row">
                        @if($loyalty->loyalty_slug == 1) 
                        <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                            <div class="form-group">
                                <label>Loyalty Type</label>
                                <input type="text" name="loyalty_type" class="form-control" id="loyalty_type" value="{{ $loyalty->loyalty_type ?? ''  }}"  readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 mt-3">Applicable for orders 
                            </label> 
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                            <div class="form-group">
                                <label>From</label>
                                <input type="text" name="applicable_from" class="form-control" id="applicable_from" value="{{ $loyalty->applicable_from ?? ''}}"  readonly >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                                <label>To</label>
                                <input type="text" name="applicable_to" class="form-control" id="applicable_to" value="{{ $loyalty->applicable_to ?? ''}}"  readonly >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                                <label>Get Loyalty Points description</label>
                                <input type="text" name="amount_text" class="form-control" id="amount_text" value="{{ $loyalty->amount_text ?? ''}}"  readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                            <div class="form-group">
                                <label>Amount(%)</label>
                                <input type="number" name="amount" class="form-control" id="amount" value="{{ $loyalty->amount ?? ''}}"  readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                                <label>Redeem Loyalty Points description</label>
                                <input type="text" name="redeem_text" class="form-control" id="redeem_text" value="{{ $loyalty->redeem_text ?? ''}}"  readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                                <label>Amount(%)</label>
                                <input type="number" name="redeem_amount" class="form-control" id="redeem_amount" value="{{ $loyalty->redeem_amount ?? ''}}"  readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-6  ">
                            <div class="form-group mt-3">
                                <label class="d-block">Thumbnail</label>
                                <img src="{{asset('loyalty/thumbnail/'.$loyalty->loyalty_image)}}" style="width:400px;height:180px;cursor: pointer;"  class="category_image">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                            <div class="form-group mt-3">
                                <label>Status</label>
                                <select disabled class="form-control" name="status">
                                <option value="1" {{ $loyalty->status == 1 ? 'selected':''  }}  >Active</option>
                                <option  value="0" {{ $loyalty->status == 0 ? 'selected':''  }}  >Inactive</option>
                                </select>
                            </div>
                        </div>
                        @else
                        <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3">
                            <div class="form-group">
                                <label>Loyalty Type</label>
                                <input type="text" name="loyalty_type" class="form-control" id="loyalty_type" value="{{ $loyalty->loyalty_type ?? ''  }}"  readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" name="amount" class="form-control" id="amount" value="{{ $loyalty->amount ?? ''}}"  readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-6  ">
                            <div class="form-group mt-3">
                                <label class="d-block">Thumbnail</label>
                                <img src="{{asset('loyalty/thumbnail/'.$loyalty->loyalty_image)}}" style="width:400px;height:180px;cursor: pointer;"  class="category_image">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                            <div class="form-group mt-3">
                                <label>Status</label>
                                <select disabled class="form-control" name="status">
                                <option value="1" {{ $loyalty->status == 1 ? 'selected':''  }}  >Active</option>
                                <option  value="0" {{ $loyalty->status == 0 ? 'selected':''  }}  >Inactive</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        <!-- /.card-body -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Loyalty Thumbnail</h5>
                                        <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                        ×
                                        </span>
                                        </button>
                                    </div>
                                    <div class="modal-body" class="image_preview">
                                        <div class="carousel-inner" style=" width:100%; height:400px !important;">
                                            <div class="carousel-item  active"  >
                                                <img class="d-block " style="width: 100%; height: 400px;"     src="{{asset('loyalty/thumbnail/'.$loyalty->loyalty_image)}}" alt="First slide" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---fsdfdsfd---->
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
 

 
 
  $(document).ready(function(){
   $('.category_image').each(function(){
     $(this).click(function(){
         
        

          
          $('#exampleModal').modal('show');

       

        
     });
   });
  });



   $(document).ready(function(){
 
  $('.carousel').carousel({
  interval: false,
});
 });



</script>



@stop
