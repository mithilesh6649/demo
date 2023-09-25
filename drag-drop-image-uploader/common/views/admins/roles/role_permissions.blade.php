  @extends('adminlte::page')

  @section('title', 'Role Permissions')

  @section('content_header')


  @section('content')
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-main">
                          <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                              <a class="btn btn-sm btn-success"
                                  href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                              <h3>{{ __('adminlte::adminlte.role_permissions') }}</h3>
                          </div>
                          <div class="card-body table p-0 mb-0">
                              @if (session('status'))
                                  <div class="alert alert-success" role="alert">
                                      {{ session('status') }}
                                  </div>
                              @endif
                              <form id="addRoleForm" method="post", action="{{ route('admins.role.savePermissions') }}">
                                  @csrf
                                  <div class="card-body">
                                      <div class="role-name">
                                          <div class="row">
                                              <div class="col-sm-12">
                                                  <div class="form-group">
                                                      <label
                                                          for="role_name">{{ __('adminlte::adminlte.role_name') }}</label>
                                                      <input type="hidden" name="role_id" id="role_id">
                                                      <select name="role_name" class="form-control" id="role_name"
                                                          @can('edit_permissions') @else disabled @endcan>
                                                          <option value="" hidden>Select Role</option>
                                                          @foreach ($roles as $role)
                                                              <option value="{{ $role->id }}">{{ $role->name }}
                                                              </option>
                                                          @endforeach
                                                      </select>
                                                      @if ($errors->has('role_name'))
                                                          <div class="error">{{ $errors->first('role_name') }}</div>
                                                      @endif
                                                  </div>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="role-permissions mt-3" id="role-permissions"
                                          @can('edit_permissions') @else style="pointer-events:none;" @endcan>
                                          <label for="permissions[]"
                                              class="label">{{ __('adminlte::adminlte.permissions') }}</label>
                                          <label id="permissions[]-error" class="error" for="permissions[]"
                                              style="font-weight: 400 !important;"></label>
                                          <br>
                                          @if ($errors->has('permissions'))
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
                                              <h5 class="mb-0 py-3">Users Management</h5>
                                          </div>

                                          <div class="row permissions-section">
                                              <div class="col-4">
                                                  <div class="form-group">
                                                      <div class="permissions-section-inner-sec">
                                                          <p class="headings"><strong class="list-text">Customers</strong>
                                                          </p>
                                                          <div class="custom_check_wrap">
                                                              <div class="custom-check">
                                                                  <input type="checkbox" id="appusers_permissions"
                                                                      class="ckbCheckAll">
                                                                  <span></span>
                                                              </div>
                                                              <strong class="list-text">Select All</strong>
                                                          </div>
                                                          <div id="checkBoxes">
                                                              @foreach ($appUsersPermissions as $permission)
                                                                  <div class="custom_check_wrap">
                                                                      <div class="custom-check">
                                                                          <input type="checkbox"
                                                                              class="checkBoxClass appUserscheckBox"
                                                                              name="permissions[]"
                                                                              value="{{ $permission->id }}"
                                                                              id="button_{{ $permission->id }}">
                                                                          <span></span>
                                                                      </div>
                                                                      <label class="mb-0">{{ $permission->name }}</label>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-4 mb-3">
                                                  <div class="form-group">
                                                      <div class="permissions-section-inner-sec">
                                                          <p class="headings"><strong class="list-text">Admins</strong></p>
                                                          <div class="custom_check_wrap">
                                                              <div class="custom-check">
                                                                  <input type="checkbox" id="admins_permissions"
                                                                      class="ckbCheckAll">
                                                                  <span></span>
                                                              </div>
                                                              <strong class="list-text">Select All</strong>
                                                          </div>
                                                          <div id="checkBoxes">
                                                              @foreach ($adminPermissions as $permission)
                                                                  <div class="custom_check_wrap">
                                                                      <div class="custom-check">
                                                                          <input type="checkbox"
                                                                              class="checkBoxClass adminscheckBox"
                                                                              name="permissions[]"
                                                                              value="{{ $permission->id }}"
                                                                              id="button_{{ $permission->id }}">
                                                                          <span></span>
                                                                      </div>
                                                                      <label class="mb-0">{{ $permission->name }}</label>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-4">
                                                  <div class="form-group">
                                                      <div class="permissions-section-inner-sec">
                                                          <p class="headings"><strong class="list-text"> Branch
                                                                  Managers</strong></p>
                                                          <div class="custom_check_wrap">
                                                              <div class="custom-check">
                                                                  <input type="checkbox" id="branch_manager_permissions"
                                                                      class="ckbCheckAll">
                                                                  <span></span>
                                                              </div>
                                                              <strong class="list-text">Select All</strong>
                                                          </div>
                                                          <div id="checkBoxes">
                                                              @foreach ($branchManagerPermissions as $permission)
                                                                  <div class="custom_check_wrap">
                                                                      <div class="custom-check">
                                                                          <input type="checkbox"
                                                                              class="checkBoxClass branchManagercheckBox"
                                                                              name="permissions[]"
                                                                              value="{{ $permission->id }}"
                                                                              id="button_{{ $permission->id }}">
                                                                          <span></span>
                                                                      </div>
                                                                      <label
                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>


                                              <div class="col-4">
                                                  <div class="form-group">
                                                      <div class="permissions-section-inner-sec">
                                                          <p class="headings"><strong class="list-text">Staff</strong></p>
                                                          <div class="custom_check_wrap">
                                                              <div class="custom-check">
                                                                  <input type="checkbox" id="branch_staff_permissions"
                                                                      class="ckbCheckAll">
                                                                  <span></span>
                                                              </div>
                                                              <strong class="list-text">Select All</strong>
                                                          </div>
                                                          <div id="checkBoxes">
                                                              @foreach ($branchStaffPermissions as $permission)
                                                                  <div class="custom_check_wrap">
                                                                      <div class="custom-check">
                                                                          <input type="checkbox"
                                                                              class="checkBoxClass branchStaffcheckBox"
                                                                              name="permissions[]"
                                                                              value="{{ $permission->id }}"
                                                                              id="button_{{ $permission->id }}">
                                                                          <span></span>
                                                                      </div>
                                                                      <label
                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>



                                              <div class="col-4">
                                                  <div class="form-group">
                                                      <div class="permissions-section-inner-sec">
                                                          <p class="headings"><strong
                                                                  class="list-text">Management</strong></p>
                                                          <div class="custom_check_wrap">
                                                              <div class="custom-check">
                                                                  <input type="checkbox" id="management_permissions"
                                                                      class="ckbCheckAll">
                                                                  <span></span>
                                                              </div>
                                                              <strong class="list-text">Select All</strong>
                                                          </div>
                                                          <div id="checkBoxes">
                                                              @foreach ($ManagementPermissions as $permission)
                                                                  <div class="custom_check_wrap">
                                                                      <div class="custom-check">
                                                                          <input type="checkbox"
                                                                              class="checkBoxClass ManagementcheckBox"
                                                                              name="permissions[]"
                                                                              value="{{ $permission->id }}"
                                                                              id="button_{{ $permission->id }}">
                                                                          <span></span>
                                                                      </div>
                                                                      <label
                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>



                                          </div>

                                          <div class="title">
                                              <h5 class="mb-0 py-3">Branch Management</h5>
                                          </div>

                                          <div class="row permissions-section">
                                              <div class="col-4">
                                                  <div class="form-group">
                                                      <div class="permissions-section-inner-sec">
                                                          <p class="headings"><strong class="list-text">Branches</strong>
                                                          </p>
                                                          <div class="custom_check_wrap">
                                                              <div class="custom-check">
                                                                  <input type="checkbox" id="branches_permissions"
                                                                      class="ckbCheckAll">
                                                                  <span></span>
                                                              </div>
                                                              <strong class="list-text">Select All</strong>
                                                          </div>
                                                          <div id="checkBoxes">
                                                              @foreach ($branchPermissions as $permission)
                                                                  <div class="custom_check_wrap">
                                                                      <div class="custom-check">
                                                                          <input type="checkbox"
                                                                              class="checkBoxClass branchescheckBox"
                                                                              name="permissions[]"
                                                                              value="{{ $permission->id }}"
                                                                              id="button_{{ $permission->id }}">
                                                                          <span></span>
                                                                      </div>
                                                                      <label
                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>


                                              <div class="col-4">
                                                  <div class="form-group">
                                                      <div class="permissions-section-inner-sec">
                                                          <p class="headings"><strong class="list-text">Branche
                                                                  Locality</strong></p>
                                                          <div class="custom_check_wrap">
                                                              <div class="custom-check">
                                                                  <input type="checkbox" id="locality_permissions"
                                                                      class="ckbCheckAll">
                                                                  <span></span>
                                                              </div>
                                                              <strong class="list-text">Select All</strong>
                                                          </div>
                                                          <div id="checkBoxes">
                                                              @foreach ($branchLocalityPermissions as $permission)
                                                                  <div class="custom_check_wrap">
                                                                      <div class="custom-check">
                                                                          <input type="checkbox"
                                                                              class="checkBoxClass localitycheckBox"
                                                                              name="permissions[]"
                                                                              value="{{ $permission->id }}"
                                                                              id="button_{{ $permission->id }}">
                                                                          <span></span>
                                                                      </div>
                                                                      <label
                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>


                                          </div>



                                          <div class="title">
                                              <h5 class="mb-0 py-3">Menu Management</h5>
                                          </div>

                                          <div class="row permissions-section">


                                              <div class="col-4">
                                                  <div class="form-group">
                                                      <div class="permissions-section-inner-sec">
                                                          <p class="headings"><strong
                                                                  class="list-text">Categories</strong></p>
                                                          <div class="custom_check_wrap">
                                                              <div class="custom-check">
                                                                  <input type="checkbox" id="menu_categories_permissions"
                                                                      class="ckbCheckAll">
                                                                  <span></span>
                                                              </div>
                                                              <strong class="list-text">Select All</strong>
                                                          </div>
                                                          <div id="checkBoxes">
                                                              @foreach ($menuCategoryPermissions as $permission)
                                                                  <div class="custom_check_wrap">
                                                                      <div class="custom-check">
                                                                          <input type="checkbox"
                                                                              class="checkBoxClass menuCategoriescheckBox"
                                                                              name="permissions[]"
                                                                              value="{{ $permission->id }}"
                                                                              id="button_{{ $permission->id }}">
                                                                          <span></span>
                                                                      </div>
                                                                      <label
                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>






                                              <div class="col-4">
                                                  <div class="form-group">
                                                      <div class="permissions-section-inner-sec">
                                                          <p class="headings"><strong class="list-text">Menu
                                                                  Items</strong></p>
                                                          <div class="custom_check_wrap">
                                                              <div class="custom-check">
                                                                  <input type="checkbox" id="menu_items_permissions"
                                                                      class="ckbCheckAll">
                                                                  <span></span>
                                                              </div>
                                                              <strong class="list-text">Select All</strong>
                                                          </div>
                                                          <div id="checkBoxes">
                                                              @foreach ($menuItemPermissions as $permission)
                                                                  <div class="custom_check_wrap">
                                                                      <div class="custom-check">
                                                                          <input type="checkbox"
                                                                              class="checkBoxClass menuItemscheckBox"
                                                                              name="permissions[]"
                                                                              value="{{ $permission->id }}"
                                                                              id="button_{{ $permission->id }}">
                                                                          <span></span>
                                                                      </div>
                                                                      <label
                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>






                                              <div class="col-4">
                                                  <div class="form-group">
                                                      <div class="permissions-section-inner-sec">
                                                          <p class="headings"><strong class="list-text">Items
                                                                  Availability</strong></p>
                                                          <div class="custom_check_wrap">
                                                              <div class="custom-check">
                                                                  <input type="checkbox"
                                                                      id="menu_items_availability_permissions"
                                                                      class="ckbCheckAll">
                                                                  <span></span>
                                                              </div>
                                                              <strong class="list-text">Select All</strong>
                                                          </div>
                                                          <div id="checkBoxes">
                                                              @foreach ($menuItemAvailabilityPermissions as $permission)
                                                                  <div class="custom_check_wrap">
                                                                      <div class="custom-check">
                                                                          <input type="checkbox"
                                                                              class="checkBoxClass menuItemsAvailabilitycheckBox"
                                                                              name="permissions[]"
                                                                              value="{{ $permission->id }}"
                                                                              id="button_{{ $permission->id }}">
                                                                          <span></span>
                                                                      </div>
                                                                      <label
                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                  </div>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>





                                          </div>

                                      </div>



                                      <!--
                                                                                                                                          <div class="title">
                                                                                                                                            <h5>Dine & Catering Management</h5>
                                                                                                                                            <hr/>
                                                                                                                                          </div>

                                                                                                                                          <div class="row permissions-section">
                                                                                                                                            <div class="col-4">
                                                                                                                                              <div class="form-group">
                                                                                                                                                <div class="permissions-section-inner-sec">
                                                                                                                                                  <p class="headings"><strong class="list-text">Dine & Catering</strong></p>
                                                                                                                                                  <div class="custom_check_wrap">
                                                                                                                                                    <div class="custom-check">
                                                                                                                                                      <input type="checkbox" id="catering_permissions" class="ckbCheckAll">
                                                                                                                                                      <span></span>
                                                                                                                                                    </div>
                                                                                                                                                      <strong class="list-text">Select All</strong>
                                                                                                                                                  </div>
                                                                                                                                                  <div id="checkBoxes">
                                                                                                                                                    @foreach ($cateringPermissions as $permission)
    <div class="custom_check_wrap">
                                                                                                                                                        <div class="custom-check">
                                                                                                                                                          <input type="checkbox" class="checkBoxClass cateringcheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                                                                                                                                          <span></span>
                                                                                                                                                        </div>
                                                                                                                                                          <label class="mb-0">{{ $permission->name }}</label>
                                                                                                                                                      </div>
    @endforeach
                                                                                                                                                  </div>
                                                                                                                                                </div>
                                                                                                                                              </div>
                                                                                                                                            </div>



                                                                                                                                          </div>
                                                                                                                                        -->



                                      <div class="title">
                                          <h5 class="mb-0 py-3">Orders Management</h5>
                                      </div>

                                      <div class="row permissions-section">
                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Online Orders</strong>
                                                      </p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="orders_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($orderPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass orderscheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                      </div>













                                      <div class="title">
                                          <h5 class="mb-0 py-3">Offer Management</h5>
                                      </div>

                                      <div class="row permissions-section">

                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Current
                                                              Offers</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="current_offers_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($CurrentOfferPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass CurrentofferscheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Checkout
                                                              Offers</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="offers_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($offerPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass offerscheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Discount</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="discount_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($discountPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass discountcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Coupon Code</strong>
                                                      </p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="coupon_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($couponPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass couponcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Gift Cards</strong>
                                                      </p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="giftcard_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($giftCardPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass giftCardcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>







                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Loyalties</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="loyalties_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($loyaltyPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass loyaltiescheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                      </div>


                                      <div class="title">
                                          <h5 class="mb-0 py-3">Payments</h5>
                                      </div>

                                      <div class="row permissions-section">
                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Payments
                                                              <!-- Transactions -->
                                                          </strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="payments_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($transactionPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass paymentcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                      </div>


                                      <div class="title">
                                          <h5 class="mb-0 py-3">Content Management</h5>
                                      </div>

                                      <div class="row permissions-section">


                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Website</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="mobile_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($websiteContentPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass mobilecheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Banners</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="banners_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($bannerContentPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass bannerscheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Media</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="media_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($MediaContentPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass MediacheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4 mt-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Theme</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="theme_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($ThemeContentPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass ThemecheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4 mt-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Social Links</strong>
                                                      </p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="social_links_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SocialLinkContentPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SocialLinkscheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Blogs</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="blogs_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($blogPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass blogscheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>




                                      </div>


                                      <div class="title">
                                          <h5>User's Feedback</h5>
                                          <hr />
                                      </div>

                                      <div class="row permissions-section">
                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Contact Us</strong>
                                                      </p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="contactus_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($contactUSPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass contactUsCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Review</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="review_permission"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($reviewPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass reviewCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <!--
                                                                        <div class="col-4">
                                                                        <div class="form-group">
                                                                          <div class="permissions-section-inner-sec">
                                                                            <p class="headings"><strong class="list-text">Join Us Requests</strong></p>
                                                                            <div class="custom_check_wrap">
                                                                              <div class="custom-check">
                                                                                <input type="checkbox" id="joinus_permission" class="ckbCheckAll">
                                                                                <span></span>
                                                                              </div>
                                                                                <strong class="list-text">Select All</strong>
                                                                            </div>
                                                                            <div id="checkBoxes">
                                                                              @foreach ($joinusPermissions as $permission)
    <div class="custom_check_wrap">
                                                                                  <div class="custom-check">
                                                                                    <input type="checkbox" class="checkBoxClass joinusCheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                                                                    <span></span>
                                                                                  </div>
                                                                                    <label class="mb-0">{{ $permission->name }}</label>
                                                                                </div>
    @endforeach
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </div> -->









                                      </div>






                                      <!--  <div class="title">
                                                                                                                                            <h5 class="mb-0 py-3">Reports</h5>
                                                                                                                                          </div>

                                                                                                                                          <div class="row permissions-section">
                                                                                                                                            <div class="col-4">
                                                                                                                                              <div class="form-group">
                                                                                                                                                <div class="permissions-section-inner-sec">
                                                                                                                                                  <p class="headings"><strong class="list-text">Reports </strong></p>
                                                                                                                                                  <div class="custom_check_wrap">
                                                                                                                                                    <div class="custom-check">
                                                                                                                                                      <input type="checkbox" id="reports_permissions" class="ckbCheckAll">
                                                                                                                                                      <span></span>
                                                                                                                                                    </div>
                                                                                                                                                      <strong class="list-text">Select All</strong>
                                                                                                                                                  </div>
                                                                                                                                                  <div id="checkBoxes">
                                                                                                                                                    @foreach ($reportsPermissions as $permission)
    <div class="custom_check_wrap">
                                                                                                                                                        <div class="custom-check">
                                                                                                                                                          <input type="checkbox" class="checkBoxClass reportscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                                                                                                                                          <span></span>
                                                                                                                                                        </div>
                                                                                                                                                          <label class="mb-0">{{ $permission->name }}</label>
                                                                                                                                                      </div>
    @endforeach
                                                                                                                                                  </div>
                                                                                                                                                </div>
                                                                                                                                              </div>
                                                                                                                                            </div>
                                                                                                                                          </div> -->




                                      <div class="title">
                                          <h5 class="mb-0 py-3">Advance Reports</h5>
                                      </div>

                                      <div class="row permissions-section">


                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Daily Sales Report
                                                              (DSR)</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="daily_sales_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($DailySalesReportsPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass DailySalescheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Cash Deposite Branch
                                                              Wise </strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="cash_deposite_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($CashDepositeReportsPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass cashDepositecheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>





                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Payment Methods Branch
                                                              Wise</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="payment_branch_wise_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($PaymentMethodsBranchWisePermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass PaymentBranchWisecheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>




                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Sales By
                                                              Branch ( Gross Sale )</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="sales_by_branch_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesByBranchPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesByBranchcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Gross Sale
                                                              Monthly</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox"
                                                                  id="sales_by_branch_gross_sale_monthly_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesByBranchGrossSaleMonthlyPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesByBranchGrossSaleMonthlycheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Sales By
                                                              Branch ( Net Sale )</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox"
                                                                  id="sales_by_branch_net_sale_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesByBranchNetSalePermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesByBranchNetSalecheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Net Sale
                                                              Monthly</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox"
                                                                  id="sales_by_branch_net_sale_monthly_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesByBranchNetSaleMonthlyPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesByBranchNetSaleMonthlycheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Sales By
                                                              Branch ( Discount Sale )</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox"
                                                                  id="sales_by_branch_discount_sale_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesByBranchDiscountSalePermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesByBranchDiscountSalecheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Sales By Branch (
                                                              Discount,Complimentary,Retrun)</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox"
                                                                  id="sales_by_branch_discount_complementry_return_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesByBranchDiscountComplementryReturnPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesByBranchDiscountComplementryReturnSalecheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>





                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Sales By
                                                              Month</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="sales_by_month_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesByMonthPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesByMonthcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>




                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Sales By
                                                              Service</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="sales_by_service_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesByServicePermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesByServicecheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Complimentary
                                                              Report</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox"
                                                                  id="sales_by_complimentary_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesByComplimentaryPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesByComplimentarycheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>





                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Sales & Petty
                                                              Cash</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="sales_and_petty_cash_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesPettyReportPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesAndPettyCashcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>





                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Branch Petty
                                                              Cash</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="branch_petty_cash_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($BranchPettyCashPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass BranchPettyCashcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text"> Petty Cash By Branch
                                                              (Month Wise)</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox"
                                                                  id="petty_cash_month_wise_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($PettyByBranchPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass PettyCashMonthWisecheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Petty cash by Month
                                                              (Single Branch)</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox"
                                                                  id="petty_cash_single_branch_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($PettyByMonthPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass PettyCashSingleBranchcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>




                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Car Wise Fule
                                                              Report</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="car_wise_fule_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($CarWiseFulePermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass CarWiseFulecheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>






                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Card Commission
                                                              Report</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="credit_card_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($CreditCardReportPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass CreditCardcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Card Report By
                                                              Branch</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="sales_reporting_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($SalesReportPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass SalesReportingcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Card Report By
                                                              Month</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox"
                                                                  id="credit_card_repor_by_month_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($CreditCardReportByMonthReportPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass CreditCardReportByMonthcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Maintenance
                                                              Report</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="maintenance_report_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($MaintenanceReportPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass MaintenanceReportcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Tip
                                                              Report</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="tip_report_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($TipReportReportPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass TipReportcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>




                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Gift Cards
                                                              Report</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="gift_card_report_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($GiftCardReportPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass GiftCardReportcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Gift Cards All
                                                              Branch</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox"
                                                                  id="gift_card_all_branch_report_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($GiftCardAllBranchReportPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass GiftCardAllBranchReportcheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>












                                      </div>




                                      <div class="title">
                                          <h5 class="mb-0 py-3">Misc Data Management</h5>
                                      </div>

                                      <div class="row permissions-section">

                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Brands</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="brands_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($brandsPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass brandsCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong
                                                              class="list-text">Subsidiaries</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="subsidiaries_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($subsidiariesPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass subsidiariesCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Blocks</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="blocks_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($blocksPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass blocksCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Cities</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="citiess_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($cityPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass citiessCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Security
                                                              Questions</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="question_permission"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($questionPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass questionCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong
                                                              class="list-text">Designations</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="desginations_permission"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($designationsPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass designationsCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Petty Expense
                                                              Category</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="PettyECat_permission"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($PettyECatPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass PettyECatCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>




                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Petty Expense Sub
                                                              Category</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="PettyESubCat_permission"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($PettyESubCatPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass PettyESubCatCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <!-- ---------------------------------------------------- -->

                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Maintenance
                                                              Category</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="MaintenanceCat_permission"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($MaintenanceCatPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass MaintenanceCatCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Maintenance Sub
                                                              Category</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="MaintenanceSubCat_permission"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($MaintenanceSubCatPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass MaintenanceSubCatCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Ownership</strong>
                                                      </p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="ownership_permission"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($ownershipPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass OwnershipCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Drivers</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="Drivers_permission"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($driverPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass DriversCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          <div class="col-4 mb-3">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Cars</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="Cars_permission"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($carPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass CarsCheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                          <!-- ----------------------------------------------------- -->



                                      </div>

                                      <div class="title">
                                          <h5 class="mb-0 py-3">Access Control</h5>
                                      </div>

                                      <div class="row permissions-section">
                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Roles</strong></p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="roles_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($rolesPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass rolescheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="permissions-section-inner-sec">
                                                      <p class="headings"><strong class="list-text">Permissions</strong>
                                                      </p>
                                                      <div class="custom_check_wrap">
                                                          <div class="custom-check">
                                                              <input type="checkbox" id="access_permissions"
                                                                  class="ckbCheckAll">
                                                              <span></span>
                                                          </div>
                                                          <strong class="list-text">Select All</strong>
                                                      </div>
                                                      <div id="checkBoxes">
                                                          @foreach ($permissionPermissions as $permission)
                                                              <div class="custom_check_wrap">
                                                                  <div class="custom-check">
                                                                      <input type="checkbox"
                                                                          class="checkBoxClass accesscheckBox"
                                                                          name="permissions[]"
                                                                          value="{{ $permission->id }}"
                                                                          id="button_{{ $permission->id }}">
                                                                      <span></span>
                                                                  </div>
                                                                  <label class="mb-0">{{ $permission->name }}</label>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>


                                  </div>


                                  <div class="title">
                                      <h5 class="mb-0 py-3">Recycle Bin</h5>
                                  </div>

                                  <div class="row permissions-section">
                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="permissions-section-inner-sec">
                                                  <div class="custom_check_wrap">
                                                      <div class="custom-check">
                                                          <input type="checkbox" id="restore_permissions"
                                                              class="ckbCheckAll">
                                                          <span></span>
                                                      </div>
                                                      <strong class="list-text">Select All</strong>
                                                  </div>
                                                  <div id="checkBoxes">

                                                      <div class="row">

                                                          {{-- Customer Recycle Bin --}}

                                                          <div class="col-3 mt-3">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Customers</strong></p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_customer_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (end($slug) == 'customer')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_customer_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>


                                                          {{--  ------------------  --}}


                                                          {{-- Admin Recycle Bin --}}

                                                          <div class="col-3 mt-3">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Admins</strong></p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_admin_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (end($slug) == 'admin')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_admin_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}


                                                          {{-- Branch Managers Recycle Bin --}}

                                                          <div class="col-3 mt-3">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Branch Managers</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_manager_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (end($slug) == 'manager')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_manager_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}



                                                          {{-- Staff Recycle Bin --}}

                                                          <div class="col-3 mt-3">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Staffs</strong></p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_staff_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (end($slug) == 'staff')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_staff_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}



                                                      </div>

                                                      <div class="row">

                                                          {{-- Branch Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Branches</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_branch_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (end($slug) == 'branch')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_branch_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}


                                                          {{-- Menu Categories Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong class="list-text">Menu
                                                                              Categories</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_menu_categories_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'menu' && @$slug[count($slug) - 1] == 'categories')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_menu_categories_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Menu Item Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong class="list-text">Menu
                                                                              Items</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_menu_items_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'menu' && @$slug[count($slug) - 1] == 'item')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_menu_item_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}



                                                          {{-- Current Offer Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Current Offers</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_current_offer_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'current' && @$slug[count($slug) - 1] == 'offer')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_current_offer_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}




                                                          {{-- Checkout Offer Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Checkout Offers</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_checkout_offer_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'checkout' && @$slug[count($slug) - 1] == 'offer')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_checkout_offer_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}


                                                          {{-- --------------------  --}}





                                                          {{-- Discount Offer Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Discount Offers</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_discount_offer_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'discount' && @$slug[count($slug) - 1] == 'offer')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_discount_offer_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}


                                                          {{-- Coupon Code Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Coupon Code</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_coupon_code_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'coupon' && @$slug[count($slug) - 1] == 'code')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_coupon_code_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Gift Card Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong class="list-text">Gift
                                                                              Cards</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_gift_card_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'gift' && @$slug[count($slug) - 1] == 'cards')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_gift_card_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}


                                                          {{-- Daily Sales Report Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Daily Sales
                                                                              Report (DSR)</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_daily_sales_report_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'dsr')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_daily_sales_report_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}


                                                          {{-- Sales & Petty Report Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Sales & Petty
                                                                              Report</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_sales_petty_report_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'petty')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_sales_petty_report_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}







                                                          {{-- Maintenance Report Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Maintenance
                                                                              Report</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_maintenance_report_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'maintenance' && @$slug[count($slug) - 1] == 'report')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_maintenance_report_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}



                                                          {{-- Tip Report Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong class="list-text">Tip
                                                                              Report</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_tip_report_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'tip' && @$slug[count($slug) - 1] == 'report')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_tip_report_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}





                                                          {{-- Brands Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Brands</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_brands_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'brands')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_brands_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}



                                                          {{-- Blocks Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Blocks</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_blocks_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'blocks')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_blocks_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}





                                                          {{-- Cities Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Cities</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_cities_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'cities')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_cities_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Security Questions Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Security
                                                                              Questions</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_security_questions_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'question')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_security_questions_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}


                                                          {{-- Designations Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Designations</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_designations_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'designations')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_designations_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Petty Expense Category Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Petty Expense
                                                                              Category</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_petty_expense_category_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'expense' && @$slug[count($slug) - 1] == 'category')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_petty_expense_category_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Petty Expense Sub Category Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Petty Expense Sub
                                                                              Category</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_petty_expense_sub_category_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 3] == 'expense' &&
                                                                                  @$slug[count($slug) - 2] == 'sub' &&
                                                                                  @$slug[count($slug) - 1] == 'category')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_petty_expense_sub_category_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Maintenance Category Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Maintenance
                                                                              Category</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_maintenance_category_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 2] == 'maintenance' && @$slug[count($slug) - 1] == 'category')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_maintenance_category_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Maintenance Sub Category Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Maintenance Sub
                                                                              Category</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_maintenance_sub_category_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if (@$slug[count($slug) - 3] == 'maintenance' &&
                                                                                  @$slug[count($slug) - 2] == 'sub' &&
                                                                                  @$slug[count($slug) - 1] == 'category')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_maintenance_sub_category_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Ownership Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Ownership</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_ownership_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'ownership')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_ownership_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Drivers Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Drivers</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_drivers_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'drivers')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_drivers_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Cars Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Cars</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_cars_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'cars')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_cars_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                          {{-- Role Recycle Bin --}}

                                                          <div class="col-4 mt-4">
                                                              <div class="form-group">
                                                                  <div class="permissions-section-inner-sec">
                                                                      <p class="headings"><strong
                                                                              class="list-text">Role</strong>
                                                                      </p>
                                                                      <div class="custom_check_wrap">
                                                                          <div class="custom-check">
                                                                              <input type="checkbox"
                                                                                  id="restore_role_all"
                                                                                  class="restore_select_checkbox ckbCheckAll">
                                                                              <span></span>
                                                                          </div>
                                                                          <strong class="list-text">Select All</strong>
                                                                      </div>
                                                                      <div id="checkBoxes">

                                                                          @foreach ($recycle_binPermissions as $permission)
                                                                              <?php

                                                                              $slug = explode('_', $permission->slug);

                                                                              //   end($slug); //For Getting End of array value//

                                                                              ?>

                                                                              @if ($slug[count($slug) - 1] == 'role')
                                                                                  <div class="custom_check_wrap">
                                                                                      <div class="custom-check">
                                                                                          <input type="checkbox"
                                                                                              class="checkBoxClass restorecheckBox restore_role_fields"
                                                                                              name="permissions[]"
                                                                                              value="{{ $permission->id }}"
                                                                                              id="button_{{ $permission->id }}">
                                                                                          <span></span>
                                                                                      </div>
                                                                                      <label
                                                                                          class="mb-0">{{ $permission->name }}</label>
                                                                                  </div>
                                                                              @endif
                                                                          @endforeach

                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          {{-- --------------------  --}}

                                                      </div>

                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">

                              <button type="submit"
                                  class="button btn_bg_color common_btn text-white @can('edit_permissions') @else d-none @endcan">{{ __('adminlte::adminlte.save') }}</button>

                          </div>
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
      <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

      <script>
          $(document).ready(function() {
              checkAll();
              $("input[type='checkbox']").change(function() {
                  checkAll();
              });
              $("#role_name").change(function() {
                  $('input').filter(':checkbox').prop('checked', false);
                  var role = $(this);
                  $("#role_id").val(role.val());
                  $(".checkBoxClass").removeAttr('checked');
                  var id = $("#role_name").val();
                  $.ajax({
                      url: "{{ route('admins.role.permissions') }}",
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
                              var permissionId = "#button_" + response.permission_id;
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
                      "permissions[]": {
                          required: true
                      }
                  },
                  messages: {
                      role_name: {
                          required: "The Role Name field is required"
                      },
                      "permissions[]": {
                          required: "You must select at least one permission",
                      }
                  }
              });
          });

          function checkAll() {
              $("#full_access").click(function() {
                  $("input[type=checkbox]").prop('checked', this.checked)
              })

              $("#appusers_permissions").click(function() {
                  $(".appUserscheckBox").prop('checked', this.checked)
              })

              $("#admins_permissions").click(function() {
                  $(".adminscheckBox").prop('checked', this.checked)
              })


              $("#branch_manager_permissions").click(function() {
                  $(".branchManagercheckBox").prop('checked', this.checked)
              })

              $("#branch_staff_permissions").click(function() {
                  $(".branchStaffcheckBox").prop('checked', this.checked)
              })

              $("#management_permissions").click(function() {
                  $(".ManagementcheckBox").prop('checked', this.checked)
              })

              $("#branches_permissions").click(function() {
                  $(".branchescheckBox").prop('checked', this.checked)
              })

              $("#locality_permissions").click(function() {
                  $(".localitycheckBox").prop('checked', this.checked)
              })

              $("#menu_categories_permissions").click(function() {
                  $(".menuCategoriescheckBox").prop('checked', this.checked)
              })

              $("#menu_items_permissions").click(function() {
                  $(".menuItemscheckBox").prop('checked', this.checked)
              })

              $("#menu_items_availability_permissions").click(function() {
                  $(".menuItemsAvailabilitycheckBox").prop('checked', this.checked)
              })



              $("#blogs_permissions").click(function() {
                  $(".blogscheckBox").prop('checked', this.checked)
              })


              $("#catering_permissions").click(function() {
                  $(".cateringcheckBox").prop('checked', this.checked)
              })

              $("#offers_permissions").click(function() {
                  $(".offerscheckBox").prop('checked', this.checked)
              })

              $("#current_offers_permissions").click(function() {
                  $(".CurrentofferscheckBox").prop('checked', this.checked)
              })

              $("#discount_permissions").click(function() {
                  $(".discountcheckBox").prop('checked', this.checked)
              })

              $("#coupon_permissions").click(function() {
                  $(".couponcheckBox").prop('checked', this.checked)
              })

              $("#loyalties_permissions").click(function() {
                  $(".loyaltiescheckBox").prop('checked', this.checked)
              })


              // $("#products_permissions").click(function() {
              //   $(".productsheckBox").prop('checked', this.checked)
              // })

              $("#contactus_permissions").click(function() {
                  $(".contactUsCheckBox").prop('checked', this.checked)
              })


              $("#citiess_permissions").click(function() {
                  $(".citiessCheckBox").prop('checked', this.checked)
              })

              $("#brands_permissions").click(function() {
                  $(".brandsCheckBox").prop('checked', this.checked)
              })

              $("#subsidiaries_permissions").click(function() {
                  $(".subsidiariesCheckBox").prop('checked', this.checked)
              })


              $("#blocks_permissions").click(function() {
                  $(".blocksCheckBox").prop('checked', this.checked)
              })



              $("#mobile_permissions").click(function() {
                  $(".mobilecheckBox").prop('checked', this.checked)
              })


              $("#banners_permissions").click(function() {
                  $(".bannerscheckBox").prop('checked', this.checked)
              })

              $("#media_permissions").click(function() {
                  $(".MediacheckBox").prop('checked', this.checked)
              })

              $("#theme_permissions").click(function() {
                  $(".ThemecheckBox").prop('checked', this.checked)
              })

              $("#social_links_permissions").click(function() {
                  $(".SocialLinkscheckBox").prop('checked', this.checked)
              })

              // $("#currency_permissions").click(function() {
              //   $(".currencycheckBox").prop('checked', this.checked)
              // })
              $("#roles_permissions").click(function() {
                  $(".rolescheckBox").prop('checked', this.checked)
              })

              $("#access_permissions").click(function() {
                  $(".accesscheckBox").prop('checked', this.checked)
              })

              $("#restore_permissions").click(function() {

                  $(".restorecheckBox").prop('checked', this.checked);

                  $('.restore_select_checkbox').prop('checked', this.checked);
              })

              $("#orders_permissions").click(function() {

                  $(".orderscheckBox").prop('checked', this.checked)
              })

              $("#payments_permissions").click(function() {

                  $(".paymentcheckBox").prop('checked', this.checked)
              })

              $("#reports_permissions").click(function() {

                  $(".reportscheckBox").prop('checked', this.checked)
              })

              $("#cash_deposite_permissions").click(function() {

                  $(".cashDepositecheckBox").prop('checked', this.checked)
              })

              $("#daily_sales_permissions").click(function() {

                  $(".DailySalescheckBox").prop('checked', this.checked)
              })


              $("#payment_branch_wise_permissions").click(function() {

                  $(".PaymentBranchWisecheckBox").prop('checked', this.checked)
              })


              $("#sales_by_branch_permissions").click(function() {

                  $(".SalesByBranchcheckBox").prop('checked', this.checked)
              })

              $("#sales_by_branch_gross_sale_monthly_permissions").click(function() {

                  $(".SalesByBranchGrossSaleMonthlycheckBox").prop('checked', this.checked)
              })


              $("#sales_by_branch_net_sale_permissions").click(function() {

                  $(".SalesByBranchNetSalecheckBox").prop('checked', this.checked)
              })


              $("#sales_by_branch_net_sale_monthly_permissions").click(function() {

                  $(".SalesByBranchNetSaleMonthlycheckBox").prop('checked', this.checked)
              })



              $("#sales_by_branch_discount_sale_permissions").click(function() {

                  $(".SalesByBranchDiscountSalecheckBox").prop('checked', this.checked)
              })

              $("#sales_by_branch_discount_complementry_return_permissions").click(function() {

                  $(".SalesByBranchDiscountComplementryReturnSalecheckBox").prop('checked', this.checked)
              })


              $("#sales_by_month_permissions").click(function() {

                  $(".SalesByMonthcheckBox").prop('checked', this.checked)
              })

              $("#sales_by_service_permissions").click(function() {

                  $(".SalesByServicecheckBox").prop('checked', this.checked)
              })


              $("#sales_by_complimentary_permissions").click(function() {

                  $(".SalesByComplimentarycheckBox").prop('checked', this.checked)
              })


              $("#branch_petty_cash_permissions").click(function() {

                  $(".BranchPettyCashcheckBox").prop('checked', this.checked)
              })



              $("#petty_cash_month_wise_permissions").click(function() {

                  $(".PettyCashMonthWisecheckBox").prop('checked', this.checked)
              })



              $("#petty_cash_single_branch_permissions").click(function() {

                  $(".PettyCashSingleBranchcheckBox").prop('checked', this.checked)
              })

              $("#car_wise_fule_permissions").click(function() {

                  $(".CarWiseFulecheckBox").prop('checked', this.checked)
              })



              $("#sales_and_petty_cash_permissions").click(function() {

                  $(".SalesAndPettyCashcheckBox").prop('checked', this.checked)
              })


              $("#credit_card_permissions").click(function() {

                  $(".CreditCardcheckBox").prop('checked', this.checked)
              })


              $("#sales_reporting_permissions").click(function() {

                  $(".SalesReportingcheckBox").prop('checked', this.checked)
              })


              $("#credit_card_repor_by_month_permissions").click(function() {

                  $(".CreditCardReportByMonthcheckBox").prop('checked', this.checked)
              })


              $("#review_permission").click(function() {

                  $(".reviewCheckBox").prop('checked', this.checked)
              })

              $("#question_permission").click(function() {

                  $(".questionCheckBox").prop('checked', this.checked)
              })



              $("#desginations_permission").click(function() {

                  $(".designationsCheckBox").prop('checked', this.checked)
              })



              $("#PettyECat_permission").click(function() {

                  $(".PettyECatCheckBox").prop('checked', this.checked)
              })


              $("#PettyESubCat_permission").click(function() {

                  $(".PettyESubCatCheckBox").prop('checked', this.checked)
              })


              $("#joinus_permission").click(function() {

                  $(".joinusCheckBox").prop('checked', this.checked)
              })



              // ----


              $("#giftcard_permissions").click(function() {

                  $(".giftCardcheckBox").prop('checked', this.checked)
              })



              $("#gift_card_report_permissions").click(function() {

                  $(".GiftCardReportcheckBox").prop('checked', this.checked)
              })


              $("#gift_card_all_branch_report_permissions").click(function() {

                  $(".GiftCardAllBranchReportcheckBox").prop('checked', this.checked)
              })


              $("#maintenance_report_permissions").click(function() {

                  $(".MaintenanceReportcheckBox").prop('checked', this.checked)
              })


              $("#tip_report_permissions").click(function() {

                  $(".TipReportcheckBox").prop('checked', this.checked)
              })


              $("#MaintenanceCat_permission").click(function() {

                  $(".MaintenanceCatCheckBox").prop('checked', this.checked)
              })


              $("#MaintenanceSubCat_permission").click(function() {

                  $(".MaintenanceSubCatCheckBox").prop('checked', this.checked)
              })


              $("#ownership_permission").click(function() {

                  $(".OwnershipCheckBox").prop('checked', this.checked)
              })


              $("#Drivers_permission").click(function() {

                  $(".DriversCheckBox").prop('checked', this.checked)
              })


              $("#Cars_permission").click(function() {

                  $(".CarsCheckBox").prop('checked', this.checked)
              })

              ////////////////////////////////////////

              if ($('.checkBoxClass:checked').length == $('.checkBoxClass').length) {
                  $("#full_access").prop('checked', 'true');
              } else {
                  $("#full_access").prop('checked', false);
              }


              if ($('.appUserscheckBox:checked').length == $('.appUserscheckBox').length) {
                  $("#appusers_permissions").prop('checked', 'true');
              } else {
                  $("#appusers_permissions").prop('checked', false);
              }



              if ($('.adminscheckBox:checked').length == $('.adminscheckBox').length) {
                  $("#admins_permissions").prop('checked', 'true');
              } else {
                  $("#admins_permissions").prop('checked', false);
              }


              if ($('.branchManagercheckBox:checked').length == $('.branchManagercheckBox').length) {
                  $("#branch_manager_permissions").prop('checked', 'true');
              } else {
                  $("#branch_manager_permissions").prop('checked', false);
              }


              if ($('.branchStaffcheckBox:checked').length == $('.branchStaffcheckBox').length) {
                  $("#branch_staff_permissions").prop('checked', 'true');
              } else {
                  $("#branch_staff_permissions").prop('checked', false);
              }


              if ($('.ManagementcheckBox:checked').length == $('.ManagementcheckBox').length) {
                  $("#management_permissions").prop('checked', 'true');
              } else {
                  $("#management_permissions").prop('checked', false);
              }


              if ($('.branchescheckBox:checked').length == $('.branchescheckBox').length) {
                  $("#branches_permissions").prop('checked', 'true');
              } else {
                  $("#branches_permissions").prop('checked', false);
              }


              if ($('.localitycheckBox:checked').length == $('.localitycheckBox').length) {
                  $("#locality_permissions").prop('checked', 'true');
              } else {
                  $("#locality_permissions").prop('checked', false);
              }


              if ($('.menuCategoriescheckBox:checked').length == $('.menuCategoriescheckBox').length) {
                  $("#menu_categories_permissions").prop('checked', 'true');
              } else {
                  $("#menu_categories_permissions").prop('checked', false);
              }


              if ($('.menuItemscheckBox:checked').length == $('.menuItemscheckBox').length) {
                  $("#menu_items_permissions").prop('checked', 'true');
              } else {
                  $("#menu_items_permissions").prop('checked', false);
              }


              if ($('.menuItemsAvailabilitycheckBox:checked').length == $('.menuItemsAvailabilitycheckBox').length) {
                  $("#menu_items_availability_permissions").prop('checked', 'true');
              } else {
                  $("#menu_items_availability_permissions").prop('checked', false);
              }



              if ($('.cateringcheckBox:checked').length == $('.cateringcheckBox').length) {
                  $("#catering_permissions").prop('checked', 'true');
              } else {
                  $("#catering_permissions").prop('checked', false);
              }


              if ($('.offerscheckBox:checked').length == $('.offerscheckBox').length) {
                  $("#offers_permissions").prop('checked', 'true');
              } else {
                  $("#offers_permissions").prop('checked', false);
              }

              if ($('.CurrentofferscheckBox:checked').length == $('.CurrentofferscheckBox').length) {
                  $("#current_offers_permissions").prop('checked', 'true');
              } else {
                  $("#current_offers_permissions").prop('checked', false);
              }


              if ($('.discountcheckBox:checked').length == $('.discountcheckBox').length) {
                  $("#discount_permissions").prop('checked', 'true');
              } else {
                  $("#discount_permissions").prop('checked', false);
              }


              if ($('.couponcheckBox:checked').length == $('.couponcheckBox').length) {
                  $("#coupon_permissions").prop('checked', 'true');
              } else {
                  $("#coupon_permissions").prop('checked', false);
              }


              if ($('.loyaltiescheckBox:checked').length == $('.loyaltiescheckBox').length) {
                  $("#loyalties_permissions").prop('checked', 'true');
              } else {
                  $("#loyalties_permissions").prop('checked', false);
              }




              if ($('.blogscheckBox:checked').length == $('.blogscheckBox').length) {
                  $("#blogs_permissions").prop('checked', 'true');
              } else {
                  $("#blogs_permissions").prop('checked', false);
              }


              if ($('.mobilecheckBox:checked').length == $('.mobilecheckBox').length) {
                  $("#mobile_permissions").prop('checked', 'true');
              } else {
                  $("#mobile_permissions").prop('checked', false);
              }


              if ($('.bannerscheckBox:checked').length == $('.bannerscheckBox').length) {
                  $("#banners_permissions").prop('checked', 'true');
              } else {
                  $("#banners_permissions").prop('checked', false);
              }


              if ($('.MediacheckBox:checked').length == $('.MediacheckBox').length) {
                  $("#media_permissions").prop('checked', 'true');
              } else {
                  $("#media_permissions").prop('checked', false);
              }


              if ($('.ThemecheckBox:checked').length == $('.ThemecheckBox').length) {
                  $("#theme_permissions").prop('checked', 'true');
              } else {
                  $("#theme_permissions").prop('checked', false);
              }


              if ($('.SocialLinkscheckBox:checked').length == $('.SocialLinkscheckBox').length) {
                  $("#social_links_permissions").prop('checked', 'true');
              } else {
                  $("#social_links_permissions").prop('checked', false);
              }

              //  if($('.currencycheckBox:checked').length == $('.currencycheckBox').length) {
              //    $("#currency_permissions").prop('checked', 'true');
              //  }
              //  else {
              //    $("#currency_permissions").prop('checked', false);
              //  }
              if ($('.rolescheckBox:checked').length == $('.rolescheckBox').length) {
                  $("#roles_permissions").prop('checked', 'true');
              } else {
                  $("#roles_permissions").prop('checked', false);
              }
              if ($('.accesscheckBox:checked').length == $('.accesscheckBox').length) {
                  $("#access_permissions").prop('checked', 'true');
              } else {
                  $("#access_permissions").prop('checked', false);
              }
              if ($('.restorecheckBox:checked').length == $('.restorecheckBox').length) {
                  $("#restore_permissions").prop('checked', 'true');
              } else {
                  $("#restore_permissions").prop('checked', false);
              }

              if ($('.contactUsCheckBox:checked').length == $('.contactUsCheckBox').length) {
                  $("#contactus_permissions").prop('checked', 'true');
              } else {
                  $("#contactus_permissions").prop('checked', false);
              }


              if ($('.citiessCheckBox:checked').length == $('.citiessCheckBox').length) {
                  $("#citiess_permissions").prop('checked', 'true');
              } else {
                  $("#citiess_permissions").prop('checked', false);
              }

              if ($('.brandsCheckBox:checked').length == $('.brandsCheckBox').length) {
                  $("#brands_permissions").prop('checked', 'true');
              } else {
                  $("#brands_permissions").prop('checked', false);
              }


              if ($('.subsidiariesCheckBox:checked').length == $('.subsidiariesCheckBox').length) {
                  $("#subsidiaries_permissions").prop('checked', 'true');
              } else {
                  $("#subsidiaries_permissions").prop('checked', false);
              }



              if ($('.blocksCheckBox:checked').length == $('.blocksCheckBox').length) {
                  $("#blocks_permissions").prop('checked', 'true');
              } else {
                  $("#blocks_permissions").prop('checked', false);
              }

              //  if($('.deliveryagentcheckBox:checked').length == $('.deliveryagentcheckBox').length) {
              //    $("#delivery_agent_permissions").prop('checked', 'true');
              //  }
              //  else {
              //    $("#delivery_agent_permissions").prop('checked', false);
              //  }

              if ($('.orderscheckBox:checked').length == $('.orderscheckBox').length) {
                  $("#orders_permissions").prop('checked', 'true');
              } else {
                  $("#orders_permissions").prop('checked', false);
              }

              if ($('.reportscheckBox:checked').length == $('.reportscheckBox').length) {
                  $("#reports_permissions").prop('checked', 'true');
              } else {
                  $("#reports_permissions").prop('checked', false);
              }


              if ($('.cashDepositecheckBox:checked').length == $('.cashDepositecheckBox').length) {
                  $("#cash_deposite_permissions").prop('checked', 'true');
              } else {
                  $("#cash_deposite_permissions").prop('checked', false);
              }


              if ($('.DailySalescheckBox:checked').length == $('.DailySalescheckBox').length) {
                  $("#daily_sales_permissions").prop('checked', 'true');
              } else {
                  $("#daily_sales_permissions").prop('checked', false);
              }


              if ($('.PaymentBranchWisecheckBox:checked').length == $('.PaymentBranchWisecheckBox').length) {
                  $("#payment_branch_wise_permissions").prop('checked', 'true');
              } else {
                  $("#payment_branch_wise_permissions").prop('checked', false);
              }


              if ($('.SalesByBranchcheckBox:checked').length == $('.SalesByBranchcheckBox').length) {
                  $("#sales_by_branch_permissions").prop('checked', 'true');
              } else {
                  $("#sales_by_branch_permissions").prop('checked', false);
              }


              if ($('.SalesByBranchGrossSaleMonthlycheckBox:checked').length == $('.SalesByBranchGrossSaleMonthlycheckBox')
                  .length) {
                  $("#sales_by_branch_gross_sale_monthly_permissions").prop('checked', 'true');
              } else {
                  $("#sales_by_branch_gross_sale_monthly_permissions").prop('checked', false);
              }



              if ($('.SalesByBranchNetSaleMonthlycheckBox:checked').length == $('.SalesByBranchNetSaleMonthlycheckBox')
                  .length) {
                  $("#sales_by_branch_net_sale_monthly_permissions").prop('checked', 'true');
              } else {
                  $("#sales_by_branch_net_sale_monthly_permissions").prop('checked', false);
              }



              if ($('.SalesByBranchNetSalecheckBox:checked').length == $('.SalesByBranchNetSalecheckBox').length) {
                  $("#sales_by_branch_net_sale_permissions").prop('checked', 'true');
              } else {
                  $("#sales_by_branch_net_sale_permissions").prop('checked', false);
              }




              if ($('.SalesByBranchDiscountSalecheckBox:checked').length == $('.SalesByBranchDiscountSalecheckBox').length) {
                  $("#sales_by_branch_discount_sale_permissions").prop('checked', 'true');
              } else {
                  $("#sales_by_branch_discount_sale_permissions").prop('checked', false);
              }


              if ($('.SalesByBranchDiscountComplementryReturnSalecheckBox:checked').length == $(
                      '.SalesByBranchDiscountComplementryReturnSalecheckBox').length) {
                  $("#sales_by_branch_discount_complementry_return_permissions").prop('checked', 'true');
              } else {
                  $("#sales_by_branch_discount_complementry_return_permissions").prop('checked', false);
              }



              if ($('.SalesByMonthcheckBox:checked').length == $('.SalesByMonthcheckBox').length) {
                  $("#sales_by_month_permissions").prop('checked', 'true');
              } else {
                  $("#sales_by_month_permissions").prop('checked', false);
              }


              if ($('.SalesByServicecheckBox:checked').length == $('.SalesByServicecheckBox').length) {
                  $("#sales_by_service_permissions").prop('checked', 'true');
              } else {
                  $("#sales_by_service_permissions").prop('checked', false);
              }


              if ($('.SalesByComplimentarycheckBox:checked').length == $('.SalesByComplimentarycheckBox').length) {
                  $("#sales_by_complimentary_permissions").prop('checked', 'true');
              } else {
                  $("#sales_by_complimentary_permissions").prop('checked', false);
              }


              if ($('.BranchPettyCashcheckBox:checked').length == $('.BranchPettyCashcheckBox').length) {
                  $("#branch_petty_cash_permissions").prop('checked', 'true');
              } else {
                  $("#branch_petty_cash_permissions").prop('checked', false);
              }


              if ($('.PettyCashMonthWisecheckBox:checked').length == $('.PettyCashMonthWisecheckBox').length) {
                  $("#petty_cash_month_wise_permissions").prop('checked', 'true');
              } else {
                  $("#petty_cash_month_wise_permissions").prop('checked', false);
              }

              if ($('.PettyCashSingleBranchcheckBox:checked').length == $('.PettyCashSingleBranchcheckBox').length) {
                  $("#petty_cash_single_branch_permissions").prop('checked', 'true');
              } else {
                  $("#petty_cash_single_branch_permissions").prop('checked', false);
              }



              if ($('.CarWiseFulecheckBox:checked').length == $('.CarWiseFulecheckBox').length) {
                  $("#car_wise_fule_permissions").prop('checked', 'true');
              } else {
                  $("#car_wise_fule_permissions").prop('checked', false);
              }




              if ($('.SalesAndPettyCashcheckBox:checked').length == $('.SalesAndPettyCashcheckBox').length) {
                  $("#sales_and_petty_cash_permissions").prop('checked', 'true');
              } else {
                  $("#sales_and_petty_cash_permissions").prop('checked', false);
              }

              if ($('.CreditCardcheckBox:checked').length == $('.CreditCardcheckBox').length) {
                  $("#credit_card_permissions").prop('checked', 'true');
              } else {
                  $("#credit_card_permissions").prop('checked', false);
              }

              if ($('.SalesReportingcheckBox:checked').length == $('.SalesReportingcheckBox').length) {
                  $("#sales_reporting_permissions").prop('checked', 'true');
              } else {
                  $("#sales_reporting_permissions").prop('checked', false);
              }


              if ($('.CreditCardReportByMonthcheckBox:checked').length == $('.CreditCardReportByMonthcheckBox').length) {
                  $("#credit_card_repor_by_month_permissions").prop('checked', 'true');
              } else {
                  $("#credit_card_repor_by_month_permissions").prop('checked', false);
              }






              if ($('.reviewCheckBox:checked').length == $('.reviewCheckBox').length) {
                  $("#review_permission").prop('checked', 'true');
              } else {
                  $("#review_permission").prop('checked', false);
              }

              if ($('.questionCheckBox:checked').length == $('.questionCheckBox').length) {
                  $("#question_permission").prop('checked', 'true');
              } else {
                  $("#question_permission").prop('checked', false);
              }


              if ($('.designationsCheckBox:checked').length == $('.designationsCheckBox').length) {
                  $("#desginations_permission").prop('checked', 'true');
              } else {
                  $("#desginations_permission").prop('checked', false);
              }



              if ($('.PettyECatCheckBox:checked').length == $('.PettyECatCheckBox').length) {
                  $("#PettyECat_permission").prop('checked', 'true');
              } else {
                  $("#PettyECat_permission").prop('checked', false);
              }



              if ($('.PettyESubCatCheckBox:checked').length == $('.PettyESubCatCheckBox').length) {
                  $("#PettyESubCat_permission").prop('checked', 'true');
              } else {
                  $("#PettyESubCat_permission").prop('checked', false);
              }




              if ($('.joinusCheckBox:checked').length == $('.joinusCheckBox').length) {
                  $("#joinus_permission").prop('checked', 'true');
              } else {
                  $("#joinus_permission").prop('checked', false);
              }



              // -----------------------------


              if ($('.giftCardcheckBox:checked').length == $('.giftCardcheckBox').length) {
                  $("#giftcard_permissions").prop('checked', 'true');
              } else {
                  $("#giftcard_permissions").prop('checked', false);
              }


              if ($('.GiftCardReportcheckBox:checked').length == $('.GiftCardReportcheckBox').length) {
                  $("#gift_card_report_permissions").prop('checked', 'true');
              } else {
                  $("#gift_card_report_permissions").prop('checked', false);
              }

              if ($('.GiftCardAllBranchReportcheckBox:checked').length == $('.GiftCardAllBranchReportcheckBox').length) {
                  $("#gift_card_all_branch_report_permissions").prop('checked', 'true');
              } else {
                  $("#gift_card_all_branch_report_permissions").prop('checked', false);
              }



              if ($('.MaintenanceReportcheckBox:checked').length == $('.MaintenanceReportcheckBox').length) {
                  $("#maintenance_report_permissions").prop('checked', 'true');
              } else {
                  $("#maintenance_report_permissions").prop('checked', false);
              }



              if ($('.TipReportcheckBox:checked').length == $('.TipReportcheckBox').length) {
                  $("#tip_report_permissions").prop('checked', 'true');
              } else {
                  $("#tip_report_permissions").prop('checked', false);
              }


              if ($('.MaintenanceCatCheckBox:checked').length == $('.MaintenanceCatCheckBox').length) {
                  $("#MaintenanceCat_permission").prop('checked', 'true');
              } else {
                  $("#MaintenanceCat_permission").prop('checked', false);
              }



              if ($('.MaintenanceSubCatCheckBox:checked').length == $('.MaintenanceSubCatCheckBox').length) {
                  $("#MaintenanceSubCat_permission").prop('checked', 'true');
              } else {
                  $("#MaintenanceSubCat_permission").prop('checked', false);
              }


              if ($('.OwnershipCheckBox:checked').length == $('.OwnershipCheckBox').length) {
                  $("#ownership_permission").prop('checked', 'true');
              } else {
                  $("#ownership_permission").prop('checked', false);
              }



              if ($('.DriversCheckBox:checked').length == $('.DriversCheckBox').length) {
                  $("#Drivers_permission").prop('checked', 'true');
              } else {
                  $("#Drivers_permission").prop('checked', false);
              }



              if ($('.CarsCheckBox:checked').length == $('.CarsCheckBox').length) {
                  $("#Cars_permission").prop('checked', 'true');
              } else {
                  $("#Cars_permission").prop('checked', false);
              }


              function check_recycle_checkbox() {
                  if ($('.restore_select_checkbox:checked').length == $('.restore_select_checkbox').length) {
                      $("#restore_permissions").prop('checked', 'true');
                  } else {
                      $("#restore_permissions").prop('checked', false);
                  }
              }

              //   Customer Recycle Checkbox //

              $("#restore_customer_all").click(function() {

                  $(".restore_customer_fields").prop('checked', this.checked)
              });


              if ($('.restore_customer_fields:checked').length == $('.restore_customer_fields').length) {
                  $("#restore_customer_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_customer_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Admin Recycle Checkbox //

              $("#restore_admin_all").click(function() {

                  $(".restore_admin_fields").prop('checked', this.checked)
              });

              if ($('.restore_admin_fields:checked').length == $('.restore_admin_fields').length) {
                  $("#restore_admin_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_admin_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //


              //   Staff Recycle Checkbox //

              $("#restore_staff_all").click(function() {

                  $(".restore_staff_fields").prop('checked', this.checked)
              });

              if ($('.restore_staff_fields:checked').length == $('.restore_staff_fields').length) {
                  $("#restore_staff_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_staff_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //



              //   Manager Recycle Checkbox //

              $("#restore_manager_all").click(function() {

                  $(".restore_manager_fields").prop('checked', this.checked)
              });

              if ($('.restore_manager_fields:checked').length == $('.restore_manager_fields').length) {
                  $("#restore_manager_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_manager_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Branch Recycle Checkbox //

              $("#restore_branch_all").click(function() {

                  $(".restore_branch_fields").prop('checked', this.checked)
              });

              if ($('.restore_branch_fields:checked').length == $('.restore_branch_fields').length) {
                  $("#restore_branch_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_branch_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Menu Categories Recycle Checkbox //

              $("#restore_menu_categories_all").click(function() {

                  $(".restore_menu_categories_fields").prop('checked', this.checked)
              });

              if ($('.restore_menu_categories_fields:checked').length == $('.restore_menu_categories_fields').length) {
                  $("#restore_menu_categories_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_menu_categories_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Menu Items Recycle Checkbox //

              $("#restore_menu_items_all").click(function() {

                  $(".restore_menu_item_fields").prop('checked', this.checked)
              });

              if ($('.restore_menu_item_fields:checked').length == $('.restore_menu_item_fields').length) {
                  $("#restore_menu_items_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_menu_items_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //


              //   Checkout Offer Recycle Checkbox //

              $("#restore_current_offer_all").click(function() {

                  $(".restore_current_offer_fields").prop('checked', this.checked)
              });

              if ($('.restore_current_offer_fields:checked').length == $('.restore_current_offer_fields').length) {
                  $("#restore_current_offer_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_current_offer_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //




              //   Checkout Offer Recycle Checkbox //

              $("#restore_checkout_offer_all").click(function() {

                  $(".restore_checkout_offer_fields").prop('checked', this.checked)
              });

              if ($('.restore_checkout_offer_fields:checked').length == $('.restore_checkout_offer_fields').length) {
                  $("#restore_checkout_offer_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_checkout_offer_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Discount Offer Recycle Checkbox //

              $("#restore_discount_offer_all").click(function() {

                  $(".restore_discount_offer_fields").prop('checked', this.checked)
              });

              if ($('.restore_discount_offer_fields:checked').length == $('.restore_discount_offer_fields').length) {
                  $("#restore_discount_offer_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_discount_offer_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //


              //   Coupon Code Recycle Checkbox //

              $("#restore_coupon_code_all").click(function() {

                  $(".restore_coupon_code_fields").prop('checked', this.checked)
              });

              if ($('.restore_coupon_code_fields:checked').length == $('.restore_coupon_code_fields').length) {
                  $("#restore_coupon_code_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_coupon_code_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Gift Card Recycle Checkbox //

              $("#restore_gift_card_all").click(function() {

                  $(".restore_gift_card_fields").prop('checked', this.checked)
              });

              if ($('.restore_gift_card_fields:checked').length == $('.restore_gift_card_fields').length) {
                  $("#restore_gift_card_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_gift_card_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Daily Sales Report Recycle Checkbox //

              $("#restore_daily_sales_report_all").click(function() {

                  $(".restore_daily_sales_report_fields").prop('checked', this.checked)
              });

              if ($('.restore_daily_sales_report_fields:checked').length == $('.restore_daily_sales_report_fields').length) {
                  $("#restore_daily_sales_report_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_daily_sales_report_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Sales & Petty Recycle Checkbox //

              $("#restore_sales_petty_report_all").click(function() {

                  $(".restore_sales_petty_report_fields").prop('checked', this.checked)
              });

              if ($('.restore_sales_petty_report_fields:checked').length == $('.restore_sales_petty_report_fields').length) {
                  $("#restore_sales_petty_report_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_sales_petty_report_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Maintenance Report Recycle Checkbox //

              $("#restore_maintenance_report_all").click(function() {

                  $(".restore_maintenance_report_fields").prop('checked', this.checked)
              });

              if ($('.restore_maintenance_report_fields:checked').length == $('.restore_maintenance_report_fields').length) {
                  $("#restore_maintenance_report_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_maintenance_report_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //



              //   Tip Report Recycle Checkbox //

              $("#restore_tip_report_all").click(function() {

                  $(".restore_tip_report_fields").prop('checked', this.checked)
              });

              if ($('.restore_tip_report_fields:checked').length == $('.restore_tip_report_fields').length) {
                  $("#restore_tip_report_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_tip_report_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //



              //   Brands Recycle Checkbox //

              $("#restore_brands_all").click(function() {

                  $(".restore_brands_fields").prop('checked', this.checked)
              });

              if ($('.restore_brands_fields:checked').length == $('.restore_brands_fields').length) {
                  $("#restore_brands_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_brands_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //


              //   Blocks Recycle Checkbox //

              $("#restore_blocks_all").click(function() {

                  $(".restore_blocks_fields").prop('checked', this.checked)
              });

              if ($('.restore_blocks_fields:checked').length == $('.restore_blocks_fields').length) {
                  $("#restore_blocks_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_blocks_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //



              //   Cities Recycle Checkbox //

              $("#restore_cities_all").click(function() {

                  $(".restore_cities_fields").prop('checked', this.checked)
              });

              if ($('.restore_cities_fields:checked').length == $('.restore_cities_fields').length) {
                  $("#restore_cities_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_cities_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Security Questions Recycle Checkbox //

              $("#restore_security_questions_all").click(function() {

                  $(".restore_security_questions_fields").prop('checked', this.checked)
              });

              if ($('.restore_security_questions_fields:checked').length == $('.restore_security_questions_fields').length) {
                  $("#restore_security_questions_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_security_questions_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Designation Recycle Checkbox //

              $("#restore_designations_all").click(function() {

                  $(".restore_designations_fields").prop('checked', this.checked)
              });

              if ($('.restore_designations_fields:checked').length == $('.restore_designations_fields').length) {
                  $("#restore_designations_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_designations_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Petty Expense Category Recycle Checkbox //

              $("#restore_petty_expense_category_all").click(function() {

                  $(".restore_petty_expense_category_fields").prop('checked', this.checked)
              });

              if ($('.restore_petty_expense_category_fields:checked').length == $('.restore_petty_expense_category_fields')
                  .length) {
                  $("#restore_petty_expense_category_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_petty_expense_category_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Petty Expense Sub Category Recycle Checkbox //

              $("#restore_petty_expense_sub_category_all").click(function() {

                  $(".restore_petty_expense_sub_category_fields").prop('checked', this.checked)
              });

              if ($('.restore_petty_expense_sub_category_fields:checked').length == $(
                      '.restore_petty_expense_sub_category_fields').length) {
                  $("#restore_petty_expense_sub_category_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_petty_expense_sub_category_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Maintenance Category Recycle Checkbox //

              $("#restore_maintenance_category_all").click(function() {

                  $(".restore_maintenance_category_fields").prop('checked', this.checked)
              });

              if ($('.restore_maintenance_category_fields:checked').length == $('.restore_maintenance_category_fields')
                  .length) {
                  $("#restore_maintenance_category_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_maintenance_category_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Maintenance Sub Category Recycle Checkbox //

              $("#restore_maintenance_sub_category_all").click(function() {

                  $(".restore_maintenance_sub_category_fields").prop('checked', this.checked)
              });

              if ($('.restore_maintenance_sub_category_fields:checked').length == $(
                      '.restore_maintenance_sub_category_fields').length) {
                  $("#restore_maintenance_sub_category_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_maintenance_sub_category_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Ownership Recycle Checkbox //

              $("#restore_ownership_all").click(function() {

                  $(".restore_ownership_fields").prop('checked', this.checked)
              });

              if ($('.restore_ownership_fields:checked').length == $('.restore_ownership_fields').length) {
                  $("#restore_ownership_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_ownership_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Drivers Recycle Checkbox //

              $("#restore_drivers_all").click(function() {

                  $(".restore_drivers_fields").prop('checked', this.checked)
              });

              if ($('.restore_drivers_fields:checked').length == $('.restore_drivers_fields').length) {
                  $("#restore_drivers_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_drivers_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Cars Recycle Checkbox //

              $("#restore_cars_all").click(function() {

                  $(".restore_cars_fields").prop('checked', this.checked)
              });

              if ($('.restore_cars_fields:checked').length == $('.restore_cars_fields').length) {
                  $("#restore_cars_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_cars_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //

              //   Role Recycle Checkbox //

              $("#restore_role_all").click(function() {

                  $(".restore_role_fields").prop('checked', this.checked)
              });

              if ($('.restore_role_fields:checked').length == $('.restore_role_fields').length) {
                  $("#restore_role_all").prop('checked', 'true');
                  check_recycle_checkbox();
              } else {
                  $("#restore_role_all").prop('checked', false);
                  $("#restore_permissions").prop('checked', false);
              }


              // --------------------- //



          }
      </script>
  @stop
