<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $blogs = Blog::where('user_id', Auth::user()->id)->get();
            return view('theme.blog.my-blogs', compact('blogs'));
        }
        return to_route('theme.home');
    }

    /**
     * Show the form for creating a news resource.
     */
    public function create()
    {
        if (Auth::check()) {
            return view('theme.blog.create');
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request)
    {
        // $data['user_id'] = Auth::user()->id;
        $data = $request->validated();

        // Image Uploading
        // 1- get imag
        $image = $request->image;
        // 2- name replacement
        $newImageName = time() . "-" . $image->getClientOriginalName();
        // 3- move image to my project
        $image->storeAs('blogs', $newImageName, 'public'); // php artisan storge:link 
        // 4- save image new name to database
        $data['image'] = $newImageName; // Image Uploading
        // 1- get imag
        $image = $request->image;
        // 2- name replacement
        $newImageName = time() . "-" . $image->getClientOriginalName();
        // 3- move image to my project
        $image->storeAs('blogs', $newImageName, 'public'); // php artisan storge:link 
        // 4- save image new name to database
        $data['image'] = $newImageName;

        Blog::create($data);
        return redirect()->back()->with('success_msg', 'Blog added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('theme.singleBlog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if (Auth::check()) {
            if (Auth::user()->id == $blog->user->id) {
                return view('theme.blog.edit', compact('blog'));
            }
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        if (Auth::check()) {
            if (Auth::user()->id == $blog->user->id) {
                $data = $request->validated();

                if ($request->hasFile('image')) {
                    // Image Uploading
                    // 0- delete old image
                    if (Storage::exists('public/blogs/' . $blog->image)) {
                        Storage::delete('public/blogs/' . $blog->image);
                    }
                    // 1- get imag
                    $image = $request->image;
                    // 2- name replacement
                    $newImageName = time() . "-" . $image->getClientOriginalName();
                    // 3- move image to my project
                    $image->storeAs('blogs', $newImageName, 'public'); // php artisan storge:link 
                    // 4- save image new name to database
                    $data['image'] = $newImageName;
                }

                $blog->update($data);
                return to_route('blogs.index')->with('update_msg', 'Blog updated successfully');
            }
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if (Auth::check()) {
            if (Auth::user()->id == $blog->user->id) {
                // Check if the blog has an associated image and delete it from storage
                if ($blog->image && Storage::exists('public/blogs/' . $blog->image)) {
                    Storage::delete('public/blogs/' . $blog->image);
                }

                // Delete the blog from the database
                $blog->delete();

                // Redirect back with a success message
                return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
            }
        }
        abort(403);
    }
}
