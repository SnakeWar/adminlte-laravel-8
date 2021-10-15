@extends('pages.layouts.loja')
@section('css')
    <style>
        .negrito{
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
                <div id="app">
                    <front-page>
                    </front-page>
                </div>
@endsection
@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
@stop
