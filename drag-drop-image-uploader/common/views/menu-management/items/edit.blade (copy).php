@extends('adminlte::page') @section('title', ' Super Admin | Edit Menu Item') @section('content_header') @section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card"> 
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3>Edit Menu Item</h3>
                  <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> 
               </div>
               <div class="card-body p-0">
                  @if (session('status'))
                  <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                  @endif 
                  <!-- tab content here -->
                  <div class="tab_wrapper">
                     <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link nav_link {{ Request::segment(3) == 'edit' && Request::segment(2) == 'items' ? 'active' : '' }}" id="pills-home-tab" href="{{route('menu.item.edit',['id'=>$menuItem->id])}}" aria-controls="pills-home" aria-selected="true">Item</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link nav_link {{ (Request::segment(3) == 'choice') && (Request::segment(2) == 'items') ? 'active' : '' }}" id="pills-transactions-tab" aria-controls="pills-transactions" href="{{route('menu.item.edit.choice.group',['id'=>$menuItem->id])}}" aria-selected="false">Choice Groups </a> </li>
                        <li class="nav-item"> <a class="nav-link nav_link {{ Request::segment(2) == 'current_offers'? 'active' : '' }}" id="pills-transactions-tab" aria-controls="pills-transactions" href="{{route('current_offers.edit',$menuItem->id)}}" aria-selected="false">Current Offers</a> </li>
                        <!--   <li class="nav-item">
                           <a class="nav-link nav_link {{ Request::segment(2) == 'add' && Request::segment(1) == 'branch' ? 'active' : '' }}   "    id="pills-home-tab" href="{{route('add_branch')}}" aria-controls="pills-home" aria-selected="true"> <i class="fas fa-code-branch mr-2"></i> Branch</a>
                           </li>
                           
                           <li class="nav-item">
                           <a class="nav-link nav_link {{ (Request::segment(2) == 'permission') && (Request::segment(1) == 'branch') ? 'active' : '' }}" id="pills-persmissions-tab" href="{{route('branch.permission')}}" aria-controls="pills-permissions" aria-selected="false"><i class="fas fa-time mr-2"></i>Persmission</a>
                           </li> -->
                     </ul>
                     <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  {{ Request::segment(3) == 'edit' && Request::segment(2) == 'items' ? 'show active' : '' }}" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                           <!-- item tab content -->
                           <form id="editMenuItemForm" method="post" action="{{ route('menu.item.update') }}" enctype="multipart/form-data">
                              @csrf
                              <div class="card-body table form mb-0">
                                 <div class="row">
                                    <input type="hidden" name="menu_item_id" value="{{$menuItem->id}}">
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                       <div class="form-group">
                                          <label for="item_name_en">Item Name(en)<span class="text-danger"> *</span></label>
                                          <input type="text" name="item_name_en" class="form-control" id="item_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{ $menuItem->item_name_en }}"> 
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                       <div class="form-group">
                                          <label for="item_name_ar">Item Name(ar)<span class="text-danger"> *</span></label>
                                          <input type="text" name="item_name_ar" class="form-control" id="item_name_ar" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{ $menuItem->item_name_ar }}"> 
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                       <div class="form-group mt-3">
                                          <label for="description_en">Description{{ labelEnglish() }} </label>
                                          <textarea name="description_en">{{ $menuItem->description_en }}</textarea>
                                       </div>
                                    </div>
                                    <!--Description in english -->
                                    <!--Description in english -->
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                       <div class="form-group mt-3">
                                          <label for="description_ar">Description{{ labelArabic() }} </label>
                                          <textarea name="description_ar">{{ $menuItem->description_ar }}</textarea>
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                       <div class="form-group mt-3">
                                          <label for="cat_id">Category<span class="text-danger"> *</span></label>
                                          <select class="form-control catselect" name="cat_id" id="category_value">
                                             <option value="">Select Category</option>
                                          @forelse ($menuCategories as $category)
                                             @if($category->name_en=='Loyalty')
                                               <option value="loyalty" {{ $category->id == $menuItem->cat_id ? 'selected' : ' '}} >{{ $category->name_en}}({{ $category->name_ar}})</option> 
                                             @else
                                              <option value="{{ $category->id }}" {{ $category->id == $menuItem->cat_id ? 'selected' : ' '}} >{{ $category->name_en}}({{ $category->name_ar}})</option> 
                                              @endif

                                             @empty
                                             <option disabled>Please add category first</option>
                                             @endforelse 
                                          </select>
                                          @if($errors->has('category'))
                                          <div class="error">{{ $errors->first('category') }}</div>
                                          @endif 
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                       <div class="form-group mt-3">
                                          <label for="price" id="change_value">
                                             
                                               @if($menuItem->item_type=='loyalty') Loyalty Point 
                                                  @php $price=(int)$menuItem->price; @endphp
                                               @else 
                                                   Price (KD) 
                                                   @php $price=$menuItem->price; @endphp
                                               @endif

                                          </label>
                                          <input type="number" name="{{$menuItem->item_type=='loyalty'?'loyalty_point':'price'}}" class="form-control" id="price" maxlength="100" style="background-color:white;border:1px solid #ced4da;" value="{{$price}}"> 
                                       </div>
                                    </div>
                                    <!--Description in english -->
                                    
                                    <!--Description in english -->
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                       <div class="form-group mt-3">
                                          <label for="password_confirmation">Image</label>
                                          <input type="file" name="thumbnail" onchange="readURL(this);"  accept=".png, .jpg, .jpeg" class="form-control"> @if($errors->has('thumbnail'))
                                          <div class="error">{{ $errors->first('thumbnail') }}</div>
                                          @endif 
                                       </div>
                                     
                                        <div class="upload-img  {{$menuItem->thumbnail != null ? '':'d-none'}}" style="position:relative;width:250px;">
                                           <a href="javascript:;" class="remove-pro-imgdelete_pdf delete_cate_image" pdf_name="{{$menuItem->thumbnail ?? ' '}}" current_id="{{$menuItem->id}}"   style="display:block;position: absolute;right:-10px;top:16px;">
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
                                           @if($menuItem->thumbnail!="")
                                          <img src="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}" class="thumbnail_preview" id="thumbnail_preview" style="width: 250px;" class="{{$menuItem->thumbnail != null ? '':'d-none'}} ">
                                          @else
                                             <img src="" class="thumbnail_preview" id="thumbnail_preview" style="width: 250px;" alt="image">
                                          @endif
                                        
                                         </div>
                                            
                                    </div>

                                    
                                    
                                    
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                       <div class="form-group rating tagline mt-3">
                                          <label>Tagline <span class="text-danger">*</span></label>
                                          <input type="text" id="rating" value="{{$menuItem->tagline ?? ''}}" class="form-control" name="tagline">
                                         <!--  <textarea id="rating" class="form-control" name="" maxlength="500"></textarea> -->
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-6 ">
                                       <div class="form-group mt-3">
                                          <label for="status">Status </label>

                                          <select class="form-control" name="status">
                                          
                                             @foreach($status as $status_data)
                                                 <option value="{{$status_data->value}}" {{ $menuItem->status ==$status_data->value ? 'selected':'' }} >{{$status_data->name}}</option>
                                             @endforeach

                                          </select>

                                       </div>
                                    </div>
                                 </div>
                                 <div class="card-footer">
                                 <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
                              </div>
                                 <!--end tag line -->
                              </div>
                              <!-- /.card-body -->
                              
                           </form>
                           <!-- item tab content -->
                        </div>
                        <div class="alert d-none" role="alert" id="flash-message"> </div>
                        <div class="tab-pane fade {{ (Request::segment(3) == 'choice') && (Request::segment(2) == 'items') ? 'show active' : '' }}" id="pills-transactions" role="tabpanel" aria-labelledby="pills-transactions-tab">
                                <div class="d-flex align-items-center justify-content-between">
                                
                                    <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0 mb-0 w-100" style="border-bottom: none;">
                                        <h3></h3> 
                                        <a class="btn btn-sm btn-success mb-0" href="javascript:;" data-toggle="modal" data-target="#choice_group_modal">Add Choice Group</a> 
                                    </div>
                                </div>
                           <div class="card-body table form items mb-0">
                              @if (session('status'))
                              <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                              @endif
                              <table style="width:100%" id="choice-list" class="table table-bordered table-hover">
                                 <thead>
                                    <tr>
                                       <th class="display-none"></th>
                                       <th>Group Name(en)</th>
                                       <th>Group Name(ar)</th>
                                       <th>Choices (en)</th>
                                       <th>Choices (ar)</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="choicegp">
                                    @foreach($menuItem->ChoiceGroups as $choicegroup)
                                    <tr>
                                       <td class="display-none" c_g_n_en="{{$choicegroup->name_en ?? ''}}" c_g_n_ar="{{$choicegroup->name_ar ?? ''}}" m_c_count="{{$choicegroup->mendatory_choice_count}}" t_c_count="{{$choicegroup->total_choice_count}}"></td>
                                       <td>{{$choicegroup->name_en ?? ''}}</td>
                                       <td>{{$choicegroup->name_ar ?? ''}}</td>
                                       <td> @foreach($choicegroup->choice as $choice) {{$choice->name_en}}({{$choice->price}}) , @endforeach </td>
                                       <td> @foreach($choicegroup->choice as $choice) {{$choice->name_ar}}({{$choice->price}}) , @endforeach </td>
                                       <td> <a data-id="{{ $choicegroup->id}}" class="action-button edit-button" title="Edit" href="javascript:void(0)"><i class="text-warning fa fa-edit" ></i></a> <a data-id="{{ $choicegroup->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)"><i class="text-danger fa fa-trash-alt" ></i></a> </td>
                                    </tr>
                                    @endforeach 
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <!-- current offer modules -->
                        <div class="tab-pane fade {{ Request::segment(2) == 'current_offers' ? 'show active' : '' }}" id="pills-transactions" role="tabpanel" aria-labelledby="pills-transactions-tab">
                           <div class="card-body table items">
                              @if (session('status'))
                              <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                              @endif
                              <form method="post" action="{{route('current_offers.updates')}}" id="editformcurrentoffer"  enctype="multipart/form-data">
                                 @csrf
                                 <div class="card-body form">
                                    <div class="row">
                                       <input type="hidden" name="menuitem_id" value="{{Request::segment(4)}}" >
                                       <input type="hidden" name="current_offers_id" value="@if(count($current_offers)>0) {{$current_offers[0]->id}} @endif">
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                          <div class="form-group">
                                             <label for="current_offer_amount">Offer Name<span class="text-danger">*</span> </label>
                                             <input type="text" name="current_offer_name" id="current_offer_name" class="form-control subs" 
                                                @if(count($current_offers)>0) value="{{$current_offers[0]->offer_name}}" @endif>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                          <div class="form-group">
                                             <label for="current_offer_amount"> Description <span class="text-danger">*</span></label>
                                             <input type="text" name="current_offer_description" id="current_offer_description" class="form-control subs" @if(count($current_offers)>0) value="{{$current_offers[0]->offer_description}}" @endif>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                          <div class="form-group mt-3">
                                             <label for="offers_type ">Offer Type <span class="text-danger">*</span></label>
                                             <select class="form-select"  id="offers_type"  name="offers_type">
                                               <option value="">Offer Type</option>
                                                @if(count($current_offers)>0)
                                                  @foreach($offerType as $offerTypes)
                                                  <option value="{{$offerTypes->value}}" @if($current_offers[0]->current_offer_type==$offerTypes->value) selected @endif> {{$offerTypes->name}}</option>

                                                  @endforeach
                                                @else
                                                   @foreach($offerType as $offerTypes)
                                                  <option value="{{$offerTypes->value}}"> {{$offerTypes->name}}</option>

                                                  @endforeach
                                                @endif
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                          <div class="form-group mt-3">
                                             <label for="current_offer_amount">Percentage/Amount <span class="text-danger">*</span></label>
                                             <input type="number" maxlength="9" name="current_offer_amount" id="current_offer_amount" class="form-control subs" @if(count($current_offers)>0) value="{{$current_offers[0]->amount}}" @endif>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                          <div class="form-group mt-3">
                                             <label for="current_offer_startdate">Start Date/ Time <span class="text-danger">*</span> </label>
                                             <input type="text" value="@if(count($current_offers)>0){{date('d/m/Y h:00 A',strtotime($current_offers[0]->start_date))}}@endif" name="current_offer_startdate" id="current_offer_startdate" class="form-control current__offerdatepicker" autocomplete="off" >
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                          <div class="form-group mt-3">
                                             <label for="current_offer_enddate">End Date/ Time <span class="text-danger">*</span></label>
                                             <input type="text" value="@if(count($current_offers)>0){{date('d/m/Y h:00 A',strtotime($current_offers[0]->end_date))}}@endif" name="current_offer_enddate" autocomplete="off" id="current_offer_enddate" class="form-control current__offerdatepicker" >
                                          </div>
                                       </div>
                                      <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                        <div class="form-group mt-3">
                                            <label>Image</label>
                                            <input type="file" name="c_offerimage" class="thumbnail_pic input-border-auto" onchange="readURLL(this);" accept=".png, .jpg, .jpeg"  class="form-control">
                                            @if($errors->has('thumbnail'))
                                            <div class="error">{{ $errors->first('thumbnail') }}</div>
                                            @endif
                                            
                                        <div class="upload-img" style="position:relative;width:250px;">
                                           <a href="javascript:;" class="remove-pro-img"  style="display:block;position: absolute;right:-10px;top:16px;">
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
                                           @if(count($current_offers)>0)
                                            <img src="{{asset('CMS/banner/'.$current_offers[0]->image)}}" id="current_thumbnail_preview" alt="Image" style="width:250px;display:block;border-radius: 10px;">
                                            @else
                                             <img src="" id="current_thumbnail_preview" alt="Image" style="width:250px;display:block;border-radius: 10px;">
                                            @endif
                                         </div>
                                        </div>
                                      </div>
<!--                                        <div class="col-12 mt-3">
                                          <div class="form-group">
                                             <label>Image</label>
                                             <input type="file" onchange="readURLL(this);" accept=".png, .jpg, .jpeg" name="c_offerimage" class="form-control">
                                          </div>
                                       </div>
                                        <div  style="position:relative;">
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
                                          <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                             <div class="upload-img mt-0">
                                              @if(count($current_offers)>0)
                                                <img src="{{asset('CMS/banner/'.$current_offers[0]->image)}}" id="current_thumbnail_preview" alt="Image" style="width:250px;display:block;border-radius: 10px;">
                                                @else
                                                 <img src="" id="current_thumbnail_preview" alt="Image" style="width:250px;display:block;border-radius: 10px;">
                                                @endif
                                             </div>
                                          </div>
                                       </div> -->
                                       <div class="col-12  mt-3">
                                          <div class="form-group">
                                             <label>Status</label>
                                             <select name="current_offer_status" class="form-select">
                                                 @if(count($current_offers)>0)
                                                  @foreach($status as $status_data)
                                                    <option value="{{$status_data->value}}" @if($current_offers[0]->status==$status_data->value) selected @endif>{{$status_data->name}}</option>
                                                  @endforeach
                                                @else
                                                   @foreach($status as $status_data)
                                                    <option value="{{$status_data->value}}" >{{$status_data->name}}</option>
                                                  @endforeach
                                                @endif
                                             </select>
                                          </div>
                                       </div>
                                        
                                        <label class="mb-1 mt-2 d-block">Current Offer applied on 
                       <a class="btn info_btn" data-toggle="tooltip" data-placement="right" title="Select Branches ">
                       <i class="fa fa-question-circle"></i>
                       </a>
                     </label>

                                        <div class="col-12">
                                          <!-- <button type="button" class="add_new_choice">Apply Branch</button> -->
                         <!--                  <div class="btn-group w-100 col-3 mt-3">
                                             <button type="button" class="btn btn-warning w-100" id="branch-modal"> Branch</button>
                                           </div> -->
                                           <div class=" btn-group my-4" style="width: 49.333%;">
                                                    <div class="left_tab w-100">
                                                   <button type="button" class="btn btn-warning w-100" id="branch-modal"> Branch</button>
                                               </div>
                                            </div>
                                              <p class=" d-none select_notice p-2 border bg-danger" style="width:fit-content;">Branch  is required</p>
                                            <div id="branches-modal" class="modal  fade  " role="dialog">
                                                    <div class="modal-dialog ">
                                                    <!-- Modal content-->
                                                    <div class="modal-content menu">
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Edit Branch</h4>
                                                       <p class=" d-none select_branch_warning p-2 border bg-danger" style="width:fit-content;">Please Select branch and proceed</p>

                                                      <button type="button" class="close" data-dismiss="modal">×</button>
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
                                                    @if(count($current_offers)>0)
                                                        @php 
                                                            $flg25=\App\Models\CurrentOffer::checkedBranch($current_offers[0]->id);
                                                           
                                                        @endphp


                                                    <div class="custom-check">
                                                    <input type="checkbox" id="category" name="branch[]" class="checkBranchAll" {{$flg25==1?'checked':''}}>  
                                                    <span></span>                             
                                                    </div>
                                                    @else

                                                    <div class="custom-check">
                                                    <input type="checkbox" id="category" name="branch[]" class="checkBranchAll">  
                                                    <span></span>                             
                                                    </div>
                                                    @endif
                                                    <strong class="list-text"> &nbsp; All </strong>
                                                    </div>
                                                    <div class="branch-container">
                                                    @forelse ($branchs as $branch)
                                                     
                                                     @if(count($current_offers)>0)
                                                        @php 
                                                            $flg23=\App\Models\CurrentOffer::checksinglebrach($current_offers[0]->id,$branch->id);
                                                           
                                                        @endphp

                                                        <div class="d-flex align-items-center">
                                                       <div class="custom-check">
                                                       <input type="checkbox" id="category" name="branches[]" class="ckbCheckAll branch_inputs" value="{{$branch->id}}" branch-name-attr="{{$branch->title_en}}" {{$flg23==1?'checked':''}}>  
                                                       <span></span>                             
                                                       </div>
                                                       <strong class="list-text"> &nbsp; {{$branch->title_en}}</strong>
                                                       </div>

                                                     @else
                                                     <div class="d-flex align-items-center">
                                                    <div class="custom-check">
                                                    <input type="checkbox" id="category" name="branches[]" class="ckbCheckAll branch_inputs" value="{{$branch->id}}" branch-name-attr="{{$branch->title_en}}">  
                                                    <span></span>                             
                                                    </div>
                                                    <strong class="list-text"> &nbsp; {{$branch->title_en}}</strong>
                                                    </div>
                                                     @endif
                                                    
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
                                                       <!-- <div class="btn-group"> -->
                                                         
                                                         <button type="button" class="btn btn-danger" id="branch_save_countinue">Save and Continue</button>
                                                       </div>
                                                       <!-- </div> -->
                                                              
                                                    </div>
                                                    </div>
                                                    <!--end modal -->
                                                    <!-- end branch modal -->
                                                    <div class="pl-3 mb-3">
                                                    <span class="text-danger  d-none  select_notice"> Select at least one </span>
                                                    </div>
                                                    <!-- /.card-body -->
                                                 </div>
                                           
                                        <div class="row">
                                          <div class="col-6">
                                             <div id="" class="">
                                               <div class="border mt-0">
                                                <ul class="mb-0" id="show_all_selected_branch">
                                                @if(count($current_offers)>0)

                                                   @forelse ($current_offers[0]->brachlist as $branchlist)              
                                                      <li>
                                                          @php 
                                                           $flg12=\App\Models\CurrentOfferBranch::checkbranch($branchlist->branch_id);

                                                          @endphp
                                                        {{$flg12}}
                                                      </li>
                                                       @empty

                                                    @endforelse   
                                                 @endif
                                                </ul>
                                               </div>
                                             </div>
                                          </div>
                                        </div>
                                       </div>
                                       <!-- add choices -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer" style="padding-top: 25px;">
                                       <button type="submit" class="button btn_bg_color common_btn text-white w-auto">Update</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- tab content here -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- choice group modal -->
<div id="choice_group_modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Add Choice Group</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" data-bs-dismiss="modal">×</span>
            </button>
         </div>
         <div class="modal-body ">
            <form id="addChoiceGroupForm" enctype="multipart/form-data">
               <input type="hidden" value="{{$menuItem->id}}" name="menu_item_id">
               <div class="card-body form">
                  <div class="row">
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label for="name_en">Group Name(en)<span class="text-danger"> *</span></label>
                           <input type="text" name="name_en" class="form-control " id="choice_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;"> <small class='text-danger d-none choice_name_en_warning'> <i class='fa fa-warning'></i> This field can't be empty</small> @if($errors->has('name_en'))
                           <div class="error">{{ $errors->first('name_en') }}</div>
                           @endif 
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label for="name_ar">Group Name(ar)<span class="text-danger"> *</span></label>
                           <input type="text" name="name_ar" class="form-control" id="choice_name_ar" maxlength="100" style="background-color:white;border:1px solid #ced4da;"> <small class='text-danger d-none choice_name_ar_warning'> <i class='fa fa-warning'></i> This field can't be empty</small> 
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group mt-3">
                           <label for="mendatory_choice_count">Minimum Number of Choices</label>
                           <select class="form-control mendatory_choice_count" name="mendatory_choice_count">
                              <option value="0" selected>0(optional)</option>
                              <option value="1">1</option>
                           </select>
                           @if($errors->has('mendatory_choice_count'))
                           <div class="error">{{ $errors->first('mendatory_choice_count') }}</div>
                           @endif 
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group mt-3">
                           <label for="newtotal_choice_count">Maximum number of choices</label>
                           <select name="total_choice_count" id="newtotal_choice_count" >
                              <option>1</option>
                           </select>
                           <input type="hidden"  class="form-control" id="total_choice_count" value="1"> @if($errors->has('total_choice_count '))
                           <div class="error">{{ $errors->first('total_choice_count ') }}</div>
                           @endif 
                        </div>
                     </div>
                     <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                        <div class="form-group mt-3 mb-2">
                           <button type="button" class="add_new_choice">Add More Choices</button>
                        </div>
                     </div>
                     <div class="choices_parent" id="choices">
                        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                           <div class="row choices_child mt-2 pl-1">
                    <!--           <div class="col-md-4  col-lg-4  col-xl-4 col-12">
                                 <div class="form-group">
                                    <label for="imagefile">Image<span class="text-danger"> *</span></label>
                                    <input type="file" name="imagefile[]" id="imagefile" accept=".png, .jpg, .jpeg" class="form-control newimagefile"  >
                                    <div style="height:90px;width:100px;" class="mt-3 d-none"><img src="" style="height:100%;width:100%;" class="thumbnail_preview" /></div>
                                 </div>
                              </div> -->
                              <div class="col-md-4  col-lg-4  col-xl-4 col-12">
                                 <div class="form-group">
                                    <label for="choice_name_en">Choice Name(en)<span class="text-danger"> *</span></label>
                                    <input type="text" name="choice_name_en[]" class="form-control dynamic_name_en" maxlength="100"> 
                                 </div>
                              </div>
                              <div class="col-md-4  col-lg-4  col-xl-4 col-12">
                                 <div class="form-group">
                                    <label for="choice_name_ar">Choice Name(ar)<span class="text-danger"> *</span></label>
                                    <input type="text" name="choice_name_ar[]" class="form-control dynamic_name_ar" maxlength="100"> 
                                 </div>
                              </div>
                              <div class="col-md-3  col-lg-3  col-xl-3 col-12">
                                 <div class="form-group">
                                    <label for="choice_price">Price(KD) </label>
                                    <input type="number" name="choice_price[]" class="form-control" value=""  step="any"> 
                                 </div>
                              </div>
                              <div class="col-md-1 col-lg-1 col-xl-1 col-2 mt-5">
                                 <!-- <i class="text-danger fa fa-trash-alt" style="font-size:28px"></i> --><i class="text-success">Default</i> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- add choices -->
                  </div>
                  <!-- /.card-body -->
                  <div class="modal-footer pb-0 px-0">
                     <button type="submit" class="button btn_bg_color common_btn text-white">Save</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- choice group modal -->
<!-- edit choice group modal -->
<div id="edit_group_modal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Edit Choice Group</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body ">
            <form id="editChoiceGroupForm" enctype="multipart/form-data">
               <div class="card-body form">
                  <div class="row">
                     <input type="hidden" name="choice_group_id" id="choice_group_id">
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label for="name_en">Group Name(en)<span class="text-danger"> *</span></label>
                           <input type="text" name="name_en" class="form-control" id="edit_name_en" maxlength="100" style="background-color:white;border:1px solid #ced4da;"> @if($errors->has('name_en'))
                           <div class="error">{{ $errors->first('name_en') }}</div>
                           @endif 
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label for="name_ar">Group Name(ar)<span class="text-danger"> *</span></label>
                           <input type="text" name="name_ar" class="form-control" id="edit_name_ar" maxlength="100" style="background-color:white;border:1px solid #ced4da;"> @if($errors->has('name_ar'))
                           <div class="error">{{ $errors->first('name_ar') }}</div>
                           @endif 
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group mt-3">
                           <label for="mendatory_choice_count">Minimum Number of Choices</label>
                           <select class="form-control edit_mendatory_choice_count" id="edit_mendatory_choice_count" name="mendatory_choice_count"> </select> @if($errors->has('mendatory_choice_count'))
                           <div class="error">{{ $errors->first('mendatory_choice_count') }}</div>
                           @endif 
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group mt-3">
                           <label for="total_choice_count ">Maximum number of choices</label>
                           <select class="form-control" name="total_choice_count" id="ttotal_choice_countd">
                           </select>
                           <input type="hidden" name="" class="form-control" id="edit_total_choice_count"  value="1"> @if($errors->has('total_choice_count '))
                           <div class="error">{{ $errors->first('total_choice_count ') }}</div>
                           @endif 
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group mt-3 mb-1">
                           <button type="button" class="add_new_choice">Add More Choices</button>
                        </div>
                     </div>
                     <div class="edit_choices_parent" id="choices">
                        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                           <div class="row choices_child mt-3">
                              <!-- <div class="col-md-3 col-lg-3 col-xl-3 col-3">
                                 <div class="form-group mt-3">
                                    <label for="choice_name_en">Image<span class="text-danger"> *</span></label>
                                    <input type="file" accept=".png, .jpg, .jpeg" name="imagefile[]" class="form-control imagefile"> 
                                 </div>
                              </div> -->
                              <div class="col-md-4 col-lg-4 col-xl-4 col-4">
                                 <div class="form-group mt-3">
                                    <label for="choice_name_en">Choice Name(en)<span class="text-danger"> *</span></label>
                                    <input type="text" name="choice_name_en[]" class="form-control" maxlength="100"> 
                                 </div>
                              </div>
                              <div class="col-md-4 col-lg-4 col-xl-4 col-4">
                                 <div class="form-group mt-3">
                                    <label for="choice_name_ar">Choice Name(ar)<span class="text-danger"> *</span></label>
                                    <input type="text" name="choice_name_ar[]" class="form-control" maxlength="100"> 
                                 </div>
                              </div>
                              <div class="col-md-2 col-lg-2 col-xl-2 col-2">
                                 <div class="form-group mt-3">
                                    <label for="choice_price">Price<span class="text-danger"> *</span></label>
                                    <input type="number" name="choice_price[]" class="form-control" value="" maxlength="100"> 
                                 </div>
                              </div>
                              <div class="col-md-1 col-lg-1 col-xl-1 col-1 mt-5">
                                 <i class="text-success">Default</i> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- add choices -->
                  </div>
                  <!-- /.card-body -->
               </div>
               <div class="modal-footer pb-0">
               <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
            </div>
            </form>
            
         </div>
      </div>
   </div>
</div>
<!-- choice group modal -->
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<style type="text/css">

       label#rating-error   ,label#category_value-error{
    position: relative;
    top: 92px;
    left: -55px;
  }

    .form-group textarea{
        height:90px !important;
    }
   .bracherror{
   position: absolute;
   top: 45px;
   left:21px;
   }
   .tab_wrapper ul.nav.nav-pills {
   width: 70%;
   }
   .tab_wrapper ul li.nav-item {
   width: 32.333%;
   }
   .form-group.rating .emojionearea.form-control.emojionearea-inline {
    margin-left: -12px;
}
body form .card-body .btn-group button#branch-modal:active {
    background-color: #000000 !important;
    border-color: #000000 !important;
}
</style>
@stop 
@section('js')
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
 <script type="text/javascript">
      $(".catselect").select2();
</script>
<script type="text/javascript">
   $(document).ready(function(){

       $('#category_value').on('change',function(){
        if($(this).val()=='loyalty'){
            $('#change_value').html('Loyalty Point <span class="text-danger">*</span>');
            $('#change_value').next().attr('name','loyalty_point')
         }else{
            $('#change_value').text('Price (KD)');
            $('#change_value').next().attr('name','price')
         }
      });

       $('.checkBranchAll').click(function(){
           var branches  = $('.branch-container')[0];
           var all_branches_input = branches.getElementsByTagName('INPUT');

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
            $(".checkBranchAll").prop('checked', false);
          }

     });
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
             
              html_branch+="";
              html_branch+="<li>"+index+"</li>"
              html_branch+="";
            
          }); 
          $('.braches').removeClass('d-none');
            $('#show_all_selected_branch').append(html_branch);
     }
  });

     $('#branch-modal').click(function(){
          $('#branches-modal').modal({
             'show':true,
              backdrop: 'static',
              keyboard: false
        });
      });
   
   $( ".current__offerdatepicker" ).datetimepicker({
     timepicker:true,
     formatTime: 'g:i A',
     format : 'd/m/Y g:i A',
      validateOnBlur: false,
     minDate : 0
     });
   
          $("#rating").emojioneArea({
           pickerPosition: "right",
          });
   });
   
</script>
<script>
   $('#choice-list').DataTable({
       "language": {
           "emptyTable": " No choices found please add "
       },
   });
   $(document).ready(function() {  
    // preview image
   $(document).on('change','.imagefile',function(){
    $(this).next().children('img').attr('src',URL.createObjectURL(event.target.files[0]))
       $(this).next().children('img').onload = function() {
         URL.revokeObjectURL($(this).next().children('img').attr('src',URL.createObjectURL(event.target.files[0]))) // free memory
       }
   });
   $(document).on('change','.newimagefile',function(){
   $(this).next().removeClass('d-none');
   //$(this).next().children('img').removeClass('d-none');
    $(this).next().children('img').attr('src',URL.createObjectURL(event.target.files[0]))
       $(this).next().children('img').onload = function() {
         URL.revokeObjectURL($(this).next().children('img').attr('src',URL.createObjectURL(event.target.files[0]))) // free memory
       }
   
   });
   
   
   
     $('#editMenuItemForm').validate({
           ignore: [],
           debug: false,
           rules: {
               item_name_en: {
                   required: true,
                   noSpace: true
               },
               item_name_ar: {
                   required: true,
                   noSpace: true
               },
               cat_id: {
                   required: true,
                   noSpace: true
               },
               price: {
                   required: false,
                   //noSpace:true
               },
               tagline:{
                   required:true,
               },
               loyalty_point:{
                  required:true
               }
           },
           messages: {
               item_name_en: {
                   required: "Item Name(en) is required",
               },
               item_name_ar: {
                   required: "Item Name(ar) is required",
               },
               cat_id: {
                   required: "Category is required",
               },
               price: {
                   required: "Price is required",
               },
               tagline:{
                   required:"Tagline is required",
               },
               loyalty_point:{
                  required:"Loyalty Point is required"
               }
           }
       });
       $.validator.addMethod("noSpace", function(value, element) {
           return $.trim(value).length != 0;
       }, "No space please and don't leave it empty");
   
       $(document).on('click','#appbrackcheck',function() {
            $("input[type=checkbox]").prop('checked', this.checked)
         });
   
       $('.checkBoxClass').on('click',function(){
          if($('.checkBoxClass:checked').length == $('.checkBoxClass').length) {
            $(".ckbCheckAll").prop('checked', 'true');
            }
         else {
           
           $(".ckbCheckAll").prop('checked', false);
         }
       })
        
   
         $('.subs').keypress(function( e ) {
   
             if($(this).val()===null || $(this).val()===''){
             if(e.which === 32){ 
                 return false;
               }
             }
         })
   
         jQuery.validator.addMethod("maxlengthd", function(value, element) {
             if($('#offers_type').val()=='0')
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
   
           jQuery.validator.addMethod("money",function(value, element) {
                   var isValidMoney = /^\d{0,4}(\.\d{0,2})?$/.test(trim(value));
                   return this.optional(element) || isValidMoney;
               },
               "Plase enter a valid Percentage/Amount"
           );
   
       $('#editformcurrentoffer').validate({
           ignore: [],
           debug: false,
           rules: {
            current_offer_name:{
                  required:true
            },
               offers_type: {
                   required: true,
                   noSpace: true
               },
               current_offer_amount: {
                   required: true,
                  maxlengthd:true,
                  
   
               },
               current_offer_description:{
                    required:true
               },
               'branchs[]': { required: true, minlength: 1 },
               current_offer_enddate:{
                   required:true
               },
               current_offer_startdate:{
                   required:true
               }
               
              
           },
           messages: {
            current_offer_name:{
                  required:"Offer Name is required"
            },
               offers_type: {
                   required: "Offer type is required",
               },
               current_offer_description:{
                   required:"Description is required"
               },
             
               current_offer_amount: {
                   required: "Percentage/Amount is required",
               },
               'branchs[]': { required:"Branch is required" },
               current_offer_enddate:{
                   required:"End Date/ Time is required"
               },
               current_offer_startdate:{
                   required:"Start Date/ Time is required"
               }
              
           },
               submitHandler: function(form) { 
             

 



               if($('.ckbCheckAll').is(':checked')){
                 // alert();
                  return true;
              }else{
                
                  $('.select_notice').removeClass('d-none');

                  setTimeout(function(){
                     $('.select_notice').addClass('d-none');
                  },1800);
                  return false;
              } 




              //  return false;

             
               
              
   }
       });
   });
   
   
</script>
<!-- show image on change -->

<!-- show image on change -->
<script type="text/javascript">
   function readURL(input) {
       if(input.files && input.files[0]) {
           var reader = new FileReader();
           reader.onload = function(e) {
               $('#thumbnail_preview').css('display', 'block');
               $('#thumbnail_preview').attr('src', e.target.result);
               $('.upload-img').removeClass('d-none');
           };
           reader.readAsDataURL(input.files[0]);
       }
   } 
   
   function readURLL(input) {
       if(input.files && input.files[0]) {
           var reader = new FileReader();
           reader.onload = function(e) {
               $('#current_thumbnail_preview').css('display', 'block');
               $('.upload-img').removeClass('d-none');
               $('#current_thumbnail_preview').attr('src', e.target.result);
           };
           reader.readAsDataURL(input.files[0]);
       }
   }
</script>
<!-- show image on change -->
<script>
   $(document).ready(function() {
   
       $(document).on('click','.choice_remove_btnpre',function(){
        var id=$(this).data('id');
   
       $(this).parent().parent().remove();
   
        $.ajax({
           
           url:"{{route('items.delete.choices')}}",
           method:"POST", 
           dataType:"JSON",
           data:{
               'id':id, 
               "_token": "{{ csrf_token() }}"
              },
           success:function(response)
           {
             
               var mendatory_choice_count=$('.edit_mendatory_choice_count').find(':selected').val();
              
               var total_choice_length = $('#edit_total_choice_count').val();
               $('#edit_total_choice_count').val(total_choice_length - 1);
               var indx = $('#edit_total_choice_count').val();
               $('.edit_mendatory_choice_count').html(' ');
              
               $('#ttotal_choice_countd').html('');
               var maxchoice=response.group.total_choice_count;
        
               var  maxchoice_option="";
               var selected_max_choice='';
               for(i = 0; i < parseInt(total_choice_length); i++) {
            
   
                   if(i == 0) {
                       var selected = '';
                       if(mendatory_choice_count == i) {
                           // alert(mendatory_choice_count);
                           selected = 'selected';
                       }
                       var option = `<option value="` + i + `"  ` + selected + `>` + i + `(optional)</option>`;
                       $('.edit_mendatory_choice_count').append(option);
                   } else {
   
                        if(i==maxchoice)
                        {
                          selected_max_choice='selected';
                        }else
                        {
                           selected_max_choice='';
                        }
   
                       var selected = '';
                       if(mendatory_choice_count == i) {
                           // alert(mendatory_choice_count);
                           selected = 'selected';
                       }
                       var option = `<option value="` + i + `" ` + selected + ` >` + i + `</option>`;
                       $('.edit_mendatory_choice_count').append(option);
   
                 maxchoice_option+="<option "+selected_max_choice+" >"+i+"</option>";
                   }
               } 
               $('#ttotal_choice_countd').append(maxchoice_option);
    
           }
        });        
      });
   
   
      $('.add_new_choice').click(function() {
           var total_choice_count = $('#total_choice_count').val();
               total_choice_count = Number(total_choice_count) + 1;
         
               
           $('#total_choice_count').val(total_choice_count);
   
       var max_choice = `
           <option value=` + total_choice_count + `>` + total_choice_count + `</option>
           `;
       var option = `
           <option value=` + total_choice_count + `>` + total_choice_count + `</option>
           `;
           $('.mendatory_choice_count').append(option);
           $('#newtotal_choice_count').append(max_choice);
               
           var html = `
           <div class="col-12">
           <div class="row choices_child mt-2 pl-1">
          
           <div class="col-md-4 col-lg-4 col-xl-4 col-4">
           <div class="form-group">
           <label for="choice_name_en">Choice Name(en)<span class="text-danger"> *</span></label>
           <input type="text" name="choice_name_en[]" class="form-control dynamic_name_en"     maxlength="100">
           </div>
           </div>
           <div class="col-md-4 col-lg-4 col-xl-4 col-4">
           <div class="form-group">
           <label for="choice_name_ar">Choice Name(ar)<span class="text-danger"> *</span></label>
           <input type="text" name="choice_name_ar[]" class="form-control dynamic_name_ar"     maxlength="100">
           </div>
           </div>
           <div class="col-md-3 col-lg-3 col-xl-3 col-3">
           <div class="form-group">
           <label for="choice_price">Price(KD) </label>
           <input type="number" name="choice_price[]" class="form-control" step="any">
           </div>
           </div>
           <div class="col-md-1 col-lg-1 col-xl-1 col-1 mt-5">
           <i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:20px;cursor:pointer"></i> 
           </div>
           </div></div>
           `;
           $('.choices_parent').append(html);
           //remove choices
           $('.choice_remove_btn').each(function() {
               $(this).click(function() {
                   var total_choice_length = this.parentElement.parentElement.parentElement.children.length;
                   var index = $('#total_choice_count').val();
                   $('#total_choice_count').val(parseInt(index) - 1);
                   $('.mendatory_choice_count').html(' ');
                    $('#newtotal_choice_count').html('');
                   for(i = 0; i < parseInt(index); i++) {
   
                       if(i == 0) {
                           var option = `
                   <option value="` + i + `">` + i + `(optional)</option>
                   `;
                           $('.mendatory_choice_count').append(option);
                       }
                        else {
   
              var max_choice = `<option>` + i + `</option>`;
             var option = ` <option value="` + i + `">` + i + `</option>`;
                    $('.mendatory_choice_count').append(option);
                   $('#newtotal_choice_count').append(max_choice);
   
                       }
                   }
                   var parentElements = this.parentElement.parentElement;
                   parentElements.remove();
               });
           });
       });
   });
   $('#addChoiceGroupForm').submit(function(e) {
   
          var maxchoice=$('#newtotal_choice_count').find(':selected').val();
           var minchoice=$('.mendatory_choice_count').find(':selected').val();
           if(minchoice<=maxchoice)
           {
               //alert('success')
           }
           else
           {
               toastr.error("Please Minimum Number of Choices Less then or Equal Maximum Number of choices");
                $('.mendatory_choice_count').focus();
               return false;
           }
   
       e.preventDefault();
       if($('#choice_name_en').val().trim() == '') {
           //$('#choice_name_en').addClass('border border-danger');
           $('#choice_name_en').next().remove();
           $("<span class='text-danger compare'>Group Name(en) is required </span>").insertAfter('#choice_name_en');
       }
       if($('#choice_name_ar').val().trim() == '') {
           //$('#choice_name_ar').addClass('border border-danger'); 
           $('#choice_name_ar').next().remove();
           $("<span class='text-danger compare'>Group Name(ar) is required </span>").insertAfter('#choice_name_ar');
       }
       $('#choice_name_en').on('input', function() {
           //$('#choice_name_en').removeClass('border border-danger');
           $('#choice_name_en').next().remove();
       }); 
       $('#choice_name_ar').on('input', function() {
           // $('#choice_name_ar').removeClass('border border-danger');
           $('#choice_name_ar').next().remove();
       });
       $('.dynamic_name_en').each(function() {
           if($(this).val().trim() == '') {
               //  $(this).addClass('border border-danger');
               $(this).next().remove();
               $("<span class='text-danger compare'>Choice Name(en) is required </span>").insertAfter(this);
           }
       });
   
       //  $('.newimagefile').each(function() {
       //     if($(this).val().trim() == '') {
       //         $(this).next().remove();
       //         $("<span class='text-danger compare'>Image is required </span>").insertAfter(this);
       //     }
       // });
       // $('.newimagefile').each(function() {
       //     $(this).on('input', function() {
       //         $(this).next().remove();
       //     });
       // });
   
       // $('.addimage').each(function() {
       //     if($(this).val().trim() == '') {
       //         //  $(this).addClass('border border-danger');
       //         $(this).next().remove();
       //         $("<span class='text-danger compare'>Choice image is required </span>").insertAfter(this);
       //     }
       // });
       // $('.addimage').each(function() {
       //     $(this).on('input', function() {
       //         //  $(this).removeClass('border border-danger');
       //         $(this).next().remove();
       //     });
       // });
       $('.dynamic_name_en').each(function() {
           $(this).on('input', function() {
               //  $(this).removeClass('border border-danger');
               $(this).next().remove();
           });
       });
       $('.dynamic_name_ar').each(function() {
           if($(this).val().trim() == '') {
               // $(this).addClass('border border-danger'); 
               $(this).next().remove();
               $("<span class='text-danger compare'>Choice Name(ar) is required </span>").insertAfter(this);
           }
       });
       $('.addimage').each(function() {
           if($(this).val().trim() == '') {
               // $(this).addClass('border border-danger'); 
               $(this).next().remove();
               $("<span class='text-danger compare'>Choice Image is required </span>").insertAfter(this);
           }
       });
       $('.dynamic_name_ar').each(function() {
           $(this).on('input', function() {
               //  $(this).removeClass('border border-danger'); 
               $(this).next().remove();
           });
       });
       $('.addimage').each(function() {
           $(this).on('input', function() {
               //  $(this).removeClass('border border-danger'); 
               $(this).next().remove();
           });
       });
       //menu.item.choice.group.edit.save
       var container = document.getElementById('addChoiceGroupForm');
       var input = container.getElementsByClassName("compare");
       if(input.length == 0) {
           $.ajax({
               type: "POST",
               url: "{{route('menu.item.choice.group.edit.save')}}",
               data: new FormData(this),
               contentType: false,
               processData: false,
               success: function(response) {
                 
                   $('#choice_group_modal').modal('hide');
                   if(response.trim() == 'success') {
                       $("#flash-message").css("display", "block");
                       $("#flash-message").removeClass("d-none");
                       $("#flash-message").addClass("alert-success");
                       $('#flash-message').html('Choice Group Created Successfully');
                       setTimeout(() => {
                           $("#flash-message").addClass("d-none");
                           location.href = window.location;
                       }, 2000);
                   } else {
                      
                       setTimeout(() => {
                           swal('Error', 'Something went wrong', 'error');
                           // alert("Something went wrong! Please try again.");
                       }, 500);
                   }
               }
           });
       }
   });
</script>
<script>
   $(document).on('click', '.edit-button', function(e) {
   
        var edit_id = $(this).attr('data-id');
         $('#edit_group_modal').modal({backdrop: 'static', keyboard: false}, 'show');
   
       var current_value_stored_td = this.parentElement.parentElement.children[0];
       var name_en = $(current_value_stored_td).attr('c_g_n_en');
       var name_ar = $(current_value_stored_td).attr('c_g_n_ar');
       var mendatory_choice_count = $(current_value_stored_td).attr('m_c_count');
       var total_choice_count = $(current_value_stored_td).attr('t_c_count');
       var choice_group_id = edit_id;
   
      
       $.ajax({
           type: "post",
           url: "{{route('menu.item.choice.group.choices')}}",
           data: {
               "_token": "{{ csrf_token() }}",
               "id": edit_id
           },
           success: function(response) {
               var url="{{asset('files')}}";
               
                var all_data = response;
              
               $('#edit_name_en').val(response.group.name_en);
               $('#edit_name_ar').val(response.group.name_ar);
              
               $('#choice_group_id').val(choice_group_id);
   
            let mendatory_choice_count=response.group.mendatory_choice_count;
            let maxchoice=response.group.total_choice_count;
   
               $('.edit_choices_parent').html("");
               $('.edit_mendatory_choice_count').html("");
               $('#ttotal_choice_countd').html("");
               var option = "<option value='0' selected>0(optional)</option>";
               $('.edit_mendatory_choice_count').append(option);
                var index_selected=0;
   
                var selected_max_choice='';
               response.ct.forEach(function(data, index) {
   
                    if((index_selected+1)==maxchoice)
                    {
                      selected_max_choice='selected';
                    }else
                    {
                       selected_max_choice='';
                    }
   
                   var  maxchoice_option="<option "+selected_max_choice+" >"+(index_selected+1)+"</option>";
   
                  if(index == 0) {
                        index_selected = index + 1;
                       var selected = '';
                       
                       if(mendatory_choice_count == index_selected) {
                           selected = 'selected';
                       }

                  //  <div class="col-md-3  col-lg-3  col-xl-3  col-3 ">
                  // <div class="form-group">
                  // 
                  // <label for="choice_name_en">Image</label>
                  // <input type="file" name="imagefile[]" accept=".png, .jpg, .jpeg" class="form-control imagefile">
                  // <div style="height:90px;width:100px;" class="mt-3"><img src="`+url+"/"+data.imagefile + `" class="thumbnail_preview" style="height:100%;width:100%;"/></div>
                  // </div>
                  // </div> 

           var html = `<div class="col-12">
           <div class="row choices_child mt-2 pl-1">
                  <input type="hidden" name="choiceid[]" value="` + data.id + `" />
                  <div class="col-md-4  col-lg-4  col-xl-4  col-4 ">
                  <div class="form-group">
                  <label for="choice_name_en">Choice Name(en)<span class="text-danger"> *</span></label>
                  <input type="text" name="choice_name_en[]" class="form-control edit_dynamic_name_en" maxlength="100" value="`+ data.name_en + `">
                  </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-xl-4 col-4">
                  <div class="form-group">
                  <label for="choice_name_ar">Choice Name(ar)<span class="text-danger"> *</span></label>
                  <input type="text" name="choice_name_ar[]" class="form-control edit_dynamic_name_ar" maxlength="100" value="` + data.name_ar + `">
                  </div>
                  </div>
                  <div class="col-md-3 col-lg-3  col-xl-3  col-3">
                  <div class="form-group">
                  <label for="choice_price">Price(KD)</label>
                  <input type="number" name="choice_price[]" class="form-control"  step="any" value="` + data.price + `">
                  </div>
                  </div>
                  <div class="col-md-1 col-lg-1 col-xl-1 col-1  mt-5">
                  
                  
                  <i class="text-success">Default</i>
                  
                  </div>
                  </div></div`;
   
                       var option = `<option value="` + index_selected + `" ` + selected + ` >` + index_selected + `</option>`;
                       // var option = `<option value="`+index_selected+`" `+selected+` >`+index+`(optional)</option><option value="`+ ++index_selected+`" `+selected+`>`+ ++index +`</option>`; 
                   } else {
                        index_selected = index_selected + 1;
                       var selected = '';
                      
                       if(mendatory_choice_count == index_selected) {
                           selected = 'selected';
                       }
                  // <div class="col-md-3  col-lg-3  col-xl-3  col-3 ">
                  //         <div class="form-group">
                  //          
                  //         <label for="imagefile">Image</label>
                  //         <input type="file" name="imagefile[]" accept=".png, .jpg, .jpeg" 
                  //          id="imagefile" class="form-control imagefile">
                  //          <div style="height:90px;width:100px;" class="mt-3"><img src="`+url+"/"+data.imagefile + `" style="height:100%;width:100%;" class="thumbnail_preview" /></div>
                  //         </div>
                  //      </div>
                   var html = `<div class="col-12">
                   <div class="row choices_child mt-2 pl-1">
                       <input type="hidden" name="choiceid[]" value="` + data.id + `" />
                       <div class="col-md-4  col-lg-4  col-xl-4  col-4 ">
                       <div class="form-group">
                       <label for="choice_name_en">Choice Name(en)<span class="text-danger"> *</span></label>
                       <input type="text" name="choice_name_en[]" class="form-control edit_dynamic_name_en" maxlength="100" value="` + data.name_en + `">
                       </div>
                       </div>
                       <div class="col-md-4 col-lg-4 col-xl-4 col-4">
                       <div class="form-group">
                       <label for="choice_name_ar">Choice Name(ar)<span class="text-danger"> *</span></label>
                       <input type="text" name="choice_name_ar[]" class="form-control edit_dynamic_name_ar"     maxlength="100" value="` + data.name_ar + `">
                       </div>
                       </div>
                       <div class="col-md-3 col-lg-3  col-xl-3  col-3">
                       <div class="form-group">
                       <label for="choice_price">Price(KD) </label>
                       <input type="number" name="choice_price[]" class="form-control"   step="any" value="` + data.price + `">
                       </div>
                       </div>
                       <div class="col-md-1  col-lg-1  col-xl-1 col-1  mt-5">
   
                       <i class="text-danger fa fa-trash-alt choice_remove_btnpre" style="font-size:20px;cursor:pointer" data-id="` + data.id + `"></i> 
                       </div>
                       </div></div>`;
                       var option = `<option value="` + index_selected + `" ` + selected + ` >` + index_selected + `</option>`;
                       // var option = `<option  value="`+ ++index_selected+`" `+selected+`>`+ ++index+`</option>`; 
                   }
                   $('.edit_choices_parent').append(html);
                   $('.edit_mendatory_choice_count').append(option);
                   $('#ttotal_choice_countd').append(maxchoice_option);
                  
                   $('#edit_total_choice_count').val(index_selected);
                   
               });
               //remove choices
               $('.choice_remove_btn').each(function() {
                   $(this).click(function() {
                       var total_choice_length = $('#edit_total_choice_count').val();
                       $('#edit_total_choice_count').val(total_choice_length - 1);
                       $('.edit_mendatory_choice_count').html(' ');
                       for(i = 0; i < total_choice_length; i++) {
                           if(i == 0) {
                               var selected = '';
                               if(mendatory_choice_count == i) {
                                   // alert(mendatory_choice_count);
                                   selected = 'selected';
                               }
                               var option = `<option value="` + i + `"  ` + selected + `>` + i + `(optional)</option>`;
                               $('.edit_mendatory_choice_count').append(option);
                           } else {
                               var selected = '';
                               if(mendatory_choice_count == i) {
                                   // alert(mendatory_choice_count);
                                   selected = 'selected';
                               }
                               var option = `<option value="` + i + `" ` + selected + ` >` + i + `</option>`;
                               $('.edit_mendatory_choice_count').append(option);
                           }
                       }
                       
                       var parentElements = this.parentElement.parentElement;
                       parentElements.remove();
                   });
               });
               //Add more choices
                 $('.add_new_choice').click(function() {
   
                   var total_choice_count = $('#edit_total_choice_count').val();
                   total_choice_count = Number(total_choice_count) + 1;
                   $('#edit_total_choice_count').val(total_choice_count);
                   var option = `<option value=` + total_choice_count + `>` + total_choice_count + `</option>`;
                   $('.edit_mendatory_choice_count').append(option);
                   $('#ttotal_choice_countd').append(option);
               
               // <div class="col-md-3 col-lg-3 col-xl-3 col-3">
               //     <div class="form-group">
               //     <label for="imagefile">Image<span class="text-danger"> *</span</label>
               //     <input type="file" name="editimagefile[]" id="imagefile" class="form-control newimagefile" accept=".png, .jpg, .jpeg" >
               //      <div style="height:90px;width:100px;" class="mt-3 d-none"><img src="" style="height:100%;width:100%;" class="thumbnail_preview " /></div>
                    
               //     </div>
               //     </div>
             var html = `<div class="col-12">
             <div class="row choices_child mt-2 pl-1">
                  
                   <div class="col-md-4 col-lg-4 col-xl-4 col-4">
                   <div class="form-group">
                   <label for="choice_name_en">Choice Name(en)<span class="text-danger"> *</span></label>
                   <input type="text" name="editchoice_name_en[]" class="form-control edit_dynamic_name_en"     maxlength="100">
                   </div>
                   </div>
                   <div class="col-md-4 col-lg-4 col-xl-4 col-4">
                   <div class="form-group">
                   <label for="choice_name_ar">choice Name(ar)<span class="text-danger"> *</span></label>
                   <input type="text" name="editchoice_name_ar[]" class="form-control edit_dynamic_name_ar"     maxlength="100">
                   </div>
                   </div>
                   <div class="col-md-3 col-lg-3  col-xl-3  col-3  ">
                   <div class="form-group">
                   <label for="choice_price">Price(KD)</label>
                   <input type="number" name="editchoice_price[]" class="form-control"  step="any">
                   </div>
                   </div>
                   <div class="col-md-1 col-lg-1 col-xl-1 col-1 mt-5">
                   
                   <i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:20px;cursor:pointer"></i> 
                   </div>
                   </div></div>`;
                   $('.edit_choices_parent').append(html);
   
                   //remove choices
                   $('.choice_remove_btn').each(function() {
                       $(this).click(function() {
                           var total_choice_length = $('#edit_total_choice_count').val();
                           $('#edit_total_choice_count').val(total_choice_length - 1);
                           $('.edit_mendatory_choice_count').html(' ');
                            $('#ttotal_choice_countd').html('');
   
                           for(i = 0; i < parseInt(total_choice_length); i++) {
                               if(i == 0) {
                                   var selected = '';
                                   if(mendatory_choice_count == i) {
                                      
                                       selected = 'selected';
                                   }
                                   var option = `<option value="` + i + `"  ` + selected + `>` + i + `(optional)</option>`;
                                   $('.edit_mendatory_choice_count').append(option);
                               } else {
                                   var selected = '';
                                   if(mendatory_choice_count == i) {
                                       
                                       selected = 'selected';
                                   }
                                   var option = `<option value="` + i + `"  ` + selected + `>` + i + `</option>`;
                                   $('.edit_mendatory_choice_count').append(option);
                                   $('#ttotal_choice_countd').append(option);
                               }
                           }
                           var parentElements = this.parentElement.parentElement;
                           parentElements.remove();
                       });
                   });
               });
           }
       });
   });
   $('#editChoiceGroupForm').submit(function(e) {
   
       e.preventDefault();
   
        
           var maxchoice=$('#ttotal_choice_countd').find(':selected').val();
           var minchoice=$('.edit_mendatory_choice_count').find(':selected').val();
           if(minchoice<=maxchoice)
           {
               //alert('success')
           }
           else
           {
               toastr.error("Please Minimum Number of Choices Less then or Equal Maximum Number of choices");
                $('.edit_mendatory_choice_count').focus();
               return false;
           }
      
       if($('#edit_name_en').val().trim() == '') {
           $('#edit_name_en').next().remove();
           $("<span class='text-danger compare'>Group Name(en) is required </span>").insertAfter('#edit_name_en');
       }
       if($('#edit_name_ar').val().trim() == '') {
           $('#edit_name_ar').next().remove();
           $("<span class='text-danger compare'>Group Name(ar) is required </span>").insertAfter('#edit_name_ar');
       }
       $('#edit_name_en').on('input', function() {
           $('#edit_name_en').next().remove();
       });
       $('#edit_name_ar').on('input', function() {
           $('#edit_name_ar').next().remove();
       });
       $('.edit_dynamic_name_en').each(function() {
           if($(this).val().trim() == '') {
               $(this).next().remove();
               $("<span class='text-danger compare'>Choice Name(en) is required </span>").insertAfter(this);
           }
       });
       $('.edit_dynamic_name_en').each(function() {
           $(this).on('input', function() {
               $(this).next().remove();
           });
       });
       //   $('.newimagefile').each(function() {
       //     if($(this).val().trim() == '') {
       //         $(this).next().remove();
       //         $("<span class='text-danger compare'>Image is required </span>").insertAfter(this);
       //     }
       // });
       // $('.newimagefile').each(function() {
       //     $(this).on('input', function() {
       //         $(this).next().remove();
       //     });
       // });
       $('.edit_dynamic_name_ar').each(function() {
           if($(this).val().trim() == '') {
               $(this).next().remove();
               $("<span class='text-danger compare'>Choice Name(ar) is required </span>").insertAfter(this);
           }
       });
       $('.edit_dynamic_name_ar').each(function() {
           $(this).on('input', function() {
               $(this).next().remove();
           });
       });
       var container = document.getElementById('editChoiceGroupForm');
       var input = container.getElementsByClassName("compare");
       if(input.length == 0) {
           $.ajax({
               type: "post",
               url: "{{route('menu.item.choice.group.update')}}",
               data: new FormData(this),
               contentType: false,
               processData: false,
               success: function(response) {
   
                   $('#edit_group_modal').modal('hide');
                   if(response.data == 'success') {
                       $("#flash-message").css("display", "block");
                       $("#flash-message").removeClass("d-none");
                       $("#flash-message").addClass("alert-success");
                       $('#flash-message').html('Choice Group Updated Successfully');
                       $('#choice-list').DataTable().clear().destroy();
                       $('.choicegp').html(response.table);
                       $('#choice-list').DataTable();
                       setTimeout(() => {
                           $("#flash-message").addClass("d-none");
                           $("#flash-message").empty();
                       }, 6000);
                   } else {
                       
                       setTimeout(() => {
                           swal('Error', 'Something went wrong', 'error');
                           alert("Something went wrong! Please try again.");
                       }, 1000);
                   }
               }
           });
       }
   });
   //Delete Choices
   $(document).on('click', '.delete-button', function(e) {
       var id = $(this).attr('data-id');
       var obj = $(this);
       swal({
           title: "Are you sure?",
           text: "Are you sure you want to  this choice group ?",
           type: "warning",
           showCancelButton: true,
       }, function(willDelete) {
           if(willDelete) {
               $.ajax({
                   type: 'post',
                   url: "{{route('menu.item.choice.group.delete')}}",
                   data: {
                       id: id
                   },
                   dataType: "JSON",
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   success: function(response) {
                       
                       if(response.success == 1) {
                           $("#flash-message").css("display", "block");
                           $("#flash-message").removeClass("d-none");
                           $("#flash-message").addClass("alert-danger");
                           $('#flash-message').html('Choice Group Deleted Successfully');
                           obj.parent().parent().remove();
                           setTimeout(() => {
                               $("#flash-message").addClass("d-none");
                           }, 5000);
                       } else {
                           
                           setTimeout(() => {
                               swal('Error', 'Something went wrong', 'error');
                               // alert("Something went wrong! Please try again.");
                           }, 500);
                       }
                   }
               });
           }
       });
   });
</script>
<script>
$(".remove-pro-img").click(function(evt){      
  $(".upload-img").addClass("d-none");
  $("#thumbnail_preview").css('display', 'none');
  $(".thumbnail_pic").val(null);   
  });





$('.delete_pdf').on('click',function(){
   
    var id = $(this).attr('current_id');
    var pdf_name = $(this).attr('pdf_name');

    if(pdf_name.trim() !=""){ 


      swal({
        title: "Are you sure?",
        text: "Are you sure you want to  delete this  image ?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
         
       $.ajax({
        url:"{{route('categories.image.remove')}}",
        method:"POST",
        data:{
           'id':id, 
          }, 
        dataType:"JSON",
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success:function(response){
         console.log("Response", response);
        
        //  swal("Status!", "Status Successfully Updated. ", "success");
         
               if(response.success == 1) {
                  $('.delete_pdf').attr('pdf_name',' ');
                   $(".upload-img").addClass("d-none");
                   $("#thumbnail_preview").css('display', 'none');
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                  swal('Error','Something went wrong','error');
                // alert("Something went wrong! Please try again.");
                }, 500);
              } 

        }
      });
        } 
      });
  
    }
   

});

</script> 
@stop