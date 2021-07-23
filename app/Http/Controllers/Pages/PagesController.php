<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\WorkwithusRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Response;
use App\Models\Workwithus;
use App\Traits\UploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    use UploadTraits;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category, Post $post, Comment $comment, Response $response, Product $product, Page $page)
    {
        $this->category = $category;
        $this->post = $post;
        $this->comment = $comment;
        $this->response = $response;
        $this->product = $product;
        $this->page = $page;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->product->whereStatus(true)->limit(6)->get();
        //dd(date('Y-m-d'));
        $posts = $this->post->whereStatus(true)
            ->where('published_at', '<=', date('Y-m-d H:i:s'))
            ->get();
        return view('pages.index', [
            'produtos' => $products,
            'posts' => $posts,
            'pagina' => 'Home'
        ]);
    }
    public function quem_somos()
    {
        return view('pages.quem_somos', [
            'pagina' => 'Quem Somos'
        ]);
    }
    public function page($slug){

        $page = $this->page->whereSlug($slug)->first();

        return view('pages.page_detail', [
            'page' => $page,
            'pagina' => ''
        ]);
    }
    public function products()
    {
        $products = $this->product->whereStatus(true)->paginate(16);
        //dd($products);
        return view('pages.products', [
            'products' => $products,
            'pagina' => 'Produtos'
        ]);
    }
    public function product($slug)
    {
        $products = $this->product->whereStatus(true)->paginate(16);
        $product = $this->product->whereSlug($slug)->first();
        //dd($product);
        return view('pages.product_detail', [
            'product' => $product,
            'products' => $products,
            'pagina' => 'Produtos'
        ]);
    }
    public function posts(Request $request)
    {
        if(isset($request))
        {
            $posts = $this->post
                ->where('title', 'like' ,'%' . $request->title . '%')
                ->whereStatus(true)
                ->where('published_at', '<=', date('Y-m-d H:i:s'))
                ->paginate(16);
            return view('pages.posts', [
                'posts' => $posts,
                'pagina' => 'Blog'
            ]);
        }
        else
        {
            $posts = $this->post
                ->whereStatus(true)
                ->where('published_at', '<=', date('Y-m-d H:i:s'))
                ->paginate(16);
            return view('pages.posts', [
                'posts' => $posts,
                'pagina' => 'Blog'
            ]);
        }
    }
    public function post($slug)
    {
//        $posts = $this->post->whereStatus(true)->paginate(16);
        $post = $this->post->with('comments')->whereSlug($slug)->first();
        //$posts = $this->post->with('comments')->get();
        return view('pages.post', [
            'post' => $post,
            //'posts' => $posts,
            'pagina' => 'Blog',
            'title' => 'Endereço do Site - ' . $post->title,
            'img' => env('APP_URL').'/storage/'.$post->photo,
            'description' => $post->description
        ]);
    }
    public function comment(Request $request)
    {
        $dados = $request->all();
        $comment = $this->comment->create($dados);
        if($comment){
            flash(' Comentário adicionado com sucesso!')->success();
        }
        else{
            flash('Ops, houve um erro!')->warning();
        }
        
    }
    public function response(Request $request)
    {
        $dados = $request->all();
        $response = $this->response->create($dados);
        if($response){
            flash(' Resposta adicionada com sucesso!')->success();
            return redirect()->back();
        }
        else{
            flash('Ops, houve um erro!')->warning();
            return redirect()->back();
        }
        
    }
    public function fale_conosco()
    {
        return view('pages.fale_conosco', [
            'pagina' => ''
        ]);
    }
    public function trabalhe_conosco()
    {
        return view('pages.trabalhe_conosco', [
            'pagina' => ''
        ]);
    }
    public function enviar_trabalhe_conosco(WorkwithusRequest $request)
    {
        $data = $request->all();
        //dd($data);
        if($request->hasFile('attach')){
            $data['attach'] = $this->imageUpload($data['attach'], 'trabalhe_conosco');
        }
        $contact = Workwithus::create($data);

        if ($contact)
        {
            flash(' Mensagem enviada com sucesso!')->success();
            return redirect()->back();
        }
        else{
            flash(' Erro ao enviar a mensagem!')->warning();
            return redirect()->back();
        }
    }
    public function enviar_fale_conosco(ContactRequest $request)
    {
        $data = $request->all();

        $contact = Contact::create($data);

        if ($contact)
        {
            flash(' Mensagem enviada com sucesso!')->success();
            return redirect()->back();
        }
        else{
            flash(' Erro ao enviar a mensagem!')->warning();
            return redirect()->back();
        }
    }
    public function category($id)
    {
        $products = $this->product->where('category_id', $id)->paginate(16);
        return view('pages.category', [
            'products' => $products,
            'pagina' => 'Produtos'
        ]);
    }
}
