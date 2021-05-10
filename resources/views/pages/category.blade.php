@extends('pages.layouts.app')

@section('content')

    <section class="pb-5 bg-white">

        <section class="produtos interna">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <h1>
                            <img src="{{ asset('assets/img/icon/icon_h1.png') }}"> Nossos produtos
                        </h1>
                    </div>

                    <div class="col-12">
                        <div class="row mt-5 mb-5">
                            @foreach($products as $item)
                            <div class="col-sm-6 col-md-4 col-lg-3 item text-center">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset("storage/$item->photo") }}" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! $item->body !!}</h5>
                                            <a href="{{route('product', [ 'slug' => $item->slug ])}}" class="btn stretched-link">Leia mais</a>
                                        </div>
                                    </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-end mb-5">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </section>

@endsection
