<?php

namespace App\Http\Controllers;

use App\Models\DailyPettyExpense;
use App\Models\DailyPettyExpenseDoc;
use Illuminate\Http\Request;

class DailyPettyExpenseController extends Controller
{
    public function index()
    {
        $daily_petty_expense_report = DailyPettyExpense::with('category', 'sub_category')->get();
        return view('daily_petty_expense/index', compact('daily_petty_expense_report'));
    }

    public function view($id)
    {
        $daily_petty_expense = DailyPettyExpense::with('DailyPettyExpenseDoc')->where('id', $id)->first();
        $daily_petty_expense_doc = DailyPettyExpenseDoc::all();

        return view('daily_petty_expense/view', compact('daily_petty_expense', 'daily_petty_expense_doc'));
    }

    public function filterReports(Request $request)
    {

        $date_range = $request->date_range;
        $daily_petty_expense_report = DailyPettyExpense::orderByDesc('created_at')->where('created_at', '>=', date('Y-m-d', strtotime($date_range[0])))->where('created_at', '<=', date('Y-m-d', strtotime($date_range[1])))->get();
        $result_view = view('daily_petty_expense.partial', ['daily_petty_expense_report' => $daily_petty_expense_report])->render();

        return json_encode(['html' => $result_view, 'status' => true]);
    }

    public function reset(Request $request)
    {

        $daily_petty_expense_report = DailyPettyExpense::orderByDesc('created_at')->get();
        $result_view = view('daily_petty_expense.partial', ['daily_petty_expense_report' => $daily_petty_expense_report])->render();

        return json_encode(['html' => $result_view, 'status' => true]);
    }
}
