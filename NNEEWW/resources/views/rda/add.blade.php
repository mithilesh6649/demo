@extends('adminlte::page')
@section('title', 'Add RDA')
@section('content_header')
@section('content')
<div class="container-fluid p-0">
   <div class="col-md-12">
      <div class="card order_outer rounded_circle">
         <div class="card-body rounded_circle table p-0 mb-0">
            <div class="order_details">
               <div class="card-main pt-3">
                  <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                     <h3 class="mb-0">Add RDA</h3>
                     <a class="btn btn-sm btn-success add-advance-options"
                     href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                 </div>
                 <div class="card-body main_body form p-3">
                     @if (session('status'))
                     <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form id="addSpecializationForm" method="post" action="{{ route('rda_value_save') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                       @if ($errors->any())
                       <div class="alert alert-warning">
                          <ul>
                             @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                             @endforeach
                         </ul>
                     </div>
                     @endif
                     <div class="information_fields mb-0">
                      <div class="row">
                         <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                            <div class="form-group ">
                               <label for="status">RDA Group<span class="text-danger">
                               *</span></label>
                               <select class="form-control" id="select" name="category">
                                  <option value="">Select RDA Group</option>
                                  @foreach ($rdaGroupCategories as $all_active_traits_category)
                                  <option value="{{ $all_active_traits_category->value }}">{{ $all_active_traits_category->name }}
                                  </option>
                                  @endforeach
                              </select>
                              <label id="show_custom_label"></label>
                          </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-xl-6 col-6 mb-3 ">
                        <div class="form-group ">
                           <label for="status">RDA Particulars<span class="text-danger">
                           *</span></label>
                           <select class="form-control" id="select" name="particulars">
                              <option value="">Select RDA  Particulars</option>
                              @foreach ($rdaParticularsValues as $all_active_traits_category)
                              <option value="{{ $all_active_traits_category->value }}">{{ $all_active_traits_category->name }}
                              </option>
                              @endforeach
                          </select>
                          <label id="show_custom_label"></label>
                      </div>
                  </div>
                  <div class="col-md-12 font-weight-bold">
                     Enter RDA Values
                     <hr>
                 </div>

                 <div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
                    <div class="form-group"> <label>Energy EAR<span class="text-danger">
                    *</span></label>
                    <input type="number" name="energy_ear" class="form-control"
                    id="energy_ear" maxlength="100">
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
                <div class="form-group"> <label>Protein EAR<span class="text-danger">
                *</span></label>
                <input type="number" name="protein_ear" class="form-control"
                id="protein_ear" maxlength="100">
            </div>
        </div>


        <div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
            <div class="form-group"> <label>Protein RDA<span class="text-danger">
            *</span></label>
            <input type="number" name="protein_rda" class="form-control"
            id="protein_rda" maxlength="100">
        </div>
    </div>

    <div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
        <div class="form-group"> <label>Dietary Fibre<span class="text-danger">
        *</span></label>
        <input type="number" name="dietary_fibre" class="form-control"
        id="dietary_fibre" maxlength="100">
    </div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Calcium EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="calcium_ear" class="form-control"
    id="calcium_ear" maxlength="100">
</div>
</div>


<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Calcium RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="calcium_rda" class="form-control"
    id="calcium_rda" maxlength="100">
</div>
</div>


<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Calcium TUL<span class="text-danger">
    *</span></label>
    <input type="number" name="calcium_tul" class="form-control"
    id="calcium_tul" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Magnesium EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="magnesium_ear" class="form-control"
    id="magnesium_ear" maxlength="100">
</div>
</div>


<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Magnesium RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="magnesium_rda" class="form-control"
    id="magnesium_rda" maxlength="100">
</div>
</div>


<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Magnesium TUL<span class="text-danger">
    *</span></label>
    <input type="number" name="magnesium_tul" class="form-control"
    id="magnesium_tul" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Iron EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="iron_ear" class="form-control"
    id="iron_ear" maxlength="100">
</div>
</div>


<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Iron RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="iron_rda" class="form-control"
    id="iron_rda" maxlength="100">
</div>
</div>


<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Iron TUL<span class="text-danger">
    *</span></label>
    <input type="number" name="iron_tul" class="form-control"
    id="iron_tul" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Zinc EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="zinc_ear" class="form-control"
    id="zinc_ear" maxlength="100">
</div>
</div>

 

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Zinc RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="zinc_rda" class="form-control"
    id="zinc_rda" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Zinc TUL<span class="text-danger">
    *</span></label>
    <input type="number" name="zinc_tul" class="form-control"
    id="zinc_tul" maxlength="100">
</div>
</div>


<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Iodine EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="iodine_ear" class="form-control"
    id="iodine_ear" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Iodine RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="iodine_rda" class="form-control"
    id="iodine_rda" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Iodine TUL<span class="text-danger">
    *</span></label>
    <input type="number" name="iodine_tul" class="form-control"
    id="iodine_tul" maxlength="100">
</div>
</div>


<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Thiamine EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="thiamine_ear" class="form-control"
    id="thiamine_ear" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Thiamine RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="thiamine_rda" class="form-control"
    id="thiamine_rda" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Riboflavin EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="riboflavin_ear" class="form-control"
    id="riboflavin_ear" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Riboflavin RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="riboflavin_rda" class="form-control"
    id="riboflavin_rda" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Niacin EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="niacin_ear" class="form-control"
    id="niacin_ear" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Niacin RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="niacin_rda" class="form-control"
    id="niacin_rda" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Niacin TUL<span class="text-danger">
    *</span></label>
    <input type="number" name="niacin_tul" class="form-control"
    id="niacin_tul" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin b6 EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_b_6_ear" class="form-control"
    id="vitamin_b_6_ear" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin b6 RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_b_6_rda" class="form-control"
    id="vitamin_b_6_rda" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin b6 TUL<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_b_6_tul" class="form-control"
    id="vitamin_b_6_tul" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Folate EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="folate_ear" class="form-control"
    id="folate_ear" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Folate RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="folate_rda" class="form-control"
    id="folate_rda" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Folate TUL<span class="text-danger">
    *</span></label>
    <input type="number" name="folate_tul" class="form-control"
    id="folate_tul" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin b12 EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_b_12_ear" class="form-control"
    id="vitamin_b_12_ear" maxlength="100">
</div>
</div>



<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin b12 RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_b_12_rda" class="form-control"
    id="vitamin_b_12_rda" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin c EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_c_ear" class="form-control"
    id="vitamin_c_ear" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin c RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_c_rda" class="form-control"
    id="vitamin_c_rda" maxlength="100">
</div>
</div>




<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin c TUL<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_c_tul" class="form-control"
    id="vitamin_c_tul" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin a EAR<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_a_ear" class="form-control"
    id="vitamin_a_ear" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin a RDA<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_a_rda" class="form-control"
    id="vitamin_a_rda" maxlength="100">
</div>
</div>




<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin a tul<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_a_tul" class="form-control"
    id="vitamin_a_tul" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin d ear<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_d_ear" class="form-control"
    id="vitamin_d_ear" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin d rda<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_d_rda" class="form-control"
    id="vitamin_d_rda" maxlength="100">
</div>
</div>




<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>Vitamin d tul<span class="text-danger">
    *</span></label>
    <input type="number" name="vitamin_d_tul" class="form-control"
    id="vitamin_d_tul" maxlength="100">
</div>
</div>

<div class="col-md-4 col-lg-4 col-xl-4 col-4 mb-3">
    <div class="form-group"> <label>selenuim<span class="text-danger">
    *</span></label>
    <input type="number" name="selenuim" class="form-control"
    id="selenuim" maxlength="100">
</div>
</div>








                                 <!--       <div class="col-md-12 col-lg-12 col-xl-12 col-12 mb-3 ">
                                    <div class="form-group ">
                                        <label for="status">Status<span class="text-danger">
                                                *</span></label>
                                        <select class="form-control" id="select" name="status">
                                    
                                    
                                            @foreach ($status as $statu)
                                                <option value="{{ $statu->value }}">{{ $statu->name }}
                                                </option>
                                            @endforeach
                                    
                                        </select>
                                    </div>
                                    </div>
                                -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                       <button type="text"
                       class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.save') }}</button>
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
<link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@stop
@section('js')
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<!-- <script src="{{ asset('docsupport/jquery-3.2.1.min.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.5/emojionearea.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
<script>
   $(document).ready(function() {

    $('select[name ="trait_category_id"]').select2(); 

    $('#addSpecializationForm').validate({
       ignore: [],

       rules: {
           trait_category_id:{
               required: true
           },
           title:{
               required: true
           },

       },
       messages: {
           trait_category_id: {
               required: "Trait category is required"
           },
           title: {
               required: "Title is required"
           },

       },
       errorPlacement: function(error, element) {
           if(element.attr("name") == "trait_category_id") {

               error.appendTo($('#show_custom_label'));
           } else {
               error.insertAfter(element);
           }
       }, 


   });

});
</script>
@stop