<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TalabatCustomer;

class TalabatController extends Controller
{
    public function list(){
        $customers = TalabatCustomer::all();
        return view('talabat-customers.index')->with([
            'customers' => $customers
        ]);
    }

    public function add(){
        return view('talabat-customers.add');
    }

    public function edit($id){
        $customer = TalabatCustomer::find($id);
        return view('talabat-customers.edit')->with([
            'customer' => $customer
        ]);
    }

    public function view($id){
        $customer = TalabatCustomer::find($id);
        return view('talabat-customers.view')->with([
            'customer' => $customer
        ]);
    }

    public function save(Request $request){
        try{

            $customer_info = TalabatCustomer::create([
                'customer_info' => $request->customer_info
            ]);

            return redirect()->route('talabat.customers')->with('success','Customer info saved successfully!');

        }catch(\Exception $e){

            return redirect()->back()->with('error',$e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile());
        }
    }

    public function update(Request $request){
        try{

            $customer_info = TalabatCustomer::find($request->id);
            $customer_info->update([
                'customer_info' => $request->customer_info
            ]);

            return redirect()->route('talabat.customers')->with('success','Customer info updated successfully!');

        }catch(\Exception $e){

            return redirect()->back()->with('error',$e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile());
        }
    }

    public function delete(Request $request){
        try{

            $customer_info = TalabatCustomer::find($request->id);
            $customer_info->delete();

            return response()->json([
                'status' => true,
                'message' => 'Customer info deleted successfully!',
            ],200);

        }catch(\Exception $e){

            return response()->json([
                'status' => false,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ],200);
        }
    }
}
