    <!-- review start -->
    <table style="width:100%" id="reviews-list" class="table table-bordered table-hover yajra-datatable">
        <thead>
            <tr>
                <th>Nutritionst</th>
                <th>Email</th>
                <th>Message</th>
                <th>Ratings</th>


            </tr>
        </thead>
        <tbody>
            @if (@$User->ReviewComment)
                @forelse($User->ReviewComment as $key => $allUserReviews)
                    <tr>
                        <td> {{ @$allUserReviews->ReviewToNutritionst->ReviewNutritionstDetails->name ?? '--' }}</td>
                        <td>{{ @$allUserReviews->ReviewToNutritionst->ReviewNutritionstDetails->email ?? '--' }}</td>
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
