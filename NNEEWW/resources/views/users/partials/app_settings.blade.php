  <table style="width:100%" id="weight-tracker-list" class="table table-bordered table-hover yajra-datatable">
      <thead>
          <tr>
              <th>Notification Setting</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
           <tr>
              <td>Push Notification</td>
              <td style="pointer-events: none;">
              	
              	 <input type="checkbox"    data-toggle="toggle" data-size="mini" {{@$User->push_notification==1 ? 'checked': '' }}	>
              </td>
          </tr>

           <tr>
              <td>Email Notification</td>
              <td style="pointer-events: none;">
              	 <input type="checkbox"  {{@$User->email_notification==1 ? 'checked': '' }}  data-toggle="toggle" data-size="mini"  > 
              </td>
          </tr>
      </tbody>
  </table>
