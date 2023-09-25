<?php
namespace App\Http\Controllers;

use App\Models\Review;
use DB;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function ReviewList()
    {
        $allReviews = Review::get();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')
            ->get();
        return view('reviews.list', compact('allReviews', 'status'));
    }

    public function ReviewView($id)
    {
        $review = Review::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')
            ->get();
        return view('reviews.view', compact('review', 'status'));
    }

    public function changeItemStatus(Request $request)
    {

        $review = Review::where('id', $request->id)
            ->first();
        $review->status = $request->status;

        $review->update();

        return response()
            ->json(['success' => true, 'status' => 'true',

            ]);

    }

    public function addReview()
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')
            ->get();
        return view('reviews.add', compact('status'));
    }

    public function saveReview(Request $request)
    {

        $review = new Review();
        $review->name = $request->name;
        $review->message = $request->message;
        $review->status = $request->status;
        if ($review->save()) {
            return redirect()
                ->route("reviews.list")
                ->with("success", "Review has been added successfully!");
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }
    }

    public function deleteReview(Request $request)
    {

        $review = Review::where('id', $request->id);

        $review = $review->delete();

        if ($review) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

}
