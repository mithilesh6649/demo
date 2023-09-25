<?php $count = 0; ?>


@foreach ($distributions as $key=>$value)
    <tr>
        <td style="display:none"></td>
        <td class="table_td">{{ date('d/m/Y', strtotime($value->date)) }}</td>

        <td class="table_td">{{$value->distributed_batch}}</td>

        <td class="table_td" style="padding: 0.25rem!important;">

            <a class="action-button" title="View" href="{{route('tip-distributions.views', [$value['distributed_batch'],$branch_id])}}"> <i class="text-info fa fa-eye eye_green"></i></a>

        </td>
      {{-- @endif --}}
  </tr>


@endforeach
<?php $count++; ?>
