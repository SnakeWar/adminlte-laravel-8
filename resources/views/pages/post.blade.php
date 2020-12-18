@extends('pages.layouts.app')

@section('content')

    <div class="container">
        <div class="row p-5 justify-content-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="{{asset('storage/' . $post->photo)}}" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $post->title }}
                        </h4>
                        <!--                                <h5>$24.99</h5>-->
                        <p class="card-text">{{ $post->body }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
