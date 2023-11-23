<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Models\PromoCode;
use App\Models\MoneyTransfer;
use App\Models\Account;
use App\Models\Intrabank;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Crypt;

class PaymentsController extends Controller {

	/**
	 * This function is used to Show Payments Transactions
	*/

	public function paymentTransactionsList(Request $request) {
		
		\Session::forget('tablink');
		if(Auth::user()->can('view_payments')) {
			// $paymentTransactionsList = MoneyTransfer::with('sender','receiver','sender_account','receiver_account')->orderByDesc('created_at')->paginate(10);
			$paymentTransactionsList = MoneyTransfer::with('sender','receiver','sender_account','receiver_account')->orderByDesc('created_at')->get();
			//dd($paymentTransactionsList);
			return view('payments/payment_transactions_list', [ 'paymentTransactionsList' => $paymentTransactionsList ]);
		}else{
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to View Payment Transaction
	*/

	public function filter(Request $request){ 
		$date_range = $request->date_range;

		$user_name = $request->username;
		$account = $request->account;
		
		$payment_method = $request->payment_method;

		$flag = 0;

		$payment = MoneyTransfer::query();
		$payment->with('sender_account');
		$payment->orderByDesc('created_at');

		// Single Searching //

		if($account != null || $account != ''){

			//$account_data = Account::where('accountNumber','LIKE',$account.'%')->get();

			$account_data = Account::all()->filter(function($record) use($account) { 
					return false !== stripos(Crypt::decryptString($record->accountNumber), $account);
				
			});
	
			$account_id = [];
			// $account_number = []; 

			if(sizeof($account_data) > 0){
				foreach($account_data as $data){
			
			$account_id[] = $data->account_id;
					// $account_number[] = $data->accountNumber;

				}

				$payment->where( function ( $query ) use ($account_id)
				{
					$query->whereIn('accountId',$account_id);
				});
				

				if(count($payment->get()) == 0){
					$flag = 1;
				}
			}else{
				$flag = 1;
			}

		}

		if($user_name != null || $user_name != ''){
			
			$payment->where('name','like','%'.$user_name.'%');
		
		}
		
		if($date_range[0] != null || $date_range[0] != ''){

			$payment->where('created_at','>=',date('Y-m-d',strtotime($date_range[0])))->where('created_at','<=',date('Y-m-d',strtotime($date_range[1].'+ 1 days')));
		
		}

		if($payment_method != null || $payment_method != ''){
			$payment->where('transferType','LIKE','%'.$payment_method.'%');
		}
		

		if($flag == 1){
			$payments = array();
		}else{

			$payments = $payment->get();
			
		}
		$result_view = view('payments.partial',['paymentTransactionsList'=>$payments])->render();
        return json_encode(['html'=> $result_view,'status'=>"true"]);
	}

	public function reset(Request $request){

		$payments = MoneyTransfer::with('sender','receiver','sender_account','receiver_account')->orderByDesc('created_at')->get();

		$result_view = view('payments.partial',['paymentTransactionsList'=>$payments])->render();
        return json_encode(['html'=> $result_view,'status'=>true]);
	}

	public function view($id){

		\Session::put('tablink','transactions');

		if(Auth::user()->can('view_payments')) {
			$payment = MoneyTransfer::find($id);
			$address = json_decode($payment->address);
			$full_response = json_decode($payment->full_response);
			$accounts = Account::where('account_id',$payment->accountId)->orWhere('accountNumber',$payment->accountNumber)->orWhere('accountNumber',$payment->contact->account->accountNumber)->get();
			return view('payments/view_payment_transaction')->with(['payment'=>$payment,'accounts'=>$accounts,'address'=>$address,'full_response'=>$full_response]);
		}else{
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}


	public function promoCodes(){
		$promo_codes = PromoCode::get();
		return view('payments/promo-codes/list')->with(['promo_codes'=>$promo_codes]);
	}

	public function addPromoCode(){
		return view('payments/promo-codes/add');
	}

	public function savePromoCode(Request $request){

		$promo_code = new PromoCode;
		$promo_code->name = $request->name;
		$promo_code->description = $request->description;
		$promo_code->percentage_off = $request->percentage_off;
		$promo_code->status = $request->status;
		if($promo_code->save()){
			return redirect()->route('promo_codes')->with('success','Promo Code has been added successfully!');
		}else{
			return redirect()->back()->with('warning','Something went wrong!');
		}
	}

	public function editPromoCode($id){
		$promo_code = PromoCode::find($id);
		return view('payments/promo-codes/edit')->with(['promo_code'=>$promo_code]);
	}

	public function updatePromoCode(Request $request){
		
		$promo_code = PromoCode::find($request->id);
		$promo_code->name = $request->name;
		$promo_code->description = $request->description;
		$promo_code->percentage_off = $request->percentage_off;
		$promo_code->status = $request->status;
		if($promo_code->save()){
			return redirect()->route('promo_codes')->with('success','Promo Code has been updated successfully!');
		}else{
			return redirect()->back()->with('warning','Something went wrong!');
		}
	}

	public function deletePromoCode(Request $request){
		$promo_code = PromoCode::find($request->id)->delete();
		if($promo_code){
			return response()->json([
			    'status' => true,
			    'message' => 'Promo Code deleted successfully!',
			]);
		}else{
			return response()->json([
			    'status' => false,
			    'message' => 'Something went wrong!',
			]);
		}
	}

	public function viewAccount(Request $request){
        
        $account_id = $request->id;

        $account_data = Account::where('id',$account_id)->first();

		$created_at = date('m/d/Y', strtotime($account_data->createdAt));

		
		if($account_data){
			$array = [
				'status' => "true",
				'data' => $account_data,
				'created_at' => $created_at,
			];

			return response()->json($array);
		}else{

			$array = [
				'status' => "false",
				'data' => $account_data,
				'created_at' => $created_at,
			];

			return response()->json($array);
		}

        // return view('users.view_accounts')->with(['account_data'=>$account_data]);
    }

}
