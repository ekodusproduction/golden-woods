<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function show(Blog $blog)
    {
        //
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        //
    }

    public function destroy(Blog $blog)
    {

    }
}
