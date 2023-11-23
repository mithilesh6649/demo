<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use DB,Auth;
class ClientReviewController extends Controller
{
 public function ClientReviewsList(){
     if (Auth::user()->can('review_management')) {
       $data = Testimonial::orderBy("updated_at", "DESC")->get();
       return view("client_reviews.list", compact("data"));
   } else {
    return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
}
}

public function addClientReview(){
 if (Auth::user()->can('add_review')) {
     $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
     return view("client_reviews.add", compact('status')); 
 } else {
    return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
} 
}


public function saveClientReview(Request $request)
{
      //  dd($request->all());
          //  return env('APP_URL');

    $Blogs = new Testimonial();
    $Blogs->name = $request->name;
    $Blogs->title = $request->title;
    $Blogs->rating = $request->rating; 
    $Blogs->status = $request->status;
    $Blogs->description = $request->descripiton;
    
    

    if ($request->file("thumbnail")) {
        $GenTestImage = $request->file("thumbnail");
        $thumbnail = time() . "." . $GenTestImage->getClientOriginalExtension();
        $GenTestImage->move("images/media", $thumbnail);
        $Blogs->image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail;
    }

     if ($request->file("thumbnail_before")) {
        $GenTestImage = $request->file("thumbnail_before");
        $thumbnail_before = time() . "." . $GenTestImage->getClientOriginalExtension();
        $GenTestImage->move("images/media", $thumbnail_before);
        $Blogs->before_image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail_before;
    }

     if ($request->file("thumbnail_after")) {
        $GenTestImage = $request->file("thumbnail_after");
        $thumbnail_after = time() . "." . $GenTestImage->getClientOriginalExtension();
        $GenTestImage->move("images/media", $thumbnail_after);
        $Blogs->after_image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail_after;
    }

    if ($Blogs->save()) {

        return redirect()->route('client.review.list')->with(['success' => 'Testimonial  has been created successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }

}


public function editClientReview($id){
 if (Auth::user()->can('edit_review')) {
  $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
  $data = Testimonial::find($id);
  return view("client_reviews.edit", compact("data", "status"));
} else {
    return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
}

}

public function updateClientReview(Request $request){
      // dd($request->all());

           // dd($request->all());
    $BlogEdit = Testimonial::where('id', $request->review_id)->first();
    $BlogEdit->name = $request->name;
    $BlogEdit->title = $request->title;
    $BlogEdit->rating = $request->rating;
    $BlogEdit->status = $request->status;
    $BlogEdit->description = $request->descripiton;
    

    if ($request->file("thumbnail")) {
        $GenTestImage = $request->file("thumbnail");
        $thumbnail = time() . "." . $GenTestImage->getClientOriginalExtension();
        $GenTestImage->move("images/media", $thumbnail);
        $BlogEdit->image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail;
    }

    if ($request->file("thumbnail_before")) {
        $GenTestImage = $request->file("thumbnail_before");
        $thumbnail_before = time() . "." . $GenTestImage->getClientOriginalExtension();
        $GenTestImage->move("images/media", $thumbnail_before);
        $BlogEdit->before_image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail_before;
    }

     if ($request->file("thumbnail_after")) {
        $GenTestImage = $request->file("thumbnail_after");
        $thumbnail_after = time() . "." . $GenTestImage->getClientOriginalExtension();
        $GenTestImage->move("images/media", $thumbnail_after);
        $BlogEdit->after_image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail_after;
    }

    if ($BlogEdit->update()) {

       return redirect()->route('client.review.list')->with(['success' => 'Testimonial  has been updated successfully!']);
   } else {
    return redirect()->back()->with('warning', 'Something went wrong!');
}


}

public function viewClientReview($id){
 if (Auth::user()->can('view_review')) {
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    $data = Testimonial::find($id);
    return view("client_reviews.view", compact("data", "status"));
} else {
    return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
}
}


public function deleteClientReview(Request $request)
{
   $Blog = Testimonial::where('id', $request->id)->first();
   if ($Blog) {
    $Blog->delete();
    return response()->json([
        'success' => 1,
    ]);
} else {
    return response()->json([
        'success' => 0,
    ]);
}
}

}
