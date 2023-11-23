@extends('adminlte::page')
@section('title', 'Role Permissions')
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
                     <h3 class="mb-0">{{ __('adminlte::adminlte.role_permissions') }}</h3>
                     <!-- <a class="btn btn-sm btn-success add-advance-options" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> -->
                  </div>
                  <div class="card-body main_body form p-3">
                     @if (session('status'))
                     <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                     </div>
                     @endif
                     <form id="addRoleForm" method="post", action="{{ route('save_permissions') }}">
                        @csrf
                        <div class="">
                           <div class="role-name">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                       <label for="role_name">Role<span
                                          class="text-danger">*</span></label>
                                       <!-- <input type="hidden" name="role_id" id="role_id"> -->
                                       <select name="role_id" class="form-control" id="role_name">
                                          <option value="" hidden>Select Role</option>
                                          @foreach (@$roles as $role)
                                          @if ($role->id != $admin->role_id)
                                          <option value="{{ $role->id }}">{{ $role->name }}
                                          </option>
                                          @endif
                                          @endforeach
                                       </select>
                                       @if ($errors->has('role_name'))
                                       <div class="form-group">
                                          <div class="error">{{ $errors->first('role_name') }}</div>
                                       </div>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="role-permissions" id="role-permissions">
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
                                 <h5>Users Management</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong class="list-text">Users</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="users_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$usersPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass userscheckBox"
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
                                             class="list-text">Nutritionists</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="nutritionists_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$NutritionistPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass nutritionistcheckBox"
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
                                          <p class="headings"><strong class="list-text">Admins</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="admins_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$adminsPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass  adminscheckBox"
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
                                             class="list-text">Subscribers</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="subscribers_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$subscribersPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass subscriberscheckBox"
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
                              <!-- payments permission -->
                              <div class="title">
                                 <h5>Appointment Management</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong
                                             class="list-text">Appointments</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="appointments_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$AppointmentsPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass appointmentscheckBox"
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
                              <!-- payments permission -->
                              <div class="title">
                                 <h5>Genetic Test Management</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong class="list-text">Genetic
                                             Test</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="test_reports_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$TestReportsPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass testReportscheckBox"
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
                              <!-- payments permission -->
                              <!--   <div class="title">
                                 <h5>Laboratory Management</h5>
                                 <hr />
                                 </div>
                                 
                                 <div class="row permissions-section">
                                 <div class="col-4">
                                     <div class="form-group">
                                         <div class="permissions-section-inner-sec">
                                             <p class="headings"><strong
                                                     class="list-text">Laboratories</strong></p>
                                             <div class="custom_check_wrap">
                                                 <div class="custom-check">
                                                     <input type="checkbox" id="laboratories_permissions"
                                                         class="ckbCheckAll">
                                                     <span></span>
                                                 </div>
                                                 <strong class="list-text">Select All</strong>
                                             </div>
                                             <div id="checkBoxes">
                                                 @foreach (@$LaboratoriesPermissions as $permission)
                                                     <div class="custom_check_wrap">
                                                         <div class="custom-check">
                                                             <input type="checkbox"
                                                                 class="checkBoxClass laboratoriescheckBox"
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
                                 -->
                              <!-- payments permission -->
                              <div class="title">
                                 <h5>Consultation Session</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong class="list-text">Consultation
                                             Session</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="consultation_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$consultationSessionPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass consultationcheckBox"
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
                                 <h5>Consultation Session</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong class="list-text">Consultation
                                             Session</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="consultation_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$consultationSessionPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass consultationcheckBox"
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
                              <!--   <div class="title">
                                 <h5>Clinicians</h5>
                                 <hr />
                                 </div>
                                 
                                 <div class="row permissions-section">
                                 <div class="col-4">
                                     <div class="form-group">
                                         <div class="permissions-section-inner-sec">
                                             <p class="headings"><strong
                                                     class="list-text">Clinicians</strong></p>
                                             <div class="custom_check_wrap">
                                                 <div class="custom-check">
                                                     <input type="checkbox"
                                                         id="referral_patients_permissions"
                                                         class="ckbCheckAll">
                                                     <span></span>
                                                 </div>
                                                 <strong class="list-text">Select All</strong>
                                             </div>
                                             <div id="checkBoxes">
                                                 @foreach (@$referralPatientsPermissions as $permission)
                                                     <div class="custom_check_wrap">
                                                         <div class="custom-check">
                                                             <input type="checkbox"
                                                                 class="checkBoxClass referralPatientsCheckBox"
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
                                 
                                 
                                 
                                 </div> -->
                              <!-- payments permission -->
                              <div class="title">
                                 <h5>User's Feedback</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong
                                             class="list-text">Help & Support</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="help_and_support_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$HelpAndSupportPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass helpAndSupportcheckBox"
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
                                             class="list-text">Testimonials</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="reviews_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$ReviewPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass reviewscheckBox"
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
                                          <p class="headings"><strong class="list-text">Contact
                                             Us</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="contacu_uus_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$contactusPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass contacu_uuscheckBox"
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
                              <!-- payments permission -->
                              <div class="title">
                                 <h5>Payments</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong class="list-text">Payment
                                             Transactions</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox"
                                                   id="payment_transactions_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$paymentTransactionsPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass paymentTransactionscheckBox"
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
                              <!-- payments permission -->
                              <!-- <div class="title">
                                 <h5>Health Complaint</h5>
                                 <hr/>
                                 </div>
                                 
                                 <div class="row permissions-section">
                                 
                                 <div class="col-4">
                                  <div class="form-group">
                                   <div class="permissions-section-inner-sec">
                                    <p class="headings"><strong class="list-text">Diseases</strong></p>
                                    <div class="custom_check_wrap">
                                     <div class="custom-check">
                                      <input type="checkbox" id="referral_patients_permissions" class="ckbCheckAll">
                                      <span></span>
                                   </div>
                                   <strong class="list-text">Select All</strong>
                                 </div>
                                 <div id="checkBoxes">
                                  @foreach (@$DiseasesPermissions as $permission)
                                 <div class="custom_check_wrap">
                                   <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass referralPatientsCheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
                                 <p class="headings"><strong class="list-text">Allergy</strong></p>
                                 <div class="custom_check_wrap">
                                  <div class="custom-check">
                                   <input type="checkbox" id="consultations_permissions" class="ckbCheckAll">
                                   <span></span>
                                 </div>
                                 <strong class="list-text">Select All</strong>
                                 </div>
                                 <div id="checkBoxes">
                                 @foreach (@$AllergiesPermissions as $permission)
                                 <div class="custom_check_wrap">
                                 <div class="custom-check">
                                 <input type="checkbox" class="checkBoxClass consultationsCheCkBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
                                 <p class="headings"><strong class="list-text">Tests</strong></p>
                                 <div class="custom_check_wrap">
                                  <div class="custom-check">
                                   <input type="checkbox" id="tests_permissions" class="ckbCheckAll">
                                   <span></span>
                                 </div>
                                 <strong class="list-text">Select All</strong>
                                 </div>
                                 <div id="checkBoxes">
                                 @foreach (@$TestPermissions as $permission)
                                 <div class="custom_check_wrap">
                                 <div class="custom-check">
                                 <input type="checkbox" class="checkBoxClass testscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
                              <!-- content managements -->
                              <div class="title">
                                 <h5>Content Management</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong class="list-text">Website
                                             Pages</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="website_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$WebsitePermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass websitecheckBox"
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
                                          <p class="headings"><strong class="list-text">Mobile
                                             Pages</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="mobile_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$MobilePermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass mobilecheckBox"
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
                                          <p class="headings"><strong class="list-text">Media</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="media_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$MediaPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass mediacheckBox"
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
                                          <p class="headings"><strong class="list-text">Social
                                             Links</strong>
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
                                             @foreach (@$SociallinksPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass socialLinkscheckBox"
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
                              <!-- content managements -->
                              <div class="title">
                                 <h5>Misc Data Management</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong class="list-text">Blogs</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="blogs_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$BlogPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass blogscheckBox"
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
                                             class="list-text">Laboratories</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="laboratories_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$LaboratoriesPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass laboratoriescheckBox"
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
                                             class="list-text">Clinicians</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox"
                                                   id="referral_patients_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$referralPatientsPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass referralPatientsCheckBox"
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
                                             class="list-text">Specializations</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="specialization_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$SpecializationPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass specializationcheckBox"
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
                                          <p class="headings"><strong class="list-text">Health
                                             Complaints</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox"
                                                   id="project_features_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$ProjectFeaturesPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass projectFeaturescheckBox"
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
                                          <p class="headings"><strong class="list-text">Our
                                             Teams</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="our_teams_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$OurTeamPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass ourTeamscheckBox"
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
                                          <p class="headings"><strong class="list-text">Tests</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="tests_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$TestPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass testscheckBox"
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
                                             class="list-text">Consultations</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="consultations_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$ConsultationsPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass consultationsCheCkBox"
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
                                             class="list-text">Meal Template</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="meal_template_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$mealTemplatePermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass mealTemplateCheCkBox"
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
                                          <p class="headings"><strong class="list-text">Job</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="job_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$jobsPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass jobCheCkBox"
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
                                             class="list-text">Exercises</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="exercises_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$exercisesPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass exercisesCheCkBox"
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
                                             class="list-text">Food</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="food_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$foodPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass foodCheCkBox"
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
                                             class="list-text">Recommended Dietary Allowance</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="rda_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$rdaPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass rdaCheCkBox"
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
                                             class="list-text">Trait Categories</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="trait_category_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$traitCategoryPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass traitCategoryCheCkBox"
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
                                             class="list-text">Traits</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="trait_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$traitPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass traitCheCkBox"
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
                                          <p class="headings"><strong class="list-text">Recipe
                                             Categories</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox"
                                                   id="recipe_category_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$RecipeCategoryPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass recipeCategorycheckBox"
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
                                          <p class="headings"><strong class="list-text">Recipes</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="recipe_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$RecipePermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass recipecheckBox"
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
                                          <p class="headings"><strong class="list-text">Diet
                                             Subscription Features </strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox"
                                                   id="diet_subscription_features_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$dietSubscriptionFeaturesPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass dietSubscriptionFeaturescheckBox"
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
                                          <p class="headings"><strong class="list-text"> Diet
                                             Subscription plans</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox"
                                                   id="subscription_plans_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$DietSubscriptionplansPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass subscriptionPlanscheckBox"
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
                                          <p class="headings"><strong class="list-text"> Diet
                                             Subscription Sub  plans</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox"
                                                   id="subscription_sub_plans_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$DietSubscriptionSubplansPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass subscriptionSubPlanscheckBox"
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
                                 <!--
                                    <div class="col-4">
                                      <div class="form-group">
                                        <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong class="list-text">Diseases</strong></p>
                                          <div class="custom_check_wrap">
                                            <div class="custom-check">
                                              <input type="checkbox" id="referral_patients_permissions" class="ckbCheckAll">
                                              <span></span>
                                           </div>
                                           <strong class="list-text">Select All</strong>
                                        </div>
                                        <div id="checkBoxes">
                                         @foreach (@$DiseasesPermissions as $permission)
                                    <div class="custom_check_wrap">
                                           <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass referralPatientsCheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
                                          <p class="headings"><strong class="list-text">Allergy</strong></p>
                                          <div class="custom_check_wrap">
                                            <div class="custom-check">
                                              <input type="checkbox" id="consultations_permissions" class="ckbCheckAll">
                                              <span></span>
                                           </div>
                                           <strong class="list-text">Select All</strong>
                                        </div>
                                        <div id="checkBoxes">
                                         @foreach (@$AllergiesPermissions as $permission)
                                    <div class="custom_check_wrap">
                                           <div class="custom-check">
                                             <input type="checkbox" class="checkBoxClass consultationsCheCkBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                             <span></span>
                                          </div>
                                          <label class="mb-0">{{ $permission->name }}</label>
                                       </div>
                                    @endforeach
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    -->
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong class="list-text">Diet
                                             Categories</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="diet_category_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$DietCategoryPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass dietCategorycheckBox"
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
                                          <p class="headings"><strong class="list-text">Diets</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="diet_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$DietPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass dietcheckBox"
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
                              <!-- content managements -->
                              <div class="title">
                                 <h5>Settings</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong
                                             class="list-text text-capitalize">Confidential Api
                                             Key</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="api_keys_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$ApiKeyPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass apiKeyscheckBox"
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
                                             class="list-text">Notifications</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="notification_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$NotificationPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass notificationcheckBox"
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
                                          <p class="headings"><strong class="list-text"> Your Health Guide Message</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox"
                                                   id="guide_message_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$GuideMessagePermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass guideMessagecheckBox"
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
                                 <h5>Access Control</h5>
                                 <hr />
                              </div>
                              <div class="row permissions-section">
                                 <div class="col-4">
                                    <div class="form-group">
                                       <div class="permissions-section-inner-sec">
                                          <p class="headings"><strong class="list-text">Roles</strong>
                                          </p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="roles_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$rolesPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass rolescheckBox"
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
                                             class="list-text">Permissions</strong></p>
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox" id="access_permissions"
                                                   class="ckbCheckAll">
                                                <span></span>
                                             </div>
                                             <strong class="list-text">Select All</strong>
                                          </div>
                                          <div id="checkBoxes">
                                             @foreach (@$accessPermissions as $permission)
                                             <div class="custom_check_wrap">
                                                <div class="custom-check">
                                                   <input type="checkbox"
                                                      class="checkBoxClass accesscheckBox"
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
                           <hr>
                           <div class="title">
                              <h5>Recycle Bin</h5>
                              <hr />
                           </div>
                           <div class="row permissions-section">
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="permissions-section-inner-sec">
                                       <p class="headings"><strong class="list-text">Recycle Bin</strong>
                                       </p>
                                       <div class="custom_check_wrap">
                                          <div class="custom-check">
                                             <input type="checkbox" id="restore_role_permissions"
                                                class="ckbCheckAll">
                                             <span></span>
                                          </div>
                                          <strong class="list-text">Select All</strong>
                                       </div>
                                       <div id="checkBoxes">
                                          @foreach (@$role_recyclePermissions as $permission)
                                          <div class="custom_check_wrap">
                                             <div class="custom-check">
                                                <input type="checkbox"
                                                   class="checkBoxClass restore_role_checkBox"
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
                        <!-- /.card-body -->
                        <div class="card-footer pt-0">
                           <button type="submit"
                              class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
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
   #role-permissions label.error {
   color: red !important;
   }
   /*.role-permissions { display:none; } */
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
           $('input').filter(':checkbox').prop('checked', false);
           var role = $(this);
           $("#role_id").val(role.val());
           $(".checkBoxClass").removeAttr('checked');
           var id = $("#role_name").val();
           $.ajax({
               url: "{{ route('get_role_permissions') }}",
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
               role_id: {
                   required: true
               },
               "permissions[]": {
                   required: true
               }
           },
           messages: {
               role_id: {
                   required: "Please Select Any Role."
               },
               "permissions[]": {
                   required: "You must select at least one Permission.",
               }
           }
       });
   });
   
   function checkAll() {
       // FULL ACCESS CHECK
       $("#full_access").click(function() {
           $("input[type=checkbox]").prop('checked', this.checked)
       });
   
       if ($('.checkBoxClass:checked').length == $('.checkBoxClass').length) {
           $("#full_access").prop('checked', 'true');
       } else {
           $("#full_access").prop('checked', false);
       }
   
       // OTHER ACCESS CHECKS
       $("#users_permissions").click(function() {
           $(".userscheckBox").prop('checked', this.checked)
       })
   
       $("#nutritionists_permissions").click(function() {
           $(".nutritionistcheckBox").prop('checked', this.checked)
       })
   
       $("#admins_permissions").click(function() {
           $(".adminscheckBox").prop('checked', this.checked)
       })
   
       $("#appointments_permissions").click(function() {
           $(".appointmentscheckBox").prop('checked', this.checked)
       })
   
       $("#appointments_permissions").click(function() {
           $(".appointmentscheckBox").prop('checked', this.checked)
       })
   
       $("#help_and_support_permissions").click(function() {
           $(".helpAndSupportcheckBox").prop('checked', this.checked)
       })
   
       $("#test_reports_permissions").click(function() {
           $(".testReportscheckBox").prop('checked', this.checked)
       })
   
       // 
   
   
   
   
   
       $("#diet_category_permissions").click(function() {
           $(".dietCategorycheckBox").prop('checked', this.checked)
       })
   
       $("#diet_permissions").click(function() {
           $(".dietcheckBox").prop('checked', this.checked)
       })
   
       $("#reviews_permissions").click(function() {
           $(".reviewscheckBox").prop('checked', this.checked)
       })
   
       $("#consultation_permissions").click(function() {
           $(".consultationcheckBox").prop('checked', this.checked)
       })
   
       $("#contacu_uus_permissions").click(function() {
           $(".contacu_uuscheckBox").prop('checked', this.checked)
       })
   
       $("#subscribers_permissions").click(function() {
           $(".subscriberscheckBox").prop('checked', this.checked)
       })
   
       $("#mobile_permissions").click(function() {
           $(".mobilecheckBox").prop('checked', this.checked)
       })
   
       $("#blogs_permissions").click(function() {
           $(".blogscheckBox").prop('checked', this.checked)
       })
   
       $("#recipe_permissions").click(function() {
           $(".recipecheckBox").prop('checked', this.checked)
       })
   
       $("#recipe_category_permissions").click(function() {
           $(".recipeCategorycheckBox").prop('checked', this.checked)
       })
   
   
   
       // 
       $("#referral_patients_permissions").click(function() {
           $(".referralPatientsCheckBox").prop('checked', this.checked)
       })
   
       $("#consultations_permissions").click(function() {
           $(".consultationsCheCkBox").prop('checked', this.checked)
       })
   
       $("#job_permissions").click(function() {
           $(".jobCheCkBox").prop('checked', this.checked)
       })
   
       $("#exercises_permissions").click(function() {
           $(".exercisesCheCkBox").prop('checked', this.checked)
       })
       // 

       $("#food_permissions").click(function() {
         $(".foodCheCkBox").prop('checked', this.checked)
       })

         $("#meal_template_permissions").click(function() {
         $(".mealTemplateCheCkBox").prop('checked', this.checked)
       })

       $("#rda_permissions").click(function() {
         $(".rdaCheCkBox").prop('checked', this.checked)
     })

       $("#trait_category_permissions").click(function() {
        $(".traitCategoryCheCkBox").prop('checked', this.checked)
     })

       $("#trait_permissions").click(function() {
         $(".traitCheCkBox").prop('checked', this.checked)
     })

       $("#subscription_sub_plans_permissions").click(function() {
         $(".subscriptionSubPlanscheckBox").prop('checked', this.checked)
     })

       $("#guide_message_permissions").click(function() {
         $(".guideMessagecheckBox").prop('checked', this.checked)
     })

       // 
   
       $("#tests_permissions").click(function() {
           $(".testscheckBox").prop('checked', this.checked)
       })
   
   
   
       $("#media_permissions").click(function() {
           $(".mediacheckBox").prop('checked', this.checked)
       })
   
       $("#website_permissions").click(function() {
           $(".websitecheckBox").prop('checked', this.checked)
       })
   
   
       $("#social_links_permissions").click(function() {
           $(".socialLinkscheckBox").prop('checked', this.checked)
       })
   
       $("#subscription_plans_permissions").click(function() {
           $(".subscriptionPlanscheckBox").prop('checked', this.checked)
       })
   
   
       $("#specialization_permissions").click(function() {
           $(".specializationcheckBox").prop('checked', this.checked)
       })
   
       $("#project_features_permissions").click(function() {
           $(".projectFeaturescheckBox").prop('checked', this.checked)
       })
   
       $("#our_teams_permissions").click(function() {
           $(".ourTeamscheckBox").prop('checked', this.checked)
       })
   
       $("#api_keys_permissions").click(function() {
           $(".apiKeyscheckBox").prop('checked', this.checked)
       })
   
       $("#notification_permissions").click(function() {
           $(".notificationcheckBox").prop('checked', this.checked)
       })
   
   
   
   
       $("#roles_permissions").click(function() {
           $(".rolescheckBox").prop('checked', this.checked)
       })
       $("#access_permissions").click(function() {
           $(".accesscheckBox").prop('checked', this.checked)
       })
       $("#recycle_admin_permissions").click(function() {
           $(".restore_admin_checkBox").prop('checked', this.checked)
       })
       $("#restore_role_permissions").click(function() {
           $(".restore_role_checkBox").prop('checked', this.checked)
       })
       $("#website_permissions").click(function() {
           $(".websitecheckBox").prop('checked', this.checked)
       })
       $("#mobile_permissions").click(function() {
           $(".mobilecheckBox").prop('checked', this.checked)
       })
   
       $("#payment_transactions_permissions").click(function() {
           $(".paymentTransactionscheckBox").prop('checked', this.checked)
       })
   
       $("#diet_subscription_features_permissions").click(function() {
           $(".dietSubscriptionFeaturescheckBox").prop('checked', this.checked)
       })
   
       $("#feedback_permissions").click(function() {
           $(".feedbackcheckBox").prop('checked', this.checked)
       })
   
       $("#contactus_permissions").click(function() {
           $(".contactuscheckBox").prop('checked', this.checked)
       })
   
       /* *********************************************** */
   
       /* *********************************************** */
   
       if ($('.userscheckBox:checked').length == $('.userscheckBox').length) {
           $("#users_permissions").prop('checked', 'true');
       } else {
           $("#users_permissions").prop('checked', false);
       }
   
       // instructors
       if ($('.nutritionistcheckBox:checked').length == $('.nutritionistcheckBox').length) {
           $("#nutritionists_permissions").prop('checked', 'true');
       } else {
           $("#nutritionists_permissions").prop('checked', false);
       }
       // instructors
   
   
       if ($('.adminscheckBox:checked').length == $('.adminscheckBox').length) {
           $("#admins_permissions").prop('checked', 'true');
       } else {
           $("#admins_permissions").prop('checked', false);
       }
   
       if ($('.appointmentscheckBox:checked').length == $('.appointmentscheckBox').length) {
           $("#appointments_permissions").prop('checked', 'true');
       } else {
           $("#appointments_permissions").prop('checked', false);
       }
   
   
       if ($('.helpAndSupportcheckBox:checked').length == $('.helpAndSupportcheckBox').length) {
           $("#help_and_support_permissions").prop('checked', 'true');
       } else {
           $("#help_and_support_permissions").prop('checked', false);
       }
   
   
       if ($('.testReportscheckBox:checked').length == $('.testReportscheckBox').length) {
           $("#test_reports_permissions").prop('checked', 'true');
       } else {
           $("#test_reports_permissions").prop('checked', false);
       }
   
   
       // students 2
       if ($('.laboratoriescheckBox:checked').length == $('.laboratoriescheckBox').length) {
           $("#laboratories_permissions").prop('checked', 'true');
       } else {
           $("#laboratories_permissions").prop('checked', false);
       }
   
   
       // 
   
   
   
   
       if ($('.dietCategorycheckBox:checked').length == $('.dietCategorycheckBox').length) {
           $("#diet_category_permissions").prop('checked', 'true');
       } else {
           $("#diet_category_permissions").prop('checked', false);
       }
   
       if ($('.dietcheckBox:checked').length == $('.dietcheckBox').length) {
           $("#diet_permissions").prop('checked', 'true');
       } else {
           $("#diet_permissions").prop('checked', false);
       }
   
   
       if ($('.reviewscheckBox:checked').length == $('.reviewscheckBox').length) {
           $("#reviews_permissions").prop('checked', 'true');
       } else {
           $("#reviews_permissions").prop('checked', false);
       }
   
       if ($('.consultationcheckBox:checked').length == $('.consultationcheckBox').length) {
           $("#consultation_permissions").prop('checked', 'true');
       } else {
           $("#consultation_permissions").prop('checked', false);
       }
   
   
       if ($('.contacu_uuscheckBox:checked').length == $('.contacu_uuscheckBox').length) {
           $("#contacu_uus_permissions").prop('checked', 'true');
       } else {
           $("#contacu_uus_permissions").prop('checked', false);
       }
   
   
       if ($('.subscriberscheckBox:checked').length == $('.subscriberscheckBox').length) {
           $("#subscribers_permissions").prop('checked', 'true');
       } else {
           $("#subscribers_permissions").prop('checked', false);
       }
   
   
       if ($('.mobilecheckBox:checked').length == $('.mobilecheckBox').length) {
           $("#mobile_permissions").prop('checked', 'true');
       } else {
           $("#mobile_permissions").prop('checked', false);
       }
   
   
       if ($('.blogscheckBox:checked').length == $('.blogscheckBox').length) {
           $("#blogs_permissions").prop('checked', 'true');
       } else {
           $("#blogs_permissions").prop('checked', false);
       }
   
   
       if ($('.recipecheckBox:checked').length == $('.recipecheckBox').length) {
           $("#recipe_permissions").prop('checked', 'true');
       } else {
           $("#recipe_permissions").prop('checked', false);
       }
   
       if ($('.recipeCategorycheckBox:checked').length == $('.recipeCategorycheckBox').length) {
           $("#recipe_category_permissions").prop('checked', 'true');
       } else {
           $("#recipe_category_permissions").prop('checked', false);
       }
   
   
       // 
       // students 2
   
       // reports
       if ($('.referralPatientsCheckBox:checked').length == $('.referralPatientsCheckBox').length) {
           $("#referral_patients_permissions").prop('checked', 'true');
       } else {
           $("#referral_patients_permissions").prop('checked', false);
       }
       // reports
   
   
   
   
       if ($('.consultationsCheCkBox:checked').length == $('.consultationsCheCkBox').length) {
           $("#consultations_permissions").prop('checked', 'true');
       } else {
           $("#consultations_permissions").prop('checked', false);
       }
   
       if ($('.jobCheCkBox:checked').length == $('.jobCheCkBox').length) {
           $("#job_permissions").prop('checked', 'true');
       } else {
           $("#job_permissions").prop('checked', false);
       }
   
       if ($('.exercisesCheCkBox:checked').length == $('.exercisesCheCkBox').length) {
           $("#exercises_permissions").prop('checked', 'true');
       } else {
           $("#exercises_permissions").prop('checked', false);
       }
      
      // 
        if ($('.foodCheCkBox:checked').length == $('.foodCheCkBox').length) {
           $("#food_permissions").prop('checked', 'true');
       } else {
           $("#food_permissions").prop('checked', false);
       }

          if ($('.mealTemplateCheCkBox:checked').length == $('.mealTemplateCheCkBox').length) {
           $("#meal_template_permissions").prop('checked', 'true');
       } else {
           $("#meal_template_permissions").prop('checked', false);
       }

       if ($('.rdaCheCkBox:checked').length == $('.rdaCheCkBox').length) {
           $("#rda_permissions").prop('checked', 'true');
       } else {
           $("#rda_permissions").prop('checked', false);
       }

       if ($('.traitCategoryCheCkBox:checked').length == $('.traitCategoryCheCkBox').length) {
           $("#trait_category_permissions").prop('checked', 'true');
       } else {
           $("#trait_category_permissions").prop('checked', false);
       }

       if ($('.traitCheCkBox:checked').length == $('.traitCheCkBox').length) {
           $("#trait_permissions").prop('checked', 'true');
       } else {
           $("#trait_permissions").prop('checked', false);
       }


       if ($('.subscriptionSubPlanscheckBox:checked').length == $('.subscriptionSubPlanscheckBox').length) {
           $("#subscription_sub_plans_permissions").prop('checked', 'true');
       } else {
           $("#subscription_sub_plans_permissions").prop('checked', false);
       }

       // 
   
       if ($('.guideMessagecheckBox:checked').length == $('.guideMessagecheckBox').length) {
           $("#guide_message_permissions").prop('checked', 'true');
       } else {
           $("#guide_message_permissions").prop('checked', false);
       }
   
   
       if ($('.mediacheckBox:checked').length == $('.mediacheckBox').length) {
           $("#media_permissions").prop('checked', 'true');
       } else {
           $("#media_permissions").prop('checked', false);
       }
   
       if ($('.websitecheckBox:checked').length == $('.websitecheckBox').length) {
           $("#website_permissions").prop('checked', 'true');
       } else {
           $("#website_permissions").prop('checked', false);
       }
   
   
       if ($('.socialLinkscheckBox:checked').length == $('.socialLinkscheckBox').length) {
           $("#social_links_permissions").prop('checked', 'true');
       } else {
           $("#social_links_permissions").prop('checked', false);
       }
   
       if ($('.subscriptionPlanscheckBox:checked').length == $('.subscriptionPlanscheckBox').length) {
           $("#subscription_plans_permissions").prop('checked', 'true');
       } else {
           $("#subscription_plans_permissions").prop('checked', false);
       }
   
       if ($('.specializationcheckBox:checked').length == $('.specializationcheckBox').length) {
           $("#specialization_permissions").prop('checked', 'true');
       } else {
           $("#specialization_permissions").prop('checked', false);
       }
   
   
   
       if ($('.projectFeaturescheckBox:checked').length == $('.projectFeaturescheckBox').length) {
           $("#project_features_permissions").prop('checked', 'true');
       } else {
           $("#project_features_permissions").prop('checked', false);
       }
   
       if ($('.ourTeamscheckBox:checked').length == $('.ourTeamscheckBox').length) {
           $("#our_teams_permissions").prop('checked', 'true');
       } else {
           $("#our_teams_permissions").prop('checked', false);
       }
   
       if ($('.apiKeyscheckBox:checked').length == $('.apiKeyscheckBox').length) {
           $("#api_keys_permissions").prop('checked', 'true');
       } else {
           $("#api_keys_permissions").prop('checked', false);
       }
   
       if ($('.notificationcheckBox:checked').length == $('.notificationcheckBox').length) {
           $("#notification_permissions").prop('checked', 'true');
       } else {
           $("#notification_permissions").prop('checked', false);
       }
   
   
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
   
       if ($('.restore_admin_checkBox:checked').length == $('.restore_admin_checkBox').length) {
           $("#recycle_admin_permissions").prop('checked', 'true');
       } else {
           $("#recycle_admin_permissions").prop('checked', false);
       }
   
       if ($('.restore_role_checkBox:checked').length == $('.restore_role_checkBox').length) {
           $("#restore_role_permissions").prop('checked', 'true');
       } else {
           $("#restore_role_permissions").prop('checked', false);
       }
   
   
   
       if ($('.mobilecheckBox:checked').length == $('.mobilecheckBox').length) {
           $("#mobile_permissions").prop('checked', 'true');
       } else {
           $("#mobile_permissions").prop('checked', false);
       }
   
   
       if ($('.feedbackcheckBox:checked').length == $('.feedbackcheckBox').length) {
           $("#feedback_permissions").prop('checked', 'true');
       } else {
           $("#feedback_permissions").prop('checked', false);
       }
   
       if ($('.dietSubscriptionFeaturescheckBox:checked').length == $('.dietSubscriptionFeaturescheckBox').length) {
           $("#diet_subscription_features_permissions").prop('checked', 'true');
       } else {
           $("#diet_subscription_features_permissions").prop('checked', false);
       }
   
   
       if ($('.paymentTransactionscheckBox:checked').length == $('.paymentTransactionscheckBox').length) {
           $("#payment_transactions_permissions").prop('checked', 'true');
       } else {
           $("#payment_transactions_permissions").prop('checked', false);
       }
   
       if ($('.contactuscheckBox:checked').length == $('.contactuscheckBox').length) {
           $("#contactus_permissions").prop('checked', 'true');
       } else {
           $("#contactus_permissions").prop('checked', false);
       }
   
   }
</script>
@stop
