@extends('layouts.main')

@section('title', 'Branch | Daily Petty Expense Reports')

@section('content')

    <div class="rightside_content">
        <div class="container-fluid p-0">
            <div class="alert d-none" role="alert" id="flash-message">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card order_outer rounded_circle">
                        <div class="card-body rounded_circle table p-0 mb-0">

                            <div class="order_details">
                                <div class="card-main pt-3">
                                    <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                        <h3 class="mb-0">Daily Petty Expense Reports</h3>
                                        <div class="search_wrap position-relative">
                                            <a class="btn btn-sm btn_clr btn-success"
                                                href="{{ url()->previous() }}">Back</a>
                                        </div>
                                    </div>

                                    <form name="daily_petty_expense" id="daily_petty_expense" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="daily_petty_expense_id" name="daily_petty_expense_id"
                                            value="{{ $daily_petty_expense->id }}">
                                        <div class="card-body main_body form p-3">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="category">Category <span
                                                                class="text-danger">*</span></label>
                                                        <select name="category" class="category form-control"
                                                            id="category">
                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->id }}"
                                                                    @if ($daily_petty_expense->category_id == $cat->id) selected @endif>
                                                                    {{ $cat->cat_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="sub_category">Sub Category <span
                                                                class="text-danger">*</span></label>
                                                        <select name="sub_category" class="sub_category form-control"
                                                            id="sub_category">
                                                            <option value="{{ $daily_petty_expense->sub_category->id }}"
                                                                selected>
                                                                {{ $daily_petty_expense->sub_category->sub_cat_name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="doc_ref_no">Document Reference Number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="doc_ref_no" id="doc_ref_no"
                                                            class="form-control" placeholder="Document Reference Number"
                                                            value="{{ $daily_petty_expense->doc_ref_no }}">
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="amount">Amount <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" step="0.01" name="amount"
                                                            class="amount form-control" placeholder="Amount" id="amount"
                                                            maxlength="100" aria-invalid="false"
                                                            value="{{ $daily_petty_expense->amount }}">
                                                    </div>
                                                </div>
                                                {{-- <input type="file" id="doc_upload" name="doc_upload"> --}}

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="remarks">Remarks</label>
                                                        <input type="text" class="form-control" id="remarks"
                                                            name="remarks" placeholder="Remarks"
                                                            value="{{ $daily_petty_expense->remarks }}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12 mb-3">
                                                    <div class="form-group mt-0">
                                                        <label>Doc Image <span class="text-danger">*</span></label>
                                                        <div id="dropzoneDragArea"
                                                            class="dz-default dz-message dropzoneDragArea mb-0">
                                                            <span class="customsvg">Upload Doc Images</span>
                                                        </div>
                                                        <div class="dropzone-previews"></div>
                                                        <small class="image_notice"
                                                            style="color:#FF0A00;font-size:12px;"></small>
                                                    </div>
                                                </div>

                                                <div class="card-footer">
                                                    <button
                                                        class="button btn_bg_color common_btn text-white">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Document Image
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">
                                                        ×
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="modal-body" class="image_preview">
                                                <div class="w3-content w3-display-container"
                                                    style='height:400px;width:100%;'>
                                                    <button class="w3-button w3-black w3-display-left"
                                                        onclick="plusDivs(-1)">&#10094;</button>
                                                    <button class="w3-button w3-black w3-display-right"
                                                        onclick="plusDivs(1)">&#10095;</button>
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
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .mySlides {
            display: none;
        }

        .dropzoneDragArea {
            background-color: #fbfdff;
            border: 1px dashed #c0ccda;
            border-radius: 6px;
            padding: 60px;
            text-align: center;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .dropzone {
            box-shadow: 0px 2px 20px 0px #f2f2f2;
            border-radius: 10px;
        }

        .dz-image img {
            width: 85%;
            border-radius: 14px;
            margin-bottom: 5px;
            margin-top: 5px;
        }

        body .dz-preview {
            text-align: left !important;
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

        .dz-image-preview {
            width: 15% !important;
            float: left;
            text-align: center !important;
            text-transform: capitalize;
        }

        .select-status {
            height: 30px !important;
            width: 120px !important;
            border-radius: 0px !important;
            position: relative;
            bottom: 3px;
        }

        .btn-danger {
            height: 26px;
            width: 87%;
            margin: 0px auto;
            line-height: 15px;
            position: relative;
            top: 3px;
        }

        .dz-success-mark,
        .dz-error-mark {
            display: none;
        }

        .dz-preview {
            margin-top: 20px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            imagetotal();

            $(document).on('click', '.dz-image', function() {

                var src = "{{ asset('branch_images') }}" + '/' + $(this).children("img").attr('alt');

                $(".w3-display-container img").each(function() {
                    if ($(this).attr('src') == src) {
                        $(this).css('display', 'block');
                    } else {
                        $(this).css('display', 'none');
                    }
                });


                $('#exampleModal').modal('show');
                //$('.image_previeww').attr('src',src);

            });
        });

        $('.close').click(function(e) {
            $('#exampleModal').modal('hide');
        });


        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex - 1].style.display = "block";
        }


        function imagetotal() {
            var daily_petty_expense_id = '{{ $daily_petty_expense->id }}';

            $.ajax({
                url: "{{ route('docimage.update.data') }}",
                method: "GET",
                data: {
                    id: daily_petty_expense_id
                },
                dataType: "JSON",
                success: function(response) {
                    imageslide(response.data);

                }

            });
        }

        function imageslide(imagesld) {
            var src = "{{ asset('branch_images') }}";
            var html = "";

            $.each(imagesld, function(key, val) {

                $.each(imagesld[key], function(key, val) {
                    if (key == 'doc') {

                        html += "<img class='mySlides' src='" + src + "/" + val +
                            "' style='width:100%;height:400px;' />";


                    }
                });


            });
            var button =
                '<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button><button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>';
            $('.w3-display-container').empty();
            $('.w3-display-container').append(button);
            $('.w3-display-container').append(html);

        }
    </script>

    <script>
        function elementr(id) {
            var document_image_id = $('.removei' + id).data('deltype');
            var daily_petty_expense_id = '{{ $daily_petty_expense->id }}';
            var maxFile = 20;

            if ($('.dz-complete').length == 1) {
                swal({
                    title: "Doc Image",
                    text: "One Doc Image is required",
                    type: "info",
                });
                return false;
            } else {
                $.ajax({
                    url: "{{ route('document_image.delete') }}",
                    method: "POST",
                    data: {
                        document_image_id: document_image_id,
                        daily_petty_expense_id: daily_petty_expense_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "JSON",

                    success: function(response) {

                        if (response.status == 'success') {

                            previewImageDisplay(response.data, maxFile);
                            imageslide(response.data);

                        }
                    }

                });
            }

        }


        // Dropzone has been added as a global variable.
        Dropzone.autoDiscover = false;
        let token = $('meta[name="csrf-token"]').attr('content');

        function previewImageDisplay(asllimage, maxFile) {
            $('.dropzone-previews').empty();

            if (Dropzone.instances.length > 0)
                Dropzone.instances.forEach(dz => dz.destroy())


            var dropzone = new Dropzone("div#dropzoneDragArea", {
                paramName: "file",
                url: "{{ route('document_image.update.images') }}",
                previewsContainer: 'div.dropzone-previews',
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 20,
                maxFilesize: 500,
                maxFiles: maxFile,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },

                // addRemoveLinks: true,
                acceptedFiles: ".jpeg,.jpg,.png",
                params: {
                    _token: token
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;
                    //form submission code goes here
                    this.on("uploadprogress", function(file, progress) {
                        console.log("File progress", progress);
                    });

                    var id = '';
                    var petty_expense_id = '';
                    var js_lang = asllimage;

                    js_lang.forEach(obj => {

                        Object.entries(obj).forEach(([key, value]) => {

                            if (`${key}` === `doc`) {
                                let key = {
                                    name: `${value}`,
                                    size: 12345
                                };
                                myDropzone.displayExistingFile(key,
                                    "{{ asset('branch_images') }}/" + `${value}`);


                                var del = "<button type='button' data-delid='" + id +
                                    "' onclick='elementr(" + id +
                                    ")' class='btn btn-danger removei" + id +
                                    "' data-deltype='" + id + "' >Delete</button>"
                                $('.dz-remove').last().attr('remove-id', id);

                                $('.dz-remove').last().addClass('remove-image');
                                $('.dz-remove').empty();
                                $('.dz-details').last().append(del);
                            }

                            if (`${key}` === `id`) {
                                id = value;
                            }

                            if (`${key}` === `daily_petty_expense_id`) {
                                petty_expense_id = value;

                            }


                            $('.dz-remove').last().attr('remove-id', id);

                            $('.dz-remove').last().addClass('remove-image');


                        });

                        $(".dz-preview").last().slideToggle().slideToggle(); //fadeIn("slow");
                    });


                    $('.dz-success-mark,.dz-error-mark,.dz-size,.dz-filename').empty();


                    $("form[name='daily_petty_expense']").submit(function(event) {
                        //Make sure that the form isn't actully being sent.
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });


                        //Checking image upload or not

                        if ($(this).valid()) {

                            if ($('.dropzone-previews').html() != "") {

                            } else {
                                $('.image_notice').html('Please Upload at least one image');
                                setTimeout(function() {
                                    $('.image_notice').html('');
                                }, 1500);
                                return false;
                            }
                        } else {
                            return false;
                        }


                        event.preventDefault();

                        var formData = new FormData(this);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('daily_petty_expense_report.update') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                if (data.status == "success") {

                                    if (myDropzone.files.length == 0) {
                                        swal({
                                                title: "Daily Petty Expense",
                                                text: "Daily Petty Expense Updated Successfully",
                                                type: "success",
                                            },
                                            function() {
                                                window.location.href =
                                                    "{{ route('daily_petty_expense') }}"
                                            });
                                    }

                                    myDropzone.processQueue();
                                    $('.image_notice').html('');

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
                        let daily_petty_expense_id = document.getElementById('daily_petty_expense_id')
                            .value;
                        formData.append('daily_petty_expense_id', daily_petty_expense_id);
                    });

                    this.on("success", function(file, response) {

                        swal({
                                title: "Daily Petty Expense",
                                text: "Daily Petty Expense Updated Successfully",
                                type: "success",
                            },
                            function() {
                                window.location.href = "{{ route('daily_petty_expense') }}"
                            }
                        )

                        $('#daily_petty_expense')[0].reset();

                        $('.dropzone-previews').empty();
                        localStorage.setItem('success_data', 'Doc Image has been added successfully!');

                    });


                    this.on("error", function(file, message) {
                        //alert(message);
                        console.log(file);

                        var messages = myDropzone.removeFile(file);

                        if (message != "Upload canceled.")
                            swal({
                                title: "Error",
                                text: message,
                                type: "warning",
                                showCancelButton: true,
                            });

                    });
                }
            });
        }

        $(function() {
            $('.dropzone-previews').empty();

            var dropzone = new Dropzone("div#dropzoneDragArea", {
                paramName: "file",
                url: "{{ route('document_image.update.images') }}",
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

                // addRemoveLinks: true,
                acceptedFiles: ".jpeg,.jpg,.png",
                params: {
                    _token: token
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;
                    //form submission code goes here
                    this.on("uploadprogress", function(file, progress) {
                        console.log("File progress", progress);
                    });

                    var id = '';
                    var daily_petty_expense_id = '';
                    var js_lang = {!! json_encode($branch_images) !!};

                    js_lang.forEach(obj => {

                        Object.entries(obj).forEach(([key, value]) => {

                            if (`${key}` === `doc`) {
                                let key = {
                                    name: `${value}`,
                                    size: 12345
                                };
                                myDropzone.displayExistingFile(key,
                                    "{{ asset('branch_images') }}/" + `${value}`);

                                var del = "<button type='button' data-delid='" + id +
                                    "' onclick='elementr(" + id +
                                    ")' class='btn btn-danger removei" + id +
                                    "' data-deltype='" + id + "' >Delete</button>"
                                $('.dz-remove').last().attr('remove-id', id);

                                $('.dz-remove').last().addClass('remove-image');
                                $('.dz-remove').empty();
                                $('.dz-details').last().append(del);
                            }

                            if (`${key}` === `id`) {
                                id = value;
                            }

                            if (`${key}` === `daily_petty_expense_id`) {
                                daily_petty_expense_id = value;

                            }


                            $('.dz-remove').last().attr('remove-id', id);

                            $('.dz-remove').last().addClass('remove-image');


                        });

                        $(".dz-preview").last().slideToggle().slideToggle(); //fadeIn("slow");
                    });


                    $('.dz-success-mark,.dz-error-mark,.dz-size,.dz-filename').empty();


                    $("form[name='daily_petty_expense']").submit(function(event) {
                        //Make sure that the form isn't actully being sent.
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            }
                        });


                        //Checking image upload or not

                        if ($(this).valid()) {

                            if ($('.dropzone-previews').html() != "") {

                            } else {
                                $('.image_notice').html('Please Upload at least one image');
                                setTimeout(function() {
                                    $('.image_notice').html('');
                                }, 1500);
                                return false;
                            }
                        } else {
                            return false;
                        }


                        event.preventDefault();

                        var formData = new FormData(this);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('daily_petty_expense_report.update') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                if (data.status == "success") {

                                    if (myDropzone.files.length == 0) {
                                        swal({
                                                title: "Daily Petty Expense",
                                                text: "Daily Petty Expense Updated Successfully",
                                                type: "success",
                                            },
                                            function() {
                                                window.location.href =
                                                    "{{ route('daily_petty_expense') }}"
                                            });
                                    }

                                    myDropzone.processQueue();
                                    $('.image_notice').html('');

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
                        let daily_petty_expense_id = document.getElementById(
                            'daily_petty_expense_id').value;
                        formData.append('daily_petty_expense_id', daily_petty_expense_id);
                    });

                    this.on("success", function(file, response) {

                        swal({
                                title: "Daily Petty Expense",
                                text: "Daily Petty Expense Updated Successfully",
                                type: "success",
                            },
                            function() {
                                window.location.href = "{{ route('daily_petty_expense') }}"
                            }
                        )

                        $('#daily_petty_expense')[0].reset();

                        $('.dropzone-previews').empty();
                        localStorage.setItem('success_data',
                            'Doc Image has been added successfully!');

                    });


                    this.on("error", function(file, message) {
                        //alert(message);
                        console.log(file);

                        var messages = myDropzone.removeFile(file);

                        if (message != "Upload canceled.")
                            swal({
                                title: "Error",
                                text: message,
                                type: "warning",
                                showCancelButton: true,
                            });

                    });
                }
            });
        });
    </script>
    <script>
        $(document).on('change', '#category', function() {

            $.ajax({
                type: "POST",
                url: "{{ route('sub_category') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    cat_id: $(this).val()
                },
                success: function(response) {

                    var html = '';
                    if (response.sub_categories) {

                        $.each(response.sub_categories, function(ind, val) {
                            html = html + '<option value="' + val.id + '">' + val.sub_cat_name +
                                '</option>';
                        });

                        // html += '<option value="0" disabled>Sub Category</option>';
                        $('#sub_category').html(html);

                    } else {

                    }
                }
            });
        });

        $('#daily_petty_expense').validate({
            rules: {
                category: {
                    required: true,
                },
                sub_category: {
                    required: true
                },
                doc_ref_no: {
                    required: true
                },
                amount: {
                    required: true
                }

            },
            messages: {
                category: {
                    required: 'Please Select Category'
                },
                sub_category: {
                    required: 'Please Select Sub Category'
                },
                doc_ref_no: {
                    required: 'Document Reference Number required'
                },
                amount: {
                    required: 'Amount required'
                }
            }
        });
    </script>
@endpush
