@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('dropify')
    <link rel="stylesheet" href="{{asset('dropify/css/dropify.css')}}">
    <link rel="stylesheet" href="{{asset('dropify/fonts/dropify.ttf')}}">
@endsection
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="card-title">
                Editar {{$title}}
            </h1>
        </div>
        @include('flash::message')

        <div class="card-body">
            <form action="{{route('admin.slides.update', ['slide' => $slide->id])}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="">Título</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{$slide->title}}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Descrição</label>
                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                           value="{{$slide->description}}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
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
                    <button type="submit" class="btn btn-block btn-lg btn-success">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach($slide->photos as $photo)
                <div class="col-lg-4 col-6 text-center">
                    <form action="{{route('admin.slide_photo_remove')}}" method="post">
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
