<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Response;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category, Post $post, Comment $comment, Response $response)
    {
        $this->category = $category;
        $this->post = $post;
        $this->comment = $comment;
        $this->response = $response;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function post($slug)
    {
        $post = $this->post::whereSlug($slug)->with('comments')->first();
        return view('pages.post', ['post' => $post, 'title' => 'Notícias - ' . $post->slug]);
    }
    public function comment(Request $request)
    {
        $comment = $this->comment::create($request->all());
        if ($comment) return back();
        return back()->with('error', 'Sua mensagem não foi enviada!');
    }
    public function response(Request $request)
    {
        $response = $this->response::create($request->all());
        if ($response) return back();
        return back()->with('error', 'Sua mensagem não foi enviada!');
    }
}
