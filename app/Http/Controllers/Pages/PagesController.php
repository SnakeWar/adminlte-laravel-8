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
    public function posts(Request $request)
    {
        $data = $request->all();

        $orderBy = empty($data['order']) ? 'asc' : $data['order'];

        $product_query = $this->post::with('categories')->get();

        if(!empty($data['segment'])) {
            $segment_id = $data['segment'];
            $product_query = $product_query->where('segment_id', $segment_id);
        }

        if(!empty($data['term'])) {
            $product_query = $product_query->where('title', 'like', "%{$data['term']}%");
        }

        $response = $product_query->paginate(1);

        $last_page = $response->lastPage();

        setlocale(LC_MONETARY, "pt_BR");

        if(empty($data['order'])){
            $response = $response->shuffle();
        }
        return response()->json([
            'last_page' => $last_page,
            'data' => $response
        ]);
    }
}
