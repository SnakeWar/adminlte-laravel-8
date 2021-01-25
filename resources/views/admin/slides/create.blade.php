@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('dropify')
    <link rel="stylesheet" href="{{asset('dropify/css/dropify.css')}}">
    <link rel="stylesheet" href="{{asset('dropify/fonts/dropify.ttf')}}">
    @section('title', $subtitle)
@endsection
@section('content')
    <div class="card card-outline card-primary">
      <div class="card-header">
          <h1 class="card-title text">{{$subtitle}}</h1>
      </div>

        <div class="card-body">
            <form action="{{route('admin.slides.store')}}" method="post" enctype="multipart/form-data">

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
                        Criar
                    </button>
                </div>

            </form>
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
