<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crypto;
use App\Models\CryptoResponse;
use Auth;

class WalletController extends Controller
{
   public function crypto_wallet(){
    \Session::forget('tablink');
    if(Auth::user()->can('view_crypto_wallet_users')) {
        $userList = Crypto::orderBy("id",'DESC')->with('person')->get();
        return view('users_wallet/index', ['userList' => $userList]);
    }else{
        return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
    }
   }

   public function view_crypto_wallet($id){
        $tablink = 'home';

        if(\Session::get('tablink')){
            $tablink = \Session::get('tablink');
        }
     $crypto_wallet_data = Crypto::where('id',$id)->with('person')->first();
     $crypto_transactions = CryptoResponse::get();

     return view('users_wallet/view')->with(['wallet_data' => $crypto_wallet_data,'tablink' => $tablink,'crypto_transactions'=>$crypto_transactions]);
   }

   public function filter($id,Request $request){

    $type = $request->transferType;

    $crypto_wallet_data = Crypto::where('id',$id)->with('person')->first();

    if($type != null){
        $crypto_transactions = CryptoResponse::where('transferType','like','%'.$type.'%')->get();
    }else{
        $crypto_transactions = CryptoResponse::get();
    }

    $result_view = view('transactions.partial',['wallet_data' => $crypto_wallet_data,'type'=>$type,'crypto_transactions'=>$crypto_transactions])->render();
    return json_encode(['html'=> $result_view,'status'=>"true"]);

   }

   public function reset($id,Request $request){

    $type = null;

    $crypto_wallet_data = Crypto::where('id',$id)->with('person')->first();

    $crypto_transactions = CryptoResponse::get();

    $result_view = view('transactions.partial',['wallet_data' => $crypto_wallet_data,'crypto_transactions'=>$crypto_transactions,'type'=>$type])->render();
    return json_encode(['html'=> $result_view,'status'=>"true"]);
}

}
