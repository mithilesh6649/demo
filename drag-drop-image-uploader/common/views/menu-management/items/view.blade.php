@extends('adminlte::page') @section('title', 'Super Admin | Menu Item Details') @section('content_header') @section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-main">
                    <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                        <h3> Menu Item Details</h3> <a class="btn btn-sm btn-success"
                            href="{{ route('menu.item.list') }}">{{ __('adminlte::adminlte.back') }}</a>
                    </div>
                    <div class="card-body p-0">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                        @endif
                        <!-- tab content here -->
                        <div class="tab_wrapper">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link nav_link   active   " id="pills-home-tab" data-toggle="pill"
                                        href="#pills-home" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Item</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav_link   " id="pills-transactions-tab" data-toggle="pill"
                                        href="#pills-transactions" role="tab" aria-controls="pills-transactions"
                                        aria-selected="false">Choice Groups</a>
                                </li>
                                <li class="nav-item d-none">
                                    <a class="nav-link nav_link   " id="pills-transactions-tab" data-toggle="pill"
                                        href="#pills-current_offers" role="tab" aria-controls="pills-current_offers"
                                        aria-selected="false">Current Offers</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade  show active " id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <form id="editUserForm" method="post" , action=""> @csrf
                                        <div class="card-body table form mb-0">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="first_name">Item Name{{ labelEnglish() }}</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="name" value="{{ $menuItem->item_name_en ?? ' ' }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="first_name">Item Name{{ labelArabic() }}</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="name" value="{{ $menuItem->item_name_ar ?? ' ' }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="description_en">Description{{ labelEnglish() }}
                                                        </label>
                                                        <textarea name="description_en">{!! $menuItem->description_en ?? 'N/A' !!}</textarea>


                                                    </div>
                                                </div>
                                                <!--Description in english -->
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="description_ar">Description{{ labelArabic() }}
                                                        </label>
                                                        <textarea name="description_en">{!! $menuItem->description_ar ?? 'N/A' !!}</textarea>

                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="first_name">Category</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="name"
                                                            value="{{ optional($menuItem->menuCategory)->name_en }} ( {{ optional($menuItem->menuCategory)->name_ar ?? '' }} )"
                                                            readonly>
                                                    </div>
                                                </div>

                                                {{-- Add To Regular --}}

                                                @if ($menuItem->price >= 0 && !(is_null($menuItem->price)))
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="added_content d-flex align-items-center justify-content-between flex-wrap">
                                                        <div class="first_content d-flex align-items-center">
                                                            <div class="custom-check">
                                                                <input type="checkbox" id="regular_checkbox"
                                                                    name="regular_checkbox" class="regular_checkbox"
                                                                    @if ($menuItem->price >= 0 && !(is_null($menuItem->price))) checked data-id="1" @else data-id="0" @endif disabled>
                                                                <span></span>
                                                            </div>
                                                            <strong class="list-text"> &nbsp; Add to Regular Item </strong>
                                                        </div>
                                                        <div class="input_content d-flex align-items-center justify-content-between flex-wrap">
                                                            <div class="second_content">
                                                                <div class="form-group">

                                                                    @if ($menuItem->item_type == 'loyalty')
                                                                        @php $price=(int)$menuItem->price; @endphp
                                                                    @else
                                                                        @php $price=$menuItem->price; @endphp
                                                                    @endif

                                                                    <input type="number"
                                                                        name="{{ $menuItem->item_type == 'loyalty' ? 'loyalty_point' : 'price' }}"
                                                                        class="form-control regular_input_value"
                                                                        id="price" maxlength="100" style="@if ($menuItem->price >= 0 && !(is_null($menuItem->price))) @else display:none; @endif"
                                                                        value="{{ $price }}" readonly>
                                                                </div>
                                                            </div>

                                                        <div class="third_content regular_status" style="@if ($menuItem->price >= 0 && !(is_null($menuItem->price))) @else display:none; @endif">
                                                            <div class="form-group">

                                                                <select class="form-control" name="status" disabled>

                                                                    @foreach ($status as $status_data)
                                                                        <option value="{{ $status_data->value }}"
                                                                            {{ $menuItem->status == $status_data->value ? 'selected' : '' }}>
                                                                            {{ $status_data->name }}</option>
                                                                    @endforeach

                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    </div>
                                                </div>
                                                @endif
                                                {{-- ------------- --}}

                                                {{-- Loyalty Item Content --}}

                                                @if (@$menuItem->loyalty_item->loyalty_points >= 0 && @$menuItem->loyalty_item->loyalty_points)
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="added_content d-flex align-items-center justify-content-between flex-wrap">
                                                        <div class="first_content d-flex align-items-center">
                                                            <div class="custom-check">
                                                                <input type="checkbox" id="loyality_checkbox"
                                                                    name="loyality_checkbox" class="loyality_checkbox"
                                                                    @if (@$menuItem->loyalty_item->loyalty_points && @$menuItem->loyalty_item->loyalty_points >=0 ) checked data-id="1" @else data-id="0" @endif disabled>
                                                                <span></span>
                                                            </div>
                                                            <strong class="list-text"> &nbsp; Add to Loyalty Item </strong>
                                                        </div>

                                                        <div class="input_content d-flex align-items-center justify-content-between flex-wrap">
                                                            <div class="second_content">
                                                                <div class="form-group">
                                                                    <input type="number"
                                                                        class="form-control loyality_item_points"
                                                                        id="loyality_item_points"
                                                                        name="loyality_item_points"
                                                                        style="@if (@$menuItem->loyalty_item->loyalty_points && @$menuItem->loyalty_item->loyalty_points >= 0) @else display:none; @endif"
                                                                        value="{{ @$menuItem->loyalty_item->loyalty_points }}"
                                                                        data-id="{{ @$menuItem->loyalty_item->id }}" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="third_content switch_container"
                                                                style="@if (@$menuItem->loyalty_item->loyalty_points && @$menuItem->loyalty_item->loyalty_points >= 0) @else display:none; @endif">
                                                                <div class="form-group">

                                                                    <select class="form-control" name="loyalty_status"
                                                                        id="loyalty_status" disabled>

                                                                        @foreach ($status as $status_data)
                                                                            <option value="{{ $status_data->value }}"
                                                                                {{ $status_data->value == @$menuItem->loyalty_item->status ? 'selected' : '' }}>
                                                                                {{ $status_data->name }}</option>
                                                                        @endforeach

                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                {{-- --------------- --}}



                                            {{-- Most Selling Item Content --}}
                                            
                                                    <div class="added_content d-flex align-items-center  flex-wrap">
                                                        <div class="first_content d-flex align-items-center">
                                                            <div class="custom-check">
                                                                <input disabled type="checkbox" id="mostselling_checkbox"
                                                                    name="mostselling_checkbox" class="mostselling_checkbox"
                                                                    data-id="0"  {{ @$menuItem->mostselling_item->menu_item_id == $menuItem->id ? 'checked':''}}>
                                                                <span></span>
                                                            </div>
                                                            <strong class="list-text"> &nbsp; Add to Most Selling </strong>
                                                        </div>
 

                                                   
                                                        </div>
                                                  
                                                    {{-- --------------- --}}



                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group">
                                                        <label class="pr-2 d-block images">Image</label>
                                                        <div class="upload-img">
                                                            @if ($menuItem->thumbnail != null)
                                                                <div style="width:250px;"> <img
                                                                        src="{{ asset('menuItem/thumbnail/' . $menuItem->thumbnail) }}"
                                                                        id="thumbnail_preview"
                                                                        class="menu_thumb_image"
                                                                        style="width:250px;cursor: pointer;margin-top: 0;">
                                                                </div>
                                                            @else
                                                                <img src="" alt="Image">
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="form-group mt-3">
                                                        <label for="rating" class="tagline">Tagline </label>
                                                        <textarea disabled id="rating" class="form-control" name="tagline" maxlength="500"
                                                            style="height:60px!important;">{{ $menuItem->tagline ?? 'N/A' }}</textarea>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="alert d-none" role="alert" id="flash-message"> </div>
                                <div class="tab-pane fade  " id="pills-transactions" role="tabpanel"
                                    aria-labelledby="pills-transactions-tab">
                                    <div class="card-body table items">
                                        <table style="width:100%" id="choice-list"
                                            class="table table-bordered table-hover">
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
                                            <tbody>
                                                @foreach ($menuItem->ChoiceGroups as $choicegroup)
                                                    <tr>
                                                        <td class="display-none"
                                                            c_g_n_en="{{ $choicegroup->name_en ?? '' }}"
                                                            c_g_n_ar="{{ $choicegroup->name_ar ?? '' }}"
                                                            m_c_count="{{ $choicegroup->mendatory_choice_count }}"
                                                            t_c_count="{{ $choicegroup->total_choice_count }}"></td>
                                                        <td>{{ $choicegroup->name_en ?? '' }}</td>
                                                        <td>{{ $choicegroup->name_ar ?? '' }}</td>
                                                        <td>
                                                            @foreach ($choicegroup->choice as $choice)
                                                                {{ $choice->name_en }}({{ $choice->price }}) ,
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($choicegroup->choice as $choice)
                                                                {{ $choice->name_ar }}({{ $choice->price }}) ,
                                                            @endforeach
                                                        </td>
                                                        <td><a data-id="{{ $choicegroup->id }}"
                                                                class="action-button view-button" title="view"
                                                                href="javascript:void(0)"><i
                                                                    class="text-info fa fa-eye"></i></a> </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- current offers modules -->
                                <div class="tab-pane fade" id="pills-current_offers" role="tabpanel"
                                    aria-labelledby="pills-current_offers">

                                    <div class="card-body table items">
                                        <form>
                                            <div class="card-body form">
                                                <div class="row">

                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label for="current_offer_amount">Offer Name </label>
                                                            <input type="text" name="current_offer_amount"
                                                                id="current_offer_amount" class="form-control"
                                                                value=" @if (count($current_offers) > 0) {{ $current_offers[0]->offer_name }} @else N/A @endif"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label for="current_offer_amount">Description </label>
                                                            <input type="text" name="current_offer_amount"
                                                                id="current_offer_amount" class="form-control"
                                                                value=" @if (count($current_offers) > 0) {{ $current_offers[0]->offer_description }} @else N/A @endif"
                                                                readonly>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group mt-3">
                                                            <label for="total_choice_count ">Offer Type</label>

                                                            <select class="form-select" disabled name="offers_type">
                                                                <option value="">Offer Type</option>

                                                                @if (count($current_offers) > 0)
                                                                    @foreach ($offerType as $offerTypes)
                                                                        <option
                                                                            @if ($current_offers[0]->current_offer_type == $offerTypes->value) selected @endif>
                                                                            {{ $offerTypes->name }}</option>
                                                                    @endforeach
                                                                @endif

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">

                                                        <div class="form-group mt-3">
                                                            <label for="current_offer_amount">Percentage/Amount
                                                            </label>

                                                            <input type="text" name="current_offer_amount"
                                                                id="current_offer_amount" class="form-control"
                                                                value=" @if (count($current_offers) > 0) {{ $current_offers[0]->amount }} @else N/A @endif"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mt-3">
                                                        <div class="form-group">
                                                            <label for="current_offer_startdate">Start Date/ Time
                                                            </label>
                                                            <input type="text"
                                                                value="@if (count($current_offers) > 0) {{ date('d/m/Y h:m A', strtotime($current_offers[0]->start_date)) }} @else N/A @endif"
                                                                name="current_offer_startdate"
                                                                id="current_offer_startdate" class="form-control"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 mt-3">
                                                        <div class="form-group">
                                                            <label for="current_offer_enddate">End Date/ Time</label>
                                                            <input type="text"
                                                                value="@if (count($current_offers) > 0) {{ date('d/m/Y h:m A', strtotime($current_offers[0]->end_date)) }} @else N/A @endif"
                                                                name="current_offer_enddate"
                                                                id="current_offer_enddate" class="form-control"
                                                                readonly>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12 mt-4">
                                                        <div class="form-group">
                                                            <label class="images">Image</label>
                                                            @if (count($current_offers) > 0)
                                                                <div class="mt-3 ml-1"
                                                                    style="width:300px;height:200px" class="mb-3">
                                                                    <img src="{{ asset('CMS/banner/' . $current_offers[0]->image) }}"
                                                                        width="100%" id="offeriamge" height="100%"
                                                                        style="border-radius: 10px;">
                                                                </div>
                                                            @else
                                                                <img src="" alt="image">
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select name="current_offer_status" disabled
                                                                class="form-select">
                                                                @if (count($current_offers) > 0)
                                                                    @foreach ($status as $status_data)
                                                                        <option
                                                                            @if ($current_offers[0]->status == $status_data->value) selected @endif>
                                                                            {{ $status_data->name }}</option>
                                                                    @endforeach
                                                                @endif

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class=" btn-group my-4" style="width: 49.333%;">
                                                            <div class="left_tab w-100">
                                                                <button type="button" class="btn btn-warning w-100"
                                                                    id="branch-modal"> Branch</button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div
                                                    class="row @if (count($current_offers) > 0) @else d-none @endif">
                                                    <div class="col-6">

                                                        <div id="branch" class="border">

                                                            <!--  <thead>
                                                    <tr style="border: none;">
                                                      <th style="border: none;"></th>
                                                    </tr>
                                                  </thead>
                                                  <tbody> -->
                                                            <ul class="mb-0">
                                                                @if (count($current_offers) > 0)
                                                                    @forelse ($current_offers[0]->brachlist as $branchlist)
                                                                        <li>
                                                                            @php
                                                                                $flg12 = \App\Models\CurrentOfferBranch::checkbranch($branchlist->branch_id);

                                                                            @endphp
                                                                            {{ $flg12 }}
                                                                        </li>


                                                                    @empty
                                                                    @endforelse
                                                                @endif

                                                            </ul>

                                                        </div>
                                                    </div>
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
<!-- edit choice group modal -->
<div id="edit_group_modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Choice Group Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-main m-0">
                    <form id="editChoiceGroupForm" class="p-0" enctype="multipart/form-data">
                        <div class="card-body form">
                            <div class="row">
                                <input type="hidden" name="choice_group_id" id="choice_group_id">
                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                    <div class="form-group">
                                        <label for="name_en">Group Name(en)</label>
                                        <input type="text" readonly name="name_en" class="form-control"
                                            id="edit_name_en" maxlength="100">
                                        @if ($errors->has('name_en'))
                                            <div class="error">{{ $errors->first('name_en') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                    <div class="form-group">
                                        <label for="name_ar">Group Name(ar)</label>
                                        <input type="text" readonly name="name_ar" class="form-control"
                                            id="edit_name_ar" maxlength="100">
                                        @if ($errors->has('name_ar'))
                                            <div class="error">{{ $errors->first('name_ar') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                    <div class="form-group mt-3">
                                        <label for="mendatory_choice_count">Minimum Number of Choices</label>
                                        <select class="form-control edit_mendatory_choice_count" disabled
                                            id="edit_mendatory_choice_count" name="mendatory_choice_count"> </select>
                                        @if ($errors->has('mendatory_choice_count'))
                                            <div class="error">{{ $errors->first('mendatory_choice_count') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                    <div class="form-group mt-3">
                                        <label for="total_choice_count ">Maximum number of choices</label>
                                        <input type="text" readonly name="total_choice_count" class="form-control"
                                            id="edit_total_choice_count" maxlength="100" value="1" readonly>
                                        @if ($errors->has('total_choice_count '))
                                            <div class="error">{{ $errors->first('total_choice_count ') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <!--                                     <div class="add-choices w-100 mt-3">

                                        <button type="button" >Add Choices</button>
                                    </div> -->
                                <div class="edit_choices_parent w-100" id="choices">
                                    <div class="row choices_child mt-3">
                                        <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                                            <div class="form-group">
                                                <label for="choice_name_en">Choice Name(en)</label>
                                                <input type="text" name="choice_name_en[]" readonly
                                                    class="form-control" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                                            <div class="form-group">
                                                <label for="choice_name_ar">Choice Name(ar)</label>
                                                <input type="text" readonly name="choice_name_ar[]"
                                                    class="form-control" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                                            <div class="form-group">
                                                <label for="choice_price">Price</label>
                                                <input type="number" readonly name="choice_price[]"
                                                    class="form-control" value="" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 col-12 mt-5">
                                            <!-- <i class="text-danger fa fa-trash-alt" style="font-size:28px"></i> -->
                                            <i class="text-success">Default</i>
                                        </div>
                                    </div>
                                </div>
                                <!-- add choices -->
                            </div>
                            <!-- /.card-body -->
                            <!-- <div class="card-footer">
                                 <button type="submit" class="btn btn-primary">Update</button>
                            </div> -->
                        </div>
                        <div class="modal-footer p-0">
                            <button type="button" class="button btn_bg_color common_btn text-white"
                                data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>



<!-- start menu thumbnail modal -->

<div class="modal fade" id="MenuItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menu Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <div class="modal-body" class="image_preview">


                <div class="carousel-inner" style=" width:100%; height:400px !important;">



                    <div class="carousel-item  active">
                        <img class="d-block " style="width: 100%; height: 400px;"
                            src="{{ asset('menuItem/thumbnail/' . $menuItem->thumbnail) }}" alt="First slide">
                    </div>

                </div>








            </div>
        </div>
    </div>
</div>


<!---end menu thumbnail modal---->



@endsection

@section('css')

<style>
    .categoryitm {
        position: relative;
        top: -10px;
    }

    #dst {
        position: relative;
        top: 10px;
    }

    .form-group textarea {
        height: 90px !important;
    }

    .dc {

        position: relative;
        top: -115px;

    }

    .modal-footer {
        padding-top: 25px;
        padding-bottom: 25px;
    }

    body form .card-body .btn-group button#branch-modal:active {
        background-color: #000000 !important;
        border-color: #000000 !important;
    }

    .tab_wrapper ul.nav.nav-pills {
        width: 70%;
    }

    .tab_wrapper ul li.nav-item {
        width: calc(33.33333333333333% - 5px);
    }
</style>
@stop
@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.view-button', function() {
            var id = $(this).data('id');
            $('#edit_group_modal').modal('show');
            $.ajax({
                type: "post",
                url: "{{ route('menu.item.choice.group.choices') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    console.log(response)
                    var url = "{{ asset('files') }}";
                    var all_data = response;
                    $('#edit_name_en').val(response.group.name_en);
                    $('#edit_name_ar').val(response.group.name_ar);
                    $('#edit_total_choice_count').val(response.group.total_choice_count);
                    $('#choice_group_id').val(choice_group_id);
                    $('.edit_choices_parent').html("");
                    $('.edit_mendatory_choice_count').html("");
                    var option = "<option value='0' selected>0(optional)</option>";
                    $('.edit_mendatory_choice_count').append(option);
                    var mendatory_choice_count = response.group.mendatory_choice_count
                    var index_selected = 0;
                    var selected = '';
                    response.ct.forEach(function(data, index) {
                        if (index == 0) {
                            index_selected = index + 1;
                            selected = '';
                            console.log("mc" + mendatory_choice_count);
                            console.log("in" + index_selected);
                            if (mendatory_choice_count == index_selected) {
                                selected = 'selected';
                            }


                            var html = `<div class="col-12"><div class="row choices_child mt-3">
               <input type="hidden" name="choiceid[]" value="` + data.id +
                                `" />
               <div class="col-md-4 col-lg-4 col-xl-4 col-12">
               <div class="form-group">
               <label for="choice_name_en">Choice Name(en)</label>
               <input type="text" readonly name="choice_name_en[]" class="form-control edit_dynamic_name_en" maxlength="100" value="` +
                                data.name_en +
                                `">
               </div>
               </div>
               <div class="col-md-4 col-lg-4 col-xl-4 col-12">
               <div class="form-group">
               <label for="choice_name_ar">Choice Name(ar)</label>
               <input type="text" readonly name="choice_name_ar[]" class="form-control edit_dynamic_name_ar" maxlength="100" value="` +
                                data.name_ar + `">
               </div>
               </div>
               <div class="col-md-4 col-lg-4 col-xl-4 col-12">
               <div class="form-group">
               <label for="choice_price">Price(KD)</label>
               <input type="number" readonly name="choice_price[]" class="form-control" maxlength="100" value="` + data
                                .price + `">
               </div>
               </div>

               </div></div`;
                            var option = `<option value="` + index_selected + `" ` +
                                selected + ` >` + index_selected + `</option>`;
                            // var option = `<option value="`+index_selected+`" `+selected+` >`+index+`(optional)</option><option value="`+ ++index_selected+`" `+selected+`>`+ ++index +`</option>`;
                        } else {
                            index_selected = index_selected + 1;
                            selected = '';
                            console.log("mc" + mendatory_choice_count);
                            console.log("in" + index_selected);
                            if (mendatory_choice_count == index_selected) {
                                selected = 'selected';
                            }


                            var html = `<div class="col-12"><div class="row choices_child mt-3">
                   <input type="hidden" name="choiceid[]" value="` + data.id +
                                `" />
                    <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                    <div class="form-group">
                    <label for="choice_name_en">Choice Name(en)</label>
                    <input type="text" readonly name="choice_name_en[]" class="form-control edit_dynamic_name_en" maxlength="100" value="` +
                                data.name_en +
                                `">
                    </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                    <div class="form-group">
                    <label for="choice_name_ar">Choice Name(ar)</label>
                    <input type="text" readonly name="choice_name_ar[]" class="form-control edit_dynamic_name_ar"     maxlength="100" value="` +
                                data.name_ar +
                                `">
                    </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                    <div class="form-group">
                    <label for="choice_price">Price(KD) </label>
                    <input type="number" readonly name="choice_price[]" class="form-control"     maxlength="100" value="` +
                                data
                                .price + `">
                    </div>
                    </div>

                    </div></div>`;
                            var option = `<option value="` + index_selected + `" ` +
                                selected + ` >` + index_selected + `</option>`;
                            // var option = `<option  value="`+ ++index_selected+`" `+selected+`>`+ ++index+`</option>`;
                        }
                        $('.edit_choices_parent').append(html);
                        $('.edit_mendatory_choice_count').append(option);
                    });
                }
            });
        });
    });
    $('#choice-list').DataTable({
        sorting: false,
        "language": {
            "emptyTable": " No choices found please add "
        },
    });
</script>




<script>
    $(document).ready(function() {
        $('.click_me').click(function() {
            $('#exampleModal').modal('show');
        });
    });


    $(document).ready(function() {
        $('.menu_thumb_image').each(function() {
            $(this).click(function() {




                $('#MenuItem').modal('show');




            });
        });
    });



    $(document).ready(function() {

        $('.carousel').carousel({
            interval: false,
        });
    });
</script>

@stop
