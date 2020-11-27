@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('content')
    <h1>{{$title}}</h1>

    <hr>
    @include('flash::message')
    <a href="{{route('admin.categories.create')}}" class="btn btn-primary mb-5"><i class="fa fa-fw fa-plus"></i> Criar Categoria</a>
    <div class="container-fluid">
        @if($categories)
            <table class="table table-bordered table-striped data-table">
                <thead>
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            {{$category->id}}
                        </td>
                        <td>
                            {{$category->name}}
                        </td>
                        <td>
                            {{$category->description}}
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.categories.edit', ['category' => $category->id])}}" class="btn btn-sm btn-primary"><i style="color: white" class="fa fa-pencil-alt"></i></a>
                                <form action="{{route('admin.categories.destroy', ['category' => $category->id])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-sm btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="ml-5">Não tem nada ainda...</p>
        @endif
        {{$categories->links()}}
    </div>
@endsection
@section('js')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
    @stop
