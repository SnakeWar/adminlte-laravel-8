@extends('pages.layouts.loja')
@section('css')
    <style>
        .negrito{
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
               {{-- @include('pages.layouts.sections.filter_section')
               @include('pages.layouts.sections.products_section') --}}
                <div id="app">
                    <front-page>
                    </front-page>
                </div>
@endsection
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
