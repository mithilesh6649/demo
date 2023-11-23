<table style="width:100%" id="chats-list" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th class="display-none"></th>
			<th>Ticket Id</th>
			<th>Category</th>
			<!-- <th>Status</th> -->
			 
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@forelse ($groupChatWebUsers as $groupChatWebUser)

		<tr>
			<th class="display-none"></th>
			<td>
				{{ @$groupChatWebUser->groupChat->ticket->unique_ticket_id }}
			</td>
			<td>

				{{ @$groupChatWebUser->groupChat->ticket->category }}
			</td>

			<!-- <td> No</td> -->


			 

			<td> <a title="View" href="{{route('nutritionist_view_ticket',['id'=>$groupChatWebUser->groupChat->ticket->id])}}"><i class="text-success fa fa-eye"></i></a>



		</tr>

	 
		@empty
		@endforelse

	</tbody>
</table>
