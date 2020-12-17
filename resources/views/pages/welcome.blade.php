@extends('pages.layouts.app')
@section('css')
    <style>
        .negrito{
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
{{--                @include('pages.layouts.sections.filter_section')--}}
{{--                @include('pages.layouts.sections.products_section')--}}
                <div id="app">
                    <front-page>
                    </front-page>
                </div>
@endsection
@section('js')
{{--@include('pages.layouts.partials.filter_script')--}}
<script>
    $(document).ready(function(){
        var currentItem = null;
        $(".selecionado").click(function(e) {
            if($(this).hasClass("negrito")) {
                $(this).removeClass("negrito")
                currentItem = null;
            } else {
                $(".selecionado.negrito").removeClass("negrito");
                currentItem = $(this).addClass("negrito");
            }
            e.stopPropagation();
        });
        $(document).click(function() {
            $(".selecionado.negrito").removeClass("negrito");
        });
    });
</script>
@stop
