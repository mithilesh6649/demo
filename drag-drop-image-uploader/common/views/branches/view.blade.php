@extends('adminlte::page')

@section('title', 'Super Admin | Branch Details')

@section('content_header')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Branch Details</h3>
                            <label class="mb-0">{{ $branch->title_en ?? 'N/A' }} ( {{ $branch->title_ar ?? 'N/A' }}
                                )</label>
                            <a class="btn btn-sm btn-success"
                                href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body p-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="tab_wrapper branchs">
                                <ul class="nav nav-pills branch-details mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link nav_link active" id="pills-home-tab" data-toggle="pill"
                                            href="#pills-home" role="tab" aria-controls="pills-home"
                                            aria-selected="true">Branch</a>
                                    </li>

                                    <li class="nav-item ">
                                        <a class="nav-link nav_link" id="pills-images-tab" data-toggle="pill"
                                            href="#pills-images" role="tab" aria-controls="pills-images"
                                            aria-selected="false">Info</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link" id="pills-persmissions-tab" data-toggle="pill"
                                            href="#pills-persmissions" role="tab" aria-controls="pills-permissions"
                                            aria-selected="false">Persmission</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link" id="pills-localities-tab" data-toggle="pill"
                                            href="#pills-localities" role="tab" aria-controls="pills-localities"
                                            aria-selected="false">Localities</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link" id="pills-category-tab" data-toggle="pill"
                                            href="#pills-category" role="tab" aria-controls="pills-category"
                                            aria-selected="false">Menu Category</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link" id="pills-items-tab" data-toggle="pill"
                                            href="#pills-items" role="tab" aria-controls="pills-items"
                                            aria-selected="false">Menu Items</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link" id="pills-transactions-tab" data-toggle="pill"
                                            href="#pills-transactions" role="tab" aria-controls="pills-transactions"
                                            aria-selected="false">Managers</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link" id="pills-staff-tab" data-toggle="pill"
                                            href="#pills-staff" role="tab" aria-controls="pills-staff"
                                            aria-selected="false">Staffs</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link" id="pills-cars-tab" data-toggle="pill"
                                            href="#pills-cars" role="tab" aria-controls="pills-cars"
                                            aria-selected="false">Cars</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link" id="pills-drivers-tab" data-toggle="pill"
                                            href="#pills-drivers" role="tab" aria-controls="pills-drivers"
                                            aria-selected="false">Drivers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav_link" data-toggle="pill"
                                            id="pills-table-qr-tab"
                                            href="#pills-tableqr"
                                            aria-controls="pills-tableqr" aria-selected="true">Table QR Details</a>
                                    </li>

                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <form method="post" >
                                            @csrf
                                            <div class="card-body table form mb-0">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12 d-none">
                                                        <div class="form-group">
                                                            <label for="first_name">Image <span class="text-danger">
                                                                    *</span></label>
                                                            <input type="file" accept="image/*" name="profile_picture"
                                                                id="profile_picture" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label for="title_en">Title {{ labelEnglish() }} </label>
                                                            <input type="text" name="title_en" class="form-control"
                                                                id="title_en" maxlength="100"
                                                                style="background-color:white;border:1px solid #dfe1eb;"
                                                                value="{{ $branch->title_en ?? 'N/A' }}" readonly>

                                                            @if ($errors->has('title_en'))
                                                                <div class="error">{{ $errors->first('title_en') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label for="title_ar">Title{{ labelArabic() }} </label>
                                                            <input type="text" name="title_ar" class="form-control"
                                                                id="title_ar" maxlength="100"
                                                                value="{{ $branch->title_ar ?? 'N/A' }}" readonly>

                                                            @if ($errors->has('title_ar'))
                                                                <div class="error">{{ $errors->first('title_ar') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 d-none">
                                                        <div class="form-group">
                                                            <label for="first_name">Name {{ labelEnglish() }} </label>
                                                            <input type="text" value=" " name="name_en"
                                                                class="form-control" id="name" maxlength="100">

                                                            @if ($errors->has('name'))
                                                                <div class="error">{{ $errors->first('name') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 d-none">
                                                        <div class="form-group">
                                                            <label for="first_name">Name{{ labelArabic() }} </label>
                                                            <input type="text" value=" " name="name_ar"
                                                                class="form-control" id="name" maxlength="100">

                                                            @if ($errors->has('name'))
                                                                <div class="error">{{ $errors->first('name') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="description_en">Description {{ labelEnglish() }}
                                                            </label>
                                                            <textarea disabled name="description_en" class="form-control" id="description_en" maxlength="100"
                                                                style="height: 100px;">{{ $branch->description_en ?? 'N/A' }}</textarea>
                                                            @if ($errors->has('description_en'))
                                                                <div class="error">{{ $errors->first('description_en') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="description_ar">Description {{ labelArabic() }}
                                                            </label>
                                                            <textarea disabled name="description_ar" class="form-control" id="description_ar" maxlength="100"
                                                                style="height: 100px;">{{ $branch->description_ar ?? 'N/A' }}</textarea>
                                                            @if ($errors->has('description_ar'))
                                                                <div class="error">{{ $errors->first('description_ar') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="country_code">Country Code </label>
                                                            <input type="tel" name="country_code"
                                                                class="form-control" id="country_code"
                                                                placeholder="{{ $branch->country ?? 'N/A' }}">

                                                            @if ($errors->has('country_code'))
                                                                <div class="error">{{ $errors->first('country_code') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="password">Contact Number 1</label>
                                                            <br>
                                                            <input style="width:100%l" type="tel" name="phone_number"
                                                                class="form-control " id="txtPhone" autocomplete="false"
                                                                value="{{ $branch->phone_number ?? 'N/A' }}" readonly>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="password">Contact Number 2</label>
                                                            <br>
                                                            <input style="width:100%l" type="tel" name="phone_number"
                                                                class="form-control " id="txtPhone" autocomplete="false"
                                                                value="{{ $branch->secondary_phone_number ?? 'N/A' }}"
                                                                readonly>

                                                        </div>
                                                    </div>



                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="password">WhatsApp Number </label>
                                                            <br>
                                                            <input style="width:100%" type="tel"
                                                                name="whatsapp_number" class="form-control "
                                                                id="WhatsAppNumber" autocomplete="false"
                                                                value="{{ $branch->whatsapp_number ?? '' }}" readonly>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12   ">
                                                        <div class="form-group mt-3">
                                                            <label for="first_name">Email</label>
                                                            <input name="email" class="form-control" id="email"
                                                                value="{{ $branch->email ?? 'N/A' }}" readonly>
                                                            @if ($errors->has('name'))
                                                                <div class="error">{{ $errors->first('name') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-6    ">
                                                        <div class="form-group mt-3">
                                                            <label for="address">Address</label>
                                                            <textarea disabled name="address" class="form-control" id="address" maxlength="100" style="height:60px;">{{ $branch->address ?? 'N/A' }}
                         </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 ">
                                                        <div class="form-group mt-3">
                                                            <label for="email">Map link</label>
                                                            <div style="position:relative;">
                                                                <input type="url" name="map_link"
                                                                    class="form-control" id="map_link"
                                                                    value="{{ $branch->map_link ?? 'N/A' }}" readonly>
                                                                <div style="position:absolute;top:18px;right:10px;"
                                                                    class="{{ $branch->map_link ?? 'd-none' }}">
                                                                    <a href="{{ $branch->map_link ?? 'N/A' }}"
                                                                        target="_blank">Click for view</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 ">
                                                        <div class="form-group mt-3">
                                                            <label for="email">Tour link</label>
                                                            <div style="position:relative;">
                                                                <input type="url" name="map_link"
                                                                    class="form-control" id="map_link"
                                                                    value="{{ $branch->tour_link ?? 'N/A' }}" readonly>
                                                                <div style="position:absolute;top:18px;right:10px;"
                                                                    class="{{ $branch->tour_link ?? 'd-none' }}">
                                                                    <a href="{{ $branch->tour_link ?? 'N/A' }}"
                                                                        target="_blank">Click for view</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>





                                                    <div class="col-md-6 col-sm-6 col-12 mt-3">
                                                        <div
                                                            class="form-group pdf {{ $branch->branch_pdf != null ? '' : 'd-none' }}">
                                                            <label class="d-block">Branch Pdf</label>
                                                            <a href="{{ url('branch_images/pdf') }}/{{ $branch->branch_pdf }}"
                                                                target="_blank"><i
                                                                    class="fas fa-file-pdf fa-10x text-danger"
                                                                    style="font-size:120px;"></i></a>
                                                        </div>

                                                        <div
                                                            class="form-group pdf {{ $branch->branch_pdf == null ? '' : 'd-none' }}">
                                                            <label class="d-block">Branch Pdf</label>
                                                            <input type="url" name="branch_pdf" class="form-control"
                                                                id="map_link" value="{{ $branch->branch_pdf ?? 'N/A' }}"
                                                                readonly>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                                                        <div class="form-group mt-3">
                                                            <label for="password">Branch City </label>
                                                            <select class=" form-control advance_category_search catselect"
                                                                name="city_id" disabled>
                                                                <option value="">Select Branch City</option>
                                                                @forelse ($city_list as $city)
                                                                    <option value="{{ $city->id }}"
                                                                        {{ $branch->city_id == $city->id ? 'selected' : '' }}>
                                                                        {{ $city->city }}</option>
                                                                @empty
                                                                    <option class="disabled">City not found</option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>



                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                        <div class="form-group mt-3">
                                                            <label>Managers </label>
                                                            <select disabled data-placeholder="Select Managers" multiple
                                                                class="chosen-select form-control" name="managers_id[]"
                                                                id="managers">

                                                                @forelse ($managers as $manager)
                                                                    <option value="{{ $manager->id }}"
                                                                        @foreach ($in_session_managers as $mm)
                              @if ($mm['user_id'] == $manager->id)
                              selected
                              @endif @endforeach>
                                                                        {{ $manager->first_name ?? ' ' }}
                                                                        {{ $manager->last_name }} ( {{ $manager->email }}
                                                                        ) - {{ $manager->BranchRole->role_name }}</option>
                                                                @empty
                                                                    <option disabled>Branch Manager's not added yet
                                                                    </option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 d-none ">
                                                        <div class="form-group mt-3">
                                                            <label>Managers<span class="text-danger"> *</span></label>
                                                            <select data-placeholder="Select Managers" multiple
                                                                class="chosen-select form-control" name="managers_id[]"
                                                                id="managers">
                                                                <option value="" disabled>Select Managers</option>
                                                                @if (isset($managers))
                                                                    @forelse ($managers as $manager)
                                                                        <option value="{{ $manager->id }}">
                                                                            {{ $manager->first_name ?? '' }}
                                                                            {{ $manager->last_name }} -
                                                                            {{ $manager->email }}</option>
                                                                    @empty
                                                                        <option disabled>Please add manager</option>
                                                                    @endforelse
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                 <div class="form-group mt-3">
                                    <label for="email">Status</label>
                                    <div class="form-group radio">
                                     <select disabled class="form-control" name="status">
                                       <option value="1" {{ $branch->status == 1 ? 'selected' : '' }}>Active</option>
                                       <option  value="0" {{ $branch->status == 0 ? 'selected' : '' }}>Inactive</option>
                                     </select>
                                    </div>
                                 </div>
                              </div>  -->


                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12 mt-3">
                                                        <div class="form-group ">
                                                            <label for="status">Status </label>
                                                            <select class="form-control" name="status" id="status"
                                                                disabled>
                                                                @foreach ($status as $status_data)
                                                                    <option value="{{ $status_data->value }}"
                                                                        {{ $status_data->value == $branch->status ? 'selected' : '' }}>
                                                                        {{ $status_data->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    {{-- Big Image --}}

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                                        <div class="form-group mt-3">
                                                            <label>Branch Big Image</label>
                                                            @if ($errors->has('branch_image'))
                                                                <div class="error">{{ $errors->first('branch_image') }}
                                                                </div>
                                                            @endif
                                                            <div class="upload-img {{ @$branch->BranchBigImages->image_name != null ? '' : 'd-none' }}"
                                                                style="position:relative;width:250px;">
                                                                <input type="hidden" name="old_big_image_name"
                                                                    value="{{ @$branch->BranchBigImages->image_name }}">
                                                                <img src="{{ url('branch_images') }}/{{ @$branch->BranchBigImages->image_name }}"
                                                                    id="branch_image_preview"
                                                                    class="{{ @$branch->BranchBigImages->image_name != null ? '' : 'd-none' }} ">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- ---------------------- --}}

                                                    {{-- Small Image --}}

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                                        <div class="form-group mt-3">
                                                            <label>Branch Small Image (Size: 374 X 200)</label>
                                                            @if ($errors->has('branch_small_image'))
                                                                <div class="error">
                                                                    {{ $errors->first('branch_small_image') }}
                                                                </div>
                                                            @endif
                                                            <div class="upload-small-img {{ @$branch->BranchSmallImages->image_name != null ? '' : 'd-none' }}"
                                                                style="position:relative;width:250px;">
                                                                <input type="hidden" name="old_small_image_name"
                                                                    value="{{ @$branch->BranchSmallImages->image_name }}">
                                                                <img src="{{ url('branch_small_images') }}/{{ @$branch->BranchSmallImages->image_name }}"
                                                                    id="branch_small_image_preview"
                                                                    class="{{ @$branch->BranchSmallImages->image_name != null ? '' : 'd-none' }} ">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- ------------ --}}

                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Branch Image
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">
                                                                    ×
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" class="image_preview">
                                                            <div id="carouselExampleControls" class="carousel slide"
                                                                data-ride="carousel">
                                                                <div class="carousel-inner"
                                                                    style=" width:100%; height:400px !important;">

                                                                    @foreach ($branch->BranchImages as $key => $images)
                                                                        <div class="carousel-item show_image_id"
                                                                            show_image_id='{{ $key }}'>
                                                                            <img class="d-block "
                                                                                style="width: 100%; height: 400px;"
                                                                                src="{{ url('branch_images' . '/' . $images->image_name) }}"
                                                                                alt="First slide">
                                                                        </div>
                                                                    @endforeach
                                                                </div>

                                                                <a class="carousel-control-prev"
                                                                    href="#carouselExampleControls" role="button"
                                                                    data-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next"
                                                                    href="#carouselExampleControls" role="button"
                                                                    data-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!---fsdfdsfd---->

                                        </form>
                                    </div>


                                    <!--Start Branch Images -->
                                    <div class="tab-pane fade" id="pills-images" role="tabpanel"
                                        aria-labelledby="pills-images-tab">
                                        <form class="form_wrap" id="addAdditionalInformation" method="post"
                                            action="{{ route('branch.info.save') }}">
                                            <div class="row">
                                                <!--     <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>Minimum order amount </label>
                              <input type="number" class="form-control" name="minimum_order_amount" maxlength="100" value="{{ $branch->minimum_order_amount ?? '0' }}" readonly />

                            </div>
                          </div>  -->



                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label>Cuisines </label>
                                                        <input type="text" class="form-control" name="cuisins"
                                                            maxlength="100" value="{{ $branch->cuisins ?? 'N/A' }}"
                                                            readonly />

                                                    </div>


                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group  ">
                                                        <label>Rating </label>
                                                        <textarea id="rating" class="form-control" name="rating" maxlength="500" disabled>{{ $branch->rating ?? 'N/A' }}</textarea>
                                                    </div>
                                                </div>




                                                {{-- <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group">
                                                        <label>Delivery Time ( in Min) </label>
                                                        <input type="text" class="form-control"
                                                            name="branch_delivery_time" maxlength="100"
                                                            value="{{ $branch->branch_delivery_time ?? '' }}" readonly />

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group">
                                                        <label>Pickup Time ( in Min) </label>
                                                        <input type="text" class="form-control"
                                                            name="branch_pickup_time" maxlength="100"
                                                            value="{{ $branch->branch_pickup_time ?? '' }}" readonly />

                                                    </div>
                                                </div> --}}


                                            </div>
                                            <div class="row mb-3">


                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group mt-3">
                                                        <label>Pre-Order </label>
                                                        <select class="form-control" name="accepts_pre_order" disabled>
                                                            <option value="">Select Pre Order</option>
                                                            <option value="1"
                                                                {{ $branch->accepts_pre_order == 1 ? 'selected' : '' }}>Yes
                                                            </option>
                                                            <option value="0"
                                                                {{ $branch->accepts_pre_order == 0 ? 'selected' : '' }}>No
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <span class="font-weight-bold"> Opening days</span>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr style="background: #f1f3f4; border-bottom: 1px solid #dee2e6;">
                                                        <th class="color_header">Days</th>
                                                        <th class="color_header text-center">Start time</th>
                                                        <th class="color_header text-right">End time</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="background: #fff;">


                                                    @forelse ($BranchWorkingHour as $BranchWorkingTimings)
                                                        <tr>
                                                            <td class="heading_weight text-capitalize">
                                                                {{ $BranchWorkingTimings->days ?? '' }}</td>
                                                            <td class="text-center heading_space">
                                                                {{ date('h:i A', strtotime($BranchWorkingTimings->starting_hour)) }}
                                                                <svg fill="#ffca33" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 32 32" width="20px" height="20px"
                                                                    style="vertical-align:sub;">
                                                                    <path
                                                                        d="M 16 4 C 9.382813 4 4 9.382813 4 16 C 4 22.617188 9.382813 28 16 28 C 22.617188 28 28 22.617188 28 16 C 28 9.382813 22.617188 4 16 4 Z M 16 6 C 21.535156 6 26 10.464844 26 16 C 26 21.535156 21.535156 26 16 26 C 10.464844 26 6 21.535156 6 16 C 6 10.464844 10.464844 6 16 6 Z M 15 8 L 15 17 L 22 17 L 22 15 L 17 15 L 17 8 Z" />
                                                                </svg>
                                                            </td>
                                                            <td class="text-right heading_space">
                                                                {{ date('h:i A', strtotime($BranchWorkingTimings->ending_hour)) }}
                                                                <svg fill="#ffca33" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 32 32" width="20px" height="20px"
                                                                    style="vertical-align:sub;">
                                                                    <path
                                                                        d="M 16 4 C 9.382813 4 4 9.382813 4 16 C 4 22.617188 9.382813 28 16 28 C 22.617188 28 28 22.617188 28 16 C 28 9.382813 22.617188 4 16 4 Z M 16 6 C 21.535156 6 26 10.464844 26 16 C 26 21.535156 21.535156 26 16 26 C 10.464844 26 6 21.535156 6 16 C 6 10.464844 10.464844 6 16 6 Z M 15 8 L 15 17 L 22 17 L 22 15 L 17 15 L 17 8 Z" />
                                                                </svg>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>

                                                            <th colspan="3" class="text-center">N/A</th>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>





                                        </form>

                                    </div>



                                    <!-- End Branch Images -->


                                    <!--Start Menu Items -->
                                    <div class="tab-pane fade" id="pills-items" role="tabpanel"
                                        aria-labelledby="pills-items-tab" onclick="return false">

                                        <div class="card-body table form Items mb-0 p-0">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            <table style="width:100%" id="menu-list"
                                                class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="display-none"></th>

                                                        <th>Item Name (en)</th>
                                                        <th>Item Name (ar)</th>
                                                        <th>Category</th>
                                                        <th>Price</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    @foreach ($branchMenuItems as $menus)
                                                        <tr>
                                                            <th class="display-none"></th>
                                                            <td> {{ @$menus->menuItems[0]->item_name_en ?? 'N/A' }}</td>
                                                            <td> {{ @$menus->menuItems[0]->item_name_ar ?? 'N/A' }}</td>
                                                            <td> {{ @$menus->menuItems[0]->menuCategory->name_en ?? 'N/A' }}
                                                            </td>
                                                            <td>KD {{ @$menus->menuItems[0]->price ?? '0' }}</td>



                                                            <td>
                                                                @if ($menus->status == 1)
                                                                    <span
                                                                        class="badge badge-pill badge-success">Available</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-pill badge-danger">Unavailable</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>



                                    </div>



                                    <!-- End Menu Items -->




                                    <!--Start Menu Category -->
                                    <div class="tab-pane fade" id="pills-category" role="tabpanel"
                                        aria-labelledby="pills-category-tab" onclick="return false">

                                        <div class="card-body table form Items mb-0 p-0">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            <table style="width:100%" id="menu-category-list"
                                                class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="display-none"></th>

                                                        <th>Menu Category (en)</th>
                                                        <th>Menu Category (ar)</th>

                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    @foreach ($branchMenuCategory as $branchMenuCat)
                                                        <tr>
                                                            <th class="display-none"></th>
                                                            <td> {{ @$branchMenuCat->menuCategory[0]->name_en ?? 'N/A' }}
                                                            </td>
                                                            <td> {{ @$branchMenuCat->menuCategory[0]->name_ar ?? 'N/A' }}
                                                            </td>




                                                            <td>
                                                                @if ($branchMenuCat->status == 1)
                                                                    <span
                                                                        class="badge badge-pill badge-success">Available</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-pill badge-danger">Unavailable</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>



                                    </div>



                                    <!-- End Menu Category -->




                                    <!--  Start branch_localities -->
                                    <div class="tab-pane fade" id="pills-localities" role="tabpanel"
                                        aria-labelledby="pills-localities-tab" onclick="return false">


                                        <div class="alert d-none" role="alert" id="flash-message">
                                        </div>


                                        <div class="card-body table form items mb-0">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert"> {{ session('status') }}
                                                </div>
                                            @endif
                                            <table style="width:100%" id="localities-list"
                                                class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>

                                                        <th>City</th>
                                                        <th>Delivery Fee</th>
                                                        <th>Minimum Order Amount</th>
                                                        <th>Delivery Time(minutes)</th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    @foreach ($branchLocalities as $localities)
                                                        <tr>

                                                            <td>{{ @$localities->city->city ?? 'N/A' }}
                                                                {{ $localities->city->city_ar ?? ' ' }}</td>
                                                            <td>{{ @$localities->delivery_fee ?? '0' }} KD</td>
                                                            <td>{{ @$localities->minimum_order_amount ?? '0' }} KD</td>
                                                            <td>{{ @$localities->delivery_time ?? '0' }}</td>

                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>
                                        </div>


                                    </div>



                                    <!--branch_localities Menu Items -->







                                    <div class="tab-pane fade" id="pills-persmissions" role="tabpanel"
                                        aria-labelledby="pills-permissions-tab" onclick="return false">


                                        <form class="form-wrap" method="post"
                                            action="{{ route('branch.permission.update') }}">
                                            @csrf
                                            @csrf
                                            <input type="hidden" name="branch_id" value="{{ $branch->id }}"
                                                id='branch_id_permissions'>


                                            <!--start mk permission coding-->

                                            <div class="container ">
                                                <div class="row permissions-section">

                                                    @foreach ($branch_roles as $branchRole)
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <div class="permissions-section-inner-sec">
                                                                    <p class="headings"><strong
                                                                            class="ldist-text">{{ $branchRole->role_name }}</strong>
                                                                    </p>
                                                                    <div class="custom_check_wrap">
                                                                        <div class="custom-check">
                                                                            <input type="checkbox"
                                                                                id="appusers_permissions"
                                                                                class="checkAllPermission" name="roles[]">
                                                                            <span></span>
                                                                        </div>
                                                                        <strong class="list-text">Select All</strong>
                                                                    </div>
                                                                    <div id="checkBoxes" class="AllPermissionBox">

                                                                        @foreach ($all_branches_permissions as $branchPermission)
                                                                            <div class="custom_check_wrap">
                                                                                <div class="custom-check">
                                                                                    <input type="checkbox"
                                                                                        class="checkBoxClass permissionsName"
                                                                                        name="{{ $branchPermission->slug }}[]"
                                                                                        permission-name="{{ $branchPermission->slug }}"
                                                                                        branches-permission-id="{{ $branchPermission->id }}"
                                                                                        role-id="{{ $branchRole->id }}"
                                                                                        @if ($branchRole->id == 1 && in_array($branchPermission->id, $manager_permissions)) checked @endif
                                                                                        @if ($branchRole->id == 2 && in_array($branchPermission->id, $desk1_permissions)) checked @endif
                                                                                        @if ($branchRole->id == 3 && in_array($branchPermission->id, $desk2_permissions)) checked @endif>
                                                                                    <span></span>
                                                                                </div>
                                                                                <label
                                                                                    class="mb-0">{{ $branchPermission->name }}</label>
                                                                            </div>
                                                                        @endforeach



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>


                                            <!--end mk permissoin coding -->



                                        </form>


                                    </div>
                                    <!-- customer management -->










                                    <div class="tab-pane fade" id="pills-transactions" role="tabpanel"
                                        aria-labelledby="pills-transactions-tab">

                                        <div class="card-body table form Items mb-0 p-0">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            <table style="width:100%" id="managers-list"
                                                class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="display-none"></th>

                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Contact Number</th>
                                                        <th>In Session</th>
                                                        <th>Out Session</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($branch->branchManagers as $manager)
                                                        @php

                                                        @endphp
                                                        <tr>
                                                            <th class="display-none"></th>
                                                            <td>{{ optional($manager->user)->first_name }}
                                                                {{ optional($manager->user)->last_name }}</td>
                                                            <td>{{ optional($manager->user)->email }}</td>
                                                            <td> {{ optional($manager->user)->phone_number }}</td>
                                                            <td>{{ @date('d/m/Y H:i A', strtotime($manager->in_sesssion)) }}
                                                            </td>

                                                            <td>{{ $manager->out_sesssion == null ? '-' : date('d/m/Y H:i A', strtotime($manager->out_sesssion)) }}
                                                            </td>
                                                            <td><span
                                                                    class=" p-2 {{ $manager->out_sesssion == null ? 'alert-success' : 'alert-danger' }}">{{ $manager->out_sesssion == null ? 'Active' : 'In Active' }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>




                                    <!--start staff coding -->

                                    <div class="tab-pane fade" id="pills-staff" role="tabpanel"
                                        aria-labelledby="pills-staff-tab">

                                        <div class="card-body table form Items mb-0 p-0">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            <table style="width:100%" id="staff-list"
                                                class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="display-none"></th>

                                                        <th>Code</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Points</th>
                                                        <!--    <th>Status</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($AllbranchStaff as $staff)
                                                        <tr>
                                                            <th class="display-none"></th>

                                                            <td>{{ optional($staff->staff)->staff_code }}</td>
                                                            <td>{{ optional($staff->staff)->staff_name }}</td>
                                                            <td>


                                                                @foreach ($Alldesignation as $designation)
                                                                    @if ($designation->id == $staff->designation_id)
                                                                        {{ $designation->designation }}
                                                                    @endif
                                                                @endforeach

                                                                @forelse ($Alldesignation as $designation)
                                                                    @if ($designation->id == $staff->staff->designation_id)
                                                                        {{ $designation->designation }}
                                                                    @endif
                                                                @empty
                                                                @endforelse


                                                            </td>
                                                            <td>{{ $staff->staff->points ?? '0' }}</td>

                                                            <!--         <td>
                                      <label class="switch">
                                      <input type="checkbox" class="change_status_of_group"  data-id="{{ $staff->id }}" {{ $staff->status == '1' ? 'checked' : '' }}>
                                      <span class="slider round"></span>
                                      </label>

                                       <input  class="change_status_of_group"  data-id="{{ $staff->id }}" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Active" data-off="Inactive" {{ $staff->status == '1' ? 'checked' : '' }} >


                                    </td>  -->
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <!--end staff coding -->




                                    <!--start staff coding -->

                                    <div class="tab-pane fade" id="pills-cars" role="tabpanel"
                                        aria-labelledby="pills-cars-tab">


                                        <div class="alert d-none" role="alert" id="flash-message-cars">
                                        </div>

                                        <div class="card-body items">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert"> {{ session('status') }}
                                                </div>
                                            @endif
                                            <table style="width:100%" id="cars-list"
                                                class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>

                                                        <th>Modal</th>
                                                        <th>No Plate</th>
                                                        <th>Ownershiop</th>
                                                        <th>Driver Name</th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    @foreach ($branchCars as $branchCar)
                                                        <tr>

                                                            <td>{{ @$branchCar->car->model ?? 'N/A' }}</td>
                                                            <td>{{ @$branchCar->car->no_plate ?? 'N/A' }}</td>
                                                            <td>{{ @$branchCar->car->owner->ownership_name ?? 'N/A' }}
                                                            </td>
                                                            <td>{{ @$branchCar->car->driver->drivers_name ?? 'N/A' }}</td>




                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>
                                        </div>


                                    </div>

                                    <!--end staff coding -->




                                    <!--start staff coding -->

                                    <div class="tab-pane fade" id="pills-drivers" role="tabpanel"
                                        aria-labelledby="pills-drivers-tab">
                                        <div class="alert d-none" role="alert" id="flash-message-cars">
                                        </div>
                                        <div class="card-body items">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert"> {{ session('status') }}
                                                </div>
                                            @endif
                                            <table style="width:100%" id="drivers-list"
                                                class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Driver Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($branchDrivers as $branchDriver)
                                                    <tr>
                                                       <td>{{ $branchDriver->driver->drivers_name ?? 'N/A' }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--end staff coding -->
                                       
                                   <div class="tab-pane fade" id="pills-tableqr" role="tabpanel"
                                        aria-labelledby="pills-tableqr-tab">
                                        <div class="alert d-none" role="alert" id="flash-message-cars">
                                        </div>
                                        <div class="card-body items">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert"> {{ session('status') }}
                                                </div>
                                            @endif



                                            <div class="col-md-5 m-auto">
                                                <div class="row">
                                                  @if(!empty($tableqrdata))
                                                    <div class="col-4"> 
                                                    <a href="{{asset('branch_images/QR/'.$tableqrdata->qrcode)}}" target="_blank" class="my-3" ><img src="{{asset('branch_images/QR/'.$tableqrdata->qrcode)}}" width="160px" height="160px" style="width: 160px !important;" /></a>
                                                    </div>
                                                    <div class="col-8 mb-0">

                                                      <form >
                                                        <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                                                        <input type="hidden" value="{{$tableqrdata->id}}" name="qrid">  
                                                        <div class="form-group">
                                                          <input type="text" name="table_number" class="form-control col-5 table_number" value="{{$tableqrdata->table_number}}" readonly placeholder="total table">
                                                       </div>
                                                       </form>
                                                    </div>
                                                    @else
                                                    <div class="col-4"> 
                                                        <a href="{{asset('branch_images/QR/')}}" target="_blank" class="my-3" ><img src="{{asset('branch_images/QR/')}}" width="160px" height="160px" style="width: 160px !important;" /></a>
                                                        </div>
                                                        <div class="col-8 mb-0">
                                                        <form >
                                                            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                                                        <div class="form-group">
                                                          <input type="text" name="table_number" class="form-control col-5 table_number" readonly  placeholder="total table">
                                                       </div>
                                                        </form>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('css')
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
            rel="stylesheet">

        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

        <style>
            .table_number{
                margin: 0;
                padding: 0;
                position:absolute;
                top:70%;
                left: 80px;
                bottom: 0;
                text-indent: 10px;
            }
            .border {
                border: 1px solid #cccccc !important;
                border-radius: 14px;
                padding: 20px;
                background-color: #ffffff;
            }

            .tab_wrapper ul li.nav-item {
                width: calc(11.11111111111111% - 5px);
            }

            .tab_wrapper ul.nav.nav-pills {
                width: 100%;
            }

            .border img {
                width: 100%;
                border-radius: 14px;
            }

            .custom-check input:checked~span {
                background-color: #FCB302;
                border-color: #FCB302;
            }

            .custom-check input:checked~span:before {
                background-color: #FCB302;
                left: 5px;
                top: 1px;
                width: 5px;
                height: 10px;
                border: solid #ffffff;
                border-width: 0 2px 2px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
                content: "";
                position: absolute;
            }

            /*my code*/
            .nav-pills .nav-link.active,
            .nav-pills .show>.nav-link {
                background-color: #1f5c7a;
            }

            /*my code*/

            #profileImage {
                height: 150px;
                width: 200px;
                border-radius: 10px;
                object-fit: contain;
                background-color: #fbfbfb;
                border: 1px solid #343d49;
                padding: 10px;
            }

            .messageArea {
                margin-left: 0;
                padding-left: 0;
            }

            .my-message {
                margin-right: 10px;
                background: #ebebeb;
                color: #333333;
                border-radius: 10px;
                padding: 10px;
                max-width: 50vw;
                display: inline-block;
                position: relative;
                margin-bottom: 22px;
            }

            .my-name {
                font-weight: bolder;
                margin-right: 0px;
            }

            .my-content {
                margin-top: 0px;
                margin-bottom: 0px;
            }

            .my-message:after {
                content: '';
                position: absolute;
                width: 0;
                height: 0;
                border-top: 15px solid #ebebeb;
                border-left: 15px solid transparent;
                border-right: 15px solid transparent;
                top: 0;
                right: -15px;
            }

            .my-message:before {
                content: '';
                position: absolute;
                width: 0;
                height: 0;
                border-top: 17px solid #ebebeb;
                border-left: 16px solid transparent;
                border-right: 16px solid transparent;
                top: 0px;
                right: -16px;
            }

            .butDel {
                width: 10px;
                height: 25px;
            }

            .butDelText {
                position: relative;
                right: 3.5px;
                top: -1px;
            }

            .another-message {
                margin-left: 10px;
                background: #263238;
                color: #ffffff;
                border-radius: 10px;
                padding: 10px;
                max-width: 50vw;
                display: inline-block;
                position: relative;
                margin-bottom: 22px;
            }

            .another-message:after {
                content: '';
                position: absolute;
                width: 0;
                height: 0;
                border-top: 15px solid #263238;
                border-left: 15px solid transparent;
                border-right: 15px solid transparent;
                top: 0;
                left: -15px;
            }

            .another-message:before {
                content: '';
                position: absolute;
                width: 0;
                height: 0;
                border-top: 17px solid #263238;
                border-left: 16px solid transparent;
                border-right: 16px solid transparent;
                top: 0px;
                left: -16px;
            }

            .another-name {
                font-weight: bolder;
                margin-right: 0px;
            }

            .another-content {
                margin-top: 0px;
                margin-bottom: 0px;
                line-height: 22px;
            }

            /* Small Image Css */

            .upload-small-img img {
                height: 200px;
                object-fit: contain;
                width: 250px;
            }

            .upload-small-img img {
                margin: 22px 0 0;
                border: 1px solid #cccccc;
                padding: 15px;
                border-radius: 20px;
            }

            .remove-branch-small-img {
                top: 10px !important;
            }

            /* -------------------- */


            
        </style>
    @stop

    @section('js')
        <script>
            $(document).on('click', '.nav-item', function() {
                $('.nav_link').each(function() {
                    if ($(this).hasClass('active')) {
                        var target = $(this).attr('href');
                        $('.tab-pane').removeClass('show');
                        $('.tab-pane').removeClass('active');
                        $(target).addClass('show');
                        $(target).addClass('active');
                    }
                })
            })
        </script>


        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
        <!-- <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
        <!-- <script src="{{ asset('docsupport/jquery-3.2.1.min.js') }}"></script> -->
        <link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />



        <script type="text/javascript">
            $(document).ready(function() {
                $('#managers-list').DataTable({
                    columnDefs: [{
                        targets: 0,
                        render: function(data, type, row) {
                            return data.substr(0, 2);
                        }
                    }]
                });


                $('#menu-list').DataTable({
                    columnDefs: [{
                        targets: 0,
                        render: function(data, type, row) {
                            return data.substr(0, 2);
                        }
                    }],
                    order: [
                        [3, 'asc'],
                        [1, 'asc']
                    ],
                });

                $('#menu-category-list').DataTable({
                    columnDefs: [{
                        targets: 0,
                        render: function(data, type, row) {
                            return data.substr(0, 2);
                        }
                    }],
                    order: [
                        [3, 'asc'],
                        [1, 'asc']
                    ],
                });

            })


            $(".chosen-select").chosen({
                no_results_text: "Oops, nothing found!",

            })




            $(document).ready(function() {

                $('#editUserForm').validate({
                    ignore: [],
                    debug: false,
                    rules: {
                        title_en: {
                            required: true,

                        },
                        title_ar: {
                            required: true,
                            noSpace: true
                        },
                        // name_en:{
                        //   required: true,

                        // },
                        // name_ar:{
                        //   required: true,

                        // },
                        description_en: {
                            required: true,

                        },
                        description_ar: {
                            required: true,

                        },
                        email: {
                            required: true,
                            email: true,
                            //         remote:{
                            //   type:"get",
                            //   url:"{{ route('check_user_email') }}",
                            //   data: {
                            //         "email": function() { return $("#email").val(); },
                            //         "_token": "{{ csrf_token() }}",

                            //       },
                            //       dataFilter: function (result) {
                            //        var json = JSON.parse(result);
                            //                     if (json.msg == 1) {
                            //                         return "\"" + "Email ID already  exist" + "\"";
                            //                     } else {
                            //                         return 'true';
                            //                     }
                            //       }
                            // }
                        },

                        "managers_id[]": {
                            required: true,

                        },
                        region: {
                            required: true,

                        }
                    },
                    messages: {
                        title_en: {
                            required: "The title(english) field is required.",
                        },
                        title_ar: {
                            required: "The title(arabic) field is required.",
                        },
                        description_en: {
                            required: "The description(english) field is required.",
                        },
                        description_ar: {
                            required: "The description(arabic) field is required.",
                        },

                        email: {
                            required: "The Email field is required.",
                            email: "Please enter a valid email"
                        },
                        phone_number: {
                            required: "The Contact number field is required.",
                        },
                        password: {
                            required: "The Password field is required."
                        },
                        password_confirmation: {
                            required: "The Confirm Password field is required.",
                            equalTo: "The Confirm Password should match to Password."
                        },
                    }
                });

                jQuery.validator.addMethod("phone_valid", function(value, element) {
                    return this.optional(element) ||
                        /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value)
                    // just ascii letters
                }, "Please enter vaild numer");








            });
        </script>


        <script>
            $(document).ready(function() {
                checkAll();
                $("input[type='checkbox']").change(function() {

                    checkAll();
                });

                function checkAll() {

                    $("#full_access").click(function() {
                        $("input[type=checkbox]").prop('checked', this.checked)
                    });

                    //////////////////

                    if ($('.ckbCheckAll:checked').length == $('.ckbCheckAll').length) {
                        $("#full_access").prop('checked', 'true');
                    } else {
                        $("#full_access").prop('checked', false);
                    }


                }


            });
        </script>



        <script>
            $(document).ready(function() {
                $('.click_me').click(function() {
                    $('#exampleModal').modal('show');
                });
            });


            $(document).ready(function() {
                $('.branch_image_box').each(function() {
                    $(this).click(function() {

                        $('.show_image_id').each(function() {
                            $(this).removeClass('active');
                        });

                        var image_id = $(this).attr('image_id');
                        $('#exampleModal').modal('show');

                        $('.show_image_id').each(function() {

                            if ($(this).attr('show_image_id') == image_id) {
                                $(this).addClass('active');
                            }

                        });


                    });
                });
            });



            $(document).ready(function() {

                $('.carousel').carousel({
                    interval: false,
                });






            });



            $('#localities-list').DataTable({
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data;
                    }
                }]
            });

            $('#staff-list').DataTable({
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data;
                    }
                }]
            });



            $('.AllPermissionBox').each(function(index, key) {
                var count = 0;
                var all_input = this.getElementsByTagName('INPUT');
                var getParentInput = this.parentElement.parentElement.parentElement;

                var parentInput = getParentInput.getElementsByTagName('INPUT')[0];
                $(all_input).each(function(data) {
                    if ($(this).is(':checked')) {
                        count++;
                    }
                });

                if (all_input.length == count) {
                    //alert('yes');
                    $(parentInput).prop('checked', 'true');
                } else {
                    // alert('no')
                    $(parentInput).prop('checked', false);
                }



            });
        </script>






        <script type="text/javascript">
            //Active and incactive choices

            $(document).ready(function() {
                $(document).on('change', '.change_status_of_group', function() {

                    var id = $(this).data("id");
                    var status_value = $(this).prop('checked') == true ? 1 : 0;

                    $.ajax({
                        type: "post",
                        url: "{{ route('change.staff.status') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id,
                            status_value: status_value,
                        },
                        success: function(response) {
                            toastr.success(response.message);
                            console.log(response);
                        }
                    });
                })

                //        $('.change_status_of_group').change(function(){

                // });



            });


            $('#cars-list').DataTable({
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data;
                    }
                }]
            });

             $('#drivers-list').DataTable({
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data;
                    }
                }]
            });


            $('#tableqr-list').DataTable({
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data;
                    }
                }]
            });
        </script>



    @stop
