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
        <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="post" enctype="multipart/form-data">

            @csrf
            @method("PUT")

            <div class="form-group">
                <label for="">Título</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$post->title}}">
                @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Descrição</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$post->description}}">
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
                        <option value="{{$category->id}}" @if($post->categories->contains($category)) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Conteúdo</label>
                <textarea type="text" id="editor" name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$post->body}}</textarea>
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
            <div class="row">
                <div class="col-6">
                    <img src="{{asset('storage/' . $post->photo)}}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="form-group mt-5">
                <button type="submit" class="btn -btn-lg btn-success">
                    Atualizar Postagem
                </button>
            </div>
        </form>
    </div>
@endsection

@section('js')
{{--    @include('ckfinder::setup')--}}
    {{--    <script> console.log('Hi!'); </script>--}}
    {{--    <script>--}}
    {{--        $(document).ready(function(){--}}
    {{--            $(selector).inputmask("99-9999999");  //static mask--}}
    {{--            $(selector).inputmask({"mask": "(999) 999-9999"}); //specifying options--}}
    {{--            $(selector).inputmask("9-a{1,3}9{1,3}"); //mask with dynamic syntax--}}
    {{--        });--}}
    {{--    </script>--}}
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                },
            } )
            .catch( error => {
                console.error( error );
            } );
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
