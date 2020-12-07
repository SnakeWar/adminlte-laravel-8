@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('content')
        <div class="container-fluid">
            <h1 class="text-black-50">{{$title}}</h1>
            <hr>
            @include('flash::message')
            <a href="{{ route('admin.modules.create') }}" class="btn btn-primary mb-5"><i class="fa fa-plus"></i> Adicionar</a>
            <table id="myTable" class="table table-bordered table-striped data-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($modules as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td class="action">
                            <div class="btn-group">
                                <a href="{{ route('admin.modules.edit', $item->id) }}" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                <form action="{{ route('admin.modules.destroy', $item->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button style="border-bottom-left-radius: 0;border-top-left-radius: 0" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $modules->links() !!}

        </div>
        <!-- /.box-body -->
    </div>
@stop
@section('js')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@stop
