@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('dropify')
    <link rel="stylesheet" href="{{asset('dropify/css/dropify.css')}}">
    <link rel="stylesheet" href="{{asset('dropify/fonts/dropify.ttf')}}">
@section('title', $subtitle)
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}" class="pr-1"><i class="fa fa-address-card"></i> Home /</a></li>
        <li><a href="{{ route('admin.posts.index') }}" class="pr-1"> {{$title}} /</a></li>
        <li class="active"> Criar</li>
    </ol>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="card-title">{{$subtitle}}</h1>
        </div>
        <div class="card-body">
            <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="">Título</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{old('title')}}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Descrição</label>
                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                           value="{{old('description')}}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Conteúdo</label>
                    <textarea type="text" id="editor1" name="body" cols="30" rows="10"
                              class="form-control @error('body') is-invalid @enderror">{{old('body')}}</textarea>
                    @error('body')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                {{--        <div class="form-group">--}}
                {{--            <label for="">Preço</label>--}}
                {{--            <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">--}}
                {{--            @error('price')--}}
                {{--            <div class="invalid-feedback">--}}
                {{--                {{$message}}--}}
                {{--            </div>--}}
                {{--            @enderror--}}
                {{--        </div>--}}
                <div class="form-group">
                    <label for="">Categorias</label>
                    <select name="categories[]" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                            {{$category->id}}|{{$category->name}}
                        @endforeach
                    </select>
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
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-lg btn-primary">
                        Criar Postagem
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection
@section('js')
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
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
                extraPlugins: 'uploadimage',
                height: 250
            });
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
