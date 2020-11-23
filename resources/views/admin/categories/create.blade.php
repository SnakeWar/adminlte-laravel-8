@extends('adminlte::page')

@section('content')
    <div class="container-fluid card">
        <h1>
            {{$title}}
        </h1>
        <hr>
        <h3>{{$subtitle}}</h3>
        <hr>
        <form action="{{route('admin.categories.store')}}" method="post">

            @csrf

            <div class="form-group">
                <label for="">Nome Categoria</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                @error('name')
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
                <button type="submit" class="btn-block btn-lg btn-success">
                    Criar Categoria
                </button>
            </div>

        </form>
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

