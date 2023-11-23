  <table style="width:100%" id="weight-tracker-list" class="table table-bordered table-hover yajra-datatable">
      <thead>
          <tr>
              <th>Medicine</th>
              <th>Unit</th>
              <th>Dose</th>
              <th>Dose Days</th>
              <th> Dose Timings</th>
              <th>Date</th>

          </tr>
      </thead>
      <tbody>
          @forelse($User->MedicineTracker as $key => $data)
              <tr>
                  <td>{{ @$data->medicine_name ?? '' }}</td>
                  <td>{{ @$data->medicineType->name ?? '--' }} / {{ @$data->medicineServing->name ?? '' }}</td>
                  <td>{{ @$data->dose_count ?? '' }}</td>
                  <td>
                      @forelse($data->MedicineScheduler as $key => $MedicineSchedule)
                          <span
                              class="badge badge-pill badge-dark">{{ \App\Models\User::GetDayNameByNuber($MedicineSchedule->week_days) }}</span>

                      @empty
                          --
                      @endforelse

                  </td>
                  <td>

                      @forelse($data->MedicineReminder as $key => $MedicineReminder)
                          <span
                              class="badge badge-pill badge-dark">{{ date('g:h A', strtotime($MedicineReminder->remind_time)) }}</span>
                      @empty
                          --
                      @endforelse

                  </td>
                  <td>{{ date('m/d/Y', strtotime($data->created_at)) }}</td>
              </tr>
          @empty
          @endforelse
      </tbody>
  </table>
