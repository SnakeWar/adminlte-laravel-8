<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use UploadTrait;

    private $post;

    public function __construct(Post $post, Category $category)
    {
        $authenticationMiddleware = config('ckfinder.authentication');

        if(!is_callable($authenticationMiddleware)) {
            if(isset($authenticationMiddleware) && is_string($authenticationMiddleware)) {
                $this->middleware($authenticationMiddleware);
            } else {
                $this->middleware(\CKSource\CKFinderBridge\CKFinderMiddleware::class);
            }
        }
        $this->post = $post;
        $this->category = $category;
        $this->title = 'Postagens';
        $this->subtitle = 'Adicionar Postagem';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index', ['posts' => Post::paginate(10), 'title' => $this->title, 'subtitle' => $this->subtitle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all();
        return view('admin.posts.create', ['categories' => $categories, 'title' => $this->title, 'subtitle'=> $this->subtitle]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        $categories = $request->get('categories', null);
        $user_id = Auth::id();
        $data['user_id'] = $user_id;
        //dd($data);

        if($request->hasFile('photo')){
            $data['photo'] = $this->imageUpload($request->file('photo'));
        }

        $post = $this->post->create($data);

        $post->categories()->sync($categories);
        flash('Postagem Criada com Sucesso!')->success();
        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->category->all();
        $post = $this->post->findOrFail($id);

        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'title' => $this->subtitle]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $data = $request->except('categories');

        $categories = $request->get('categories', null);

        $post = $this->post->find($id);

        if($request->hasFile('photo')){
            if(Storage::disk('public')->exists($post->photo)){
                Storage::disk('public')->delete($post->photo);
            }
            $data['photo'] = $this->imageUpload($request->file('photo'));
        }
        $post->update($data);

        if(!is_null($categories))
            $post->categories()->sync($categories);

        flash('Postagem Atualizada com Sucesso!')->success();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->post->find($id);
        $post->delete();

        flash('Postagem Removida com Sucesso!')->success();
        return redirect()->route('admin.posts.index');
    }
}
