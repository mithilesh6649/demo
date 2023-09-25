<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogList()
    {
        $blogs = Blog::orderBy("updated_at", "DESC")->get();
        return view("blogs.list", compact("blogs"));
    }

    public function addBlog()
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

        return view("blogs.add", compact('status'));
    }

    public function saveBlog(Request $request)
    {

        $blog = new Blog();
        $blog->title_en = $request->title_en;
        $blog->title_ar = $request->title_ar;
        $blog->content_en = $request->content_en;
        $blog->content_ar = $request->content_ar;
        $blog->status = $request->status;

        if ($request->hasFile('Media_image')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            $file = $request->file('Media_image');

            $fileName = $file->getClientOriginalName();
            $imageName = time() . '-' . str_replace(' ', '', $file->getClientOriginalName());

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                if ($file->move(public_path('/blog_images'), $imageName)) {
                    $blog->thumbnail = $imageName;
                }

                if ($blog->save()) {
                    return redirect()
                        ->route("blogs.list")
                        ->with(["success" => "Blog has been added successfully !"]);
                } else {
                    return redirect()
                        ->back()
                        ->with("warning", "Something went wrong!");
                }

            } else {
                Session::flash('status', "Somthing went wrong.");
            }
        } else {
            if ($blog->save()) {
                return redirect()
                    ->route("blogs.list")
                    ->with(["success" => "Blog has been added successfully !"]);
            } else {
                return redirect()
                    ->back()
                    ->with("warning", "Something went wrong!");
            }
        }

    }

    public function updateBlog(Request $request)
    {
        // return $request->input();

        if ($request->hasFile('Media_image')) {

            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            $file = $request->file('Media_image');

            $fileName = $file->getClientOriginalName();
            $imageName = time() . '-' . str_replace(' ', '', $file->getClientOriginalName());

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                if ($file->move(public_path('/blog_images'), $imageName)) {
                    $blog = Blog::where("id", $request->blog_id)->first();

                    $blog->title_en = $request->title_en;
                    $blog->title_ar = $request->title_ar;
                    $blog->content_en = $request->content_en;
                    $blog->content_ar = $request->content_ar;
                    $blog->status = $request->status;
                    $blog->thumbnail = $imageName;

                    if ($blog->update()) {
                        return redirect()
                            ->route("blogs.list")
                            ->with(["success" => "Blog has been updated successfully !"]);
                    } else {
                        return redirect()
                            ->back()
                            ->with("warning", "Something went wrong!");
                    }
                }

            } else {
                Session::flash('status', "Somthing went wrong.");
            }

        } else {
            $blog = Blog::where("id", $request->blog_id)->first();

            $blog->title_en = $request->title_en;
            $blog->title_ar = $request->title_ar;
            $blog->content_en = $request->content_en;
            $blog->content_ar = $request->content_ar;
            $blog->status = $request->status;

            if ($blog->update()) {
                return redirect()
                    ->route("blogs.list")
                    ->with(["success" => "Blog has been updated successfully !"]);
            } else {
                return redirect()
                    ->back()
                    ->with("warning", "Something went wrong!");
            }
        }

    }

    public function editBlog($id)
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        $blog = Blog::find($id);

        return view("blogs.edit", compact("blog", "status"));
    }

    public function viewBlog($id)
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

        $blog = Blog::find($id);
        return view("blogs.view", compact("blog", "status"));
    }

    public function deleteBlog(Request $request)
    {
        $deleteBlog = Blog::where("id", $request->id)->delete();
        if ($deleteBlog) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    //deletedCategoryList
    public function deletedBlogList()
    {
        $blogList = Blog::orderBY("id", "desc")
            ->onlyTrashed()
            ->get();
        //dd($usersList);
        return view("blogs.deleted_blogs_list", compact("blogList"));
    }

    //Restore Category
    public function restoreBlog(Request $request)
    {
        $blogList = Blog::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete Category
    public function permanentDeleteBlog(Request $request)
    {
        $blogList = Blog::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

    public function deleteBlogImage(Request $request)
    {
        $blog_data = Blog::where('id', $request->blog_id)->update(['thumbnail' => null]);

        if ($blog_data) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }
}
