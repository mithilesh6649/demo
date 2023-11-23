
    <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="display-none"></th>
            <th>Test Name</th>
            <th>Report</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userTestLists as $userTestList)

     <tr>
       <td>{{@$userTestList->test->name}}</td>
       <td>
        <!-- {{$userTestList}} -->
            <input type="hidden" name="user_test_id[]" value="{{$userTestList->id}}">
            <input type="hidden" name="test_id[]" value="{{$userTestList->test_id}}">
            <input type="hidden" name="user_id" value="{{$userTestList->user_id}}">
           <input type="file" accept="application/pdf,image/*" name="test_reports[]">
       </td>
        <td>@if(@$userTestList->test_done==1)
            <a href="{{$userTestList->document_url}}" target="_blank"><i class="text-success fa fa-eye"></i></a>
            <span class="active_text_success">Report Uploaded</span>  
            @else <span class="inactive_text_warning">Report Pending</span> @endif</td>
   </tr>
   @endforeach
</tbody>
</table>
 