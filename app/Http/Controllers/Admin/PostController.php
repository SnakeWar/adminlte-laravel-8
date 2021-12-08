<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Traits\Functions;
use App\Traits\UploadTraits;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;
use Intervention\Image\Facades\Image;
use App\Picture;

use function PHPUnit\Framework\directoryExists;

class PostController extends Controller
{
    use UploadTraits, Functions;

    private $post;

    public function __construct(Post $post, Category $category)
    {
        $this->model = $post;
        $this->category = $category;
        $this->title = 'Postagens';
        $this->subtitle = 'Postagem';
        $this->middleware('auth');
        $this->admin = 'admin.posts';
        $this->view = 'posts';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->admin . '.index', [
            'model' => $this->model->with('user')->get(),
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'admin' => $this->admin,
            'view' => $this->view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all();
        return view($this->admin . '.form', [
            'categories' => $categories,
            'title' => $this->title,
            'subtitle'=> $this->subtitle,
            'admin' => $this->admin,
            'view' => $this->view
        ]);
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
        $data['slug'] = Str::slug($data['title']);
        $data['published_at'] = \Helper::convertdata_todb($data['published_at']);
        $categories = $request->get('categories', null);
        $data['user_id'] = Auth::user()->id;
        // if($request->hasFile('photo')){
        //     if(!is_dir(public_path('/storage/thumbnail/posts')))
        //     {
        //         mkdir(public_path('/storage/thumbnail/posts'), 0775, true);
        //     }
        //     // Pega a imagem e salva no storage
        //     $data['photo'] = $this->imageUpload($request->file('photo'), $this->view);
        //     // Pega a imagem já salva e redimensiona proporcionalmente
        //     $imageResized = Image::make(public_path("/storage/") . "{$data['photo']}")
        //     ->save(public_path("/storage/") . "{$data['photo']}", 60);
        //     // Salva a imagem redimensionada e salva na pasta thumbnail
        //     //->save(public_path("/storage/thumbnail/") . $data['photo']);
        // }

        $post = $this->model->create($data);

        if($post){
            $post->categories()->sync($categories);
            flash($this->subtitle . ' Criada com Sucesso!')->success();
            return redirect()->route($this->admin . '.index');
        }

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
        $categories = Category::all();
        //dd($categories[0]->title);
        $model = $this->model->findOrFail($id);
        //dd($post);
        return view($this->admin . '.form', [
            'model' => $model,
            'categories' => $categories,
            'title' => $this->title,
            'subtitle'=> $this->subtitle,
            'admin' => $this->admin,
            'view' => $this->view
        ]);
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
        $data = $request->except(['categories', 'photos']);
        //dd(convertdata_todb($data['published_at']));
        $data['published_at'] = \Helper::convertdata_todb($data['published_at']);
        $categories = $request->get('categories', null);

        $post = $this->model->find($id);

        if($request->hasFile('photo')){
            if(Storage::disk('public')->exists($post->photo)){
                Storage::disk('public')->delete($post->photo);
            }
            if($request->hasFile('photo')){
                if(!is_dir(public_path('/storage/thumbnail/posts')))
                {
                    mkdir(public_path('/storage/thumbnail/posts'), 0775, true);
                }
                // Pega a imagem e salva no storage
                $data['photo'] = $this->imageUpload($request->file('photo'), $this->view);
                // Pega a imagem já salva e redimensiona proporcionalmente
                $imageResized = Image::make(public_path("/storage/") . "{$data['photo']}")
                ->resize(300, 300, function($constraint){
                    $constraint->aspectRatio();
                })
                // Salva a imagem redimensionada e salva na pasta thumbnail
                ->save(public_path("/storage/thumbnail/") . $data['photo']);
            }
        }
        $post->update($data);

        if(!is_null($categories))
            $post->categories()->sync($categories);

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'photo');
            $post->photos()->createMany($images);
            flash('Foto(s) adicionadas com Sucesso!')->success();
            return redirect()->back();
        }

        flash($this->subtitle . ' Atualizada com Sucesso!')->success();
        return redirect()->route($this->admin . '.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->model->findOrFail($id);
        $post->delete();

        flash($this->subtitle . ' Removida com Sucesso!')->success();
        return redirect()->route($this->admin . '.index');
    }
    public function ativo($id)
    {
        $post = $this->model->findOrFail($id);
        if($post->status == false){
            $post->status = true;
            $post->update();
            flash('Ativado!')->success();
            return redirect()->back();
        }
        else{
            $post->status = false;
            $post->update();
            flash('Desativado!')->warning();
            return redirect()->back();
        }
    }
    public function upload(Request $request)
    {
        if(!is_dir(public_path('/storage/posts')))
        {
            mkdir(public_path('/storage/posts'), 0775, true);
        }
        $folderPath = public_path('/storage/posts/');
 
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
 
        $imageName = uniqid() . '.png';
 
        $imageFullPath = $folderPath.$imageName;
 
        file_put_contents($imageFullPath, $image_base64);
        $arquivo = 'posts/' . $imageName;
        //  $saveFile = new Picture;
        //  $saveFile->name = $imageName;
        //  $arquivo = $saveFile->save();
        //dd($arquivo);
    
        return response()->json(['success'=>'Imagem Redimensionada', 'file' => $arquivo]);
    }
}
