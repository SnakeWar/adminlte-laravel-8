<!DOCTYPE html>
<html lang="en">

<head>
@include('pages.layouts.block.head')
</head>
<body>
@yield('css')
@include('pages.layouts.block.header')
@yield('content')
@include('pages.layouts.block.footer')
@include('pages.layouts.block.script')
@yield('js')
</body>
</html>
