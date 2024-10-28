<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create']);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $categories=Category::get();
        return view('theme.blogs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data=$request->validated();

        $image=$request->image; // Get Image
        $newImageName=time().'_'.$image->getClientOriginalName(); // Chanjectge Name
        $image->storeAs('blogs',$newImageName,'public'); // Add To My Project
        $data['image']=$newImageName; // Add To Variable
        $data['user_id']= Auth::user()->id; // Add User Id
        Blog::create($data); // Record In dDatabase

        return back()->with('status-blog','Your Blog Sent Successfully');
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
        if ($blog->user_id==Auth::user()->id) {
            $categories=Category::get();
            return view('theme.blogs.edit',compact('categories','blog'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if ($blog->user_id==Auth::user()->id) {
            $data=$request->validated();            
            if ($request->hasFile('image')) {
                Storage::delete("public/storage/$blog->image");
                $image=$request->image; // Get Image
                $newImageName=time().'_'.$image->getClientOriginalName(); // Change image Name
                $image->storeAs('blogs',$newImageName,'public'); // Add To My Project
                $data['image']=$newImageName; // Add To Variable
            }
            $blog->update($data);
            return back()->with('status-edit','Your Blog Sent Successfully');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Blog $blog)
    {
        if($blog->user_id==Auth::user()->id){
        Storage::delete("public/storage/$blog->image");
        $blog->delete();
        return back()->with('status-delete','Your Blog Deleted Successfully');
        }
        abort(403);
    }
    public function myBlog()
    {
        if(Auth::check()){
        $blogs=Blog::where('user_id',Auth::user()->id)->paginate(3);
        return view('theme.blogs.my-blog',compact('blogs'));
    }
    return back();    
}
}
