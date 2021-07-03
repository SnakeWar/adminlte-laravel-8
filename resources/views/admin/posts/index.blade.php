@extends('adminlte::page')
@section('css')
    <style>
        .table .action {
            text-align: center;
        }
    </style>
@endsection
@section('title_prefix', env('APP_NAME') . ' - ')
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
        <a href="{{route($admin . '.create')}}" class="btn btn-outline-primary mb-5"><i
                class="fa fa-fw fa-plus m-auto"></i> {{$subtitle}}</a>
        @if(isset($model))
            <table id="myTable" class="table table-bordered table-striped data-table table-responsive-sm">
                <thead>
                <th>Criação</th>
                <th>Atualização</th>
                <th>Publicação</th>
                <th>Título</th>
                <th>Foto</th>
                <th>Autor</th>
                <th>Ações</th>
                </thead>
                <tbody>
                @foreach($model as $item)
                    <tr>
                        <td>
                            {{Helper::convertdata_tosite($item->created_at)}}
                        </td>
                        <td>
                            {{$item->updated_at->diffForHumans()}}
                        </td>
                        <td>
                            {{Helper::convertdata_tosite($item->published_at)}}
                        </td>
                        <td>
                            {{$item->title}}
                        </td>
                        <td class="text-center">
                            <img src="{{asset("storage/$item->photo")}}" class="img-fluid w-25" alt="">
                        </td>
                        <td>
                            {{$item->user->name}}
                        </td>
                        <td class="action">
                            <div class="btn-group">
                                <form action="{{route($admin . '.ativo', [$item->id])}}" method="post">
                                    @csrf
                                    @if($item->status == false)
                                        <button type="submit" class="btn btn-danger"
                                                style="border-bottom-right-radius: 0;border-top-right-radius: 0"><i
                                                class="fa fa-minus"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-success"
                                                style="border-bottom-right-radius: 0;border-top-right-radius: 0"><i
                                                class="fa fa-check"></i>
                                        </button>
                                    @endif
                                </form>
                                <a href="{{route($admin . '.edit', [$item->id])}}" class="btn btn-primary"><i
                                        class="fa fa-edit"></i></a>
                                <form action="{{route($admin . '.destroy', [$item->id])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger"
                                            style="border-bottom-left-radius: 0;border-top-left-radius: 0"><i
                                            class="fa fa-trash"></i>
                                    </button>
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
    {{--        {{$model->links()}}--}}
@endsection
@section('js')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@stop
