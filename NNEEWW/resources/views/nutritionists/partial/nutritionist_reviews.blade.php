    <!-- review start -->
    <table style="width:100%" id="review-list" class="table table-bordered table-hover yajra-datatable">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Ratings</th>


            </tr>
        </thead>
        <tbody>
            @if (@$Nutritionist->Review->ReviewComment)
                @forelse($Nutritionist->Review->ReviewComment as $key => $allUserReviews)
                    <tr>
                        <td> {{ @$allUserReviews->ReviewCommentByUsers->name ?? '--' }}</td>
                        <td>{{ @$allUserReviews->ReviewCommentByUsers->email ?? '--' }}</td>
                        <td>{{ @$allUserReviews->comment ?? '--' }}</td>
                        <td>
                            @for ($i = 0; $i < $allUserReviews->review; $i++)
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                            @endfor
                        </td>

                    </tr>
                @empty
                @endforelse
            @endif
        </tbody>
    </table>

    <!-- review end -->
