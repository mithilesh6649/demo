<form id="addAppointmentForm" 
enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="{{ @$data->id }}">
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

            <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group"> <label for="reason_for_appointment">
                    Appoinment Title<span class="text-danger"> *</span></label>
                    <input type="text" name="reason_for_appointment"
                    class="form-control reason_for_appointment"
                    id="reason_for_appointment" maxlength="100"
                    autocomplete="off" value={{@$data->reason_for_appointment}}> </div>
                </div>



                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                        <label>Select User <span class="text-danger">*</span></label>
                        <select class="form-control UserSelect" id="select" name="user_id">
                            <option value="{{ $data->Appointment->user_id }}" selected="selected">
                                {{ @$data->Appointment->User->name }}</option>

                            </select>
                            <label id="user_cutom_error"></label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                            <label>Select Nutritionists<span class="text-danger">*</span></label>
                            <select class="form-control NutritionistSelect" id="select" name="nutritionist_id">
                                <option value="">Select Nutritionist</option>

                                @forelse ($NutritionistList as $Nutritionist)
                                <option
                                {{ $data->Appointment->invitee_id == $Nutritionist->id ? 'selected' : '' }}
                                value="{{ $Nutritionist->id }}">
                                {{ $Nutritionist->name }}</option>
                                @empty
                                <option disabled>No results found </option>
                                @endforelse

                            </select>
                            <label id="nutritionist_cutom_error"></label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group"> <label for="appoinment_date">Appointment Date<span class="text-danger">
                        *</span></label> <input type="text" name="appoinment_date"
                        class="form-control appoinment_date" id="appoinment_date" maxlength="100" autocomplete="off"
                        value="{{ date('d/m/Y', strtotime(@$data->appointment_time)) }}"></div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group"> <label for="appoinment_start_time"> Appointment Start Time<span
                            class="text-danger"> *</span></label> <input type="text" name="appoinment_start_time"
                            class="form-control appoinment_start_time" id="appoinment_start_time" maxlength="100"
                            autocomplete="off" value=" {{ $data->appointment_start_time }}"> </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group"> <label for="appoinment_end_time">Appointment End Time<span
                                class="text-danger"> *</span></label> <input type="text" name="appoinment_end_time"
                                class="form-control appoinment_end_time" id="appoinment_end_time" maxlength="100"
                                autocomplete="off" value="{{ $data->appointment_end_time  }}"> </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="error-msg-app">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="text"
                    class="button btn_bg_color common_btn text-white">{{ __('adminlte::adminlte.save') }}</button>
                </div>
            </form>
