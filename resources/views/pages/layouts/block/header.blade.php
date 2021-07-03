<section class="navegador">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand mr-5" href="index.php">
            <img src="{{ asset('assets/img/logo.png') }}" alt=""></a>
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img src="{{ asset('assets/img/icon/menu.png') }}" alt="">
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto scroll" >
                <li class="nav-item">
                    <a class="nav-link {{ $pagina == 'Home' ? 'active' : ''}}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $pagina == 'Quem Somos' ? 'active' : ''}}" href="{{ route('quem_somos') }}">Quem somos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $pagina == 'Produtos' ? 'active' : ''}}" href="{{ route('products') }}">Nossos produtos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $pagina == 'Blog' ? 'active' : ''}}" href="{{ route('posts') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#localizacao">Onde encontrar</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SAC
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('fale_conosco') }}">Fale conosco</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('trabalhe_conosco') }}">Trabalhe conosco</a>
                    </div>
                </li>
                <div class="li_sociais">
                    <li class="mr-1">
                        <a href="https://www.facebook.com" target="_blank" class="mr-2"><i class="fab fa-facebook"></i></a>
                    </li>
                    <li class="">
                        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    </li>
                </div>

            </ul>
        </div>

    </nav>
</section>
