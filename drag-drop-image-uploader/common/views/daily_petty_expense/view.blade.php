@extends('adminlte::page')
@section('title', 'Super Admin |  Daily Petty Expense Report Details')
@section('content_header')

@section('content')

<?php 

  $category = [];
?>

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3>Daily Petty Expense Report Details</h3>
                  <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
               </div>
               <div class="card-body p-0">
                  @if (session('status'))
                  <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                  </div>
                  @endif
                  <form id="addCategoryForm" method="post" action="{{ route('categories.update') }}" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body table form mb-0">
                        <div class="row">
                           <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                              <div class="form-group">
                                 <label>Category</label>
                                <input type="text" class="category form-control" name="category"
                                                        id="category"
                                                        value="{{ $daily_petty_expense->category->cat_name }}" readonly>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                              <div class="form-group">
                                 <label>Sub Category</label>
                                   <input type="text" class="sub_category form-control"
                                                        name="sub_category" id="sub_category"
                                                        value="{{ $daily_petty_expense->sub_category->sub_cat_name ?? 'N/A' }}"
                                                        readonly>
                              </div>
                           </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                              <div class="form-group">
                                 <label>Document Reference Number</label>
                                   <input type="text" name="doc_ref_no" id="doc_ref_no"
                                                        class="form-control" value="{{ $daily_petty_expense->doc_ref_no ?? 'N/A' }}"
                                                        readonly>
                              </div>
                           </div>



                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                              <div class="form-group">
                                 <label>  Voucher  Number</label>
                                   <input type="text" name="doc_ref_no" id="doc_ref_no"
                                                        class="form-control" value="{{ $daily_petty_expense->voucher_number ?? 'N/A' }}"
                                                        readonly>
                              </div>
                           </div>


                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                              <div class="form-group">
                                 <label>Amount</label>
                                 <input type="number" step="0.01" name="amount"
                                                        class="amount form-control" placeholder="Amount" id="amount"
                                                        maxlength="100" value="{{ $daily_petty_expense->amount ?? 'N/A' }}"
                                                        aria-invalid="false" readonly>
                              </div>
                           </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                              <div class="form-group">
                                 <label>Remarks</label>
                                <input type="text" class="form-control" id="remarks"
                                                            name="remarks" value="{{ $daily_petty_expense->remarks ?? 'N/A' }}"
                                                            readonly>
                              </div>
                           </div>
                          
                         


                                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                      <div class="form-group mt-3">
                        <label for="address">Image</label>
                         <div class="row">
                          @forelse ($daily_petty_expense->DailyPettyExpenseDoc as $key=>$images)
                         <div class="col-md-4 col-lg-64 col-xl-4 col-12 branch_image_box" image_id='{{$key}}'>
                            <div class="border">
                                <img src="{{$images->doc}}"  >
                              </div>
                            </div>
                            @empty
                            <div class="col-md-4 border text-center font-weight-bold">
                               <p class='p-2'>No Images available</p>
                            </div>
                            @endforelse 
                         </div>    
                      </div>
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


    <!-- /.card-body -->
        
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"> Image</h5>
                      <button type="button" class="close"
                          data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">
                              ×
                          </span>
                      </button>
                    </div>
                    <div class="modal-body" class="image_preview">
                      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" style=" width:100%; height:400px !important;">
                 


                             @forelse ($daily_petty_expense->DailyPettyExpenseDoc as $key=>$images)
                            
                         <div class="carousel-item show_image_id" show_image_id='{{$key}}'>
                            <img class="d-block " style="width: 100%; height: 400px;"     src="{{$images->doc}}" alt="First slide" >
                          </div>

                      @endforeach
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!---fsdfdsfd---->


@endsection
@section('css')
<style type="text/css">
    .form-group textarea{
        height: 90px !important;
    }
</style>
@stop
@section('js')



<script>
  
  $(document).ready(function(){
    $('.click_me').click(function(){
       $('#exampleModal').modal('show');
    });
  });


  $(document).ready(function(){
   $('.branch_image_box').each(function(){
     $(this).click(function(){
         
          $('.show_image_id').each(function(){
            $(this).removeClass('active');
          });

            var image_id = $(this).attr('image_id');
          $('#exampleModal').modal('show');

          $('.show_image_id').each(function(){
              
             if($(this).attr('show_image_id') == image_id){
              $(this).addClass('active');
             }

          });

        
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
