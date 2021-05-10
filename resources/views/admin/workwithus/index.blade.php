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
        @if(isset($model))
            <table id="myTable" class="table table-bordered table-striped data-table table-responsive-sm">
                <thead>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Mensagem</th>
                <th>CV</th>
                <th>Ações</th>
                </thead>
                <tbody>
                @foreach($model as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{$item->email}}
                        </td>
                        <td>
                            {{$item->message}}
                        </td>
                        <td class="">
                            <a href="{{asset("storage/$item->attach")}}" target="_blank">Baixar</a>
                        </td>
                        <td class="action">
                            <div class="btn-group">
                                <form action="{{route($admin . '.destroy', [$item->id])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger"
                                            ><i
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
