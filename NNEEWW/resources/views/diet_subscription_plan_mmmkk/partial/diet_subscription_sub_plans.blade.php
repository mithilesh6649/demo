<!-- <div class="tab-pane fade {{ Request::segment(3) == 'choice' && Request::segment(2) == 'items' ? 'show active' : '' }}"
id="pills-transactions" role="tabpanel" aria-labelledby="pills-transactions-tab"> -->
<div class="d-flex align-items-center justify-content-between">

<div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0 mb-0 w-100"
style="border-bottom: none;">
<h3></h3>
<a class="btn btn-sm btn-success mb-0 btn btn-sm btn-success add-advance-options" href="javascript:;"
data-toggle="modal" data-target="#choice_group_modal">Add Sub Plan</a>
</div>
</div>
<div class="card-body table form items mb-0">
@if (session('status'))
<div class="alert alert-success" role="alert"> {{ session('status') }}
</div>
@endif
<table style="width:100%" id="choice-list"
class="table table-bordered table-hover">
<thead>
<tr>
<th class="display-none"></th>
<th>Plan Name</th>
<th>Duration</th>
<th>Price</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody class="choicegp">
 
<tr>
<td>
   MetMax
</td>
<td>
   3 Months
</td>

<td>
   23332
</td>

<td>
    <!-- <input  class="change_status_of_group"  data-id="{{ $choicegroup->id }}" type="checkbox"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"  data-on="Active" data-off="Inactive" {{ $choicegroup->status == '1' ? 'checked' : '' }} > -->
    <label class="switch">
        <input type="checkbox" class="change_status_of_group"
        data-id="{{ $choicegroup->id }}"
        {{ $choicegroup->status == '1' ? 'checked' : '' }}>
        <span class="slider round"></span>
    </label>
</td>

<td>  <a
    data-id="{{ $choicegroup->id }}"
    class="action-button delete-button" title="Delete"
    href="javascript:void(0)"><i
    class="text-danger fa fa-trash-alt"></i></a> </td>
</tr>
 

 <tr>
<td>
   MetMax
</td>
<td>
   6 Months
</td>

<td>
   23332
</td>

<td>
   
    <label class="switch">
        <input type="checkbox" class="change_status_of_group"
        data-id="{{ $choicegroup->id }}"
        {{ $choicegroup->status == '1' ? 'checked' : '' }}>
        <span class="slider round"></span>
    </label>
</td>

<td> <a
    data-id="{{ $choicegroup->id }}"
    class="action-button delete-button" title="Delete"
    href="javascript:void(0)"><i
    class="text-danger fa fa-trash-alt"></i></a> </td>
</tr>
</tbody>
</table>
</div>
<!-- </div> -->