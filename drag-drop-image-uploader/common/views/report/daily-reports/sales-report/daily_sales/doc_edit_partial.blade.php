 


@if(pathinfo($dailySalesDocEdit->doc, PATHINFO_EXTENSION) == 'pdf')
 <a href="{{env('BRANCH_PORTAL_DOC_URL').$dailySalesDocEdit->doc}}" target="_blank"><i class="fas fa-file-pdf fa-10x text-danger" style="font-size:150px;"></i></a> 
@else
  <a href="{{env('BRANCH_PORTAL_DOC_URL').$dailySalesDocEdit->doc}}" target="_blank"><img src="{{env('BRANCH_PORTAL_DOC_URL').$dailySalesDocEdit->doc}}" style="width:150px;"></a> 
@endif


 