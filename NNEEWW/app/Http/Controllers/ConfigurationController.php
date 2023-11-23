<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionLimit;

class ConfigurationController extends Controller
{
    public function configuration(){
        $transaction_limit = TransactionLimit::first();
        return view('configurations.index')->with(['transaction_limit'=>$transaction_limit]);
    }

    public function editConfiguration($id){
        $transaction_limit = TransactionLimit::find($id);
        return view('configurations.edit')->with(['transaction_limit'=>$transaction_limit]);
    }

    public function updateConfiguration(Request $request){
        $transaction_limit = TransactionLimit::find($request->id);
        $transaction_limit->amount = $request->amount;
        $transaction_limit->days = $request->days;
        if($transaction_limit->save()){
            return redirect()->back()->with('success','The Transaction Limit has been updated successfully!');
        }else{
            return redirect()->back()->with('error','Something went wrong!');
        }
    }

}
