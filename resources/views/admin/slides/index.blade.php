@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('content')
    <div class="conteiner-fluid box box-primary">
        <h1 class="text-black-50">{{$title}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}" class="pr-1"><i class="fa fa-address-card"></i> Home /</a></li>
            <li class="active">{{$title}}</li>
        </ol>
        <hr>
        @include('flash::message')
        <a href="{{route('admin.slides.create')}}" class="btn btn-primary mb-5"><i class="fa fa-fw fa-plus"></i> {{$subtitle}}</a>
        @if($slides)
        <table id="myTable" class="table table-bordered table-striped data-table">
            <thead>
            <th>#</th>
            <th>Título</th>
            <th>Foto</th>
            <th>Ações</th>
            </thead>
            <tbody>
            @foreach($slides as $slide)
                <tr>
                    <td>
                        {{$slide->id}}
                    </td>
                    <td>
                        {{$slide->title}}
                    </td>
                    <td >
                        <img src="{{asset("storage/$slide->photo")}}" class="img-fluid w-25" alt="">
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('admin.slides.edit', [$slide->id])}}" class="btn btn-sm btn-primary"><i style="color: white" class="fa fa-pencil-alt"></i></a>
                            <form action="{{route('admin.slides.destroy', [$slide->id])}}" method="post">
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
{{--        {{$slides->links()}}--}}
@endsection
@section('js')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    @stop
