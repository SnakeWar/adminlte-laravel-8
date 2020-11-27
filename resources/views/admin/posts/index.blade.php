@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('content')
    <h1>{{$title}}</h1>

    <hr>
    @include('flash::message')
    <a href="{{route('admin.posts.create')}}" class="btn btn-primary mb-5"><i class="fa fa-fw fa-plus"></i> Nova Postagem</a>
    {{$posts}}
    @if($posts)
    <div class="container-fluid">
        <table class="table table-bordered table-striped data-table">
            <thead>
            <th>#</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Autor</th>
            <th>Ações</th>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>
                        {{$post->id}}
                    </td>
                    <td>
                        {{$post->title}}
                    </td>
                    <td>
                        {{$post->description}}
                    </td>
                    <td>
                        {{$post->user->name}}
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('admin.posts.edit', [$post->id])}}" class="btn btn-sm btn-primary"><i style="color: white" class="fa fa-pencil-alt"></i></a>
                            <form action="{{route('admin.posts.destroy', [$post->id])}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger" style="border-bottom-left-radius: 0;border-top-left-radius: 0"><i class="fa fa-fw fa-trash" style="color: white"></i></button>
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
        {{$posts->links()}}
@endsection
@section('js')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
    @stop
