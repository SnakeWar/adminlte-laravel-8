@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/owl-carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/owl-carousel/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/lightbox/css/lightbox.min.css')}}">
    <style>
        .table .action{
            text-align: center;
        }
    </style>
@endsection
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
        <a href="{{route('admin.slides.create')}}" class="btn btn-app mb-5"><i
                class="fa fa-fw fa-plus m-auto"></i> {{$subtitle}}</a>
        @if($slides)
            <table id="myTable" class="table table-bordered table-striped data-table table-responsive-sm">
                <thead>
                <th>#</th>
                <th>Título</th>
                <th>Fotos</th>
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
                        <td>
                            <div id="carousel" class="owl-carousel owl-theme">
                                @foreach($slide->photos as $key => $photo)
                                    <div class="item">
                                        <a href="{{asset("storage/$photo->photo")}}" data-lightbox="image-{{$slide->title}}" data-title="{{$slide->title}}">
                                            <img src="{{asset("storage/$photo->photo")}}" class="">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="action">
                            <div class="btn-group">
                                <a href="{{route($admin . '.edit', [$slide->id])}}" class="btn btn-app"><i class="fa fa-edit"></i>Editar</a>
                                <form action="{{route($admin . '.destroy', [$slide->id])}}" method="post">
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
    </div>
    @else
        <p class="ml-5">Não tem nada ainda...</p>
    @endif
    {{--        {{$slides->links()}}--}}
@endsection
@section('js')

    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script src="{{asset('assets/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#carousel").owlCarousel({
                    loop: false,
                    margin: 10,
                    dots: false,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: false
                        },
                        600: {
                            items: 3,
                            nav: false
                        },
                        1000: {
                            items: 4,
                            nav: false,
                            loop: false
                        }
                    }
                }
            );
        });
    </script>
    <script src="{{asset('assets/vendor/lightbox/js/lightbox.min.js')}}"></script>
@stop
