<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class ThemeController extends Controller
{
    public function index(){
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(4);
        $sliderBlogs=Blog::latest()->take(5)->get();
        return view('theme.index',compact('blogs','sliderBlogs'));
    }

    public function category($id){
        $category=Category::find($id);
        $blogs=Blog::where('category_id','=',$id)->paginate(8);
        return view('theme.category',compact('blogs','category'));
    }

    public function contact(){
        return view('theme.contact');
    }
}
