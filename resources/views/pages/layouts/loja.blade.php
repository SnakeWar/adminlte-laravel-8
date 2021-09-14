<!DOCTYPE html>
<html lang="en">

<head>
@include('pages.layouts.block_loja.head')
</head>
<!-- preloader -->
<div id="preloader">
    <div class="inner">
        <div class="pulsex">
            <img class="w-100" src="{{ asset('assets/img/logo.png') }}">
        </div>
    </div>
</div>
<body>
@yield('css')
@include('pages.layouts.block_loja.header')
@yield('content')
@include('pages.layouts.block_loja.footer')
@include('pages.layouts.block_loja.script')
@yield('js')
</body>
</html>
