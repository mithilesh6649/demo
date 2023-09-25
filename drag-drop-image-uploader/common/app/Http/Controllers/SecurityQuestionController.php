<?php

namespace App\Http\Controllers;

use App\Models\SecurityQuestion;
use Auth;
use DB;
use Illuminate\Http\Request;

class SecurityQuestionController extends Controller
{

    public function questionsList()
    {
        if (Auth::user()->can("security_questions_management")) {

            $allQuestions = SecurityQuestion::get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            return view('security-questions.list', compact('allQuestions', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function addQuestions()
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        return view('security-questions.add', compact('status'));
    }

    public function saveQuestions(Request $request)
    {
        $SecurityQuestion = SecurityQuestion::create($request->all());
        if ($SecurityQuestion) {
            return redirect()
                ->route("security.questions.list")
                ->with("success", "Security questions has been added successfully!");
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }

    }

    public function viewQuestions($id)
    {
        if (Auth::user()->can("view_question")) {

            $question = SecurityQuestion::where('id', $id)->first();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            return view('security-questions.view', compact('question', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function editQuestions($id)
    {
        if (Auth::user()->can("edit_question")) {

            $question = SecurityQuestion::where('id', $id)->first();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            return view('security-questions.edit', compact('question', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function updateQuestions(Request $request)
    {
        SecurityQuestion::where('id', $request->question_id)->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'status' => $request->status,
        ]);
        return redirect()
            ->route("security.questions.list")
            ->with("success", "Security questions has been updated successfully!");
    }

    public function deleteQuestions(Request $request)
    {

        $question = SecurityQuestion::where('id', $request->id);

        $question = $question->delete();

        if ($question) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    //deletedOfferList
    public function deletedQuestionsList()
    {
        if (Auth::user()->can("manage_recyle_question_tab")) {

            $allQuestions = SecurityQuestion::onlyTrashed()->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            return view('security-questions.deleted_list', compact("allQuestions", 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Restore Offer
    public function restoreQuestions(Request $request)
    {
        SecurityQuestion::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete Offer
    public function permanentDeleteQuestions(Request $request)
    {
        SecurityQuestion::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

}
