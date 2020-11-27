@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('content')
    <h1>{{$title}}</h1>

    <hr>
    @include('flash::message')
    <a href="{{route('admin.roles.create')}}" class="btn btn-primary mb-5"><i class="fa fa-fw fa-plus"></i> Criar Grupo</a>
    @if($roles)
    <div class="container-fluid">
        <table class="table table-bordered table-striped data-table">
            <thead>
            <th class="d-sm-none">#</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Ações</th>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td class="d-sm-none">
                        {{$role->id}}
                    </td>
                    <td>
                        {{$role->title}}
                    </td>
                    <td>
                        {{$role->description}}
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('admin.roles.edit', [$role->id])}}" class="btn btn-sm btn-primary"><i style="color: white" class="fa fa-pencil-alt"></i></a>
                            <form action="{{route('admin.roles.destroy', [$role->id])}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0"><i class="fa fa-fw fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
        @else
        <p class="ml-5">Não tem nada ainda...</p>
    @endif
        {{$roles->links()}}
@endsection
@section('js')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
    @stop
