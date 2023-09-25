@extends('adminlte::page')
@section('title', 'Super Admin | Branch Permissions')
@section('content_header')
@stop
@section('content')
<div class="container">
<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header alert d-flex justify-content-between align-items-center">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Branch Permissions</h3>
         </div>
         <div class="card-body pb-3">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
               {{ session('status') }}
            </div>
            @endif
            <form id="addRoleForm" method="post", action="">
               @csrf
               <div class="card-body">
                  <div class="role-name">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <label for="role_name">Branches</label>
                              <input type="hidden" name="role_id" id="role_id">
                              <select name="role_name" class="form-control" id="role_name">
                                 <option value="" hidden>Select Branch</option>
                                 <option value="">Mohali</option>
                                 <option value="">Chandigarh</option>
                                 <option value="">Shimla</option>
                              </select>
                              @if($errors->has('role_name'))
                              <div class="error">{{ $errors->first('role_name') }}</div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="role-permissions" id="role-permissions">
                     <label for="permissions[]" class="label">{{ __('adminlte::adminlte.permissions') }}</label>
                     <label id="permissions[]-error" class="error" for="permissions[]" style="font-weight: 400 !important;"></label>
                     <br>
                     @if($errors->has('permissions'))
                     <div class="error">{{ $errors->first('permissions') }}</div>
                     @endif
                     <div class="custom_check_wrap">
                        <div class="custom-check">
                           <input type="checkbox" id="full_access" class="">
                           <span></span>       
                        </div>
                        <strong>FULL ACCESS</strong>                     
                     </div>
                     <div class="title">
                        <h5>Dashboard</h5>
                        <hr/>
                     </div>
                     <div class="permissions-section">
                        <!-- dashboard -->
                        <div class="row ">
                           <!-- total customers -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Total Customers</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- total customers -->
                           <!-- order placed -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Total Orders Placed</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- order placed -->
                           <!-- total employees -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Total Employees</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- total employees -->
                           <!-- new notifications -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Notifications for Catering</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Notifications for Orders</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Notifications for Dine-in</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- new notifications -->
                        </div>
                     </div>
                     <!-- customer management -->
                     <div class="title">
                        <h5>Customer Management</h5>
                        <hr/>
                     </div>
                     <div class="permissions-section">
                        <div class="row ">
                           <!-- customers -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Customers</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- customers -->
                        </div>
                     </div>
                     <!-- customer management -->
                     <!-- staff management -->
                     <div class="title">
                        <h5>Staff Management</h5>
                        <hr/>
                     </div>
                     <div class="permissions-section">
                        <div class="row ">
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Staff</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Add</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Edit</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Delete</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- staff management -->
                     <!-- menu categories/sub categories management -->
                     <div class="title">
                        <h5>Menu Categories & Sub-Categories Management</h5>
                        <hr/>
                     </div>
                     <div class="permissions-section">
                        <div class="row ">
                           <!-- categories -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Menu Categories</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Add</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Edit</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Delete</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- categories -->
                           <!-- sub categories -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Menu Sub-Categories</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Add</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Edit</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Delete</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- sub categories -->
                        </div>
                     </div>
                     <!-- menu categories/sub categories management -->
                     <!-- menu items management -->
                     <div class="title">
                        <h5>Menu Items Management</h5>
                        <hr/>
                     </div>
                     <div class="permissions-section">
                        <div class="row ">
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Menu Items</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Add</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Edit</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Delete</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Assign to Categories</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Assign to Sub-categories</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Assign to Branch</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- menu items management -->
                     <!-- online orders management -->
                     <div class="title">
                        <h5>Online Orders Management</h5>
                        <hr/>
                     </div>
                     <div class="permissions-section">
                        <div class="row ">
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Online Orders</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">Change Order Status</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- online orders management -->
                     <!-- Dine & catering inquiries management -->
                     <div class="title">
                        <h5>Dine & Catering Inquiries Management</h5>
                        <hr/>
                     </div>
                     <div class="permissions-section">
                        <div class="row ">
                           <!-- Dine inquiries -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Dine Inquiries</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Dine inquiries -->
                           <!-- catering inquiries -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Catering Inquiries</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- catering inquiries -->
                        </div>
                     </div>
                     <!-- Dine & catering inquiries management -->
                     <!-- payment history -->
                     <div class="title">
                        <h5>Payment History</h5>
                        <hr/>
                     </div>
                     <div class="permissions-section">
                        <div class="row ">
                           <!-- payouts -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Total Payouts</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- payouts -->
                           <!-- customers reports/earnings -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Total Customer Reports</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Total Earning Reports</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- customers reports/earnings -->
                        </div>
                     </div>
                     <!-- payment history -->
                     <!-- Reports/Analytics -->
                     <div class="title">
                        <h5>Reports & Analytics</h5>
                        <hr/>
                     </div>
                     <div class="permissions-section">
                        <div class="row ">
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Business Growth Graph</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- repeated customers percentage -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Repeated customer percentage</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- repeated customers percentage -->
                           <!-- total number of customers -->
                           <div class="col-4">
                              <div class="form-group">
                                 <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Total Number of Customers</strong></p>
                                    <div class="custom_check_wrap">
                                       <div class="custom-check">
                                          <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                          <span></span>                             
                                       </div>
                                       <strong class="list-text">Select All</strong>
                                    </div>
                                    <div id="checkBoxes">
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="" id="button_">
                                             <span></span>                                
                                          </div>
                                          <label class="mb-0">View</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- total number of customers -->
                        </div>
                     </div>
                     <!-- Reports/Analytics -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer" style="border-top: 1px solid rgba(0,0,0,.125);">
                     <button type="submit" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
                  </div>
            </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
   strong.list-text {
   position: relative;
   left: -8px;
   top: -3px;
   }
   span.list-text {
   position: relative;
   left: -8px;
   top: -3px;
   }
   /* .role-permissions { display:none; } */
</style>
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
   $(document).ready(function() {
     checkAll();
     $("input[type='checkbox']").change(function() {
       checkAll();
     });
     $("#role_name").change(function() {
       $('input').filter(':checkbox').prop('checked',false);
       var role = $(this);
       $("#role_id").val(role.val());
       $(".checkBoxClass").removeAttr('checked');
       var id = $("#role_name").val();
       $.ajax({
         url: "",
         type: 'post',
         data: {
           role_id: id
         },
         dataType: "JSON",
         headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(res) {
           for (let i = 0; i < res.length; i++) {
             const response = res[i];
             var permissionId = "#button_"+response.permission_id;
             $(permissionId).prop('checked', 'true');
             checkAll();
           }
         }
       });
     });
     
     $('#addRoleForm').validate({
       ignore: [],
       debug: false,
       rules: {
         role_name: {
           required: true
         },
         "permissions[]":{
           required: true
         }
       },
       messages: {
         role_name: {
           required: "The Role Name field is required."
         },
         "permissions[]": {
           required: "You must select at least one permission.",
         }
       }
     });
   });
   
   function checkAll() {
     $("#full_access").click(function() {
       $("input[type=checkbox]").prop('checked', this.checked)
     })
     $("#pending_customer_permissions").click(function() {
       $(".pendingCustomerscheckBox").prop('checked', this.checked)
     })
     $("#whitelisted_customer_permissions").click(function() {
       $(".whitelistedCustomerscheckBox").prop('checked', this.checked)
     })
     $("#rejected_customer_permissions").click(function() {
       $(".rejectedCustomerscheckBox").prop('checked', this.checked)
     })
     $("#recruiter_permissions").click(function() {
       $(".recruiterscheckBox").prop('checked', this.checked)
     })
     $("#jobseeker_permissions").click(function() {
       $(".jobseekerscheckBox").prop('checked', this.checked)
     })
     $("#guest_permissions").click(function() {
       $(".guestscheckBox").prop('checked', this.checked)
     })
     $("#admins_permissions").click(function() {
       $(".adminscheckBox").prop('checked', this.checked)
     })
     $("#jobs_permissions").click(function() {
       $(".jobscheckBox").prop('checked', this.checked)
     })
     $("#suspended_jobs_permissions").click(function() {
       $(".suspendedJobscheckBox").prop('checked', this.checked)
     })
     $("#job_history_permissions").click(function() {
       $(".jobHistorycheckBox").prop('checked', this.checked)
     })
     $("#job_bookmarks_permissions").click(function() {
       $(".jobBookmarkscheckBox").prop('checked', this.checked)
     })
     $("#job_applications_permissions").click(function() {
       $(".jobApplicationscheckBox").prop('checked', this.checked)
     })
     $("#job_search_history_permissions").click(function() {
       $(".jobSearchHistorycheckBox").prop('checked', this.checked)
     })
     $("#reported_jobs_permissions").click(function() {
       $(".reportedJobscheckBox").prop('checked', this.checked)
     })
     $("#viewed_jobs_permissions").click(function() {
       $(".viewedJobscheckBox").prop('checked', this.checked)
     })
     /* $("#credits_permissions").click(function() {
       $(".companyCreditscheckBox").prop('checked', this.checked)
     })
     $("#credits_history_permissions").click(function() {
       $(".companyCreditsHistorycheckBox").prop('checked', this.checked)
     }) */
     $("#payments_permissions").click(function() {
       $(".paymentTransactionscheckBox").prop('checked', this.checked)
     })
     $("#payments_permissions-1").click(function() {
       $(".paymentTransactionscheckBox-1").prop('checked', this.checked)
     })
   
     $("#payments_permissions-2").click(function() {
       $(".paymentTransactionscheckBox-2").prop('checked', this.checked)
     })
   
     $("#payments_permissions-3").click(function() {
       $(".paymentTransactionscheckBox-3").prop('checked', this.checked)
     })
     $("#tickets_permissions").click(function() {
       $(".ticketscheckBox").prop('checked', this.checked)
     })
     $("#feedbacks_permissions").click(function() {
       $(".feedbackscheckBox").prop('checked', this.checked)
     })
     $("#contact_us_permissions").click(function() {
       $(".contactUscheckBox").prop('checked', this.checked)
     })
     $("#job_industries_permissions").click(function() {
       $(".jobIndustriescheckBox").prop('checked', this.checked)
     })
     $("#job_qualifications_permissions").click(function() {
       $(".jobQualificationscheckBox").prop('checked', this.checked)
     })
     $("#job_locations_permissions").click(function() {
       $(".jobLocationscheckBox").prop('checked', this.checked)
     })
     $("#skills_permissions").click(function() {
       $(".skillscheckBox").prop('checked', this.checked)
     })
     $("#cities_permissions").click(function() {
       $(".citiescheckBox").prop('checked', this.checked)
     })
     $("#counties_permissions").click(function() {
       $(".countiescheckBox").prop('checked', this.checked)
     })
     $("#roles_permissions").click(function() {
       $(".rolescheckBox").prop('checked', this.checked)
     })
     $("#access_permissions").click(function() {
       $(".accesscheckBox").prop('checked', this.checked)
     })
     $("#restore_permissions").click(function() {
       $(".restorecheckBox").prop('checked', this.checked)
     })
     $("#website_permissions").click(function() {
       $(".websitecheckBox").prop('checked', this.checked)
     })
     $("#mobile_permissions").click(function() {
       $(".mobilecheckBox").prop('checked', this.checked)
     })
   
      $("#recyclebin_user_permissions").click(function() {
       $(".recyclebin_user_permissions").prop('checked', this.checked)
     })
      $("#recyclebin_admin_permissions").click(function() {
       $(".recyclebin_admin_permissions").prop('checked', this.checked)
     })
   
   
     if($('.checkBoxClass:checked').length == $('.checkBoxClass').length) {
       $("#full_access").prop('checked', 'true');
     }
     else {
       $("#full_access").prop('checked', false);
     }
   
     if($('.pendingCustomerscheckBox:checked').length == $('.pendingCustomerscheckBox').length) {
       $("#pending_customer_permissions").prop('checked', 'true');
     }
     else {
       $("#pending_customer_permissions").prop('checked', false);
     }
     if($('.whitelistedCustomerscheckBox:checked').length == $('.whitelistedCustomerscheckBox').length) {
       $("#whitelisted_customer_permissions").prop('checked', 'true');
     }
     else {
       $("#whitelisted_customer_permissions").prop('checked', false);
     }
     if($('.rejectedCustomerscheckBox:checked').length == $('.rejectedCustomerscheckBox').length) {
       $("#rejected_customer_permissions").prop('checked', 'true');
     }
     else {
       $("#rejected_customer_permissions").prop('checked', false);
     }
     if($('.recruiterscheckBox:checked').length == $('.recruiterscheckBox').length) {
       $("#recruiter_permissions").prop('checked', 'true');
     }
     else {
       $("#recruiter_permissions").prop('checked', false);
     }
     if($('.jobseekerscheckBox:checked').length == $('.jobseekerscheckBox').length) {
       $("#jobseeker_permissions").prop('checked', 'true');
     }
     else {
       $("#jobseeker_permissions").prop('checked', false);
     }
     if($('.guestscheckBox:checked').length == $('.guestscheckBox').length) {
       $("#guest_permissions").prop('checked', 'true');
     }
     else {
       $("#guest_permissions").prop('checked', false);
     }
     if($('.adminscheckBox:checked').length == $('.adminscheckBox').length) {
       $("#admins_permissions").prop('checked', 'true');
     }
     else {
       $("#admins_permissions").prop('checked', false);
     }
     if($('.jobscheckBox:checked').length == $('.jobscheckBox').length) {
       $("#jobs_permissions").prop('checked', 'true');
     }
     else {
       $("#jobs_permissions").prop('checked', false);
     }
     if($('.suspendedJobscheckBox:checked').length == $('.suspendedJobscheckBox').length) {
       $("#suspended_jobs_permissions").prop('checked', 'true');
     }
     else {
       $("#suspended_jobs_permissions").prop('checked', false);
     }
     if($('.jobHistorycheckBox:checked').length == $('.jobHistorycheckBox').length) {
       $("#job_history_permissions").prop('checked', 'true');
     }
     else {
       $("#job_history_permissions").prop('checked', false);
     }
     if($('.jobBookmarkscheckBox:checked').length == $('.jobBookmarkscheckBox').length) {
       $("#job_bookmarks_permissions").prop('checked', 'true');
     }
     else {
       $("#job_bookmarks_permissions").prop('checked', false);
     }
     if($('.jobApplicationscheckBox:checked').length == $('.jobApplicationscheckBox').length) {
       $("#job_applications_permissions").prop('checked', 'true');
     }
     else {
       $("#job_applications_permissions").prop('checked', false);
     }
     if($('.jobSearchHistorycheckBox:checked').length == $('.jobSearchHistorycheckBox').length) {
       $("#job_search_history_permissions").prop('checked', 'true');
     }
     else {
       $("#job_search_history_permissions").prop('checked', false);
     }
     if($('.reportedJobscheckBox:checked').length == $('.reportedJobscheckBox').length) {
       $("#reported_jobs_permissions").prop('checked', 'true');
     }
     else {
       $("#reported_jobs_permissions").prop('checked', false);
     }
     if($('.viewedJobscheckBox:checked').length == $('.viewedJobscheckBox').length) {
       $("#viewed_jobs_permissions").prop('checked', 'true');
     }
     else {
       $("#viewed_jobs_permissions").prop('checked', false);
     }
   
     if($('.recyclebin_user_permissions:checked').length == $('.recyclebin_user_permissions').length) {
       $("#recyclebin_user_permissions").prop('checked', 'true');
     }
     else {
       $("#recyclebin_user_permissions").prop('checked', false);
     }
   
     if($('.recyclebin_admin_permissions:checked').length == $('.recyclebin_admin_permissions').length) {
       $("#recyclebin_admin_permissions").prop('checked', 'true');
     }
     else {
       $("#recyclebin_admin_permissions").prop('checked', false);
     }
   
     
     /* if($('.companyCreditscheckBox:checked').length == $('.companyCreditscheckBox').length) {
       $("#credits_permissions").prop('checked', 'true');
     }
     else {
       $("#credits_permissions").prop('checked', false);
     }
     if($('.companyCreditsHistorycheckBox:checked').length == $('.companyCreditsHistorycheckBox').length) {
       $("#credits_history_permissions").prop('checked', 'true');
     }
     else {
       $("#credits_history_permissions").prop('checked', false);
     } */
     if($('.paymentTransactionscheckBox:checked').length == $('.paymentTransactionscheckBox').length) {
       $("#payments_permissions").prop('checked', 'true');
     }
     else {
       $("#payments_permissions").prop('checked', false);
     }
   
     if($('.paymentTransactionscheckBox-1:checked').length == $('.paymentTransactionscheckBox-1').length) {
       $("#payments_permissions-1").prop('checked', 'true');
     }
     else {
       $("#payments_permissions-1").prop('checked', false);
     }
   
     if($('.paymentTransactionscheckBox-2:checked').length == $('.paymentTransactionscheckBox-2').length) {
       $("#payments_permissions-2").prop('checked', 'true');
     }
     else {
       $("#payments_permissions-2").prop('checked', false);
     }
   
     if($('.paymentTransactionscheckBox-3:checked').length == $('.paymentTransactionscheckBox-3').length) {
       $("#payments_permissions-3").prop('checked', 'true');
     }
     else {
       $("#payments_permissions-3").prop('checked', false);
     }
     if($('.ticketscheckBox:checked').length == $('.ticketscheckBox').length) {
       $("#tickets_permissions").prop('checked', 'true');
     }
     else {
       $("#tickets_permissions").prop('checked', false);
     }
     if($('.feedbackscheckBox:checked').length == $('.feedbackscheckBox').length) {
       $("#feedbacks_permissions").prop('checked', 'true');
     }
     else {
       $("#feedbacks_permissions").prop('checked', false);
     }
     if($('.contactUscheckBox:checked').length == $('.contactUscheckBox').length) {
       $("#contact_us_permissions").prop('checked', 'true');
     }
     else {
       $("#contact_us_permissions").prop('checked', false);
     }
     if($('.jobIndustriescheckBox:checked').length == $('.jobIndustriescheckBox').length) {
       $("#job_industries_permissions").prop('checked', 'true');
     }
     else {
       $("#job_industries_permissions").prop('checked', false);
     }
     if($('.jobQualificationscheckBox:checked').length == $('.jobQualificationscheckBox').length) {
       $("#job_qualifications_permissions").prop('checked', 'true');
     }
     else {
       $("#job_qualifications_permissions").prop('checked', false);
     }
     if($('.jobLocationscheckBox:checked').length == $('.jobLocationscheckBox').length) {
       $("#job_locations_permissions").prop('checked', 'true');
     }
     else {
       $("#job_locations_permissions").prop('checked', false);
     }
     if($('.skillscheckBox:checked').length == $('.skillscheckBox').length) {
       $("#skills_permissions").prop('checked', 'true');
     }
     else {
       $("#skills_permissions").prop('checked', false);
     }
     if($('.citiescheckBox:checked').length == $('.citiescheckBox').length) {
       $("#cities_permissions").prop('checked', 'true');
     }
     else {
       $("#cities_permissions").prop('checked', false);
     }
     if($('.countiescheckBox:checked').length == $('.countiescheckBox').length) {
       $("#counties_permissions").prop('checked', 'true');
     }
     else {
       $("#counties_permissions").prop('checked', false);
     }
     if($('.rolescheckBox:checked').length == $('.rolescheckBox').length) {
       $("#roles_permissions").prop('checked', 'true');
     }
     else {
       $("#roles_permissions").prop('checked', false);
     }
     if($('.accesscheckBox:checked').length == $('.accesscheckBox').length) {
       $("#access_permissions").prop('checked', 'true');
     }
     else {
       $("#access_permissions").prop('checked', false);
     }
     if($('.restorecheckBox:checked').length == $('.restorecheckBox').length) {
       $("#restore_permissions").prop('checked', 'true');
     }
     else {
       $("#restore_permissions").prop('checked', false);
     }
     if($('.websitecheckBox:checked').length == $('.websitecheckBox').length) {
       $("#website_permissions").prop('checked', 'true');
     }
     else {
       $("#website_permissions").prop('checked', false);
     }
     if($('.mobilecheckBox:checked').length == $('.mobilecheckBox').length) {
       $("#mobile_permissions").prop('checked', 'true');
     }
     else {
       $("#mobile_permissions").prop('checked', false);
     }
   }
</script>
@stop