@extends('pages.layouts.app')
@section('content')

    <section class="img_vitrine">
        <div class="owl-carousel owl-theme" id="owl-banner">
            <div class="item">
                <img class="w-100" src="assets/img/img_vitrine.png">
            </div>
            <div class="item">
                <img class="w-100" src="assets/img/img_vitrine.png">
            </div>
        </div>
    </section>
    <section class="quem-somos" >
        <div class="container">
            <div class="row d-flex align-items-center" id="somos">
                <div class="col-xl-5">
                    <h1 class="mb-5">
                        <img src="{{ asset('assets/img/icon/icon_h1.png') }}"> Quem Somos
                    </h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula consectetur nisi non hendrerit. In hac habitasse platea dictumst. Vivamus tincidunt fringilla sollicitudin. Pellentesque sit amet est at justo lacinia suscipit et eu mauris.
                        Fusce dapibus metus nunc, eget fringilla urna maximus vel. Sed orci quam, semper non ante elementum, euismod sollicitudin eros. Nullam vehicula imperdiet eros at malesuada. Donec congue orci nibh, sit amet cursus arcu facilisis ut.
                        Aenean sollicitudin gravida mi, vitae porttitor tortor finibus tincidunt. Cras imperdiet congue cursus. Vivamus id quam mattis, finibus lorem ut, consectetur elit. Aenean et fringilla sapien, ac tristique mauris. Suspendisse commodo
                        ullamcorper lectus et aliquet.
                    </p>
                </div>
                <div class="col-xl-5 frango">
                    <img  src="{{ asset('assets/img/frango.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>



    <section class="produtos">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <h1>
                        <img src="{{ asset('assets/img/icon/icon_h1.png') }}"> Nossos produtos
                    </h1>
                </div>

                <div class="col-12">
                    <div class="owl-carousel owl-theme mt-5 mb-5" id="owl-produtos">
                        @foreach($produtos as $item)
                        <div class="item text-center">
                                <div class="card">
                                    <img class="card-img-top" src="{{ asset("storage/$item->photo") }}" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <a href="{{ route('product', [ 'slug' => $item->slug]) }}" class="btn stretched-link">Leia mais</a>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <a href="{{ route('products') }}" class="btn ver_todos">ver todos os produtos</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <h1>
                        <img src="{{ asset('assets/img/icon/icon_h1.png') }}"> Blog
                    </h1>
                </div>

                <div class="col-12">
                    <div class="owl-carousel owl-theme mt-5 mb-5" id="owl-blog">
                        @foreach($posts as $item)
                        <div class="item">
                                <div class="card">
                                    <img class="card-img-top" src="{{ asset("storage/$item->photo") }}" alt="">
                                    <div class="card-body">
                                        <small>{{ Helper::convertdata_tosite($item->published_at, false) }}</small>
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        {!! $item->body !!}
                                    </div>
                                    <a class="stretched-link" href="{{ route('post', ['slug' => $item->slug]) }}"></a>
                                </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <a href="{{ route('posts') }}" class="btn ver_todos">ver todas as postagens</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="instagram">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 mb-5">
                    <h1>
                        <img src="{{ asset('assets/img/icon/icon_h1.png') }}">
                        <img src="{{ asset('assets/img/icon/instagram.png') }}"> Nome
                        <b>Marca</b>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <img class="w-100" src="{{ asset('assets/img/INSTAGRAM.png') }}" alt="">
    <section class="localizacao">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-9 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Veja aqui a loja mais <b>próximo de você!</b>

                            </h5>
                            <form id="pesquisa_loja">
                                <div class="form-row">
                                    <div class="col-12">
                                        <select class="form-control" id="cidades">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn w-100 pulse">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="localizacao_mapa">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 mb-5">
                    <h1>
                        <img src="{{ asset('assets/img/icon/icon_h1.png') }}">
                        <b>onde encontrar</b>
                    </h1>
                </div>
            </div>
        </div>
        <iframe  id="mapa" class="w-100" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d31753.937488603013!2d-35.26281378815178!3d-5.821431390091804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sfrango%20bom%20todo!5e0!3m2!1spt-BR!2sbr!4v1617915357278!5m2!1spt-BR!2sbr" height="685" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>

    <section class="contato">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <h1>
                        <img src="{{ asset('assets/img/icon/icon_h1.png') }}">
                        <b>contato</b>
                        {{-- display validation errors --}}
                        @if(count($errors) > 0)

                            @foreach($errors->all() as $error)
                                <small class='text-danger'>{{$error}}</small>
                            @endforeach

                        @endif
                        @include('flash::message')
                    </h1>
                    <form class="mt-5" action="{{route('enviar_fale_conosco')}}" method="post" id="regForm" >
                        @csrf
                        {{-- enable captcha for the form --}}
                        @captcha
                        <div class="form-group">
                            <input type="text" class="form-control" id="nome" name="name" placeholder="Nome">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="mensagem" name="message" placeholder="Mensagem" rows="5"></textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn enviar">enviar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <img class="w-100" src="{{ asset('assets/img/contato_frango.png') }}">
                </div>
            </div>
        </div>

    </section>

@endsection
@section('js')
    <script src="{{ asset('assets/mapa/mapa.js') }}"></script>
@endsection
