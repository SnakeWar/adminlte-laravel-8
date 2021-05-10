@extends('pages.layouts.app')

@section('content')
    <section sclass="pb-5 bg-white">
        <section class="interna">
            <div class="container">
                <div class="row d-flex" id="somos">
                    <div class="col-xl-12">
                        <h1 class="mb-5">
                            <img src="{{ asset("storage/$page->photo") }}"> {{ $page->title }}
                        </h1>
                        {!! $page->body !!}
                    </div>
                </div>
{{--                <div class="row mt-5">--}}
{{--                    <div class="col-xl-4">--}}
{{--                        <h2 class="mb-3">--}}
{{--                            <img src="assets/img/icon/icon_h1.png"> missão--}}
{{--                        </h2>--}}
{{--                        <p>--}}
{{--                            Lorem ipsum dolor sit amet, consectetur elit. Egestas purus in nisl scelerisque eu ultrices. Proin fermentum porta non pulvinar.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-4">--}}
{{--                        <h2 class="mb-3">--}}
{{--                            <img src="assets/img/icon/icon_h1.png"> visão--}}
{{--                        </h2>--}}
{{--                        <p>--}}
{{--                            Pulvinar elementum integer enim ac tincidunt vitae. Elit eget cum sociis natoque penatibus et. Ut diam quam nulla porttitor massa.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-4">--}}
{{--                        <h2 class="mb-3">--}}
{{--                            <img src="assets/img/icon/icon_h1.png"> valores--}}
{{--                        </h2>--}}
{{--                        <p>--}}
{{--                            Phasellus vestibulum lorem sed risus. Auctor elit sed mi sit amet mauris. Eleifend mi in nulla posuere. Enim neque volutpat ac tincidunt.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </section>
    </section>
@endsection
