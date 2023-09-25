<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLog;
use Auth;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function list() {
        if (Auth::user()->can("order_management")) {

            $allOrdersList = Order::with('user', 'branch', 'address', 'orderItems', 'orderItems.menuItems', 'orderItems.menuItems.menuCategory', 'orderItems.orderChoices.choice', 'orderLogs')->orderBY('created_at', 'desc')->get();

            $order_summary_logs = DB::table('md_dropdowns')->where('slug', 'order_summary')->get()->toArray();

            return view('orders.list', compact('allOrdersList', 'order_summary_logs'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function statusUpdate(Request $request)
    {
        //  dd($request->all());
        $orderlogs = new OrderLog();

        $orderlogs->order_id = $request->order_id;
        $orderlogs->status = $request->status;

        if ($orderlogs->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => true]);
        }

    }

    public function view($id)
    {

        if (Auth::user()->can("view_order")) {
            $particularOrder = Order::with('user', 'branch', 'address', 'address.city', 'orderItems', 'orderItems.menuItems', 'orderItems.menuItems.menuCategory', 'orderItems.orderChoices.choice', 'orderLogs')->where('id', $id)->first();

            //dd($particularOrder);
            $order_summary_logs = DB::table('md_dropdowns')->where('slug', 'order_summary')->get()->toArray();

            return view('orders.view', compact('particularOrder', 'order_summary_logs'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function show(Request $request)
    {

        $particularOrder = Order::with('user', 'branch', 'address', 'orderItems', 'orderItems.menuItems', 'orderItems.menuItems.menuCategory', 'orderItems.orderChoices.choice')->where('id', $request->id)->first();

        $result_view = view("orders.partials", [
            "particularOrder" => $particularOrder,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

        //dd($request->all());
        // dd('dfdsfsd show');
    }

    public function filterOrder(Request $request)
    {

        //05/25/2022 - 06/30/2022

        $date_range = $request->date_range;

        $orders = Order::with('user', 'branch', 'address', 'orderItems', 'orderItems.menuItems', 'orderItems.menuItems.menuCategory', 'orderItems.orderChoices.choice', 'orderLogs')->orderByDesc('created_at')->where('created_at', '>=', date('Y-m-d', strtotime($date_range[0])))->where('created_at', '<=', date('Y-m-d', strtotime($date_range[1])))->get();

        //dd($orders);
        $order_summary_logs = DB::table('md_dropdowns')->where('slug', 'order_summary')->get()->toArray();

        $result_view = view('orders.order_list_partial', ['orders' => $orders, 'order_summary_logs' => $order_summary_logs])->render();

        return json_encode(['html' => $result_view, 'status' => true]);

    }

    public function reset(Request $request)
    {

        $date_range = $request->date_range;

        $orders = Order::with('user', 'branch', 'address', 'orderItems', 'orderItems.menuItems', 'orderItems.menuItems.menuCategory', 'orderItems.orderChoices.choice')->orderByDesc('created_at')->get();

        $result_view = view('orders.order_list_partial', ['orders' => $orders])->render();

        return json_encode(['html' => $result_view, 'status' => true]);

    }

}
