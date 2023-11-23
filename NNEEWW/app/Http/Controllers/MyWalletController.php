<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class MyWalletController extends Controller
{
    public function my_wallet(){ 
		
        \Session::forget('tablink');
        if(Auth::user()->can('view_my_wallet')) {
            $userWallet = Account::where('used_for','moneywallet')->with('person')->get();
            return view('my_wallet/index', ['userWallet' => $userWallet]);
        }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }

    }

    public function view_my_wallet($id){
        $tablink = 'home';

        if(\Session::get('tablink')){
            $tablink = \Session::get('tablink');
        }
        
        $userWallet = Account::find($id);
        $send_transactions = $userWallet->send_transactions;
		$receive_transactions = $userWallet->receive_transactions;
        return view('my_wallet/view')->with(['userWallet'=>$userWallet,'tablink'=>$tablink,'send_transactions'=>$send_transactions,'receive_transactions'=>$receive_transactions]);
    }


    public function filter(Request $request){
		$date_range = $request->date_range;

		$holder_name = $request->holder_name;
		$account_name = $request->account_name;
		$account_number = $request->account_number;

		$walletData = Account::query();
		$walletData->where('used_for','moneywallet');
		$walletData->with('person');

		
		
		if($holder_name!=null){
			$walletData->wherehas('person',function($query) use ($holder_name){
				$query->where('firstName','LIKE','%'.$holder_name.'%');
			});
		}

		if($account_name!=null){
			$walletData->where('label','LIKE','%'.$account_name.'%');
		}
		

		if(isset($date_range[0]) && $date_range[0] != null && (isset($date_range[1]) && $date_range[1] != null)){
			 $walletData->where('createdAt','>=',date('Y-m-d',strtotime($date_range[0])));
			 $walletData->where('createdAt','<=',date('Y-m-d',strtotime($date_range[1].'+ 1 days')));
		}

		$wallet = $walletData->get();
		
		if($account_number!=null){
			//$walletData->where('accountNumber','LIKE',$account_number.'%');
			$wallet = $wallet->filter(function($record) use($account_number) { 
				return false !== stripos(Crypt::decryptString($record->accountNumber), $account_number);
			
		});
		}

		$result_view = view('my_wallet.partial',['userWallet'=>$wallet])->render();
        return json_encode(['html'=> $result_view,'status'=>true]);
	}

    public function reset(){

		$wallet_data = Account::where('used_for','moneywallet')->with('person')->get();

		$result_view = view('my_wallet.partial',['userWallet'=>$wallet_data])->render();
        return json_encode(['html'=> $result_view,'status'=>true]);
	}
}
