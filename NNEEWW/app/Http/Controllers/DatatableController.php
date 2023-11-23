<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\PaymentTransaction;
use App\Models\User;
use App\Models\Cart;
use App\Models\Inventory;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentLogs;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;

class DatatableController extends Controller
{
    public function getPaymentLogs(Request $request)
    {
        if ($request->date_range) {
            $date_range_array = explode(' - ',$request->date_range);
            $from = \Carbon\Carbon::parse($date_range_array[0]);
            $to = \Carbon\Carbon::parse($date_range_array[1]);
            
            $data = PaymentTransaction::with('user')
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->get();
        }else{
            $data = PaymentTransaction::with('user')->get();
        }
            
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('amount', function($row){
            
            return '$'.$row->amount;
        })
        ->addColumn('action', function($row){
            $btn = '';
            return $btn;
        })
        ->addColumn('status', function($row){
            return '<span style="color:green">'.$row->status.'</span>';
        })
        ->addColumn('userName', function($row){
        	return $row->user->name;
            // return $row->created_at->format('d/m/y');
        })
        ->addColumn('invoice', function($row){

            return '<a target="_blank" class="download-invoice" data-id="'.$row->id.'">Download Invoice</a>';
        })
        ->rawColumns(['action','status','invoice'])
        ->make(true);
    }

    public function exportPaymentLogs(Request $request)
    {
        return Excel::download(new PaymentLogs($request->date_range), 'payment.xlsx');
    }

    public function exportBulkInvoices(Request $request)
    {

        if ($request->has('id')) {
            $payment_log = PaymentTransaction::find($request->id);

            $user = User::find($payment_log->user_id);

            $customer = new Buyer([
                'name'          => $user->first_name .' '. $user->last_name,
                'custom_fields' => [
                    'email' => $user->email
                ],
            ]);

            $cart = Cart::whereIn("id", [$payment_log->cart_id])->get();

            $inventory = Inventory::find($cart[0]->inventory_id);

            $item = [(new InvoiceItem(10))->title($inventory->title)->pricePerUnit($inventory->selling_price)->quantity($cart[0]->quantity)
            ];

            $client = new Party([
                'name'          => 'Central Motor',
                'phone'         => '202-555-0704',
                'custom_fields' => [
                    'note'        => 'IDDQD',
                    'business id' => '365#GG',
                ],
            ]);

            $invoice = Invoice::make()
                ->buyer($customer)
                ->filename($payment_log->txn_id)
                ->addItems($item)
                ->seller($client)
                ->currencySymbol('$')
                ->currencyCode('USD')
                ->currencyFormat('{SYMBOL}{VALUE}');

            return $invoice->stream();

        }else{
            if (empty($request->date_range)) {
                $data = PaymentTransaction::all();

            }else{

                $date_range_array = explode(' - ',$request->date_range);
                $from = \Carbon\Carbon::parse($date_range_array[0]);
                $to = \Carbon\Carbon::parse($date_range_array[1]);

                $data = PaymentTransaction::
                whereDate('created_at','>=',$from)
                ->whereDate('created_at','<=',$to)
                ->get();
            }
                
            $all_files = '';

              $client = new Party([
                'name'          => 'Central Motor',
                'phone'         => '202-555-0704',
                'custom_fields' => [
                    'note'        => 'IDDQD',
                    'business id' => '365#GG',
                ],
            ]);

            foreach ($data as $key => $value) {
                $user = User::find($value->user_id);

                $customer = new Buyer([
                    'name'          => $user->first_name .' '. $user->last_name,
                    'custom_fields' => [
                        'email' => $user->email
                    ],
                ]);


                /*$cart = Cart::whereIn("id", [$value->cart_id])->first();

                $inventory = Inventory::find($cart->inventory_id);*/

                $item = [(new InvoiceItem(10))->title("Battery")->pricePerUnit(500)->quantity(2)
                ];

                $invoice = Invoice::make()
                    ->buyer($customer)
                    ->filename($value->txn_id)
                    ->seller($client)
                    ->currencySymbol('$')
                    ->currencyCode('USD')
                    ->currencyFormat('{SYMBOL}{VALUE}')
                    // ->logo(public_path('assets/images/logo-email.png'))
                    ->addItems($item)->save('public');

                $all_files .= $value->txn_id.'.pdf ';
            }
            
            chdir('storage');

            $file_name = 'output-'.uniqid().time().'.pdf';
            $command = 'pdfunite '.$all_files.' '.$file_name;

            shell_exec($command);

            shell_exec('rm -f '.$all_files);

            $headers = array(
                'Content-Type: application/pdf',
            );
            return \Response::download($file_name, 'filename.pdf', $headers);
        }       
    }
}
