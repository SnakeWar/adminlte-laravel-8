<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category, Post $post)
    {
        $this->category = $category;
        $this->post = $post;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = $this->category::all();
        $posts = $this->post::with('categories')->paginate(1);
        return view('pages.welcome', ['segments' => $categories, 'products' => $posts]);
    }
    public function post($slug)
    {
        $post = $this->post::whereSlug($slug)->first();

        return view('pages.post', ['post' => $post, 'title' => 'Blog Maxmeio - Título: ' . $post->slug]);
    }
}
