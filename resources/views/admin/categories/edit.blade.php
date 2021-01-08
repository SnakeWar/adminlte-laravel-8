@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('content')
    <div class="card card-outline card-primary">

        <div class="card-header">
            <h1 class="card-title">
                Editar {{$title}}
            </h1>
        </div>
        <div class="card-body">
            <form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="post">

                @csrf
                @method("PUT")

                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="">Nome Categoria</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$category->title}}">
                    @error('title')
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
                    <button type="submit" class="btn btn-block btn-lg btn-success">
                        Atualizar Categoria
                    </button>
                </div>

            </form>
        </div>
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

