@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('content')

    <h1>{{$title}}</h1>

    <hr>
    @include('flash::message')
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-5"><i class="fa fa-fw fa-plus"></i> Adicionar</a>
            <div class="container-fluid">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Grupo</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>@foreach($item->roles as $role)
                                    {{ $role->title.' ' }}
                                @endforeach
                            </td>
                            <td class="action">
                                <div class="btn-group">
                                    <a href="{{route('admin.users.edit', [$role->id])}}" class="btn btn-sm btn-primary"><i style="color: white" class="fa fa-pencil-alt"></i></a>
                                    <form action="{{route('admin.users.destroy', [$role->id])}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger" style="border-bottom-left-radius: 0;border-top-left-radius: 0"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $users->links() !!}
            </div>


@stop
