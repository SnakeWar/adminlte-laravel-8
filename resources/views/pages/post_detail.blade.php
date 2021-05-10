@extends('pages.layouts.app')

@section('content')
    <section class="pb-5 bg-white">

        <section class="blog interna">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <div class="row mt-5 mb-5 detalhes">
                            <div class="col-md-3 item text-center">
                                <div class="card">
                                    <img class="card-img-top" src="{{asset("storage/$post->photo")}}" alt="">
                                </div>
                            </div>

                            <div class="col-md-9 item text-center">
                                <div class="card border-0 text-left">
                                    <div class="card-body pt-4">
                                        <small>{{ Helper::convertdata_tosite($post->published_at) }}</small>
                                        <h5 class="card-title text-left">{{ $post->title }}</h5>

                                        {!! $post->body !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(isset($posts))
            <section class="blog interna pt-0">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                            <h1>
                                <img src="{{ asset('assets/img/icon/icon_h1.png') }}"> Veja mais postagens
                            </h1>
                        </div>

                        <div class="col-12">
                            <div class="row mt-5 mb-5">
                                @foreach($posts as $item)
                                    <div class="col-sm-6 col-md-4 col-lg-3 item text-center">
                                        <div class="card">
                                            <img class="card-img-top" src="{{ asset("storage/$item->photo") }}" alt="">
                                            <div class="card-body">
                                                <small>{{ Helper::convertdata_tosite($item->published_at) }}</small>
                                                <h5 class="card-title">{{ $item->title }}</h5>

                                                {!! $item->body !!}

                                            </div>
                                            <a class="stretched-link"
                                               href="{{ route('post', ['slug' => $item->slug]) }}"></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-end mb-5">
                                {{$posts->links('vendor.pagination.bootstrap-4')}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </section>
@endsection
