<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h1><img class="mr-2" src="{{ asset('assets/img/icon/footer/icon1.png') }}" alt="">Contatos</h1>
                <div class="mt-4">
                    <div class="media">
                        <img class="mr-3" src="{{ asset('assets/img/icon/footer/endereco.png') }}" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Endereço - Bairro, Cidade - UF, 00000-000</h5>
                        </div>
                    </div>
                    <div class="media">
                        <img class="mr-3" src="{{ asset('assets/img/icon/footer/telefone.png') }}" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">+55 (84) 3206.3410</h5>
                        </div>
                    </div>
                    <div class="media">
                        <img class="mr-3" src="{{ asset('assets/img/icon/footer/horario.png') }}" alt="">
                        <div class="media-body">
                            <h5 class="mt-0"><b>Horário de atendimento:</b><br>
                                A Segunda a Sexta das 08h às 18h</h5>
                        </div>
                    </div>
                    <div class="media">
                        <img class="mr-3" src="{{ asset('assets/img/icon/footer/email.png') }}" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">
                                <b>Email:</b> <br>
                                email@email.com.br
                            </h5>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <h1><img class="mr-2" src="{{ asset('assets/img/icon/footer/icon1.png') }}" alt="">menu</h1>
                <ul class="mt-4">
                    <li>
                        <a href="{{ route('quem_somos') }}">Quem somos</a>
                    </li>
                    <li>
                        <a href="{{ route('products') }}">Nossos produtos</a>
                    </li>
                    <li>
                        <a href="#">Onde encontrar</a>
                    </li>
                    <li>
                        <a href="{{ route('posts') }}">Blog</a>
                    </li>
                    <li>
                        <a href="{{ route('fale_conosco') }}">SAC</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h1><img class="mr-2" src="{{ asset('assets/img/icon/footer/icon1.png') }}" alt="">produtos</h1>
                <ul class="mt-4">
                    @if(isset($categories))
                        @foreach($categories as $item)
                            <li>
                                <a href="{{ route('category', ['id' => $item->id]) }}">{{ $item->title }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-md-3">
                <h1><img class="mr-2" src="{{ asset('assets/img/icon/footer/icon1.png') }}" alt="">redes sociais</h1>
                <div class="mt-4">
                    <a class="mr-2" href="https://www.facebook.com/frangobomtodo" target="_blank">
                        <img class="pulse" src="{{ asset('assets/img/icon/footer/facebook.png') }}" alt="">
                    </a>
                    <a href="https://www.instagram.com/sigabomtodo/" target="_blank">
                        <img class="pulse" src="{{ asset('assets/img/icon/footer/instagram.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<section class="copyright">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-5 text-center text-md-left text-white">
                <small>© Marca | Todos os Direitos Reservados</small>
            </div>
            <div class="col-md-5 text-center  text-md-right text-white">
                <small>Desenvolvido por
                    <a href="Mayrcon" target="_blank">
                    </a>
                </small>
            </div>
        </div>
    </div>
</section>
