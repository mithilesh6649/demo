{{-- <div class="advance_filter text-right mb-3 ">
    <div class="advance-options" style="">

        <div class="left_option">
            <div class="left_inner">
                <h6>Select Months</h6>
                <div class="button_input_wrap">
                    <div class="date_range_wrapper wrap-align-input ">



                        <select id="selected_year" class="form-control col-12">

                            @for ($i = 2023; $i <= date('Y'); $i++)
                                <option value="{{ $i }}" @if ($i == date('Y')) selected @endif>
                                    {{ $i }}</option>
                            @endfor
                        </select>

                        <select id="selected_month" class="form-control col-12" style="width: 300px;">
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ (int) date('m', mktime(0, 0, 0, $m)) }}"
                                    @if (date('m') == date('m', mktime(0, 0, 0, $m))) selected @endif>
                                    {{ date('F', mktime(0, 0, 0, $m)) }}</option>
                            @endfor

                        </select>




                    </div>

                    <div class="apply_reset_btn">
                        <button class="apply apply-filter mr-1"
                            style="background-color: red !important;border: none;border-radius:4px;"><i
                                class="fas fa-paper-plane mr-2"></i>Apply</button>
                        <button class="btn btn-primary reset-button mr-1 " id="reset_filter_btn"
                            style="background-color:#000000;border: none;color: #ffffff;"><i
                                class="fas fa-sync-alt mr-2" style="color: #ffffff;"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="table-responsive">
<table style="width:100%" id="water-tracker-list" class="table table-bordered table-hover yajra-datatable">
    <thead>
        <tr>
            <th>Date</th>
            <th>Blood Pressure</th>
            <th>Fasting Blood Sugar</th>
            <th>Random Blood Sugar</th>
            <th>HBA1C</th>
            <th>Cholesterol</th>
            <th>HDL</th>
            <th>LDL</th>
            <th>Triglycerides</th>
            <th>Serum creatinine</th>
            <th>Haemoglobin</th>
            <th>Albumin</th>
            <th>Calcium</th>
            <th>Phosphorous</th>




        </tr>
    </thead>
    <tbody>
        @forelse($User->userDietAndTestLog as $key => $data)
       
            <tr>
               
                <td>{{ date('m/d/Y', strtotime(@$data->log_date)) }}</td>
                <td>{{@$data->bmi}}</td>
                <td>{{@$data->fasting_blood_sugar}}</td>
                <td>{{@$data->random_blood_sugar}}</td>
                <td>{{@$data->hba1c}}</td>
                <td>{{@$data->cholesterol}}</td>
                <td>{{@$data->hdl}}</td>
                <td>{{@$data->ldl}}</td>
                <td>{{@$data->triglycerides}}</td>
                <td>{{@$data->serum_creatinine}}</td>
                <td>{{@$data->haemoglobin}}</td>
                <td>{{@$data->albumin}}</td>
                <td>{{@$data->calcium}}</td>
                <td>{{@$data->phosphorous}}</td>
                 
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
</div>
