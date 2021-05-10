@extends('pages.layouts.app')
@section('content')
<section class="pb-5 bg-white">
    <section class="interna form">
        <div class="container">
            <div class="row d-flex justify-content-center" id="somos">
                <div class="col-xl-6">
                    @include('flash::message')
                    <h1 class="mb-5 text-center">
                        <img class="mr-3" src="{{ asset('assets/img/icon/icon_h1.png') }}">Fale conosco
                    </h1>

                    <form action="{{route('enviar_fale_conosco')}}" method="post">
                        @csrf
                        @captcha
{{--                        {!! app('captcha')->render('br') !!}--}}
                        <div class="form-group">
                            <input type="text" class="form-control" id="nome" name="name" placeholder="Nome">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="mensagem" rows="3" name="message" placeholder="Mensagem"></textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn enviar">Enviar</button>
                        </div>
                    </form>

                </div>
            </div>


        </div>
    </section>
</section>
@endsection
