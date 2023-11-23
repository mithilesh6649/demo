<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use DB,Auth;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogList()
    { 

           if (Auth::user()->can('blog_management')) {
            $blogs = Blog::orderBy("created_at", "ASC")->get();
            return view("blog.list", compact("blogs"));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function addBlog()
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view("blog.add", compact('status'));
        
    }

    public function saveBlog(Request $request)
    {
          //  return env('APP_URL');
       
        $Blogs = new Blog();
        $Blogs->title = $request->name;
         
        $Blogs->status = $request->status;
        $Blogs->content = $request->description;
        $Blogs->is_show = isset($request->is_show) ? '1' : '0';
        $Blogs->author_name = $request->author_name;
        $Blogs->reviewer_name = $request->reviewer_name; 

        if ($request->file("thumbnail")) {
            $GenTestImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $GenTestImage->getClientOriginalExtension();
            $GenTestImage->move("images/blog", $thumbnail);
            $Blogs->image = env('IMAGE_BASE_URL') . '/images/blog/' . $thumbnail;
        }

        if ($Blogs->save()) {

            return redirect()->route('blogs.list')->with(['success' => 'Blog  has been created successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

//    public function upload(Request $request)
// {
//     if($request->hasFile('upload')) {

//             $blogImage = $request->file("upload");
//             $thumbnail = time() . "." . $blogImage->getClientOriginalExtension();
//             $blogImage->move("images/blog", $thumbnail);
//             $imageName = env('IMAGE_BASE_URL') . '/images/blog/' . $thumbnail;
//         // //get filename with extension
//         // $filenamewithextension = $request->file('upload')->getClientOriginalName();
  
//         // //get filename without extension
//         // $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
  
//         // //get file extension
//         // $extension = $request->file('upload')->getClientOriginalExtension();
  
//         // //filename to store
//         // $filenametostore = $filename.'_'.time().'.'.$extension;
  
//         // //Upload File
//         // $request->file('upload')->storeAs('public/uploads', $filenametostore);
//         // $request->file('upload')->storeAs('public/uploads/thumbnail', $filenametostore);
 
//         // //Resize image here
//         // $thumbnailpath = public_path('storage/uploads/thumbnail/'.$filenametostore);
//         // $img = Image::make($thumbnailpath)->resize(500, 150, function($constraint) {
//         //     $constraint->aspectRatio();
//         // });
//         // $img->save($thumbnailpath); 
 
//         echo json_encode([
//             'default' => $imageName,
//             '500' => $imageName,
//         ]);
//     }
// }

     public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function updateBlog(Request $request)
    {
       // dd($request->all());
        $BlogEdit = Blog::where('id', $request->blog_id)->first();
        $BlogEdit->title = $request->name;
        $BlogEdit->status = $request->status;
        $BlogEdit->content = $request->description;
        $BlogEdit->is_show = isset($request->is_show) ? '1' : '0';
        $BlogEdit->author_name =  $request->author_name;
        $BlogEdit->reviewer_name =  $request->reviewer_name;
        if ($request->file("thumbnail")) {
            $GenTestImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $GenTestImage->getClientOriginalExtension();
            $GenTestImage->move("images/blogs", $thumbnail);
            $BlogEdit->image = env('IMAGE_BASE_URL') . '/images/blogs/' . $thumbnail;
        }

        if ($BlogEdit->update()) {

           return redirect()->route('blogs.list')->with(['success' => 'Blog  has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function editBlog($id)
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        $data = Blog::find($id);

        return view("blog.edit", compact("data", "status"));
    }

    public function viewBlog($id)
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        $data = Blog::find($id);
        return view("blog.view", compact("data", "status"));
    }

    public function deleteBlog(Request $request)
    {
           $Blog = Blog::where('id', $request->id)->first();
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

    public function verifyBlog(Request $request){
        $blog_data = Blog::where('id', $request->id)->update(['reviewer_id' => Auth::user()->id]);
        if ($blog_data) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }
}
