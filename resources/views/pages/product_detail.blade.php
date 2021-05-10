@extends('pages.layouts.app')

@section('content')

    <section class="pb-5 bg-white">

        <section class="produtos interna">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <div class="row mt-5 mb-5 detalhes">
                            <div class="col-md-3 item text-center">
                                <div class="card">
                                    <img class="card-img-top" src="{{ asset("storage/$product->photo") }}" alt="">
                                </div>
                            </div>

                            <div class="col-md-9 item text-center">
                                <div class="card border-0 text-left">
                                    <div class="card-body pt-4">
                                        <h5 class="card-title text-left">{{ $product->title }}</h5>
                                        {!! $product->body !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="produtos interna pt-0">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <h1>
                            <img src="{{ asset('assets/img/icon/icon_h1.png') }}"> Veja mais produtos
                        </h1>
                    </div>

                    <div class="col-12">
                        <div class="row mt-5 mb-5">
                            @foreach($products as $item)
                            <div class="col-sm-6 col-md-4 col-lg-3 item text-center">
                                <a href="">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset("storage/$item->photo") }}" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->title }}</h5>
                                            <a href="{{ route('product', ['slug' => $item->slug]) }}" class="btn">Leia mais</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                                @endforeach
                        </div>
                        <div class="d-flex justify-content-end mb-5">
                            {{$products->links('vendor.pagination.bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

@endsection
