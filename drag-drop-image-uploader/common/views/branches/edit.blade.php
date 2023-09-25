@extends('adminlte::page')

@section('title', ' Super Admin | Edit Branch')

@section('content_header')


@section('content')
    <div class="container">
        <div class=" alert-danger custom_message p-3 mb-2 mx-0 d-none "role="alert">
            Branch has been Updated successfully!
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Edit Branch</h3>
                            <label class="mb-0">{{ $branch->title_en ?? 'N/A' }} ( {{ $branch->title_ar ?? 'N/A' }}
                                )</label>
                            <a class="btn btn-sm btn-success"
                                href="{{ route('branches') }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body p-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="tab_wrapper">
                                <ul class="nav nav-pills branch-details mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link nav_link {{ Request::segment(2) == 'edit' && Request::segment(1) == 'branch' ? 'active' : '' }} "
                                            id="pills-home-tab" href="{{ route('edit_branch', ['id' => $branch->id]) }}"
                                            aria-controls="pills-home" aria-selected="true">Branch</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link {{ Request::segment(2) == 'info' && Request::segment(1) == 'branch' ? 'active' : '' }} "
                                            id="pills-info-tab" href="{{ route('info.edit_branch', ['id' => $branch->id]) }}"
                                            aria-controls="pills-home" aria-selected="true">Info</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link {{ Request::segment(2) == 'permission' && Request::segment(1) == 'branch' ? 'active' : '' }} "
                                            id="pills-permission-tab"
                                            href="{{ route('permission.edit_branch', ['id' => $branch->id]) }}"
                                            aria-controls="pills-home" aria-selected="true">Persmission</a>
                                    </li>


                                    <!--    <li class="nav-item">
                             <a class="nav-link nav_link {{ Request::segment(2) == 'localities' && Request::segment(1) == 'branch' ? 'active' : '' }} " id="pills-localities-tab" href="{{ route('localities.edit_branch', ['id' => $branch->id]) }}"  aria-controls="pills-home" aria-selected="true">Localities</a>
                          </li> -->

                                    <li class="nav-item">
                                        <a class="nav-link nav_link {{ Request::segment(2) == 'menucategory' && Request::segment(1) == 'branch' ? 'active' : '' }} "
                                            id="pills-menucategory-tab"
                                            href="{{ route('menucategory.edit_branch', ['id' => $branch->id]) }}"
                                            aria-controls="pills-home" aria-selected="true">Menu Category</a>
                                    </li>


                                          <li class="nav-item">
                                        <a class="nav-link nav_link {{ Request::segment(2) == 'menuitem' && Request::segment(1) == 'branch' ? 'active' : '' }} "
                                            id="pills-menuitem-tab"
                                            href="{{ route('menuitem.edit_branch', ['id' => $branch->id]) }}"
                                            aria-controls="pills-home" aria-selected="true">Menu Items</a>
                                    </li>



                                    <li class="nav-item">
                                        <a class="nav-link nav_link {{ Request::segment(2) == 'cars' && Request::segment(1) == 'branch' ? 'active' : '' }} "
                                            id="pills-cars-tab" href="{{ route('cars.edit_branch', ['id' => $branch->id]) }}"
                                            aria-controls="pills-home" aria-selected="true">Cars</a>
                                    </li>


                                    <li class="nav-item">
                                        <a class="nav-link nav_link {{ Request::segment(2) == 'drivers' && Request::segment(1) == 'branch' ? 'active' : '' }} "
                                            id="pills-drivers-tab"
                                            href="{{ route('drivers.edit_branch', ['id' => $branch->id]) }}"
                                            aria-controls="pills-home" aria-selected="true">Drivers</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav_link {{ Request::segment(2) == 'table-qr' && Request::segment(1) == 'branch' ? 'active' : '' }} "
                                            id="pills-table-qr-tab"
                                            href="{{ route('qrtable.editlist', ['id' => $branch->id]) }}"
                                            aria-controls="pills-home" aria-selected="true">Table QR Details</a>
                                    </li>






                                </ul>
                                <div class="tab-content" id="pills-tabContent">



                                    <div class="tab-pane fade {{ Request::segment(2) == 'edit' && Request::segment(1) == 'branch' ? ' show active' : '' }}"
                                        id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                     <form id="addUser" method="post" onload="resetForm()" autocomplete="off"
                                            enctype="multipart/form-data" name="demoform" style="border:none;">
                                            @csrf
                                            <div class="card-body form">
                                                <div class="row">
                                                    <input type="hidden" id="userid" name="userid">
                                                    <input type="hidden" id="old_images_name" name="old_images_name">
                                                    <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label for="title_en">Title {{ labelEnglish() }}<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="title_en" class="form-control"
                                                                id="title_en" maxlength="100"
                                                                value="{{ $branch->title_en ?? '' }}">
                                                            @if ($errors->has('title_en'))
                                                                <div class="error">{{ $errors->first('title_en') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label for="title_ar">Title{{ labelArabic() }}<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="title_ar" class="form-control"
                                                                id="title_ar" maxlength="100"
                                                                value="{{ $branch->title_ar ?? '' }}">
                                                            @if ($errors->has('title_ar'))
                                                                <div class="error">{{ $errors->first('title_ar') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="description_en">Description
                                                                {{ labelEnglish() }} </label>
                                                            <textarea name="description_en" class="form-control" id="description_en" maxlength="900" style="height: 100px;">{{ $branch->description_en ?? '' }}</textarea>
                                                            @if ($errors->has('description_en'))
                                                                <div class="error">{{ $errors->first('description_en') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="description_ar">Description
                                                                {{ labelArabic() }} </label>

                                                            <textarea name="description_ar" class="form-control" id="description_ar" maxlength="900" style="height: 100px;">{{ $branch->description_ar ?? '' }}</textarea>

                                                            @if ($errors->has('description_ar'))
                                                                <div class="error">{{ $errors->first('description_ar') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="country_code">Country Code <span
                                                                    class="text-danger"> *</span> </label>
                                                            <input type="tel" name="country_code"
                                                                class="form-control" id="country_code"
                                                                value="{{ $branch->country ?? '' }}">

                                                            @if ($errors->has('country_code'))
                                                                <div class="error">{{ $errors->first('country_code') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="password">Contact Number 1<span
                                                                    class="text-danger"> *</span></label>
                                                            <br>
                                                            <input style="width:100%" type="tel" name="phone_number"
                                                                class="form-control " id="txtPhone" autocomplete="false"
                                                                value="{{ $branch->phone_number ?? '' }}">
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="password">Contact Number 2 </label>
                                                            <br>
                                                            <input type="tel" name="secondary_phone_number"
                                                                class="form-control"
                                                                value="{{ $branch->secondary_phone_number ?? '' }}"
                                                                id="secondary_phone_number" />
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="password">WhatsApp Number </label>
                                                            <br>
                                                            <input style="width:100%" type="tel"
                                                                name="whatsapp_number" class="form-control "
                                                                id="WhatsAppNumber" autocomplete="false"
                                                                value="{{ $branch->whatsapp_number ?? '' }}">
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="email">Email </label>
                                                            <input type="email" name="email" class="form-control"
                                                                id="email" value="{{ $branch->email }}">
                                                            @if ($errors->has('email'))
                                                                <div class="error">{{ $errors->first('email') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="address">Address </label>
                                                            <textarea name="address" class="form-control" id="address" maxlength="500" style="height:60px;">{{ $branch->address ?? '' }}</textarea>
                                                            @if ($errors->has('address'))
                                                                <div class="error">{{ $errors->first('address') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="email">Map link</label>
                                                            <input type="url" name="map_link" class="form-control"
                                                                id="map_link" value="{{ $branch->map_link ?? '' }}">

                                                            @if ($errors->has('map_link'))
                                                                <div class="error">{{ $errors->first('map_link') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="password">Tour link </label>
                                                            <br>
                                                            <input type="url" name="tour_link" class="form-control"
                                                                id="tour_link" value="{{ $branch->tour_link ?? '' }}" />
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                                                        <div class="form-group pdf mt-3">
                                                            <label for="password">Branch pdf
                                                                <a class="btn info_btn" data-toggle="tooltip"
                                                                    data-placement="right"
                                                                    title="Upload max 5 MB file. Only .pdf files are allowed to upload.">
                                                                    <i class="fa fa-question-circle"></i>
                                                                </a>
                                                            </label>
                                                            <input type="file" name="branch_pdf" class="thumbnail_pic"
                                                                onchange="readURL(this);" accept="application/pdf"
                                                                class="form-control" style="border:1px  solid #cccccc">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group branches branch-city mt-3">
                                                            <label for="password">Branch City </label>
                                                            <br>
                                                            <select class="advance_category_search catselect"
                                                                name="city_id" id="city_id"
                                                                style="width:100% !important;">
                                                                <option value="">Select Branch City</option>
                                                                @forelse ($city_list as $city)
                                                                    <option value="{{ $city->id }}"
                                                                        {{ $branch->city_id == $city->id ? 'selected' : ' ' }}>
                                                                        {{ $city->city }}</option>
                                                                @empty
                                                                    <option class="disabled">City not found</option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="{{ $branch->branch_pdf != null ? '' : 'd-none' }} close_btn_container"
                                                        style="position:relative;">
                                                        <a href="javascript:;" class="remove-pro-img  delete_pdf"
                                                            pdf_name="{{ $branch->branch_pdf ?? ' ' }}"
                                                            current_id="{{ $branch->id }}"
                                                            style="display:block;position: absolute;right:0px;top:15px;z-index: 1;">
                                                            <svg width="25" height="25" viewBox="0 0 257 256"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_2088_553)">
                                                                    <path
                                                                        d="M254.85 141.81C253.9 157.47 249.21 172.11 241.97 185.85C222.7 222.45 192.59 244.9 152.18 253.57C150.9 253.85 149.55 253.82 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z"
                                                                        fill="#F7F9FA" />
                                                                    <path
                                                                        d="M254.85 141.81C251.98 142.27 250.79 139.87 249.24 138.32C230 119.18 210.83 99.9701 191.64 80.7801C190.08 79.2301 188.55 77.6401 186.86 76.2301C186.73 76.1101 186.6 76.0101 186.47 75.9101C186.37 75.8201 186.27 75.7401 186.17 75.6601C179.43 68.4101 174.9 68.2601 167.78 75.3201C156.31 86.6701 144.95 98.1401 133.52 109.53C128.75 114.28 128.21 114.29 123.52 109.63C111.61 97.7701 99.7803 85.8401 87.8503 74.0101C83.5703 69.7701 79.6603 69.0701 75.8503 71.6001C70.9103 74.8801 70.1903 80.2701 74.3803 84.8201C79.1203 89.9501 84.2103 94.7501 89.1403 99.7001C96.6603 107.24 104.24 114.72 111.71 122.31C115.58 126.24 115.59 127.4 111.66 131.37C100.3 142.84 88.8503 154.21 77.4403 165.63C76.0403 167.04 74.5503 168.4 73.4803 170.11C70.4303 174.98 71.1603 179.23 75.6803 182.84C76.5803 183.56 77.6903 184.03 78.3503 185.05C78.4203 185.21 78.4903 185.36 78.5803 185.51C78.5903 185.55 78.6103 185.59 78.6403 185.63C79.4203 187.06 80.6103 188.16 81.7603 189.31C101.43 208.97 121.13 228.61 140.72 248.36C142.99 250.65 145.76 252.04 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z"
                                                                        fill="#E11B1B" />
                                                                    <path
                                                                        d="M254.851 141.81C253.901 157.47 249.211 172.11 241.971 185.85C222.701 222.45 192.591 244.9 152.181 253.57C150.901 253.85 149.551 253.82 148.231 253.94C145.631 253.93 143.601 252.98 141.691 251.05C121.101 230.32 100.401 209.7 79.8109 188.98C79.0309 188.19 76.6309 187.69 78.2509 185.61C78.3609 185.58 78.471 185.55 78.581 185.51C85.011 183.79 89.421 179.22 93.911 174.65C103.951 164.44 114.101 154.34 124.281 144.26C128.391 140.18 129.551 140.18 133.721 144.32C144.961 155.46 156.111 166.68 167.301 177.86C168.361 178.92 169.391 180.01 170.501 181.02C174.681 184.83 179.601 185.14 183.031 181.84C186.531 178.46 186.521 172.88 182.621 168.86C172.881 158.82 162.871 149.04 153.001 139.13C151.001 137.13 148.991 135.13 146.991 133.12C141.341 127.44 141.331 127.19 146.851 121.66C156.381 112.11 165.821 102.47 175.501 93.0802C180.591 88.1502 185.511 83.2702 186.471 75.9102C186.521 75.5802 186.551 75.2502 186.581 74.9102C188.681 75.4402 189.791 77.2202 191.171 78.6002C211.061 98.4402 230.911 118.32 250.781 138.17C252.071 139.45 253.491 140.6 254.851 141.81V141.81Z"
                                                                        fill="#C30606" />
                                                                    <path
                                                                        d="M186.59 74.9098C187.91 79.9298 186.29 83.8598 182.62 87.4598C170.4 99.4598 158.43 111.72 146.19 123.7C143.59 126.25 143.08 127.63 146.03 130.49C158.57 142.64 170.82 155.09 183.14 167.46C187.36 171.69 188.23 176.25 185.8 180.48C182.3 186.59 174.86 187.29 169.34 181.82C156.93 169.53 144.51 157.25 132.36 144.72C129.44 141.71 127.98 141.78 125.1 144.75C113.17 157.04 100.91 169.01 88.8705 181.2C85.8805 184.23 82.5405 185.95 78.2505 185.62C68.6605 181.06 67.5405 174.17 75.2105 166.49C87.3205 154.35 99.3805 142.15 111.65 130.17C114.22 127.66 114 126.36 111.57 123.97C98.8505 111.49 86.3205 98.8298 73.7205 86.2298C70.1505 82.6498 69.0905 78.4998 71.5605 73.9798C73.7705 69.9098 77.4505 68.2598 82.0605 68.8998C84.8505 69.2898 86.8105 71.0798 88.7205 72.9998C100.71 85.0298 112.83 96.9298 124.67 109.11C127.65 112.18 129.28 112.74 132.58 109.3C144.34 97.0498 156.48 85.1698 168.52 73.1898C175.19 66.5498 181.31 67.1798 186.6 74.9198L186.59 74.9098Z"
                                                                        fill="#FEFEFE" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_2088_553">
                                                                        <rect width="256.1" height="255.86"
                                                                            fill="white" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                            <div class="form-group pdf">
                                                                <a href="{{ url('branch_images/pdf') }}/{{ $branch->branch_pdf }}"
                                                                    id="thumbnail_preview" target="_blank"
                                                                    class="{{ $branch->branch_pdf != null ? '' : 'd-none' }}">
                                                                    <i class="fas fa-file-pdf fa-10x text-danger"
                                                                        style="font-size:120px;"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                        <div class="form-group mt-3">
                                                            <label>Managers</label>
                                                            <select data-placeholder="Select Managers" multiple
                                                                class="chosen-select form-control" name="managers_id[]"
                                                                id="managers">
                                                                <option value="" disabled>Select Managers</option>
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


                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12 mt-2">
                                                        <div class="form-group ">
                                                            <label for="status">Status </label>
                                                            <select class="form-control" name="status" id="status">
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
                                                            <input type="file" name="branch_image"
                                                                class="branch_image {{ @$branch->BranchBigImages->image_name == null ? '' : 'd-none' }}" onchange="BranchBigPictureURL(this);"
                                                                id="branch_image" accept=".png, .jpg, .jpeg"
                                                                class="form-control">
                                                            @if ($errors->has('branch_image'))
                                                                <div class="error">{{ $errors->first('branch_image') }}
                                                                </div>
                                                            @endif
                                                            <div class="upload-img {{ @$branch->BranchBigImages->image_name != null ? '' : 'd-none' }}"
                                                                style="position:relative;width:250px;">
                                                                <a href="javascript:;" class="remove-branch-big-img"
                                                                    pdf_name="{{ @$branch->BranchBigImages->image_name ?? ' ' }}"
                                                                    current_id="{{ @$branch->BranchBigImages->id }}"
                                                                    style="display:block;position: absolute;right:-10px;top:16px;">
                                                                    <svg width="25" height="25"
                                                                        viewBox="0 0 257 256" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <g clip-path="url(#clip0_2088_553)">
                                                                            <path
                                                                                d="M254.85 141.81C253.9 157.47 249.21 172.11 241.97 185.85C222.7 222.45 192.59 244.9 152.18 253.57C150.9 253.85 149.55 253.82 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z"
                                                                                fill="#F7F9FA" />
                                                                            <path
                                                                                d="M254.85 141.81C251.98 142.27 250.79 139.87 249.24 138.32C230 119.18 210.83 99.9701 191.64 80.7801C190.08 79.2301 188.55 77.6401 186.86 76.2301C186.73 76.1101 186.6 76.0101 186.47 75.9101C186.37 75.8201 186.27 75.7401 186.17 75.6601C179.43 68.4101 174.9 68.2601 167.78 75.3201C156.31 86.6701 144.95 98.1401 133.52 109.53C128.75 114.28 128.21 114.29 123.52 109.63C111.61 97.7701 99.7803 85.8401 87.8503 74.0101C83.5703 69.7701 79.6603 69.0701 75.8503 71.6001C70.9103 74.8801 70.1903 80.2701 74.3803 84.8201C79.1203 89.9501 84.2103 94.7501 89.1403 99.7001C96.6603 107.24 104.24 114.72 111.71 122.31C115.58 126.24 115.59 127.4 111.66 131.37C100.3 142.84 88.8503 154.21 77.4403 165.63C76.0403 167.04 74.5503 168.4 73.4803 170.11C70.4303 174.98 71.1603 179.23 75.6803 182.84C76.5803 183.56 77.6903 184.03 78.3503 185.05C78.4203 185.21 78.4903 185.36 78.5803 185.51C78.5903 185.55 78.6103 185.59 78.6403 185.63C79.4203 187.06 80.6103 188.16 81.7603 189.31C101.43 208.97 121.13 228.61 140.72 248.36C142.99 250.65 145.76 252.04 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z"
                                                                                fill="#E11B1B" />
                                                                            <path
                                                                                d="M254.851 141.81C253.901 157.47 249.211 172.11 241.971 185.85C222.701 222.45 192.591 244.9 152.181 253.57C150.901 253.85 149.551 253.82 148.231 253.94C145.631 253.93 143.601 252.98 141.691 251.05C121.101 230.32 100.401 209.7 79.8109 188.98C79.0309 188.19 76.6309 187.69 78.2509 185.61C78.3609 185.58 78.471 185.55 78.581 185.51C85.011 183.79 89.421 179.22 93.911 174.65C103.951 164.44 114.101 154.34 124.281 144.26C128.391 140.18 129.551 140.18 133.721 144.32C144.961 155.46 156.111 166.68 167.301 177.86C168.361 178.92 169.391 180.01 170.501 181.02C174.681 184.83 179.601 185.14 183.031 181.84C186.531 178.46 186.521 172.88 182.621 168.86C172.881 158.82 162.871 149.04 153.001 139.13C151.001 137.13 148.991 135.13 146.991 133.12C141.341 127.44 141.331 127.19 146.851 121.66C156.381 112.11 165.821 102.47 175.501 93.0802C180.591 88.1502 185.511 83.2702 186.471 75.9102C186.521 75.5802 186.551 75.2502 186.581 74.9102C188.681 75.4402 189.791 77.2202 191.171 78.6002C211.061 98.4402 230.911 118.32 250.781 138.17C252.071 139.45 253.491 140.6 254.851 141.81V141.81Z"
                                                                                fill="#C30606" />
                                                                            <path
                                                                                d="M186.59 74.9098C187.91 79.9298 186.29 83.8598 182.62 87.4598C170.4 99.4598 158.43 111.72 146.19 123.7C143.59 126.25 143.08 127.63 146.03 130.49C158.57 142.64 170.82 155.09 183.14 167.46C187.36 171.69 188.23 176.25 185.8 180.48C182.3 186.59 174.86 187.29 169.34 181.82C156.93 169.53 144.51 157.25 132.36 144.72C129.44 141.71 127.98 141.78 125.1 144.75C113.17 157.04 100.91 169.01 88.8705 181.2C85.8805 184.23 82.5405 185.95 78.2505 185.62C68.6605 181.06 67.5405 174.17 75.2105 166.49C87.3205 154.35 99.3805 142.15 111.65 130.17C114.22 127.66 114 126.36 111.57 123.97C98.8505 111.49 86.3205 98.8298 73.7205 86.2298C70.1505 82.6498 69.0905 78.4998 71.5605 73.9798C73.7705 69.9098 77.4505 68.2598 82.0605 68.8998C84.8505 69.2898 86.8105 71.0798 88.7205 72.9998C100.71 85.0298 112.83 96.9298 124.67 109.11C127.65 112.18 129.28 112.74 132.58 109.3C144.34 97.0498 156.48 85.1698 168.52 73.1898C175.19 66.5498 181.31 67.1798 186.6 74.9198L186.59 74.9098Z"
                                                                                fill="#FEFEFE" />
                                                                        </g>
                                                                        <defs>
                                                                            <clipPath id="clip0_2088_553">
                                                                                <rect width="256.1" height="255.86"
                                                                                    fill="white" />
                                                                            </clipPath>
                                                                        </defs>
                                                                    </svg>
                                                                </a>
                                                                <input type="hidden" name="old_big_image_name"
                                                                    value="{{ @$branch->BranchBigImages->image_name }}"
                                                                    class="old_big_image_name">
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
                                                            <input type="file" name="branch_small_image"
                                                                class="branch_small_image {{ @$branch->BranchSmallImages->image_name == null ? '' : 'd-none' }}"
                                                                onchange="BranchSmallPictureURL(this);"
                                                                id="branch_small_image" accept=".png, .jpg, .jpeg"
                                                                class="form-control">
                                                            @if ($errors->has('branch_small_image'))
                                                                <div class="error">
                                                                    {{ $errors->first('branch_small_image') }}
                                                                </div>
                                                            @endif
                                                            <div class="upload-small-img {{ @$branch->BranchSmallImages->image_name != null ? '' : 'd-none' }}"
                                                                style="position:relative;width:250px;">
                                                                <a href="javascript:;" class="remove-branch-small-img"
                                                                    pdf_name="{{ @$branch->BranchSmallImages->image_name ?? ' ' }}"
                                                                    current_id="{{ @$branch->BranchSmallImages->id }}"
                                                                    style="display:block;position: absolute;right:-10px;top:-8px;">
                                                                    <svg width="25" height="25"
                                                                        viewBox="0 0 257 256" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <g clip-path="url(#clip0_2088_553)">
                                                                            <path
                                                                                d="M254.85 141.81C253.9 157.47 249.21 172.11 241.97 185.85C222.7 222.45 192.59 244.9 152.18 253.57C150.9 253.85 149.55 253.82 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z"
                                                                                fill="#F7F9FA" />
                                                                            <path
                                                                                d="M254.85 141.81C251.98 142.27 250.79 139.87 249.24 138.32C230 119.18 210.83 99.9701 191.64 80.7801C190.08 79.2301 188.55 77.6401 186.86 76.2301C186.73 76.1101 186.6 76.0101 186.47 75.9101C186.37 75.8201 186.27 75.7401 186.17 75.6601C179.43 68.4101 174.9 68.2601 167.78 75.3201C156.31 86.6701 144.95 98.1401 133.52 109.53C128.75 114.28 128.21 114.29 123.52 109.63C111.61 97.7701 99.7803 85.8401 87.8503 74.0101C83.5703 69.7701 79.6603 69.0701 75.8503 71.6001C70.9103 74.8801 70.1903 80.2701 74.3803 84.8201C79.1203 89.9501 84.2103 94.7501 89.1403 99.7001C96.6603 107.24 104.24 114.72 111.71 122.31C115.58 126.24 115.59 127.4 111.66 131.37C100.3 142.84 88.8503 154.21 77.4403 165.63C76.0403 167.04 74.5503 168.4 73.4803 170.11C70.4303 174.98 71.1603 179.23 75.6803 182.84C76.5803 183.56 77.6903 184.03 78.3503 185.05C78.4203 185.21 78.4903 185.36 78.5803 185.51C78.5903 185.55 78.6103 185.59 78.6403 185.63C79.4203 187.06 80.6103 188.16 81.7603 189.31C101.43 208.97 121.13 228.61 140.72 248.36C142.99 250.65 145.76 252.04 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z"
                                                                                fill="#E11B1B" />
                                                                            <path
                                                                                d="M254.851 141.81C253.901 157.47 249.211 172.11 241.971 185.85C222.701 222.45 192.591 244.9 152.181 253.57C150.901 253.85 149.551 253.82 148.231 253.94C145.631 253.93 143.601 252.98 141.691 251.05C121.101 230.32 100.401 209.7 79.8109 188.98C79.0309 188.19 76.6309 187.69 78.2509 185.61C78.3609 185.58 78.471 185.55 78.581 185.51C85.011 183.79 89.421 179.22 93.911 174.65C103.951 164.44 114.101 154.34 124.281 144.26C128.391 140.18 129.551 140.18 133.721 144.32C144.961 155.46 156.111 166.68 167.301 177.86C168.361 178.92 169.391 180.01 170.501 181.02C174.681 184.83 179.601 185.14 183.031 181.84C186.531 178.46 186.521 172.88 182.621 168.86C172.881 158.82 162.871 149.04 153.001 139.13C151.001 137.13 148.991 135.13 146.991 133.12C141.341 127.44 141.331 127.19 146.851 121.66C156.381 112.11 165.821 102.47 175.501 93.0802C180.591 88.1502 185.511 83.2702 186.471 75.9102C186.521 75.5802 186.551 75.2502 186.581 74.9102C188.681 75.4402 189.791 77.2202 191.171 78.6002C211.061 98.4402 230.911 118.32 250.781 138.17C252.071 139.45 253.491 140.6 254.851 141.81V141.81Z"
                                                                                fill="#C30606" />
                                                                            <path
                                                                                d="M186.59 74.9098C187.91 79.9298 186.29 83.8598 182.62 87.4598C170.4 99.4598 158.43 111.72 146.19 123.7C143.59 126.25 143.08 127.63 146.03 130.49C158.57 142.64 170.82 155.09 183.14 167.46C187.36 171.69 188.23 176.25 185.8 180.48C182.3 186.59 174.86 187.29 169.34 181.82C156.93 169.53 144.51 157.25 132.36 144.72C129.44 141.71 127.98 141.78 125.1 144.75C113.17 157.04 100.91 169.01 88.8705 181.2C85.8805 184.23 82.5405 185.95 78.2505 185.62C68.6605 181.06 67.5405 174.17 75.2105 166.49C87.3205 154.35 99.3805 142.15 111.65 130.17C114.22 127.66 114 126.36 111.57 123.97C98.8505 111.49 86.3205 98.8298 73.7205 86.2298C70.1505 82.6498 69.0905 78.4998 71.5605 73.9798C73.7705 69.9098 77.4505 68.2598 82.0605 68.8998C84.8505 69.2898 86.8105 71.0798 88.7205 72.9998C100.71 85.0298 112.83 96.9298 124.67 109.11C127.65 112.18 129.28 112.74 132.58 109.3C144.34 97.0498 156.48 85.1698 168.52 73.1898C175.19 66.5498 181.31 67.1798 186.6 74.9198L186.59 74.9098Z"
                                                                                fill="#FEFEFE" />
                                                                        </g>
                                                                        <defs>
                                                                            <clipPath id="clip0_2088_553">
                                                                                <rect width="256.1" height="255.86"
                                                                                    fill="white" />
                                                                            </clipPath>
                                                                        </defs>
                                                                    </svg>
                                                                </a>
                                                                <input type="hidden" name="old_small_image_name"
                                                                    value="{{ @$branch->BranchSmallImages->image_name }}"
                                                                    class="old_small_image_name">
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
                                            <div class="card-footer">
                                                <button type="submit"
                                                    class="button btn_bg_color common_btn text-white">Update</button>
                                            </div>
                                        </form>


                                    </div>
                                    <!--Start Menu Items -->
                                    <div class="tab-pane fade {{ Request::segment(2) == 'menuitem' && Request::segment(1) == 'branch' ? 'show active' : '' }} "
                                        id="pills-menuitem" role="tabpanel" aria-labelledby="pills-items-tab"
                                        onclick="return false">
                                        <div class="card-body table Items p-0">
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
                                                            <td> {{ $menus->menuItems[0]->item_name_en ?? 'N/A' }}</td>
                                                            <td> {{ $menus->menuItems[0]->item_name_ar ?? 'N/A' }}</td>
                                                            <td> {{ $menus->menuItems[0]->menuCategory->name_en ?? 'N/A' }}
                                                            </td>
                                                            <td> {{ $menus->menuItems[0]->price ?? '0' }} KD</td>
                                                            <td>
                                                                <!-- <div class="form-group">
                                              <select class="form-control changestatus" name="cars" data-id="{{ $menus->id }}">
                                              <option value="1" data-hours="0"  @if ($menus->status == 1) selected @endif >Active</option>
                                              <option value="0" data-hours="0" @if ($menus->status == 0) selected @endif>Deactive</option>
                                              </select>
                                           </div> -->

                                                                <div class="form-group">
                                                                    <select class="form-control changestatus"
                                                                        name="cars" data-id="{{ $menus->id }}">



                                                                        @foreach ($menu_item_availability as $item_availability)
                                                                            <option
                                                                                value="{{ $item_availability->value == 1 ? '1' : '0' }}"
                                                                                data-minutes="{{ $item_availability->value }}"
                                                                                {{ $menus->availabality == $item_availability->value ? 'selected' : '' }}>
                                                                                {{ $item_availability->name }}</option>
                                                                        @endforeach

                                                                        <!--  <option value="1" data-hours="0"  @if ($menus->status == 1 && $menus->availabality == 0) selected @endif >Available</option>

                            <option value="0" data-hours="0" @if ($menus->status == 0 && $menus->availabality == 0) selected @endif>Unavailable</option>

                            <option value="0" data-hours="1" @if ($menus->status == 0 && $menus->availabality == 1) selected @endif >Unaivalibale for 1 Hour</option>

                            <option value="0" data-hours="2" @if ($menus->status == 0 && $menus->availabality == 2) selected @endif>Unaivalibale for 2 Hour</option>

                            <option value="0" data-hours="4" @if ($menus->status == 0 && $menus->availabality == 4) selected @endif>Unaivalibale for 4 Hour</option>

                            <option value="0" data-hours="24" @if ($menus->status == 0 && $menus->availabality == 24) selected @endif >Unaivalibale Untill Next Day</option> -->
                                                                    </select>

                                                                </div>








                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- End Menu Items -->






                                         <!--Start Menu Category -->
                                    <div class="tab-pane fade {{ Request::segment(2) == 'menucategory' && Request::segment(1) == 'branch' ? 'show active' : '' }} "
                                        id="pills-menucategory" role="tabpanel" aria-labelledby="pills-items-tab"
                                        onclick="return false">
                                        <div class="card-body table Items p-0">
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
                                                    @foreach($branchMenuCategory  as $branchMenuCat)

                                                    <tr>
                                                        <th class="display-none"></th>
                                                        <td> {{@$branchMenuCat->menuCategory[0]->name_en ?? 'N/A' }}</td>
                                                        <td> {{@$branchMenuCat->menuCategory[0]->name_ar ?? 'N/A' }}</td>
                                                     <td>
                                                        <div class="form-group">
                                                           <select class="form-control changeCategorystatus"
                                                                name="cars" data-id="{{ $branchMenuCat->id }}">
                                                             <option  value="1"   @if ( $branchMenuCat->status == 1  ) selected @endif >Available</option>

                                                            <option  value="0"  @if ($branchMenuCat->status == 0  ) selected @endif>Unavailable</option>


                                                            </select>

                                                        </div>


                                                    </td>
                                                </tr>

                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- End Menu Category -->




                                    <!-- info -->

                                    <div class="tab-pane fade {{ Request::segment(2) == 'info' && Request::segment(1) == 'branch' ? 'show active' : '' }} "
                                        id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
                                        <div class="card-body Items p-0">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif







                                            <form class="form_wrap" id="addAdditionalInformation">
                                                <input type="hidden" name="branch_id" value="{{ $branch->id }}">

                                                <div class="row">





                                                    <!--       <div class="col-md-6 col-lg-6 col-xl-6 col-12">
               <div class="form-group">
                 <label>Minimum order amount<span class="text-danger">*</span></label>
                 <input type="number" class="form-control" name="minimum_order_amount" maxlength="100" value="{{ $branch->minimum_order_amount ?? '' }}" />

              </div>
           </div>  -->



                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                        <div class="form-group">
                                                            <label>Cuisines<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="cuisins"
                                                                maxlength="100" value="{{ $branch->cuisins ?? '' }}" />

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                        <div class="form-group rating ">
                                                            <label>Rating <span class="text-danger">*</span></label>
                                                            <textarea id="rating" class="form-control" name="rating" maxlength="500" style="height:60px!important;">{{ $branch->rating ?? '' }}</textarea>
                                                        </div>
                                                        <span class="text-danger d-none rating_notice">Rating is
                                                            required</span>
                                                    </div>


<!--
              <div class="col-md-6 col-lg-6 col-xl-6 col-12">
              <div class="form-group">
                <label>Delivery Time ( in Min) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="branch_delivery_time" maxlength="100" value="{{ $branch->branch_delivery_time ?? '' }}" />

              </div>
            </div>

               <div class="col-md-6 col-lg-6 col-xl-6 col-12">
              <div class="form-group">
                <label>Pickup Time ( in Min) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="branch_pickup_time" maxlength="100" value="{{ $branch->branch_pickup_time ?? '' }}" />

              </div>
            </div> -->



                                                </div>
                                                <div class="row">


                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                        <div class="form-group mt-3">
                                                            <label>Pre-Order <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="accepts_pre_order">
                                                                <option value="">Select Pre Order</option>
                                                                <option value="1"
                                                                    {{ $branch->accepts_pre_order == 1 ? 'selected' : '' }}>
                                                                    Yes</option>
                                                                <option value="0"
                                                                    {{ $branch->accepts_pre_order == 0 ? 'selected' : '' }}>
                                                                    No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- start opening day --->
                                                <div class="row px-2">
                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-12 mt-3">
                                                        <label>Opening days<span class="text-danger">*</span></label>
                                                        <span class="text-danger d-none opening_day_notice">Opening day is
                                                            required</span>
                                                        <div class="row permissions-section-inner-sec">

                                                            <!--start section one sunday --->


                                                            <div
                                                                class="col-md-12 col-lg-12 col-xl-12 col-12 mt-2 d-flex align-items-center">
                                                                <div class="d-flex justify-content-start width_date">
                                                                    <strong class="list-text text-days">Days</strong>
                                                                </div>
                                                                <div class="w-100">
                                                                    <div class="row">
                                                                        <div class="col-sm-6 pr-0">
                                                                            <div class="form-group">
                                                                                <label>Start time<span
                                                                                        class="text-danger">*</span></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 pr-3">
                                                                            <div class="form-group">
                                                                                <label>End time<span
                                                                                        class="text-danger">*</span></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-12 col-lg-12 col-xl-12 col-12 mb-2 d-flex align-items-center">
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center width_date">
                                                                    <div class="custom-check">
                                                                        <input type="checkbox" id="sunday_input"
                                                                            name="days[]" class="ckbCheckAll"
                                                                            data-target="#sunday" value="sunday">
                                                                        <span></span>
                                                                    </div>
                                                                    <strong class="list-text text-days"> &nbsp;
                                                                        Sunday</strong>
                                                                </div>
                                                                <div id="sunday" class="  w-100">

                                                                    <div class="row" id="sunday_timing_box">
                                                                        <div class="col-sm-6 pr-0">
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="starting_hour_sun"
                                                                                    name="starting_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 pr-3">
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="ending_hour_sun"
                                                                                    name="ending_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <!--end secontin one sunday -->



                                                            <!--start section one Monday --->

                                                            <div
                                                                class="col-md-12 col-lg-12 col-xl-12 col-12 mt-2 mb-2 d-flex align-items-center">
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center width_date">
                                                                    <div class="custom-check">
                                                                        <input type="checkbox" id="monday_input"
                                                                            name="days[]" class="ckbCheckAll"
                                                                            data-target="#monday" value="monday">
                                                                        <span></span>
                                                                    </div>
                                                                    <strong class="list-text text-days"> &nbsp;
                                                                        Monday</strong>
                                                                </div>
                                                                <div id="monday" class="  w-100">
                                                                    <div class="row " id="monday_timing_box">
                                                                        <div class="col-sm-6 pr-0">
                                                                            <div class="form-group">
                                                                                <!-- <label>Start time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="starting_hour_mon"
                                                                                    name="starting_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 pr-3">
                                                                            <div class="form-group">
                                                                                <!-- <label>End time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="ending_hour_mon"
                                                                                    name="ending_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!--end seconton one Monday -->



                                                            <!--start section one Tuesday --->

                                                            <div
                                                                class="col-md-12 col-lg-12 col-xl-12 col-12 mt-2 mb-2 d-flex align-items-center">
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center width_date">
                                                                    <div class="custom-check">
                                                                        <input type="checkbox" id="tuesday_input"
                                                                            name="days[]" class="ckbCheckAll"
                                                                            data-target="#tuesday" value="tuesday">
                                                                        <span></span>
                                                                    </div>
                                                                    <strong class="list-text text-days"> &nbsp;
                                                                        Tuesday</strong>
                                                                </div>
                                                                <div id="tuesday" class="  w-100">
                                                                    <div class="row" id="tuesday_timing_box">
                                                                        <div class="col-sm-6 pr-0">
                                                                            <div class="form-group">
                                                                                <!-- <label>Start time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="starting_hour_tue"
                                                                                    name="starting_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 pr-3">
                                                                            <div class="form-group">
                                                                                <!-- <label>End time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="ending_hour_tue"
                                                                                    name="ending_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!--end seconton one Tuesday -->


                                                            <!--start section one Wednesday --->

                                                            <div
                                                                class="col-md-12 col-lg-12 col-xl-12 col-12 mt-2 mb-2 d-flex align-items-center">
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center width_date">
                                                                    <div class="custom-check">
                                                                        <input type="checkbox" id="wednesday_input"
                                                                            name="days[]" class="ckbCheckAll"
                                                                            data-target="#Wednesday" value="wednesday">
                                                                        <span></span>
                                                                    </div>
                                                                    <strong class="list-text text-days"> &nbsp;
                                                                        Wednesday</strong>
                                                                </div>
                                                                <div id="Wednesday" class="  w-100">
                                                                    <div class="row" id="wednesday_timing_box">
                                                                        <div class="col-sm-6 pr-0">
                                                                            <div class="form-group">
                                                                                <!-- <label>Start time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="starting_hour_wed"
                                                                                    name="starting_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 pr-3">
                                                                            <div class="form-group">
                                                                                <!-- <label>End time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="ending_hour_wed"
                                                                                    name="ending_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!--end seconton one Wednesday -->


                                                            <!--start section one Thursday --->

                                                            <div
                                                                class="col-md-12 col-lg-12 col-xl-12 col-12 mt-2 mb-2 d-flex align-items-center">
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center width_date">
                                                                    <div class="custom-check">
                                                                        <input type="checkbox" id="thursday_input"
                                                                            name="days[]" class="ckbCheckAll"
                                                                            data-target="#Thursday" value="thursday">
                                                                        <span></span>
                                                                    </div>
                                                                    <strong class="list-text text-days"> &nbsp;
                                                                        Thursday</strong>
                                                                </div>
                                                                <div id="Thursday" class="  w-100">
                                                                    <div class="row" id="thursday_timing_box">
                                                                        <div class="col-sm-6 pr-0">
                                                                            <div class="form-group">
                                                                                <!-- <label>Start time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="starting_hour_thu"
                                                                                    name="starting_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 pr-3">
                                                                            <div class="form-group">
                                                                                <!-- <label>End time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="ending_hour_thu"
                                                                                    name="ending_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--end seconton one Thursday -->

                                                            <!--start section one Friday --->

                                                            <div
                                                                class="col-md-12 col-lg-12 col-xl-12 col-12 mt-2 mb-2 d-flex align-items-center">
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center width_date">
                                                                    <div class="custom-check">
                                                                        <input type="checkbox" id="friday_input"
                                                                            name="days[]" class="ckbCheckAll"
                                                                            data-target="#Friday" value="friday">
                                                                        <span></span>
                                                                    </div>
                                                                    <strong class="list-text text-days"> &nbsp;
                                                                        Friday</strong>
                                                                </div>
                                                                <div id="Friday" class="  w-100">
                                                                    <div class="row" id="friday_timing_box">
                                                                        <div class="col-sm-6 pr-0">
                                                                            <div class="form-group">
                                                                                <!-- <label>Start time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="starting_hour_fri"
                                                                                    name="starting_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 pr-3">
                                                                            <div class="form-group">
                                                                                <!-- <label>End time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="ending_hour_fri"
                                                                                    name="ending_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--end seconton one Friday -->

                                                            <!--start section one Saturday --->

                                                            <div
                                                                class="col-md-12 col-lg-12 col-xl-12 col-12 mt-2 mb-2 d-flex align-items-center">
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center width_date">
                                                                    <div class="custom-check">
                                                                        <input type="checkbox" id="saturday_input"
                                                                            name="days[]" class="ckbCheckAll"
                                                                            data-target="#Saturday" value="saturday">
                                                                        <span></span>
                                                                    </div>
                                                                    <strong class="list-text text-days"> &nbsp;
                                                                        Saturday</strong>
                                                                </div>
                                                                <div id="Saturday" class="  w-100">
                                                                    <div class="row" id="saturday_timing_box">
                                                                        <div class="col-sm-6 pr-0">
                                                                            <div class="form-group">
                                                                                <!-- <label>Start time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="starting_hour_sat"
                                                                                    name="starting_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 pr-3">
                                                                            <div class="form-group">
                                                                                <!-- <label>End time<span class="text-danger">*</span></label> -->
                                                                                <input type="text"
                                                                                    class="form-control date_controls timepickercustom"
                                                                                    id="ending_hour_sat"
                                                                                    name="ending_hour[]"
                                                                                    autocomplete="off" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--end seconton one Saturday -->
                                                            <!-- end opening day --->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit"
                                                        class="button btn_bg_color common_btn text-white">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!--end info -->

                                    <div class="tab-pane fade {{ Request::segment(2) == 'permission' && Request::segment(1) == 'branch' ? ' show active' : '' }}  "
                                        id="pills-persmissions" role="tabpanel" aria-labelledby="pills-permissions-tab">
                                        <form class="form-wrap" id="UpdateBranchPermissions">
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
                                            <div class="card-footer">
                                                <button type="submit"
                                                    class="button btn_bg_color common_btn text-white">Update</button>
                                            </div>

                                            <!--end mk permissoin coding -->




                                        </form>
                                    </div>


                                    <!--start branch localities form -->


                                    <!--
       <div class="tab-pane fade {{ Request::segment(2) == 'localities' && Request::segment(1) == 'branch' ? ' show active' : '' }}  " id="pills-localities" role="tabpanel" aria-labelledby="pills-localities-tab"> -->

                                    <!-- start branch localities-->

                                    <div class="tab-pane fade {{ Request::segment(2) == 'localities' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                                        id="pills-localities" role="tabpanel" aria-labelledby="pills-localities-tab">

                                        <div class="alert d-none" role="alert" id="flash-message">
                                        </div>

                                        <div class="card-body table items">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert"> {{ session('status') }}
                                                </div>
                                            @endif
                                            <div class="card-header alert d-flex justify-content-between align-items-center m-0 pt-0 pb-4"
                                                style="border-bottom: none;">
                                                <h3></h3>
                                                <a class="btn btn-sm btn-success mb-0" href="javascript:;"
                                                    data-toggle="modal" data-target="#add_localities_modal">Add
                                                    Localities</a>
                                            </div>
                                            <table style="width:100%" id="localities-list"
                                                class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>

                                                        <th>City</th>
                                                        <th>Delivery Fee</th>
                                                        <th>Minimum Order Amount</th>
                                                        <th>Delivery Time(minutes)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($branchLocalities as $localities)
                                                        <tr>

                                                            <td>{{ optional($localities->city)->city ?? 'N/A' }}
                                                                {{ optional($localities->city)->city_ar ?? 'N/A' }}</td>
                                                            <td>{{ $localities->delivery_fee ?? '0' }} KD</td>
                                                            <td>{{ $localities->minimum_order_amount ?? '0' }} KD</td>
                                                            <td>{{ $localities->delivery_time }}</td>

                                                            <td> <a data-id="{{ $localities->id ?? '' }}"
                                                                    branch-id="{{ $localities->branch_id }}"
                                                                    data-cid="{{ optional($localities->city)->id }}"
                                                                    class="action-button edit-button edit_localities"
                                                                    title="Edit" href="javascript:void(0)"><i
                                                                        class="text-warning fa fa-edit"></i></a> <a
                                                                    data-id="{{ $localities->id }}"
                                                                    class="action-button delete-button" title="Delete"
                                                                    href="javascript:void(0)"><i
                                                                        class="text-danger fa fa-trash-alt"></i></a> </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>
                                        </div>




                                    </div>

                                    <!--end branch localities -->


                                    <!-- add  localities   modal -->
                                    <div id="add_localities_modal" class="modal fade" role="dialog" role="dialog"
                                        data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Localities</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form id="addLocalitiesForm" method="post" class="model-back"
                                                        action="{{ route('branch.localities.edit.save') }}">
                                                        <div class="card-body form">
                                                            <div class="row">

                                                                <input type="hidden" name="branch_id"
                                                                    value="{{ $branch->id }}">

                                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                                                                    <div class="form-group branches">
                                                                        <label for="password"> City<span
                                                                                class="text-danger"> *</span></label>


                                                                        <select class="advance_category_search catselect"
                                                                            name="localities_id" style="width:200px;">
                                                                            <option value="">City</option>

                                                                            @forelse ($city_list as $city)
                                                                                <option value="{{ $city->id }}"
                                                                                    {{ in_array($city->id, $branchLocalitiesCities) ? 'disabled' : ' ' }}>
                                                                                    {{ $city->city }}
                                                                                    {{ $city->city_ar }}</option>
                                                                            @empty
                                                                                <option class="disabled">City not found
                                                                                </option>
                                                                            @endforelse

                                                                        </select>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="delivery_charge">Delivery Fee<span
                                                                                class="text-danger"> *</span></label>
                                                                        <input type="number" step="any"
                                                                            name="delivery_fee" class="form-control "
                                                                            id="delivery_charge" maxlength="6">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="minimum_order_amount">Minimum Order
                                                                            Amount<span class="text-danger">
                                                                                *</span></label>
                                                                        <input type="number" step="any"
                                                                            name="minimum_order_amount"
                                                                            class="form-control "
                                                                            id="minimum_order_amount" maxlength="6">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="delivery_time">Delivery
                                                                            Time(minutes)<span class="text-danger">
                                                                                *</span></label>
                                                                        <input type="number" name="delivery_time"
                                                                            class="form-control " step="any"
                                                                            id="delivery_time" maxlength="6">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="card-footer" style="padding-top: 24px;">
                                                                <button type="submit"
                                                                    class="button btn_bg_color common_btn text-white">Save</button>
                                                            </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end localities  modal -->







                                </div>



                                <!-- end branch localities coding -->







                                <!--start cars coding -->


                                <!-- start branch localities-->

                                <div class="tab-pane fade {{ Request::segment(2) == 'cars' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                                    id="pills-cars" role="tabpanel" aria-labelledby="pills-cars-tab">


                                    <div class="alert d-none" role="alert" id="flash-message-cars">
                                    </div>

                                    <div class="card-header alert d-flex justify-content-between align-items-center m-0"
                                        style="border-bottom: none;">
                                        <h3></h3> <a class="btn btn-sm btn-success" href="javascript:;"
                                            data-toggle="modal" data-target="#add_cars_modal">Add Cars </a>
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
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                @foreach ($branchCars as $branchCar)
                                                    <tr>

                                                        <td>{{ $branchCar->car->model ?? 'N/A' }}</td>
                                                        <td>{{ $branchCar->car->no_plate ?? 'N/A' }}</td>
                                                        <td>{{ $branchCar->car->owner->ownership_name ?? 'N/A' }}</td>
                                                        <td>{{ $branchCar->car->driver->drivers_name ?? 'N/A' }}</td>

                                                        <td> <a data-id="{{ $branchCar->id ?? '' }}"
                                                                branch-id="{{ $branchCar->branch_id ?? '' }}"
                                                                data_cid="{{ optional($branchCar->car)->id }}"
                                                                class="action-button edit-button edit_cars" title="Edit"
                                                                href="javascript:void(0)"><i
                                                                    class="text-warning fa fa-edit"></i></a>

                                                            <a data-id="{{ $branchCar->id }}"
                                                                class="action-button delete-car-button" title="Delete"
                                                                href="javascript:void(0)"><i
                                                                    class="text-danger fa fa-trash-alt"></i></a>
                                                        </td>


                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    </div>




                                </div>


                                <div class="tab-pane fade {{ Request::segment(2) == 'drivers' && Request::segment(1) == 'branch' ? ' show active' : '' }}"
                                    id="pills-drivers" role="tabpanel" aria-labelledby="pills-drivers-tab">
                                    <div class="alert d-none" role="alert" id="flash-message-drivers">
                                    </div>

                                    <div class="card-header alert d-flex justify-content-between align-items-center m-0"
                                        style="border-bottom: none;">
                                        <h3></h3> <a class="btn btn-sm btn-success" href="javascript:;"
                                            data-toggle="modal" data-target="#add_drivers_modal">Add Drivers </a>
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
                                                    <!--  <th>Status</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                @foreach ($branchDrivers as $branchDriver)
                                                    <tr>


                                                        <td>{{ $branchDriver->driver->drivers_name ?? 'N/A' }}</td>
                                                        <!--   <td>{{ $branchDriver->status }} </td> -->


                                                        <td> <a data-id="{{ $branchDriver->id }}"
                                                                branch-id="{{ $branchDriver->branch_id }}"
                                                                data_cid="{{ $branchDriver->driver_id }}"
                                                                class="action-button edit-button edit_drivers"
                                                                title="Edit" href="javascript:void(0)"><i
                                                                    class="text-warning fa fa-edit"></i></a>

                                                            <a data-id="{{ $branchDriver->id }}"
                                                                class="action-button delete-driver-button" title="Delete"
                                                                href="javascript:void(0)"><i
                                                                    class="text-danger fa fa-trash-alt"></i></a>
                                                        </td>


                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                </div>


                                <div class="tab-pane fade {{ Request::segment(2) == 'table-qr' && Request::segment(1) == 'branch' ? ' show active' : '' }}"
                                    id="pills-table-qr" role="tabpanel" aria-labelledby="pills-table-qr-tab">
                                    <div class="alert d-none" role="alert" id="flash-message-table-qr">
                                    </div>

                                    <div class="card-header alert d-flex justify-content-between align-items-center m-0"
                                        style="border-bottom: none;">
                                        <h3></h3>
                                  
                                    </div>
                                    <div class="card-body items">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert"> {{ session('status') }}
                                            </div>
                                        @endif

                                          <div class="col-md-7 m-auto">
                                                <div class="row">
                                                
                                                   @if(!empty($tableqrdata))
                                                    <div class="col-4"> 
                                                    <a href="{{asset('branch_images/QR/'.$tableqrdata->qrcode)}}" target="_blank" class="my-3" ><img src="{{asset('branch_images/QR/'.$tableqrdata->qrcode)}}" width="160px" height="160px" style="width: 160px !important;" /></a>
                                                    </div>
                                                    <div class="col-8 mb-0">

                                                      <form id="edittableqrForm"  method="post" action="{{route('table-qr.updated')}}">

                                                        @csrf
                                                        <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                                                        <input type="hidden" value="{{$tableqrdata->id}}" name="qrid">  
                                                       <div class="form-group">
                                                          <input type="text" name="table_number" class="form-control col-5 table_number" value="{{$tableqrdata->table_number}}" placeholder="total table">
                                                       </div>
                                                         <button type="submit" class="table-delete  button btn_bg_color common_btn text-white" style="width: 124px;"> Update</button>
                                                      </form>
                                                    </div>
                                                    @else

                                                    <div class="col-4"> 
                                                        <a href="{{asset('branch_images/QR/')}}" target="_blank" class="my-3" ><img src="{{asset('branch_images/QR/')}}" width="160px" height="160px" style="width: 160px !important;" /></a>
                                                        </div>
                                                        <div class="col-8 mb-0">

                                                        <form id="edittableqrForm"  method="post" action="{{route('table-qr.updated')}}">
                                                            @csrf
                                                            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                                                           
                                                           <div class="form-group">
                                                              <input type="text" name="table_number" class="form-control col-5 table_number" value="" placeholder="total table">
                                                           </div>
                                                            <button type="submit" class="table-delete  button btn_bg_color common_btn text-white" style="width: 124px;"> Update</button>
                                                        </form>
                                                    </div>

                                                    @endif

                                                </div>
                                            </div>

                                       
                                    </div>
                                </div>




                                <!--end branch localities -->


                                <!-- add  cars   modal -->
                                <div id="add_cars_modal" class="modal fade" role="dialog" role="dialog"
                                    data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add Cars</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body ">
                                                <form id="addCarsForm" class="model-back" method="post"
                                                    action="{{ route('branch.cars.edit.save') }}">
                                                    <div class="card-body form">
                                                        <div class="row">

                                                            <input type="hidden" name="branch_id"
                                                                value="{{ $branch->id }}">

                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                                <div class="form-group branches">
                                                                    <label for="password"> Cars<span class="text-danger">
                                                                            *</span></label>


                                                                    <select class="advance_category_search catselect"
                                                                        name="cars_id" style="width:200px;">
                                                                        <option value="">Cars</option>

                                                                        @forelse ($cars as $car)
                                                                            <option value="{{ $car->id }}"
                                                                                {{ in_array($car->id, $assign_cars) ? 'disabled' : ' ' }}>
                                                                                {{ $car->model }}
                                                                                ({{ $car->no_plate }})</option>
                                                                        @empty
                                                                            <option disabled>Car not found</option>
                                                                        @endforelse

                                                                    </select>

                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="card-footer" style="padding-top: 24px;">
                                                            <button type="submit"
                                                                class="button btn_bg_color common_btn text-white">Save</button>
                                                        </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- end cars  modal -->











                                <!--
                         <div class="tab-pane fade" id="pills-transactions" role="tabpanel" aria-labelledby="pills-transactions-tab">
                            <div class="card-body">
                               @if (session('status'))
    <div class="alert alert-success" role="alert">
                                  {{ session('status') }}
                               </div>
    @endif
                               <table style="width:100%" id="managers-list" class="table table-bordered table-hover">
                                  <thead>
                                     <tr>
                                        <th class="display-none"></th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>{{ __('adminlte::adminlte.email') }}</th>
                                        <th>{{ __('adminlte::adminlte.contact_number') }}</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <tr>
                                        <th class="display-none"></th>
                                        <td>Demo</td>
                                        <td>Manager</td>
                                        <td>demo@mission22.com</td>
                                        <td>+56498767</td>
                                     </tr>
                                     <tr>
                                        <th class="display-none"></th>
                                        <td>Demo</td>
                                        <td>Manager2</td>
                                        <td>demo2@mission22.com</td>
                                        <td>+56498761</td>
                                     </tr>
                                  </tbody>
                               </table>
                            </div>
                         </div> -->
                            </div>


                            <!-- Edit  cars   modal -->
                            <div id="update_cars_modal" class="modal fade" role="dialog" role="dialog"
                                data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Cars</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editLocalitiesForm" method="post"
                                                action="{{ route('cars.update.existing') }}">
                                                <div class="card-body" id="edit_cars_container">

                                                </div>

                                                <div class="card-footer" style="padding-top: 24px;">
                                                    <button type="submit"
                                                        class="button btn_bg_color common_btn text-white">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!--  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div> -->
                                    </div>
                                </div>
                            </div>


                          

                            <!-- add  drivers   modal -->
                            <div id="add_drivers_modal" class="modal fade" role="dialog" role="dialog"
                                data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Drivers</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body ">
                                            <form id="addDriversForm" method="post"
                                                action="{{ route('branch.drivers.edit.save') }}">
                                                <div class="card-body form">
                                                    <div class="row">
                                                        <input type="hidden" name="branch_id"
                                                            value="{{ $branch->id }}">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                            <div class="form-group branches">
                                                                <label for="password"> Drivers<span class="text-danger">
                                                                        *</span></label>


                                                                <select class="advance_category_search catselect"
                                                                    name="driver_id" style="width:200px;">
                                                                    <option value="">Select Drivers</option>

                                                                    @forelse ($drivers as $driver)
                                                                        <option value="{{ $driver->id }}">
                                                                            {{ $driver->drivers_name }}</option>
                                                                    @empty
                                                                        <option disabled>Driver not found</option>
                                                                    @endforelse

                                                                </select>

                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="card-footer" style="padding-top: 24px;">
                                                        <button type="submit"
                                                            class="button btn_bg_color common_btn text-white">Save</button>
                                                    </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- end drivers  modal -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


  <!--end cars coding -->



    <!-- Start Update  localities   modal -->
    <div id="update_localities_modal" class="modal fade" role="dialog" role="dialog" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Localities</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editLocalitiesForm" class="model-back" method="post"
                        action="{{ route('localities.update.existing') }}">
                        <div class="card-body" id="edit_localities_container">

                        </div>
                    </form>
                </div>
                <!--   <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div> -->
            </div>
        </div>
    </div>




    <!--End Update localities  modal -->

   <div id="update_table_qr_modal" class="modal fade" role="dialog" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Table Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form>
              <div class="card-body">
                <input name="branch_id" type="hidden" id="branch_id">
                <input type="hidden" name="qrid" id="qrid">
                <label>Total Table</label>
                <input type="number" name="table_number" id="table_number" class="form-control">

              </div>

              <div class="card-footer" style="padding-top: 24px;">
                <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit  drivers   modal -->
    <div id="update_drivers_modal" class="modal fade" role="dialog" role="dialog" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Drivers</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editDriversForm" method="post" action="{{ route('drivers.update.existing') }}">
                        <div class="card-body" id="edit_drivers_container">

                        </div>

                        <div class="card-footer" style="padding-top: 24px;">
                            <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
                        </div>
                    </form>
                </div>
                <!--  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div> -->
            </div>
        </div>
    </div>

    <!-- Edit drivers  modal -->


<div id="add_qrcode_modal" class="modal fade" role="dialog" role="dialog"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Table Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">

                <form  id="tableQrCode"  method="post"
                    action="{{ route('qrtable.save') }}">
                    <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="branch_id"
                            value="{{ $branch->id }}">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                            <div class="form-group branches">
                                <label for="password">Total Table<span class="text-danger">
                                        *</span></label>
                                <input type="number" name="table_number" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding-top: 24px;">
                        <input type="submit" value="Save" 
                            class="button btn_bg_color common_btn text-white">
                    </div>
                  </div>
                </form>
            </div>
            <div class="modal-footer">
                <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>


@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <style>
         .table_number{
                margin: 0;
                padding: 0;
                position:absolute;
                top:70%;
                left:20px;
                bottom: 0;
                text-indent: 10px;
            }

         .table-delete{
                position: absolute;
                top:71%;
                left: 185px;
            }

         label#table_number-error {
                position: absolute;
                top: 99%;
                left: 23px;
            }
         .dropzone .dz-message {
                text-align: center;
                margin: 0;
            }

        .tab_wrapper ul li.nav-item {
                width: calc(14.28571428571429% - 5px);
            }

        .tab_wrapper ul.nav.nav-pills {
                width: 100%;
            }

        .dropzoneDragArea {
            background-color: #fbfdff;
            border: 1px dashed #c0ccda;
            border-radius: 6px;
            padding: 60px;
            text-align: center;
            cursor: pointer;
        }

        .dropzone .dz-preview {
            position: relative;
            display: inline-block;
            vertical-align: top;
            margin: 20px 20px 0 0px;
            min-height: 100px;
        }

        .dropzone .dz-preview .dz-remove {
            color: #f43127;
            font-weight: 600;
        }

        div#managers_chosen {
            padding: 16px 22px !important;
            font-size: 14px !important;
            border-radius: 14px !important;
            border: 1px solid #cccccc;
            height: 120px;
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

        .iti {
            position: relative;
            display: inline-block;
            min-width: 100%;
        }


        .chosen-container .chosen-choices {
            width: 100% !important;
            height: 50px !important;
            border-radius: 4px;
        }

            .emojionearea-editor {
            position: relative;
            left: -3px !important;
        }

         /* Small Image Css */

        .upload-small-img img {
            height: 200px;
            object-fit: contain;
            width: 250px;
        }

        .upload-small-img img {
            margin: 0px 0 0;
            border: 1px solid #cccccc;
            padding: 15px;
            border-radius: 20px;
        }

        .remove-branch-small-img {
            top: -8px !important;
        }

        .upload-small-img {
            margin: 22px 0 0;
        }

/*        sddddddddddddddddddddddd*/

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
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <!-- <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script> -->
    <!-- <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/> -->
    <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
    <!-- <script src="{{ asset('docsupport/jquery-3.2.1.min.js') }}"></script> -->
    <link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script type="text/javascript">
        $(document).ready(function() {
            $('.timepickercustom').timepicker({
                'showDuration': true,
                'timeFormat': 'h:i A'
            });
        });


        $(document).ready(function() {
            $('#managers-list').DataTable({
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

            });


        })


        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",

        })




        $(document).ready(function() {

        
            $('#addUser').validate({
                ignore: [],
                debug: false,
                rules: {
                    title_en: {
                        required: true,

                    },
                    title_ar: {
                        required: true,

                    },
                    // description_en: {
                    //     required: true,

                    // },
                    // description_ar: {
                    //     required: true,

                    // },
                    email: {

                        email: true,
                    },

                    //  "managers_id[]":{
                    //    required:true,

                    // },

                    phone_number: {
                        required: true,
                        //phone_valid:true,
                        minlength: 8,
                        maxlength: 15
                    },

                     whatsapp_number: {
                        required: false,
                        //phone_valid:true,
                        minlength: 8,
                        maxlength: 15
                    },
                    secondary_phone_number: {
                        //required:true,
                        //phone_valid:true,
                        minlength: 8,
                        maxlength: 15
                    },
                    country_code: {
                        required: true,
                        country_valid: true
                    },
                    map_link: {
                        //url: true
                    },
                    tour_link: {
                        // url: true
                    },
                    // city_id: {
                    //     required: true,
                    // },
                },
                messages: {
                    title_en: {
                        required: "Title(en)  is required",
                    },
                    title_ar: {
                        required: "Title(ar)   is required",
                    },
                    description_en: {
                        required: "Description(en)  is required",
                    },
                    description_ar: {
                        required: "Description(ar)   is required",
                    },
                    email: {
                        required: " Email is required",
                        email: "Please enter a valid email"
                    },
                    address: {
                        required: " Address  is required",
                    },
                    "managers_id[]": {
                        required: "Manager is required",
                    },
                    country_code: {
                        required: "Country code   is required",
                    },
                    phone_number: {
                        required: " Contact Numer 1  is required",
                        minlength: "Please enter at least 8 digits",
                        maxlength: "Please enter no more than 15 digits",

                    },
                    secondary_phone_number: {
                        minlength: "Please enter at least 8 digits",
                        maxlength: "Please enter no more than 15 digits",

                    },

                       whatsapp_number: {
                        required: " WhatsApp  is required",
                        minlength: "Please enter at least 8 digits",
                        maxlength: "Please enter no more than 15 digits",

                    },

                    map_link: {
                        url: "Map link URL must be valid"
                    },
                    tour_link: {
                        url: "Tour link URL must be valid"
                    },
                    city_id: {
                        required: " Branch City is required"
                    }
                }
            });

            jQuery.validator.addMethod("country_valid", function(value, element) {
                return this.optional(element) || /^(\+?\d{1,3}|\d{1,4})$/.test(value)
                // just ascii letters
            }, "Please enter vaild country code");


          
            $('#tableQrCode').validate({
              rules:{
                   table_number:{
                      required:true,
                      digit: true
                   }
                },
                messages:{
                    table_number:{
                      required:"total table is required"
                   }
                }
            });

        $('#edittableqrForm').validate({
             ignore: [],
             rules: {
               table_number: {
                required: true,
                digit: true
              },
            },
            messages: {
              table_number: {
                required: "total table is required"
              },
             
            },
          });

        $('body').on('click', '.edit_table_qr', function(e) {

          var data_id = $(this).attr('data-id');
          var branch_id = $(this).attr('branch-id');
          var qrcode=$(this).attr('data-qrcode');
          var table_number=$(this).attr('data-table');

          var obj = $(this);

            $('#qrid').val(data_id);
            $('#table_number').val(table_number);
            $('#branch_id').val(branch_id);

            $('#update_table_qr_modal').modal({
              'show':true,
              backdrop: 'static',
              keyboard: false
            });

        });

        $(document).on('click', '.delete-qrcode-button', function(e) {
              var id = $(this).attr('data-id');
              var obj = $(this);
              swal({
                title: "Are you sure?",
                text: "Are you sure you want to  this delete table QR ?",
                type: "warning",
                showCancelButton: true,
              }, function(willDelete) {
                if(willDelete) {
                  $.ajax({
                    type: 'post',
                    url: "{{route('table-qr.delete')}}",
                    data: {
                      id: id
                    },
                    dataType: "JSON",
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                      if(response.success == 1) {
                        $("#flash-message-tableqr").css("display", "block");
                        $("#flash-message-tableqr").removeClass("d-none");
                        $("#flash-message-tableqr").addClass("alert-danger");
                        $('#flash-message-tableqr').html('Table QR Deleted Successfully');
                        obj.parent().parent().remove();
                        setTimeout(() => {
                          $("#flash-message-tableqr").addClass("d-none");
                          location.reload();
                        },2500);
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
        });
    </script>



    <script>
        // Dropzone has been added as a global variable.
        var old_images_name = [];
        Dropzone.autoDiscover = false;
        let token = $('meta[name="csrf-token"]').attr('content');
        //alert(token);
        $(function() {

            const dropzone = new Dropzone("div#dropzoneDragArea", {

                paramName: "file",
                url: "{{ route('update_images') }}",
                previewsContainer: 'div.dropzone-previews',
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 20,
                maxFilesize: 500,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                addRemoveLinks: true,

                acceptedFiles: ".jpeg,.jpg,.png",
                params: {
                    _token: token
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;



                    //Preview Images

                    //   let mockFile = { name: "Filename 2", size: 12345 };
                    // myDropzone.displayExistingFile(mockFile, "http://127.0.0.1:8000/products/16524188147455.jpg");

                    var js_lang = {!! json_encode($user_images) !!};
                    js_lang.forEach(obj => {
                        Object.entries(obj).forEach(([key, value]) => {
                            if (`${key}` === `image_name`) {
                                let key = {
                                    name: `${value}`,
                                    size: 12345
                                };
                                myDropzone.displayExistingFile(key,
                                    "{{ asset('branch_images/') }}/" + `${value}`);
                            }
                        });

                    });





                    //form submission code goes here
                    $("form[name='demoform']").submit(function(event) {





                        // if($(this).valid()){
                        //      if($('.dropzone-previews').html() != "")
                        //       {

                        //       }
                        //       else{
                        //         $('.image_notice').html('Please Upload at least one image');
                        //         setTimeout(function(){
                        //           $('.image_notice').html('');
                        //         },1500);
                        //         return false;
                        //       }

                        //  }
                        //  else{
                        //    return false;
                        //  }

                      $('.custom_message').addClass('d-none');

                        if ($('#title_en').val() != '' && $('#title_ar').val() != '' && $('#country_code')
                        .val() != '' && $('#txtPhone').val() != '') {
                            //alert('success');
                        } else {
                            return false;
                        }




                        // Geting all Uploaded images data.......
                        var old_images_name = " ";
                        $('.dz-complete').each(function() {
                            var c_one = this.children[0];

                            $(c_one).each(function() {
                                old_images_name += this.children[0].alt + "--";
                            });
                        });

                        $("#old_images_name").val(old_images_name);

                        if ($('.variant_notice').text() != "") {
                            return false;
                        }


                        //Make sure that the form isn't actully being sent.
                        // alert();
                        // return false;
                        event.preventDefault();

                        var formData = new FormData(this);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('update_branch') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                if (data == "success") {

                                    if (myDropzone.files.length) {
                                        myDropzone.processQueue();
                                    } else {
                                        setTimeout(function() {
                                            localStorage.setItem(
                                                'success_data',
                                                'Branch has been Updated successfully!'
                                                );

                                        }, 900);
                                    }

                                    $('.image_notice').html('');

                                    $(".custom_message").removeClass('d-none');
                                    scroll(0, 0);
                                    checkKey();


                                    //   localStorage.setItem('success_data', 'Branch details has been updated successfully !');
                                    // window.location.href = "{{ route('branches') }}";
                                }
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });

                    });

                    //Gets triggered when we submit the image.
                    this.on('sending', function(file, xhr, formData) {
                        //fetch the user id from hidden input field and send that userid with our image
                        //  let userid = document.getElementById('userid').value;
                        // formData.append('userid', userid);
                        // formData.append('old_images_name', old_images_name);
                    });

                    this.on("success", function(file, response) {
                        console.log(response);
                        $(".custom_message").removeClass('d-none');
                        scroll(0, 0);
                        checkKey();

                        //reset the form
                        $('#demoform')[0].reset();
                        //reset dropzone
                        $('.dropzone-previews').empty();
                        //  localStorage.setItem('success_data', 'Branch details has been updated successfully !');
                        // window.location.href = "{{ route('branches') }}";

                    });

                    this.on("error", function(file) {
                        // $('.image_notice').html('The uploaded image size is to larage');
                        myDropzone.removeFile(file);
                        swal({
                            title: "Error",
                            text: "The file is too large.  ",
                            type: "warning",
                            showCancelButton: true,
                        });

                        //   setTimeout(function(){
                        //     $('.image_notice').html('');
                        //     myDropzone.removeFile(file);
                        // }, 2000);


                    });



                }

            });

        });


        // //Permission

        //  $(document).ready(function(){
        //       $("#full_access").click(function() {
        //         $("input[type=checkbox]").prop('checked', this.checked)
        //       })
        //  });








        $(document).on('change', '.changestatus', function() {

            var id = $(this).attr('data-id');
            var minutes = $(this).find(':selected').data('minutes');
            var status = $(this).find(':selected').val();
            //alert(id+"" +minutes+" "+status);

            $.ajax({
                url: "{{ route('changebranchitems.status') }}",
                method: "POST",
                data: {
                    'status': status,
                    'minutes': minutes,
                    'id': id,
                },
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    if (response.status == 'true') {
                         swal("Status!", "Status Successfully Updated. ", "success");
                    }

                }
            });

        });





        //Change Menu Category Status

        $(document).on('change', '.changeCategorystatus', function() {

            var id = $(this).attr('data-id');
            var status = $(this).find(':selected').val();

            $.ajax({
                url: "{{ route('changebranchcategory.status') }}",
                method: "POST",
                data: {
                    'status': status,
                    'id': id,
                },
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    if (response.status == 'true') {
                     swal("Status!", "Status Successfully Updated. ", "success");
                    }

                }
            });

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




        $(document).ready(function() {
            $(window).on('click', function() {
                //alert("{{ Request::segment(2) == 'add' && Request::segment(1) == 'branch' ? 'active' : '' }}");
                $('#pills-home-tab').addClass(
                    "{{ Request::segment(2) == 'edit' && Request::segment(1) == 'branch' ? 'active' : '' }}"
                    );

                $('#pills-persmissions-tab').addClass(
                    "{{ Request::segment(2) == 'permission' && Request::segment(1) == 'branch' ? 'active' : '' }}"
                    );

                $('#pills-menuitem-tab').addClass(
                    "{{ Request::segment(2) == 'menuitem' && Request::segment(1) == 'branch' ? 'active' : '' }}"
                    );

                   $('#pills-menucategory-tab').addClass(
                    "{{ Request::segment(2) == 'menucategory' && Request::segment(1) == 'branch' ? 'active' : '' }}"
                    );

                $('#pills-info-tab').addClass(
                    "{{ Request::segment(2) == 'info' && Request::segment(1) == 'branch' ? 'active' : '' }}"
                    );

                $('#pills-localities-tab').addClass(
                    "{{ Request::segment(2) == 'localities' && Request::segment(1) == 'branch' ? 'active' : '' }}"
                    );

                $('#pills-cars-tab').addClass(
                    "{{ Request::segment(2) == 'cars' && Request::segment(1) == 'branch' ? 'active' : '' }}"
                    );

                $('#pills-drivers-tab').addClass(
                    "{{ Request::segment(2) == 'drivers' && Request::segment(1) == 'branch' ? 'active' : '' }}"
                    );


                $('#pills-table-qr-tab').addClass(
                    "{{ Request::segment(2) == 'table-qr' && Request::segment(1) == 'branch' ? 'active' : '' }}"
                    );


                $("#pills-home").addClass(
                    "{{ Request::segment(2) == 'edit' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                    );

                $('#pills-persmissions').addClass(
                    "{{ Request::segment(2) == 'permission' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                    );

                $('#pills-menuitem').addClass(
                    "{{ Request::segment(2) == 'menuitem' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                    );

                $('#pills-menucategory').addClass(
                    "{{ Request::segment(2) == 'menucategory' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                    );


                $('#pills-info').addClass(
                    "{{ Request::segment(2) == 'info' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                    );

                $('#pills-localities').addClass(
                    "{{ Request::segment(2) == 'localities' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                    );

                $('#pills-cars').addClass(
                    "{{ Request::segment(2) == 'cars' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                    );

                $('#pills-drivers').addClass(
                    "{{ Request::segment(2) == 'drivers' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                    );

                $('#pills-table-qr').addClass(
                    "{{ Request::segment(2) == 'table-qr' && Request::segment(1) == 'branch' ? 'show active' : '' }}"
                    );

            });
        })


        function checkKey() {
            // if(localStorage.getItem("success_data") != null){
            //    $('.custom_message').removeClass('d-none');
            //    $('.custom_message').html('Branch has been added successfully ! ');

            //   localStorage.removeItem("success_data");

            // }

            setTimeout(function() {
                $('.custom_message').addClass('d-none');
            }, 1400);

        };

        window.onload = function() {
            checkKey();
        }
    </script>



    <!-- show image on change -->
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {

                var uploaded_pdf = input.files[0];

                if (uploaded_pdf.size < 5000000) {

                } else {
                    swal({
                        title: "Error",
                        text: "The file is too large. Allowed maximum size is 5 MB.",
                        type: "warning",

                    });
                    $(".thumbnail_pic").val(null);
                }



                // Store Preview Links
                var blobURL = URL.createObjectURL(input.files[0]);

                var reader = new FileReader();

                reader.onload = function(e) {

                    $('#thumbnail_preview').css('display', 'block');
                    $(".remove-pro-img").removeClass("d-none");
                    $('#thumbnail_preview').removeClass('d-none');
                    $(".close_btn_container").removeClass('d-none');
                    $('#thumbnail_preview').attr('href', blobURL);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <!-- show image on change -->
    <script>
        // CKEDITOR.replace( 'description_en' ,{

        // });

        // CKEDITOR.replace( 'description_ar' ,{

        // });




        $(".remove-pro-img").click(function(evt) {
            var pdf_name = $('.delete_pdf').attr('pdf_name');
            if (pdf_name.trim() == "") {
                $(".remove-pro-img").addClass("d-none");
                $("#thumbnail_preview").css('display', 'none');

                $(".thumbnail_pic").val(null);
            }

        });





        $('.delete_pdf').on('click', function() {
            var id = $(this).attr('current_id');
            var pdf_name = $(this).attr('pdf_name');

            if (pdf_name.trim() != "") {


                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to  delete this pdf ?",
                    type: "warning",
                    showCancelButton: true,
                }, function(willDelete) {
                    if (willDelete) {

                        $.ajax({
                            url: "{{ route('branch.pdf.remove') }}",
                            method: "POST",
                            data: {
                                'id': id,
                            },
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log("Response", response);

                                //  swal("Status!", "Status Successfully Updated. ", "success");

                                if (response.success == 1) {
                                    $('.delete_pdf').attr('pdf_name', ' ');
                                    $(".remove-pro-img").addClass("d-none");
                                    $("#thumbnail_preview").css('display', 'none');
                                } else {
                                    console.log("FALSE");
                                    setTimeout(() => {
                                        swal('Error', 'Something went wrong', 'error');
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


    <script type="text/javascript">
        $(document).ready(function() {
            $("#rating").emojioneArea({
                pickerPosition: "bottom",
            });
        });
    </script>


    <script>
        $(document).ready(function() {

            $('#addAdditionalInformationdddd').validate({
                ignore: [],
                debug: false,
                rules: {

                    "working_days[]": {
                        required: true,

                    },

                    starting_hour: {
                        required: true,
                    },
                    ending_hour: {
                        required: true,
                    },
                    minimum_order_amount: {
                        required: true,
                    },
                    cuisins: {
                        required: true,
                    },
                    rating: {
                        required: true,
                    },

                    accepts_pre_order: {
                        required: true,
                    },

                },
                messages: {
                    starting_hour: {
                        required: "Branch starting hour   is required",
                    },
                    ending_hour: {
                        required: "Branch ending hour   is required",
                    },
                    minimum_order_amount: {
                        required: "Minimum order amount   is required",
                    },
                    cuisins: {
                        required: "Cuisins    is required",
                    },
                    rating: {
                        required: " rating  is required",

                    },
                    accepts_pre_order: {
                        required: "Pre-Order  is required",
                    },

                    "working_days[]": {
                        required: "Opening day is required",
                    },

                }
            });












        });
    </script>



    <script>
        $(document).ready(function() {

            $('#addAdditionalInformation').submit(function(e) {
                e.preventDefault();

                //Opening day chek validation........
                var count = 0;
                $("#addAdditionalInformation input[type='checkbox']").each(function() {

                    if ($(this).is(':checked')) {
                        count = count + 1;

                    } else {
                        $('.opening_day_notice').removeClass('d-none');
                        $('.opening_day_notice').addClass('custom_error_count');
                    }

                });

                if (count) {
                    $('.opening_day_notice').addClass('d-none');
                    $('.opening_day_notice').removeClass('custom_error_count');
                }

                //End Opening day chek validation........

                //Start validation for sunday

                if ($('#sunday_input').is(':checked')) {
                    var sunday = $('#sunday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        if ($(data).val().trim() == "") {

                            if (data.nextSibling.nodeName == "SMALL") {
                                data.nextSibling.remove();
                            }

                            //$(data).addClass("border-danger");
                            $("<small class='text-danger required-notice custom_error_count'> <i class='fa fa-warning'></i> Branch timing is required</small>")
                                .insertAfter(data);
                        }

                    });



                    //remove required message on input

                    $(inputs).each(function() {

                        $(this).on("click", function() {
                            if (this.nextSibling.nodeName == "SMALL") {
                                this.nextSibling.remove();
                                $(this).removeClass("border-danger");
                            }
                        });
                    });



                } else {
                    var sunday = $('#sunday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    $(inputs).each(function() {


                        if (this.nextSibling.nodeName == "SMALL") {
                            this.nextSibling.remove();
                            $(this).removeClass("border-danger");
                        }
                    });




                }

                //End validation for sunday




                //Start validation for monday

                if ($('#monday_input').is(':checked')) {
                    var sunday = $('#monday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        if ($(data).val().trim() == "") {

                            if (data.nextSibling.nodeName == "SMALL") {
                                data.nextSibling.remove();
                            }

                            //$(data).addClass("border-danger");
                            $("<small class='text-danger required-notice custom_error_count'> <i class='fa fa-warning'></i>Branch timing is required</small>")
                                .insertAfter(data);
                        }

                    });



                    //remove required message on input

                    $(inputs).each(function() {

                        $(this).on("click", function() {
                            if (this.nextSibling.nodeName == "SMALL") {
                                this.nextSibling.remove();
                                $(this).removeClass("border-danger");
                            }
                        });
                    });



                } else {
                    var sunday = $('#monday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    $(inputs).each(function() {


                        if (this.nextSibling.nodeName == "SMALL") {
                            this.nextSibling.remove();
                            $(this).removeClass("border-danger");
                        }
                    });


                }

                //End validation for monday





                //Start validation for Tuesday

                if ($('#tuesday_input').is(':checked')) {
                    var sunday = $('#tuesday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        if ($(data).val().trim() == "") {

                            if (data.nextSibling.nodeName == "SMALL") {
                                data.nextSibling.remove();
                            }

                            // $(data).addClass("border-danger");
                            $("<small class='text-danger required-notice custom_error_count'> <i class='fa fa-warning'></i> Branch timing is required</small>")
                                .insertAfter(data);
                        }

                    });



                    //remove required message on input

                    $(inputs).each(function() {

                        $(this).on("click", function() {
                            if (this.nextSibling.nodeName == "SMALL") {
                                this.nextSibling.remove();
                                $(this).removeClass("border-danger");
                            }
                        });
                    });



                } else {
                    var sunday = $('#tuesday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    $(inputs).each(function() {


                        if (this.nextSibling.nodeName == "SMALL") {
                            this.nextSibling.remove();
                            $(this).removeClass("border-danger");
                        }
                    });


                }

                //End validation for Tuesday



                //Start validation for Wednesday

                if ($('#wednesday_input').is(':checked')) {
                    var sunday = $('#wednesday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        if ($(data).val().trim() == "") {

                            if (data.nextSibling.nodeName == "SMALL") {
                                data.nextSibling.remove();
                            }

                            // $(data).addClass("border-danger");
                            $("<small class='text-danger required-notice custom_error_count'> <i class='fa fa-warning'></i> Branch timing is required</small>")
                                .insertAfter(data);
                        }

                    });



                    //remove required message on input

                    $(inputs).each(function() {

                        $(this).on("click", function() {
                            if (this.nextSibling.nodeName == "SMALL") {
                                this.nextSibling.remove();
                                $(this).removeClass("border-danger");
                            }
                        });
                    });



                } else {
                    var sunday = $('#wednesday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    $(inputs).each(function() {


                        if (this.nextSibling.nodeName == "SMALL") {
                            this.nextSibling.remove();
                            $(this).removeClass("border-danger");
                        }
                    });


                }

                //End validation for Wednesday



                //Start validation for Thursday

                if ($('#thursday_input').is(':checked')) {
                    var sunday = $('#thursday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        if ($(data).val().trim() == "") {

                            if (data.nextSibling.nodeName == "SMALL") {
                                data.nextSibling.remove();
                            }

                            // $(data).addClass("border-danger");
                            $("<small class='text-danger required-notice custom_error_count'> <i class='fa fa-warning'></i> Branch timing is required</small>")
                                .insertAfter(data);
                        }

                    });



                    //remove required message on input

                    $(inputs).each(function() {

                        $(this).on("click", function() {
                            if (this.nextSibling.nodeName == "SMALL") {
                                this.nextSibling.remove();
                                $(this).removeClass("border-danger");
                            }
                        });
                    });



                } else {
                    var sunday = $('#thursday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    $(inputs).each(function() {


                        if (this.nextSibling.nodeName == "SMALL") {
                            this.nextSibling.remove();
                            $(this).removeClass("border-danger");
                        }
                    });


                }

                //End validation for Thursday






                //Start validation for Friday

                if ($('#friday_input').is(':checked')) {
                    var sunday = $('#friday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        if ($(data).val().trim() == "") {

                            if (data.nextSibling.nodeName == "SMALL") {
                                data.nextSibling.remove();
                            }

                            // $(data).addClass("border-danger");
                            $("<small class='text-danger required-notice custom_error_count'> <i class='fa fa-warning'></i> Branch timing is required</small>")
                                .insertAfter(data);
                        }

                    });



                    //remove required message on input

                    $(inputs).each(function() {

                        $(this).on("click", function() {
                            if (this.nextSibling.nodeName == "SMALL") {
                                this.nextSibling.remove();
                                $(this).removeClass("border-danger");
                            }
                        });
                    });



                } else {
                    var sunday = $('#friday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    $(inputs).each(function() {


                        if (this.nextSibling.nodeName == "SMALL") {
                            this.nextSibling.remove();
                            $(this).removeClass("border-danger");
                        }
                    });


                }

                //End validation for Friday







                //Start validation for Saturday

                if ($('#saturday_input').is(':checked')) {
                    var sunday = $('#saturday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        if ($(data).val().trim() == "") {

                            if (data.nextSibling.nodeName == "SMALL") {
                                data.nextSibling.remove();
                            }

                            //$(data).addClass("border-danger");
                            $("<small class='text-danger required-notice custom_error_count'> <i class='fa fa-warning'></i> Branch timing is required</small>")
                                .insertAfter(data);
                        }

                    });



                    //remove required message on input

                    $(inputs).each(function() {

                        $(this).on("click", function() {
                            if (this.nextSibling.nodeName == "SMALL") {
                                this.nextSibling.remove();
                                $(this).removeClass("border-danger");
                            }
                        });
                    });



                } else {
                    var sunday = $('#saturday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    $(inputs).each(function() {


                        if (this.nextSibling.nodeName == "SMALL") {
                            this.nextSibling.remove();
                            $(this).removeClass("border-danger");
                        }
                    });


                }

                //End validation for Saturday




                // Minimum order amount validation

                if ($("input[name='minimum_order_amount']").val().trim() == "") {
                    $("input[name='minimum_order_amount']").next().remove();
                    $("<span class='text-danger custom_error_count'>Minimum order amount is required</span>")
                        .insertAfter($("input[name='minimum_order_amount']"));
                }

                $("input[name='minimum_order_amount']").on('input', function() {
                    $("input[name='minimum_order_amount']").next().remove();
                });



                // Cuisines validation

                if ($("input[name='cuisins']").val().trim() == "") {
                    $("input[name='cuisins']").next().remove();
                    $("<span class='text-danger custom_error_count'>Cuisines is required</span>")
                        .insertAfter($("input[name='cuisins']"));
                }

                $("input[name='cuisins']").on('input', function() {
                    $("input[name='cuisins']").next().remove();
                });


  //                // Branch Delivery Time validation

  //   if($("input[name='branch_delivery_time']").val().trim()==""){
  //    $("input[name='branch_delivery_time']").next().remove();
  //    $("<span class='text-danger custom_error_count'>Delivery time is required</span>").insertAfter($("input[name='branch_delivery_time']"));
  //  }

  //  $("input[name='branch_delivery_time']").on('input', function() {
  //   $("input[name='branch_delivery_time']").next().remove();
  // });


  // // Branch Pickup Time validation

  //   if($("input[name='branch_pickup_time']").val().trim()==""){
  //    $("input[name='branch_pickup_time']").next().remove();
  //    $("<span class='text-danger custom_error_count'>Pickup time is required</span>").insertAfter($("input[name='branch_pickup_time']"));
  //  }

  //  $("input[name='branch_pickup_time']").on('input', function() {
  //   $("input[name='branch_pickup_time']").next().remove();
  // });



                // rating validation

                if ($("textarea[name='rating']").val().trim() == "") {
                    $('.rating_notice').removeClass('d-none');
                    $('.rating_notice').addClass('custom_error_count');
                }

                $(".emojionearea-editor").on('click', function() {

                    $('.rating_notice').addClass('d-none');
                    $('.rating_notice').removeClass('custom_error_count');
                });



                //Accepts pre order validation



                if ($("select[name='accepts_pre_order']").val().trim() == "") {
                    $("select[name='accepts_pre_order']").next().remove();
                    $("<span class='text-danger custom_error_count'>Pre-Order is required</span>")
                        .insertAfter($("select[name='accepts_pre_order']"));
                }

                $("select[name='accepts_pre_order']").on('input', function() {
                    $("select[name='accepts_pre_order']").next().remove();
                });

                //start ajax for submit from

                var container = document.getElementById('addAdditionalInformation');
                var errors_length = container.getElementsByClassName("custom_error_count");


                if (errors_length.length == 0) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('branch.info.update') }}",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response == "success") {

                                $(".custom_message").removeClass('d-none');
                                scroll(0, 0);
                                checkKey();

                            }
                        }
                    });

                }


            });

        });
    </script>





    <script>
        $(document).ready(function() {

            //For Sunday input

            $('#sunday_input').click(function() {
                if ($(this).is(':checked')) {
                    var sunday = $('#sunday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).removeAttr('disabled', false);
                    });
                } else {
                    var sunday = $('#sunday_timing_box')[0];
                    var inputs = sunday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).val(' ');
                        $(data).attr('disabled', true);
                        if (data.nextSibling.nodeName == "SMALL") {
                            data.nextSibling.remove();
                            $(data).removeClass("border-danger");
                        }
                    });
                }
            });



            //For Monday input

            $('#monday_input').click(function() {
                if ($(this).is(':checked')) {
                    var monday = $('#monday_timing_box')[0];
                    var inputs = monday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).removeAttr('disabled', false);
                    });
                } else {
                    var monday = $('#monday_timing_box')[0];
                    var inputs = monday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).val(' ');
                        $(data).attr('disabled', true);
                        if (data.nextSibling.nodeName == "SMALL") {
                            data.nextSibling.remove();
                            $(data).removeClass("border-danger");
                        }
                    });
                }
            });


            //For tuesday input

            $('#tuesday_input').click(function() {
                if ($(this).is(':checked')) {
                    var tuesday = $('#tuesday_timing_box')[0];
                    var inputs = tuesday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).removeAttr('disabled', false);
                    });
                } else {
                    var tuesday = $('#tuesday_timing_box')[0];
                    var inputs = tuesday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).val(' ');
                        $(data).attr('disabled', true);
                        if (data.nextSibling.nodeName == "SMALL") {
                            data.nextSibling.remove();
                            $(data).removeClass("border-danger");
                        }
                    });
                }
            });


            //For wednesday input

            $('#wednesday_input').click(function() {
                if ($(this).is(':checked')) {
                    var wednesday = $('#wednesday_timing_box')[0];
                    var inputs = wednesday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).removeAttr('disabled', false);
                    });
                } else {
                    var wednesday = $('#wednesday_timing_box')[0];
                    var inputs = wednesday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).val(' ');
                        $(data).attr('disabled', true);
                        if (data.nextSibling.nodeName == "SMALL") {
                            data.nextSibling.remove();
                            $(data).removeClass("border-danger");
                        }
                    });
                }
            });



            //For thursday input

            $('#thursday_input').click(function() {
                if ($(this).is(':checked')) {
                    var thursday = $('#thursday_timing_box')[0];
                    var inputs = thursday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).removeAttr('disabled', false);
                    });
                } else {
                    var thursday = $('#thursday_timing_box')[0];
                    var inputs = thursday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).val(' ');
                        $(data).attr('disabled', true);
                        if (data.nextSibling.nodeName == "SMALL") {
                            data.nextSibling.remove();
                            $(data).removeClass("border-danger");
                        }
                    });
                }
            });


            //For friday input

            $('#friday_input').click(function() {
                if ($(this).is(':checked')) {
                    var friday = $('#friday_timing_box')[0];
                    var inputs = friday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).removeAttr('disabled', false);
                    });
                } else {
                    var friday = $('#friday_timing_box')[0];
                    var inputs = friday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).val(' ');
                        $(data).attr('disabled', true);
                        if (data.nextSibling.nodeName == "SMALL") {
                            data.nextSibling.remove();
                            $(data).removeClass("border-danger");
                        }
                    });
                }
            });


            //For saturday input

            $('#saturday_input').click(function() {
                if ($(this).is(':checked')) {
                    var saturday = $('#saturday_timing_box')[0];
                    var inputs = saturday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).removeAttr('disabled', false);
                    });
                } else {
                    var saturday = $('#saturday_timing_box')[0];
                    var inputs = saturday.getElementsByTagName("INPUT");
                    inputs.forEach(function(data) {
                        $(data).val(' ');
                        $(data).attr('disabled', true);
                        if (data.nextSibling.nodeName == "SMALL") {
                            data.nextSibling.remove();
                            $(data).removeClass("border-danger");
                        }
                    });
                }
            });







        })
    </script>





    <script type="text/javascript">
        $(".catselect").select2();
    </script>



    <script>
        $(document).ready(function() {
            var js_lang = {!! json_encode($BranchWorkingHourArray) !!};
            js_lang.forEach(function(data) {
                var all_days = data.days;
                var starting_hour = data.starting_hour;
                var ending_hour = data.ending_hour;

                if (all_days == 'sunday') {

                    $('#sunday_input').trigger('click');
                    $('#starting_hour_sun').val(starting_hour);
                    $('#ending_hour_sun').val(ending_hour);
                    $('#starting_hour_sun , #ending_hour_sun').removeAttr('disabled', false);
                }

                if (all_days == 'monday') {
                    $('#monday_input').trigger('click');
                    $('#starting_hour_mon').val(starting_hour);
                    $('#ending_hour_mon').val(ending_hour);
                    $('#starting_hour_mon , #ending_hour_mon').removeAttr('disabled', false);

                }

                if (all_days == 'tuesday') {
                    $('#tuesday_input').trigger('click');
                    $('#starting_hour_tue').val(starting_hour);
                    $('#ending_hour_tue').val(ending_hour);
                    $('#starting_hour_tue , #ending_hour_tue').removeAttr('disabled', false);

                }

                if (all_days == 'wednesday') {
                    $('#wednesday_input').trigger('click');
                    $('#starting_hour_wed').val(starting_hour);
                    $('#ending_hour_wed').val(ending_hour);
                    $('#starting_hour_wed , #ending_hour_wed').removeAttr('disabled', false);

                }

                if (all_days == 'thursday') {
                    $('#thursday_input').trigger('click');
                    $('#starting_hour_thu').val(starting_hour);
                    $('#ending_hour_thu').val(ending_hour);
                    $('#starting_hour_thu , #ending_hour_thu').removeAttr('disabled', false);

                }

                if (all_days == 'friday') {
                    $('#friday_input').trigger('click');
                    $('#starting_hour_fri').val(starting_hour);
                    $('#ending_hour_fri').val(ending_hour);
                    $('#starting_hour_fri , #ending_hour_fri').removeAttr('disabled', false);
                }

                if (all_days == 'saturday') {
                    $('#saturday_input').trigger('click');
                    $('#starting_hour_sat').val(starting_hour);
                    $('#ending_hour_sat').val(ending_hour);
                    $('#starting_hour_sat , #ending_hour_sat').removeAttr('disabled', false);
                }

            });
        })
    </script>



    <script>
        //addLocalitiesForm


        $(document).ready(function() {


            $('#addLocalitiesForm').validate({
                ignore: [],

                rules: {
                    localities_id: {
                        required: true
                    },
                    delivery_fee: {
                        required: true
                    },
                    minimum_order_amount: {
                        required: true
                    },
                    delivery_time: {
                        required: true
                    }

                },
                messages: {
                    localities_id: {
                        required: "City is required"
                    },
                    delivery_fee: {
                        required: "Delivery Fee is required"
                    },

                    minimum_order_amount: {
                        required: " Minimum Order Amount is required"
                    },
                    delivery_time: {
                        required: "Delivery Time(minutes) is required"
                    }

                },


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



        //delete localities


        $(document).on('click', '.delete-button', function(e) {
            var id = $(this).attr('data-id');
            var obj = $(this);
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to  this localities ?",
                type: "warning",
                showCancelButton: true,
            }, function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('branch.localities.delete') }}",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {

                            if (response.success == 1) {
                                $("#flash-message").css("display", "block");
                                $("#flash-message").removeClass("d-none");
                                $("#flash-message").addClass("alert-danger");
                                $('#flash-message').html('Localities Deleted Successfully');
                                obj.parent().parent().remove();
                                setTimeout(() => {
                                    $("#flash-message").addClass("d-none");
                                    location.reload();
                                }, 2500);
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




        //Edit Localities

        $('body').on('click', '.edit_localities', function(e) {

            var data_id = $(this).attr('data-id');
            var branch_id = $(this).attr('branch-id');
            var city_id = $(this).attr('data-cid');
            var obj = $(this);

            $.ajax({
                type: "post",
                url: "{{ route('localities.edit.justcreated') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": data_id,
                    "branch_id": branch_id,
                    "city_id": city_id
                },
                dataType: "JSON",
                success: function(response) {

                    if (response.status) {

                        $('#edit_localities_container').html(response.html);
                        $('#update_localities_modal').modal({
                            'show': true,
                            backdrop: 'static',
                            keyboard: false
                        });

                    }


                    $(".catselect").select2();



                    $('#editLocalitiesForm').validate({
                        ignore: [],

                        rules: {

                            delivery_fee: {
                                required: true
                            },
                            minimum_order_amount: {
                                required: true
                            },
                            delivery_time: {
                                required: true
                            },
                        },
                        messages: {
                            localities_id: {
                                required: "City is required"
                            },
                            delivery_fee: {
                                required: "Delivery fee is required"
                            },

                            minimum_order_amount: {
                                required: " Minimum order amount is required"
                            },
                            delivery_time: {
                                required: "Delivery Time (minutes) is required "
                            },

                        },


                    });










                }

            });

        });
    </script>






    <script type="text/javascript">
        $(document).ready(function() {

            //01 - click parent select all and select all children

            $('.checkAllPermission').each(function() {
                $(this).click(function() {
                    var getParent = this.parentElement.parentElement.parentElement;
                    var allPermissionBox = getParent.getElementsByClassName('AllPermissionBox')[0];
                    var all_inputs = allPermissionBox.getElementsByTagName('INPUT');

                    if ($(this).is(':checked')) {
                        $(all_inputs).each(function(index, all_input) {
                            $(all_input).prop('checked', 'true');
                        });
                    } else {
                        $(all_inputs).each(function(index, all_input) {
                            $(all_input).prop('checked', false);
                        });
                    }


                });
            });






            //02 - click each child and auto checked/unchecked parent


            $('.permissionsName').each(function() {
                $(this).click(function() {
                    var count = 0;
                    var allPermissionBox = this.parentElement.parentElement.parentElement;
                    var getParentInput = this.parentElement.parentElement.parentElement
                        .parentElement;
                    var parentInput = getParentInput.getElementsByTagName('INPUT')[0];
                    console.log(parentInput);
                    var all_input = allPermissionBox.getElementsByTagName('INPUT');

                    $(all_input).each(function(data) {
                        if ($(this).is(':checked')) {
                            count++;
                        }
                    });

                    if (all_input.length == count) {
                        $(parentInput).prop('checked', 'true');
                    } else {
                        $(parentInput).prop('checked', false);
                    }




                });
            });




            //03 -  onload each child and auto checked/unchecked parent







            //add branch permissions


            $(document).ready(function() {
                $('#UpdateBranchPermissions').submit(function(e) {
                    e.preventDefault();
                    let manager_permission = [];
                    let manager_role = [];
                    let desk1_permission = [];
                    let desk1_role = [];
                    let desk2_permission = [];
                    let desk2_role = [];
                    //   var all_input = this.getElementsByTagName('INPUT');
                    //   let permission = [];
                    //   let role = [];

                    //    $(all_input).each(function(data){
                    //    if($(this).is(':checked')){
                    //        var permissions_name = $(this).attr('permission-name');
                    //        var role_id = $(this).attr('role-id');
                    //        if(permissions_name != undefined){
                    //         permission.push(permissions_name);
                    //        }

                    //        if(role_id != undefined){
                    //         role.push(role_id);
                    //        }



                    //     }
                    // });

                    //  console.log(permission);
                    //  console.log(role);
                    var AllPermissionBox = $('.AllPermissionBox');
                    AllPermissionBox.each(function(index, item) {
                        var all_input = this.getElementsByTagName('INPUT');

                        if (index == 0) {

                            $(all_input).each(function(data) {
                                if ($(this).is(':checked')) {
                                    var permissions_name = $(this).attr(
                                        'branches-permission-id');
                                    var role_id = $(this).attr('role-id');
                                    if (permissions_name != undefined) {
                                        manager_permission.push(permissions_name);
                                    }

                                    if (role_id != undefined) {
                                        manager_role.push(role_id);
                                    }
                                }
                            });

                        } else if (index == 1) {

                            $(all_input).each(function(data) {
                                if ($(this).is(':checked')) {
                                    var permissions_name = $(this).attr(
                                        'branches-permission-id');
                                    var role_id = $(this).attr('role-id');
                                    if (permissions_name != undefined) {
                                        desk1_permission.push(permissions_name);
                                    }

                                    if (role_id != undefined) {
                                        desk1_role.push(role_id);
                                    }
                                }
                            });

                        } else if (index == 2) {

                            $(all_input).each(function(data) {
                                if ($(this).is(':checked')) {
                                    var permissions_name = $(this).attr(
                                        'branches-permission-id');
                                    var role_id = $(this).attr('role-id');
                                    if (permissions_name != undefined) {
                                        desk2_permission.push(permissions_name);
                                    }

                                    if (role_id != undefined) {
                                        desk2_role.push(role_id);
                                    }
                                }
                            });

                        }


                    });


                    // console.log(manager_permission);
                    // console.log(manager_role);
                    // console.log(desk2_permission);
                    // console.log(desk1_permission);
                    // console.log(desk1_role);
                    // console.log(desk2_role);

                    $.ajax({
                        type: "post",
                        url: "{{ route('branch.permission.update') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "manager_permission": manager_permission,
                            "manager_role": manager_role,
                            "desk1_permission": desk1_permission,
                            "desk1_role": desk1_role,
                            "desk2_permission": desk2_permission,
                            "desk2_role": desk2_role,
                            "branch_id": $('#branch_id_permissions').val(),
                        },
                        success: function(response) {
                            localStorage.setItem('success_data',
                                'Permissions has been Updated successfully !');
                            scroll(0, 0);
                            checkKey();
                            // window.location.href="{{ route('branch.localities') }}";
                        }
                    });



                });
            });






        });
    </script>


    <script>
        function checkKey() {
            if (localStorage.getItem("success_data") != null) {
                $('.custom_message').removeClass('d-none');
                $('.custom_message').html(localStorage.getItem("success_data"));

                localStorage.removeItem("success_data");
                setTimeout(function() {
                    $('.custom_message').addClass('d-none');
                }, 1000);

            }
        };

        window.onload = function() {
            checkKey();
        }



        $(document).ready(function() {

            //03 onload click

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


        });
    </script>









    <script type="text/javascript">
        //Add cars form


        $(document).ready(function() {



            $('#addCarsForm').validate({
                ignore: [],

                rules: {

                    cars_id: {
                        required: true,
                        maxlength: 6
                    },
                },
                messages: {
                    cars_id: {
                        required: "Cars is required"
                    }
                },


            });


            $('#cars-list').DataTable({
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data;
                    }
                }]
            });



            //Fot delete................


            //delete localities


            $(document).on('click', '.delete-car-button', function(e) {
                var id = $(this).attr('data-id');
                var obj = $(this);
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to  this delete car ?",
                    type: "warning",
                    showCancelButton: true,
                }, function(willDelete) {
                    if (willDelete) {
                        $.ajax({
                            type: 'post',
                            url: "{{ route('branch.cars.delete') }}",
                            data: {
                                id: id
                            },
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {

                                if (response.success == 1) {
                                    $("#flash-message-cars").css("display", "block");
                                    $("#flash-message-cars").removeClass("d-none");
                                    $("#flash-message-cars").addClass("alert-danger");
                                    $('#flash-message-cars').html(
                                        'Car Deleted Successfully');
                                    obj.parent().parent().remove();
                                    setTimeout(() => {
                                        $("#flash-message-cars").addClass(
                                            "d-none");
                                        location.reload();
                                    }, 2500);
                                } else {

                                    setTimeout(() => {
                                        swal('Error', 'Something went wrong',
                                            'error');
                                        // alert("Something went wrong! Please try again.");
                                    }, 500);
                                }
                            }
                        });
                    }
                });
            });





            //Edit Localities

            $('body').on('click', '.edit_cars', function(e) {



                var data_id = $(this).attr('data-id');
                var branch_id = $(this).attr('branch-id');
                var city_id = $(this).attr('data_cid');

                var obj = $(this);

                $.ajax({
                    type: "post",
                    url: "{{ route('cars.edit.justcreated') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": data_id,
                        "branch_id": branch_id,
                        'car_id': city_id
                    },
                    dataType: "JSON",
                    success: function(response) {

                        if (response.status) {

                            $('#edit_cars_container').html(response.html);
                            $('#update_cars_modal').modal({
                                'show': true,
                                backdrop: 'static',
                                keyboard: false
                            });

                        }


                        $(".catselect").select2();



                        $('#editCarsForm').validate({
                            ignore: [],

                            rules: {

                                delivery_fee: {
                                    required: true,
                                    maxlength: 6
                                },
                                minimum_order_amount: {
                                    required: true,
                                    maxlength: 6
                                },
                                edelivery_time: {
                                    required: true,
                                    maxlength: 6
                                }

                            },
                            messages: {
                                localities_id: {
                                    required: "City is required"
                                },
                                delivery_fee: {
                                    required: "Delivery fee is required"
                                },

                                minimum_order_amount: {
                                    required: " Minimum order amount is required"
                                },
                                edelivery_time: {
                                    required: "Delivery Time(minutes) is required"
                                }

                            },


                        });










                    }

                });

            });



        });
    </script>




    <script type="text/javascript">
        //Add Drivers form


        $(document).ready(function() {



            $('#addDriversForm').validate({
                ignore: [],

                rules: {

                    driver_id: {
                        required: true,
                        maxlength: 6
                    },
                },
                messages: {
                    driver_id: {
                        required: "Drivers is required"
                    }
                },


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



            //Fot delete................





            //delete drivers


            $(document).on('click', '.delete-driver-button', function(e) {
                var id = $(this).attr('data-id');
                var obj = $(this);
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to  this delete driver ?",
                    type: "warning",
                    showCancelButton: true,
                }, function(willDelete) {
                    if (willDelete) {
                        $.ajax({
                            type: 'post',
                            url: "{{ route('branch.drivers.delete') }}",
                            data: {
                                id: id
                            },
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {

                                if (response.success == 1) {
                                    $("#flash-message-drivers").css("display", "block");
                                    $("#flash-message-drivers").removeClass("d-none");
                                    $("#flash-message-drivers").addClass(
                                    "alert-danger");
                                    $('#flash-message-drivers').html(
                                        'Driver Deleted Successfully');
                                    obj.parent().parent().remove();
                                    setTimeout(() => {
                                        $("#flash-message-drivers").addClass(
                                            "d-none");
                                        location.reload();
                                    }, 2500);
                                } else {

                                    setTimeout(() => {
                                        swal('Error', 'Something went wrong',
                                            'error');
                                        // alert("Something went wrong! Please try again.");
                                    }, 500);
                                }
                            }
                        });
                    }
                });
            });




            //Edit Localities

            $('body').on('click', '.edit_drivers', function(e) {



                var data_id = $(this).attr('data-id');
                var branch_id = $(this).attr('branch-id');
                var driver_id = $(this).attr('data_cid');

                var obj = $(this);

                $.ajax({
                    type: "post",
                    url: "{{ route('drivers.edit.justcreated') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": data_id,
                        "branch_id": branch_id,
                        'driver_id': driver_id
                    },
                    dataType: "JSON",
                    success: function(response) {

                        if (response.status) {

                            $('#edit_drivers_container').html(response.html);
                            $('#update_drivers_modal').modal({
                                'show': true,
                                backdrop: 'static',
                                keyboard: false
                            });

                        }


                        $(".catselect").select2();



                        $('#editCarsForm').validate({
                            ignore: [],

                            rules: {

                                delivery_fee: {
                                    required: true,
                                    maxlength: 6
                                },
                                minimum_order_amount: {
                                    required: true,
                                    maxlength: 6
                                },
                                edelivery_time: {
                                    required: true,
                                    maxlength: 6
                                }

                            },
                            messages: {
                                localities_id: {
                                    required: "City is required"
                                },
                                delivery_fee: {
                                    required: "Delivery fee is required"
                                },

                                minimum_order_amount: {
                                    required: " Minimum order amount is required"
                                },
                                edelivery_time: {
                                    required: "Delivery Time(minutes) is required"
                                }

                            },


                        });










                    }

                });

            });



        });
    </script>





















    <script type="text/javascript">
        function BranchBigPictureURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {

                    var image = new Image();
                    image.src = e.target.result;

                    image.onload = function() {
                        var height = this.height;
                        var width = this.width;

                        $('#branch_image_preview').css('display', 'block');
                        $('#branch_image_preview').removeClass("d-none");
                        $(".upload-img").removeClass("d-none");
                        $('#branch_image_preview').attr('src', e.target.result);

                    };


                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(".remove-branch-big-img").click(function(evt) {

            var id = $(this).attr('current_id');

            if (id != "" && id != null) {
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to  delete this image ?",
                    type: "warning",
                    showCancelButton: true,
                }, function(willDelete) {
                    if (willDelete) {

                        $.ajax({
                            url: "{{ route('branch_image.remove') }}",
                            method: "POST",
                            data: {
                                'id': id,
                            },
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log("Response", response);

                                //  swal("Status!", "Status Successfully Updated. ", "success");

                                if (response.success == 1) {
                                    $(".upload-img").addClass("d-none");
                                    $("#branch_image_preview").css('display', 'none');
                                    $('.branch_image').removeClass('d-none');
                                    $(".branch_image").val(null);
                                    $('.old_big_image_name').val('');
                                    $('.remove-branch-big-img').removeAttr('current_id');
                                } else {
                                    console.log("FALSE");
                                    setTimeout(() => {
                                        swal('Error', 'Something went wrong', 'error');
                                        // alert("Something went wrong! Please try again.");
                                    }, 500);
                                }

                            }
                        });
                    }
                });

            } else {
                $(".upload-img").addClass("d-none");
                $("#branch_image_preview").css('display', 'none');
                $(".branch_image").val(null);
            }

        });
    </script>


    <script type="text/javascript">
        function BranchSmallPictureURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {

                    var image = new Image();
                    image.src = e.target.result;

                    image.onload = function() {
                        var height = this.height;
                        var width = this.width;
                        if (height == 200 && width == 374) {

                            $('#branch_small_image_preview').css('display', 'block');
                            $('#branch_small_image_preview').removeClass("d-none");
                            $(".upload-small-img").removeClass("d-none");
                            $('#branch_small_image_preview').attr('src', e.target.result);

                        } else {
                            $('#branch_small_image').val('');
                            toastr.error('Please upload an image with 374 x 200 pixels dimension');
                            return false;
                        }
                    };


                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(".remove-branch-small-img").click(function(evt) {

            var id = $(this).attr('current_id');

            if (id != "" && id != null) {
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to delete this image ?",
                    type: "warning",
                    showCancelButton: true,
                }, function(willDelete) {
                    if (willDelete) {

                        $.ajax({
                            url: "{{ route('branch_image.remove') }}",
                            method: "POST",
                            data: {
                                'id': id,
                            },
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log("Response", response);

                                //  swal("Status!", "Status Successfully Updated. ", "success");

                                if (response.success == 1) {
                                    $(".upload-small-img").addClass("d-none");
                                    $("#branch_small_image_preview").css('display', 'none');
                                    $('.branch_small_image').removeClass('d-none');
                                    $(".branch_small_image").val(null);
                                    $('.old_small_image_name').val('');
                                    $('.remove-branch-small-img').removeAttr('current_id');
                                } else {
                                    console.log("FALSE");
                                    setTimeout(() => {
                                        swal('Error', 'Something went wrong', 'error');
                                        // alert("Something went wrong! Please try again.");
                                    }, 500);
                                }

                            }
                        });
                    }
                });
            } else {
                $(".upload-small-img").addClass("d-none");
                $("#branch_small_image_preview").css('display', 'none');
                $(".branch_small_image").val(null);
            }
        });
    </script>
    <script>
        $("form[name='demoform']").submit(function(event) {
            //Make sure that the form isn't actully being sent.

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                }
            });

            $('.custom_message').addClass('d-none');

            if ($('#title_en').val() != '' && $('#title_ar').val() != '' && $('#country_code')
                .val() != '' && $('#txtPhone').val() != '') {
                //alert('success');
            } else {
                return false;
            }


            if ($('.variant_notice').text() != "") {
                return false;
            }

            event.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('update_branch') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    if (data == "success") {

                        setTimeout(function() {
                            localStorage.setItem(
                                'success_data',
                                'Branch has been Updated successfully!'
                            );

                        }, 300);

                        //  localStorage.setItem('success_data', 'Branche has been added successfully!');
                        //window.location.href = "{{ route('branch.permission') }}";


                        setTimeout(function() {
                            $(".custom_message").removeClass('d-none');
                            scroll(0, 0);
                            checkKey();
                            location.reload();
                        }, 700)


                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });




        });
    </script>

@stop
