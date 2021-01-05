@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('dropify')
    <link rel="stylesheet" href="{{asset('dropify/css/dropify.css')}}">
    <link rel="stylesheet" href="{{asset('dropify/fonts/dropify.ttf')}}">
@endsection
@section('content')
    <div class="container-fluid card">
        <h1>
            Editar Postagem
        </h1>
        <hr>
        <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="">Título</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{$post->title}}">
                @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Descrição</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                       value="{{$post->description}}">
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Categorias</label>
                <select name="categories[]" id="" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                                @if($post->categories->contains($category)) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Conteúdo</label>
                <textarea type="text" id="editor1" name="body" cols="30" rows="10"
                          class="form-control @error('body') is-invalid @enderror">{{$post->body}}</textarea>
                @error('body')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Foto</label>
                <input type="file" class="dropify form-control @error('photo') is-invalid @enderror" name="photo">
                @error('photo')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-6">--}}
{{--                    <img src="{{asset('storage/' . $post->photo)}}" alt="" class="img-fluid w-25">--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="form-group">
                <label for="">Galeria</label>
                <input type="file" class="dropify form-control @error('photos') is-invalid @enderror" name="photos[]"
                       multiple>
                @error('photos')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group mt-5">
                <button type="submit" class="btn -btn-lg btn-success">
                    Atualizar Postagem
                </button>
            </div>
        </form>
    </div>
    <div class="container p-5">
        <div class="row">
            @foreach($post->photos as $photo)
                <div class="col-lg-3 col-6">
                    <form action="{{route('admin.post_photo_remove')}}" method="post">
                        @csrf
                        <input type="hidden" name="photoName" value="{{$photo->photo}}">
                        <button type="submit" class="btn btn-sm btn-danger my-2"><i class="fa fx fa-close"></i></button>
                    </form>
                    <img src="{{asset('storage/' . $photo->photo)}}" alt="" class="img-responsive w-25">

                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('js')
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
    <script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
    <script>
        // Note: in this sample we use CKEditor with two extra plugins:
        // - uploadimage to support pasting and dragging images,
        // - image2 (instead of image) to provide images with captions.
        // Additionally, the CSS style for the editing area has been slightly modified to provide responsive images during editing.
        // All these modifications are not required by CKFinder, they just provide better user experience.
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.disableAutoInline = true;
            CKEDITOR.addCss('img {max-width:100%; height: auto;}');
            var editor = CKEDITOR.replace('editor1', {
                extraPlugins: 'uploadimage,image2',
                removePlugins: 'image',
                height: 250
            });
            CKFinder.setupCKEditor(editor);
        } else {
            document.getElementById('editor1').innerHTML =
                '<div class="tip-a tip-a-alert">This sample requires working Internet connection to load CKEditor 4 from CDN.</div>'
        }
    </script>
    <script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js" type="text/javascript"></script>
@stop
@section('scripts')
    {{--    <script src="{{asset('assets/js/jquerymaskmoney/jquery.maskMoney.min.js')}}"></script>--}}
    {{--    <script>--}}
    {{--        $('#price').maskMoney({--}}
    {{--            prefix: 'R$ ',--}}
    {{--            allowNegative: false,--}}
    {{--            thousands: '.',--}}
    {{--            decimal: ','--}}
    {{--        })--}}
    {{--    </script>--}}
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
@endsection
@section('dropify_js')
    <script src="{{asset('dropify/js/dropify.js')}}"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endsection
