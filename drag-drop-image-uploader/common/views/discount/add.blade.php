@extends('adminlte::page')

@section('title', 'Super Admin | Add Discount ')

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
                            <h3>Add Discount</h3>
                        </div>
                        <div class="card-body table form mb-0">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                            @endif
                            <form id="addOfferForm" method="post" action="{{ route('discount.save') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group">
                                                <label for="discount_title">Discount Name <span class="text-danger">
                                                        *</span></label>
                                                <input type="text" id="discount_title" name="discount_title"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group">
                                                <label for="discount_description">Description <span class="text-danger">
                                                        *</span></label>
                                                <input type="text" id="discount_description" name="discount_description"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group mt-3">
                                                <label for="discount_type">Discount type<span class="text-danger">
                                                        *</span></label>
                                                <select class="form-control" name="discount_type">
                                                    <option value="">Select Discount Type</option>
                                                    <option>Amount</option>
                                                    <option>Percentage</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group mt-3"> <label for="title_en">Percentage/Amount <span
                                                        class="text-danger"> *</span></label> <input type="number"
                                                    name="discount_amount" class="form-control" id="discount_amount"
                                                    maxlength="100"> </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group mt-3"> <label for="start_date">Start Date/ Time<span
                                                        class="text-danger"> *</span></label>
                                                <input type="text" name="start_date" class="form-control dicount_date"
                                                    id="start_date" maxlength="100" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                            <div class="form-group mt-3"> <label for="end_date">End Date/ Time<span
                                                        class="text-danger"> *</span></label> <input type="text"
                                                    name="end_date" class="form-control dicount_date" id="end_date"
                                                    maxlength="100" autocomplete="off"> </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                            <div class="form-group mt-3">
                                                <label for="start_date">Status<span class="text-danger"> *</span></label>
                                                <select class="form-control" name="discount_status" id="discount_status">
                                                    @foreach ($status as $status_data)
                                                        <option value="{{ $status_data->value }}">{{ $status_data->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <label class="mb-3 mt-3">Discount applied on
                                            <a class="btn info_btn" data-toggle="tooltip" data-placement="right"
                                                title="Select Branch and Category/ Menu Item">
                                                <i class="fa fa-question-circle"></i>
                                            </a>
                                        </label>
                                        <div class="btn-group d-flex flex-wrap justify-content-between w-100">
                                            <div class="left_tab">
                                                <button type="button" class="btn btn-warning w-100"
                                                    id="branch-modal">Branch</button>
                                                <div class="border d-none mt-3" id="all_selected_branch_container">
                                                    <table class="d-none braches">
                                                        <thead>
                                                        </thead>
                                                        <tbody id="show_all_selected_branch">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="right_tab">
                                                <button type="button" class="btn btn-success w-100"
                                                    id="categories-modal">Category/ Menu Item</button>
                                                <div class="border d-none mt-3" id="all_selected_categories_container">
                                                    <div class="show_all_selected_categories" id="selectedaccordionExample">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div id="cat-modal" class="modal  fade  " role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <div class="modal-content menu">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        id="category_close_icon">&times;</button>
                                                    <h4 class="modal-title">
                                                        <div>
                                                            Add Menu Categories and items
                                                        </div>
                                                    </h4>

                                                  
                                                     <p class=" d-none select_branch_warning p-2 border bg-danger" style="width:fit-content;">Please Select Category/Menu Item and proceed</p>

                                                </div>
                                                <div class="modal-body categories-content">
                                                    {{-- $categories --}}
                                                    <!--start container -->
                                                    <div class="container-fluid  category_all_inputs_container "
                                                        id="quick_view_container">
                                                        <div class="accordion" id="accordionExample">
                                                            <div class="all-content d-flex align-items-center w-100">
                                                                <div class="custom-check">
                                                                    <input type="checkbox" id="category"
                                                                        name="category[]"
                                                                        class="checkItemsAllcategory selected">
                                                                    <span></span>
                                                                </div>
                                                                <strong class="list-text ml-3">All </strong>
                                                            </div>
                                                            
                                                                <div class="main_container">
                                                                    @forelse ($categories as $categorie)
                                                                    <div class="card categories">
                                                                        <div class="position-relative">
                                                                            <div class="card-header collapsed check_collapse"
                                                                                data-toggle="collapse"
                                                                                data-target="#{{ preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '', $categorie->name_en)) }}"
                                                                                aria-expanded="false">
                                                                                <span
                                                                                    class="title">{{ $categorie->name_en }}</span>
                                                                                <span class="accicon"><i
                                                                                        class="fas fa-angle-down rotate-icon"></i></span>
                                                                            </div>
                                                                            <input type="checkbox" id="category"
                                                                                name="category[]"
                                                                                class="checkItemsAll selected"
                                                                                value="{{ $categorie->id }}">
                                                                        </div>
                                                                        <div id="{{ preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '', $categorie->name_en)) }}"
                                                                            class="collapse"
                                                                            data-parent="#accordionExample">
                                                                            <div class="card-body ">
                                                                                <div class="items-container">
                                                                                    @forelse ($categorie->menuItems as $items)
                                                                                        <div class="col-md-12">
                                                                                            <div
                                                                                                class="d-flex align-items-center justify-content-start">
                                                                                                <div class="custom-check">
                                                                                                    <input type="checkbox"
                                                                                                        id="category"
                                                                                                        name="menu_items[]"
                                                                                                        class="ckbCheckAllItems"
                                                                                                        value="{{ $items->id }}"
                                                                                                        category-name-attr="{{ $categorie->name_en }}:{{ $items->item_name_en }}">
                                                                                                    <span></span>
                                                                                                </div>
                                                                                                <strong class="list-text">
                                                                                                    &nbsp;
                                                                                                    {{ $items->item_name_en }}</strong>
                                                                                            </div>
                                                                                        </div>
                                                                                    @empty
                                                                                        <p>No users</p>
                                                                                    @endforelse
                                                                                </div>
                                                                            </div>
                                                                            {{-- $categorie->menuItems --}}
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
                                                        <!-- <button type="button" class="btn btn-success"
                                                            data-dismiss="modal">Close</button> -->
                                                             <button type="button" class="btn btn-success" id="category_unselect_all">Close</button>
                                                        <button type="button" class="btn btn-danger"
                                                            id="category_save_countinue">Save and Continue</button>
                                                    </div>
                                                </div>

                                              
                                                <!--end container -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                         <!-- end branch modal -->
                         

                         <p class=" d-none select_notice p-2 border bg-danger" style="width:fit-content;">Branch and Category / Menu Item both are required</p>

                        <!-- /.card-body -->
                        <div class="card-footer" style="width:100%;"> <button type="submit" style="width:150px;"
                                class="button btn_bg_color common_btn text-white">Save</button></div>
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
                                                <div class="card-header " data-toggle="collapse"
                                                    data-target="#collapseOne" aria-expanded="true">
                                                    <span class="title">Select Branch</span>
                                                    <span class="accicon"><i
                                                            class="fas fa-angle-down rotate-icon"></i></span>
                                                </div>
                                                <div class="card-body branch_all_inputs_container">
                                                    <div class="all-content d-flex align-items-center">
                                                        <div class="custom-check">
                                                            <input type="checkbox" id="category" name="branch[]"
                                                                class="checkBranchAll">
                                                            <span></span>
                                                        </div>
                                                        <strong class="list-text"> &nbsp; All </strong>
                                                    </div>
                                                    <div class="branch-container">
                                                        @forelse ($branches as $branch)
                                                            <div class="d-flex align-items-center">
                                                                <div class="custom-check">
                                                                    <input type="checkbox" id="category"
                                                                        name="branches[]"
                                                                        class="ckbCheckAll branch_inputs"
                                                                        value="{{ $branch->id }}"
                                                                        branch-name-attr="{{ $branch->title_en }}">
                                                                    <span></span>
                                                                </div>
                                                                <strong class="list-text"> &nbsp;
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
                                <div class="card-footer pt-0 pb-4 " align="center">
                                    <div class="btn-group">
                                        <!-- <button type="button" class="btn btn-success"
                                            data-dismiss="modal">Close</button> -->
                                            <button type="button" class="btn btn-success"   id="branch_unselect_all">Close</button>
                                        <button type="button" class="btn btn-danger" id="branch_save_countinue">Save
                                            and Continue</button>
                                    </div>
                                </div>

                               

                            </div>
                        </div>
                        <!--end modal -->
                       
                    </div>
                </div>
            </div>
            <!--end modal -->


          
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>


@endsection

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">

    <style type="text/css">
        .card-header .accicon {
            float: right;
            font-size: 20px;
            width: 1.2em;
        }

        .card-header {
            cursor: pointer;
            border-bottom: none;
        }

        .card {
            border: 1px solid #ddd;
        }

        .card-header:not(.collapsed) .rotate-icon {
            transform: rotate(180deg);
        }
    </style>
@stop

@section('js')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $(document).ready(function() {


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



            $(".checkItemsAllcategory").change(function() {


                if ($(this).prop('checked')) {
                    $('.checkItemsAll').prop('checked', true);
                    $('.ckbCheckAllItems').prop('checked', true);
                } else {
                    $('.checkItemsAll').prop('checked', false);
                    $('.ckbCheckAllItems').prop('checked', false);
                }

            });

            //2nd logic For Select/Unselect all 

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

            // content
            //  CKEDITOR.replace( 'content_en', {
            //   customConfig : 'config.js',
            //   toolbar : 'simple',
            //   allowedContent: true
            // });

            //  CKEDITOR.replace('content_ar',{
            //   customConfig:'config.js',
            //   toolbar:'simple',
            //   allowedContent:true
            //  });{ dateFormat: 'dd/mm/yy',minDate: 0, }

            $(".dicount_date").datetimepicker({
                timepicker: true,
                formatTime: 'g:i A',
                format: 'd/m/Y g:i A',
                validateOnBlur: false,
                minDate: 0
            });

            $('#addOfferForm').validate({
                ignore: [],

                rules: {

                    discount_title: {
                        required: true
                    },
                    start_date: {
                        required: true
                    },
                    end_date: {
                        required: true
                    },

                    discount_description: {
                        required: true
                    },

                    discount_type: {
                        required: true
                    },
                    discount_amount: {
                        required: true
                    }

                },
                messages: {

                    discount_title: {
                        required: "Discount Name is required"
                    },
                    start_date: {
                        required: "Start Date/ Time is required"
                    },
                    end_date: {
                        required: "End Date/ Time is required"
                    },

                    discount_description: {
                        required: "Description is required"
                    },

                    discount_type: {
                        required: "Discount type is required"
                    },
                    discount_amount: {
                        required: " Percentage/Amount is required"
                    },

                },
                submitHandler: function(form) {


                    if ($('.ckbCheckAllItems').is(':checked') || $('.ckbCheckAll').is(':checked')) {

                        return true;
                    } else {

                        $('.select_notice').removeClass('d-none');

                        setTimeout(function() {
                            $('.select_notice').addClass('d-none');
                        }, 1800);
                        return false;
                    }



                }

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


            $('#category_save_countinue').on('click', function() {


                var category_all_inputs_container = $('.category_all_inputs_container')[0];

                var all_inputs = category_all_inputs_container.getElementsByTagName('INPUT');

                var category_sel_count = 0;
                var all_category_name = [];
                var maincategory = [];

                $(all_inputs).each(function() {

                    if ($(this).is(':checked')) {
                        category_sel_count++;
                        if ($(this).attr('category-name-attr') != undefined) {

                            if (jQuery.inArray($(this).attr('category-name-attr').split(":")[0],
                                    maincategory) != -1) {
                                all_category_name.push($(this).attr('category-name-attr'));
                            } else {
                                maincategory.push($(this).attr('category-name-attr').split(":")[0]);
                                all_category_name.push($(this).attr('category-name-attr'));
                            }
                        }
                    }
                });


                if (category_sel_count == 0) {
                    $('.select_branch_warning').removeClass('d-none');

                    setTimeout(function() {
                        $('.select_branch_warning').addClass('d-none');
                    }, 2000);
                    return false;
                } else {

                    $('#cat-modal').modal('hide');

                    $('#all_selected_categories_container').removeClass('d-none');

                    $('.show_all_selected_categories').html(' ');
                    var html_data = "";
                    $(maincategory).each(function(data, index2) {

                        html_data +=
                            '<div class="main_container"> <div class="card categories"><div class="position-relative"><div class="card-header alt collapsed" data-toggle="collapse" data-target="#' +
                            index2.replaceAll(" ", "").replaceAll("(", "").replaceAll(")", "")
                            .replaceAll(".", "").replaceAll("&", "") +
                            '" aria-expanded="false"><span class="title">' + index2 +
                            '</span><span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span></div></div><div id="' +
                            index2.replaceAll(" ", "").replaceAll("(", "").replaceAll(")", "")
                            .replaceAll(".", "").replaceAll("&", "") +
                            '" class="collapse" data-parent="#selectedaccordionExample" ><div class="card-body "><div class="items-container">';

                        html_data += '<ul>';
                        $(all_category_name).each(function(data, index) {

                            if (index.split(":")[0] == index2) {
                                // html_data+='<div class=""><div class="d-flex align-items-center justify-content-start"><strong class="list-text">'+index.split(":")[1]+'</strong></div></div>';

                                html_data += '<li><strong class="list-text">' + index.split(
                                    ":")[1] + '</strong></li>';
                            }

                        });

                        html_data += '</ul></div></div></div></div></div>';

                    });
                    $('.categories').removeClass('d-none');
                    $('.show_all_selected_categories').append(html_data)
                    $('.alt').addClass('collapsed');

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


        $(document).ready(function() {
            $('#categories-modal').click(function() {
                $('#cat-modal').modal({
                    'show': true,
                    backdrop: 'static',
                    keyboard: false
                });
            });

        });



        $(document).ready(function() {
            $('#branch-modal').click(function() {
                $('#branches-modal').modal({
                    'show': true,
                    backdrop: 'static',
                    keyboard: false
                });

            });


        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {

            $('.checkItemsAll').each(function() {
                $(this).click(function() {

                    var parentElement = this.parentElement.parentElement;
                    //console.log(parentElement);

                    //return false;

                    var secondDiv = parentElement.getElementsByClassName('items-container')[0];
                    var all_input = secondDiv.getElementsByTagName('INPUT');
                    // console.log(secondDiv);

                    if ($(this).is(':checked')) {
                        for (var i = 0; i < all_input.length; i++) {
                            $(all_input[i]).prop('checked', 'true');
                        }
                    } else {
                        for (var i = 0; i < all_input.length; i++) {
                            $(all_input[i]).prop('checked', false);
                        }

                    }

                });


            });


            $('.ckbCheckAllItems').each(function() {

                $(this).click(function() {
                    var count = 0;
                    var getParent = this.parentElement.parentElement.parentElement.parentElement;

                    var getParentInput = this.parentElement.parentElement.parentElement
                        .parentElement.parentElement.parentElement.parentElement ;
                        console.log(getParentInput);
                    var parentInput = getParentInput.getElementsByTagName('INPUT')[0];

                    var all_input = getParent.getElementsByTagName('INPUT');
                    // console.log(all_input.length);
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





        });



        $(document).ready(function() {
            $('.checkBranchAll').click(function() {
                var branches = $('.branch-container')[0];
                var all_branches_input = branches.getElementsByTagName('INPUT');
                // console.log(all_branches_input.length);
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






            //2nd logic

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
                        //  alert("false");
                        $(".checkBranchAll").prop('checked', false);
                    }

                });
            });

            // $('#category_unselect_all').click(function(e) {
            //     $("input[name='category[]']").prop('checked', false);
            //     $("input[name='menu_items[]']").prop('checked', false);

            // });


        })
    </script>

@stop
