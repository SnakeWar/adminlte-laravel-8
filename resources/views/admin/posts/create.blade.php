@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('dropify')
    <link rel="stylesheet" href="{{asset('dropify/css/dropify.css')}}">
    <link rel="stylesheet" href="{{asset('dropify/fonts/dropify.ttf')}}">
    @section('title', $subtitle)
@endsection
@section('content')
    <div class="container-fluid card">
            <h1>
                {{$title}}
            </h1>
        <hr>
        <h3>{{$subtitle}}</h3>
        <hr>
        <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="">Título</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
                @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Descrição</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Conteúdo</label>
                <textarea type="text" id="editor" name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror" value="{{old('body')}}"></textarea>
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
                        <option value="{{$category->id}}">{{$category->name}}</option>
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
                <button type="submit" class="btn-block btn-lg btn-success">
                    Criar Postagem
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
    @include('ckfinder::setup')
    <script>
        // ClassicEditor
        //     .create( document.querySelector( '#editor' ) ,{
        //         //extraPlugins: [ MyUploadAdapterPlugin ],
        //     })
        //     .then( editor => {
        //         console.log( editor );
        //     } )
        //     .catch( error => {
        //         console.error( error );
        //     } );
        ClassicEditor
            .create( document.querySelector( '#editor' ), {

                ckfinder: {
                    uploadUrl: 'http://localhost/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
                },

            } )
            .catch( function( error ) {
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
