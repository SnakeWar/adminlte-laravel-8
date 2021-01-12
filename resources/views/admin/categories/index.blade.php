@extends('adminlte::page')
@section('css')
    <style>
        .table .action{
            text-align: center;
        }
    </style>
@endsection
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{$title}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}" class="pr-1"><i class="fa fa-address-card"></i> Home /</a></li>
            <li class="active"> {{$title}}</li>
        </ol>
        <hr>
        @include('flash::message')
        <a href="{{route('admin.categories.create')}}" class="btn btn-primary mb-5"><i class="fa fa-fw fa-plus"></i>{{$subtitle}}</a>
        @if($categories)
            <table id="myTable" class="table table-bordered table-striped data-table table-responsive-sm">
                <thead>
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            {{$category->id}}
                        </td>
                        <td>
                            {{$category->title}}
                        </td>
                        <td>
                            {{$category->description}}
                        </td>
                        <td class="action">
                            <div class="btn-group">
                                <a href="{{route('admin.categories.edit', ['category' => $category->id])}}" class="btn btn-app"><i class="fa fa-edit"></i>Editar</a>
                                <form action="{{route('admin.categories.destroy', ['category' => $category->id])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-app" style="border-bottom-left-radius: 0;border-top-left-radius: 0"><i class="fa fa-trash"></i>Excluir</button>
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
{{--        {{$categories->links()}}--}}
    </div>
@endsection
@section('js')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    @stop
