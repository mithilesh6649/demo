<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class PaymentController extends Controller
{
    public function paymentTransactions(){
        if (Auth::user()->can("payment_management")) {

        return view('payments.list');
         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function viewPaymentTransaction(){
        if (Auth::user()->can("view_payment_transaction")) {

        return view('payments.view');
          } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }
}
