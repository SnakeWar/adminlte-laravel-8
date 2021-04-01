    @extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('dropify')
    <link rel="stylesheet" href="{{asset('dropify/css/dropify.css')}}">
    <link rel="stylesheet" href="{{asset('dropify/fonts/dropify.ttf')}}">
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}" class="pr-1"><i class="fa fa-address-card"></i> Home /</a></li>
        <li><a href="{{ route('admin.posts.index') }}" class="pr-1"> {{$title}} /</a></li>
        <li class="active"> Editar</li>
    </ol>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="card-title">Editar {{$title}}</h1>
        </div>
        @include('flash::message')

        <div class="card-body">
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
                                    @if($post->categories->contains($category)) selected @endif>{{$category->title}}</option>
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
                    <button type="submit" class="btn btn-block btn-lg btn-primary">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid p-5">
        <div class="row">
            @foreach($post->photos as $photo)
                <div class="col-lg-4 col-6 text-center">
                    <form action="{{route('admin.post_photo_remove')}}" method="post">
                        @csrf
                        <input type="hidden" name="photoName" value="{{$photo->photo}}">
                        <button type="submit" class="btn btn-sm btn-danger my-2"><i class="fa fx fa-close">Remover</i></button>
                    </form>
                    <img src="{{asset('storage/' . $photo->photo)}}" alt="" class="img-responsive w-50">
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
    <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
    @include('ckfinder::setup')
    <script>
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.disableAutoInline = true;
            CKEDITOR.addCss('img {max-width:100%; height: auto;}');
            var editor = CKEDITOR.replace('editor1', {
                extraPlugins: 'uploadimage',
            });
        } else {
            document.getElementById('editor1').innerHTML =
                '<div class="tip-a tip-a-alert">This sample requires working Internet connection to load CKEditor 4 from CDN.</div>'
        }
        CKFinder.setupCKEditor(editor);
    </script>
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
