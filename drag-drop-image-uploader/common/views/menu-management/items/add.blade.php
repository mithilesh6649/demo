@extends('adminlte::page') @section('title', ' Super Admin | Add Menu Item') @section('content_header')
<style>
    .text-danger {
        color: red !important;
    }
</style> @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                            <h3>Add Menu Item</h3>
                            <a class="btn btn-sm btn-success"
                                href="{{ route('menu.item.list') }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body p-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                                @endif @if (session('item_saved'))
                                    <div class="alert alert-success" role="alert"> {{ session('item_saved') }} </div>
                                @endif
                                <!-- tab content here -->
                                <div class="tab_wrapper">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link nav_link  menu_item_add d-none" id="pills-home-tab"
                                                data-toggle="pill" href="{{ route('menu.item.add') }}" role="tab"
                                                aria-controls="pills-home" aria-selected="true">Item</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav_link disabled  menu_item_choice_group"
                                                id="pills-transactions-tab" data-toggle="pill"
                                                href="{{ route('menu.item.add.choice') }}" role="tab"
                                                aria-controls="pills-transactions" aria-selected="false">Choice Groups</a>
                                        </li>
                                        <li class="nav-item d-none">
                                            <a class="nav-link nav_link disabled menu_item_currentoffers"
                                                id="pills-currentoffers-tab" data-toggle="pill"
                                                href="{{ route('current_offers.index') }}" role="tab"
                                                aria-controls="pills-transactions" aria-selected="false">Current Offers</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade  menu_item_add_show" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab">
                                            <!-- item tab content -->
                                            <form id="addMenuItemForm" method="post" action="{{ route('menu.item.save') }}"
                                                enctype="multipart/form-data"> @csrf
                                                <div class="card-body table form mb-0">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="item_name_en">Item Name(en)<span
                                                                        class="text-danger"> *</span></label>
                                                                <input type="text" name="item_name_en"
                                                                    class="form-control" id="item_name_en" maxlength="100">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="item_name_ar">Item Name(ar)<span
                                                                        class="text-danger"> *</span></label>
                                                                <input type="text" name="item_name_ar"
                                                                    class="form-control" id="item_name_ar" value=""
                                                                    maxlength="100">
                                                            </div>
                                                        </div>
                                                        <!--Description in english -->
                                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="description_en">Description{{ labelEnglish() }}
                                                                </label>
                                                                <textarea name="description_en"></textarea>
                                                            </div>
                                                        </div>
                                                        <!--Description in english -->
                                                        <!--Description in english -->
                                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="description_ar">Description{{ labelArabic() }}
                                                                </label>
                                                                <textarea name="description_ar"> </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                            <div class="form-group branch-city mb-3">
                                                                <label for="cat_id">Category<span class="text-danger">
                                                                        *</span></label>
                                                                <br>
                                                                <select class="form-control catselect" name="cat_id"
                                                                    id="category_value">
                                                                    <option value="">Select Category</option>

                                                                    @forelse ($menuCategories as $category)
                                                                        @if ($category->name_en == 'Loyalty')
                                                                            <option value="loyalty">
                                                                                {{ $category->name_en ?? '' }}({{ $category->name_ar }})
                                                                            </option>
                                                                        @else
                                                                            <option value="{{ $category->id }}">
                                                                                {{ $category->name_en ?? '' }}({{ $category->name_ar }})
                                                                            </option>
                                                                        @endif
                                                                    @empty
                                                                        <option disabled>Please add category first</option>
                                                                    @endforelse
                                                                </select>
                                                                @if ($errors->has('category'))
                                                                    <div class="error">{{ $errors->first('category') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- Add To Regular --}}


                                                    <div
                                                        class="added_content d-flex align-items-center justify-content-between flex-wrap">
                                                        <div class="first_content d-flex align-items-center">
                                                            <div class="custom-check">
                                                                <input type="checkbox" id="regular_checkbox"
                                                                    name="regular_checkbox" class="regular_checkbox"
                                                                    data-id="0">
                                                                <span></span>
                                                            </div>
                                                            <strong class="list-text"> &nbsp; Add to Regular Item </strong>
                                                        </div>

                                                        <div
                                                            class="input_content d-flex align-items-center justify-content-between flex-wrap">
                                                            <div class="second_content">
                                                                <div class="form-group">
                                                                    <input type="number" name="price"
                                                                        class="form-control regular_input_value"
                                                                        id="price" maxlength="9">
                                                                </div>
                                                            </div>

                                                            <div class="third_content regular_status">
                                                                <div class="form-group">
                                                                    <select class="form-control" name="status">
                                                                        @foreach ($status as $status_data)
                                                                            <option value="{{ $status_data->value }}">
                                                                                {{ $status_data->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- ------------- --}}

                                                    {{-- Loyalty Item Content --}}

                                                    <div
                                                        class="added_content d-flex align-items-center justify-content-between flex-wrap">
                                                        <div class="first_content d-flex align-items-center">
                                                            <div class="custom-check">
                                                                <input type="checkbox" id="loyality_checkbox"
                                                                    name="loyality_checkbox" class="loyality_checkbox"
                                                                    data-id="0">
                                                                <span></span>
                                                            </div>
                                                            <strong class="list-text"> &nbsp; Add to Loyalty Item </strong>
                                                        </div>

                                                        <div
                                                            class="input_content d-flex align-items-center justify-content-between flex-wrap">
                                                            <div class="second_content">
                                                                <div class="form-group">
                                                                    <input type="number"
                                                                        class="form-control loyality_item_points"
                                                                        id="loyality_item_points"
                                                                        name="loyality_item_points">
                                                                </div>
                                                            </div>

                                                            <div class="third_content switch_container">
                                                                <div class="form-group">
                                                                    <select class="form-control" name="loyalty_status"
                                                                        id="loyalty_status">

                                                                        @foreach ($status as $status_data)
                                                                            <option value="{{ $status_data->value }}">
                                                                                {{ $status_data->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- --------------- --}}





                                                    {{-- Most Selling Item Content --}}

                                                    <div class="added_content d-flex align-items-center  flex-wrap">
                                                        <div class="first_content d-flex align-items-center">
                                                            <div class="custom-check">
                                                                <input type="checkbox" id="mostselling_checkbox"
                                                                    name="mostselling_checkbox"
                                                                    class="mostselling_checkbox" data-id="0">
                                                                <span></span>
                                                            </div>
                                                            <strong class="list-text"> &nbsp; Add to Most Selling </strong>
                                                        </div>



                                                    </div>


                                                    <div class="row">

                                                        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                            <div class="form-group mt-3">
                                                                <label for="password_confirmation">Image (400x200)</label>
                                                                <input type="file" name="thumbnail" id="thumbnail"
                                                                    onchange="readURL(this);" accept=".png, .jpg, .jpeg"
                                                                    class="form-control">
                                                                @if ($errors->has('thumbnail'))
                                                                    <div class="error">{{ $errors->first('thumbnail') }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="upload-img  d-none"
                                                                style="position:relative;width:250px;">
                                                                <a href="javascript:;"
                                                                    class="remove-pro-imgdelete_pdf delete_cate_image d-none"
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

                                                                <img src="" class="thumbnail_preview"
                                                                    id="thumbnail_preview" style="width: 250px;"
                                                                    alt="image">

                                                            </div>

                                                        </div>

                                                        <div class="col-md-12 col-lg-12 col-xl-12 col-12 mt-3">
                                                            <div class="form-group tagline">
                                                                <label>Tagline <span class="text-danger">*</span></label>
                                                                <input type="text" name="tagline" maxlength="200"
                                                                    id="tagline">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit"
                                                            class="button btn_bg_color common_btn text-white">Save</button>
                                                    </div>
                                                </div> <!-- /.card-body -->
                                            </form>
                                            <!-- item tab content -->
                                        </div>
                                        <div class="alert d-none" role="alert" id="flash-message"> </div>
                                        <div class="tab-pane  menu_item_choice_show" id="pills-transactions"
                                            role="tabpanel" aria-labelledby="pills-transactions-tab">
                                            <div class="d-flex align-items-center justify-content-between">

                                                <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0 mb-0 w-100"
                                                    style="border-bottom: none;">
                                                    <h3></h3>
                                                    <a class="btn btn-sm btn-success mb-0" href="javascript:;"
                                                        data-toggle="modal" data-target="#choice_group_modal">Add Choice
                                                        Group</a>
                                                </div>
                                            </div>
                                            <div class="card-body table choices">
                                                @if (session('status'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ session('status') }} </div>
                                                @endif
                                                <table style="width:100%" id="choice-list"
                                                    class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="display-none"></th>
                                                            <th>Group Name (en)</th>
                                                            <th>Group Name (ar)</th>
                                                            <th>Choices (en)</th>
                                                            <th>Choices (ar)</th>
                                                            <th style="min-width:90px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="choicegp">
                                                        @foreach ($choicegroup as $choice)
                                                            <tr>
                                                                <td class="display-none"></td>
                                                                <td>{{ $choice->name_en }}</td>
                                                                <td>{{ $choice->name_ar }}</td>
                                                                <td>
                                                                    @foreach ($choice->choice as $choicegroup)
                                                                        {{ $choicegroup->name_en }}({{ $choicegroup->price }}),
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @foreach ($choice->choice as $choicegroup)
                                                                        {{ $choicegroup->name_ar }}({{ $choicegroup->price }}),
                                                                    @endforeach
                                                                </td>
                                                                <td> <a data-id="{{ $choice->id }}"
                                                                        class="action-button edit-button" title="Edit"
                                                                        href="javascript:void(0)"><i
                                                                            class="text-warning fa fa-edit"></i></a> <a
                                                                        data-id="{{ $choice->id }}"
                                                                        class="action-button delete-button" title="Delete"
                                                                        href="javascript:void(0)"><i
                                                                            class="text-danger fa fa-trash-alt"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- current offers modules -->
                                        <div class="tab-pane  menu_item_currentoffers_show" id="pills-transactions"
                                            role="tabpanel" aria-labelledby="pills-currentoffers-tab">

                                            <div class="card-body p-0">
                                                @if (session('status'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ session('status') }} </div>
                                                @endif


                                                <form id="formcurrent_offers" action="{{ route('current_offers.save') }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body table form mb-0">
                                                        <div class="row">

                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="current_offer_name">Offer Name <span
                                                                            class="text-danger"> *</span></label>
                                                                    <input type="text" name="current_offer_name"
                                                                        id="current_offer_name" class="form-control subs">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="current_offer_description">Description
                                                                        <span class="text-danger"> *</span></label>
                                                                    <input type="text" name="current_offer_description"
                                                                        id="current_offer_description"
                                                                        class="form-control subs">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                                <div class="form-group mt-3">
                                                                    <label for="total_choice_count ">Offer Type <span
                                                                            class="text-danger"> *</span></label>
                                                                    <select class="form-select" id="select"
                                                                        name="offers_type">
                                                                        <option value="">Offer Type</option>

                                                                        @foreach ($offerType as $offerTypes)
                                                                            <option value="{{ $offerTypes->value }}">
                                                                                {{ $offerTypes->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                                <div class="form-group mt-3">
                                                                    <label for="current_offer_amount">Percentage/Amount
                                                                        <span class="text-danger"> *</span> </label>
                                                                    <input type="number" name="current_offer_amount"
                                                                        id="current_offer_amount" maxlength="9"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                                <div class="form-group mt-3">
                                                                    <label for="current_offer_startdate">Start Date/ Time
                                                                        <span class="text-danger"> *</span> </label>
                                                                    <input type="text" name="current_offer_startdate"
                                                                        id="current_offer_startdate" autocomplete="off"
                                                                        class="form-control current__offerdatepicker">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                                <div class="form-group mt-3">
                                                                    <label for="current_offer_enddate">End Date/ Time<span
                                                                            class="text-danger"> *</span></label>
                                                                    <input type="text" name="current_offer_enddate"
                                                                        id="current_offer_enddate" autocomplete="off"
                                                                        class="form-control current__offerdatepicker">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                                <div class="form-group mt-3">
                                                                    <label>Image<span class="text-danger"> *</span></label>
                                                                    <input type="file" onchange="readURLL(this);"
                                                                        accept=".png, .jpg, .jpeg" name="c_offerimage"
                                                                        class="form-control">
                                                                    <div class="upload-img d-none"
                                                                        style="position:relative;width:250px;">
                                                                        <a href="javascript:;" class="remove-pro-img"
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
                                                                                        <rect width="256.1"
                                                                                            height="255.86"
                                                                                            fill="white" />
                                                                                    </clipPath>
                                                                                </defs>
                                                                            </svg>
                                                                        </a>
                                                                        <img src="" id="current_thumbnail_preview"
                                                                            style="width:250;display:none;">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                                <div class="form-group mt-3">
                                                                    <label>Status</label>
                                                                    <select name="current_offer_status"
                                                                        class="form-select">

                                                                        @foreach ($status as $status_data)
                                                                            <option value="{{ $status_data->value }}">
                                                                                {{ $status_data->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                                <label class="mb-1 mt-2 d-block">Current Offer applied on
                                                                    <a class="btn info_btn" data-toggle="tooltip"
                                                                        data-placement="right" title="Select Branches ">
                                                                        <i class="fa fa-question-circle"></i>
                                                                    </a>
                                                                </label>
                                                            </div>

                                                            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                                <div class="btn-group mt-2 mb-4" style="width: 49.333%;">
                                                                    <div class="left_tab w-100">
                                                                        <button type="button"
                                                                            class="btn btn-warning w-100"
                                                                            id="branch-modal"> Branch</button>
                                                                        <div class="border d-none mt-3"
                                                                            id="all_selected_branch_container">
                                                                            <!-- <h5>Selected Branches List</h5> -->
                                                                            <table class="d-none braches">
                                                                                <thead>

                                                                                    <!--    <th>Branch Name</th> -->
                                                                                </thead>
                                                                                <tbody id="show_all_selected_branch">

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <p class=" d-none select_notice p-2 border bg-danger"
                                                                    style="width:fit-content;">Branch is required</p>
                                                            </div>


                                                            <div id="branches-modal" class="modal  fade  "
                                                                role="dialog">
                                                                <div class="modal-dialog ">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content menu">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">
                                                                                <div>
                                                                                    Add Branches
                                                                                </div>
                                                                            </h4>
                                                                            <p class=" d-none select_branch_warning p-2 border bg-danger"
                                                                                style="width:fit-content;">Please Select
                                                                                branch and proceed</p>

                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!--start container -->
                                                                            <div class="container-fluid"
                                                                                id="quick_view_container">
                                                                                <div class="accordion"
                                                                                    id="accordionExample">
                                                                                    <div class="card categories">
                                                                                        <div class="card-header "
                                                                                            data-toggle="collapse"
                                                                                            data-target="#collapseOne"
                                                                                            aria-expanded="true">
                                                                                            <span class="title">Select
                                                                                                Branch</span>
                                                                                            <span class="accicon"><i
                                                                                                    class="fas fa-angle-down rotate-icon"></i></span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="card-body branch_all_inputs_container">
                                                                                            <div
                                                                                                class="all-content d-flex align-items-center">
                                                                                                <div class="custom-check">
                                                                                                    <input type="checkbox"
                                                                                                        id="category"
                                                                                                        name="branch[]"
                                                                                                        class="checkBranchAll">
                                                                                                    <span></span>
                                                                                                </div>
                                                                                                <strong class="list-text">
                                                                                                    &nbsp; All </strong>
                                                                                            </div>
                                                                                            <div class="branch-container">
                                                                                                @forelse ($branchs as $branch)
                                                                                                    <div
                                                                                                        class="d-flex align-items-center">
                                                                                                        <div
                                                                                                            class="custom-check">
                                                                                                            <input
                                                                                                                type="checkbox"
                                                                                                                id="category"
                                                                                                                name="branches[]"
                                                                                                                class="ckbCheckAll branch_inputs"
                                                                                                                value="{{ $branch->id }}"
                                                                                                                branch-name-attr="{{ $branch->title_en }}">
                                                                                                            <span></span>
                                                                                                        </div>
                                                                                                        <strong
                                                                                                            class="list-text">
                                                                                                            &nbsp;
                                                                                                            {{ $branch->title_en }}</strong>
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
                                                                        <div class="card-footer pt-0 pb-4 "
                                                                            align="center">
                                                                            <div class="btn-group">
                                                                                <button type="button"
                                                                                    class="btn btn-success"
                                                                                    id="branch_unselect_all">Close</button>
                                                                                <button type="button"
                                                                                    class="btn btn-danger"
                                                                                    id="branch_save_countinue">Save and
                                                                                    Continue</button>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <!--end modal -->
                                                                <!-- end branch modal -->
                                                                <div class="pl-3 mb-3">
                                                                    <span class="text-danger  d-none  select_notice">
                                                                        Select at least one </span>
                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>

                                                            <!-- add choices -->
                                                        </div>
                                                        <!-- /.card-body -->
                                                        <div class="card-footer p-0">
                                                            <button type="submit"
                                                                class="button btn_bg_color common_btn text-white">Save</button>
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
        <!-- choice group modal -->
        <div id="choice_group_modal" class="modal fade" role="dialog" role="dialog" data-backdrop="static"
            data-keyboard="false">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Choice Group</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body ">
                        <div class="card-main m-0">
                            <form id="addChoiceGroupForm" enctype='multipart/form-data' class="model-back p-0">
                                <div class="card-body mb-0">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group">
                                                <label for="name_en">Group Name (en)<span class="text-danger">
                                                        *</span></label>
                                                <input type="text" name="name_en" class="form-control "
                                                    id="choice_name_en" maxlength="100"> <small
                                                    class='text-danger d-none choice_name_en_warning'> <i
                                                        class='fa fa-warning'></i> This field can't be empty</small>
                                                @if ($errors->has('name_en'))
                                                    <div class="error">{{ $errors->first('name_en') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group">
                                                <label for="name_ar">Group Name (ar)<span class="text-danger">
                                                        *</span></label>
                                                <input type="text" name="name_ar" class="form-control"
                                                    id="choice_name_ar" maxlength="100"> <small
                                                    class='text-danger d-none choice_name_ar_warning'> <i
                                                        class='fa fa-warning'></i> This field can't be empty</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group">
                                                <label for="mendatory_choice_count">Minimum Number of Choices</label>
                                                <select class="form-control mendatory_choice_count"
                                                    name="mendatory_choice_count">
                                                    <option value="0" selected>0(optional)</option>
                                                    <option value="1">1</option>
                                                </select>
                                                @if ($errors->has('mendatory_choice_count'))
                                                    <div class="error">{{ $errors->first('mendatory_choice_count') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group">
                                                <label for="total_choice_count ">Maximum number of choices</label>
                                                <select name="total_choice_count" id="newtotal_choice_count">
                                                    <option>1</option>
                                                </select>
                                                <input type="hidden" class="form-control" id="total_choice_count"
                                                    value="1" readonly>
                                                @if ($errors->has('total_choice_count '))
                                                    <div class="error">{{ $errors->first('total_choice_count ') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal_content">
                                        <div class="add-choices d-flex justify-content-end" style="margin-top: 20px;">
                                            <!-- <p style="font-weight:700;font-size:16px;color:#343e49;border-bottom:1px solid grey;">Choices</p>  -->
                                            <button type="button" class="add_new_choice">Add More Choices</button>
                                        </div>
                                    </div>
                                    <div class="row choices_parent" id="choices">
                                        <div class="col-12">
                                            <div class="row choices_child mt-2 pl-0">

                                                <div class="col-md-4  col-lg-4  col-xl-4 col-12">
                                                    <div class="mainEnglisChoiceContainer">
                                                        <div class="form-group">
                                                            <label for="choice_name_en">Choice Name(en)<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="choice_name_en[]"
                                                                class="form-control dynamic_name_en englishChoiceInput "
                                                                autocomplete="off" maxlength="100">
                                                        </div>


                                                        <div class="border-lg englishChoiceSuggestionBox d-none"
                                                            style="overflow-x:auto;height:180px;width:100%;position:absolute;z-index: 1000;background-color:#ffcdca;cursor: pointer;">

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-4  col-lg-4  col-xl-4 col-12">
                                                    <div class="mainArabicChoiceContainer">
                                                        <div class="form-group">
                                                            <label for="choice_name_ar">Choice Name(ar)<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="choice_name_ar[]"
                                                                class="form-control dynamic_name_ar arabicChoiceInput"
                                                                maxlength="100">
                                                        </div>

                                                        <div class="border-lg arabicChoiceSuggestionBox d-none "
                                                            style="overflow-x:auto;height:180px;width:100%;position:absolute;z-index: 1000;background-color:#ffcdca;cursor: pointer;">



                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-3 col-12">
                                                    <div class="form-group">
                                                        <label for="choice_price">Price({{ env('AMOUNT_SIGN') }}) </label>
                                                        <input type="number" name="choice_price[]" class="form-control"
                                                            value="" step="any">
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-lg-1 col-xl-1 col-2 delete">
                                                    <!-- <i class="text-danger fa fa-trash-alt" style="font-size:28px"></i> --><i
                                                        class="text-success">Default</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- add choices -->
                                </div>
                                <!-- /.card-body -->
                                <div class="modal-footer pb-0" style="margin-top: 24px;">
                                    <button type="submit" class="button btn_bg_color common_btn text-white">Save</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div> -->
            </div>
        </div>
    </div>

    <!-- edit choice group modal -->
    <div id="edit_group_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Choice Group</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="card-main m-0">
                        <form id="editChoiceGroupForm" enctype="multipart/form-data" class="model-back p-0">
                            <div class="card-body form mb-0">
                                <div class="row">
                                    <input type="hidden" name="choice_group_id" id="choice_group_id">
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label for="name_en">Group Name(en)<span class="text-danger">
                                                    *</span></label>
                                            <input type="text" name="name_en" class="form-control" id="edit_name_en"
                                                maxlength="100">
                                            @if ($errors->has('name_en'))
                                                <div class="error">{{ $errors->first('name_en') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label for="name_ar">Group Name(ar)<span class="text-danger">
                                                    *</span></label>
                                            <input type="text" name="name_ar" class="form-control" id="edit_name_ar"
                                                maxlength="100">
                                            @if ($errors->has('name_ar'))
                                                <div class="error">{{ $errors->first('name_ar') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label for="mendatory_choice_count">Minimum Number of Choices</label>
                                            <select class="form-control edit_mendatory_choice_count"
                                                id="edit_mendatory_choice_count" name="mendatory_choice_count"> </select>
                                            @if ($errors->has('mendatory_choice_count'))
                                                <div class="error">{{ $errors->first('mendatory_choice_count') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label for="total_choice_count ">Maximum number of choices</label>
                                            <select name="total_choice_count" id="ttotal_choice_countd">

                                            </select>
                                            <input type="hidden" class="form-control" id="edit_total_choice_count"
                                                maxlength="100" value="1" readonly>
                                            @if ($errors->has('total_choice_count '))
                                                <div class="error">{{ $errors->first('total_choice_count ') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal_content">
                                    <div class="add-choices d-flex justify-content-end" style="margin-top: 20px;">
                                        <!-- <p style="font-weight:700;font-size:16px;color:#343e49;border-bottom:1px solid grey;">Choices</p>  -->
                                        <button type="button" class="add_new_choice ml-0">Add More Choices</button>
                                    </div>
                                </div>
                                <div class="row edit_choices_parent" id="choices">
                                    <div class="col-12">
                                        <div class="row choices_child mt-2 pl-0">

                                            <div class="col-md-4 col-lg-4 col-xl-4 col-12">

                                                <div class="form-group">
                                                    <label for="choice_name_en">Choice Name(en)<span class="text-danger">
                                                            *</span></label>
                                                    <input type="text" name="choice_name_en[]" class="form-control"
                                                        maxlength="100">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                                                <div class="form-group">
                                                    <label for="choice_name_ar">Choice Name(ar)<span class="text-danger">
                                                            *</span></label>
                                                    <input type="text" name="choice_name_ar[]" class="form-control"
                                                        maxlength="100">
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3 col-12">
                                                <div class="form-group">
                                                    <label for="choice_price">Price </label>
                                                    <input type="number" name="choice_price[]" class="form-control"
                                                        value="" step="any">
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete">
                                                <!-- <i class="text-danger fa fa-trash-alt" style="font-size:28px"></i> --><i
                                                    class="text-success">Default</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- add choices -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer p-0" style="margin-top: 24px;">
                                <button type="submit" class="button btn_bg_color common_btn text-white">Update</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- choice group modal -->



    <!-- Cropper Popup -->
    <div class="modal fade" id="cropper-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">
                        <svg width="40" height="35" viewBox="0 0 512 470" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_0_1)">
                                <path
                                    d="M511.79 41.6V301.5C508.66 323.5 495.31 336.01 474.67 341.87C471.945 342.618 469.124 342.955 466.3 342.87C455.087 342.91 443.877 342.94 432.67 342.96H430.99C332.7 343.17 234.42 342.88 136.14 343.18C112.45 343.26 96.78 331.7 86.39 311.79C82.56 304.45 83.61 295.79 83.5 287.72C83.15 262.09 83.34 236.44 83.38 210.8C83.44 169.92 83.21 129.05 83.48 88.17V87.02C83.48 86.66 83.48 86.3 83.48 85.94C83.8 70.94 82.48 55.94 84.4 41.06C87.16 20.14 106.07 -0.0499823 131.14 0.0600177C243 0.300018 354.86 0.140013 466.71 0.180013C477.698 0.166221 488.307 4.19563 496.516 11.5004C504.724 18.8052 509.958 28.8747 511.22 39.79C511.22 40.11 511.3 40.43 511.33 40.79C511.43 41.0868 511.587 41.3618 511.79 41.6Z"
                                    fill="black"></path>
                                <path
                                    d="M511.79 301.47C508.66 323.47 495.31 335.98 474.67 341.84C471.945 342.588 469.124 342.925 466.3 342.84C455.087 342.88 443.877 342.91 432.67 342.93C432.245 343.155 431.877 343.475 431.596 343.865C431.315 344.255 431.128 344.705 431.05 345.18C429.05 353.18 426.95 361.18 424.9 369.18C434.13 373.86 437.17 380.02 434.78 389.91C431.3 404.27 427.83 418.63 424.04 432.91C416.78 460.28 391.26 475 363.9 467.68C265.9 441.493 167.933 415.28 70 389.04C59.42 386.26 48.89 383.35 38.26 380.6C17.86 375.22 5.26 362.4 0.82 341.6C0.74 341.18 0.28 340.84 0 340.46C2.45 340.54 2.14 342.67 2.56 344.09C8 362.57 19.85 374.28 38.56 379.25C90.7133 393.09 142.823 407.03 194.89 421.07C250.84 436.07 306.89 450.87 362.74 466.14C389.74 473.52 414.31 460.46 422.4 433.66C427.01 418.36 430.4 402.72 433.9 387.12C435.17 381.4 432.79 376.71 428.47 372.95C427.03 371.69 425.11 370.95 424.2 369.09L424.12 368.93C424.115 368.867 424.115 368.803 424.12 368.74C424.49 360.24 427.7 352.42 430.12 344.42C430.27 343.862 430.567 343.355 430.98 342.95C431.98 342.01 433.45 341.95 434.98 341.95C444.28 342.01 453.58 341.95 462.89 341.95C464.53 341.95 466.21 342.26 467.81 341.61C489.49 339.2 505.46 325.19 510.69 304.02C510.94 303.12 510.6 301.98 511.79 301.47Z"
                                    fill="#FEFEFE"></path>
                                <path
                                    d="M434.78 389.96C431.3 404.32 427.83 418.68 424.04 432.96C416.78 460.33 391.26 475.05 363.9 467.73C265.9 441.543 167.933 415.33 70 389.09C59.42 386.26 48.89 383.35 38.26 380.6C17.86 375.22 5.26 362.4 0.82 341.6C0.74 341.18 0.28 340.84 0 340.46V330.46C0.92 328.97 0.440001 327.36 0.470001 325.78C0.465012 325.693 0.465012 325.607 0.470001 325.52C0.470001 325.37 0.470001 325.22 0.470001 325.08C0.668369 320.089 1.48116 315.142 2.89 310.35C12.96 272.08 23.06 233.8 32.83 195.44C33.77 191.74 34.83 188.06 35.83 184.38C39.21 172.64 44.69 168.74 56.95 169.28L57.17 169.35L57.71 169.52C67.65 172.83 72.19 180.81 69.71 191.74C67.71 200.66 65.2 209.49 62.87 218.35C53.37 254.583 43.9067 290.83 34.48 327.09C33.1 332.38 33.2 337.22 36.39 341.87C38.81 345.41 42.26 347.06 46.24 348.13C72.6 355.237 98.9733 362.31 125.36 369.35C194.17 387.85 263.05 406.11 331.83 424.71C345.01 428.27 358.22 431.71 371.41 435.26C382.17 438.14 389.24 434.1 392.15 423.16C395.483 410.613 398.617 398.01 401.55 385.35C402.83 379.76 404.55 374.41 409.37 370.69C414.19 366.97 419.93 366.21 424.14 368.69C424.401 368.84 424.655 369.004 424.9 369.18C434.13 373.91 437.17 380.07 434.78 389.96Z"
                                    fill="black"></path>
                                <path
                                    d="M511.23 39.73C510.59 37.56 509.96 35.39 509.23 33.26C506.069 23.7113 499.966 15.4084 491.796 9.54142C483.626 3.67439 473.808 0.544395 463.75 0.600026C353.71 0.526693 243.67 0.526693 133.63 0.600026C106.19 0.600026 85.58 21.6 85.21 49.6C85.05 61.6 85.05 73.6 84.98 85.54C84.46 86.4 83.98 87.27 83.48 88.14C72.89 107.14 70.48 128.86 63.98 149.22C62.42 154.13 61.13 159.13 59.9 164.15C59.5986 166.075 58.8596 167.905 57.74 169.5C57.4925 169.801 57.218 170.079 56.92 170.33C45.06 169.85 39.92 173.69 36.99 185.19C25.2833 230.283 13.56 275.37 1.82 320.45C1.41 322.04 1.21 323.69 0.91 325.32C0.79 325.63 0.640001 325.78 0.470001 325.78C0.300001 325.78 0.18 325.68 0 325.47C0.153519 325.526 0.318317 325.543 0.48 325.52C0.48 325.37 0.48 325.22 0.48 325.08C0.675114 320.09 1.48455 315.142 2.89 310.35C12.96 272.08 23.06 233.8 32.83 195.44C33.77 191.74 34.83 188.06 35.83 184.38C39.21 172.64 44.69 168.74 56.95 169.28L57.17 169.35C63.59 146.02 69.95 122.68 76.5 99.35C77.7665 94.705 80.1725 90.4497 83.5 86.97C83.5 86.61 83.5 86.25 83.5 85.89C83.82 70.89 82.5 55.89 84.42 41.01C87.18 20.09 106.09 -0.09997 131.16 0.01003C243.02 0.25003 354.88 0.0900251 466.73 0.130025C477.715 0.118408 488.32 4.14752 496.526 11.45C504.732 18.7525 509.966 28.8182 511.23 39.73V39.73Z"
                                    fill="#FEFEFE"></path>
                                <path
                                    d="M0 330.46V325.46C0.153519 325.516 0.318317 325.533 0.48 325.51C0.637296 325.479 0.784777 325.41 0.91 325.31C1.19 327.14 1.56 328.97 0 330.46Z"
                                    fill="#353535"></path>
                                <path
                                    d="M117.19 264.53V52.24C117.19 38.29 122.94 32.58 136.92 32.58H460.78C473.71 32.58 479.78 38.58 479.78 51.4V217.72C466.68 202.46 454.36 188.11 442.05 173.72C429.05 158.55 415.62 143.72 403.14 128.11C385.85 106.51 357.27 111.11 343.14 128.62C318.62 158.9 293.33 188.56 268.5 218.62C266.14 221.47 264.95 221.89 262.24 219.01C255.4 211.72 248.24 204.75 241.11 197.73C224.22 181.09 202.05 181.15 185.28 197.88C164.033 219.027 142.82 240.237 121.64 261.51C120.561 262.76 119.587 264.098 118.73 265.51L117.19 264.53Z"
                                    fill="#EBEEF0"></path>
                                <path
                                    d="M467.83 341.6C464.36 343.32 460.65 342.38 457.06 342.46C449.92 342.62 442.77 342.56 435.62 342.46C434.599 342.373 433.573 342.524 432.62 342.9C432.195 343.125 431.827 343.445 431.546 343.835C431.265 344.225 431.078 344.675 431 345.15C429 353.15 426.9 361.15 424.85 369.15L424.16 369.01C413.82 367.01 406.35 371.66 403.78 381.93C400.38 395.47 397.027 409.023 393.72 422.59C390.59 435.32 383.17 439.76 370.38 436.33C277.76 411.53 185.143 386.71 92.53 361.87C76.9967 357.75 61.45 353.62 45.89 349.48C34.89 346.54 30.1 338.65 32.97 327.6C44.6433 282.56 56.3533 237.523 68.1 192.49C71.03 181.23 67.8 174.94 56.92 170.36C57.01 170.03 57.1 169.69 57.2 169.36C63.62 146.03 69.98 122.69 76.53 99.36C77.7964 94.715 80.2025 90.4596 83.53 86.98C84.01 86.48 84.53 85.98 85.03 85.53C85.13 87.35 85.31 89.17 85.31 90.99C85.31 155.29 85.31 219.59 85.31 283.89C85.31 291.04 85.42 298.22 85.99 305.34C86.65 313.47 92.35 319.18 97.16 324.93C107.03 336.75 120.16 341.7 135.56 341.67C209.013 341.563 282.457 341.54 355.89 341.6H467.83Z"
                                    fill="#D4D9DB"></path>
                                <path
                                    d="M278.8 256.43C300.26 230.543 321.72 204.673 343.18 178.82C351.26 169.08 359.353 159.357 367.46 149.65C371.98 144.25 374.57 144.16 379.05 149.38C411.777 187.553 444.503 225.72 477.23 263.88C478.123 264.834 478.815 265.958 479.267 267.184C479.719 268.41 479.92 269.715 479.86 271.02C479.68 278.51 479.86 286.02 479.77 293.5C479.62 302.9 473.12 309.63 463.71 309.65C420.423 309.75 377.133 309.75 333.84 309.65C333.501 309.619 333.165 309.552 332.84 309.45C331.66 308.55 330.24 308.03 329.15 306.94C312.4 290.09 295.44 273.42 278.8 256.43Z"
                                    fill="#ECB415"></path>
                                <path
                                    d="M278.8 256.43C279.46 256.498 280.1 256.699 280.681 257.02C281.262 257.342 281.772 257.777 282.18 258.3C298.8 274.967 315.427 291.61 332.06 308.23C332.37 308.614 332.638 309.029 332.86 309.47C331.54 309.55 330.22 309.7 328.86 309.71H135.68C132.52 309.71 129.41 309.63 126.41 308.24C123.25 306.78 122.55 305.62 125.47 302.76C139.84 288.67 154 274.34 168.24 260.1C181.42 246.92 194.607 233.747 207.8 220.58C212.61 215.78 213.88 215.8 218.8 220.68C230.22 232.093 241.63 243.513 253.03 254.94C261.89 263.81 269.3 264.24 278.8 256.43Z"
                                    fill="#FEC933"></path>
                                <path
                                    d="M191.89 149.74C183.464 149.712 175.236 147.186 168.247 142.481C161.257 137.776 155.821 131.103 152.624 123.308C149.428 115.512 148.615 106.943 150.29 98.6855C151.965 90.428 156.051 82.8527 162.032 76.9181C168.013 70.9834 175.619 66.9561 183.89 65.3455C192.16 63.735 200.722 64.6137 208.493 67.8705C216.263 71.1272 222.894 76.6156 227.544 83.6414C232.195 90.6671 234.658 98.9145 234.62 107.34C234.536 118.616 229.996 129.402 221.991 137.345C213.987 145.287 203.167 149.743 191.89 149.74V149.74Z"
                                    fill="black"></path>
                                <path
                                    d="M191.79 117.72C189.021 117.7 186.37 116.601 184.398 114.658C182.426 112.714 181.29 110.078 181.23 107.31C181.276 104.528 182.405 101.873 184.378 99.9097C186.351 97.9467 189.011 96.8303 191.793 96.7978C194.576 96.7652 197.262 97.8191 199.28 99.7354C201.298 101.652 202.489 104.279 202.6 107.06C202.604 108.474 202.326 109.874 201.783 111.179C201.239 112.484 200.441 113.668 199.434 114.66C198.427 115.653 197.233 116.435 195.92 116.96C194.608 117.486 193.204 117.744 191.79 117.72V117.72Z"
                                    fill="#FDC833"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_0_1">
                                    <rect width="511.79" height="469.6" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                        Crop the image
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                    </div>
                    <div class="row" id="actions">
                        <div class=" col-12 docs-buttons">
                            <div class="btn-group">
                                <a class="btn btn-primary btn-sm" title="Upload New Image"
                                    onclick="document.getElementById('input').click();"><i class="fa fa-upload"></i></a>
                                <button type="button" id="reset" class="btn btn-primary btn-sm action_button"
                                    title="Reset">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <button type="button" id="zoomOut" class="btn btn-primary btn-sm action_button"
                                    title="Zoom Out">
                                    <i class="fa fa-search-minus"></i>
                                </button>
                                <button type="button" id="zoomIn" class="btn btn-primary btn-sm action_button"
                                    title="Zoom In">
                                    <i class="fa fa-search-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="crop"
                        style="background-color:#009641;border-color:#009641;color:white;"><i class="fas fa-upload mr-2"
                            style="color: white;"></i>Upload</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end cropper  modal -->



@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css">

    <style type="text/css">
        label#tagline-error,
        label#category_value-error {
            position: relative;
            top: 92px;
            left: -55px;
        }



        .form-group textarea {
            height: 90px !important;
        }

        .dc {

            position: relative;
            top: -115px;

        }

        .emojionearea-editor {
            position: relative;
            left: -2px !important;
        }

        .content-wrapper .card-body .form-group input.form-control {
            padding: 16px 22px;
        }

        #rating-error {
            position: relative;
            top: 26px;
            left: -52px;
        }

        .bracherror {
            position: absolute;
            top: 45px;
            left: 21px;
        }

        .rating {
            position: relative;
            top: 16px;
        }

        .tab_wrapper ul li.nav-item {
            width: calc(33.33333333333333% - 5px);
        }

        .tab_wrapper ul.nav.nav-pills {
            width: 70%;
        }
    </style>
@stop
@section('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
    <script type="text/javascript" src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet" />


    <script type="text/javascript">
        $(".catselect").select2();
    </script>
    <script>
        $(document).ready(function() {



            $('#category_value').on('change', function() {
                if ($(this).val() == 'loyalty') {
                    $('#change_value').html('Loyalty Point <span class="text-danger">*</span>');
                    $('#change_value').next().attr('name', 'loyalty_point')
                } else {
                    $('#change_value').text('Price (KD)');
                    $('#change_value').next().attr('name', 'price')
                }
            });

            $('.subs').keypress(function(e) {
                if ($(this).val() === null || $(this).val() === '') {
                    if (e.which === 32) {
                        return false;
                    }
                }
            })

            $('.checkBranchAll').click(function() {
                var branches = $('.branch-container')[0];
                var all_branches_input = branches.getElementsByTagName('INPUT');

                if ($(this).is(':checked')) {
                    for (var i = 0; i < all_branches_input.length; i++) {
                        $(all_branches_input[i]).prop('checked', 'true');
                    }
                } else {
                    for (var i = 0; i < all_branches_input.length; i++) {
                        $(all_branches_input[i]).prop('checked', false);
                    }
                }
            });

            var all_branches_input = $('.branch_inputs');
            var branches_input_length = all_branches_input.length;
            $(all_branches_input).each(function() {
                $(this).click(function() {
                    var counts = 0;
                    $(all_branches_input).each(function(data) {

                        if ($(this).is(':checked')) {
                            counts++;
                        }
                    });
                    if (branches_input_length == counts) {
                        $(".checkBranchAll").prop('checked', 'true');
                    } else {
                        $(".checkBranchAll").prop('checked', false);
                    }

                });
            });

            $('.ckbCheckAll').each(function() {

                $(this).click(function() {
                    var count = 0;
                    var getParent = this.parentElement.parentElement.parentElement.parentElement;

                    var getParentInput = this.parentElement.parentElement.parentElement
                        .parentElement.parentElement.parentElement.parentElement.parentElement;
                    var parentInput = getParentInput.getElementsByTagName('INPUT')[0];

                    var all_input = getParent.getElementsByTagName('INPUT');
                    console.log(all_input.length);
                    $(all_input).each(function(data) {
                        if ($(this).is(':checked')) {
                            count++;
                        }
                    });

                    if (all_input.length == count) {
                        $(parentInput).prop('checked', 'true');
                    } else {
                        //  alert("false");
                        $(parentInput).prop('checked', false);
                    }

                });
            });



            $('#branch-modal').click(function() {
                $('#branches-modal').modal({
                    'show': true,
                    backdrop: 'static',
                    keyboard: false
                });
            });

            $('#branch_save_countinue').on('click', function() {

                var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
                var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
                var branch_sel_count = 0;
                var all_branches_name = [];
                $(all_inputs).each(function() {

                    if ($(this).is(':checked')) {
                        branch_sel_count++;
                        if ($(this).attr('branch-name-attr') != undefined) {
                            all_branches_name.push($(this).attr('branch-name-attr'));
                        }
                    }
                });

                if (branch_sel_count == 0) {
                    $('.select_branch_warning').removeClass('d-none');

                    setTimeout(function() {
                        $('.select_branch_warning').addClass('d-none');
                    }, 2000);
                    return false;
                } else {

                    //get data selected.............
                    //console.log(all_branches_name);
                    $('#branches-modal').modal('hide');
                    //$('#all_selected_branch_container').removeClass('d-none');
                    $('#all_selected_branch_container').removeClass('d-none');

                    $('#show_all_selected_branch').html(' ');
                    var html_branch = "";

                    $(all_branches_name).each(function(data, index) {

                        html_branch += "<ul>";
                        html_branch += "<li>" + index + "</li>"
                        html_branch += "</ul>";

                    });
                    $('.braches').removeClass('d-none');
                    $('#show_all_selected_branch').append(html_branch);
                }
            });

            $(".current__offerdatepicker").datetimepicker({
                timepicker: true,
                formatTime: 'g:i A',
                format: 'd/m/Y g:i A',
                validateOnBlur: false,
                minDate: 0
            });



            $('#addMenuItemForm').validate({
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
                        required: function(value, element) {
                            let check_regular_item = $('#regular_checkbox').attr("data-id");
                            return (value != null && check_regular_item != "0");
                        },
                        //noSpace:true
                    },
                    loyalty_point: {
                        required: function(value, element) {
                            let check_regular_item = $('#regular_checkbox').attr("data-id");
                            return (value != null && check_regular_item != "0");
                        }
                    },
                    // thumbnail: {
                    //     required: true
                    // },
                    tagline: {
                        required: true
                    },
                    loyality_item_points: {
                        required: function(value, element) {
                            let check_loyalty_item = $('#loyality_checkbox').attr("data-id");
                            return (value != null && check_loyalty_item != "0");
                        }
                    }
                },
                messages: {
                    item_name_en: {
                        required: "Item Name(en) is required",
                    },
                    thumbnail: {
                        required: "Image is required"
                    },
                    item_name_ar: {
                        required: "Item Name(ar) is required",
                    },
                    cat_id: {
                        required: "Category is required",
                    },
                    price: {
                        required: "Regular Item is required",
                    },
                    loyalty_point: {
                        required: "Regular Item is required"
                    },
                    tagline: {
                        required: "Tagline is required",
                    },
                    loyality_item_points: {
                        required: "Loyalty Item is required"
                    }
                }
            });
            $.validator.addMethod("noSpace", function(value, element) {
                return $.trim(value).length != 0;
            }, "No space please and don't leave it empty");
        });
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $('#choice-list').DataTable({
            columnDefs: [{
                targets: 0,
                render: function(data, type, row) {
                    return data.substr(0, 2);
                }
            }],
            "language": {
                "emptyTable": "Add choices of menu item"
            },
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#tagline").emojioneArea({
                pickerPosition: "right",
            });
        });
    </script>
    <script>
        $(".remove-pro-img").click(function(evt) {
            $('.profile_image').val('');
            $(".upload-img").addClass("d-none");
            $("#thumbnail_preview").css('display', 'none');
            $(".thumbnail_pic").val(null);
        });
    </script>
    <!-- show image on change -->
    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {

                    var image = new Image();
                    image.src = e.target.result;

                    image.onload = function() {
                        var height = this.height;
                        var width = this.width;
                        if (height == 200 && width == 400) {

                            $('#thumbnail_preview').css('display', 'block');
                            $(".upload-img").removeClass("d-none");
                            $('#thumbnail_preview').removeClass("d-none");
                            $('#thumbnail_preview').attr('src', e.target.result);

                        } else {
                            $('#thumbnail').val('');
                            toastr.error('Please upload an image with 400 x 200 pixels dimension');
                            return false;
                        }
                    };
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


        function readURLL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#current_thumbnail_preview').css('display', 'block');
                    $('#current_thumbnail_preview').attr('src', e.target.result);
                    $('.upload-img').removeClass('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // CKEDITOR.replace('description_en', {});
        // CKEDITOR.replace('description_ar', {});

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
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('menu.item.choice.group.delete') }}",
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
        $(document).ready(function() {

            $(document).on('click', '.choice_remove_btnpre', function() {
                var id = $(this).data('id');

                $(this).parent().parent().remove();

                $.ajax({

                    url: "{{ route('items.delete.choices') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        'id': id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var mendatory_choice_count = $('.edit_mendatory_choice_count').find(
                            ':selected').val();

                        var total_choice_length = $('#edit_total_choice_count').val();
                        $('#edit_total_choice_count').val(total_choice_length - 1);
                        var indx = $('#edit_total_choice_count').val();
                        $('.edit_mendatory_choice_count').html(' ');

                        $('#ttotal_choice_countd').html('');
                        var maxchoice = response.group.total_choice_count;
                        var maxchoice_option = "";
                        var selected_max_choice = '';

                        for (i = 0; i < parseInt(total_choice_length); i++) {
                            if (i == 0) {
                                var selected = '';
                                if (mendatory_choice_count == i) {
                                    selected = 'selected';
                                }

                                var option = `<option value="` + i + `"  ` + selected + `>` +
                                    i + `(optional)</option>`;
                                $('.edit_mendatory_choice_count').append(option);
                            } else {

                                if (i == maxchoice) {
                                    selected_max_choice = 'selected';
                                } else {
                                    selected_max_choice = '';
                                }

                                var selected = '';
                                if (mendatory_choice_count == i) {
                                    // alert(mendatory_choice_count);
                                    selected = 'selected';
                                }
                                var option = `<option value="` + i + `" ` + selected + ` >` +
                                    i + `</option>`;

                                maxchoice_option += "<option " + selected_max_choice + " >" +
                                    i + "</option>";
                                $('.edit_mendatory_choice_count').append(option);
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

                var max_choice = `<option value=` + total_choice_count + `>` + total_choice_count +
                    `</option>`;
                var option = `<option value=` + total_choice_count + `>` + total_choice_count + `</option>`;

                $('.mendatory_choice_count').append(option);
                $('#newtotal_choice_count').append(max_choice);



                var html = `
        <div class="col-12">
        <div class="row choices_child mt-2 pl-0">

        <div class="col-md-4 col-lg-4 col-xl-4 col-12">
           <div class="mainEnglisChoiceContainer">

        <div class="form-group">
        <label for="choice_name_en">Choice Name(en)<span class="text-danger"> *</span></label>
        <input type="text" name="choice_name_en[]" class="form-control dynamic_name_en englishChoiceInput"     maxlength="100">
        </div>
        <div class="border-lg englishChoiceSuggestionBox d-none"  style="overflow-x:auto;height:180px;width:100%;position:absolute;z-index: 1000;background-color:#ffcdca;">

                                 </div>
        </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-12">
             <div class="mainArabicChoiceContainer">

        <div class="form-group">
        <label for="choice_name_ar">Choice Name(ar)<span class="text-danger"> *</span></label>
        <input type="text" name="choice_name_ar[]" class="form-control dynamic_name_ar arabicChoiceInput"     maxlength="100">
        </div>
        <div class="border-lg englishChoiceSuggestionBox d-none"  style="overflow-x:auto;height:180px;width:100%;position:absolute;z-index: 1000;background-color:#ffcdca;">

                                 </div>
        </div>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3 col-12">
        <div class="form-group">
        <label for="choice_price">Price(KD) </label>
        <input type="number" name="choice_price[]" class="form-control"     step="any">
        </div>
        </div>
        <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete">
        <i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:20px;cursor:pointer"></i>
        </div>
        </div></div>
        `;
                $('.choices_parent').append(html);
                //remove choices


                // start choice suggestions

                $(document).ready(function() {


                    //01 - click on input field and show suggestions For english choice..................

                    $('.englishChoiceInput').each(function() {
                        $(this).on('input', function() {

                            var currentInputField = this;
                            var currentInputFieldValue = this.value;
                            var mainEnglisChoiceContainer = this.parentElement
                                .parentElement;
                            var englishChoiceSuggestionBox =
                                mainEnglisChoiceContainer.getElementsByTagName(
                                    'DIV')[1];
                            //console.log(englishChoiceSuggestionBox);

                            //Get second input field arabic for autofill
                            var mainEnglisArabicChoiceContainer = this.parentElement
                                .parentElement.parentElement.parentElement
                                .parentElement;
                            var CurrentInputArabic = mainEnglisArabicChoiceContainer
                                .getElementsByTagName('INPUT')[1];
                            var psd = mainEnglisArabicChoiceContainer
                                .getElementsByTagName('INPUT')[2];

                            if (this.value.length > 0) {
                                //Remove d-none class
                                $(englishChoiceSuggestionBox).removeClass('d-none');

                                //onclick and make input filed value
                                //Get Data from database
                                //alert(currentInputFieldValue);

                                //stat get data form database

                                $.ajax({
                                    type: 'post',
                                    url: "{{ route('menu.item.get.choice.suggestion') }}",
                                    data: {
                                        id: "1",
                                        choice_key: currentInputFieldValue
                                    },
                                    dataType: "JSON",
                                    headers: {
                                        'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]')
                                            .attr('content')
                                    },
                                    success: function(response) {
                                        //  console.log(response+"ajax");
                                        if (response.success == 1) {
                                            // console.log(response.data);
                                            $(englishChoiceSuggestionBox)
                                                .html(' ');
                                            response.data.forEach(
                                                function(data,
                                                    index) {
                                                    var choices_name =
                                                        data;
                                                    var html =
                                                        `<li class="p-2 border-bottom choicesSuggestionList" ar_input_value="` +
                                                        response
                                                        .data_ar[
                                                            index] +
                                                        `" data-price="` +
                                                        response
                                                        .data_price[
                                                            index] +
                                                        `">` +
                                                        choices_name +
                                                        `</li>`;
                                                    $(englishChoiceSuggestionBox)
                                                        .append(
                                                            html);
                                                });

                                            $(allchoicesSuggestionList)
                                                .each(function() {
                                                    $(this).click(
                                                        function() {
                                                            var choiceSuggestionName =
                                                                $(
                                                                    this
                                                                )
                                                                .text();
                                                            var arabicSuggestions =
                                                                $(
                                                                    this
                                                                )
                                                                .attr(
                                                                    'ar_input_value'
                                                                );
                                                            var p_price =
                                                                $(
                                                                    this
                                                                )
                                                                .attr(
                                                                    'data-price'
                                                                );
                                                            $(currentInputField)
                                                                .val(
                                                                    choiceSuggestionName
                                                                );
                                                            $(CurrentInputArabic)
                                                                .val(
                                                                    arabicSuggestions
                                                                );
                                                            $(psd)
                                                                .val(
                                                                    p_price
                                                                );
                                                            $(englishChoiceSuggestionBox)
                                                                .addClass(
                                                                    'd-none'
                                                                );
                                                        });
                                                });

                                        } else {
                                            //$(englishChoiceSuggestionBox).html(' ');
                                            // var html = `<li class="p-2 border-bottom choicesSuggestionList">Choice not found !</li>`;
                                            //  $(englishChoiceSuggestionBox).append(html);
                                            $(englishChoiceSuggestionBox)
                                                .addClass('d-none');

                                        }
                                    }
                                });


                                //end get data form database



                                var allchoicesSuggestionList =
                                    englishChoiceSuggestionBox
                                    .getElementsByClassName(
                                        'choicesSuggestionList');

                                $(allchoicesSuggestionList).each(function() {
                                    $(this).click(function() {
                                        var choiceSuggestionName =
                                            $(this).text();
                                        // console.log(choiceSuggestionName);
                                        $(currentInputField).val(
                                            choiceSuggestionName
                                        );
                                        $(englishChoiceSuggestionBox)
                                            .addClass('d-none');
                                    });
                                });


                            } else {
                                $(englishChoiceSuggestionBox).addClass('d-none');
                            }

                        });


                        //onchnage add class d-none

                        // $(this).on('focusout',function() {
                        //       var currentInputField = this;
                        //      var currentInputFieldValue = this.value;
                        //      var mainEnglisChoiceContainer = this.parentElement.parentElement;
                        //      var englishChoiceSuggestionBox = mainEnglisChoiceContainer.getElementsByTagName('DIV')[1];
                        //      $(englishChoiceSuggestionBox).addClass('d-none');
                        // });


                        $(this).on('click', function() {
                            // if(this.value.length > 0){
                            // alert();
                            // }

                            $('.englishChoiceSuggestionBox , .arabicChoiceSuggestionBox')
                                .each(function() {
                                    $(this).addClass('d-none');
                                });

                        });


                    });

















                    //02 - click on input field and show suggestions For english choice..................

                    $('.arabicChoiceInput').each(function() {
                        $(this).on('input', function() {
                            var currentInputField = this;
                            var currentInputFieldValue = this.value;
                            var mainEnglisChoiceContainer = this.parentElement
                                .parentElement;
                            var englishChoiceSuggestionBox =
                                mainEnglisChoiceContainer.getElementsByTagName(
                                    'DIV')[1];
                            console.log(englishChoiceSuggestionBox);

                            if (this.value.length > 0) {
                                //Remove d-none class
                                $(englishChoiceSuggestionBox).removeClass('d-none');

                                //onclick and make input filed value
                                //Get Data from database
                                //alert(currentInputFieldValue);

                                //stat get data form database

                                $.ajax({
                                    type: 'post',
                                    url: "{{ route('menu.item.get.choice.suggestion') }}",
                                    data: {
                                        id: "2",
                                        choice_key: currentInputFieldValue
                                    },
                                    dataType: "JSON",
                                    headers: {
                                        'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]')
                                            .attr('content')
                                    },
                                    success: function(response) {
                                        //  console.log(response+"ajax");
                                        if (response.success == 1) {
                                            // console.log(response.data);
                                            $(englishChoiceSuggestionBox)
                                                .html(' ');
                                            response.data.forEach(
                                                function(data,
                                                    index) {
                                                    var choices_name =
                                                        data;
                                                    var html =
                                                        `<li class="p-2 border-bottom choicesSuggestionList">` +
                                                        choices_name +
                                                        `</li>`;
                                                    $(englishChoiceSuggestionBox)
                                                        .append(
                                                            html);
                                                });

                                            $(allchoicesSuggestionList)
                                                .each(function() {
                                                    $(this).click(
                                                        function() {
                                                            var choiceSuggestionName =
                                                                $(
                                                                    this
                                                                )
                                                                .text();
                                                            // console.log(choiceSuggestionName);
                                                            $(currentInputField)
                                                                .val(
                                                                    choiceSuggestionName
                                                                );
                                                            $(englishChoiceSuggestionBox)
                                                                .addClass(
                                                                    'd-none'
                                                                );
                                                        });
                                                });

                                        } else {
                                            $(englishChoiceSuggestionBox)
                                                .html(' ');
                                            // var html = `<li class="p-2 border-bottom choicesSuggestionList">Choice not found !</li>`;
                                            // $(englishChoiceSuggestionBox).append(html);
                                            $(englishChoiceSuggestionBox)
                                                .addClass('d-none');

                                        }
                                    }
                                });


                                //end get data form database



                                var allchoicesSuggestionList =
                                    englishChoiceSuggestionBox
                                    .getElementsByClassName(
                                        'choicesSuggestionList');

                                $(allchoicesSuggestionList).each(function() {
                                    $(this).click(function() {
                                        var choiceSuggestionName =
                                            $(this).text();
                                        // console.log(choiceSuggestionName);
                                        $(currentInputField).val(
                                            choiceSuggestionName
                                        );
                                        $(englishChoiceSuggestionBox)
                                            .addClass('d-none');
                                    });
                                });


                            } else {
                                $(englishChoiceSuggestionBox).addClass('d-none');
                            }

                        });


                        //onchnage add class d-none


                        $(this).on('click', function() {
                            // if(this.value.length > 0){
                            // alert();
                            // }

                            $('.englishChoiceSuggestionBox , .arabicChoiceSuggestionBox')
                                .each(function() {
                                    $(this).addClass('d-none');
                                });

                        });



                    });








                    //end choice suggestions
                });


                $('.choice_remove_btn').each(function() {
                    $(this).click(function() {
                        var total_choice_length = this.parentElement.parentElement
                            .parentElement.children.length;
                        var index = $('#total_choice_count').val();
                        $('#total_choice_count').val(parseInt(index) - 1);
                        $('.mendatory_choice_count').html(' ');
                        $('#newtotal_choice_count').html('');
                        for (i = 0; i < parseInt(index); i++) {
                            if (i == 0) {
                                var option = `
                <option value="` + i + `">` + i + `(optional)</option>
                `;
                                $('.mendatory_choice_count').append(option);
                            } else {

                                var max_choice = `<option>` + i + `</option>`;
                                var option = `<option value="` + i + `">` + i + `</option>`;

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

            var maxchoice = $('#newtotal_choice_count').val();
            var minchoice = $('.mendatory_choice_count').val();

            if (minchoice <= maxchoice) {
                //alert('success')
            } else {
                toastr.error("Please Minimum Number of Choices Less then or Equal Maximum Number of choices");
                //$('.mendatory_choice_count').focus();
                return false;
            }

            e.preventDefault();
            if ($('#choice_name_en').val().trim() == '') {
                $('#choice_name_en').next().remove();
                $("<span class='text-danger compare'>Group Name(en) is required </span>").insertAfter(
                    '#choice_name_en');
            }
            if ($('#choice_name_ar').val().trim() == '') {
                $('#choice_name_ar').next().remove();
                $("<span class='text-danger compare'>Group Name(ar) is required </span>").insertAfter(
                    '#choice_name_ar');
            }
            $('#choice_name_en').on('input', function() {
                $('#choice_name_en').next().remove();
            });
            $('#choice_name_ar').on('input', function() {
                $('#choice_name_ar').next().remove();
            });
            $('.dynamic_name_en').each(function() {
                if ($(this).val().trim() == '') {
                    $(this).next().remove();
                    $("<span class='text-danger compare'>Choice Name(en) is required </span>").insertAfter(
                        this);
                }
            });
            $('.dynamic_name_en').each(function() {
                $(this).on('input', function() {
                    $(this).next().remove();
                });
            });



            $('.dynamic_name_ar').each(function() {
                if ($(this).val().trim() == '') {
                    $(this).next().remove();
                    $("<span class='text-danger compare'>Choice Name(ar) is required </span>").insertAfter(
                        this);
                }
            });
            $('.dynamic_name_ar').each(function() {
                $(this).on('input', function() {
                    $(this).next().remove();
                });
            });
            var container = document.getElementById('addChoiceGroupForm');
            var input = container.getElementsByClassName("compare");
            if (input.length == 0) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('menu.item.choice.group.save') }}",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        $('#choice_group_modal').modal('hide');
                        if (response.trim() == 'success') {
                            $("#flash-message").css("display", "block");
                            $("#flash-message").removeClass("d-none");
                            $("#flash-message").addClass("alert-success");
                            $('#flash-message').html('Choice Group Created Successfully');
                            setTimeout(() => {
                                $("#flash-message").addClass("d-none");
                                location.href = "{{ route('menu.item.add.choice') }}";
                            }, 2000);
                        } else {

                            setTimeout(() => {
                                swal('Error', 'Something went wrong', 'error');
                            }, 500);
                        }
                    }
                });
            }
        });
    </script>
    <script>
        //Edit Choices
        $(document).on('click', '.edit-button', function(e) {
            var edit_id = $(this).attr('data-id');
            $('#edit_group_modal').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');

            var current_value_stored_td = this.parentElement.parentElement.children[0];
            var name_en = $(current_value_stored_td).attr('c_g_n_en');
            var name_ar = $(current_value_stored_td).attr('c_g_n_ar');
            var mendatory_choice_count = $(current_value_stored_td).attr('m_c_count');
            var total_choice_count = $(current_value_stored_td).attr('t_c_count');
            var choice_group_id = edit_id;
            $.ajax({
                type: "post",
                url: "{{ route('menu.item.choice.group.choices') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": edit_id
                },
                success: function(response) {

                    var url = "{{ asset('files') }}";

                    var all_data = response;
                    $('#edit_name_en').val(response.group.name_en);
                    $('#edit_name_ar').val(response.group.name_ar);
                    $('#edit_total_choice_count').val(response.group.total_choice_count);
                    $('#choice_group_id').val(choice_group_id);
                    let mendatory_choice_count = response.group.mendatory_choice_count;
                    let maxchoice = response.group.total_choice_count;

                    $('.edit_choices_parent').html("");
                    $('.edit_mendatory_choice_count').html("");
                    $('#ttotal_choice_countd').html("");
                    var option = "<option value='0' selected>0(optional)</option>";
                    $('.edit_mendatory_choice_count').append(option);
                    var selected_max_choice = '';
                    response.ct.forEach(function(data, index) {
                        var index_selected = index;
                        if ((index_selected + 1) == maxchoice) {
                            selected_max_choice = 'selected';
                        } else {
                            selected_max_choice = '';
                        }

                        var maxchoice_option = "<option " + selected_max_choice + " >" + (
                            index_selected + 1) + "</option>";


                        if (index == 0) {
                            var index_selected = index_selected + 1;
                            var selected = '';

                            if (mendatory_choice_count == index_selected) {
                                selected = 'selected';
                            }



                            var html = `<div class="col-12"><div class="row choices_child mt-2">
               <input type="hidden" name="choiceid[]" value="` + data.id +
                                `" />
               <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                                 <div class="mainEnglisChoiceContainer">

               <div class="form-group">
               <label for="choice_name_en">Choice Name(en)<span class="text-danger"> *</span></label>
               <input type="text" name="choice_name_en[]" class="form-control edit_dynamic_name_en englishChoiceInput" maxlength="100" value="` +
                                data.name_en +
                                `">
               </div>
                <div class="border-lg englishChoiceSuggestionBox d-none"  style="overflow-x:auto;height:180px;width:100%;position:absolute;z-index: 1000;background-color:#ffcdca;cursor: pointer;">

                                 </div>
               </div>
               </div>
               <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                                 <div class="mainArabicChoiceContainer">

               <div class="form-group">
               <label for="choice_name_ar">Choice Name(ar)<span class="text-danger"> *</span></label>
               <input type="text" name="choice_name_ar[]" class="form-control edit_dynamic_name_ar arabicChoiceInput" maxlength="100" value="` +
                                data.name_ar + `">
               </div>
               <div class="border-lg arabicChoiceSuggestionBox d-none " style="overflow-x:auto;height:180px;width:100%;position:absolute;z-index: 1000;background-color:#ffcdca;cursor: pointer;" >



                                 </div>
               </div>
               </div>
               <div class="col-md-3 col-lg-3 col-xl-3 col-12">
               <div class="form-group">
               <label for="choice_price">Price(KD)</label>
               <input type="number" name="choice_price[]" class="form-control" step="any" value="` + data.price + `">
               </div>
               </div>
               <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete">


               <i class="text-success">Default</i>

               </div>
               </div></div`;
                            var option = `<option value="` + index_selected + `" ` + selected +
                                ` >` + index_selected + `</option>`;
                            // var option = `<option value="`+index_selected+`" `+selected+` >`+index+`(optional)</option><option value="`+ ++index_selected+`" `+selected+`>`+ ++index +`</option>`;
                        } else {
                            var index_selected = index_selected + 1;
                            var selected = '';

                            if (mendatory_choice_count == index_selected) {
                                selected = 'selected';
                            }


                            var html = `<div class="col-12"><div class="row choices_child mt-2 pl-0">
                   <input type="hidden" name="choiceid[]" value="` + data.id +
                                `" />
                    <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                     <div class="mainEnglisChoiceContainer">

                    <div class="form-group">
                    <label for="choice_name_en">Choice Name(en)<span class="text-danger"> *</span></label>
                    <input type="text" name="choice_name_en[]" class="form-control edit_dynamic_name_en englishChoiceInput" maxlength="100" value="` +
                                data.name_en +
                                `">
                    </div>
                     <div class="border-lg englishChoiceSuggestionBox d-none"  style="overflow-x:auto;height:180px;width:100%;position:absolute;z-index: 1000;background-color:#ffcdca;cursor: pointer;">

                                 </div>
                    </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                                 <div class="mainArabicChoiceContainer">

                    <div class="form-group">
                    <label for="choice_name_ar">Choice Name(ar)<span class="text-danger"> *</span></label>
                    <input type="text" name="choice_name_ar[]" class="form-control edit_dynamic_name_ar arabicChoiceInput"     maxlength="100" value="` +
                                data.name_ar + `">
                    </div>
                     <div class="border-lg arabicChoiceSuggestionBox d-none " style="overflow-x:auto;height:180px;width:100%;position:absolute;z-index: 1000;background-color:#ffcdca;cursor: pointer;" >



                                 </div>
                    </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3 col-12">
                    <div class="form-group">
                    <label for="choice_price">Price(KD) </label>
                    <input type="number" name="choice_price[]" class="form-control" step="any" value="` + data.price +
                                `">
                    </div>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete">

                    <i class="text-danger fa fa-trash-alt choice_remove_btnpre" style="font-size:20px;cursor:pointer" data-id="` +
                                data.id + `"></i>
                    </div>
                    </div></div>`;
                            var option = `<option value="` + index_selected + `" ` + selected +
                                ` >` + index_selected + `</option>`;
                            // var option = `<option  value="`+ ++index_selected+`" `+selected+`>`+ ++index+`</option>`;
                        }
                        $('.edit_choices_parent').append(html);
                        $('.edit_mendatory_choice_count').append(option);
                        $('#ttotal_choice_countd').append(maxchoice_option);

                        $('#edit_total_choice_count').val(index_selected);
                    });



                    // start choice suggestions

                    $(document).ready(function() {


                        //01 - click on input field and show suggestions For english choice..................

                        $('.englishChoiceInput').each(function() {
                            $(this).on('input', function() {

                                var currentInputField = this;
                                var currentInputFieldValue = this.value;
                                var mainEnglisChoiceContainer = this
                                    .parentElement.parentElement;
                                var englishChoiceSuggestionBox =
                                    mainEnglisChoiceContainer
                                    .getElementsByTagName('DIV')[1];
                                //console.log(englishChoiceSuggestionBox);

                                //Get second input field arabic for autofill
                                var mainEnglisArabicChoiceContainer = this
                                    .parentElement.parentElement.parentElement
                                    .parentElement.parentElement;
                                var CurrentInputArabic =
                                    mainEnglisArabicChoiceContainer
                                    .getElementsByTagName('INPUT')[2];

                                if (this.value.length > 0) {
                                    //Remove d-none class
                                    $(englishChoiceSuggestionBox).removeClass(
                                        'd-none');

                                    //onclick and make input filed value
                                    //Get Data from database
                                    //alert(currentInputFieldValue);

                                    //stat get data form database

                                    $.ajax({
                                        type: 'post',
                                        url: "{{ route('menu.item.get.choice.suggestion') }}",
                                        data: {
                                            id: "1",
                                            choice_key: currentInputFieldValue
                                        },
                                        dataType: "JSON",
                                        headers: {
                                            'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]'
                                            ).attr('content')
                                        },
                                        success: function(response) {
                                            //  console.log(response+"ajax");
                                            if (response.success ==
                                                1) {
                                                // console.log(response.data);
                                                $(englishChoiceSuggestionBox)
                                                    .html(' ');
                                                response.data
                                                    .forEach(
                                                        function(
                                                            data,
                                                            index) {
                                                            var choices_name =
                                                                data;
                                                            var html =
                                                                `<li class="p-2 border-bottom choicesSuggestionList" ar_input_value="` +
                                                                response
                                                                .data_ar[
                                                                    index
                                                                ] +
                                                                `">` +
                                                                choices_name +
                                                                `</li>`;
                                                            $(englishChoiceSuggestionBox)
                                                                .append(
                                                                    html
                                                                );
                                                        });

                                                $(allchoicesSuggestionList)
                                                    .each(
                                                        function() {
                                                            $(this)
                                                                .click(
                                                                    function() {
                                                                        var choiceSuggestionName =
                                                                            $(
                                                                                this
                                                                            )
                                                                            .text();
                                                                        var arabicSuggestions =
                                                                            $(
                                                                                this
                                                                            )
                                                                            .attr(
                                                                                'ar_input_value'
                                                                            );
                                                                        // console.log(choiceSuggestionName);
                                                                        $(currentInputField)
                                                                            .val(
                                                                                choiceSuggestionName
                                                                            );
                                                                        $(CurrentInputArabic)
                                                                            .val(
                                                                                arabicSuggestions
                                                                            );
                                                                        $(englishChoiceSuggestionBox)
                                                                            .addClass(
                                                                                'd-none'
                                                                            );
                                                                    }
                                                                );
                                                        });

                                            } else {
                                                //$(englishChoiceSuggestionBox).html(' ');
                                                // var html = `<li class="p-2 border-bottom choicesSuggestionList">Choice not found !</li>`;
                                                //  $(englishChoiceSuggestionBox).append(html);
                                                $(englishChoiceSuggestionBox)
                                                    .addClass(
                                                        'd-none');

                                            }
                                        }
                                    });


                                    //end get data form database



                                    var allchoicesSuggestionList =
                                        englishChoiceSuggestionBox
                                        .getElementsByClassName(
                                            'choicesSuggestionList');

                                    $(allchoicesSuggestionList).each(
                                        function() {
                                            $(this).click(function() {
                                                var choiceSuggestionName =
                                                    $(this).text();
                                                // console.log(choiceSuggestionName);
                                                $(currentInputField)
                                                    .val(
                                                        choiceSuggestionName
                                                    );
                                                $(englishChoiceSuggestionBox)
                                                    .addClass(
                                                        'd-none');
                                            });
                                        });


                                } else {
                                    $(englishChoiceSuggestionBox).addClass(
                                        'd-none');
                                }

                            });


                            //onchnage add class d-none

                            // $(this).on('focusout',function() {
                            //       var currentInputField = this;
                            //      var currentInputFieldValue = this.value;
                            //      var mainEnglisChoiceContainer = this.parentElement.parentElement;
                            //      var englishChoiceSuggestionBox = mainEnglisChoiceContainer.getElementsByTagName('DIV')[1];
                            //      $(englishChoiceSuggestionBox).addClass('d-none');
                            // });


                            $(this).on('click', function() {
                                // if(this.value.length > 0){
                                // alert();
                                // }

                                $('.englishChoiceSuggestionBox , .arabicChoiceSuggestionBox')
                                    .each(function() {
                                        $(this).addClass('d-none');
                                    });

                            });


                        });

















                        //02 - click on input field and show suggestions For english choice..................

                        $('.arabicChoiceInput').each(function() {
                            $(this).on('input', function() {
                                var currentInputField = this;
                                var currentInputFieldValue = this.value;
                                var mainEnglisChoiceContainer = this
                                    .parentElement.parentElement;
                                var englishChoiceSuggestionBox =
                                    mainEnglisChoiceContainer
                                    .getElementsByTagName('DIV')[1];
                                console.log(englishChoiceSuggestionBox);

                                if (this.value.length > 0) {
                                    //Remove d-none class
                                    $(englishChoiceSuggestionBox).removeClass(
                                        'd-none');

                                    //onclick and make input filed value
                                    //Get Data from database
                                    //alert(currentInputFieldValue);

                                    //stat get data form database

                                    $.ajax({
                                        type: 'post',
                                        url: "{{ route('menu.item.get.choice.suggestion') }}",
                                        data: {
                                            id: "2",
                                            choice_key: currentInputFieldValue
                                        },
                                        dataType: "JSON",
                                        headers: {
                                            'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]'
                                            ).attr('content')
                                        },
                                        success: function(response) {
                                            //  console.log(response+"ajax");
                                            if (response.success ==
                                                1) {
                                                // console.log(response.data);
                                                $(englishChoiceSuggestionBox)
                                                    .html(' ');
                                                response.data
                                                    .forEach(
                                                        function(
                                                            data,
                                                            index) {
                                                            var choices_name =
                                                                data;
                                                            var html =
                                                                `<li class="p-2 border-bottom choicesSuggestionList">` +
                                                                choices_name +
                                                                `</li>`;
                                                            $(englishChoiceSuggestionBox)
                                                                .append(
                                                                    html
                                                                );
                                                        });

                                                $(allchoicesSuggestionList)
                                                    .each(
                                                        function() {
                                                            $(this)
                                                                .click(
                                                                    function() {
                                                                        var choiceSuggestionName =
                                                                            $(
                                                                                this
                                                                            )
                                                                            .text();
                                                                        // console.log(choiceSuggestionName);
                                                                        $(currentInputField)
                                                                            .val(
                                                                                choiceSuggestionName
                                                                            );
                                                                        $(englishChoiceSuggestionBox)
                                                                            .addClass(
                                                                                'd-none'
                                                                            );
                                                                    }
                                                                );
                                                        });

                                            } else {
                                                $(englishChoiceSuggestionBox)
                                                    .html(' ');
                                                // var html = `<li class="p-2 border-bottom choicesSuggestionList">Choice not found !</li>`;
                                                // $(englishChoiceSuggestionBox).append(html);
                                                $(englishChoiceSuggestionBox)
                                                    .addClass(
                                                        'd-none');

                                            }
                                        }
                                    });


                                    //end get data form database



                                    var allchoicesSuggestionList =
                                        englishChoiceSuggestionBox
                                        .getElementsByClassName(
                                            'choicesSuggestionList');

                                    $(allchoicesSuggestionList).each(
                                        function() {
                                            $(this).click(function() {
                                                var choiceSuggestionName =
                                                    $(this).text();
                                                // console.log(choiceSuggestionName);
                                                $(currentInputField)
                                                    .val(
                                                        choiceSuggestionName
                                                    );
                                                $(englishChoiceSuggestionBox)
                                                    .addClass(
                                                        'd-none');
                                            });
                                        });


                                } else {
                                    $(englishChoiceSuggestionBox).addClass(
                                        'd-none');
                                }

                            });


                            //onchnage add class d-none


                            $(this).on('click', function() {
                                // if(this.value.length > 0){
                                // alert();
                                // }

                                $('.englishChoiceSuggestionBox , .arabicChoiceSuggestionBox')
                                    .each(function() {
                                        $(this).addClass('d-none');
                                    });

                            });



                        });








                        //end choice suggestions
                    });


                    //remove choices
                    $('.choice_remove_btn').each(function() {
                        $(this).click(function() {

                            var total_choice_length = $('#edit_total_choice_count')
                                .val();
                            $('#edit_total_choice_count').val(total_choice_length - 1);
                            var indx = $('#edit_total_choice_count').val();
                            $('.edit_mendatory_choice_count').html(' ');
                            $('#ttotal_choice_countd').html('');
                            for (i = 0; i < parseInt(total_choice_length); i++) {
                                if (i == 0) {
                                    var selected = '';
                                    if (mendatory_choice_count == i) {
                                        // alert(mendatory_choice_count);
                                        selected = 'selected';
                                    }
                                    var option = `<option value="` + i + `"  ` +
                                        selected + `>` + i + `(optional)</option>`;
                                    $('.edit_mendatory_choice_count').append(option);
                                } else {
                                    var selected = '';
                                    if (mendatory_choice_count == i) {
                                        // alert(mendatory_choice_count);
                                        selected = 'selected';
                                    }
                                    var option = `<option value="` + i + `" ` +
                                        selected + ` >` + i + `</option>`;
                                    $('.edit_mendatory_choice_count').append(option);
                                    $('#ttotal_choice_countd').append(option);
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
                        var option = `<option value=` + total_choice_count + `>` +
                            total_choice_count + `</option>`;
                        $('.edit_mendatory_choice_count').append(option);
                        $('#ttotal_choice_countd').append(option);



                        var html = `<div class="col-12"><div class="row choices_child mt-2 pl-0">

                <div class="col-md-4 col-lg-4 col-xl-4 col-4">
                                 <div class="mainArabicChoiceContainer">

                <div class="form-group">
                <label for="choice_name_en">Choice Name(en)<span class="text-danger"> *</span></label>
                <input type="text" name="editchoice_name_en[]" class="form-control edit_dynamic_name_en englishChoiceInput"     maxlength="100">
                </div>
                <div class="border-lg englishChoiceSuggestionBox d-none"  style="overflow-x:auto;height:180px;width:100%;position:absolute;z-index: 1000;background-color:#ffcdca;cursor: pointer;">

                                 </div>
                </div>
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 col-4">
                                 <div class="mainArabicChoiceContainer">

                <div class="form-group">
                <label for="choice_name_ar">choice Name(ar)<span class="text-danger"> *</span></label>
                <input type="text" name="editchoice_name_ar[]" class="form-control edit_dynamic_name_ar arabicChoiceInput"     maxlength="100">
                </div>

                 <div class="border-lg arabicChoiceSuggestionBox d-none " style="overflow-x:auto;height:180px;width:100%;position:absolute;z-index: 1000;background-color:#ffcdca;cursor: pointer;" >



                                 </div>

                </div>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-12">
                <div class="form-group">
                <label for="choice_price">Price(KD)</label>
                <input type="number" name="editchoice_price[]" class="form-control" step="any">
                </div>
                </div>
                <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete">

                <i class="text-danger fa fa-trash-alt choice_remove_btn" style="font-size:20px;cursor:pointer"></i>
                </div>
                </div></div>`;
                        $('.edit_choices_parent').append(html);







                        //remove choices
                        $('.choice_remove_btn').each(function() {
                            $(this).click(function() {
                                var total_choice_length = $(
                                    '#edit_total_choice_count').val();
                                $('#edit_total_choice_count').val(
                                    total_choice_length - 1);
                                $('.edit_mendatory_choice_count').html(' ');
                                $('#ttotal_choice_countd').html('');

                                for (i = 0; i < parseInt(
                                        total_choice_length); i++) {
                                    if (i == 0) {
                                        var selected = '';
                                        if (mendatory_choice_count == i) {

                                            selected = 'selected';
                                        }
                                        var option = `<option value="` + i +
                                            `"  ` + selected + `>` + i +
                                            `(optional)</option>`;
                                        $('.edit_mendatory_choice_count')
                                            .append(option);
                                    } else {
                                        var selected = '';
                                        if (mendatory_choice_count == i) {

                                            selected = 'selected';
                                        }
                                        var option = `<option value="` + i +
                                            `"  ` + selected + `>` + i +
                                            `</option>`;
                                        $('.edit_mendatory_choice_count')
                                            .append(option);
                                        $('#ttotal_choice_countd').append(
                                            option);
                                    }
                                }
                                var parentElements = this.parentElement
                                    .parentElement;
                                parentElements.remove();
                            });
                        });
                    });
                    //end more choices
                }
            });
        });
        $('#editChoiceGroupForm').submit(function(e) {
            e.preventDefault();

            var maxchoice = $('#ttotal_choice_countd').find(':selected').val();
            var minchoice = $('.edit_mendatory_choice_count').find(':selected').val();
            if (minchoice <= maxchoice) {
                //alert('success')
            } else {
                toastr.error("Please Minimum Number of Choices Less then or Equal Maximum Number of choices");
                $('.edit_mendatory_choice_count').focus();
                return false;
            }

            if ($('#edit_name_en').val().trim() == '') {
                $('#edit_name_en').next().remove();
                $("<span class='text-danger compare'>Group Name(en) is required </span>").insertAfter(
                    '#edit_name_en');
            }
            if ($('#edit_name_ar').val().trim() == '') {
                $('#edit_name_ar').next().remove();
                $("<span class='text-danger compare'>Group Name(ar) is required </span>").insertAfter(
                    '#edit_name_ar');
            }
            $('#edit_name_en').on('input', function() {
                $('#edit_name_en').next().remove();
            });
            $('#edit_name_ar').on('input', function() {
                $('#edit_name_ar').next().remove();
            });
            $('.edit_dynamic_name_en').each(function() {
                if ($(this).val().trim() == '') {
                    $(this).next().remove();
                    $("<span class='text-danger compare'>Choice Name(en) is required </span>").insertAfter(
                        this);
                }
            });
            $('.edit_dynamic_name_en').each(function() {
                $(this).on('input', function() {
                    $(this).next().remove();
                });
            });



            $('.edit_dynamic_name_ar').each(function() {
                if ($(this).val().trim() == '') {
                    $(this).next().remove();
                    $("<span class='text-danger compare'>Choice Name(ar) is required </span>").insertAfter(
                        this);
                }
            });
            $('.edit_dynamic_name_ar').each(function() {
                $(this).on('input', function() {
                    $(this).next().remove();
                });
            });
            var container = document.getElementById('editChoiceGroupForm');
            var input = container.getElementsByClassName("compare");
            if (input.length == 0) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('menu.item.choice.group.addupdate') }}",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#edit_group_modal').modal('hide');
                        if (response.data == 'success') {
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
                                // alert("Something went wrong! Please try again.");
                            }, 500);
                        }
                    }
                });
            }
        });
    </script>
    <script>
        var urlParams = window.location.href.match('menu/items/add');
        if (urlParams) {
            $('.menu_item_add').trigger('click');
            $('.menu_item_add').addClass('active');
            $('.menu_item_add').removeClass('d-none');
            // $('.menu_item_choice_group').addClass('d-none');
            $('.menu_item_add_show').addClass('show  active');
        }
        var add_choice = window.location.href.match('items/add/choice');
        if (add_choice) {
            $('.menu_item_choice_group').trigger('click');
            $('.menu_item_choice_group').removeClass('disabled');
            $('.menu_item_add').removeClass('active');
            $('.menu_item_choice_group').addClass('active');
            $('.menu_item_add').addClass('disabled');
            $('.menu_item_add_show').removeClass('show  active');
            $('.menu_item_choice_show').addClass('show  active');
            $('.menu_item_currentoffers').removeClass('disabled');

        }

        var add_choice = window.location.href.match('menu/current_offers');
        if (add_choice) {
            $('.menu_item_currentoffers').trigger('click');
            $('.menu_item_choice_group').addClass('disabled');
            $('.menu_item_currentoffers').removeClass('disabled');
            $('.menu_item_add').removeClass('active');
            $('.menu_item_currentoffers').addClass('active');
            $('.menu_item_add').addClass('disabled');
            $('.menu_item_add').removeClass('d-none');
            $('.menu_item_add_show').removeClass('show  active');
            $('.menu_item_choice_show').removeClass('show  active');
            $('.menu_item_currentoffers_show').addClass('show  active');


        }
        $(document).ready(function() {
            $(document).on('click', '.menu_item_currentoffers', function() {
                //$('.menu_item_choice_group').addClass('disabled');
                // $('.menu_item_choice_show').removeClass('show  active');
                window.location.href = "{{ route('current_offers.index') }}";

            });

            $("#appbrackcheck").click(function() {
                $("input[type=checkbox]").prop('checked', this.checked)
            })

            $('.checkBoxClass').on('click', function() {
                if ($('.checkBoxClass:checked').length == $('.checkBoxClass').length) {
                    $(".ckbCheckAll").prop('checked', 'true');
                } else {

                    $(".ckbCheckAll").prop('checked', false);
                }
            })

            jQuery.validator.addMethod("maxlengthd", function(value, element) {
                if ($('#select').val() == '0') {
                    if (value <= 100) {
                        return true;
                    } else {
                        console.log('not submit first validate');
                        return false;
                    }
                } else {
                    return true;
                }
            }, 'Please enter a valid Percentage/Amount');



            $('#formcurrent_offers').validate({
                ignore: [],
                debug: false,
                rules: {
                    current_offer_name: {
                        required: true
                    },
                    current_offer_description: {
                        required: true
                    },
                    offers_type: {
                        required: true,
                        noSpace: true
                    },
                    current_offer_amount: {
                        required: true,
                        maxlengthd: true
                    },
                    'branchs[]': {
                        required: true,
                        minlength: 1
                    },
                    current_offer_enddate: {
                        required: true
                    },
                    current_offer_startdate: {
                        required: true
                    },
                    c_offerimage: {
                        required: true
                    }



                },
                messages: {
                    current_offer_name: {
                        required: "Offer Name is required"
                    },
                    current_offer_description: {
                        required: "Description is required"
                    },
                    offers_type: {
                        required: "Offer Type is required",
                    },

                    current_offer_amount: {
                        required: "Percentage/Amount is required",
                    },
                    'branchs[]': {
                        required: "Branch is required"
                    },
                    current_offer_enddate: {
                        required: "End Date/ Time is required"
                    },
                    current_offer_startdate: {
                        required: "Start Date/ Time is required"
                    },
                    c_offerimage: {
                        required: "Image is required"
                    }

                },
                submitHandler: function(form) {


                    if ($('.ckbCheckAll').is(':checked')) {

                        return true;
                    } else {
                        // alert('branch is required');
                        $('.select_notice').removeClass('d-none');

                        setTimeout(function() {
                            $('.select_notice').addClass('d-none');
                        }, 1800);
                        return false;
                    }




                    //  return false;




                }


            });



        });


        $(document).ready(function() {

            $('#branch_unselect_all').on('click', function() {

                var branch_all_inputs_container = $('.branch_all_inputs_container')[0];
                var all_inputs = branch_all_inputs_container.getElementsByTagName('INPUT');
                $(all_inputs).each(function() {
                    $(this).prop('checked', false);
                    $('#branches-modal').modal('hide');
                    $('#all_selected_branch_container').html();
                    $('#all_selected_branch_container').addClass('d-none');
                    // $('#all_selected_branch_container').removeClass('d-none');
                });

            });

        });
    </script>




    <script type="text/javascript">
        $(document).ready(function() {

            //01 - click on input field and show suggestions For english choice..................

            $('.englishChoiceInput').each(function() {
                $(this).on('input', function() {

                    var currentInputField = this;
                    var currentInputFieldValue = this.value;
                    var mainEnglisChoiceContainer = this.parentElement.parentElement;
                    var englishChoiceSuggestionBox = mainEnglisChoiceContainer.getElementsByTagName(
                        'DIV')[1];
                    //console.log(englishChoiceSuggestionBox);
                    //Get second input field arabic for autofill
                    var mainEnglisArabicChoiceContainer = this.parentElement.parentElement
                        .parentElement.parentElement.parentElement;
                    var CurrentInputArabic = mainEnglisArabicChoiceContainer.getElementsByTagName(
                        'INPUT')[1];
                    var pr_price = mainEnglisArabicChoiceContainer.getElementsByTagName('INPUT')[2];
                    if (this.value.length > 0) {
                        //Remove d-none class
                        $(englishChoiceSuggestionBox).removeClass('d-none');

                        //onclick and make input filed value
                        //Get Data from database
                        //alert(currentInputFieldValue);

                        //stat get data form database

                        $.ajax({
                            type: 'post',
                            url: "{{ route('menu.item.get.choice.suggestion') }}",
                            data: {
                                id: "1",
                                choice_key: currentInputFieldValue
                            },
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                //  console.log(response+"ajax");
                                if (response.success == 1) {
                                    // console.log(response.data);
                                    $(englishChoiceSuggestionBox).html(' ');
                                    response.data.forEach(function(data, index) {
                                        var choices_name = data;
                                        var html =
                                            `<li class="p-2 border-bottom choicesSuggestionList" ar_input_value="` +
                                            response.data_ar[index] +
                                            `" data-price="` + response
                                            .data_price[index] + `">` +
                                            choices_name + `</li>`;
                                        $(englishChoiceSuggestionBox).append(
                                            html);
                                    });

                                    $(allchoicesSuggestionList).each(function() {
                                        $(this).click(function() {
                                            var choiceSuggestionName =
                                                $(this).text();
                                            var arabicSuggestions = $(
                                                this).attr(
                                                'ar_input_value');
                                            var psd = $(this).attr(
                                                'data-price');

                                            $(currentInputField).val(
                                                choiceSuggestionName
                                            );
                                            $(CurrentInputArabic).val(
                                                arabicSuggestions);
                                            $(pr_price).val(psd);
                                            $(englishChoiceSuggestionBox)
                                                .addClass('d-none');
                                        });
                                    });

                                } else {
                                    //$(englishChoiceSuggestionBox).html(' ');
                                    // var html = `<li class="p-2 border-bottom choicesSuggestionList">Choice not found !</li>`;
                                    //  $(englishChoiceSuggestionBox).append(html);
                                    $(englishChoiceSuggestionBox).addClass('d-none');

                                }
                            }
                        });


                        //end get data form database



                        var allchoicesSuggestionList = englishChoiceSuggestionBox
                            .getElementsByClassName('choicesSuggestionList');

                        $(allchoicesSuggestionList).each(function() {
                            $(this).click(function() {
                                var choiceSuggestionName = $(this).text();
                                // console.log(choiceSuggestionName);
                                $(currentInputField).val(choiceSuggestionName);
                                $(englishChoiceSuggestionBox).addClass('d-none');
                            });
                        });


                    } else {
                        $(englishChoiceSuggestionBox).addClass('d-none');
                    }

                });


                //onchnage add class d-none

                // $(this).on('focusout',function() {
                //       var currentInputField = this;
                //      var currentInputFieldValue = this.value;
                //      var mainEnglisChoiceContainer = this.parentElement.parentElement;
                //      var englishChoiceSuggestionBox = mainEnglisChoiceContainer.getElementsByTagName('DIV')[1];
                //      $(englishChoiceSuggestionBox).addClass('d-none');
                // });


                $(this).on('click', function() {
                    // if(this.value.length > 0){
                    // alert();
                    // }

                    $('.englishChoiceSuggestionBox , .arabicChoiceSuggestionBox').each(function() {
                        $(this).addClass('d-none');
                    });

                });


            });

















            //02 - click on input field and show suggestions For english choice..................

            $('.arabicChoiceInput').each(function() {
                $(this).on('input', function() {
                    var currentInputField = this;
                    var currentInputFieldValue = this.value;
                    var mainEnglisChoiceContainer = this.parentElement.parentElement;
                    var englishChoiceSuggestionBox = mainEnglisChoiceContainer.getElementsByTagName(
                        'DIV')[1];
                    console.log(englishChoiceSuggestionBox);

                    if (this.value.length > 0) {
                        //Remove d-none class
                        $(englishChoiceSuggestionBox).removeClass('d-none');

                        //onclick and make input filed value
                        //Get Data from database
                        //alert(currentInputFieldValue);

                        //stat get data form database

                        $.ajax({
                            type: 'post',
                            url: "{{ route('menu.item.get.choice.suggestion') }}",
                            data: {
                                id: "2",
                                choice_key: currentInputFieldValue
                            },
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                //  console.log(response+"ajax");
                                if (response.success == 1) {
                                    // console.log(response.data);
                                    $(englishChoiceSuggestionBox).html(' ');
                                    response.data.forEach(function(data, index) {
                                        var choices_name = data;
                                        var html =
                                            `<li class="p-2 border-bottom choicesSuggestionList">` +
                                            choices_name + `</li>`;
                                        $(englishChoiceSuggestionBox).append(
                                            html);
                                    });

                                    $(allchoicesSuggestionList).each(function() {
                                        $(this).click(function() {
                                            var choiceSuggestionName =
                                                $(this).text();
                                            // console.log(choiceSuggestionName);
                                            $(currentInputField).val(
                                                choiceSuggestionName
                                            );
                                            $(englishChoiceSuggestionBox)
                                                .addClass('d-none');
                                        });
                                    });

                                } else {
                                    $(englishChoiceSuggestionBox).html(' ');
                                    // var html = `<li class="p-2 border-bottom choicesSuggestionList">Choice not found !</li>`;
                                    // $(englishChoiceSuggestionBox).append(html);
                                    $(englishChoiceSuggestionBox).addClass('d-none');

                                }
                            }
                        });


                        //end get data form database



                        var allchoicesSuggestionList = englishChoiceSuggestionBox
                            .getElementsByClassName('choicesSuggestionList');

                        $(allchoicesSuggestionList).each(function() {
                            $(this).click(function() {
                                var choiceSuggestionName = $(this).text();
                                // console.log(choiceSuggestionName);
                                $(currentInputField).val(choiceSuggestionName);
                                $(englishChoiceSuggestionBox).addClass('d-none');
                            });
                        });


                    } else {
                        $(englishChoiceSuggestionBox).addClass('d-none');
                    }

                });


                //onchnage add class d-none


                $(this).on('click', function() {
                    // if(this.value.length > 0){
                    // alert();
                    // }

                    $('.englishChoiceSuggestionBox , .arabicChoiceSuggestionBox').each(function() {
                        $(this).addClass('d-none');
                    });

                });



            });



        });
    </script>






    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', function() {



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
                data: { //define cropbox size
                    width: 400,
                    height: 300,
                },
            }

            var this_obj;

            $('[data-toggle="tooltip"]').tooltip();

            // alert(input);
            $('.upload_image').click(function() {
                input.click();
            })

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
                        swal("Error!", "Please select a image below 5 MB!", "error");
                        return false;
                    }

                    if (file.type == 'image/png' || file.type == 'image/jpeg' || file.type ==
                        'image/svg+xml') {


                    } else {
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
                cropper = new Cropper(image, options);
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
                    initialAvatarURL = avatar.src;
                    avatar.src = canvas.toDataURL();

                    console.log('res-----------');
                    console.log(avatar.src);

                    $('.profile_image').val(avatar.src);
                    $('#thumbnail_preview').css('display', 'block');
                    //$('#thumbnail_preview').attr('src', e.target.result);
                    $('.upload-img').removeClass('d-none');

                    console.log($('.profile_image').val());

                    $progress.show();
                    $alert.removeClass('alert-success alert-warning');

                }
            });
        });
    </script>

    {{-- For Loyalty Item --}}
    <script>
        $(document).ready(function() {
            $(document).on("change", "#loyality_checkbox", function() {
                if (this.checked) {
                    //Do stuff
                    $('#loyality_item_points').show();
                    $('#loyality_checkbox').attr("data-id", 1);
                    $('.switch_container').show();
                } else {
                    $('#loyality_item_points').hide();
                    $('#loyality_checkbox').attr("data-id", 0);
                    $('#loyality_item_points-error').hide();
                    $('#loyality_item_points').val('');
                    $('.switch_container').hide();

                    $('#loyalty_status').val(1);

                    let loyalty_id = $('#loyality_item_points').attr('data-id');

                    if (loyalty_id != null && loyalty_id != '') {

                        $.ajax({
                            type: "POST",
                            url: "{{ route('menu.item.delete_loyalty_item') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                loyalty_id: loyalty_id,
                            },
                            dataType: "JSON",
                            success: function(response) {}
                        });

                    }

                }
            });

        });
    </script>
    {{--  ------------- --}}

    {{-- For Regular Item --}}
    <script>
        $(document).ready(function() {
            $(document).on("change", "#regular_checkbox", function() {
                if (this.checked) {
                    //Do stuff
                    $('.regular_input_value').show();
                    $('#regular_checkbox').attr("data-id", 1);
                    $('.regular_status').show();
                } else {
                    $('.regular_input_value').hide();
                    $('#regular_checkbox').attr("data-id", 0);
                    $('#loyalty_point-error').hide();
                    $('#price-error').hide();
                    $('.regular_status').hide();

                    // let loyalty_id = $('.regular_input_value').attr('data-id');

                    // if (loyalty_id != null && loyalty_id != '') {

                    //     $.ajax({
                    //         type: "POST",
                    //         url: "{{ route('menu.item.delete_loyalty_item') }}",
                    //         data: {
                    //             "_token": "{{ csrf_token() }}",
                    //             loyalty_id: loyalty_id,
                    //         },
                    //         dataType: "JSON",
                    //         success: function(response) {}
                    //     });

                    // }

                }
            });

        });

        $(document).on('focusout', '#choice_name_en', function() {

            $.ajax({
                type: "POST",
                url: "{{ route('check_choice_name_exist') }}",
                data: {
                    choice_name: $(this).val(),
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.status == "true") {
                        $('#choice_name_ar').val(response.arabic_name);
                    }
                }
            });

        });

        $(document).on('focusout', '#edit_name_en', function() {

            $.ajax({
                type: "POST",
                url: "{{ route('check_choice_name_exist') }}",
                data: {
                    choice_name: $(this).val(),
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.status == "true") {
                        $('#edit_name_ar').val(response.arabic_name);
                    }
                }
            });

        });
    </script>
    {{--  ------------- --}}

@stop
