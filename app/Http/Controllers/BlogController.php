<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFormRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('status', 1)->latest()->paginate(5);

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogFormRequest $request)
    {
        Blog::create($request->all());
        
        return redirect()->route('admin.panel')->with('success', 'Blog created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogFormRequest $request, Blog $blog)
    {
        $blog->update($request->all());

        return redirect()->route('admin.panel')->with('success', 'Blog edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::find($id)->delete($id);

        return response()->json([
            'success' => 'Blog deleted'
        ]);
    }

    public function getAllBlogs()
    {
        $blogs = Blog::latest()->paginate(5);

        return view('admin-panel', compact('blogs'));
    }

    public function changeBlogStatus(Request $request)
    {
        $blog = Blog::find($request->id);
        $blogStatus = $blog->status;
        $blog->status = !$blogStatus;
        $blog->save();

        return response()->json([
            'success' => 'Blog status changed'
        ]);
    }

}
