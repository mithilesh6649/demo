@extends('adminlte::page') @section('title', 'Add Food') @section('content_header') @section('content')

<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card order_outer rounded_circle">
            <div class="card-body rounded_circle table p-0 mb-0">
                <div class="order_details">
                    <div class="card-main pt-3">
                        <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0">Add Food From Edamam</h3>
                            <a class="btn btn-sm btn-success add-advance-options" href="{{ route('food.list') }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body main_body form p-3">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="search" name="" class="form-control" id="search_food" placeholder="Search foods" />
                                        </div>

                                        <div class="result" id="edamam_food_list" style="height: 70vh; overflow-y: auto;">
                                        <!--<ul style="list-style: none;padding: 0;">
                                                <li class="p-3 border-bottom">
                                                <div class="d-flex align-items-center">
                                                    <div class="pl-3">
                                                        <img width="50" src="https://www.edamam.com/food-img/99d/99d766d1734a6f8e7ee99d942b085594.jpg">
                                                    </div>
                                                    
                                                    <div class="px-1 item_wrap">
                                                        <div class="d-flex flex-column">
                                                            <input  type="number" id="serving_size" class="serving_size" name="" value="1" placeholder="Size">
                                                            <select id="serving_type" class="serving_type">
                                                                <option>Serving Type</option>
                                                                <option>Cup</option>
                                                                <option>Stick</option>
                                                                <option>Ounce</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <p class="font-weight-bold mb-1">Chicken <span>( 300 kcal )</span></p>
                                                        <small class="border p-1">Protein  : 1234</small>
                                                        <small class="border p-1">Fat : 1234</small> 
                                                        <small class="border p-1">Carbohydrate : 1234</small> 
                                                        <small class="border p-1">Fiber : 1234</small>       
                                                    </div>


                                                    <div class="px-2">
                                                        <button class="btn btn-primary food_add">Add</button>
                                                    </div>
                                                </div>
                                                </li>
                                            </ul>-->
                                        </div>
                                        <span id="edamam_food_list_msg"></span>
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
@endsection @section('css')
<link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

@stop @section('js')
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<!-- <script src="{{ asset('docsupport/jquery-3.2.1.min.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
<script>
    $(document).ready(function () {
        const container = document.getElementById("edamam_food_list");
        let nextPageUrl = "";
        container.addEventListener("scroll", function () {
            if (container.scrollTop + container.clientHeight >= container.scrollHeight) {
                // User has scrolled to the bottom of the container
                // Make AJAX call here to fetch more content
                console.log("next page url", nextPageUrl);
                $.ajax({
                    type: "POST",
                    url: "{{route('get.edamam.food')}}",
                    data: {
                        next_page_url: nextPageUrl,
                    },
                    dataType: "JSON",
                    beforeSend: function () {
                        $("#edamam_food_list_msg").html("Loading...");
                    },
                    success: function (response) {
                        console.log(response);
                        $("#edamam_food_list_msg").html("");
                        $("#edamam_food_list").append(response.html);
                        nextPageUrl = response.next_page_url;
                        console.log("next page url lla", nextPageUrl);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    },
                });
            }
        });

        $("#search_food").on("input", function () {
            var value = $(this).val();
            if (value.length == 0) {
                $("#edamam_food_list").html("");
            }
        });

        $("#search_food").keypress(function (event) {
            if (event.keyCode === 13) {
                event.preventDefault(); // prevent default behavior of "Enter" key
                var inputValue = $(this).val(); // get the input value
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('get.edamam.food')}}",
                    data: {
                        ingr: inputValue,
                    },
                    dataType: "JSON",
                    beforeSend: function () {
                        $("#edamam_food_list").html("Loading...");
                    },
                    success: function (response) {
                        console.log(response);
                        nextPageUrl = response.next_page_url;

                        $("#edamam_food_list").html(response.html);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    },
                });
            }
        });
    });

    $(document).on("click", ".food_add", function () {
        var servingContainer = $(this).parent().parent();
        var servingSize = $(servingContainer).find("#serving_size").val();
        var servingType = $(servingContainer).find("#serving_type").val();
        console.log(servingContainer, servingSize, servingType);

        if (servingSize == "" || servingType == "") {
            toastr.error("Serving size & type are required");
            return false;
        }

        var currentObj = this;

        var getFoodId = $(this).attr("food-id");
        var getFoodImage = $(this).attr("food-image");
        // alert(getFoodId);
        $.ajax({
            type: "POST",
            url: "{{route('add.edamam.food.by.id')}}",
            data: {
                food_id: getFoodId,
                food_image: getFoodImage,
                servingSize: servingSize,
                servingType: servingType,
            },
            dataType: "JSON",
            beforeSend: function () {
                $(currentObj).html("Processing...");
            },
            success: function (response) {
                console.log(response);
                toastr.success("Food added Successfully");
                $(currentObj).attr("disabled", true);
                $(currentObj).removeClass("btn-primary");
                $(currentObj).addClass("btn-success");
                $(currentObj).html("Added");
                // $('#edamam_food_list').html(response.html);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });
</script>

<script type="text/javascript">
    $(document).on("change", ".serving_type", function () {
        var servingContainer = $(this).parent().parent();
        var servingSize = $(servingContainer).find("#serving_size").val();
        var servingType = $(servingContainer).find("#serving_type").val();
        var foodId = $(servingContainer).find("#food_id").val();
        if (servingSize == "") {
            servingSize = $(servingContainer).find("#serving_size").val(1);
        }

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "{{route('get.measure.nutrition')}}",
            type: "post",
            data: {
                foodId: foodId,
                quantity: servingSize,
                measureURI: servingType,
            },
            success: function (response) {
                console.log(response);
                $(servingContainer)
                    .parent()
                    .find(".measure_calories")
                    .html("(" + response.calorie + " kcal )");
                $(servingContainer)
                    .parent()
                    .find(".measure_protein")
                    .html("Protein: " + response.protein);
                $(servingContainer)
                    .parent()
                    .find(".measure_fat")
                    .html("Fat: " + response.fat);
                $(servingContainer)
                    .parent()
                    .find(".measure_chocdf")
                    .html("Carbohydrate: " + response.carbohydrate);
                $(servingContainer)
                    .parent()
                    .find(".measure_fiber")
                    .html("Fiber: " + response.fiber);
            },
            error: function (err) {
                console.log("err", err);
                toastr.error(err);
            },
        });
    });
</script>

<script type="text/javascript">
    $(document).on("input", ".serving_size", function () {
        var servingContainer = $(this).parent().parent();
        var servingSize = $(servingContainer).find("#serving_size").val();
        var servingType = $(servingContainer).find("#serving_type").val();
        var foodId = $(servingContainer).find("#food_id").val();
        if (servingType != "") {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                url: "{{route('get.measure.nutrition')}}",
                type: "post",
                data: {
                    foodId: foodId,
                    quantity: servingSize,
                    measureURI: servingType,
                },
                success: function (response) {
                    console.log(response);
                    $(servingContainer)
                        .parent()
                        .find(".measure_calories")
                        .html("(" + response.calorie + " kcal )");
                    $(servingContainer)
                        .parent()
                        .find(".measure_protein")
                        .html("Protein: " + response.protein);
                    $(servingContainer)
                        .parent()
                        .find(".measure_fat")
                        .html("Fat: " + response.fat);
                    $(servingContainer)
                        .parent()
                        .find(".measure_chocdf")
                        .html("Carbohydrate: " + response.carbohydrate);
                    $(servingContainer)
                        .parent()
                        .find(".measure_fiber")
                        .html("Fiber: " + response.fiber);
                },
                error: function (err) {
                    console.log("err", err);
                    toastr.error(err);
                },
            });
        }
    });
</script>

@stop
