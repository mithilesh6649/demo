@extends('adminlte::page')

@section('title', 'Super Admin | Add Coupon Code  ')

@section('content_header')
 

@section('content') 
 
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
          <div class="card-main">
            <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
               <h3>Add Coupon Code</h3>
            </div>
            <div class="card-body table form mb-0">
               @if (session('status'))
               <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
               @endif
                <form id="addOfferForm" method="post" action="{{route('coupon.code.save')}}" enctype="multipart/form-data">
                  @csrf 
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                           <div class="form-group"> 
                              <label> Coupon  Name<span class="text-danger"> *</span></label>
                              <input type="text" name="coupon_name" class="form-control" id="coupon_name" maxlength="100"> 
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group">
                             <label for="description">Description<span class="text-danger"> *</span></label> 
                             <input type="text" name="description" class="form-control" id="description" maxlength="500">
                          </div>
                        </div> 
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                           <div class="form-group mt-3">
                              <label for="discount_type">Coupon type<span class="text-danger"> *</span></label> 
                              <select class="form-control" name="coupon_type">
                                 <option value="">Select Type</option>
                                 <option value="0">External</option>
                                 <option value="1">Internal</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group mt-3">
                            <label>Minimum order amount<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="minimum_order_amount" maxlength="100">
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group mt-3">
                            <label for="discount_type">Discount type<span class="text-danger"> *</span></label> 
                            <select class="form-control" name="discount_type" id="discount_type_api">
                               <option value="">Select Discount</option>
                               <option value="1">Amount</option>
                               <option value="0">Percentage</option>
                               <option value="2">Item</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12" id="discount_amount_percent">
                          <div class="form-group mt-3"> 
                             <label for="title_en">Percentage/Amount <span class="text-danger"> *</span></label> 
                             <input type="number" name="discount_amount" class="form-control" id="discount_amount" maxlength="100"> 
                          </div>
                          <label  class="percent_amount_select_error text-danger d-none" style="font-size:14px;font-weight: normal;">Percentage/Amount is required</label>
                        </div>
                       <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6 d-none" id="discount_item">
                          <div class="form-group branches mt-3">
                              <label for="password">Select Item<span class="text-danger"> *</span></label>
                              <select class="advance_category_search catselect" name="city_id"    style="width:200px;">
                                <option value="select_item">Select Item</option>
                               @forelse ($menuItem as $items)
                                    <option value="{{$items->id}}">{{ $items->item_name_en }}</option>
                                @empty
                                     <option class="disabled">City not found</option>
                                @endforelse
                              </select>  
                              <label class="cat_select_error text-danger d-none" style="font-size:14px;font-weight: normal;"> Item  is required</label>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                           <div class="form-group mt-3"> 
                              <label for="start_date">Start Date/ Time<span class="text-danger"> *</span></label> 
                              <input type="text" name="start_date" class="form-control dicount_date" id="start_date" maxlength="100"  autocomplete="off" > 
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                           <div class="form-group mt-3"> 
                              <label for="end_date">End Date/ Time<span class="text-danger"> *</span></label> 
                              <input type="text" name="end_date" class="form-control dicount_date" id="end_date" maxlength="100"  autocomplete="off"> 
                           </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                          <div class="form-group mt-3">
                              <label>Image</label>
                              <input type="file" name="thumbnail" class="thumbnail_pic" onchange="readURL(this);" accept=".png, .jpg, .jpeg" class="form-control">
                              <div class="upload-img" style="position:relative;">
                                <a href="javascript:;" class="remove-pro-img d-none "  style="display:block;position: absolute;right:-10px;top:16px;">
                                  <svg width="25" height="25" viewBox="0 0 257 256" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2088_553)">
                                    <path d="M254.85 141.81C253.9 157.47 249.21 172.11 241.97 185.85C222.7 222.45 192.59 244.9 152.18 253.57C150.9 253.85 149.55 253.82 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z" fill="#F7F9FA"/>
                                    <path d="M254.85 141.81C251.98 142.27 250.79 139.87 249.24 138.32C230 119.18 210.83 99.9701 191.64 80.7801C190.08 79.2301 188.55 77.6401 186.86 76.2301C186.73 76.1101 186.6 76.0101 186.47 75.9101C186.37 75.8201 186.27 75.7401 186.17 75.6601C179.43 68.4101 174.9 68.2601 167.78 75.3201C156.31 86.6701 144.95 98.1401 133.52 109.53C128.75 114.28 128.21 114.29 123.52 109.63C111.61 97.7701 99.7803 85.8401 87.8503 74.0101C83.5703 69.7701 79.6603 69.0701 75.8503 71.6001C70.9103 74.8801 70.1903 80.2701 74.3803 84.8201C79.1203 89.9501 84.2103 94.7501 89.1403 99.7001C96.6603 107.24 104.24 114.72 111.71 122.31C115.58 126.24 115.59 127.4 111.66 131.37C100.3 142.84 88.8503 154.21 77.4403 165.63C76.0403 167.04 74.5503 168.4 73.4803 170.11C70.4303 174.98 71.1603 179.23 75.6803 182.84C76.5803 183.56 77.6903 184.03 78.3503 185.05C78.4203 185.21 78.4903 185.36 78.5803 185.51C78.5903 185.55 78.6103 185.59 78.6403 185.63C79.4203 187.06 80.6103 188.16 81.7603 189.31C101.43 208.97 121.13 228.61 140.72 248.36C142.99 250.65 145.76 252.04 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z" fill="#E11B1B"/>
                                    <path d="M254.851 141.81C253.901 157.47 249.211 172.11 241.971 185.85C222.701 222.45 192.591 244.9 152.181 253.57C150.901 253.85 149.551 253.82 148.231 253.94C145.631 253.93 143.601 252.98 141.691 251.05C121.101 230.32 100.401 209.7 79.8109 188.98C79.0309 188.19 76.6309 187.69 78.2509 185.61C78.3609 185.58 78.471 185.55 78.581 185.51C85.011 183.79 89.421 179.22 93.911 174.65C103.951 164.44 114.101 154.34 124.281 144.26C128.391 140.18 129.551 140.18 133.721 144.32C144.961 155.46 156.111 166.68 167.301 177.86C168.361 178.92 169.391 180.01 170.501 181.02C174.681 184.83 179.601 185.14 183.031 181.84C186.531 178.46 186.521 172.88 182.621 168.86C172.881 158.82 162.871 149.04 153.001 139.13C151.001 137.13 148.991 135.13 146.991 133.12C141.341 127.44 141.331 127.19 146.851 121.66C156.381 112.11 165.821 102.47 175.501 93.0802C180.591 88.1502 185.511 83.2702 186.471 75.9102C186.521 75.5802 186.551 75.2502 186.581 74.9102C188.681 75.4402 189.791 77.2202 191.171 78.6002C211.061 98.4402 230.911 118.32 250.781 138.17C252.071 139.45 253.491 140.6 254.851 141.81V141.81Z" fill="#C30606"/>
                                    <path d="M186.59 74.9098C187.91 79.9298 186.29 83.8598 182.62 87.4598C170.4 99.4598 158.43 111.72 146.19 123.7C143.59 126.25 143.08 127.63 146.03 130.49C158.57 142.64 170.82 155.09 183.14 167.46C187.36 171.69 188.23 176.25 185.8 180.48C182.3 186.59 174.86 187.29 169.34 181.82C156.93 169.53 144.51 157.25 132.36 144.72C129.44 141.71 127.98 141.78 125.1 144.75C113.17 157.04 100.91 169.01 88.8705 181.2C85.8805 184.23 82.5405 185.95 78.2505 185.62C68.6605 181.06 67.5405 174.17 75.2105 166.49C87.3205 154.35 99.3805 142.15 111.65 130.17C114.22 127.66 114 126.36 111.57 123.97C98.8505 111.49 86.3205 98.8298 73.7205 86.2298C70.1505 82.6498 69.0905 78.4998 71.5605 73.9798C73.7705 69.9098 77.4505 68.2598 82.0605 68.8998C84.8505 69.2898 86.8105 71.0798 88.7205 72.9998C100.71 85.0298 112.83 96.9298 124.67 109.11C127.65 112.18 129.28 112.74 132.58 109.3C144.34 97.0498 156.48 85.1698 168.52 73.1898C175.19 66.5498 181.31 67.1798 186.6 74.9198L186.59 74.9098Z" fill="#FEFEFE"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_2088_553">
                                    <rect width="256.1" height="255.86" fill="white"/>
                                    </clipPath>
                                    </defs>
                                  </svg>
                                </a>
                                <img src="" id="thumbnail_preview" style="width:300;height:130px;display:none;">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                          <div class="form-group mt-3">
                            <label for="start_date">Status</label>
                            <select name="discount_status" class="valid" aria-invalid="false">
                               <option value="1">Active</option>
                               <option value="0">Inactive</option>
                            </select>
                          </div>
                        </div>
                     </div>
                     <label class="mb-3 mt-3 d-block">Coupon  applied on 
                       <a class="btn info_btn" data-toggle="tooltip" data-placement="right" title="Select Branch and Category / Menu Item  " >
                       <i class="fa fa-question-circle"></i>
                       </a>
                     </label>
                     <div class="btn-group d-flex flex-wrap justify-content-between w-100">
                        <div class="left_tab">
                          <button type="button" class="btn btn-warning w-100" id="branch-modal"> Branch</button>
                          <div class="border d-none mt-3" id="all_selected_branch_container">
                              <!-- <h5>Selected Branches List</h5> -->
                              <table class="d-none braches">
                                 <thead>
                                   <th class="d-none"></th>
                                 <!--    <th>Branch Name</th> -->
                                 </thead>
                                 <tbody id="show_all_selected_branch">
                                   <td class="d-none"></td>
                                 </tbody>
                              </table>  
                          </div>
                        </div>
                        <div class="right_tab">
                          <button type="button" class="btn btn-success w-100" id="categories-modal"> Category/ Menu Item</button>
                          <div class="border d-none mt-3" id="all_selected_categories_container">
                             <!--  <h4>Selected Category/ Menu Items</h4> -->
                             <div class="show_all_selected_categories" id="selectedaccordionExample">
                                
                             </div>
                          </div>
                        </div>
                     </div>
<!--                       <div class="d-flex align-items-center justify-content-between flex-wrap mt-0 pl-0 mb-0">
                          <div class="border d-none mt-3" id="all_selected_branch_container">
                            <table class="d-none braches">
                               <thead>
                                 <th class="d-none"></th>
                               </thead>
                               <tbody id="show_all_selected_branch">
                                 <td class="d-none"></td>
                               </tbody>
                            </table>  
                          </div>
                          <div class="border d-none mt-3" id="all_selected_categories_container">
                           <div class="show_all_selected_categories" id="selectedaccordionExample">
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
                                       Add Menu Categories and items
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
                                           <div class="card categories">
                                              <div class="position-relative">
                                                <div class="card-header collapsed" data-toggle="collapse" data-target="#{{preg_replace('/[^A-Za-z0-9\-]/','',str_replace(' ','',$categorie->name_en))}}" aria-expanded="false">
                                                   <span class="title">{{$categorie->name_en}}</span>
                                                   <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                                                </div>
                                                 <input type="checkbox" id="category" name="category[]" class="checkItemsAll selected" value="{{$categorie->id}}">
                                              </div>
                                              <div id="{{preg_replace('/[^A-Za-z0-9\-]/','',str_replace(' ','',$categorie->name_en))}}" class="collapse" data-parent="#accordionExample" >
                                                 <div class="card-body ">
                                                    <div class="items-container">
                                                       @forelse ($categorie->menuItems as $items)
                                                          <div class="d-flex align-items-center justify-content-start">
                                                             <div class="custom-check">
                                                                <input type="checkbox" id="category" name="menu_items[]" class="ckbCheckAllItems" value="{{$items->id}}" category-name-attr="{{$categorie->name_en}}:{{$items->item_name_en}}">  
                                                                <span></span>                             
                                                             </div>
                                                             <strong class="list-text"> &nbsp; {{$items->item_name_en}}</strong>
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
                               <div class="btn-group">
                             <button type="button" class="btn btn-success" id="category_unselect_all">Close</button>
                             <button type="button" class="btn btn-danger" id="category_save_countinue">Save and Continue</button>
                           </div>
                           </div>

                          <!--  <span class="text-danger text-center p-2 select_branch_warning d-none">Please Select Category/Menu Item and proceed</span>       --> 
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
            Add Branches
            </div>
             </h4>
                <p class=" d-none select_branch_warning p-2 border bg-danger" style="width:fit-content;">Please Select branch and proceed</p>

            </div>
            <div class="modal-body">
            <!--start container -->
            <div class="container-fluid" id="quick_view_container">
            <div class="accordion" id="accordionExample">
            <div class="card categories">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">     
            <span class="title">Select Branch</span>
            <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div class="card-body branch_all_inputs_container">
            <div class="all-content d-flex align-items-center">
            <div class="custom-check">
            <input type="checkbox" id="category" name="branch[]" class="checkBranchAll">  
            <span></span>                             
            </div>
            <strong class="list-text"> &nbsp; All </strong>
            </div>
            <div class="branch-container">
            @forelse ($branches as $branch)
            <div class="d-flex align-items-center">
            <div class="custom-check">
            <input type="checkbox" id="category" name="branches[]" class="ckbCheckAll branch_inputs" value="{{$branch->id}}" branch-name-attr="{{$branch->title_en}}">  
            <span></span>                             
            </div>
            <strong class="list-text"> &nbsp; {{$branch->title_en}}</strong>
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
                               <div class="btn-group">
                             <button type="button" class="btn btn-success"   id="branch_unselect_all">Close</button>
                             <button type="button" class="btn btn-danger" id="branch_save_countinue">Save and Continue</button>
                           </div>
                           </div>

                   <!--  <span class="text-danger text-center p-2 select_branch_warning d-none">Please Select branch and proceed</span> -->       
            </div>
            </div>
            <!--end modal -->
            <!-- end branch modal -->
           
            <!-- /.card-body -->
         </div>

          <!-- start coding all selected branch and menu items start -->

             <!-- <div class="row mt-3 pl-0 mb-0">
                <div class="col-md-6 border d-none" id="all_selected_branch_container">
                     <h5>Selected Branches List</h5>
                   
                  <table class="d-none braches">
                     <thead>
                        <th>Branch Name</th>
                       
                     </thead>
                     <tbody id="show_all_selected_branch">
                        
                     </tbody>
                  </table>  

                </div>
               <div class="col-md-6 p-1 border" id="all_selected_categories_container">
                <h4>Selected Category/ Menu Items</h4>
                 <div class="row">
                    <div class="container-fluid  category_all_inputs_container " id="quick_view_container">
                     <div class="accordion show_all_selected_categories" id="selectedaccordionExample" >
                       <!-- selecte menu item and category -->
                      
                <!--        <div class="pl-3 mb-3">
            <span class="text-danger  d-none select_notice"> Branch and Category/Menu Item both are required </span>
            </div> -->
               <p class=" d-none select_notice p-2 border bg-danger" style="width:fit-content;">Branch and Category / Menu Item both are required</p>
                                      

                         <!-- end for selected menu -->
                         <div class="card-footer"> <button type="submit" class="button btn_bg_color common_btn text-white">Save</button></div>
                      </div>
                     </div>
                  </div> 
                </div>
             </div> 

           </div>
          <!-- end coding all selected branch and menu items start -->
            </form>
         </div>
      </div>
   </div>
</div>
</div>
  

@endsection 

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
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
    font-weight: 600;
}
.card-header .accicon {
    font-size: 20px;
    display: flex;
    justify-content: end;
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
.form-group {
    position: relative;
}
</style>
@stop
 
@section('js')
  
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script type="text/javascript">
      $(".catselect").select2();
</script>   


<!-- show image on change -->
<script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function (e) {
          $('#thumbnail_preview').css('display', 'block');
          $(".remove-pro-img").removeClass("d-none");
          $('#thumbnail_preview').attr('src', e.target.result);
        };
    
        reader.readAsDataURL(input.files[0]);
      }
    }



    $(".remove-pro-img").click(function(evt){      
   
                  $(".remove-pro-img").addClass("d-none");
                  $("#thumbnail_preview").css('display', 'none');
                   
                  $(".thumbnail_pic").val(null);  
    
 
  });
</script>
<!-- show image on change -->



<script type="text/javascript">

   $( ".dicount_date" ).datetimepicker({
      timepicker:true,
        formatTime: 'g:i A',
      format : 'd/m/Y g:i A',
      minDate : 0
   });

  
  $(document).ready(function(){
         $("#description").emojioneArea({
           pickerPosition: "bottom",
  filtersPosition: "bottom",
  tonesStyle: "square",
  shortnames: true,
  tones:false,
  search:false,
   
         });
  });

    $(document).ready(function(){
         $("#coupon_name").emojioneArea({
          pickerPosition: "right",
         });
  });

</script>





  <script> 
    $(document).ready(function() {
    
       $('#addOfferForm').validate({
             ignore: [],
            
        rules: {
          coupon_name: {
            required: true,
                 remote:{
                  type:"get",
                  url:"{{route('coupons.code.check')}}",
                  data: {
                        "promocode": function() { return $("#coupon_name").val(); },
                        "_token": "{{ csrf_token() }}",
                       
                      },
                      dataFilter: function (result) {
                       var json = JSON.parse(result);
                                    if (json.msg == 1) {
                                        return "\"" + "Coupon is already  exist" + "\"";
                                    } else {
                                        return 'true';
                                    }
                      }    
                }
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
           
           discount_type: { 
            required: true
          },
           
          coupon_type:{
            required:true
          },
           minimum_order_amount: { 
            required: true
          },
           maximum_order_amount: { 
            required: true
          },
           
        },
        messages: {
          coupon_name:{
             required:"Coupon name is required",
          },
          description:{
            required:"Description is required",
          },
          start_date:{
            required:"Start date is required",
          },
           end_date:{
            required:"End date is required",
          },
          discount_type:{
            required:"Discount type is required",
          },
          coupon_type:{
            required:"Coupon type is required",
          },
           minimum_order_amount:{
            required:"Minimum order amount is required",
          }
        },
         submitHandler: function(form) { 
             
             


              if($("#discount_type_api").val() == 2){
                  if($('.catselect').val().trim() == 'select_item'){
                      // alert('cat_select_error');
                      $('.cat_select_error').removeClass('d-none');

                  setTimeout(function(){
                     $('.cat_select_error').addClass('d-none');
                  },800);
                  return false;

                  }
               }
               else{
                 if($('#discount_amount').val().trim() == ''){
                    
                    $('.percent_amount_select_error').removeClass('d-none');

                  setTimeout(function(){
                     $('.percent_amount_select_error').addClass('d-none');
                  },800);
                  return false;
                    
                 }
               }
 




               if($('.ckbCheckAllItems').is(':checked') && $('.ckbCheckAll').is(':checked')){
                  
                  return true;
              }else{
                
                  $('.select_notice').removeClass('d-none');

                  setTimeout(function(){
                     $('.select_notice').addClass('d-none');
                  },1800);
                  return false;
              } 




               return false;

             
               
              
   }

      });


    });
  </script>

  <script type="text/javascript">
   $(document).ready(function(){
       $('#discount_type_api').on('change',function(){
          if(this.value == 2){
             $('#discount_amount_percent').addClass('d-none');
            $('#discount_item').removeClass('d-none');
          }
          else{
            $('#discount_amount_percent').removeClass('d-none');
            $('#discount_item').addClass('d-none');
          }

       });
   });
</script>



<!-- ajeet code -->

<script type="text/javascript">
   
  $(document).ready(function(){
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
  });

</script>




<script type="text/javascript">
  
  $(document).ready(function(){
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

         //get data selected.............
         //console.log(all_branches_name); 
         $('#branches-modal').modal('hide');
         //$('#all_selected_branch_container').removeClass('d-none');    
          $('#all_selected_branch_container').removeClass('d-none'); 

          $('#show_all_selected_branch').html(' ');
          var html_branch="";

          $(all_branches_name).each(function(data,index){
             
              html_branch+="<ul>";
              html_branch+="<li>"+index+"</li>"
              html_branch+="</ul>";
            
          }); 
          $('.braches').removeClass('d-none');
            $('#show_all_selected_branch').append(html_branch);
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

              html_data+='<div class="main_container"> <div class="card categories"><div class="position-relative"><div class="card-header alt collapsed" data-toggle="collapse" data-target="#'+index2.replaceAll(" ","").replaceAll("(","").replaceAll(")","")+'" aria-expanded="false"><span class="title">'+index2+'</span><span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span></div></div><div id="'+index2.replaceAll(" ","").replaceAll("(","").replaceAll(")","")+'" class="collapse" data-parent="#selectedaccordionExample" ><div class="card-body "><div class="items-container">';
html_data+='<ul>';

              $(all_category_name).each(function(data,index){
                
                 if(index.split(":")[0]==index2)
                 {
                   html_data+='<li><strong class="list-text">'+index.split(":")[1]+'</strong></li>';
                 }
                   // html_data+='<div class=""><div class="d-flex align-items-center justify-content-start"><strong class="list-text">'+index.split(":")[1]+'</strong></div></div>';
                 });

              html_data+='</div></div></div></div></div>';

          }); 
          $('.categories').removeClass('d-none');
          $('.show_all_selected_categories').append(html_data)
      $('.alt').addClass('collapsed');

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
    
         $( ".checkoutoffers_date" ).datetimepicker({
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

      $('#addOfferFormddddd').validate({
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
           terms_and_conditions:{
            required: "Terms and conditions is required"
          },
           offer_type:{
            required: "Offer Type is required"
          },
           offer_amount:{
            required: "Percentage/Amount is required"
          },
           minimum_order_amount:{
            required: " Minimum order amount is required"
          },
           maximum_order_amount:{
            required: " Maximum order amount is required"
          },   
        },
        submitHandler: function(form) { 
             
               
              if($('.ckbCheckAllItems').is(':checked') || $('.ckbCheckAll').is(':checked')){
                 
                  return true;
              }else{
                 
                  $('.select_notice').removeClass('d-none');

                  setTimeout(function(){
                     $('.select_notice').addClass('d-none');
                  },800);
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
          
            var getParentInput = this.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
             var parentInput = getParentInput.getElementsByTagName('INPUT')[0];
           console.log(parentInput);
             var all_input = getParent.getElementsByTagName('INPUT');
            console.log(all_input.length);
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

 $(document).ready(function(){

  $('#branch_unselect_all').on('click',function(){
   
     var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
     var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
     $(all_inputs).each(function(){
        $(this).prop('checked', false);
         $('#branches-modal').modal('hide');
          $('#all_selected_branch_container').html();
          $('#all_selected_branch_container').addClass('d-none'); 
        // $('#all_selected_branch_container').removeClass('d-none');
     }); 
       
  });

 });




  $(document).ready(function(){

  $('#category_unselect_all,#category_close_icon').on('click',function(){
     
      
     var category_all_inputs_container = $('.category_all_inputs_container')[0];
     var all_inputs = category_all_inputs_container.getElementsByTagName('INPUT');
       
     $(all_inputs).each(function(){
        $(this).prop('checked', false);
         $('#cat-modal').modal('hide');
            $('.show_all_selected_categories').html();
                   $('#all_selected_categories_container').addClass('d-none'); 
     }); 
       
  });

 });



//branch save and proceed

 // $(document).ready(function(){

 //  $('#branch_save_countinue').on('click',function(){
    
 //       var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
 //     var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
 //     var  branch_sel_count = 0;
 //     $(all_inputs).each(function(){
           
 //           if($(this).is(':checked')){
 //               branch_sel_count++
 //           } 
 //     }); 

 //     if(branch_sel_count == 0){
 //       $('.select_branch_warning').removeClass('d-none');

 //       setTimeout(function(){
 //           $('.select_branch_warning').addClass('d-none');
 //       },2000); 
 //       return false;  
 //     }


 //  });

 // });
</script>

@stop
