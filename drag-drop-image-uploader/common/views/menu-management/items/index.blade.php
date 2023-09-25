@extends('adminlte::page')

@section('title', ' Super Admin |  Menu Items')

@section('content_header')
 <style type="text/css">
   .first{
    width: 120px !important;
   }
   .second{
    width: 120px !important;
   }
 </style>

@section('content')

<?php 
  
  $session_cat_id = Session::get('session_cat_id');
  $session_item_type = Session::get('session_item_type');

?>

<div class="container">
  <div class="alert d-none" role="alert" id="flash-message">        
  </div>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-main">   
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0" style="display: none;">
            <h3></h3>
            <a  href="#" data-toggle="collapse" data-target="#advanceOptions" class="d-none advance-option-margin show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a> 
          </div>
          <div class=" mb-3 collapse show" id="advanceOptions">
            <div class="advance-options" style="">
             <div class="title">
               <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
              </div> 
               <div  class="bg-light w-50">
                  <h6>Select  Category</h6>
                   <div class="left_option">
                       <div class="left_inner">
                         
                         <div class="button_input_wrap">
                          <div class="date_range_wrapper">
                           <i class="fas fa-calendar-alt mr-2"></i>
                           
                            

                            <select class="advance_category_search catselect">
                              <option value="all_category">All Category</option>
                             
                              @forelse ($menuCategory as $allCateogry)
                                  <option {{ $session_cat_id==$allCateogry->id ? 'selected':''}}  value="{{$allCateogry->id}}">{{ $allCateogry->name_en }}</option>
                               @empty 
                                   <option class="disabled">Category not found</option>
                              @endforelse

                            </select> 

                             <select class="catselect_items  item_type_search">
                              <option  {{ $session_item_type=="all_type_item" ? 'selected':''}}  value="all_type_item">All Type Items</option>
                              <option {{ $session_item_type=="most_selling_item" ? 'selected':''}}   value="most_selling_item">Most Selling  Items</option>
                              <option  {{ $session_item_type=="loyality_item" ? 'selected':''}}  value="loyality_item">Loyality Items</option>
                             </select> 


                          </div> 
                          <div class="apply_reset_btn">
                             <button class="apply apply-filter mr-1" style="background-color: red !important;border: none;border-radius:4px;"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                             <button class="btn btn-primary reset-button" style="background-color:#000000;border: none;color: #ffffff;"><i class="fas fa-sync-alt mr-2" style="color: #ffffff;"></i>Reset</button>                          
                           </div>                              
                         </div>                                                    
                       </div>
                          
                     </div>
               </div>
            </div>
          </div>
          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
           <div> <h3 class="text-center">Menu Items</h3>  
                           </div>
           @can('add_item')
            <a class="btn btn-sm btn-success" href="{{route('menu.item.add')}}">Add Menu Item</a>
         @endcan
          </div>           
          <div class="card-body table p-0 mb-0">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif 

             <!-- <button type="button" class="btn btn-primary" data-toggle="popover">Popover without Title</button> -->
            <div class="table-responsive">
              <table style="width:100%" id="menuitem-list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                   
                    <th>Order BY Position</th>
                    <th>Image</th>
                    <th class="first">Item Name{{ labelEnglish() }}</th>
                    <th class="second">Item Name{{ labelArabic() }}</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                  @if(Gate::check('view_item') || Gate::check('edit_item') || Gate::check('delete_item')) 
                   <th>{{ __('adminlte::adminlte.actions') }}</th>
                   @endif
                  </tr>
                </thead>
                <tbody id='menuitemlist-items'>
                  @forelse ($menuItem as $menuItem)
                  {{--asset('menuItem/thumbnail/'.$menuItem->thumbnail)--}} 
                    <tr class="row1" data-id="{{$menuItem->id}}">
                   
                    <td>{{$menuItem->orderedby}}</td>
                    
                    <td  style="cursor:pointer;" data-toggle="popover"  origin_url="{{asset('')}}"  class="popover_td"  data-id="{{$menuItem->id}}" data-img="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}">
                      <img src="{{asset('menuItem/thumbnail/'.$menuItem->thumbnail)}}">
                    </td>

                    <td >
                      {{ $menuItem->item_name_en ?? 'N/A'}} 
                      
                      @if(@$menuItem->mostselling_item)
                       <hr>
                      <span class="badge badge-success"> Most Selling Item</span>
                      @endif
                      @if(@$menuItem->loyalty_item)
                    <hr>
                      <span class="badge badge-success"> Loyalty Item</span>
                      @endif 
                        
                    
                      </td>

                    <td>{{ $menuItem->item_name_ar ?? 'N/A'}}
                      
                      @if(@$menuItem->mostselling_item)
                       <hr>
                       <span class="badge badge-success">  السلعة الأكثر مبيعًا</span>
                      @endif
                        @if(@$menuItem->loyalty_item)
                    <hr>
                      <span class="badge badge-success"> عنصر الولاء</span>
                      @endif

                    </td>
                    <td>{{ optional($menuItem->menuCategory)->name_en ?? 'N/A'}}   {{  optional($menuItem->menuCategory)->name_ar==null ? ' ':'('}}  {{  optional($menuItem->menuCategory)->name_ar ?? ''}}  {{  optional($menuItem->menuCategory)->name_ar==null ? ' ':')'}}</td>
                     
                    <td>
                      @if($menuItem->item_type=='loyalty')
                        {{(int)$menuItem->price." ".env('LOYALTY_POINT')}}
                     @else 
                       @if($menuItem->price != ''){{env('AMOUNT_SIGN')." ".$menuItem->price}}@else 0 KD @endif    
                     @endif
                    </td>
                    
                    <td>
                      @foreach($status as $status_data)
                         @if($menuItem->status==$status_data->value)
                          <span class="{{$menuItem->status==1?'text-success':'text-danger'}}"> {{$status_data->name}}</span>
                         @endif
                      @endforeach
                     
                    </td>
                  @if(Gate::check('view_item') || Gate::check('edit_item') || Gate::check('delete_item')) 

                    <td class="actions_wrapper">
                        
                        <!--  <a data-id="{{ $menuItem->id}}" class="action-button upload-item-images-button" title="Upload Menu Item Image" href="javascript:void(0)" ><i class="text-dark fa fa-upload" ></i></a>  -->
                        @can('edit_item')
                        <div data-id="{{ $menuItem->id}}" class="upload-item-images-button">
                         <i class="fa fa-upload"  style="cursor:pointer;"  title="Upload Menu Item Image"></i> 
                         <input type="file" class="sr-only" id="input" name="image"  accept="image/*" onchange="readURL(this);" data-id="{{ $menuItem->id}}">
                        </div>
                         @endcan
                        @can('view_item')
                        <a class="action-button" title="View" href="{{route('menu.item.view',['id' => $menuItem->id])}}"><i class="text-info fa fa-eye"></i></a>
                        @endcan
                        @can('edit_item')
                        <a class="action-button" title="Edit" href="{{route('menu.item.edit',['id' => $menuItem->id])}}"><i class="text-warning fa fa-edit"></i></a>
                        @endcan
                        @can('delete_item')
                       <a data-id="{{ $menuItem->id}}" class="action-button delete-button" title="Delete" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt" ></i></a>
                       @endcan


                    </td>

                   @endif

                  </tr>
                @empty
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Cropper Popup -->
<div class="modal fade" id="cropper-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">
              <svg width="40" height="35" viewBox="0 0 512 470" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_0_1)">
                <path d="M511.79 41.6V301.5C508.66 323.5 495.31 336.01 474.67 341.87C471.945 342.618 469.124 342.955 466.3 342.87C455.087 342.91 443.877 342.94 432.67 342.96H430.99C332.7 343.17 234.42 342.88 136.14 343.18C112.45 343.26 96.78 331.7 86.39 311.79C82.56 304.45 83.61 295.79 83.5 287.72C83.15 262.09 83.34 236.44 83.38 210.8C83.44 169.92 83.21 129.05 83.48 88.17V87.02C83.48 86.66 83.48 86.3 83.48 85.94C83.8 70.94 82.48 55.94 84.4 41.06C87.16 20.14 106.07 -0.0499823 131.14 0.0600177C243 0.300018 354.86 0.140013 466.71 0.180013C477.698 0.166221 488.307 4.19563 496.516 11.5004C504.724 18.8052 509.958 28.8747 511.22 39.79C511.22 40.11 511.3 40.43 511.33 40.79C511.43 41.0868 511.587 41.3618 511.79 41.6Z" fill="black"></path>
                <path d="M511.79 301.47C508.66 323.47 495.31 335.98 474.67 341.84C471.945 342.588 469.124 342.925 466.3 342.84C455.087 342.88 443.877 342.91 432.67 342.93C432.245 343.155 431.877 343.475 431.596 343.865C431.315 344.255 431.128 344.705 431.05 345.18C429.05 353.18 426.95 361.18 424.9 369.18C434.13 373.86 437.17 380.02 434.78 389.91C431.3 404.27 427.83 418.63 424.04 432.91C416.78 460.28 391.26 475 363.9 467.68C265.9 441.493 167.933 415.28 70 389.04C59.42 386.26 48.89 383.35 38.26 380.6C17.86 375.22 5.26 362.4 0.82 341.6C0.74 341.18 0.28 340.84 0 340.46C2.45 340.54 2.14 342.67 2.56 344.09C8 362.57 19.85 374.28 38.56 379.25C90.7133 393.09 142.823 407.03 194.89 421.07C250.84 436.07 306.89 450.87 362.74 466.14C389.74 473.52 414.31 460.46 422.4 433.66C427.01 418.36 430.4 402.72 433.9 387.12C435.17 381.4 432.79 376.71 428.47 372.95C427.03 371.69 425.11 370.95 424.2 369.09L424.12 368.93C424.115 368.867 424.115 368.803 424.12 368.74C424.49 360.24 427.7 352.42 430.12 344.42C430.27 343.862 430.567 343.355 430.98 342.95C431.98 342.01 433.45 341.95 434.98 341.95C444.28 342.01 453.58 341.95 462.89 341.95C464.53 341.95 466.21 342.26 467.81 341.61C489.49 339.2 505.46 325.19 510.69 304.02C510.94 303.12 510.6 301.98 511.79 301.47Z" fill="#FEFEFE"></path>
                <path d="M434.78 389.96C431.3 404.32 427.83 418.68 424.04 432.96C416.78 460.33 391.26 475.05 363.9 467.73C265.9 441.543 167.933 415.33 70 389.09C59.42 386.26 48.89 383.35 38.26 380.6C17.86 375.22 5.26 362.4 0.82 341.6C0.74 341.18 0.28 340.84 0 340.46V330.46C0.92 328.97 0.440001 327.36 0.470001 325.78C0.465012 325.693 0.465012 325.607 0.470001 325.52C0.470001 325.37 0.470001 325.22 0.470001 325.08C0.668369 320.089 1.48116 315.142 2.89 310.35C12.96 272.08 23.06 233.8 32.83 195.44C33.77 191.74 34.83 188.06 35.83 184.38C39.21 172.64 44.69 168.74 56.95 169.28L57.17 169.35L57.71 169.52C67.65 172.83 72.19 180.81 69.71 191.74C67.71 200.66 65.2 209.49 62.87 218.35C53.37 254.583 43.9067 290.83 34.48 327.09C33.1 332.38 33.2 337.22 36.39 341.87C38.81 345.41 42.26 347.06 46.24 348.13C72.6 355.237 98.9733 362.31 125.36 369.35C194.17 387.85 263.05 406.11 331.83 424.71C345.01 428.27 358.22 431.71 371.41 435.26C382.17 438.14 389.24 434.1 392.15 423.16C395.483 410.613 398.617 398.01 401.55 385.35C402.83 379.76 404.55 374.41 409.37 370.69C414.19 366.97 419.93 366.21 424.14 368.69C424.401 368.84 424.655 369.004 424.9 369.18C434.13 373.91 437.17 380.07 434.78 389.96Z" fill="black"></path>
                <path d="M511.23 39.73C510.59 37.56 509.96 35.39 509.23 33.26C506.069 23.7113 499.966 15.4084 491.796 9.54142C483.626 3.67439 473.808 0.544395 463.75 0.600026C353.71 0.526693 243.67 0.526693 133.63 0.600026C106.19 0.600026 85.58 21.6 85.21 49.6C85.05 61.6 85.05 73.6 84.98 85.54C84.46 86.4 83.98 87.27 83.48 88.14C72.89 107.14 70.48 128.86 63.98 149.22C62.42 154.13 61.13 159.13 59.9 164.15C59.5986 166.075 58.8596 167.905 57.74 169.5C57.4925 169.801 57.218 170.079 56.92 170.33C45.06 169.85 39.92 173.69 36.99 185.19C25.2833 230.283 13.56 275.37 1.82 320.45C1.41 322.04 1.21 323.69 0.91 325.32C0.79 325.63 0.640001 325.78 0.470001 325.78C0.300001 325.78 0.18 325.68 0 325.47C0.153519 325.526 0.318317 325.543 0.48 325.52C0.48 325.37 0.48 325.22 0.48 325.08C0.675114 320.09 1.48455 315.142 2.89 310.35C12.96 272.08 23.06 233.8 32.83 195.44C33.77 191.74 34.83 188.06 35.83 184.38C39.21 172.64 44.69 168.74 56.95 169.28L57.17 169.35C63.59 146.02 69.95 122.68 76.5 99.35C77.7665 94.705 80.1725 90.4497 83.5 86.97C83.5 86.61 83.5 86.25 83.5 85.89C83.82 70.89 82.5 55.89 84.42 41.01C87.18 20.09 106.09 -0.09997 131.16 0.01003C243.02 0.25003 354.88 0.0900251 466.73 0.130025C477.715 0.118408 488.32 4.14752 496.526 11.45C504.732 18.7525 509.966 28.8182 511.23 39.73V39.73Z" fill="#FEFEFE"></path>
                <path d="M0 330.46V325.46C0.153519 325.516 0.318317 325.533 0.48 325.51C0.637296 325.479 0.784777 325.41 0.91 325.31C1.19 327.14 1.56 328.97 0 330.46Z" fill="#353535"></path>
                <path d="M117.19 264.53V52.24C117.19 38.29 122.94 32.58 136.92 32.58H460.78C473.71 32.58 479.78 38.58 479.78 51.4V217.72C466.68 202.46 454.36 188.11 442.05 173.72C429.05 158.55 415.62 143.72 403.14 128.11C385.85 106.51 357.27 111.11 343.14 128.62C318.62 158.9 293.33 188.56 268.5 218.62C266.14 221.47 264.95 221.89 262.24 219.01C255.4 211.72 248.24 204.75 241.11 197.73C224.22 181.09 202.05 181.15 185.28 197.88C164.033 219.027 142.82 240.237 121.64 261.51C120.561 262.76 119.587 264.098 118.73 265.51L117.19 264.53Z" fill="#EBEEF0"></path>
                <path d="M467.83 341.6C464.36 343.32 460.65 342.38 457.06 342.46C449.92 342.62 442.77 342.56 435.62 342.46C434.599 342.373 433.573 342.524 432.62 342.9C432.195 343.125 431.827 343.445 431.546 343.835C431.265 344.225 431.078 344.675 431 345.15C429 353.15 426.9 361.15 424.85 369.15L424.16 369.01C413.82 367.01 406.35 371.66 403.78 381.93C400.38 395.47 397.027 409.023 393.72 422.59C390.59 435.32 383.17 439.76 370.38 436.33C277.76 411.53 185.143 386.71 92.53 361.87C76.9967 357.75 61.45 353.62 45.89 349.48C34.89 346.54 30.1 338.65 32.97 327.6C44.6433 282.56 56.3533 237.523 68.1 192.49C71.03 181.23 67.8 174.94 56.92 170.36C57.01 170.03 57.1 169.69 57.2 169.36C63.62 146.03 69.98 122.69 76.53 99.36C77.7964 94.715 80.2025 90.4596 83.53 86.98C84.01 86.48 84.53 85.98 85.03 85.53C85.13 87.35 85.31 89.17 85.31 90.99C85.31 155.29 85.31 219.59 85.31 283.89C85.31 291.04 85.42 298.22 85.99 305.34C86.65 313.47 92.35 319.18 97.16 324.93C107.03 336.75 120.16 341.7 135.56 341.67C209.013 341.563 282.457 341.54 355.89 341.6H467.83Z" fill="#D4D9DB"></path>
                <path d="M278.8 256.43C300.26 230.543 321.72 204.673 343.18 178.82C351.26 169.08 359.353 159.357 367.46 149.65C371.98 144.25 374.57 144.16 379.05 149.38C411.777 187.553 444.503 225.72 477.23 263.88C478.123 264.834 478.815 265.958 479.267 267.184C479.719 268.41 479.92 269.715 479.86 271.02C479.68 278.51 479.86 286.02 479.77 293.5C479.62 302.9 473.12 309.63 463.71 309.65C420.423 309.75 377.133 309.75 333.84 309.65C333.501 309.619 333.165 309.552 332.84 309.45C331.66 308.55 330.24 308.03 329.15 306.94C312.4 290.09 295.44 273.42 278.8 256.43Z" fill="#ECB415"></path>
                <path d="M278.8 256.43C279.46 256.498 280.1 256.699 280.681 257.02C281.262 257.342 281.772 257.777 282.18 258.3C298.8 274.967 315.427 291.61 332.06 308.23C332.37 308.614 332.638 309.029 332.86 309.47C331.54 309.55 330.22 309.7 328.86 309.71H135.68C132.52 309.71 129.41 309.63 126.41 308.24C123.25 306.78 122.55 305.62 125.47 302.76C139.84 288.67 154 274.34 168.24 260.1C181.42 246.92 194.607 233.747 207.8 220.58C212.61 215.78 213.88 215.8 218.8 220.68C230.22 232.093 241.63 243.513 253.03 254.94C261.89 263.81 269.3 264.24 278.8 256.43Z" fill="#FEC933"></path>
                <path d="M191.89 149.74C183.464 149.712 175.236 147.186 168.247 142.481C161.257 137.776 155.821 131.103 152.624 123.308C149.428 115.512 148.615 106.943 150.29 98.6855C151.965 90.428 156.051 82.8527 162.032 76.9181C168.013 70.9834 175.619 66.9561 183.89 65.3455C192.16 63.735 200.722 64.6137 208.493 67.8705C216.263 71.1272 222.894 76.6156 227.544 83.6414C232.195 90.6671 234.658 98.9145 234.62 107.34C234.536 118.616 229.996 129.402 221.991 137.345C213.987 145.287 203.167 149.743 191.89 149.74V149.74Z" fill="black"></path>
                <path d="M191.79 117.72C189.021 117.7 186.37 116.601 184.398 114.658C182.426 112.714 181.29 110.078 181.23 107.31C181.276 104.528 182.405 101.873 184.378 99.9097C186.351 97.9467 189.011 96.8303 191.793 96.7978C194.576 96.7652 197.262 97.8191 199.28 99.7354C201.298 101.652 202.489 104.279 202.6 107.06C202.604 108.474 202.326 109.874 201.783 111.179C201.239 112.484 200.441 113.668 199.434 114.66C198.427 115.653 197.233 116.435 195.92 116.96C194.608 117.486 193.204 117.744 191.79 117.72V117.72Z" fill="#FDC833"></path>
                </g>
                <defs>
                <clipPath id="clip0_0_1">
                <rect width="511.79" height="469.6" fill="white"></rect>
                </clipPath>
                </defs>
              </svg>
              Crop the image</h5>
              <button type="button" class="close" data-dismiss="modal">×</button>
         </div>
         <div class="modal-body">
            <div class="img-container">
               <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
            </div>
            <div class="row" id="actions">
               <div class=" col-12 docs-buttons">
                  <div class="btn-group">
                     <a class="btn btn-primary btn-sm" title="Upload New Image" onclick="document.getElementById('input').click();"><i class="fa fa-upload"></i></a>
                     <button type="button" id="reset" class="btn btn-primary btn-sm action_button" title="Reset">
                     <i class="fas fa-sync-alt"></i>
                     </button>
                     <button type="button" id="zoomOut" class="btn btn-primary btn-sm action_button" title="Zoom Out">
                     <i class="fa fa-search-minus"></i>
                     </button>
                     <button type="button" id="zoomIn" class="btn btn-primary btn-sm action_button" title="Zoom In">
                     <i class="fa fa-search-plus"></i>
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="crop" style="background-color:#009641;border-color:#009641;color:white;"><i class="fas fa-upload mr-2" style="color: white;"></i>Upload</button>
         </div>
      </div>
   </div>
</div>
<!-- end cropper  modal -->


@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css">

 <style type="text/css">
  .ui-sortable-helper {
        display: table;
    }
</style>
@stop

@section('js')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.2.0/tata.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


 
 
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>


<script type="text/javascript">
  
  $(document).ready(function(){
     var session_cat_id = "9";
      var search_btn = $('.apply-filter');
     //console.log(search_btn.trigger('click'));
    // alert();
     
     setTimeout(function(){
        var search_btn = $('.apply-filter');
      search_btn.trigger('click');
     
     },80); 

  });

</script>

<script>



   $(document).ready(function () {
      var table=$('#menuitem-list').DataTable({
           "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
           "order": [[ 0, "asc" ],[ 6, "asc" ]]
      });

      $("#menuitemlist-items").sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function(evt, ui) {
                var order = [];
                var pageno=table.page();
                var pagecount=table.page.len();
                
                 $('tr.row1').each(function(index,element) {
                      order.push({
                          id: $(this).attr('data-id'),
                          position:(index+1)+(pageno*pagecount)
                      });
                    });
                 
                var token = $('meta[name="csrf-token"]').attr('content');
         
                  $.ajax({
                    type: "post", 
                    dataType: "json", 
                    url: "{{ route('menuitem.change.order') }}",
                    data: {
                      'position':order,
                      _token: token
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            $('#menuitemlist-items').html('');
                            $('#menuitem-list').DataTable().clear().destroy();
                            $('#menuitemlist-items').html(response.table);
                            table=$('#menuitem-list').DataTable({
 "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
    "order": [[ 0, "asc" ],[ 6, "asc" ]],
                              "pageLength": -1});
                        }else {
                          console.log(response);
                        }
                    }  
               });
           }
       });
    });
 
      $(document).on('change','.changestatus',function(){
        
           var id = $(this).attr('data-id');
           var hours=$(this).find(':selected').data('hours');
           var status=$(this).find(':selected').val();

            $.ajax({
              url:"{{route('changeitems.status')}}",
              method:"POST",
              data:{
                  'status':status,
                  'id':id,
                  'hours':hours
                },
              dataType:"JSON",
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
              success:function(response){
              }
            });
       
          });
     
    $(document).on('click','.delete-button',function(e){  
      var id = $(this).attr('data-id');
 
      var obj = $(this);

        swal({
          title: "Are you sure?",
          text: "Are you sure you want to move this Menu Item to the Recycle Bin?",
          type: "warning",
          showCancelButton: true,
        }, function(willDelete) {
          if (willDelete) {
            $.ajax({
              type: 'post',
              url: "{{route('menu.item.delete')}}",
              data: {
                id: id
              },
              dataType: "JSON",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) {
                console.log("Response", response);
                if(response.success == 1) {
                     $( "#flash-message" ).css("display","block");
                     $( "#flash-message" ).removeClass("d-none");
                     $( "#flash-message" ).addClass("alert-danger");
                     $('#flash-message').html('Menu Item Deleted Successfully');
                     obj.parent().parent().remove();
                     setTimeout(() => {
                     $( "#flash-message" ).addClass("d-none");
                     }, 5000);
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
      });
</script>
<script type="text/javascript">
      $(".catselect").select2();
      $('.catselect_items').select2();
</script>
<script type="text/javascript">
  
  $(document).ready(function(){
     $('.apply-filter').on('click',function(){

       $value = $('.advance_category_search').val();
         var item_type = $('.item_type_search').val(); 
        if($value=='all_category')
        {
        //  return false;
            // Ajzx for Item Type.........
         var item_type = $('.item_type_search').val();
          $.ajax({
           url: "{{ route('filter_most_selling_regular_item') }}",
           method: 'post',
           data: {
                type:item_type,
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {               
            if(response.status) {
             $("#menuitem-list").DataTable().clear().destroy();
             $('#menuitemlist-items').html(response.html);
             $('#menuitem-list').DataTable({
           "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
           "order": [[ 0, "asc" ],[ 6, "asc" ]]
      });    
              }
           }
       });

        }else{
         
           $.ajax({
           url: "{{ route('filter_menu_categories') }}",
           method: 'post',
           data: {
                category_id: $value,
                item_type:item_type,
                from:'menu_item'
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {               
            if(response.status) {
             $("#menuitem-list").DataTable().clear().destroy();
             $('#menuitemlist-items').html(response.html);
             $('#menuitem-list').DataTable({
           "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
           "order": [[ 0, "asc" ],[ 6, "asc" ]]
      });    
              }
           }
       });
        }

     });
  });



   $('body').on('click','.reset-button',function(){
      
        $(".catselect").val('all_category').trigger('change');
        $(".catselect_items").val('all_type_item').trigger('change'); 
        $(".menu advance_category_search[value='0']").attr("selected", true);
        $('.advance_options_btn').hide();
        $.ajax({
           url: "{{ route('reset_menu_categories') }}",
           method: 'post',
           data: {
               reset: true,
               from:'menu_item'
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {
               console.log('response');
               console.log(response);
               if(response.status) {
                 $('#menuitem-list').DataTable().clear().destroy();
                  $('#menuitemlist-items').html(response.html);
              $('#menuitem-list').DataTable({
           "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
           "order": [[ 0, "asc" ],[ 6, "asc" ]]
      });

               }
           }
        });
   
     })
</script>



<!-- <script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover({
     html: true,
  trigger: 'hover',
  content: function () {
    return '<img src="'+$(this).data('img') + '" />';
  }
  });   
});
</script> -->
 


<script>
  function popover(){
    $('[data-toggle="popover"]').popover({
        placement : 'auto',
    trigger : 'hover',
        html : true,
         content: function () {
          var current_obj = this;
          var current_id = $(current_obj).attr('data-id');
          var data_img = $(current_obj).attr('data-img'); 
          var origin_url = $(current_obj).attr('origin_url');
          console.log(current_id);


                           $.ajax({
      url:"{{route('current.menu.item.image')}}",
      method:"POST",
      data:{
          current_id:current_id,
        },
       
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
      success:function(response){
              //var origin = window.location.origin;
              var full_url = origin_url+'menuItem/thumbnail/'+response;  
              console.log(full_url);
              $(current_obj).attr('data-img',full_url);
             // console.log(current_obj);
      }
    });


          // var current_id = this.attr('data-id');   
      //return data_img;

        return '<img alt="loding..." src="'+data_img+'" width="400" height="300"/>';

  }
    });

}

 
 setInterval(function () { popover(); }, 100);


</script>



<!-- 
<script type="text/javascript">
  
   $(document).ready(function(){
       $('.item_type_search').on('change',function(){
          
          var item_type = $(this).val();
          $.ajax({
           url: "{{ route('filter_most_selling_regular_item') }}",
           method: 'post',
           data: {
                type:item_type,
           },
           dataType: "JSON",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (response) {               
            if(response.status) {
             $("#menuitem-list").DataTable().clear().destroy();
             $('#menuitemlist-items').html(response.html);
             $('#menuitem-list').DataTable({
           "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
           "order": [[ 0, "asc" ],[ 6, "asc" ]]
      });    
              }
           }
       });
        

       });
   }); 

</script> -->






<script type="text/javascript">
 
 window.addEventListener('DOMContentLoaded', function() {
 
       var getTR1;
       var getTR2;     
       var menuItemId = '';
       var getCurrentPopImg1 = '';
       var getCurrentPopImg2 = '';
       var avatar = document.getElementById('thumbnail_preview');
       var image = document.getElementById('image');
       var input = document.getElementById('input');
       var $progress = $('.progress');
       var $progressBar = $('.progress-bar');
       var $alert = $('.alert');
       var $modal = $('#cropper-modal');
       var cropper;
       var options = {
            dragMode: 'move',
            autoCropArea: 0.65,
           // restore: false,
            guides: false,
            center: false,
            highlight: false,
            cropBoxMovable: true,
            cropBoxResizable: false,
            toggleDragModeOnDblclick: false,
            data:{ //define cropbox size
              width: 400,
              height:  300,
            },
       }
   
       var this_obj;
   
       $('[data-toggle="tooltip"]').tooltip();
   
       // alert(input);
       // $('.upload_image').click(function(){
       //     input.click();    
       // })

        $('body').on('click','.upload-item-images-button',function(){

            input.click(); 
            menuItemId = $(this).attr('data-id');
            
            var current_obj = this;
            var getParent = current_obj.parentElement.parentElement;
                getTR1  = getParent.getElementsByTagName('TD')[1];
                getTR2  = getParent.getElementsByTagName('TD')[2];
           

        });
       
       input.addEventListener('change', function(e) {
           
           var files = e.target.files;
   
           this_obj = $(this);
   
           $('.file-size-error').hide();
   
           var done = function(url) {
               input.value = '';
   
               $('.profile_image').val('');
   
               image.src = url;
               $alert.hide();
   
               $modal.addClass('show');
               $modal.modal('show');
           };
   
           var reader;
           var file;
           var url;
   
           if (files && files.length > 0) {
               file = files[0];
               console.log(file);
               // return false;


               if (file.size > 5000000) {
                   swal("Error!","Please select a image below 5 MB!","error");
                   return false;    
               }
   
               if (file.type == 'image/png' || file.type == 'image/jpeg' || file.type == 'image/svg+xml') {
   
                      
               }else{
                   $('.file-size-error').text('Only jpg, svg and png files are allowed.').show();
                   return false;
               }
               
               
               
               console.log(file);
               if (URL) {
                   done(URL.createObjectURL(file));
                   // added later today
                   cropper.destroy();
                   cropper = new Cropper(image, options);
                   inputImage.value = null;
                   // added later today
               } else if (FileReader) {
                   reader = new FileReader();
                   reader.onload = function(e) {
                       done(reader.result);
                   };
                   reader.readAsDataURL(file);
               }
           }
       });
   
       $modal.on('shown.bs.modal', function() {
           cropper = new Cropper(image,options);
           $("#zoomIn").click(function() {
             cropper.zoom(0.1);
           });
           $("#zoomOut").click(function() {
             cropper.zoom(-0.1);
           });
           $("#reset").click(function() {
             cropper.reset();
           });
       }).on('hidden.bs.modal', function() {
           cropper.destroy();
           cropper = null;
       });
     
    
   
       document.getElementById('crop').addEventListener('click', function() {
           var initialAvatarURL;
           var canvas;
   
           $modal.modal('hide');
   
   
           if (cropper) {
               canvas = cropper.getCroppedCanvas({
                   width: 400,
                   height: 300,
               });
           //    initialAvatarURL = avatar.src;
            //   avatar.src = canvas.toDataURL();
                
                //get img

                getTR1.children[0].src = canvas.toDataURL(); 
                  $(getTR1).attr('data-img',canvas.toDataURL());
              // $(getTR1).next().attr('src',canvas.toDataURL());
               console.log('res-----------'+canvas.toDataURL());
              // console.log(avatar.src);
   
          //     $('.profile_image').val(avatar.src);
          //     $('#thumbnail_preview').css('display', 'block');
         //      //$('#thumbnail_preview').attr('src', e.target.result);
        //       $('.upload-img').removeClass('d-none');

           //    console.log($('.profile_image').val());
               console.log(menuItemId);
            
            //Upload Menu Item Image

                 $.ajax({
      url:"{{route('change.menu.item.image')}}",
      method:"POST",
      data:{
          image_url:canvas.toDataURL(),
          menuItemId:menuItemId,
        },
      dataType:"JSON",
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
      success:function(response){
        
        if(response.success)
            {
                //  toastr.success('image Updated Successfully');
                  

                           swal({
                       title: "Menu  Item",
                     text:"Menu Item Image Updated Successfully",
                     type: "success",
                     },
                   function(){ 
                      //  window.location.reload(); 
                   }
                )

            }else{
                  toastr.error('Something Went To Wrong');
            }
      

      }
    });

   
               $progress.show();
               $alert.removeClass('alert-success alert-warning');
               
           }
       });
   });




</script>





@stop
