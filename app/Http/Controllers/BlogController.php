<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Facades\Storage;
use App\Traits\ImageTrait;

class BlogController extends Controller
{
    use ImageTrait;
    public function __construct()
    {
        $this->middleware('auth')->only(['create','myblogs']);
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('theme.blogs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        // dd($request->all());
        $data=$request->validated();
        // =============== image uploading ====================
        $data['image']=$this->uploadImage($data['image'],'blogs');
        $data['user_id']=auth()->user()->id;
        Blog::create($data);
        return redirect()->back()->with('status-blog','Blog Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('theme.single-blog',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if(auth()->user()->id == $blog->user_id){
            $categories=Category::all();
            return view('theme.blogs.edit',compact('blog','categories'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if(auth()->user()->id == $blog->user_id){
            $data=$request->validated();
            // =============== image uploading ====================
            if($request->hasFile('image'))
            {
                // Delete The Old Image
                Storage::delete('blogs/'.$blog->image);
                // 4- save new name to database record
                $data['image']=$this->uploadImage($data['image'],'blogs');
            }else{
                $data['image']=$blog->image;
            }
                $data['user_id']=auth()->user()->id;
                $blog->update($data);
                return redirect()->back()->with('status-blog','Blog Updated Successfully');
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
    if(auth()->user()->id == $blog->user_id){
        if($blog->image){
        // Delete The Old Image
            Storage::delete('blogs/'.$blog->image);
        }
        $blog->delete();
        return redirect()->back()->with('status-blog','Blog Deleted Successfully');
        }
    }
    public function myblogs()
    {
        $myBlogs=Blog::where('user_id','=',auth()->user()->id)->paginate(10);
        return view('theme.blogs.my-blogs',[
            'blogs'=>$myBlogs,
        ]);
    }
}
