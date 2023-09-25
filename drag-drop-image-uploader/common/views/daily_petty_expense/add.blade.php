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
                                            <a class="btn btn-sm btn_clr btn-success" href="{{ url()->previous() }}">Back</a>
                                        </div>
                                    </div>

                                    <form name="daily_petty_expense" id="daily_petty_expense" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="userid" name="userid">
                                        <div class="card-body main_body form p-3">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="category">Category <span class="text-danger">*</span></label>
                                                        <select name="category" class="category form-control" id="category">
                                                            <option value="0" disabled selected>Category</option>
                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="sub_category">Sub Category <span class="text-danger">*</span></label>
                                                        <select name="sub_category" class="sub_category form-control"
                                                            id="sub_category">
                                                            <option value="" disabled selected>Sub Category</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="doc_ref_no">Document Reference Number <span class="text-danger">*</span></label>
                                                        <input type="text" name="doc_ref_no" id="doc_ref_no" class="form-control"
                                                            placeholder="Document Reference Number">
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="amount">Amount <span class="text-danger">*</span></label>
                                                        <input type="number" step="0.01" name="amount" class="amount form-control"
                                                            placeholder="Amount" id="amount" maxlength="100"
                                                            aria-invalid="false">
                                                    </div>
                                                </div>
                                                {{-- <input type="file" id="doc_upload" name="doc_upload"> --}}

                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="remarks">Remarks</label>
                                                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks">
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
                                                        <small class="image_notice" style="color:#FF0A00;font-size:12px;"></small>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="button btn_bg_color common_btn text-white">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script type="text/javascript">
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

        Dropzone.autoDiscover = false;
        let token = $('meta[name="csrf-token"]').attr('content');

        // if (Dropzone.instances.length > 0)
        //     Dropzone.instances.forEach(dz => dz.destroy())

        // $('.dropzone-previews').empty();

        var dropzone = new Dropzone("div#dropzoneDragArea", {
            paramName: "file",
            url: "{{ route('daily_petty_expense_report.doc_image_save') }}",
            previewsContainer: 'div.dropzone-previews',
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 20,
            maxFilesize: 500,
            // maxFiles:1,
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

                this.on("uploadprogress", function(file, progress) {
                    console.log("File progress", progress);
                });
                //form submission code goes here
                $("form[name='daily_petty_expense']").submit(function(event) {
                    //Make sure that the form isn't actully being sent.

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // alert(count_disabled);

                    //Checking image upload or not

                    if ($(this).valid()) {

                        if ($('.dropzone-previews').html() != "") {

                        } else {
                            $('.image_notice').html('Please Upload at least one Doc Image');
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
                        url: "{{ route('daily_petty_expense_report.save') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {

                            if (data.status == "success") {
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
                    let userid = document.getElementById('userid').value;
                    formData.append('userid', userid);
                });

                this.on("success", function(file, response) {
                    console.log(response);

                    swal({
                            title: "Daily Petty Expense",
                            text: "Daily Petty Expense Added Successfully",
                            type: "success",
                        },
                        function() {
                            window.location.href = "{{ route('daily_petty_expense') }}"
                        }
                    );
                    $('#demoform')[0].reset();
                    //reset dropzone
                    $('.dropzone-previews').empty();

                });
                this.on("error", function(file, message) {
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
    </script>
@endpush
