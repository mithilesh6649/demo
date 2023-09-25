@extends('adminlte::page')

@section('title', 'Super Admin | Edit Offer  ')

@section('content_header')
 

@section('content') 

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
               <h3>Edit Checkout Offer</h3>
            </div>
            <div class="card-body table form mb-0">
               @if (session('status'))
               <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
               @endif
               <form id="addOfferForm" method="post" action="{{route('checkout.offers.update')}}" enctype="multipart/form-data">
                  @csrf 
                  <input type="hidden" name="offers_id" value="{{$offer->id}}" >
                   <div class="row">
                      <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                         <div class="form-group"> <label>Offer Name<span class="text-danger"> *</span></label>
                            <input type="text" name="offer_name" class="form-control" id="offer_name" maxlength="100" value="{{$offer->offer_name ?? ''}}"> 
                         </div>
                      </div>
                       <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                         <div class="form-group">
                            <label for="description">Description<span class="text-danger"> *</span></label> 
                        
                            <input type="text" name="description" class="form-control" id="description" maxlength="100" value="{{$offer->description ?? ''}}"> 
                        
                         </div>
                      </div>
                   
                     </div>

                   <div class="row">
                      <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                         <div class="form-group mt-3">
                            <label for="discount_type">Offer Type<span class="text-danger"> *</span></label> 
                           <select class="form-control" id="select" name="offer_type">
                              <option value="">Select Offer Type  </option>
                              @foreach($offerType as $offerTypes)
                                  <option value="{{$offerTypes->value}}" {{ $offer->offer_type==$offerTypes->value?'selected' : ' ' }} >{{$offerTypes->name}}</option>
                              @endforeach
                               
                      </select>
                         </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                         <div class="form-group mt-3"> <label for="title_en">Percentage/Amount <span class="text-danger"> *</span></label> <input type="number" name="offer_amount" class="form-control" id="discount_amount" maxlength="100" value="{{$offer->offer_amount ?? ''}}"> </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                         <div class="form-group mt-3"> <label for="start_date">Start Date/ Time<span class="text-danger"> *</span></label> <input type="text" name="start_date" class="form-control offerscheckout_date" id="start_date" maxlength="100" value="{{date('d/m/Y h:00 A',strtotime($offer->start_date))}}"> </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                         <div class="form-group mt-3"> <label for="end_date">End Date/ Time<span class="text-danger"> *</span></label> <input type="text" name="end_date" class="form-control offerscheckout_date" id="end_date" maxlength="100" value="{{date('d/m/Y h:00 A',strtotime($offer->end_date))}}"> </div>
                      </div>
                   </div>
                   <div class="row">
                       <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                         <div class="form-group mt-3">
                            <label for="discount_status">Status<span class="text-danger"> *</span></label> 
                            <select class="form-control" name="discount_status" id="discount_status">
                                  @foreach($status as $status_data)
                                    <option value="{{$status_data->value}}" @if($status_data->value==$offer->status)selected @endif>{{$status_data->name}}</option>
                                   @endforeach
                            </select>
                         </div>
                      </div>
                   </div>
                   <label class="mb-3 mt-3">Offer applied on 
                   <a class="btn info_btn" data-toggle="tooltip" data-placement="right" title="Select Branch and Category/ Menu Item " >
                   <i class="fa fa-question-circle"></i>
                   </a>
                   </label>
                   <div>
                      <div class="btn-group d-flex flex-wrap justify-content-between w-100">
                        <div class="left_tab">
                          <button type="button" class="btn btn-warning w-100" id="branch-modal"> Branch</button>
                          <div class="border mt-3 edit" id="all_selected_branch_container">
                          <!--  <h5>Selected Branches List</h5> -->
                           
                          <ul id='show_all_selected_branch' class="mb-0">
                           @foreach ($offer->CheckoutOfferBranch as $checkoutOffers)              
                              
                               <li ><strong class="list-text">{{@$checkoutOffers->branch->title_en}}</strong></li>
                              
                            @endforeach   
                             </ul>

                        </div>
                        </div>
                        <div class="right_tab">
                          <button type="button" class="btn btn-success w-100" id="categories-modal"> Category/ Menu Item </button>
                          <div class="border mt-3 edit" id="all_selected_categories_container">
                           <div class="show_all_selected_categories accordion" id="selectedaccordionExample">
                                @foreach ($selected_menuItem as $key=>$selectitem)
                                     @php
                                      $flg31=\App\Models\CheckoutOfferItem::getcatName($key); 
                                     @endphp
                                   <div class="main_container">
                                   <div class="card categories">
                                      <div class="position-relative">
                                        <div class="card-header collapsed" data-toggle="collapse" data-target="#categoriess_{{$key}}" aria-expanded="false">
                                           <span class="title">
                                             @php 
                                              echo $flg31;
                                             @endphp
                                           </span>
                                           <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                                        </div>
                                      </div>
                                      <div id="categoriess_{{$key}}" class="collapse" data-parent="#selectedaccordionExample" >
                                         <div class="card-body ">
                                            <div class="items-container">
                                              @foreach($selectitem as $value)
                                               <!-- <div class="col-md-12">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                      
                                                       <strong class="list-text"> &nbsp;

                                                 @php  
                                                 $flg2=\App\Models\CheckoutOfferItem::getMenuItem($value->menu_item_id); 
                                              
                                                  echo $flg2;
                                                 @endphp
                                                       </strong>
                                                    </div>
                                                 </div> -->
                                                 <ul class="mb-0">
                                                   @php  
                                                 $flg2=\App\Models\CheckoutOfferItem::getMenuItem($value->menu_item_id); 
                                              
                                                 
                                                 @endphp
                                                 <li><strong class="list-text">@php echo $flg2; @endphp</strong></li>
                                                 </ul>
                                               @endforeach
                                             
                                            </div>
                                         </div>
                                         
                                      </div>
                                   </div>
                                </div>
                                @endforeach

                             </div>   
                        </div>
                        </div>
                      </div>
                      <!-- <div class="d-flex align-items-center justify-content-between flex-wrap mt-0 pl-0 mb-0">
                        <div class="border mt-3 edit" id="all_selected_branch_container">
                           
                          <table style="width:100%"  class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody id='show_all_selected_branch'>
                           @foreach ($offer->CheckoutOfferBranch as $checkoutOffers)              
                              <tr>
                               <td >{{@$checkoutOffers->branch->title_en}}</td>
                               </tr>
                            @endforeach   

                          </tbody>
                          </table>

                        </div>
                        <div class="border mt-3 edit" id="all_selected_categories_container">
                           <div class="show_all_selected_categories accordion" id="selectedaccordionExample">
                                @foreach ($selected_menuItem as $key=>$selectitem)
                                     @php
                                      $flg31=\App\Models\CheckoutOfferItem::getcatName($key); 
                                     @endphp
                                   <div class="main_container">
                                   <div class="card categories">
                                      <div class="position-relative">
                                        <div class="card-header collapsed" data-toggle="collapse" data-target="#categoriess_{{$key}}" aria-expanded="false">
                                           <span class="title">
                                             @php 
                                              echo $flg31;
                                             @endphp
                                           </span>
                                           <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                                        </div>
                                        
                                      </div>
                                      <div id="categoriess_{{$key}}" class="collapse" data-parent="#selectedaccordionExample" >
                                         <div class="card-body ">
                                            <div>
                                              @foreach($selectitem as $value)
                                               <div class="col-md-12">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                      
                                                       <strong class="list-text"> &nbsp;

                                                 @php  
                                                 $flg2=\App\Models\CheckoutOfferItem::getMenuItem($value->menu_item_id); 
                                              
                                                  echo $flg2;
                                                 @endphp
                                                       </strong>
                                                    </div>
                                                 </div>
                                               @endforeach
                                             
                                            </div>
                                         </div>
                                         
                                      </div>
                                   </div>
                                </div>
                                @endforeach

                             </div>   
                        </div>
                     </div> -->
                   </div>
                   <!-- Modal --> 
                     <div id="cat-modal" class="modal  fade  " role="dialog">
                      <div class="modal-dialog ">
                         <!-- Modal content-->
                         <div class="modal-content menu">
                            <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" id="category_close_icon">&times;</button>
                               <h4 class="modal-title">
                                  <div > 
                                     Edit Menu Categories and items
                                  </div>
                               </h4>
                               <p class=" d-none select_branch_warning p-2 border bg-danger" style="width:fit-content;">Please Select Category/Menu Item and proceed</p>

                            </div>
                            <div class="modal-body categories-content">
                               {{--$categories--}}
                               <!--start container -->
                               <div class="container-fluid  category_all_inputs_container " id="quick_view_container">
                                   <div class="accordion" id="accordionExample">
                                    <div class="all-content d-flex align-items-center w-100">
                                                <div class="custom-check">
                                                    <input type="checkbox" id="category" name="category[]" class="checkItemsAllcategory selected">
                                                    <span></span>
                                                </div>
                                                <strong class="list-text ml-3">All </strong>
                                            </div>
                                        
                                        <div class="main_container">
                                          @forelse ($categories as $categorie)
                                           
                                           @php
                                              $flg1=\App\Models\CheckoutOffer::checkedcategory($offer->id,$categorie->id);
                                           @endphp
                                             
                                           <div class="card categories">
                                              <div class="position-relative">
                                                <div class="card-header collapsed" data-toggle="collapse" data-target="#{{preg_replace('/[^A-Za-z0-9\-]/','',str_replace(' ','',$categorie->name_en))}}" aria-expanded="false">
                                                   <span class="title">{{$categorie->name_en}} <span class="text-success p-2 selected_items_count_show border shadow-sm " style="border:3px solid #ddd;background:#f6f6f6;" > </span></span>
                                                   <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                                                </div>
                                                 <input type="checkbox" id="category" name="category[]" class="checkItemsAll selected" value="{{$categorie->id}}" {{$flg1==1?'checked':''}}>
                                              </div>
                                              <div id="{{preg_replace('/[^A-Za-z0-9\-]/','',str_replace(' ','',$categorie->name_en))}}" class="collapse" data-parent="#accordionExample" >
                                                 <div class="card-body ">
                                                    <div class="items-container menu_item_container_for_out_of">
                                                       @forelse ($categorie->menuItems as $items)
                                                         @php
                                                         $flg2=\App\Models\CheckoutOffer::checkedmenuitem($offer->id,$items->id);
                                                     @endphp
                                                       <div class="col-md-12">
                                                          <div class="d-flex justify-content-start">
                                                             <div class="custom-check">
                                                                <input type="checkbox" id="category" name="menu_items[]" class="ckbCheckAllItems" value="{{$items->id}}" category-name-attr="{{$categorie->name_en}}:{{$items->item_name_en}}" {{$flg2==1?'checked':''}}>  
                                                                <span></span>                             
                                                             </div>
                                                             <strong class="list-text"> &nbsp; {{$items->item_name_en}}</strong>
                                                          </div>
                                                       </div>
                                                       @empty
                                                       <p>No users</p>
                                                       @endforelse
                                                    </div>
                                                 </div>
                                                 {{--$categorie->menuItems--}}
                                              </div>
                                           </div>
                                           @empty
                                        @endforelse
                                        </div>
                                        
                                   </div>
                               </div>
                            </div>
                             <div class="card-footer pt-0 pb-4 " align="center"> 
                             
                               <!-- <button type="button" class="btn btn-success" id="category_unselect_all" data-dismiss="modal">Close </button> -->
                               <button type="button" class="btn btn-danger" id="category_save_countinue">Save and Continue</button>
                             
                         </div>

                 <!--  <span class="text-danger text-center p-2 select_branch_warning d-none">Please Select Category/Menu Item and proceed</span> -->       
                         <!--end container -->
                      </div>
                   </div>
                </div>
            </div>
            <!--end modal --> 
            <!-- start branch modal -->
           <!-- Modal -->
            <div id="branches-modal" class="modal  fade  " role="dialog">
            <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content menu">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
            <div> 
            Edit Branches
            </div>
            </h4>
            <p class=" d-none select_branch_warning p-2 border bg-danger" style="width:fit-content;">Please Select branch and proceed</p>
            </div>
            <div class="modal-body">
            <!--start container -->
            <div class="container-fluid" id="quick_view_container">
            <div class="accordion" id="accordionExample">
            <div class="card categories">
            <div class="card-header " data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">     
            <span class="title">Select Branch</span>
            <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div class="card-body branch_all_inputs_container">
            <div class="all-content d-flex align-items-center">
            <div class="custom-check">
               @php 
                 $flg22=\App\Models\CheckoutOffer::checkallbranch($offer->id);

               @endphp
            <input type="checkbox" id="category" name="branch[]" class="checkBranchAll" {{$flg22==1?'checked':''}}>  
            <span></span>                             
            </div>
            <strong class="list-text"> &nbsp; All </strong>
            </div>
            <div class="branch-container">
            @forelse ($branches as $branch)
              @php 
                $flag21=\App\Models\CheckoutOffer::checksinglebranch($branch->id,$offer->id);
              @endphp
               <div class="list-branch d-flex">
                  <div class="custom-check">
                  <input type="checkbox" id="category" name="branches[]" class="ckbCheckAll branch_inputs" value="{{$branch->id}}" branch-name-attr="{{$branch->title_en}}"  {{$flag21==1?'checked':''}} >  
                  <span></span>                             
                  </div>
               <strong class="list-text"> &nbsp;{{$branch->title_en}}</strong>
               </div>
            @empty
            <p>No users</p>
            @endforelse
            </div>
            </div>
            </div> 
            </div>  
            <!--end container -->
            </div>
            </div>
           <div class="card-footer pt-0 pb-4 " align="center"> 
                               
                             <!-- <button type="button" class="btn btn-success"  data-dismiss="modal">Close</button> -->
                             <button type="button" class="btn btn-danger" id="branch_save_countinue">Save and Continue</button>
                           
                           </div>

                   <!--  <span class="text-danger text-center p-2 select_branch_warning d-none">Please Select branch and proceed</span> -->       
            </div>
            </div>
            <!--end modal -->
           
         </div>
            <!--end modal -->
            <!-- end branch modal -->
            <!-- <div class="pl-3">
            <span class="text-danger  d-none  select_notice">  Branch and Category / Menu Item both are required  </span>
            </div> -->

               <p class=" d-none select_notice p-2 border bg-danger" style="width:fit-content;">Branch and Category / Menu Item both are required</p>

            <!-- /.card-body -->
            <div class="card-footer"> <button type="submit" class="button btn_bg_color common_btn text-white">Update</button></div>
            </form>
          </div>
         </div>
      </div>
   </div>
</div>
</div>
  

@endsection 

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<style type="text/css">
.card-header .title {
    font-size: 15px;
    color: #000;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 52vw;
}
.card-header .accicon {
  float: right;
  font-size: 20px;  
}
.card-header{
  cursor: pointer;
}
.card{
  border: 1px solid #ddd;
}
.card-header:not(.collapsed) .rotate-icon {
  transform: rotate(180deg);
}
.branch-container strong.list-text {
    padding-left: 4px;
}
.btn-group .left_tab .btn-warning:not(:disabled):not(.disabled):active {
    background-color: #000000;
    border: 1px solid #000000;
    color: #ffffff;
}
.btn-success:not(:disabled):not(.disabled):active {
    background-color: #ffca33;
    border: 1px solid #ffca33;
    color: #000000;
}
.card.categories .custom-check, .custom-check {
    margin: 4px 0;
}
</style>
@stop
 
@section('js')
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet"/>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>

<script type="text/javascript">
  
  $(document).ready(function(){

      //all check logic
     

     

     $(".checkItemsAllcategory").change(function() {
          if ($(this).prop('checked')) {
              $('.checkItemsAll').prop('checked', true);
              $('.ckbCheckAllItems').prop('checked', true);
          } else {
              $('.checkItemsAll').prop('checked', false);
              $('.ckbCheckAllItems').prop('checked', false);
          }

      });


      var all_category_input = $('.checkItemsAll');
            var category_input_length = all_category_input.length;
            var all_menu_item = $('.ckbCheckAllItems');
            var menu_item_length = all_menu_item.length;


            $(all_menu_item).each(function(data) {

                $(this).click(function() {

                    let count_menu_item = 0;

                    $(all_menu_item).each(function(data) {

                        if ($(this).is(':checked')) {
                            count_menu_item++;
                        }
                    });

                    if (menu_item_length == count_menu_item) {
                        $(".checkItemsAllcategory").prop('checked', 'true');
                    } else {
                        //  alert("false");
                        $(".checkItemsAllcategory").prop('checked', false);
                    }
                });
            });


 
    //Check all on load 
            $(all_menu_item).each(function(data) {

                $(this).ready(function() {

                    let count_menu_item = 0;

                    $(all_menu_item).each(function(data) {

                        if ($(this).is(':checked')) {
                            count_menu_item++;
                        }
                    });

                    if (menu_item_length == count_menu_item) {
                        $(".checkItemsAllcategory").prop('checked', 'true');
                    } else {
                        //  alert("false");
                        $(".checkItemsAllcategory").prop('checked', false);
                    }
                });
            });




               $(all_category_input).each(function() {
                $(this).click(function() {

                    var counts = 0;

                    $(all_category_input).each(function(data) {

                        if ($(this).is(':checked')) {
                            counts++;
                        }
                    });

                    if (category_input_length == counts) {
                        $(".checkItemsAllcategory").prop('checked', 'true');
                    } else {
                        //  alert("false");
                        $(".checkItemsAllcategory").prop('checked', false);
                    }

                });
            });
     
  $("#description").emojioneArea({
           pickerPosition: "bottom",
           filtersPosition: "bottom",
           tonesStyle: "square",
           shortnames: true,
           tones:false,
           search:false,
            
                  });

  $('#branch_save_countinue').on('click',function(){
    
       var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
     var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
     var  branch_sel_count = 0;
     var all_branches_name = [];
     $(all_inputs).each(function(){
           
           if($(this).is(':checked')){
               branch_sel_count++;
               if($(this).attr('branch-name-attr') != undefined){
               all_branches_name.push($(this).attr('branch-name-attr'));
                  }
           } 
     }); 

     if(branch_sel_count == 0){
       $('.select_branch_warning').removeClass('d-none');

       setTimeout(function(){
           $('.select_branch_warning').addClass('d-none');
       },2000); 
       return false;  
     }else{
 
         $('#branches-modal').modal('hide');  
          $('#all_selected_branch_container').removeClass('d-none'); 
          $('#show_all_selected_branch').html(' ');
          $(all_branches_name).each(function(data,index){
              var li = document.createElement('LI');
              // li.style.border = '1px solid #dee2e6';
              // li.style.textAlign = 'center';
              // li.style.height = '40px';
              // li.style.marginBottom = '8px';
              li.innerHTML = index;
            
              $('#show_all_selected_branch').append(li);
          }); 
     }
  });

$('#category_save_countinue').on('click',function(){
   
    
       var category_all_inputs_container = $('.category_all_inputs_container')[0];
      
     var all_inputs = category_all_inputs_container.getElementsByTagName('INPUT');

     var  category_sel_count = 0;
     var all_category_name = [];
     var maincategory=[];

     $(all_inputs).each(function(){

           if($(this).is(':checked')){
               category_sel_count++;
               if($(this).attr('category-name-attr') != undefined){
                 
                  if(jQuery.inArray($(this).attr('category-name-attr').split(":")[0], maincategory) != -1) {
                    all_category_name.push($(this).attr('category-name-attr'));
                  } else {
                      maincategory.push($(this).attr('category-name-attr').split(":")[0]);
                      all_category_name.push($(this).attr('category-name-attr'));
                  }
               }
           }  
     }); 
   

     if(category_sel_count == 0){
       $('.select_branch_warning').removeClass('d-none');

       setTimeout(function(){
           $('.select_branch_warning').addClass('d-none');
       },2000); 
       return false;  
     }else{
        
        $('#cat-modal').modal('hide');
          
          $('#all_selected_categories_container').removeClass('d-none'); 
 
          $('.show_all_selected_categories').html(' ');
           var html_data="";
          $(maincategory).each(function(data,index2){  

              html_data+='<div class="main_container"> <div class="card categories"><div class="position-relative"><div class="card-header collapsed" data-toggle="collapse" data-target="#'+index2.replaceAll(" ","").replaceAll("(","").replaceAll(")","").replaceAll(".","").replaceAll("&","")+'" aria-expanded="false"><span class="title">'+index2+'</span><span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span></div></div><div id="'+index2.replaceAll(" ","").replaceAll("(","").replaceAll(")","").replaceAll(".","").replaceAll("&","")+'" class="collapse" data-parent="#selectedaccordionExample" ><div class="card-body "><div class="items-container">';

html_data+='<ul>';
              $(all_category_name).each(function(data,index){
                
                 if(index.split(":")[0]==index2)
                 {
                   // html_data+='<div class="col-md-12"><div class="d-flex align-items-center justify-content-start"><strong class="list-text">'+index.split(":")[1]+'</strong></div></div>';
                    html_data+='<li><strong class="list-text">'+index.split(":")[1]+'</strong></li>';
                 }

              });
              html_data+='</ul></div></div></div></div></div>';

          }); 
          $('.categories').removeClass('d-none');
          console.log(html_data);
          $('.show_all_selected_categories').append(html_data)
     }
  });

 });

    $(document).ready(function(){
         $("#offer_name").emojioneArea({
          pickerPosition: "right",
         });
  });

</script>

  <script> 
    $(document).ready(function() {
      $( ".offerscheckout_date" ).datetimepicker({
      timepicker:true,
      formatTime: 'g:i A',
      format : 'd/m/Y g:i A',
      validateOnBlur: false,
      minDate : 0
   });
 
jQuery.validator.addMethod("maxlengthd", function(value, element) {
    if($('#select').val()=='0')
    {
        if(value<=100)
        {
            return true;
        }else
        {
            console.log('not submit first validate');
            return false;
        }
    }else{
        return true;
    }  
}, 'Please enter a valid Percentage/Amount');


      $('#addOfferForm').validate({
        ignore: [],         
        rules: {
          offer_name: {
            required: true
          },
          start_date: {
            required: true
          },
           end_date: {
            required: true
          },            
           description: { 
            required: true
          },
           
           offer_type: { 
            required: true
          },
           offer_amount: { 
            required: true,
             maxlengthd:true
          },
           minimum_order_amount: { 
            required: true
          },
           maximum_order_amount: { 
            required: true
          },
           
        },
        messages: {
          offer_name: {
            required: "Offer Name is required"
          },
       
           start_date: {
            required: "Start Date/ Time  is required"
          },
           end_date: {
            required: "End Date/ Time  is required"
          },
        
          description:{
            required: "Description is required"
          },
          
           offer_type:{
            required: "Offer Type is required"
          },
           offer_amount:{
            required: " Percentage/Amount is required"
          },
           minimum_order_amount:{
            required: " Minimum order amount is required"
          },
           maximum_order_amount:{
            required: " Maximum order amount is required"
          },   
        },
        submitHandler: function(form) { 
             
               
              if($('.ckbCheckAllItems').is(':checked') && $('.ckbCheckAll').is(':checked')){
                 
                  return true;
              }else{
                 
                  $('.select_notice').removeClass('d-none');

                  setTimeout(function(){
                     $('.select_notice').addClass('d-none');
                  },1800);
                  return false;
              } 

               
              
   }

      });



    });
  </script>

 

 


<script type="text/javascript">
    // $('#myModal').modal({
    //                     'show':true,
    //                      backdrop: 'static',
    //                      keyboard: false
    //                   });


    $(document).ready(function(){
       $('#categories-modal').click(function(){
          $('#cat-modal').modal({
             'show':true,
              backdrop: 'static',
             keyboard: false
        });
       }); 
       
    });



      $(document).ready(function(){
        $('#branch-modal').click(function(){
          $('#branches-modal').modal({
             'show':true,
              backdrop: 'static',
              keyboard: false
        });

      });
        
       
    }); 
</script>
 

<script type="text/javascript">
    

$(document).ready(function(){

     $('.checkItemsAll').each(function(){
        $(this).click(function(){
 
      var parentElement  = this.parentElement.parentElement;
      //console.log(parentElement);
      
      //return false;

        var secondDiv = parentElement.getElementsByClassName('items-container')[0];
        var all_input = secondDiv.getElementsByTagName('INPUT'); 
            console.log(secondDiv);
                
                 if($(this).is(':checked')){  
                    for(var i=0;i<all_input.length;i++){
                   $(all_input[i]).prop('checked', 'true'); 
                    } 
                 }
                 else{
                    for(var i=0;i<all_input.length;i++){
                   $(all_input[i]).prop('checked', false); 
                  } 

              }

        });
     });


     $('.ckbCheckAllItems').each(function(){
        
        $(this).click(function(){
            var count = 0;
            var getParent = this.parentElement.parentElement.parentElement.parentElement;

            var getParentInput = this.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
             var parentInput = getParentInput.getElementsByTagName('INPUT')[0];
           
             var all_input = getParent.getElementsByTagName('INPUT');
           
            $(all_input).each(function(data){
                 if($(this).is(':checked')){
                    count++;
                 }
            });
            
          

              if(all_input.length == count) {
                    $(parentInput).prop('checked', 'true');
                  }
                  else {
                  //  alert("false");
                    $(parentInput).prop('checked', false);
                  }
            
        });
     });





});



$(document).ready(function(){
    $('.checkBranchAll').click(function(){
           var branches  = $('.branch-container')[0];
           var all_branches_input = branches.getElementsByTagName('INPUT');
          // console.log(all_branches_input.length);
        if($(this).is(':checked')){
                for(var i=0;i<all_branches_input.length;i++){
               $(all_branches_input[i]).prop('checked', 'true'); 
            }
        }else{
           
            for(var i=0;i<all_branches_input.length;i++){
               $(all_branches_input[i]).prop('checked', false); 
            }
        } 
    });






  //2nd logic

    var all_branches_input = $('.branch_inputs');
    var branches_input_length = all_branches_input.length; 
   
    
   $(all_branches_input).each(function(){
     $(this).click(function(){
        
          var counts = 0;
         $(all_branches_input).each(function(data){

                 if($(this).is(':checked')){
                    counts++;
                 }
            });

         if(branches_input_length  == counts) {
            $(".checkBranchAll").prop('checked', 'true');
          }
          else {
          //  alert("false");
            $(".checkBranchAll").prop('checked', false);
          }

     });
   });



})

</script>



    <script type="text/javascript">
         //Aug 26 code........

         $(document).ready(function(){
           var all_items =  $('.menu_item_container_for_out_of');
           var items_data = [];
           $(all_items).each(function(){
              var all_item_inputs = this.getElementsByTagName('INPUT');
             
               
                //get total selected items 
                 var all_selected_inputs_count = 0;
               $(all_item_inputs).each(function(){

                  if ($(this).is(':checked')) {
                    all_selected_inputs_count++;
                      
                  } 
 
               });
             
                
               //console.log("all_items_checked_length="+all_selected_inputs_count);   

              //console.log("all_items_length="+all_item_inputs.length);
              //console.log(all_selected_inputs_count);
           
              var AllInputItems = all_item_inputs.length;
              var AllSelectedItems = all_selected_inputs_count;
              var message = AllInputItems+" out of "+AllSelectedItems+" items selected";
              items_data.push(message);
             //  console.log(message);
             // $('.selected_items_count_show').html(message);
                    
           });
        


           //var get all lables

            var all_selected_count_box = $('.selected_items_count_show'); 
           all_selected_count_box.each(function(index,data){
             this.innerHTML = items_data[index];
           });


          });

    </script>


@stop
