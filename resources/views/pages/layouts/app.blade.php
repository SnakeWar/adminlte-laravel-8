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
<script src="{{ mix('js/app.js') }}"></script>
@yield('js')
</body>
</html>
