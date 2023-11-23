 
<div class="row">

	@forelse ($planDetails->paymentTransactionItem as $transactionItem)
       
       @if($transactionItem->type =='diet_plans')

       <div class="col-md-12 border p-2 mb-3 shadow-sm">
       	<b>Plan ( {!!rupeeSymbol()!!}  {{$transactionItem->amount ?? $planDetails->amount }} )</b> : -  {{@$planDetails->dietPlanSubscription->name }}  
       </div>   

       @elseif($transactionItem->type =='tests')
         
       <div class="col-md-12 p-2 mb-3 border">
       	<b>Test ( {!!rupeeSymbol()!!}  {{$transactionItem->amount ?? ''}} )</b> :

       	@forelse ($planDetails->UserTest as $test)
       	<span class="badge badge-pill badge-primary">{{@$test->test->name}}</span>
       	@empty
       	<p> -- </p>
       	@endforelse

       </div> 

       @elseif($transactionItem->type =='traits')      
         
       <div class="col-md-12 p-2 mb-3 border" style="max-height:200px;overflow-y: scroll;">
       	<b>Traits ( {!!rupeeSymbol()!!}  {{$transactionItem->amount ?? ''}} )</b>

       	@forelse ($planDetails->UserTrait as $traits)
       	<span class="badge badge-pill badge-primary">{{@$traits->trait->title}}</span>
       	@empty
       	<p> -- </p>
       	@endforelse
       </div> 

       @endif   

	@empty
	<p> -- </p>
	@endforelse

</div>