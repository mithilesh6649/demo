<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Models\PaymentTransactionItem;
use DB;
use Auth;
class PaymentTransactionController extends Controller
{
   public function transactionList(){
       
      if (Auth::user()->can('view_payment_transactions')) {      
       $transactionList = PaymentTransaction::with('paymentTransactionItem')->orderBy('created_at','desc')->get(); 
       return view('payment_transactions.list',compact('transactionList'));
   }else{
       
    return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
   }

}


public function viewTransaction($id){
 // if (Auth::user()->can('view_payment_transaction')) {     
      $transactionView = PaymentTransaction::with(['user','paymentTransactionItem','dietPlanSubscription','userDietPlanSubscription'=>function($query){$query->select(['id','payment_transaction_id','expire_at']);}])->where('id',$id)->first();
      return view('payment_transactions.view',compact('transactionView'));
// }else{
   
//     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
    
// }


}


public function filterTransaction(Request $request ){
    $date_range = $request->date_range;
    $payments = PaymentTransaction::orderByDesc('created_at')->where('created_at','>=',date('Y-m-d',strtotime($date_range[0])))->where('created_at','<=',date('Y-m-d',strtotime($date_range[1])))->get();
    $result_view = view('payment_transactions.partial',['transactionList'=>$payments])->render();
    return json_encode(['html'=> $result_view,'status'=>true]);
} 


public function filterTransactionMonthYear(Request $request){
    
    if($request->filterType=='monthYear'){
        $payments = PaymentTransaction::orderByDesc('created_at')->whereYear('created_at',$request->year)->whereMonth('created_at',$request->month)->get();
    }elseif($request->filterType=='Year'){

        $payments = PaymentTransaction::orderByDesc('created_at')->whereYear('created_at',$request->year)->get();
    }
    $result_view = view('payment_transactions.partial',['transactionList'=>$payments])->render();
    return json_encode(['html'=> $result_view,'status'=>true]);
}

public function reset(Request $request){
    $payments = PaymentTransaction::orderByDesc('created_at')->get();
    $result_view = view('payment_transactions.partial',['transactionList'=>$payments])->render();
    return json_encode(['html'=> $result_view,'status'=>true]);
}





}
