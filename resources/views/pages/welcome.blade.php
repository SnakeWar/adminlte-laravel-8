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
    <script type="text/javascript" src="instafeed/instafeed.min.js"></script>
    <script type="text/javascript">
        var accesstoken = 'https://ig.instant-tokens.com/users/ef53d648-9d34-40c9-b375-32c52af34ec1/instagram/17841401606571328/token.js?userSecret=rqjdnr0fvwhjgvahvpyxj'
        console.log(accesstoken)
        $.ajax({
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            type: 'GET',
            url: accesstoken,
            dataType: 'json',
            // contentType: "application/json; charset=utf-8",
            success: function (res) {
                var response = JSON.parse(res)
                console.log(response);
                // Display a success toast, with a title
                // toastr.success(res.data.message, 'Sucesso!');
                // alert(res.data.message)
                // window.location.href = urlThanks + '?order=' + res.data.order;
            },
            error: function (err) {
                console.log('AJAX: ', err);             }
        });

        var feed = new Instafeed({
            accessToken: 'IGQVJVR21MVFh2TVEzYU1yRDR4Mkc1LUM3VTU4MG92bWd4VFFjRnViSHBSajBRRllfRmNSWFo3WXNUcVZAMOHROb0NFeUotMTNHcVBuTHduZAVA5Qlk5QjljMlhvTkFxMVFLM2pXZAF9R',
            limit: 9,
            resolution: 'standard_resolution',
            after: function() {
                var el = document.getElementById('instafeed');
                if (el.classList)
                    el.classList.add('show');
                else
                    el.className += ' ' + 'show';
            }
        });
        feed.run();
    </script>
{{--@include('pages.layouts.partials.filter_script')--}}
@stop
