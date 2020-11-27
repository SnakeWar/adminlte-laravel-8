@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('content')
    <div class="container-fluid card">
        <h3>
            Editar Categoria
        </h3>
        <hr>
        <form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="post">

            @csrf
            @method("PUT")

            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="">Nome Categoria</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Descrição</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$category->description}}">
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control" disabled value="{{$category->slug}}">
            </div>

            {{--        <div class="form-group">--}}
            {{--            <label for="">Lojas</label>--}}
            {{--            <select type="text" name="stores" class="form-control" value="{{$store->name}}">--}}
            {{--                @foreach($stores as $store)--}}
            {{--                    <option value="{{$store->id}}">{{$store->name}}</option>--}}
            {{--                @endforeach--}}
            {{--            </select>--}}
            {{--        </div>--}}


            <div class="form-group">
                <button type="submit" class="btn -btn-lg btn-success">
                    Atualizar Categoria
                </button>
            </div>

        </form>
    </div>

@endsection

@section('js')
    {{--    <script> console.log('Hi!'); </script>--}}
    {{--    <script>--}}
    {{--        $(document).ready(function(){--}}
    {{--            $(selector).inputmask("99-9999999");  //static mask--}}
    {{--            $(selector).inputmask({"mask": "(999) 999-9999"}); //specifying options--}}
    {{--            $(selector).inputmask("9-a{1,3}9{1,3}"); //mask with dynamic syntax--}}
    {{--        });--}}
    {{--    </script>--}}
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

