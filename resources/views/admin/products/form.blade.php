@extends('adminlte::page')
@section('title_prefix', env('APP_NAME') . ' - ')
@section('title', $subtitle)
@section('dropify')
    <link rel="stylesheet" href="{{asset('dropify/css/dropify.css')}}">
    <link rel="stylesheet" href="{{asset('dropify/fonts/dropify.ttf')}}">
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}" class="pr-1"><i class="fa fa-address-card"></i> Home /</a></li>
        <li><a href="{{ route($admin . '.index') }}" class="pr-1">{{ $title }} /</a></li>
        <li class="active"> {{ isset($model) ? 'Editar '.$subtitle : 'Adicionar '.$subtitle }}</li>
    </ol>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="card-title">{{$subtitle}}</h1>
        </div>
        <div class="card-body">
            <form action="{{ isset($model) ? route($admin . '.update', $model->id) : route($admin. '.store')}}"
                  method="post" enctype="multipart/form-data">

                @csrf
                @if(!empty($model))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" class="dropify form-control @error('photo') is-invalid @enderror" name="photo">
                    @error('photo')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    @if(isset($model->photo))
                        <div class="box-body mt-3">
                            <img class="img-panel img-thumbnail w-25" src="{{ asset("storage/$model->photo") }}"
                                 alt="{{ $model->title }}">
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Nome</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ isset($model) ? $model->title : old('title') }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Categoria</label>
                            <select class="form-control" name="category_id" aria-label="Default select example">
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}"
                                            @if(isset($model)) {{ $item->id == $model->category_id ? 'selected' : '' }}@endif
                                    >
                                        {{ $item->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Descrição</label>
                    <textarea type="text" id="editor1" name="body" cols="30" rows="10"
                              class="form-control @error('body') is-invalid @enderror">{{ isset($model) ? $model->body : old('body') }}</textarea>
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
                    <button type="submit" class="btn btn-block btn-lg btn-primary">
                        {{ isset($model) ? 'Atualizar '.$subtitle : 'Criar '.$subtitle }}
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
        $('.dropify').dropify(
            {
                messages: {
                    'default': 'Arraste e solte um arquivo aqui ou clique',
                    'replace': 'Arraste solte ou clique para modificar',
                    'remove': 'Remover',
                    'error': 'Ooops, Algo de errado aconteceu.'
                }
            }
        );
    </script>
@endsection
