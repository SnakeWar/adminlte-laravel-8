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
            <form action="{{ isset($model) ? route($admin . '.update', $model->id) : route($admin. '.store')}}" method="post" enctype="multipart/form-data">

                @csrf
                @if(!empty($model))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="">Título</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ isset($model) ? $model->title : old('title') }}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Descrição</label>
                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                           value="{{ isset($model) ? $model->title : old('description') }}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
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
        $('.dropify').dropify();
    </script>
@endsection
